<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('POST');

if (!isset($_SESSION['session_token'])) {
    header('Location: /login');
    exit;
}

$session = \App\Authentication\Session::findByToken($_SESSION['session_token']);
if (!$session instanceof \App\Authentication\Session || $session->expired()) {
    session_destroy();
    header('Location: /login');
    exit;
}

\App\Authentication\LoginService::logout($session);
session_destroy();
header('Location: /login');
