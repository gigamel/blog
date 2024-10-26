<?php declare(strict_types=1);

namespace App\Service\Post;

use App\Common\Storage\ConnectionInterface;

final class PostRepository
{
    public function __construct(private ConnectionInterface $connection)
    {
    }

    /**
     * @return Post[]
     */
    public function getList(): array
    {
        return [];
    }
}
