<?php declare(strict_types=1);

namespace Package\Security\Observer;

use App\Event\RouteFoundEvent;
use Package\Security\Controller\LoginController;

final class RouteSecurityObserver
{
    public function __invoke(RouteFoundEvent $event): void
    {
        $clientMessage = $event->getClientMessage();
        if (preg_match('~^/admin/~', $clientMessage->getPath())) {
            $event->setController(LoginController::class);
        }
    }
}
