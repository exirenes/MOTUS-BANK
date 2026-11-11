<?php
declare(strict_types=1);
require dirname(__DIR__) . '/config/bootstrap.php';

csrf_verify();

$email = strtolower(post_str('email'));
$pass  = (string)($_POST['password'] ?? '');

if (!valid_email($email) || $pass === '') {
    flash_set('error', 'Please enter a valid email and password.');
    redirect('/pages/public/login.php');
}

// Throttle
if (rate_is_throttled('customer', $email)) {
    flash_set('error', 'Too many failed attempts. Try again in 15 minutes.');
    redirect('/pages/public/login.php');
}

$st = db()->prepare('SELECT * FROM customers WHERE email = ? LIMIT 1');
$st->execute([$email]);
$cust = $st->fetch();

$ok = $cust && password_verify($pass, $cust['password_hash']);
rate_log_attempt('customer', $email, $ok);

if (!$ok) {
    flash_set('error', 'Invalid email or password.');
    redirect('/pages/public/login.php');
}
if ($cust['status'] === 'suspended' || $cust['status'] === 'closed') {
    flash_set('error', 'This account is not accessible. Please contact support.');
    redirect('/pages/public/login.php');
}

// Reset failed_logins on success
db()->prepare('UPDATE customers SET failed_logins = 0 WHERE id = ?')
    ->execute([$cust['id']]);

customer_login((int)$cust['id']);
flash_set('success', 'Welcome back, ' . $cust['first_name'] . '!');
redirect('/pages/customer/dashboard.php');