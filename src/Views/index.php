<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

$viewTitle = 'Home';

ob_start();
?>

<h1>Hello from index!</h1>

<?php
$viewContent = ob_get_clean();
require __DIR__ . '/Layouts/base.php';
