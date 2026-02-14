<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Home', 'Welcome to the home page of our PHP site template.');
?>

<h1>Hello from index!</h1>

<?php LayoutHelper::end();
