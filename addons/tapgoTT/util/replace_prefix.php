<?php
/**
 * 批量替换代码中的表前缀和类名
 */

// 需要替换的目录
$dir = dirname(dirname(__FILE__)); // 指向 addons/tapgoTT 目录

// 需要替换的文件扩展名
$extensions = array('php', 'html', 'js');

// 替换规则
$replacements = array(
    // 表前缀替换
    'tapgo_tt' => 'tapgo_tt',
    'TAPGO_TT' => 'TAPGO_TT',
    // 类名替换
    'TapgoTt' => 'TapgoTt',
    'Tapgo_tt' => 'Tapgo_tt',
    'tapgo_ttv2' => 'tapgo_tt',
    // 路径替换  
    'addons/tapgo_ttv2' => 'addons/tapgoTT',
    // 其他常量替换
    'TAPGO_TT_DEBUG' => 'TAPGO_TT_DEBUG',
    'TAPGO_TT_PATH' => 'TAPGO_TT_PATH',
    'TAPGO_TT_CORE' => 'TAPGO_TT_CORE',
    'TAPGO_TT_DATA' => 'TAPGO_TT_DATA',
    'TAPGO_TT_VENDOR' => 'TAPGO_TT_VENDOR',
    'TAPGO_TT_CORE_WEB' => 'TAPGO_TT_CORE_WEB',
    'TAPGO_TT_CORE_MOBILE' => 'TAPGO_TT_CORE_MOBILE',
    'TAPGO_TT_CORE_SYSTEM' => 'TAPGO_TT_CORE_SYSTEM',
    'TAPGO_TT_PLUGIN' => 'TAPGO_TT_PLUGIN',
    'TAPGO_TT_PROCESSOR' => 'TAPGO_TT_PROCESSOR',
    'TAPGO_TT_INC' => 'TAPGO_TT_INC',
    'TAPGO_TT_URL' => 'TAPGO_TT_URL',
    'TAPGO_TT_LOCAL' => 'TAPGO_TT_LOCAL',
    'TAPGO_TT_STATIC' => 'TAPGO_TT_STATIC',
    'TAPGO_TT_PREFIX' => 'TAPGO_TT_PREFIX',
    'TAPGO_TT_AUTH_WXAPP' => 'TAPGO_TT_AUTH_WXAPP'
);

/**
 * 递归遍历目录
 */
function replaceInDir($dir, $extensions, $replacements) {
    $files = scandir($dir);
    
    foreach($files as $file) {
        if($file == '.' || $file == '..') continue;
        
        $path = $dir . '/' . $file;
        
        if(is_dir($path)) {
            replaceInDir($path, $extensions, $replacements);
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if(in_array($ext, $extensions)) {
                replaceInFile($path, $replacements);
            }
        }
    }
}

/**
 * 替换单个文件中的内容
 */
function replaceInFile($file, $replacements) {
    $content = file_get_contents($file);
    
    // 替换所有规则
    foreach($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    file_put_contents($file, $content);
    
    echo "Processed: " . $file . "\n";
}

// 开始替换
replaceInDir($dir, $extensions, $replacements);

echo "Done!\n"; 