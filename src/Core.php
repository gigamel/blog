<?php declare(strict_types=1);

namespace App;

use Gigamel\DI\Container;
use Gigamel\DI\ContainerInterface;
use Gigamel\Event\EventsObserver;
use Gigamel\Event\EventsObserverInterface;

final class Core
{
    private ContainerInterface $container;

    private EventsObserverInterface $eventsObserver;

    public function getContainer(): ContainerInterface
    {
        return $this->container ??= new Container();
    }

    public function getEventsObserver(): EventsObserverInterface
    {
        return $this->eventsObserver ??= new EventsObserver();
    }
}
