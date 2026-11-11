<?php
declare(strict_types=1);
require_admin();
$brandName = brand('name');
$admin = current_admin();
$pageTitle = $pageTitle ?? 'Admin';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> — <?= e($brandName) ?> Admin</title>
<meta name="theme-color" content="<?= e(brand('manifest.theme_color')) ?>">
<link rel="icon" href="<?= e(brand('favicon')) ?>">
<link rel="stylesheet" href="/public/css/app.css">
<style>:root{<?= brand_css_vars() ?>}</style>
</head>
<body class="page-admin">
<header class="app-header">
  <div class="container header-inner">
    <a class="brand" href="/pages/admin/dashboard.php">
      <img src="<?= e(brand('logo')) ?>" alt="<?= e($brandName) ?>" height="28">
      <span>Admin</span>
    </a>
    <div class="header-actions">
      <span class="greeting"><?= e($admin['username']) ?></span>
      <a class="btn btn-ghost" href="/actions/admin/logout.php">Logout</a>
    </div>
  </div>
</header>
<div class="admin-shell container">
  <aside class="admin-sidebar">
    <nav>
      <a href="/pages/admin/dashboard.php">Dashboard</a>
      <a href="/pages/admin/customers.php">Customers</a>
      <a href="/pages/admin/transactions.php">Transactions</a>
      <a href="/pages/admin/settings.php">Settings</a>
    </nav>
  </aside>
  <main class="admin-main">
  <?php if ($m = flash_get('error')): ?><div class="alert alert-danger"><?= e($m) ?></div><?php endif; ?>
  <?php if ($m = flash_get('success')): ?><div class="alert alert-success"><?= e($m) ?></div><?php endif; ?>