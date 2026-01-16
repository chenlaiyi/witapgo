<?php
/**
 * 批量替换代码中的表前缀
 */

// 需要替换的目录
$dir = __DIR__ . '/../';

// 需要替换的文件扩展名
$extensions = array('php', 'html', 'js');

// 旧前缀和新前缀
$old_prefix = 'tapgo_tt';
$new_prefix = 'tapgo_tt';

/**
 * 递归遍历目录
 */
function replaceInDir($dir, $extensions, $old_prefix, $new_prefix) {
    $files = scandir($dir);
    
    foreach($files as $file) {
        if($file == '.' || $file == '..') continue;
        
        $path = $dir . '/' . $file;
        
        if(is_dir($path)) {
            replaceInDir($path, $extensions, $old_prefix, $new_prefix);
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if(in_array($ext, $extensions)) {
                replaceInFile($path, $old_prefix, $new_prefix);
            }
        }
    }
}

/**
 * 替换单个文件中的内容
 */
function replaceInFile($file, $old_prefix, $new_prefix) {
    $content = file_get_contents($file);
    
    // 替换表名前缀
    $content = str_replace($old_prefix, $new_prefix, $content);
    
    // 替换表名调用
    $content = str_replace("tablename('" . $old_prefix, "tablename('" . $new_prefix, $content);
    
    file_put_contents($file, $content);
    
    echo "Processed: " . $file . "\n";
}

// 开始替换
replaceInDir($dir, $extensions, $old_prefix, $new_prefix);

echo "Done!\n"; 