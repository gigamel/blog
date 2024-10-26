<?php declare(strict_types=1);

namespace App;

use App\Common\Argument\ControllerParser;
use App\Common\Package\ContainerExpandableInterface;
use App\Common\Package\ObservableInterface;
use App\Event\ClientMessageCreatedEvent;
use App\Event\RouteFoundEvent;
use App\Event\ThrowableEvent;
use Gigamel\Http\ClientMessage;
use Gigamel\Http\Router\Collection;
use Gigamel\Http\Router\Router;
use Gigamel\Import\PhpArrayImporter;
use Throwable;

use function is_subclass_of;

final class Blog
{
    private bool $isRunning = false;

    private Core $core;

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
            $this->core->getEventsObserver()->observe(new ThrowableEvent($e));
        }
    }

    /**
     * @throws Throwable
     */
    private function appRun(): void
    {
        $importer = new PhpArrayImporter($this->getConfigDir());
        foreach ($importer->import('packages.php') as $package) {
            if (!is_subclass_of($package, ContainerExpandableInterface::class)) {
                continue;
            }

            $packageInstance = new $package();
            $packageInstance->expandContainer($this->core->getContainer());

            if ($packageInstance instanceof ObservableInterface) {
                $packageInstance->addObservers($this->core->getEventsObserver());
            }
        }

        foreach ($importer->import('observers.php') as $event => $observers) {
            foreach ($observers as $observer) {
                $this->core->getEventsObserver()->addObserver($event, $observer);
            }
        }

        $routes = new Collection();
        foreach ($importer->import('routes.php') as $route) {
            $routes->add($route);
        }

        $clientMessage = new ClientMessage();
        $this->core->getEventsObserver()->observe(new ClientMessageCreatedEvent($clientMessage));

        $router = new Router($routes);
        $route = $router->handleClientMessage($clientMessage);

        $event = new RouteFoundEvent($clientMessage, $route->getHandler());
        $this->core->getEventsObserver()->observe($event);

        $controllerClass = $event->getController();
        $controller = new $controllerClass(...array_values(
            (new ControllerParser($this->core->getContainer()))->getArguments($controllerClass)
        ));

        echo $controller($clientMessage)->getBody();
    }

    private function getConfigDir(): string
    {
        return $this->appDir . '/config';
    }
}