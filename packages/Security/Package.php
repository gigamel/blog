<?php declare(strict_types=1);

namespace Package\Security;

use App\Event\RouteFoundEvent;
use App\Common\Package\ContainerExpandableInterface;
use App\Common\Package\ObservableInterface;
use Gigamel\DI\ContainerInterface;
use Gigamel\Event\EventsObserverInterface;
use Package\Security\Observer\RouteSecurityObserver;

final class Package implements ContainerExpandableInterface, ObservableInterface
{
    public function expandContainer(ContainerInterface $container): void
    {
    }

    public function addObservers(EventsObserverInterface $observers): void
    {
        $observers->addObserver(RouteFoundEvent::class, RouteSecurityObserver::class);
    }
}
