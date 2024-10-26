<?php declare(strict_types=1);

namespace App\Common\Package;

use Gigamel\Event\EventsObserverInterface;

interface ObservableInterface
{
    public function addObservers(EventsObserverInterface $observers): void;
}
