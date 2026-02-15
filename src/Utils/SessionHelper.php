<?php

declare(strict_types=1);

namespace App\Utils;

class SessionUser
{
    public function __construct(public int $id, public string $username)
    {
    }
}

class SessionHelper
{
    public static function getUser(): ?SessionUser
    {
        $currentUser = $_SESSION['current_user'] ?? null;
        if (!$currentUser) {
            return null;
        }

        return new SessionUser((int) $currentUser['id'], (string) $currentUser['username']);
    }
}
