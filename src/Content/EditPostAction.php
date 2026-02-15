<?php

declare(strict_types=1);

namespace App\Content;

use App\Data\PDO;

class EditPostAction
{
    public ?string $error = null;

    public function __construct(private readonly PDO $pdo)
    {
    }

    public function execute(EditPostRequest $request): bool
    {
        if ($error = $request->validate()) {
            $this->error = $error;
            return false;
        }

        $stmt = $this->pdo->prepare('UPDATE posts SET title = :title, content = :content, updated_at = NOW() WHERE id = :id');
        return $stmt->execute([
            'id' => $request->postId,
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }
}
