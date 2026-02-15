<?php

declare(strict_types=1);

namespace App\Content;

use App\Data\PDO;

class DeletePostAction
{
    public function __construct(private readonly PDO $pdo, private readonly int $postId)
    {
    }

    public function execute(): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = :id');
        $stmt->execute(['id' => $this->postId]);

        return $stmt->rowCount() > 0;
    }
}
