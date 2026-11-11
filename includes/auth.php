<?php
declare(strict_types=1);

function customer_id(): ?int { return isset($_SESSION['customer_id']) ? (int)$_SESSION['customer_id'] : null; }
function admin_id(): ?int { return isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : null; }

function current_customer(): ?array {
    $id = customer_id(); if (!$id) return null;
    $st = db()->prepare('SELECT * FROM customers WHERE id = ? LIMIT 1');
    $st->execute([$id]); return $st->fetch() ?: null;
}
function current_admin(): ?array {
    $id = admin_id(); if (!$id) return null;
    $st = db()->prepare('SELECT * FROM admins WHERE id = ? LIMIT 1');
    $st->execute([$id]); return $st->fetch() ?: null;
}

function require_customer(): void {
    if (!customer_id()) {
        flash_set('error', 'Please log in to continue.');
        redirect('/pages/public/login.php');
    }
    $c = current_customer();
    if (!$c) { customer_logout(); redirect('/pages/public/login.php'); }
    if (in_array($c['status'], ['suspended', 'closed'], true)) {
        customer_logout();
        flash_set('error', 'Your account is not accessible. Please contact support.');
        redirect('/pages/public/login.php');
    }
}
function require_admin(): void {
    if (!admin_id()) { flash_set('error', 'Administrator login required.'); redirect('/pages/public/admin-login.php'); }
    $a = current_admin();
    if (!$a || $a['status'] !== 'active') {
        admin_logout();
        flash_set('error', 'Administrator account is not active.');
        redirect('/pages/public/admin-login.php');
    }
}

function customer_login(int $id): void {
    session_regenerate_id(true);
    $_SESSION['customer_id'] = $id;
    $_SESSION['customer_login_at'] = time();
}
function customer_logout(): void {
    unset($_SESSION['customer_id'], $_SESSION['customer_login_at']);
    session_regenerate_id(true);
}
function admin_login(int $id): void {
    session_regenerate_id(true);
    $_SESSION['admin_id'] = $id;
    $_SESSION['admin_login_at'] = time();
}
function admin_logout(): void {
    unset($_SESSION['admin_id'], $_SESSION['admin_login_at']);
    session_regenerate_id(true);
}