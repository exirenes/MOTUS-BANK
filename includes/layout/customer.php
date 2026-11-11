<?php
declare(strict_types=1);
require_customer();
$brandName = brand('name');
$cust = current_customer();
$pageTitle = $pageTitle ?? 'Dashboard';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> — <?= e($brandName) ?></title>
<meta name="theme-color" content="<?= e(brand('manifest.theme_color')) ?>">
<link rel="icon" href="<?= e(brand('favicon')) ?>">
<link rel="manifest" href="/manifest.php">
<link rel="stylesheet" href="/public/css/app.css">
<style>:root{<?= brand_css_vars() ?>}</style>
</head>
<body class="page-customer">
<header class="app-header">
  <div class="container header-inner">
    <a class="brand" href="/pages/customer/dashboard.php">
      <img src="<?= e(brand('logo')) ?>" alt="<?= e($brandName) ?>" height="28">
    </a>
    <div class="header-actions">
      <span class="greeting">Hi, <?= e($cust['first_name']) ?></span>
      <a class="btn btn-ghost" href="/actions/logout.php">Logout</a>
    </div>
  </div>
</header>
<main class="container app-main">
<?php if ($m = flash_get('error')): ?><div class="alert alert-danger"><?= e($m) ?></div><?php endif; ?>
<?php if ($m = flash_get('success')): ?><div class="alert alert-success"><?= e($m) ?></div><?php endif; ?>