<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = ucfirst('contact');
require MB_ROOT . '/includes/layout/public.php';
?>
<section class="card" style="margin-top:1.5rem">
  <h1><?= e($pageTitle) ?></h1>
  <p>This page will be built in Section 2.</p>
</section>
<?php require MB_ROOT . '/includes/layout/public-end.php'; ?>
