<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

$title = 'Foo';

ob_start();
?>

<h1>Hello from foo!</h1>

<?php
$viewContent = ob_get_clean();
require __DIR__ . '/Layouts/base.php';
