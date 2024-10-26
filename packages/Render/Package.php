<?php declare(strict_types=1);

namespace Package\Render;

use App\Common\Package\ContainerExpandableInterface;
use Gigamel\DI\ContainerInterface;
use Gigamel\Frontend\View\Driver\PhpRenderDriver;
use Gigamel\Frontend\View\RenderCompositeInterface;
use Package\Render\Frontend\RenderComposite;

final class Package implements ContainerExpandableInterface
{
    public function expandContainer(ContainerInterface $container): void
    {
        $container->importArguments(__DIR__ . '/src/arguments.php');

        $container->register(RenderCompositeInterface::class, RenderComposite::class);

        $container->get(RenderCompositeInterface::class)->setDriver(new PhpRenderDriver());
    }
}
