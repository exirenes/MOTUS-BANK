<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';

$pageTitle = 'Open an Account';
$old    = $_SESSION['_reg_old']    ?? [];
$errors = $_SESSION['_reg_errors'] ?? [];
unset($_SESSION['_reg_old'], $_SESSION['_reg_errors']);

require MB_ROOT . '/includes/layout/public.php';
?>
<div class="auth-wrap">
  <div class="auth-card auth-card-wide">
    <div class="auth-header">
      <div class="auth-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="8.5" cy="7" r="4"/>
          <line x1="20" y1="8" x2="20" y2="14"/>
          <line x1="23" y1="11" x2="17" y2="11"/>
        </svg>
      </div>
      <h1>Open an Account</h1>
      <p>Join <?= e(brand('name')) ?> in under a minute</p>
    </div>

    <?php if ($errors): ?>
      <div class="alert alert-danger">Please correct the highlighted fields below.</div>
    <?php endif; ?>

    <form method="post" action="/actions/register.php" novalidate>
      <?= csrf_field() ?>

      <!-- ── Personal info ─────────────────────────────── -->
      <h3 style="font-size:.95rem;font-weight:700;color:var(--brand-text-soft);margin:0 0 .85rem;text-transform:uppercase;letter-spacing:.05em">Personal information</h3>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:.85rem">
        <div class="form-group">
          <label for="first_name">First name *</label>
          <input class="form-control" id="first_name" name="first_name" value="<?= e($old['first_name'] ?? '') ?>" required autocomplete="given-name">
          <?php if (isset($errors['first_name'])): ?><div class="form-error"><?= e($errors['first_name']) ?></div><?php endif; ?>
        </div>
        <div class="form-group">
          <label for="last_name">Last name *</label>
          <input class="form-control" id="last_name" name="last_name" value="<?= e($old['last_name'] ?? '') ?>" required autocomplete="family-name">
          <?php if (isset($errors['last_name'])): ?><div class="form-error"><?= e($errors['last_name']) ?></div><?php endif; ?>
        </div>
      </div>

      <div class="form-group">
        <label for="middle_name">Middle name <span style="font-weight:400;color:var(--brand-muted)">(optional)</span></label>
        <input class="form-control" id="middle_name" name="middle_name" value="<?= e($old['middle_name'] ?? '') ?>" autocomplete="additional-name">
      </div>

      <div class="form-group">
        <label for="email">Email address *</label>
        <input class="form-control" type="email" id="email" name="email" value="<?= e($old['email'] ?? '') ?>" required autocomplete="email" placeholder="you@example.com">
        <?php if (isset($errors['email'])): ?><div class="form-error"><?= e($errors['email']) ?></div><?php endif; ?>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:.85rem">
        <div class="form-group">
          <label for="phone">Phone *</label>
          <input class="form-control" id="phone" name="phone" value="<?= e($old['phone'] ?? '') ?>" required autocomplete="tel">
          <?php if (isset($errors['phone'])): ?><div class="form-error"><?= e($errors['phone']) ?></div><?php endif; ?>
        </div>
        <div class="form-group">
          <label for="country">Country *</label>
          <input class="form-control" id="country" name="country" value="<?= e($old['country'] ?? '') ?>" required autocomplete="country-name">
          <?php if (isset($errors['country'])): ?><div class="form-error"><?= e($errors['country']) ?></div><?php endif; ?>
        </div>
      </div>

      <div class="form-group">
        <label for="address">Address <span style="font-weight:400;color:var(--brand-muted)">(optional)</span></label>
        <input class="form-control" id="address" name="address" value="<?= e($old['address'] ?? '') ?>" autocomplete="street-address">
      </div>

      <div class="form-group">
        <label for="dob">Date of birth <span style="font-weight:400;color:var(--brand-muted)">(optional)</span></label>
        <input class="form-control" type="date" id="dob" name="dob" value="<?= e($old['dob'] ?? '') ?>" autocomplete="bday">
      </div>

      <hr style="border:none;border-top:1px solid var(--brand-border);margin:1.5rem 0">

      <!-- ── Security ────────────────────────────────── -->
      <h3 style="font-size:.95rem;font-weight:700;color:var(--brand-text-soft);margin:0 0 .85rem;text-transform:uppercase;letter-spacing:.05em">Security</h3>

      <div class="form-group">
        <label for="password">Password *</label>
        <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password" placeholder="At least 8 characters">
        <div class="form-hint">Use at least 8 characters with a mix of letters and numbers.</div>
        <?php if (isset($errors['password'])): ?><div class="form-error"><?= e($errors['password']) ?></div><?php endif; ?>
      </div>

      <div class="form-group">
        <label for="password_confirm">Confirm password *</label>
        <input class="form-control" type="password" id="password_confirm" name="password_confirm" required autocomplete="new-password" placeholder="Re-enter your password">
        <?php if (isset($errors['password_confirm'])): ?><div class="form-error"><?= e($errors['password_confirm']) ?></div><?php endif; ?>
      </div>

      <div class="form-group" style="display:flex;gap:.6rem;align-items:flex-start">
        <input type="checkbox" id="terms" name="terms" style="margin-top:.25rem;width:18px;height:18px;accent-color:var(--brand-primary)">
        <label for="terms" style="font-weight:400;font-size:.88rem;color:var(--brand-text-soft);margin:0">
          I agree to the <a href="/pages/public/terms.php" target="_blank">Terms</a> and
          <a href="/pages/public/privacy.php" target="_blank">Privacy Policy</a>.
        </label>
      </div>
      <?php if (isset($errors['terms'])): ?><div class="form-error" style="margin-top:-.5rem;margin-bottom:.75rem"><?= e($errors['terms']) ?></div><?php endif; ?>

      <button class="btn btn-primary btn-block btn-lg" type="submit">Create Account</button>
    </form>

    <div class="auth-footer">
      Already have an account? <a href="/pages/public/login.php">Log in</a>
    </div>
  </div>
</div>
<?php require MB_ROOT . '/includes/layout/public-end.php'; ?>