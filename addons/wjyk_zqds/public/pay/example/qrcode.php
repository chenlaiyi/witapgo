<?php
error_reporting(E_ERROR);
requwjyk_shop 'phpqrcode/phpqrcode.php';
$url = urldecode($_GET["data"]);
QRcode::png($url);
