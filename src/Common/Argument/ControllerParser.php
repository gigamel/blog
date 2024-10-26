<?php declare(strict_types=1);

namespace App\Common\Argument;

use Gigamel\DI\ContainerInterface;
use ReflectionClass;
use RuntimeException;

final class ControllerParser
{
    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function getArguments(string $controller): array
    {
        if (!class_exists($controller)) {
            throw new RuntimeException(sprintf(
                'Controller [%s] does not exists',
                $controller
            ));
        }

        $reflectionClass = new ReflectionClass($controller);
        if (!$constructor = $reflectionClass->getConstructor()) {
            return [];
        }

        if ($constructor->isAbstract() || !$constructor->isPublic()) {
            throw new RuntimeException(sprintf(
                'Constructor of [%s] must be public',
                $controller
            ));
        }

        $arguments = [];
        foreach ($constructor->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType()->getName();
            if ($this->container->has($type)) {
                $arguments[] = $this->container->get($type);
            }
        }

        return $arguments;
    }
}
