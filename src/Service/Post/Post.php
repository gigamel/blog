<?php declare(strict_types=1);

namespace App\Service\Post;

final class Post
{
    public int $id;

    public string $title;

    public string $preview;

    public string $content;

    public string $status;

    public int $published;

    public int $updated;
}
