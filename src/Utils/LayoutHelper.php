<?php

declare(strict_types=1);

namespace App\Utils;

class LayoutHelper
{
    /**
     * Layout data storage
     * @var array{title: string, description: string, layout: string, content: string}
     */
    private static array $__layout_data = [
        'title' => '',
        'description' => '',
        'layout' => 'base',
        'content' => '',
    ];

    public static function assertRequestMethod(string ...$allowedMethods): void
    {
        if (!in_array($_SERVER['REQUEST_METHOD'] ?? '', $allowedMethods, true)) {
            http_response_code(405);
            echo 'Method Not Allowed';
            exit;
        }
    }

    public static function begin(string $title = '', string $description = '', string $layout = 'base'): void
    {
        self::$__layout_data['title'] = $title !== '' && $title !== '0' ? $title . ' - PHP Site Template' : 'PHP Site Template';
        self::$__layout_data['description'] = $description ?: 'A simple PHP site template with routing and layouts.';
        self::$__layout_data['layout'] = $layout;

        ob_start();
    }

    public static function end(): void
    {
        self::$__layout_data['content'] = ob_get_clean() ?: '';
        $viewLayout = self::$__layout_data['layout'];
        require __DIR__ . '/../Layouts/' . $viewLayout . '.php';
    }

    public static function getTitle(): string
    {
        return htmlspecialchars(self::$__layout_data['title']);
    }

    public static function getDescription(): string
    {
        return htmlspecialchars(self::$__layout_data['description']);
    }

    public static function getContent(): string
    {
        return self::$__layout_data['content'];
    }
}
