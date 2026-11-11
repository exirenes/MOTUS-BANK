<?php
return [
    'name'          => 'MOTUS BANK',
    'short_name'    => 'MOTUS',
    'tagline'       => 'Banking, in motion.',
    'description'   => 'A modern, lightweight banking experience.',
    'domain'        => 'motusbank.ink',
    'support_email' => 'support@motusbank.ink',
    'support_phone' => '+1 (000) 000-0000',

    'colors' => [
        // ── Brand ───────────────────────────────────
        'primary'    => '#4169E1',
        'primary_dark'  => '#2E4FC9',
        'primary_light' => '#6B8AE8',
        'primary_tint'  => '#E5ECFF',   // chip / pill background

        // ── Surfaces ────────────────────────────────
        'secondary'  => '#FFFFFF',
        'surface'    => '#F8FAFC',
        'surface_alt'=> '#F1F5F9',
        'border'     => '#E2E8F0',

        // ── Text ────────────────────────────────────
        'text'       => '#0F172A',
        'text_soft'  => '#334155',
        'muted'      => '#64748B',
        'muted_light'=> '#94A3B8',

        // ── Status ─────────────────────────────────
        'success'    => '#10B981',
        'success_tint' => '#D1FAE5',
        'warning'    => '#F59E0B',
        'warning_tint' => '#FEF3C7',
        'danger'     => '#EF4444',
        'danger_tint'=> '#FEE2E2',
        'info'       => '#3B82F6',
        'info_tint'  => '#DBEAFE',

        // ── Accent (dark navy for headers) ──────────
        'accent'     => '#0B1F3A',
    ],

    'fonts' => [
        'family' => "'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
        'google' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
    ],

    'gradients' => [
        // Wallet card gradient
        'card'      => 'linear-gradient(135deg, #4169E1 0%, #6B8AE8 60%, #8BA5F0 100%)',
        // Hero / dashboard top gradient
        'hero'      => 'linear-gradient(180deg, #4169E1 0%, #2E4FC9 100%)',
        // Soft chip gradient
        'chip'      => 'linear-gradient(135deg, #E5ECFF 0%, #DDE5FF 100%)',
    ],

    'radii' => [
        'sm' => '8px',
        'md' => '12px',
        'lg' => '16px',
        'xl' => '20px',
        'pill' => '999px',
    ],

    'shadows' => [
        'sm'   => '0 1px 2px rgba(15,23,42,.06)',
        'card' => '0 2px 8px rgba(15,23,42,.06)',
        'nav'  => '0 -2px 8px rgba(15,23,42,.06)',
        'fab'  => '0 6px 16px rgba(65,105,225,.4)',
    ],

    'logo'     => '/public/images/logo.svg',
    'favicon'  => '/public/images/favicon.svg',
    'icon_192' => '/public/icons/icon-192.png',
    'icon_512' => '/public/icons/icon-512.png',

    'manifest' => [
        'theme_color'      => '#4169E1',
        'background_color' => '#F8FAFC',
        'display'          => 'standalone',
        'orientation'      => 'portrait',
        'start_url'        => '/',
    ],
];