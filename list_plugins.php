<?php
$addons_dir = __DIR__ . '/addons';
$plugins = array_filter(glob($addons_dir . '/*'), 'is_dir');

echo "插件列表:\n";
foreach ($plugins as $plugin) {
    echo basename($plugin) . "\n";
}