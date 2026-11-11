<?php
declare(strict_types=1);
/**
 * Usage:
 *   php bin/create-super-admin.php <username> <email>
 * Prompts for password interactively.
 */
require dirname(__DIR__) . '/config/bootstrap.php';

if (PHP_SAPI !== 'cli') { fwrite(STDERR, "CLI only.\n"); exit(1); }

$username = $argv[1] ?? null;
$email    = $argv[2] ?? null;
if (!$username || !$email || !valid_email($email)) {
    fwrite(STDERR, "Usage: php bin/create-super-admin.php <username> <email>\n");
    exit(1);
}

// Prompt for password (hidden)
echo "Password (min 8 chars): ";
$pass = '';
if (DIRECTORY_SEPARATOR === '\\') {
    $pass = trim((string)fgets(STDIN));
} else {
    system('stty -echo');
    $pass = trim((string)fgets(STDIN));
    system('stty echo');
    echo PHP_EOL;
}
if (strlen($pass) < 8) { fwrite(STDERR, "Password must be >= 8 chars.\n"); exit(1); }

$existing = db()->prepare('SELECT id FROM admins WHERE username = ? OR email = ? LIMIT 1');
$existing->execute([$username, $email]);
if ($existing->fetch()) { fwrite(STDERR, "Admin already exists.\n"); exit(1); }

$hash = password_hash($pass, PASSWORD_DEFAULT);
$st = db()->prepare(
    'INSERT INTO admins (username, email, password_hash, role, status, must_change_pw)
     VALUES (?, ?, ?, "super", "active", 0)'
);
$st->execute([$username, $email, $hash]);

echo "✔ Super admin created: {$username} ({$email})\n";