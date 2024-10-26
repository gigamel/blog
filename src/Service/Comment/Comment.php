<?php declare(strict_types=1);

namespace App\Service\Comment;

final class Comment
{
    public int $id;

    public int $parent_id = 0;

    public string $text;

    public int $published;

    public string $status;
}
