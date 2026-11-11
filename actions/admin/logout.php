<?php
declare(strict_types=1);
require dirname(dirname(__DIR__)) . '/config/bootstrap.php';
admin_logout();
flash_set('success', 'Administrator logged out.');
redirect('/pages/public/admin-login.php');