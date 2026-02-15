<?php

declare(strict_types=1);

namespace App\Content;

use App\Data\PDO;
use App\Models\Post;

class CreatePostAction
{
    public ?string $error = null;

    public function __construct(private readonly PDO $pdo)
    {
    }

    public function execute(CreatePostRequest $request): ?Post
    {
        if ($error = $request->validate()) {
            $this->error = $error;
            return null;
        }

        return Post::create($this->pdo, $request->userId, $request->title, $request->content);
    }
}
