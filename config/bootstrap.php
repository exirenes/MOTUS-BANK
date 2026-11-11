<?php
declare(strict_types=1);
define('MB_ROOT', dirname(__DIR__));

function mb_load_env(string $path): void {
    if (!is_file($path)) return;
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        [$k, $v] = array_pad(explode('=', $line, 2), 2, '');
        $k = trim($k); $v = trim($v, " \t\"'");
        if ($k !== '' && getenv($k) === false) {
            putenv("$k=$v");
            $_ENV[$k] = $v;
        }
    }
}
mb_load_env(MB_ROOT . '/.env');

date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'UTC');
define('MB_ENV',   getenv('APP_ENV')  ?: 'production');
define('MB_DEBUG', filter_var(getenv('APP_DEBUG') ?: 'false', FILTER_VALIDATE_BOOL));
define('MB_URL',   rtrim(getenv('APP_URL') ?: '', '/'));

ini_set('display_errors', MB_DEBUG ? '1' : '0');
ini_set('log_errors', '1');
if (!is_dir(MB_ROOT . '/logs')) @mkdir(MB_ROOT . '/logs', 0775, true);
ini_set('error_log', MB_ROOT . '/logs/app.log');
error_reporting(E_ALL);

$brandName = getenv('BRAND') ?: 'motus';
$brandFile = MB_ROOT . "/config/brands/{$brandName}.php";
if (!is_file($brandFile)) {
    http_response_code(500);
    exit('Brand config missing: config/brands/' . htmlspecialchars($brandName) . '.php');
}
$GLOBALS['BRAND'] = require $brandFile;

if (session_status() !== PHP_SESSION_ACTIVE) {
    $secure = filter_var(getenv('SESSION_SECURE') ?: 'false', FILTER_VALIDATE_BOOL);
    session_name(getenv('SESSION_NAME') ?: 'MB_SESS');
    session_set_cookie_params([
        'lifetime' => 0, 'path' => '/', 'domain' => '',
        'secure' => $secure, 'httponly' => true,
        'samesite' => getenv('SESSION_SAMESITE') ?: 'Lax',
    ]);
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_start();
}

require MB_ROOT . '/includes/helpers.php';
require MB_ROOT . '/includes/csrf.php';
require MB_ROOT . '/includes/db.php';
require MB_ROOT . '/includes/auth.php';
require MB_ROOT . '/includes/brand.php';