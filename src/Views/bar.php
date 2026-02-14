<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Bar', 'This is the bar page.');
?>

<h1>Hello from bar!</h1>

<?php LayoutHelper::end();
