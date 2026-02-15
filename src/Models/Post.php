<?php

declare(strict_types=1);

namespace App\Models;

use App\Data\PDO;
use DateTime;

class Post
{
    public int $id;

    public int $userId;

    public string $title;

    public string $content;

    public DateTime $createdAt;

    public ?DateTime $updatedAt = null;

    public static function create(PDO $pdo, int $userId, string $title, string $content): self
    {
        $post = new self();
        $post->userId = $userId;
        $post->title = $title;
        $post->content = $content;
        $post->createdAt = new DateTime();

        $stmt = $pdo->prepare('INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, :created_at)');
        $stmt->execute([
            'user_id' => $post->userId,
            'title' => $post->title,
            'content' => $post->content,
            'created_at' => $post->createdAt->format('Y-m-d H:i:s'),
        ]);

        $post->id = (int) $pdo->lastInsertId();

        return $post;
    }

    public static function findById(PDO $pdo, int $id): ?self
    {
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }

        $post = new self();
        $post->id = (int) $data['id'];
        $post->userId = (int) $data['user_id'];
        $post->title = (string) $data['title'];
        $post->content = (string) $data['content'];
        $post->createdAt = new DateTime($data['created_at']);
        $post->updatedAt = $data['updated_at'] ? new DateTime($data['updated_at']) : null;
        return $post;
    }
}
