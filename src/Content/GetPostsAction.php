<?php

declare(strict_types=1);

namespace App\Content;

use App\Data\PDO;
use App\Models\Post;

readonly class GetPostsResult
{
    /**
     * @param Post[] $posts
     */
    public function __construct(public array $posts, public int $total)
    {
    }
}

class GetPostsAction
{
    private readonly int $page;

    private readonly int $perPage;

    public function __construct(private readonly PDO $pdo, int $page = 1, int $perPage = 10)
    {
        $this->page = max(1, $page);
        $this->perPage = max(1, min(100, $perPage));
    }

    public function execute(): GetPostsResult
    {
        $offset = ($this->page - 1) * $this->perPage;

        $stmt = $this->pdo->prepare('SELECT * FROM posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue('limit', $this->perPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $posts = [];
        while ($row = $stmt->fetch()) {
            $post = new Post();
            $post->id = (int) $row['id'];
            $post->userId = (int) $row['user_id'];
            $post->title = (string) $row['title'];
            $post->content = (string) $row['content'];
            $post->createdAt = new \DateTime($row['created_at']);
            if (isset($row['updated_at'])) {
                $post->updatedAt = new \DateTime($row['updated_at']);
            }

            $posts[] = $post;
        }

        $countStmt = $this->pdo->query('SELECT COUNT(*) FROM posts');
        if (!$countStmt) {
            throw new \RuntimeException('Failed to count posts');
        }

        $total = (int) $countStmt->fetchColumn();

        return new GetPostsResult($posts, $total);
    }
}
