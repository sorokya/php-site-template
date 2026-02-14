<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Settings', 'Manage your account settings.');
?>

<h1>Settings</h1>

<?php LayoutHelper::end();
