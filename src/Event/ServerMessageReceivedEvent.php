<?php declare(strict_types=1);

namespace App\Event;

use Gigamel\Http\Protocol\ServerMessageInterface;

final class ServerMessageReceivedEvent
{
    public function __construct(
        private ServerMessageInterface $serverMessage
    ) {
    }

    public function getServerMessage(): ServerMessageInterface
    {
        return $this->serverMessage;
    }
}
