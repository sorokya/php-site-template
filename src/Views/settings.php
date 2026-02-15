<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;
use App\Utils\ResponseHelper;
use App\Utils\SessionHelper;

$user = SessionHelper::getUser();
if (!$user instanceof \App\Utils\SessionUser) {
    ResponseHelper::redirect('/login');
}

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Settings', 'Manage your account settings.');
?>

<h1>Settings</h1>

<?php LayoutHelper::end();
