<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Settings';
require MB_ROOT . '/includes/layout/customer.php';
?>
<section class="card">
  <h2>Account Settings</h2>
  <p style="color:var(--brand-muted)">Profile, password, and security settings will appear here in Section 3.</p>
</section>
<?php require MB_ROOT . '/includes/layout/customer-end.php'; ?>