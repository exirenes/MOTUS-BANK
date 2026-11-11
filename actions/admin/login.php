<?php
declare(strict_types=1);
require dirname(dirname(__DIR__)) . '/config/bootstrap.php';

csrf_verify();

$identifier = post_str('identifier');
$pass       = (string)($_POST['password'] ?? '');

if ($identifier === '' || $pass === '') {
    flash_set('error', 'Please enter your credentials.');
    redirect('/pages/public/admin-login.php');
}

if (rate_is_throttled('admin', $identifier)) {
    flash_set('error', 'Too many failed attempts. Try again in 15 minutes.');
    redirect('/pages/public/admin-login.php');
}

$st = db()->prepare('SELECT * FROM admins WHERE username = ? OR email = ? LIMIT 1');
$st->execute([$identifier, $identifier]);
$admin = $st->fetch();

$ok = $admin && password_verify($pass, $admin['password_hash']);
rate_log_attempt('admin', $identifier, $ok);

if (!$ok) {
    flash_set('error', 'Invalid credentials.');
    redirect('/pages/public/admin-login.php');
}
if ($admin['status'] !== 'active') {
    flash_set('error', 'This administrator account is inactive.');
    redirect('/pages/public/admin-login.php');
}

db()->prepare('UPDATE admins SET failed_logins = 0, last_login_at = NOW() WHERE id = ?')
    ->execute([$admin['id']]);

admin_login((int)$admin['id']);
flash_set('success', 'Welcome back, ' . $admin['username'] . '!');
redirect('/pages/admin/dashboard.php');