<?php
declare(strict_types=1);
$brandName = brand('name');
$pageTitle = $pageTitle ?? $brandName;
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
<body class="page-public">
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/index.php">
      <img src="<?= e(brand('logo')) ?>" alt="<?= e($brandName) ?>" height="32">
      <span><?= e($brandName) ?></span>
    </a>
    <nav class="site-nav">
      <a href="/index.php">Home</a>
      <a href="/pages/public/about.php">About</a>
      <a href="/pages/public/services.php">Services</a>
      <a href="/pages/public/contact.php">Contact</a>
    </nav>
    <div class="header-actions">
      <a class="btn btn-ghost" href="/pages/public/login.php">Login</a>
      <a class="btn btn-primary" href="/pages/public/register.php">Open Account</a>
    </div>
  </div>
</header>
<main class="container">
<?php if ($m = flash_get('error')): ?><div class="alert alert-danger"><?= e($m) ?></div><?php endif; ?>
<?php if ($m = flash_get('success')): ?><div class="alert alert-success"><?= e($m) ?></div><?php endif; ?>