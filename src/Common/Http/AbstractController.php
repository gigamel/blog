<?php declare(strict_types=1);

namespace App\Common\Http;

use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;

abstract class AbstractController
{
    abstract public function __invoke(ClientMessageInterface $message): ServerMessageInterface;
}
