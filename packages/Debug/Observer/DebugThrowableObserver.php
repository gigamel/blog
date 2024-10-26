<?php declare(strict_types=1);

namespace Package\Debug\Observer;

use App\Event\ThrowableEvent;

final class DebugThrowableObserver
{
    public function __invoke(ThrowableEvent $event): bool
    {
        echo sprintf('<pre>%s</pre>', var_export($event->getThrowable(), true));
        return true;
    }
}
