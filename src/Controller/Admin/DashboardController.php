<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Common\Http\AbstractController;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class DashboardController extends AbstractController
{
    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        return new ServerMessage('dashboard');
    }
}
