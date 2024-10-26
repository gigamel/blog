<?php declare(strict_types=1);

namespace App\Observer\Throwable;

use App\Event\ThrowableEvent;

final class DebugThrowableObserver
{
    public function __invoke(ThrowableEvent $event): void
    {
        throw $event->getThrowable();
    }
}
