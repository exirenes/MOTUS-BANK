<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Administrator Login';
require MB_ROOT . '/includes/layout/public.php';
?>
<section class="card" style="max-width:420px;margin:1.5rem auto">
  <h1>Administrator Login</h1>
  <form method="post" action="/actions/admin/login.php" novalidate>
    <?= csrf_field() ?>
    <div class="form-group">
      <label>Username or email</label>
      <input class="form-control" name="identifier" required autofocus>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input class="form-control" type="password" name="password" required>
    </div>
    <button class="btn btn-primary btn-block" type="submit">Login</button>
  </form>
  <p style="margin-top:1rem;font-size:.85rem;color:var(--brand-muted)">
    Admin accounts are created via <code>bin/create-super-admin.php</code>.
  </p>
</section>
<?php require MB_ROOT . '/includes/layout/public-end.php'; ?>