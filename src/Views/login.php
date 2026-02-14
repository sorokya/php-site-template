<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginService = new \App\Authentication\LoginService();
    $request = new \App\Authentication\LoginRequest(
        $_POST['username'] ?? '',
        $_POST['password'] ?? '',
    );

    $session = $loginService->login($request);
    if ($session instanceof \App\Authentication\Session) {
        $_SESSION['session_token'] = $session->token;
        header('Location: /');
        exit;
    }

    $error = 'Invalid username or password.';
}

function login(string $username, string $password): ?int
{
    if (strlen($username) < 3) {
        fake_hash_verify();
        return null;
    }

    if (strlen($password) < 6) {
        fake_hash_verify();
        return null;
    }

    $pdo = new App\Data\PDO();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if (!$user || !password_verify($password, (string) $user['password_hash'])) {
        return null;
    }

    return $user['id'];
}

/// This function is used to mitigate timing attacks by performing a fake password verification
function fake_hash_verify(): void
{
    password_verify('fake_password', '$argon2id$v=19$m=65536,t=4,p=1$fake_salt$fake_hash');
}

LayoutHelper::assertRequestMethod('GET', 'POST');
LayoutHelper::begin('Login', 'This is the login page of our PHP site template.');
?>

<h1>Login</h1>
<form action="/login" method="POST">
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
