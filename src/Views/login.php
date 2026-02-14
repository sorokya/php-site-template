<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = new \App\Authentication\LoginRequest(
        $_POST['username'] ?? '',
        $_POST['password'] ?? '',
    );

    $session = \App\Authentication\LoginService::login($request);
    if ($session instanceof \App\Authentication\Session) {
        $_SESSION['session_token'] = $session->token;
        header('Location: /');
        exit;
    }

    $error = 'Invalid username or password.';
}

LayoutHelper::assertRequestMethod('GET', 'POST');
LayoutHelper::begin('Login', 'This is the login page of our PHP site template.');
LayoutHelper::addStyleSheet('login.css');
?>

<form action="/login" method="POST" id="login-form">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <button type="submit">Login</button>
</form>

<?php LayoutHelper::end();
