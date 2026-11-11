<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Dashboard';

$st = db()->prepare('SELECT * FROM accounts WHERE customer_id = ? LIMIT 1');
$st->execute([customer_id()]);
$acct = $st->fetch() ?: null;

require MB_ROOT . '/includes/layout/customer.php';
?>
<section class="card">
  <h2>Welcome, <?= e($cust['first_name']) ?> 👋</h2>
  <p style="margin:.25rem 0;color:var(--brand-muted)"><?= e($cust['email']) ?></p>
</section>

<section class="card">
  <div style="font-size:.85rem;color:var(--brand-muted);text-transform:uppercase;letter-spacing:.05em">Available Balance</div>
  <div style="font-size:2rem;font-weight:700;margin:.25rem 0">
    <?= e(money((int)($acct['available_minor'] ?? 0))) ?>
  </div>
  <div style="color:var(--brand-muted);font-size:.9rem">
    Account #: <strong><?= e($acct['account_number'] ?? '—') ?></strong>
    · <?= e(strtoupper($acct['currency'] ?? 'USD')) ?>
    · <?= e(ucfirst($acct['type'] ?? 'checking')) ?>
  </div>
</section>

<section class="card">
  <h3>Quick actions</h3>
  <p style="color:var(--brand-muted)">Deposit · Withdraw · Transfer — coming in Sections 4 &amp; 5.</p>
</section>
<?php require MB_ROOT . '/includes/layout/customer-end.php'; ?>