<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Http\AbstractController;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class DefaultController extends AbstractController
{
    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        return new ServerMessage('Hello world');
    }
}
