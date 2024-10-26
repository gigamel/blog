<?php declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ClientMessageInterface;

final class ClientMessageCreatedEvent
{
    public function __construct(
        private ClientMessageInterface $clientMessage
    ) {
    }

    public function getClientMessage(): ClientMessageInterface
    {
        return $this->clientMessage;
    }
}
