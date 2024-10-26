<?php declare(strict_types=1);

namespace App\Observer\RouteFound;

use App\Common\Http\AbstractController;
use App\Event\RouteFoundEvent;
use RuntimeException;

use function is_subclass_of;

final class TypeControllerObserver
{
    public function __invoke(RouteFoundEvent $event): void
    {
        if (is_subclass_of($event->getController(), AbstractController::class)) {
            return;
        }

        throw new RuntimeException(sprintf(
            'Controller [%s] must be instanceof [%s]',
            $event->getController(),
            AbstractController::class
        ));
    }
}
