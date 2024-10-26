<?php declare(strict_types=1);

namespace App\Observer\ServerMessage;

use App\Event\ServerMessageReceivedEvent;

final class ServerHeadersObserver
{
    public function __invoke(ServerMessageReceivedEvent $event): void
    {
        $event->getServerMessage()->addHeader('App-Result', 'Worked successfully');
    }
}
