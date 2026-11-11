<?php
declare(strict_types=1);
require __DIR__ . '/../../config/bootstrap.php';
$pageTitle = 'Login';
require MB_ROOT . '/includes/layout/public.php';
?>
<div class="auth-wrap">
  <div class="auth-card">
    <div class="auth-header">
      <div class="auth-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
      </div>
      <h1>Welcome back</h1>
      <p>Log in to your <?= e(brand('name')) ?> account</p>
    </div>

    <form method="post" action="/actions/login.php" novalidate>
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="email">Email address</label>
        <input class="form-control" type="email" id="email" name="email" placeholder="you@example.com" required autofocus autocomplete="email">
      </div>

      <div class="form-group">
        <div class="flex-between" style="margin-bottom:.4rem">
          <label for="password" style="margin:0">Password</label>
          <a href="/pages/public/forgot-password.php" style="font-size:.82rem;font-weight:600">Forgot?</a>
        </div>
        <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
      </div>

      <button class="btn btn-primary btn-block btn-lg" type="submit">Log In</button>
    </form>

    <div class="auth-footer">
      Don't have an account? <a href="/pages/public/register.php">Open one</a>
    </div>
  </div>
</div>
<?php require MB_ROOT . '/includes/layout/public-end.php'; ?>