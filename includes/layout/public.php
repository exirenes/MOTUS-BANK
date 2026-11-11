<?php
declare(strict_types=1);
$brandName = brand('name');
$pageTitle = $pageTitle ?? $brandName;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($pageTitle) ?> — <?= e($brandName) ?></title>
<meta name="theme-color" content="<?= e(brand('manifest.theme_color')) ?>">
<meta name="description" content="<?= e(brand('description')) ?>">
<link rel="icon" href="<?= e(brand('favicon')) ?>">
<link rel="manifest" href="/manifest.php">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= e(brand('fonts.google')) ?>">
<link rel="stylesheet" href="/public/css/app.css">
<style>:root{<?= brand_css_vars_v2() ?>}</style>
</head>
<body class="page-public">

<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/index.php">
      <span class="brand-mark" aria-hidden="true">
        <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="40" height="40" rx="10" fill="var(--brand-primary)"/>
          <path d="M10 27V13l10 8 10-8v14" stroke="#fff" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"/>
        </svg>
      </span>
      <span class="brand-name"><?= e($brandName) ?></span>
    </a>

    <nav class="site-nav" aria-label="Main">
      <a href="/index.php">Home</a>
      <a href="/pages/public/about.php">About</a>
      <a href="/pages/public/services.php">Services</a>
      <a href="/pages/public/contact.php">Contact</a>
    </nav>

    <div class="header-actions">
      <a class="btn btn-ghost btn-sm" href="/pages/public/login.php">Login</a>
      <a class="btn btn-primary btn-sm" href="/pages/public/register.php">Open Account</a>
    </div>
  </div>
</header>

<main class="container page-main">
<?php if ($m = flash_get('error')): ?>
  <div class="alert alert-danger" role="alert"><?= e($m) ?></div>
<?php endif; ?>
<?php if ($m = flash_get('success')): ?>
  <div class="alert alert-success" role="alert"><?= e($m) ?></div>
<?php endif; ?>