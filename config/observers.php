<?php declare(strict_types=1);

use App\Event\ClientMessageCreatedEvent;
use App\Event\RouteFoundEvent;
use App\Event\ThrowableEvent;

return [
    ClientMessageCreatedEvent::class => [
        \App\Observer\ClientMessage\ClientHeadersObserver::class,
    ],
    RouteFoundEvent::class => [
        \App\Observer\RouteFound\TypeControllerObserver::class,
    ],
    ThrowableEvent::class => [
        \App\Observer\Throwable\DebugThrowableObserver::class,
    ],
];
