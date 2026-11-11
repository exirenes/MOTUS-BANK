<?php
declare(strict_types=1);
require __DIR__ . '/config/bootstrap.php';
header('Content-Type: application/manifest+json; charset=utf-8');
echo json_encode([
    'name'             => brand('name'),
    'short_name'       => brand('short_name'),
    'description'      => brand('description'),
    'start_url'        => brand('manifest.start_url'),
    'display'          => brand('manifest.display'),
    'orientation'      => brand('manifest.orientation'),
    'theme_color'      => brand('manifest.theme_color'),
    'background_color' => brand('manifest.background_color'),
    'icons' => [
        ['src' => brand('icon_192'), 'sizes' => '192x192', 'type' => 'image/png'],
        ['src' => brand('icon_512'), 'sizes' => '512x512', 'type' => 'image/png'],
    ],
]);