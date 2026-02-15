<?php

declare(strict_types=1);

use App\Data\PDO;
use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('POST');

if (!isset($_SESSION['session_token'])) {
    header('Location: /login');
    exit;
}

$pdo = new PDO();
$session = \App\Models\Session::findByToken($pdo, $_SESSION['session_token']);
if (!$session instanceof \App\Models\Session || $session->expired()) {
    session_destroy();
    header('Location: /login');
    exit;
}

$pdo = new PDO();
$session->invalidate($pdo);
session_destroy();
header('Location: /login');
