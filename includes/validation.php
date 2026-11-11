<?php
declare(strict_types=1);

/**
 * Validate required fields.
 * Returns array of field => error message.
 */
function validate_required(array $fields, array $data): array {
    $errors = [];
    foreach ($fields as $key => $label) {
        $v = trim((string)($data[$key] ?? ''));
        if ($v === '') $errors[$key] = "{$label} is required.";
    }
    return $errors;
}

/**
 * Validate password strength: at least 8 chars.
 */
function validate_password(string $pw, string $confirm): array {
    $errors = [];
    if (strlen($pw) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    }
    if ($pw !== $confirm) {
        $errors['password_confirm'] = 'Passwords do not match.';
    }
    return $errors;
}