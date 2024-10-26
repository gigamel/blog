<?php declare(strict_types=1);

namespace Package\Debug;

use App\Event\ThrowableEvent;
use App\Common\Package\ContainerExpandableInterface;
use App\Common\Package\ObservableInterface;
use Gigamel\DI\ContainerInterface;
use Gigamel\Event\EventsObserverInterface;
use Package\Debug\Observer\DebugThrowableObserver;

final class Package implements ContainerExpandableInterface, ObservableInterface
{
    public function expandContainer(ContainerInterface $container): void
    {
    }

    public function addObservers(EventsObserverInterface $observers): void
    {
        $observers->addObserver(ThrowableEvent::class, DebugThrowableObserver::class);
    }
}
