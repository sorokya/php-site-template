<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Foo', 'This is the foo page of our PHP site template.');
?>

<h1>Hello from foo!</h1>

<?php LayoutHelper::end();
