<?php declare(strict_types=1);

namespace App\Common\Storage;

use PDO;

interface ConnectionInterface
{
    public function getConnection(): PDO;
}
