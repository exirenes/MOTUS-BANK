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


/**
 * Extended CSS variables — matches the DigiBank-style reference.
 */
function brand_css_vars_v2(): string {
    $c = brand('colors', []);
    $f = brand('fonts', []);
    $g = brand('gradients', []);
    $r = brand('radii', []);
    $s = brand('shadows', []);

    $map = [
        '--brand-primary'        => $c['primary']        ?? '#4169E1',
        '--brand-primary-dark'   => $c['primary_dark']   ?? '#2E4FC9',
        '--brand-primary-light'  => $c['primary_light']  ?? '#6B8AE8',
        '--brand-primary-tint'   => $c['primary_tint']   ?? '#E5ECFF',
        '--brand-secondary'      => $c['secondary']      ?? '#FFFFFF',
        '--brand-surface'        => $c['surface']        ?? '#F8FAFC',
        '--brand-surface-alt'    => $c['surface_alt']    ?? '#F1F5F9',
        '--brand-border'         => $c['border']         ?? '#E2E8F0',
        '--brand-text'           => $c['text']           ?? '#0F172A',
        '--brand-text-soft'      => $c['text_soft']      ?? '#334155',
        '--brand-muted'          => $c['muted']          ?? '#64748B',
        '--brand-muted-light'    => $c['muted_light']    ?? '#94A3B8',
        '--brand-success'        => $c['success']        ?? '#10B981',
        '--brand-success-tint'   => $c['success_tint']   ?? '#D1FAE5',
        '--brand-warning'        => $c['warning']        ?? '#F59E0B',
        '--brand-warning-tint'   => $c['warning_tint']   ?? '#FEF3C7',
        '--brand-danger'         => $c['danger']         ?? '#EF4444',
        '--brand-danger-tint'    => $c['danger_tint']    ?? '#FEE2E2',
        '--brand-info'           => $c['info']           ?? '#3B82F6',
        '--brand-info-tint'      => $c['info_tint']      ?? '#DBEAFE',
        '--brand-accent'         => $c['accent']         ?? '#0B1F3A',
        '--brand-font'           => $f['family']         ?? 'Poppins, sans-serif',
        '--grad-card'            => $g['card']           ?? 'linear-gradient(135deg,#4169E1,#8BA5F0)',
        '--grad-hero'            => $g['hero']           ?? 'linear-gradient(180deg,#4169E1,#2E4FC9)',
        '--grad-chip'            => $g['chip']           ?? 'linear-gradient(135deg,#E5ECFF,#DDE5FF)',
        '--radius-sm'            => $r['sm']             ?? '8px',
        '--radius-md'            => $r['md']             ?? '12px',
        '--radius-lg'            => $r['lg']             ?? '16px',
        '--radius-xl'            => $r['xl']             ?? '20px',
        '--radius-pill'          => $r['pill']           ?? '999px',
        '--shadow-sm'            => $s['sm']             ?? '0 1px 2px rgba(15,23,42,.06)',
        '--shadow-card'          => $s['card']           ?? '0 2px 8px rgba(15,23,42,.06)',
        '--shadow-nav'           => $s['nav']            ?? '0 -2px 8px rgba(15,23,42,.06)',
        '--shadow-fab'           => $s['fab']            ?? '0 6px 16px rgba(65,105,225,.4)',
    ];
    $out = '';
    foreach ($map as $k => $v) $out .= "$k:$v;";
    return $out;
}