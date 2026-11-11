<?php
declare(strict_types=1);

/**
 * Count failed attempts for identifier within window.
 */
function rate_failed_attempts(string $userType, string $identifier, int $windowSeconds = 900): int {
    $st = db()->prepare(
        'SELECT COUNT(*) FROM login_attempts
         WHERE user_type = ? AND identifier = ? AND success = 0
           AND created_at > (NOW() - INTERVAL ? SECOND)'
    );
    $st->execute([$userType, $identifier, $windowSeconds]);
    return (int)$st->fetchColumn();
}

/**
 * Record a login attempt (success=1) or failure (success=0).
 */
function rate_log_attempt(string $userType, string $identifier, bool $success): void {
    $st = db()->prepare(
        'INSERT INTO login_attempts (user_type, identifier, ip, success)
         VALUES (?, ?, ?, ?)'
    );
    $st->execute([$userType, $identifier, $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0', $success ? 1 : 0]);
}

/**
 * Return true if identifier is currently throttled.
 */
function rate_is_throttled(string $userType, string $identifier, int $max = 5, int $windowSeconds = 900): bool {
    return rate_failed_attempts($userType, $identifier, $windowSeconds) >= $max;
}