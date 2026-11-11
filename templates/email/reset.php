<?php
/**
 * Password reset email template.
 * Expects: $resetUrl (string), $expiresMinutes (int), $brandName (string)
 */
$resetUrl       = $resetUrl       ?? '';
$expiresMinutes = $expiresMinutes ?? 60;
$brandName      = $brandName      ?? brand('name');
$primary        = brand('colors.primary') ?? '#0A4DA6';
?>
<!doctype html>
<html><body style="margin:0;padding:0;background:#F8FAFC;font-family:Arial,sans-serif;color:#0F172A">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#F8FAFC;padding:24px 0">
  <tr><td align="center">
    <table width="560" cellpadding="0" cellspacing="0" style="background:#fff;border:1px solid #E2E8F0;border-radius:12px;padding:32px">
      <tr><td>
        <h1 style="margin:0 0 12px;color:<?= htmlspecialchars($primary) ?>;font-size:22px"><?= htmlspecialchars($brandName) ?></h1>
        <p style="font-size:15px;line-height:1.5">We received a request to reset your password.</p>
        <p style="font-size:15px;line-height:1.5">Click the button below to choose a new password. This link will expire in <strong><?= (int)$expiresMinutes ?> minutes</strong>.</p>
        <p style="margin:24px 0">
          <a href="<?= htmlspecialchars($resetUrl) ?>"
             style="display:inline-block;background:<?= htmlspecialchars($primary) ?>;color:#fff;padding:12px 22px;border-radius:8px;text-decoration:none;font-weight:600">
            Reset Password
          </a>
        </p>
        <p style="font-size:13px;color:#64748B;line-height:1.5">
          If the button doesn't work, copy and paste this link into your browser:<br>
          <a href="<?= htmlspecialchars($resetUrl) ?>" style="color:<?= htmlspecialchars($primary) ?>;word-break:break-all"><?= htmlspecialchars($resetUrl) ?></a>
        </p>
        <hr style="border:none;border-top:1px solid #E2E8F0;margin:24px 0">
        <p style="font-size:12px;color:#94A3B8">If you did not request this, you can safely ignore this email.</p>
      </td></tr>
    </table>
  </td></tr>
</table>
</body></html>