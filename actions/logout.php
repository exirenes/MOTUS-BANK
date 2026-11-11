<?php
declare(strict_types=1);
require dirname(__DIR__) . '/config/bootstrap.php';
customer_logout();
flash_set('success', 'You have been logged out.');
redirect('/pages/public/login.php');