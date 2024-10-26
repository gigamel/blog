<?php declare(strict_types=1);

namespace App\Observer\ClientMessage;

use App\Event\ClientMessageCreatedEvent;

final class ClientHeadersObserver
{
    public function __invoke(ClientMessageCreatedEvent $event): void
    {
    }
}
