<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Activity';
require MB_ROOT . '/includes/layout/customer.php';

$st = db()->prepare(
    'SELECT created_at, identifier, success
     FROM login_attempts
     WHERE user_type = "customer" AND identifier = ?
     ORDER BY created_at DESC LIMIT 20'
);
$st->execute([$cust['email']]);
$rows = $st->fetchAll();
?>
<section class="card">
  <h2>Account Activity</h2>
  <?php if (!$rows): ?>
    <p style="color:var(--brand-muted)">No activity yet.</p>
  <?php else: ?>
    <ul style="list-style:none;padding:0;margin:0">
      <?php foreach ($rows as $r): ?>
        <li style="padding:.6rem 0;border-bottom:1px solid var(--brand-border);display:flex;justify-content:space-between">
          <span><?= $r['success'] ? '✅ Successful login' : '⚠️ Failed login attempt' ?></span>
          <span style="color:var(--brand-muted);font-size:.85rem"><?= e($r['created_at']) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>
<?php require MB_ROOT . '/includes/layout/customer-end.php'; ?>