<?php
$plugin_dir = __DIR__ . '/addons/xc_beauty';

// 检查文件修改时间
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($plugin_dir));
$last_modified = 0;
foreach ($files as $file) {
    if ($file->isFile()) {
        $last_modified = max($last_modified, $file->getMTime());
    }
}
echo "最后修改时间: " . date('Y-m-d H:i:s', $last_modified) . "\n";

// 检查版本信息和更新日志
$version_file = $plugin_dir . '/version.php';
$changelog_file = $plugin_dir . '/changelog.txt';
if (file_exists($version_file)) {
    echo "版本信息:\n";
    include $version_file;
}
if (file_exists($changelog_file)) {
    echo "更新日志:\n";
    echo file_get_contents($changelog_file);
}

// 检查错误日志
$log_dir = $plugin_dir . '/logs';
if (is_dir($log_dir)) {
    echo "错误日志:\n";
    $log_files = glob($log_dir . '/*.log');
    foreach ($log_files as $log_file) {
        echo basename($log_file) . "\n";
    }
}