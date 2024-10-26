<?php declare(strict_types=1);

namespace Package\Security\Controller;

use App\Common\Http\AbstractController;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class LoginController extends AbstractController
{
    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        return new ServerMessage('You need auth');
    }
}
