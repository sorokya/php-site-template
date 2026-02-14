<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Posts', 'Read our latest updates.');
?>



<?php LayoutHelper::end();
