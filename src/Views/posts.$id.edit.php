<?php

declare(strict_types=1);

use App\Content\EditPostAction;
use App\Content\EditPostRequest;
use App\Data\PDO;
use App\Models\Post;
use App\Utils\LayoutHelper;
use App\Utils\ResponseHelper;
use App\Utils\SessionHelper;

LayoutHelper::assertRequestMethod('GET', 'POST');

$user = SessionHelper::getUser();
if (!$user instanceof \App\Utils\SessionUser) {
    ResponseHelper::error('Unauthorized', 403);
}

if (!isset($id) || !is_numeric($id)) {
    ResponseHelper::error('Invalid post ID', 400);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editAction = new EditPostAction(new PDO());
    $editRequest = new EditPostRequest(
        postId: (int) $id,
        title: $_POST['title'] ?? '',
        content: $_POST['content'] ?? '',
    );

    if ($editAction->execute($editRequest)) {
        ResponseHelper::redirect('/posts');
    }

    ResponseHelper::error($editAction->error ?? 'Failed to update post', 400);
}

$post = Post::findById(new PDO(), (int) $id);
if (!$post instanceof \App\Models\Post) {
    ResponseHelper::error('Post not found', 404);
}

LayoutHelper::begin('Edit Post', 'Edit your post here.');
LayoutHelper::addStyleSheet('posts.css') ?>

<h2>Edit Post</h2>
<form action="/posts/<?= $post->id ?>/edit" method="POST" class="post-form">
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post->title) ?>" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?= htmlspecialchars($post->content) ?></textarea>
    </div>
    <button type="submit">Save Changes</button>
</form>

<?php LayoutHelper::end(); ?>