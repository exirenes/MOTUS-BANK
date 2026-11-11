<?php
declare(strict_types=1);

function e(mixed $v): string {
    return htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function redirect(string $path): never { header('Location: ' . $path); exit; }
function input(string $key, mixed $default = null): mixed { return $_POST[$key] ?? $_GET[$key] ?? $default; }
function post(string $key, mixed $default = null): mixed { return $_POST[$key] ?? $default; }
function get(string $key, mixed $default = null): mixed { return $_GET[$key] ?? $default; }
function post_str(string $key, string $default = ''): string { return trim((string)($_POST[$key] ?? $default)); }
function json_out(array $payload, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload); exit;
}
function money(int $minor, string $symbol = '$'): string {
    return $symbol . number_format($minor / 100, 2, '.', ',');
}
function new_ref(string $prefix = 'TXN'): string {
    return $prefix . '-' . strtoupper(bin2hex(random_bytes(6)));
}
function random_token(int $bytes = 32): string { return bin2hex(random_bytes($bytes)); }
function flash_set(string $key, string $msg): void { $_SESSION['_flash'][$key] = $msg; }
function flash_get(string $key): ?string {
    $v = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]); return $v;
}
function valid_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
function safe_redirect_path(string $path): string {
    if ($path === '' || $path[0] !== '/' || str_starts_with($path, '//')) return '/';
    return $path;
}