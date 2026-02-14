<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= LayoutHelper::getTitle() ?></title>
    <meta name="description" content="<?= LayoutHelper::getDescription() ?>">
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
        <?= LayoutHelper::getContent() ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> PHP Site Template</p>
    </footer>
    <script src="/js/global.js"></script>
</body>