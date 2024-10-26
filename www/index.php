<?php declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Blog;

(new Blog(dirname(__DIR__)))->run();
