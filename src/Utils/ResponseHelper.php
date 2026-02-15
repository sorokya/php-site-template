<?php

declare(strict_types=1);

namespace App\Utils;

class ResponseHelper
{
    public static function error(string $message, int $statusCode = 400): void
    {
        http_response_code($statusCode);
        header('Content-Type: text/plain; charset=utf-8');
        echo $message;
    }
}
