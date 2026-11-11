<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Admin Dashboard';
require MB_ROOT . '/includes/layout/admin.php';

$customers = (int)db()->query('SELECT COUNT(*) FROM customers')->fetchColumn();
$accounts  = (int)db()->query('SELECT COUNT(*) FROM accounts')->fetchColumn();
$admins    = (int)db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
?>
<section class="card">
  <h2>Overview</h2>
  <div style="display:flex;gap:1rem;flex-wrap:wrap">
    <div class="card" style="flex:1;min-width:150px">
      <div style="color:var(--brand-muted);font-size:.85rem">Customers</div>
      <strong style="font-size:1.6rem"><?= $customers ?></strong>
    </div>
    <div class="card" style="flex:1;min-width:150px">
      <div style="color:var(--brand-muted);font-size:.85rem">Accounts</div>
      <strong style="font-size:1.6rem"><?= $accounts ?></strong>
    </div>
    <div class="card" style="flex:1;min-width:150px">
      <div style="color:var(--brand-muted);font-size:.85rem">Admins</div>
      <strong style="font-size:1.6rem"><?= $admins ?></strong>
    </div>
  </div>
</section>
<?php require MB_ROOT . '/includes/layout/admin-end.php'; ?>