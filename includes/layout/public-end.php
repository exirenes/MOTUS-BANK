</main>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <strong><?= e(brand('name')) ?></strong>
      <p><?= e(brand('tagline')) ?></p>
    </div>
    <nav class="footer-nav" aria-label="Footer">
      <a href="/pages/public/terms.php">Terms</a>
      <a href="/pages/public/privacy.php">Privacy</a>
      <a href="/pages/public/cookie.php">Cookies</a>
    </nav>
    <div class="footer-copy">
      &copy; <?= date('Y') ?> <?= e(brand('name')) ?>. All rights reserved.
    </div>
  </div>
</footer>

<script src="/public/js/app.js" defer></script>
</body>
</html>