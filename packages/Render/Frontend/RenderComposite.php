<?php declare(strict_types=1);

namespace Package\Render\Frontend;

use Gigamel\Frontend\View\RenderComposite as FrameworkRenderComposite;

final class RenderComposite extends FrameworkRenderComposite
{
    public function __construct(
        private readonly string $viewDir
    ) {
    }

    public function render(string $view, array $vars = []): string
    {
        return parent::render($this->viewDir . '/' . $view, $vars);
    }
}
