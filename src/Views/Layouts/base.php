<?php

declare(strict_types=1);

if (!isset($viewContent) || !is_string($viewContent)) {
    throw new RuntimeException('View content is not set or is not a string');
}

$title = isset($viewTitle) && is_string($viewTitle) ? $viewTitle . ' - PHP Site Template' : 'PHP Site Template';
$description = isset($viewDescription) && is_string($viewDescription) ? $viewDescription : 'A simple PHP site template with routing and layouts.';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    <link rel="stylesheet" href="/css/global.css">
</head>

<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/foo">Foo</a>
            <a href="/bar">Bar</a>
        </nav>
    </header>
    <main>
        <?= $viewContent ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> PHP Site Template</p>
    </footer>
    <script src="/js/global.js"></script>
</body>