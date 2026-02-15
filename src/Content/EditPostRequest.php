<?php

declare(strict_types=1);

namespace App\Content;

class EditPostRequest
{
    public string $title;

    public string $content;

    public function __construct(public int $postId, string $title, string $content)
    {
        $this->title = trim($title);
        $this->content = trim($content);
    }

    public function validate(): ?string
    {
        if ($this->postId <= 0) {
            return 'Invalid post ID.';
        }

        if (strlen($this->title) < 3 || strlen($this->title) > 255) {
            return 'Title must be between 3 and 255 characters long.';
        }

        if (strlen($this->content) < 10) {
            return 'Content must be at least 10 characters long.';
        }

        return null;
    }
}
