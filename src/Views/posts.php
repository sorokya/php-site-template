<?php

declare(strict_types=1);

use App\Content\CreatePostAction;
use App\Content\CreatePostRequest;
use App\Content\GetPostsAction;
use App\Data\PDO;
use App\Utils\LayoutHelper;
use App\Utils\SessionHelper;

LayoutHelper::assertRequestMethod('GET', 'POST');
LayoutHelper::begin('Posts', 'Read our latest updates.');
LayoutHelper::addStyleSheet('posts.css');

$user = SessionHelper::getUser();

$pdo = new PDO();

if ($user instanceof \App\Utils\SessionUser && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = new CreatePostRequest(
        $user->id,
        $_POST['title'] ?? '',
        $_POST['content'] ?? '',
    );

    $createPostAction = new CreatePostAction($pdo);
    $post = $createPostAction->execute($request);
    if (!$post instanceof \App\Models\Post) {
        SessionHelper::flashError($createPostAction->error ?? 'Failed to create post.');
    } else {
        SessionHelper::flashSuccess('Post created successfully.');
    }
}

$getPostsAction = new GetPostsAction($pdo);
$result = $getPostsAction->execute();
?>

<div id="posts-container">
    <div>
        <h2>Posts</h2>
        <?php if ($result->posts === []): ?>
            <p>No posts available.</p>
        <?php else: ?>
            <ul id="posts-list">
                <?php foreach ($result->posts as $post): ?>
                    <li>
                        <div class="post-content">
                            <h3><?= htmlspecialchars($post->title) ?></h3>
                            <p><?= nl2br(htmlspecialchars($post->content)) ?></p>
                            <small>Posted on <?= $post->createdAt->format('Y-m-d H:i') ?></small>
                        </div>
                        <?php if ($user instanceof \App\Utils\SessionUser): ?>
                            <div class="post-actions">
                                <form action="/posts/<?= $post->id ?>/edit" method="GET" style="display: inline;">
                                    <button type="submit">Edit</button>
                                </form>
                                <form action="/posts/<?= $post->id ?>/delete" method="POST" style="display: inline;">
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php if ($user instanceof \App\Utils\SessionUser): ?>
        <form action="/posts" method="POST" class="post-form">
            <h2>New Post</h2>
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <button type="submit">Create Post</button>
        </form>
    <?php endif; ?>
</div>

<?php LayoutHelper::end();
