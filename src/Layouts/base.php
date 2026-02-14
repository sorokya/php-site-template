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
    <?php if ($_ENV['APP_ENV'] === 'development'): ?>
        <link rel="stylesheet" href="http://<?= $_ENV['ESBUILD_SERVE_HOST'] ?? 'localhost' ?>:<?= $_ENV['ESBUILD_SERVE_PORT'] ?? 3751 ?>/css/global.css">
    <?php else: ?>
        <link rel="stylesheet" href="/css/global.css">
    <?php endif; ?>
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAACwsLAAAAAAAFlZWQD///8A5ubmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERERERERERMxREREERERMzMURERBEREzMxERERERETMzMzMxEREREzMzMzERERERMyIiMREREREDMzMzERERERMyIiMBERERETMzMzEREREREyIiMxERERETMzMzERERERMiIiMREQAAEzMzMxEREAEzMzMxERERERERERERHAHwAAgA8AAAAHAAAABwAAAB8AAIAfAADAHwAAwA8AAOAHAADwBwAA8AMAAPgDAAAAAwAAAAMAAIAHAADADwAA" rel="icon" type="image/x-icon">
</head>

<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <?php if ($username): ?>
                <span>Welcome, <?= htmlspecialchars((string) $username) ?></span>
                <form method="POST" action="/logout" style="display:inline;">
                    <button type="submit">Logout</button>
                </form>
            <?php else: ?>
                <a href="/login">Login</a>
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
    <script src="/js/global.js"></script>
</body>

</html>