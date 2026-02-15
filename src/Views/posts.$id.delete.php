<?php

declare(strict_types=1);

use App\Content\DeletePostAction;
use App\Data\PDO;
use App\Utils\LayoutHelper;
use App\Utils\ResponseHelper;
use App\Utils\SessionHelper;

LayoutHelper::assertRequestMethod('POST');

$user = SessionHelper::getUser();
if (!$user instanceof \App\Utils\SessionUser) {
    ResponseHelper::error('Unauthorized', 403);
}

if (!isset($id) || !is_numeric($id)) {
    ResponseHelper::error('Invalid post ID', 400);
}

$deleteAction = new DeletePostAction(new PDO(), (int) $id);
if ($deleteAction->execute()) {
    SessionHelper::flashSuccess('Post deleted successfully.');
} else {
    SessionHelper::flashError('Failed to delete post.');
}

ResponseHelper::redirect('/posts');
