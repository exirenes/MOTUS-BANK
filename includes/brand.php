<?php
declare(strict_types=1);

function brand(string $key = '', mixed $default = null): mixed {
    $b = $GLOBALS['BRAND'] ?? [];
    if ($key === '') return $b;
    $cur = $b;
    foreach (explode('.', $key) as $p) {
        if (!is_array($cur) || !array_key_exists($p, $cur)) return $default;
        $cur = $cur[$p];
    }
    return $cur;
}
function brand_css_vars(): string {
    $c = brand('colors', []);
    $map = [
        '--brand-primary'   => $c['primary']   ?? '#0A4DA6',
        '--brand-secondary' => $c['secondary'] ?? '#FFFFFF',
        '--brand-accent'    => $c['accent']    ?? '#0B1F3A',
        '--brand-success'   => $c['success']   ?? '#1E8E5A',
        '--brand-warning'   => $c['warning']   ?? '#C78600',
        '--brand-danger'    => $c['danger']    ?? '#C0392B',
        '--brand-text'      => $c['text']      ?? '#0F172A',
        '--brand-muted'     => $c['muted']     ?? '#64748B',
        '--brand-border'    => $c['border']    ?? '#E2E8F0',
        '--brand-surface'   => $c['surface']   ?? '#F8FAFC',
    ];
    $out = '';
    foreach ($map as $k => $v) $out .= "$k:$v;";
    return $out;
}