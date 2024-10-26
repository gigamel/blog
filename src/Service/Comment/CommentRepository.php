<?php declare(strict_types=1);

namespace App\Service\Comment;

use App\Common\Storage\ConnectionInterface;

final class CommentRepository
{
    public function __construct(private ConnectionInterface $connection)
    {
    }

    /**
     * @return Comment[]
     */
    public function getList(): array
    {
        return [];
    }
}
