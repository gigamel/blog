<?php declare(strict_types=1);

namespace App;

use App\Common\Argument\ControllerParser;
use App\Common\Package\ContainerExpandableInterface;
use App\Common\Package\ObservableInterface;
use App\Event\ClientMessageCreatedEvent;
use App\Event\RouteFoundEvent;
use App\Event\ServerMessageReceivedEvent;
use App\Event\ThrowableEvent;
use Gigamel\Http\ClientMessage;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\Router\Collection;
use Gigamel\Http\Router\CollectionInterface;
use Gigamel\Http\Router\Router;
use Gigamel\Http\Server;
use Gigamel\Import\ImportableInterface;
use Gigamel\Import\PhpArrayImporter;
use Throwable;

use function is_subclass_of;

final class Blog
{
    private bool $isRunning = false;

    private Core $core;

    private ?CollectionInterface $routes = null;

    public function __construct(private readonly string $appDir)
    {
    }

    public function run(): void
    {
        if ($this->isRunning) {
            return;
        }

        $this->isRunning = true;
        $this->core ??= new Core();

        try {
            $this->appRun();
        } catch (Throwable $e) {
            $this->handleThrowable($e);
        }
    }

    private function bootstrap(): void
    {
        $importer = new PhpArrayImporter($this->getConfigDir());
        $this->setupPackages($importer);
        $this->setupObservers($importer);
        $this->setupRoutes($importer);
    }

    private function setupPackages(ImportableInterface $importer): void
    {
        foreach ($importer->import('packages.php') as $package) {
            if (!class_exists($package) || !is_subclass_of($package, ContainerExpandableInterface::class)) {
                continue;
            }

            $packageInstance = new $package();
            $packageInstance->expandContainer($this->core->getContainer());

            if ($packageInstance instanceof ObservableInterface) {
                $packageInstance->addObservers($this->core->getEventsObserver());
            }
        }
    }

    private function setupObservers(ImportableInterface $importer): void
    {
        foreach ($importer->import('observers.php') as $event => $observers) {
            foreach ($observers as $observer) {
                $this->core->getEventsObserver()->addObserver($event, $observer);
            }
        }
    }

    private function setupRoutes(ImportableInterface $importer): void
    {
        if ($this->routes) {
            return;
        }

        $this->routes = new Collection();
        foreach ($importer->import('routes.php') as $route) {
            $this->routes->add($route);
        }
    }

    /**
     * @throws Throwable
     */
    private function appRun(): void
    {
        $clientMessage = new ClientMessage();
        $this->core->getEventsObserver()->observe(new ClientMessageCreatedEvent($clientMessage));

        $this->bootstrap();

        $serverMessage = $this->handleClientMessage($clientMessage);
        $this->core->getEventsObserver()->observe(new ServerMessageReceivedEvent($serverMessage));

        (new Server())->sendMessage($serverMessage);
    }

    private function handleClientMessage(ClientMessageInterface $message): ServerMessageInterface
    {
        $router = new Router($this->routes);
        $route = $router->handleClientMessage($message);

        $event = new RouteFoundEvent($message, $route->getHandler());
        $this->core->getEventsObserver()->observe($event);

        $controllerClass = $event->getController();
        return (new $controllerClass(...array_values(
            (new ControllerParser($this->core->getContainer()))->getArguments($controllerClass)
        )))($message);
    }

    private function handleThrowable(Throwable $e): void
    {
        $this->core->getEventsObserver()->observe(new ThrowableEvent($e));
    }

    private function getConfigDir(): string
    {
        return $this->appDir . '/config';
    }
}
