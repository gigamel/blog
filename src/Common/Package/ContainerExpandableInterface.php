<?php declare(strict_types=1);

namespace App\Common\Package;

use Gigamel\DI\ContainerInterface;

interface ContainerExpandableInterface
{
    public function expandContainer(ContainerInterface $container): void;
}
