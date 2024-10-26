<?php declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ClientMessageInterface;

final class RouteFoundEvent
{
    public function __construct(
        private ClientMessageInterface $clientMessage,
        private string $controller
    ) {
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function getClientMessage(): ClientMessageInterface
    {
        return $this->clientMessage;
    }
}
