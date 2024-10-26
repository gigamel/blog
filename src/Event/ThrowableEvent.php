<?php declare(strict_types=1);

namespace App\Event;

use Throwable;

final class ThrowableEvent
{
    public function __construct(
        private Throwable $e
    ) {
    }

    public function getThrowable(): Throwable
    {
        return $this->e;
    }
}
