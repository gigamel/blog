<?php declare(strict_types=1);

use Gigamel\Frontend\View\RenderCompositeInterface;

return [
    RenderCompositeInterface::class => [
        'viewDir' => dirname(dirname(dirname(__DIR__))) . '/view',
    ],
];
