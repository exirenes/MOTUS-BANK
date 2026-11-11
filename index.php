<?php
declare(strict_types=1);
require __DIR__ . '/config/bootstrap.php';

$pageTitle = 'Welcome';
require MB_ROOT . '/includes/layout/public.php';
?>

<!-- ══ HERO ══════════════════════════════════════════ -->
<section class="hero-bank">
  <div class="container hero-bank-inner">
    <div>
      <div class="hero-eyebrow">
        <span class="dot"></span>
        Trusted digital banking · <?= e(brand('name')) ?>
      </div>
      <h1>Banking that<br>moves with you.</h1>
      <p class="hero-sub">
        Open an account in minutes. Send money locally and internationally. Track every dollar — all in one secure, modern banking experience.
      </p>
      <div class="hero-actions">
        <a class="btn btn-lg" href="/pages/public/register.php" style="background:#fff;color:var(--brand-primary);font-weight:700">Open an Account</a>
        <a class="btn btn-lg" href="/pages/public/login.php" style="background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(8px)">Log In</a>
      </div>
      <div class="hero-meta">
        <div class="hero-meta-item"><strong>256-bit</strong> Encryption</div>
        <div class="hero-meta-item"><strong>USD</strong> Account currency</div>
        <div class="hero-meta-item"><strong>24/7</strong> Access anywhere</div>
      </div>
    </div>

    <div class="card-mockup">
      <div class="credit-card">
        <div class="cc-top">
          <div class="cc-brand"><?= e(brand('name')) ?></div>
          <div class="cc-chip"></div>
        </div>
        <div class="cc-number">•••• •••• •••• 4302</div>
        <div class="cc-bottom">
          <div>
            <div class="cc-label">Card Holder</div>
            <div class="cc-value">A. MEMBER</div>
          </div>
          <div>
            <div class="cc-label">Expires</div>
            <div class="cc-value">12 / 28</div>
          </div>
          <div class="cc-logo"><span></span><span></span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ TRUST STRIP ══════════════════════════════════ -->
<div class="trust-strip">
  <div class="container trust-strip-inner">
    <div class="trust-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Bank-grade security
    </div>
    <div class="trust-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      No hidden fees
    </div>
    <div class="trust-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      Instant transfers
    </div>
    <div class="trust-item">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.5 0 4.8 1 6.5 2.7L21 8"/><polyline points="21 3 21 8 16 8"/></svg>
      Multi-language
    </div>
  </div>
</div>

<!-- ══ STATS ════════════════════════════════════════ -->
<section class="stats-band">
  <div class="container stats-grid">
    <div class="stat-item"><strong>$0</strong><span>Monthly maintenance fees</span></div>
    <div class="stat-item"><strong>99.9%</strong><span>Uptime commitment</span></div>
    <div class="stat-item"><strong>150+</strong><span>Supported countries</span></div>
    <div class="stat-item"><strong>24/7</strong><span>Customer support</span></div>
  </div>
</section>

<!-- ══ SERVICES ═════════════════════════════════════ -->
<section class="bank-section">
  <div class="container">
    <div class="center" style="text-align:center;margin-bottom:2.5rem">
      <h2>Everything you need to bank smarter</h2>
      <p class="section-sub">Simple, secure tools designed for everyday banking and international transfers.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.25rem">
      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h3>Bank Accounts</h3>
        <p>Open a USD checking account in minutes, with a unique account number ready to receive funds.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <h3>Deposits & Withdrawals</h3>
        <p>Fund your account, withdraw when you need to — with clear fees, limits and status updates at every step.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </div>
        <h3>Domestic Transfers</h3>
        <p>Send money to banks in your country with a full bank directory and simplified recipient details.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <h3>International Transfers</h3>
        <p>Send to 150+ countries using IBAN, SWIFT/BIC, sort codes and more — with configurable requirements per destination.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"/></svg>
        </div>
        <h3>Saved Beneficiaries</h3>
        <p>Save your frequent recipients once — then send money in seconds without re-entering banking details.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6v6H9z"/></svg>
        </div>
        <h3>Transaction History</h3>
        <p>Every deposit, transfer and adjustment is recorded. Filter by type, status or reference — always traceable.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ SECURITY BAND ════════════════════════════════ -->
<section class="security-band">
  <div class="container security-grid">
    <div>
      <h2>Your money. Our responsibility.</h2>
      <p class="lead">We build security into every layer — so you can bank with confidence, every day.</p>
      <ul class="security-list">
        <li>Passwords hashed with modern algorithms — never stored as plain text</li>
        <li>Separate transaction PIN protects every debit and transfer</li>
        <li>Login rate-limiting and automatic session expiry</li>
        <li>Server-side validation on every operation</li>
        <li>Full audit trail on every financial action</li>
      </ul>
    </div>

    <div class="security-visual">
      <div class="sv-row">
        <span class="sv-label">Session security</span>
        <span class="sv-value"><span class="sv-dot"></span> Active</span>
      </div>
      <div class="sv-row">
        <span class="sv-label">Transaction PIN</span>
        <span class="sv-value"><span class="sv-dot"></span> Hashed</span>
      </div>
      <div class="sv-row">
        <span class="sv-label">Data encryption</span>
        <span class="sv-value"><span class="sv-dot"></span> TLS 1.3</span>
      </div>
      <div class="sv-row">
        <span class="sv-label">CSRF protection</span>
        <span class="sv-value"><span class="sv-dot"></span> Enabled</span>
      </div>
      <div class="sv-row">
        <span class="sv-label">Audit logging</span>
        <span class="sv-value"><span class="sv-dot"></span> Active</span>
      </div>
    </div>
  </div>
</section>

<!-- ══ CTA ═══════════════════════════════════════════ -->
<section class="cta-band">
  <div class="container">
    <h2>Ready to open your account?</h2>
    <p>Join <?= e(brand('name')) ?> today. Free to open, no monthly fees, and takes less than a minute.</p>
    <a class="btn btn-lg" href="/pages/public/register.php" style="background:#fff;color:var(--brand-primary);font-weight:700">Get Started</a>
  </div>
</section>

<?php require MB_ROOT . '/includes/layout/public-end.php'; ?>