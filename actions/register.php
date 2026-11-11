<?php
declare(strict_types=1);
require dirname(__DIR__) . '/config/bootstrap.php';

csrf_verify();

$data = [
    'first_name'  => post_str('first_name'),
    'middle_name' => post_str('middle_name'),
    'last_name'   => post_str('last_name'),
    'email'       => strtolower(post_str('email')),
    'phone'       => post_str('phone'),
    'country'     => post_str('country'),
    'address'     => post_str('address'),
    'dob'         => post_str('dob'),
];
$password = (string)($_POST['password'] ?? '');
$confirm  = (string)($_POST['password_confirm'] ?? '');
$termsOk  = isset($_POST['terms']);

$errors = validate_required([
    'first_name' => 'First name',
    'last_name'  => 'Last name',
    'email'      => 'Email',
    'phone'      => 'Phone',
    'country'    => 'Country',
], $data);

if (!$errors && !valid_email($data['email'])) {
    $errors['email'] = 'Invalid email address.';
}

$pwErrors = validate_password($password, $confirm);
if ($pwErrors) $errors += $pwErrors;

if (!$termsOk) $errors['terms'] = 'You must accept the terms.';

// Duplicate email check
if (empty($errors['email'])) {
    $st = db()->prepare('SELECT id FROM customers WHERE email = ? LIMIT 1');
    $st->execute([$data['email']]);
    if ($st->fetch()) $errors['email'] = 'That email is already registered.';
}

if ($errors) {
    $_SESSION['_reg_old']    = $data;
    $_SESSION['_reg_errors'] = $errors;
    flash_set('error', 'Please correct the errors below.');
    redirect('/pages/public/register.php');
}

try {
    db()->beginTransaction();

    // Generate UUID
    $hex  = bin2hex(random_bytes(16));
    $uuid = substr($hex,0,8).'-'.substr($hex,8,4).'-'.substr($hex,12,4).'-'.substr($hex,16,4).'-'.substr($hex,20,12);

    $st = db()->prepare(
        'INSERT INTO customers
         (uuid, first_name, middle_name, last_name, email, phone, country, address, dob, password_hash, status)
         VALUES (?,?,?,?,?,?,?,?,?,?,"active")'
    );
    $st->execute([
        $uuid,
        $data['first_name'],
        $data['middle_name'] ?: null,
        $data['last_name'],
        $data['email'],
        $data['phone'],
        $data['country'],
        $data['address'] ?: null,
        $data['dob'] ?: null,
        password_hash($password, PASSWORD_DEFAULT),
    ]);
    $cid = (int)db()->lastInsertId();

    // Auto-create a checking account (no balance — admin credits later)
    $acctNo = (string)random_int(1000000000, 9999999999);
    $st = db()->prepare(
        'INSERT INTO accounts (customer_id, account_number, type, currency, status)
         VALUES (?, ?, "checking", "USD", "active")'
    );
    $st->execute([$cid, $acctNo]);

    // Record terms acceptance
    db()->prepare(
        'INSERT INTO terms_acceptances (customer_id, terms_version, ip) VALUES (?, "v1", ?)'
    )->execute([$cid, $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0']);

    db()->commit();

    customer_login($cid);
    flash_set('success', 'Welcome to ' . brand('name') . '!');
    redirect('/pages/customer/dashboard.php');
} catch (Throwable $ex) {
    if (db()->inTransaction()) db()->rollBack();
    error_log('register: ' . $ex->getMessage());
    flash_set('error', 'Registration failed. Please try again.');
    redirect('/pages/public/register.php');
}