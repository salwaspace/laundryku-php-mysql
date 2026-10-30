<?php
require 'functions.php';
if (!empty($_SESSION['user_id'])) redirect('index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    require 'config.php';
    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        redirect('index.php');
    } else { $error = tr('login_failed'); }
}
require 'header.php'; ?>
<div class="login-panel"><div class="eyebrow">ADMIN PORTAL</div><h1><?= h(tr('login')) ?></h1><p><?= h(tr('login_hint')) ?></p>
<?php if ($error): ?><div class="alert error"><?= h($error) ?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
<label><?= h(tr('username')) ?><input name="username" required autocomplete="username"></label>
<label><?= h(tr('password')) ?><input type="password" name="password" required autocomplete="current-password"></label>
<button class="primary full" type="submit"><?= h(tr('login')) ?></button></form></div>
<?php require 'footer.php'; ?>
