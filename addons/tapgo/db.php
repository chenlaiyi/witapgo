<?php
function connect_to_external_db() {
    $host = 'localhost'; // 替换为你的数据库主机
    $dbname = 'gaoji_neixun'; // 替换为你的数据库名称
    $username = 'gaoji_neixun'; // 替换为你的数据库用户名
    $password = 'ez7YLTYpzR56xeCk'; // 替换为你的数据库密码

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo '连接数据库失败: ' . $e->getMessage();
        return null;
    }
}