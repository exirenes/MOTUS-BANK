<?php
declare(strict_types=1);
require __DIR__ . '/config/bootstrap.php';

$pageTitle = 'Welcome';
require MB_ROOT . '/includes/layout/public.php';
?>
<section class="card" style="margin-top:1.5rem">
  <h1><?= e(brand('name')) ?></h1>
  <p><?= e(brand('tagline')) ?></p>
  <p><?= e(brand('description')) ?></p>
  <div style="display:flex;gap:.5rem;margin-top:1rem">
    <a class="btn btn-primary" href="/pages/public/register.php">Open an Account</a>
    <a class="btn btn-ghost" href="/pages/public/login.php">Login</a>
  </div>
</section>
<?php require MB_ROOT . '/includes/layout/public-end.php';