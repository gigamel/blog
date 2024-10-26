<?php declare(strict_types=1);

namespace App\Controller;

use App\Common\Http\AbstractController;
use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class DefaultController extends AbstractController
{
    public function __construct(
        private RenderCompositeInterface $renderer
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        return new ServerMessage(
            $this->renderer->render(
                'home.php',
                [
                    'content' => 'This is home page Controller',
                ]
            ),
        );
    }
}
