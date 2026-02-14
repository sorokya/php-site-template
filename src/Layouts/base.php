<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

$username = $_SESSION['current_user']['username'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= LayoutHelper::getTitle() ?></title>
    <meta name="description" content="<?= LayoutHelper::getDescription() ?>">
    <?php foreach (LayoutHelper::getStyleSheets() as $stylesheet): ?>
        <link rel="stylesheet" href="<?= LayoutHelper::getStyleSheetUrl($stylesheet) ?>">
    <?php endforeach; ?>
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACwsLAAAAAAAFlZWQD///8A5ubmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERERERERERMxREREERERMzMURERBEREzMxERERERETMzMzMxEREREzMzMzERERERMyIiMREREREDMzMzERERERMyIiMBERERETMzMzEREREREyIiMxERERETMzMzERERERMiIiMREQAAEzMzMxEREAEzMzMxERERERERERERHAHwAAgA8AAAAHAAAABwAAAB8AAIAfAADAHwAAwA8AAOAHAADwBwAA8AMAAPgDAAAAAwAAAAMAAIAHAADADwAA" rel="icon" type="image/x-icon">
</head>

<body>
    <header>
        <h1>PHP Site Template</h1>
        <nav class="nav-primary">
            <a href="/" <?= LayoutHelper::is_active_route('/') ? 'class="active"' : '' ?>>Home</a>
            <a href="/posts" <?= LayoutHelper::is_active_route('/posts') ? 'class="active"' : '' ?>>Posts</a>
            <a href="https://github.com/sorokya/php-site-template" target="_blank" rel="noopener noreferrer">GitHub</a>
            <?php if ($username): ?>
                <a href="/settings" <?= LayoutHelper::is_active_route('/settings') ? 'class="active"' : '' ?>>Settings</a>
            <?php endif; ?>
        </nav>
        <nav class="nav-secondary">
            <?php if ($username): ?>
                <form method="POST" action="/logout">
                    <span>Welcome, <?= htmlspecialchars((string) $username) ?>! Not you?</span>
                    <button type="submit">Logout</button>
                </form>
            <?php else: ?>
                <a href="/login" <?= LayoutHelper::is_active_route('/login') ? 'class="active"' : '' ?>>Login</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <?= LayoutHelper::getContent() ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> PHP Site Template</p>
    </footer>
    <script type="text/javascript">
        window.APP_ENV = <?= json_encode($_ENV['APP_ENV'] ?? 'production') ?>;
        <?php if ($_ENV['APP_ENV'] === 'development'): ?>
            window.ESBUILD_SERVE_HOST = <?= json_encode($_ENV['ESBUILD_SERVE_HOST'] ?? 'localhost') ?>;
            window.ESBUILD_SERVE_PORT = <?= json_encode($_ENV['ESBUILD_SERVE_PORT'] ?? 3751) ?>;
        <?php endif; ?>
    </script>
    <?php foreach (LayoutHelper::getScripts() as $script): ?>
        <script src="/js/<?= htmlspecialchars($script) ?>"></script>
    <?php endforeach; ?>
</body>

</html>