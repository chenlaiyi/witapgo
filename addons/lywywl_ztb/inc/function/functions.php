<?php
defined("IN_IA") or exit("Access Denied");
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
spl_autoload_register(function ($classname) {
    goto wyOt6;
    IrZZe:
    gziR1:
    goto sUq35;
    sUq35:
    OUCeA:
    goto zuQvA;
    d1NVZ:
    $path = str_replace("\\", DIRECTORY_SEPARATOR, substr($classname, strlen("Flc\\Dysms\\")));
    goto dagVL;
    geJ6C:
    if (!(strpos($classname, "Flc\\Dysms\\") === 0)) {
        goto OUCeA;
    }
    goto d1NVZ;
    wyOt6:
    $baseDir = MODULE_ROOT . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "dysms" . DIRECTORY_SEPARATOR;
    goto geJ6C;
    qFSjf:
    require_once $file;
    goto IrZZe;
    WV3E9:
    if (!is_file($file)) {
        goto gziR1;
    }
    goto qFSjf;
    dagVL:
    $file = $baseDir . $path . ".php";
    goto WV3E9;
    zuQvA:
});
function getNicknameByOpenid($openid)
{
    load()->model("mc");
    $member = mc_fetch($openid, array("nickname"));
    return trim($member["nickname"]) != '' ? $member["nickname"] : $openid;
}
function resultMsg($arr)
{
    header("Content-Type: application/json; charset=utf-8");
    exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
}
function ztkLog($log, $type = "normal", $filename = "lywywl_ztb")
{
    load()->func("logging");
    logging_run($log, $type, $filename);
}
function getDataById($table, $id, $field = NULL, $default = array())
{
    global $_W;
    if (empty($table) || empty($id)) {
        return $default;
    }
    $id = intval($id);
    $uniacid = $_W["uniacid"];
    $sql = "SELECT * FROM " . tablename($table) . " WHERE id = :id AND uniacid = :uniacid and `deltime`=0";
    $params = array(":id" => $id, ":uniacid" => $uniacid);
    $item = pdo_fetch($sql, $params);
    return empty($field) ? $item : (empty($item[$field]) ? $default : $item[$field]);
}
function getDataByIdNoUniacid($table, $id, $field = NULL, $default = array())
{
    global $_W;
    if (empty($table) || empty($id)) {
        return $default;
    }
    $id = intval($id);
    $sql = "SELECT * FROM " . tablename($table) . " WHERE id = :id ";
    $params = array(":id" => $id);
    $item = pdo_fetch($sql, $params);
    return empty($field) ? $item : (empty($item[$field]) ? $default : $item[$field]);
}
function getDataSumByIdNoUniacid($table, $column, $where)
{
    global $_W;
    if (empty($table) || empty($column)) {
        return 0.0;
    }
    $uniacid = $_W["uniacid"];
    $sql = "SELECT sum(" . $column . ") FROM " . tablename($table) . " WHERE  uniacid = :uniacid {$where} ";
    $params = array(":uniacid" => $uniacid);
    $item = pdo_fetchcolumn($sql, $params);
    return $item;
}
function getAllData($table, $where = '', $order = "id DESC", $field = "*")
{
    global $_W;
    if (empty($table)) {
        return array();
    }
    $uniacid = $_W["uniacid"];
    $sql = "SELECT {$field} FROM " . tablename($table) . " WHERE uniacid = :uniacid {$where} ORDER BY {$order}";
    $params = array(":uniacid" => $uniacid);
    $item = pdo_fetchall($sql, $params);
    return $item;
}
function sqr($n)
{
    return $n * $n;
}
function xRandom($bonus_min, $bonus_max)
{
    $rand_num = rand($bonus_max, $bonus_min);
    return intval($rand_num);
}
function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = $label === null ? '' : rtrim($label) . " ";
    if (!$strict) {
        if (ini_get("html_errors")) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded("xdebug")) {
            $output = preg_replace("/\\]\\=\\>\\n(\\s+)/m", "] => ", $output);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        }
    }
    if ($echo) {
        echo $output;
        return null;
    } else {
        return $output;
    }
}
function redirect($url, $time = 0, $msg = '')
{
    $url = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg)) {
        $msg = "系统将在{$time}秒之后自动跳转到{$url}！";
    }
    if (!headers_sent()) {
        if (0 === $time) {
            header("Location: " . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo $msg;
        }
        exit;
    } else {
        $str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0) {
            $str .= $msg;
        }
        exit($str);
    }
}
function genToken()
{
    return md5(rand() . md5(md5(time()) . uniqid()));
}
function __WURL($do, $query = array(), $noredirect = true, $addhost = false)
{
    $query["do"] = $do;
    $query["m"] = "lywywl_ztb";
    return wurl("site/entry", $query, $noredirect, $addhost);
}
function __MURL($do, $query = array(), $noredirect = true, $addhost = false)
{
    $query["do"] = $do;
    $query["m"] = "lywywl_ztb";
    return murl("entry", $query, $noredirect, $addhost);
}
function __PURL($do, $query = array(), $noredirect = true, $addhost = false)
{
    $query["do"] = $do;
    $query["m"] = "lywywl_ztb";
    return murl("entry/webapp", $query, $noredirect, $addhost);
}
$_include_qrcode = false;
function includeQrCode()
{
    global $_include_qrcode;
    if ($_include_qrcode) {
        return true;
    }
    $file = IA_ROOT . "/framework/library/qrcode/phpqrcode.php";
    if (file_exists($file)) {
        include $file;
        $_include_qrcode = true;
        return true;
    } else {
        trigger_error("Invalid Class /framework/library/qrcode/phpqrcode.php", E_USER_ERROR);
        return false;
    }
}
function qrcode($isroot, $str, $outfile = false, $level = "L", $size = 5, $margin = 4, $saveandprint = false)
{
    if (includeQrCode()) {
        $qr = QRcode::png($str, $outfile, $level, $size, $margin, $saveandprint);
        return true;
    } else {
        return false;
    }
}
function poster($isroot, $str, $outfile = false, $level = "L", $size = 5, $margin = 4, $saveandprint = false, $bg_pic, $data, $userinfo)
{
    if (includeQrCode() && $data && is_array($data)) {
        if ($isroot == 1) {
            if (strpos($bg_pic, "resource") !== false) {
                $picurlarr = explode("%", str_replace("resource", "%", $bg_pic));
                $bgpath = MODULE_ROOT . "/resource/" . $picurlarr[1];
            } else {
                $bgpath = ATTACHMENT_ROOT . "/" . $bg_pic;
            }
            list($bg_w, $bg_h) = getimagesize($bgpath);
            if ($bg_w > 640) {
                $bg_h = ceil($bg_w / 640 * $bg_h);
                scalePic($bgpath, 640, $bg_h);
            } else {
                if ($bg_w < 640) {
                    $bg_h = ceil(640 / $bg_w * $bg_h);
                    scalePic($bgpath, 640, $bg_h);
                }
            }
            $BG = imagecreatefromstring(file_get_contents($bgpath));
        } else {
            if (strpos($bg_pic, "resource") !== false) {
                $picurlarr = explode("%", str_replace("resource", "%", $bg_pic));
                $bgpath = MODULE_ROOT . "/resource/" . $picurlarr[1];
            } else {
                $bgpath = ATTACHMENT_ROOT . $bg_pic;
                if (!file_exists($bgpath)) {
                    download(tomedia($bg_pic), $bgpath);
                }
            }
            list($bg_w, $bg_h) = getimagesize($bgpath);
            if ($bg_w > 640) {
                $bg_h = ceil($bg_w / 640 * $bg_h);
                scalePic($bgpath, 640, $bg_h);
            } else {
                if ($bg_w < 640) {
                    $bg_h = ceil(640 / $bg_w * $bg_h);
                    scalePic($bgpath, 640, $bg_h);
                }
            }
            $BG = imagecreatefromstring(file_get_contents($bgpath));
        }
        foreach ($data as $value) {
            if ($value["type"] == "qr") {
                $qr = QRcode::png($str, $outfile, $level, $size, $margin, $saveandprint);
                list($QR_w, $QR_h) = getimagesize($outfile);
                $QR = imagecreatefromstring(file_get_contents($outfile));
                imagecopyresampled($BG, $QR, str_replace("px", '', $value["left"]) * 2, str_replace("px", '', $value["top"]) * 2, 0, 0, str_replace("px", '', $value["width"]) * 2, str_replace("px", '', $value["height"]) * 2, $QR_w, $QR_h);
            } else {
                if ($value["type"] == "nickname") {
                    $colorArr = hex2rgb($value["color"]);
                    $textcolor = imagecolorallocate($BG, $colorArr["r"], $colorArr["g"], $colorArr["b"]);
                    $strnickname = $userinfo ? $userinfo["nickname"] : "微信昵称";
                    $strnickname = mb_convert_encoding($strnickname, "html-entities", "utf-8");
                    ImageTTFText($BG, str_replace("px", '', $value["size"]), 0, str_replace("px", '', $value["left"] + 15) * 2, str_replace("px", '', $value["top"] + 15) * 2, $textcolor, MODULE_ROOT . "/resource/font/simhei.ttf", $strnickname);
                } else {
                    if ($value["type"] == "head") {
                        if ($userinfo) {
                            $headpath = MODULE_ROOT . "/resource/data/head/" . $userinfo["openid"] . ".jpg";
                            mkdirs(dirname($headpath));
                            download(tomedia($userinfo["headimgurl"]), $headpath);
                        } else {
                            $headpath = MODULE_ROOT . "/resource/plugin/poster/head.png";
                        }
                        list($QR_w, $QR_h) = getimagesize($headpath);
                        $Head = imagecreatefromstring(file_get_contents($headpath));
                        imagecopyresampled($BG, $Head, str_replace("px", '', $value["left"]) * 2, str_replace("px", '', $value["top"]) * 2, 0, 0, str_replace("px", '', $value["width"]) * 2, str_replace("px", '', $value["height"]) * 2, $QR_w, $QR_h);
                        if ($userinfo) {
                            unlink($headpath);
                        }
                    } else {
                        if ($value["type"] == "name") {
                            $colorArr = hex2rgb($value["color"]);
                            $textcolor = imagecolorallocate($BG, $colorArr["r"], $colorArr["g"], $colorArr["b"]);
                            $strnickname = $userinfo ? $userinfo["name"] : "选手名称";
                            $strnickname = mb_convert_encoding($strnickname, "html-entities", "utf-8");
                            ImageTTFText($BG, str_replace("px", '', $value["size"]), 0, str_replace("px", '', $value["left"] + 15) * 2, str_replace("px", '', $value["top"] + 15) * 2, $textcolor, MODULE_ROOT . "/resource/font/simhei.ttf", $strnickname);
                        } else {
                            if ($value["type"] == "number") {
                                $colorArr = hex2rgb($value["color"]);
                                $textcolor = imagecolorallocate($BG, $colorArr["r"], $colorArr["g"], $colorArr["b"]);
                                $strnickname = $userinfo ? $userinfo["number"] . "号" : "选手编号";
                                $strnickname = mb_convert_encoding($strnickname, "html-entities", "utf-8");
                                ImageTTFText($BG, str_replace("px", '', $value["size"]), 0, str_replace("px", '', $value["left"] + 15) * 2, str_replace("px", '', $value["top"] + 15) * 2, $textcolor, MODULE_ROOT . "/resource/font/simhei.ttf", $strnickname);
                            } else {
                                if ($value["type"] == "pic") {
                                    if ($isroot == 1) {
                                        $picpath = ATTACHMENT_ROOT . "/" . $userinfo["pic_url"];
                                    } else {
                                        if ($userinfo) {
                                            $picArr = explode("/", $userinfo["pic_url"]);
                                            $picSuffix = array_pop($picArr);
                                            $picpath = MODULE_ROOT . "/resource/data/player/" . $picSuffix;
                                            mkdirs(dirname($picpath));
                                            download(tomedia($userinfo["pic_url"]), $picpath);
                                        } else {
                                            $picpath = MODULE_ROOT . "/resource/plugin/poster/pic.jpg";
                                        }
                                    }
                                    list($QR_w, $QR_h) = getimagesize($picpath);
                                    $Head = imagecreatefromstring(file_get_contents($picpath));
                                    imagecopyresampled($BG, $Head, str_replace("px", '', $value["left"]) * 2, str_replace("px", '', $value["top"]) * 2, 0, 0, str_replace("px", '', $value["width"]) * 2, str_replace("px", '', $value["height"]) * 2, $QR_w, $QR_h);
                                    if ($userinfo && $isroot != 1) {
                                        unlink($picpath);
                                    }
                                } else {
                                    if ($value["type"] == "storename") {
                                        $colorArr = hex2rgb($value["color"]);
                                        $textcolor = imagecolorallocate($BG, $colorArr["r"], $colorArr["g"], $colorArr["b"]);
                                        $strnickname = $userinfo ? $userinfo["storename"] : "商家名称";
                                        $strnickname = mb_convert_encoding($strnickname, "html-entities", "utf-8");
                                        ImageTTFText($BG, str_replace("px", '', $value["size"]), 0, str_replace("px", '', $value["left"] + 15) * 2, str_replace("px", '', $value["top"] + 15) * 2, $textcolor, MODULE_ROOT . "/resource/font/simhei.ttf", $strnickname);
                                    } else {
                                        if ($value["type"] == "text") {
                                            $colorArr = hex2rgb($value["color"]);
                                            $textcolor = imagecolorallocate($BG, $colorArr["r"], $colorArr["g"], $colorArr["b"]);
                                            $strnickname = $value["content"];
                                            $strnickname = mb_convert_encoding($strnickname, "html-entities", "utf-8");
                                            ImageTTFText($BG, str_replace("px", '', $value["size"]), 0, str_replace("px", '', $value["left"] + 15) * 2, str_replace("px", '', $value["top"] + 15) * 2, $textcolor, MODULE_ROOT . "/resource/font/simhei.ttf", $strnickname);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        imagejpeg($BG, $outfile);
        if ($isroot == 0) {
            load()->func("file");
            file_remote_upload(strstr($outfile, "lywywl_ztb"), true);
        }
        return true;
    } else {
        return false;
    }
}
function listDir($dir)
{
    $result = array();
    if (is_dir($dir)) {
        $file_dir = scandir($dir);
        foreach ($file_dir as $file) {
            if (!($file == "." || $file == "..")) {
                if (is_dir($dir . $file)) {
                    $result = array_merge($result, list_dir($dir . $file . "/"));
                } else {
                    array_push($result, $dir . $file);
                }
            }
        }
    }
    return $result;
}
function getServerIp()
{
    return gethostbyname($_SERVER["SERVER_NAME"]);
}
function replaceShareInfo($content, $openid = '')
{
    global $_W;
    $nickname = $_W["fans"]["nickname"];
    if (!empty($openid)) {
        $userAccount = pdo_get(ztbTable("user_account", false), array("openid" => $openid));
        if (!empty($userAccount)) {
            $nickname = $userAccount["nickname"];
        }
    }
    return str_replace("{NICKNAME}", $nickname, $content);
}
function getMemberAvatar()
{
    global $_W;
    load()->model("mc");
    $avatar = '';
    if (!empty($_W["member"]["uid"])) {
        $member = mc_fetch(intval($_W["member"]["uid"]), array("avatar"));
        if (!empty($member)) {
            $avatar = $member["avatar"];
        }
    }
    if (empty($avatar)) {
        $fan = mc_fansinfo($_W["openid"]);
        if (!empty($fan)) {
            $avatar = $fan["avatar"];
        }
    }
    if (empty($avatar)) {
        $userinfo = mc_oauth_userinfo();
        if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo["avatar"])) {
            $avatar = $userinfo["avatar"];
        }
    }
    if (empty($avatar)) {
        return '';
    } else {
        return $avatar;
    }
}
function ztbTable($table, $istablepre = true)
{
    $tablename = "lywywl_ztb_" . $table;
    if ($istablepre) {
        $tablename = tablename($tablename);
    }
    return $tablename;
}
function ztbNopreTable($table, $istablepre = true)
{
    $tablename = "lywywl_ztb_" . $table;
    return $tablename;
}
function getRow($table_name, $where = '')
{
    global $_W;
    if (empty($table_name)) {
        return array();
    }
    $uniacid = $_W["uniacid"];
    $sql = "SELECT * FROM " . ztbTable($table_name) . " WHERE uniacid = :uniacid {$where} LIMIT 1";
    $params = array(":uniacid" => $uniacid);
    return pdo_fetch($sql, $params);
}
function getCol($table_name, $where = '', $field = "*")
{
    global $_W;
    if (empty($table_name)) {
        return array();
    }
    $uniacid = $_W["uniacid"];
    $sql = "SELECT {$field} FROM " . ztbTable($table_name) . " WHERE uniacid = :uniacid {$where} LIMIT 1";
    $params = array(":uniacid" => $uniacid);
    return pdo_fetchcolumn($sql, $params);
}
function ztkUpdate($table, $data = array(), $params = array(), $glue = "AND")
{
    global $_W;
    $field_names = pdo_fetchallfields(ztbTable($table));
    $update_data = array();
    foreach ($field_names as $value) {
        if (array_key_exists($value, $data) == true) {
            $update_data[$value] = $data[$value];
        }
    }
    if (empty($update_data)) {
        return false;
    }
    $params["uniacid"] = $_W["uniacid"];
    return pdo_update(ztbTable($table, FALSE), $update_data, $params, $glue);
}
function ztkInsert($table, $data = array(), $replace = FALSE)
{
    $field_names = pdo_fetchallfields(ztkTable($table));
    $insert_data = array();
    foreach ($field_names as $value) {
        if (array_key_exists($value, $data) == true) {
            $insert_data[$value] = $data[$value];
        }
    }
    if (empty($insert_data)) {
        return false;
    }
    return pdo_insert(ztbTable($table, FALSE), $insert_data, $replace);
}
function ztkDelete($table, $params = array(), $glue = "AND")
{
    return pdo_delete(ztbTable($table, FALSE), $params, $glue);
}
function isFollow($openid, $uniacid = '')
{
    if ($uniacid) {
        $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename("account") . " WHERE uniacid = :uniacid", array(":uniacid" => $uniacid));
        $account_api = WeAccount::create($acid);
        $fans = $account_api->fansQueryInfo($openid);
        return !empty($fans["subscribe"]);
    }
    $account_api = WeAccount::create();
    $fans = $account_api->fansQueryInfo($openid);
    return !empty($fans["subscribe"]);
}
function exportToExcel($filename, $tileArray = array(), $dataArray = array())
{
    global $_W;
    $filename = urlencode($filename);
    $memory_limit = $_W["config"]["setting"]["memory_limit"];
    if (empty($memory_limit)) {
        $memory_limit = "512M";
    }
    ini_set("memory_limit", $memory_limit);
    ini_set("max_execution_time", 0);
    ob_end_clean();
    ob_start();
    header("Content-Type: text/csv");
    header("Content-Disposition:filename=" . $filename);
    $fp = fopen("php://output", "w");
    fwrite($fp, chr(0xef) . chr(0xbb) . chr(0xbf));
    fputcsv($fp, $tileArray);
    $index = 0;
    foreach ($dataArray as $item) {
        if ($index == 1000) {
            $index = 0;
            ob_flush();
            flush();
        }
        $index++;
        fputcsv($fp, $item);
    }
    ob_flush();
    flush();
    ob_end_clean();
}
function registerDataToStr($register_data, $name = '', $is_default = true)
{
    if (empty($register_data)) {
        return '';
    } else {
        $retrunStr = '';
        foreach ($register_data as $value) {
            if ($value["Explain"] == $name) {
                return $value["Value"] . '';
            } else {
                if ($is_default) {
                    $retrunStr .= $value["Explain"] . ":" . $value["Value"] . " ";
                }
            }
        }
        return $retrunStr;
    }
}
function timeAgo($time)
{
    $t = time() - $time;
    $f = array("31536000" => "年", "2592000" => "个月", "604800" => "星期", "86400" => "天", "3600" => "小时", "60" => "分钟", "1" => "秒");
    foreach ($f as $k => $v) {
        if (0 != ($c = floor($t / (int) $k))) {
            return $c . $v . "前";
        }
    }
}
function getArtContent($content)
{
    $content = str_replace("<!--\$\$", '', $content);
    $content = str_replace("\$\$-->", '', $content);
    if (!empty($content)) {
        $content = "<html>\r\n\t" . "<head>\r\n" . "<meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=utf-8\"/>" . "<meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0\" />" . "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />" . "<style>\r\n\t " . "table {border-right:1px dashed #D2D2D2;border-bottom:1px dashed #D2D2D2;} \r\n\t " . "table td{border-left:1px dashed #D2D2D2;border-top:1px dashed #D2D2D2;} \r\n\t" . "img {max-width:100%;}\r\n" . "</style>\r\n\t" . "</head>\r\n" . "<body style=\"width:[width]\">\r\n" . $content . "\r\n</body>" . "</html>";
    }
    return $content;
}
function getContent($content)
{
    $content = preg_replace("/style=.+?['|\"]/i", '', $content);
    $content = preg_replace("/width=.+?['|\"]/i", "width=\"100%\"", $content);
    $content = preg_replace("/height=.+?['|\"]/i", "height=\"auto\"", $content);
    $content = str_replace("<!--\$\$", '', $content);
    $content = str_replace("\$\$-->", '', $content);
    if (!empty($content)) {
        $content = "<html>\r\n\t" . "<head>\r\n" . "<meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=utf-8\"/>" . "<meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0\" />" . "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />" . "<style>\r\n\t " . "table {border-right:1px dashed #D2D2D2;border-bottom:1px dashed #D2D2D2;} \r\n\t " . "table td{border-left:1px dashed #D2D2D2;border-top:1px dashed #D2D2D2;} \r\n\t" . "img {max-width:100%;}\r\n" . "</style>\r\n\t" . "</head>\r\n" . "<body style=\"width:[width]\">\r\n" . $content . "\r\n</body>" . "</html>";
    }
    return $content;
}
function getRand($proArr)
{
    $result = '';
    $proSum = array_sum($proArr);
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
        }
        $proSum -= $proCur;
    }
    unset($proArr);
    return $result;
}
function tipRedirect($msg, $types = 0)
{
    header("Location: " . __MURL("tip", array("msg" => urlencode($msg), "types" => $types)));
    exit;
}
function checkLywywlAuth($uniacid, $wxAppID)
{
    return '';
    $authCache = cache_load("lywywl_ztb_auth_cache" . $uniacid);
    if (empty($authCache)) {
        load()->func("communication");
        load()->func("file");
        if (file_exists(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt")) {
            $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt");
            $fileArr = explode(",", $fileContent);
            if (count($fileArr) == 5 || count($fileArr) == 6) {
                $objectCode = IN_MODULE;
                $contacts = $fileArr[2];
                $tel = $fileArr[3];
                $authCode = $fileArr[1];
                $domain = $_SERVER["HTTP_HOST"];
                $ip = $_SERVER["SERVER_ADDR"];
                $wxAppID = $wxAppID;
                $types = intval($fileArr[5]);
                $timer = TIMESTAMP;
                $signStr = "ObjectCode=" . $objectCode . "&Contacts=" . $contacts . "&Tel=" . $tel . "&AuthCode=" . $authCode . "&Domain=" . $domain . "&IP=" . $ip . "&WxAppID=" . $wxAppID . "-" . $uniacid . "&Power=www.lywywl.com";
                $signStr = strtolower($signStr);
                $sign = strtoupper(md5($signStr));
                $posturl = "http://auth.lywywl.com/api";
                $post = array("ObjectCode" => $objectCode, "Contacts" => $contacts, "Tel" => $tel, "AuthCode" => $authCode, "Domain" => $domain, "IP" => $ip, "WxAppID" => $wxAppID . "-" . $uniacid, "Sign" => $sign, "Timer" => $timer);
                $response = ihttp_post($posturl, $post);
                if (is_error($response)) {
                    return "networkError";
                }
                if ($response["code"] == "200") {
                    $result = (array) json_decode($response["content"], true);
                    if ($result["list"]["CustomerTypes"] != $types) {
                        return "pirateError";
                    }
                    if ($result["status"] == 1) {
                        $BackTime = $result["list"]["AuthTimer"];
                        $AuthTimer = strtoupper(md5($timer . ",www.lywywl.com"));
                        if ($BackTime == $AuthTimer) {
                            cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                            cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                            $auth_plugin_list = $result["list"]["Plugins"];
                            $plugins_list = pdo_getall("lywywl_ztb_sys_plugins", array("uniacid" => $uniacid, "deltime" => 0));
                            foreach ($plugins_list as $key => $plugin) {
                                if (!pdo_fieldexists("modules_recycle", "modulename")) {
                                    if (strpos($auth_plugin_list, $plugin["name"]) === false) {
                                        pdo_update("lywywl_ztb_sys_plugins", array("deltime" => TIMESTAMP), array("id" => $plugin["id"]));
                                    }
                                } else {
                                    $recycle = pdo_get("modules_recycle", array("modulename" => $plugin["name"]), array("id", "modulename"));
                                    if (empty($recycle)) {
                                        if (strpos($auth_plugin_list, $plugin["name"]) === false) {
                                            pdo_update("lywywl_ztb_sys_plugins", array("deltime" => TIMESTAMP), array("id" => $plugin["id"]));
                                        }
                                    }
                                }
                            }
                            return '';
                        } else {
                            return "pirateError";
                        }
                    } else {
                        if ($result["status"] == -2) {
                            cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                            cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                            return "statusError";
                        } else {
                            if ($result["status"] == 0) {
                                return "paraError";
                            } else {
                                if ($result["status"] == 2) {
                                    cache_delete("lywywl_ztb_auth_cache" . $uniacid);
                                    cache_write("lywywl_ztb_auth_cache" . $uniacid, $result["list"], 60 * 60 * 24);
                                    return "renewError";
                                } else {
                                    return "pirateError";
                                }
                            }
                        }
                    }
                } else {
                    return "networkError";
                }
            } else {
                return "fileError";
            }
        } else {
            return "waitError";
        }
    }
}
function getPluginStatus($uniacid, $plugin)
{
    $pluginCache = cache_load("lywywl_ztb_plugin_cache_" . $uniacid . "_" . $plugin);
    if (!empty($pluginCache)) {
        return $pluginCache == "open" ? true : false;
    } else {
        $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin, "uniacid" => $uniacid, "status" => 1, "deltime" => 0));
        if (empty($modules)) {
            cache_write("lywywl_ztb_plugin_cache_" . $uniacid . "_" . $plugin, "close");
            return false;
        } else {
            cache_write("lywywl_ztb_plugin_cache_" . $uniacid . "_" . $plugin, "open");
            return true;
        }
    }
}
function getPluginConfig($uniacid, $plugin, $config)
{
    $configCache = cache_load("lywywl_ztb_plugin_config_" . $uniacid . "_" . $plugin);
    if (!empty($configCache)) {
        return $configCache[$config];
    } else {
        $modules = pdo_get("lywywl_ztb_sys_plugins", array("name" => $plugin, "uniacid" => $uniacid, "status" => 1, "deltime" => 0));
        $iunserializerConfig = iunserializer($modules["config"]);
        cache_write("lywywl_ztb_plugin_config_" . $uniacid . "_" . $plugin, $iunserializerConfig);
        return $iunserializerConfig[$config];
    }
}
function getRandStr($length)
{
    $str = "0123456789";
    $len = strlen($str) - 1;
    $randstr = '';
    $i = 0;
    while ($i < $length) {
        $num = mt_rand(0, $len);
        $randstr .= $str[$num];
        $i++;
    }
    return $randstr;
}
function getOrderNumber()
{
    $dateTime = date("YmdHis");
    return $dateTime . getRandStr(6);
}
function filterEmoji($emojiStr)
{
    $emojiStr = preg_replace_callback("/./u", function (array $match) {
        return strlen($match[0]) >= 4 ? '' : $match[0];
    }, $emojiStr);
    return $emojiStr;
}
function sendTplNotice($acid, $openid, $postdata, $template_id, $url = '', $topcolor = "#FF683F")
{
    global $_W;
    if (empty($acid)) {
        $acid = $_W["account"]["acid"];
    }
    if (empty($acid) && $_W["uniacid"]) {
        $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename("account") . " WHERE uniacid = :uniacid", array(":uniacid" => $_W["uniacid"]));
    }
    $acc = WeAccount::createByUniacid($acid);
    if (empty($acc) || empty($openid) || empty($postdata) || empty($template_id)) {
        return false;
    }
    $acc->clearAccessToken();
    $res = $acc->sendTplNotice($openid, $template_id, $postdata, $url, $topcolor);
    return !is_error($res);
}
function sendSiteTplNotice($uniacid, $openid, $postdata, $template_id, $url = '', $topcolor = "#FF683F")
{
    $acid = pdo_fetchcolumn("SELECT acid FROM " . tablename("account") . " WHERE uniacid = :uniacid", array(":uniacid" => $uniacid));
    $acc = WeAccount::createByUniacid($acid);
    if (empty($acc) || empty($openid) || empty($postdata) || empty($template_id)) {
        return false;
    }
    $acc->clearAccessToken();
    $res = $acc->sendTplNotice($openid, $template_id, $postdata, $url, $topcolor);
    return $res;
}
function zucpMt($sn, $pwd, $mobiles, $content, $ext, $stime, $rrid)
{
    $flag = 0;
    $argv = array("sn" => $sn, "pwd" => strtoupper(md5($sn . $pwd)), "mobile" => $mobiles, "content" => iconv("UTF-8", "gb2312//IGNORE", $content), "ext" => $ext, "stime" => '', "rrid" => '');
    $params = '';
    foreach ($argv as $key => $value) {
        if ($flag != 0) {
            $params .= "&";
            $flag = 1;
        }
        $params .= $key . "=";
        $params .= urlencode($value);
        $flag = 1;
    }
    $length = strlen($params);
    $fp = fsockopen("sdk2.entinfo.cn", 8060, $errno, $errstr, 10) or exit($errstr . "---------->" . $errno);
    $header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
    $header .= "Host:sdk2.entinfo.cn\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . $length . "\r\n";
    $header .= "Connection: Close\r\n\r\n";
    $header .= $params . "\r\n";
    fputs($fp, $header);
    $inheader = 1;
    while (!feof($fp)) {
        $line = fgets($fp, 1024);
        if ($inheader && ($line == "\n" || $line == "\r\n")) {
            $inheader = 0;
        }
        if ($inheader == 0) {
            return false;
        }
    }
    $line = str_replace("<string xmlns=\"http://tempuri.org/\">", '', $line);
    $line = str_replace("</string>", '', $line);
    $result = explode("-", $line);
    if (count($result) > 1) {
        return true;
    } else {
        return false;
    }
}
function dysms_send($accesskeyid, $accesskeysecret, $mobile, $signname, $templatecode, $templateparam = array())
{
    $config = ["accessKeyId" => $accesskeyid, "accessKeySecret" => $accesskeysecret];
    $client = new Client($config);
    $sendSms = new SendSms();
    $sendSms->setPhoneNumbers($mobile);
    $sendSms->setSignName($signname);
    $sendSms->setTemplateCode($templatecode);
    $sendSms->setTemplateParam($templateparam);
    $sendSms->setOutId("demo");
    return $client->execute($sendSms);
}
function isMobile()
{
    if (isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
        return true;
    }
    if (isset($_SERVER["HTTP_VIA"]) && stristr($_SERVER["HTTP_VIA"], "wap")) {
        return true;
    }
    if (isset($_SERVER["HTTP_USER_AGENT"])) {
        $clientkeywords = array("nokia", "sony", "ericsson", "mot", "samsung", "htc", "sgh", "lg", "sharp", "sie-", "philips", "panasonic", "alcatel", "lenovo", "iphone", "ipod", "blackberry", "meizu", "android", "netfront", "symbian", "ucweb", "windowsce", "palm", "operamini", "operamobi", "openwave", "nexusone", "cldc", "midp", "wap", "mobile");
        if (preg_match("/(" . implode("|", $clientkeywords) . ")/i", strtolower($_SERVER["HTTP_USER_AGENT"]))) {
            return true;
        }
    }
    if (isset($_SERVER["HTTP_ACCEPT"])) {
        if (strpos($_SERVER["HTTP_ACCEPT"], "vnd.wap.wml") !== false && (strpos($_SERVER["HTTP_ACCEPT"], "text/html") === false || strpos($_SERVER["HTTP_ACCEPT"], "vnd.wap.wml") < strpos($_SERVER["HTTP_ACCEPT"], "text/html"))) {
            return true;
        }
    }
    return false;
}
function isHttps()
{
    if (!empty($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) !== "off") {
        return true;
    } else {
        if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] === "https") {
            return true;
        } else {
            if (!empty($_SERVER["HTTP_FRONT_END_HTTPS"]) && strtolower($_SERVER["HTTP_FRONT_END_HTTPS"]) !== "off") {
                return true;
            } else {
            }
        }
    }
    return false;
}
function getCityNameByLongitudeAndLatitude($longitude, $latitude)
{
    load()->func("communication");
    $url = "http://api.map.baidu.com/geoconv/v1/?coords={$longitude},{$latitude}&from=1&to=5&ak=84ospYGfUQkPivaavHrXlHzXyWpRRzVe";
    $result = ihttp_get($url);
    $result = @json_decode($result["content"], true);
    if ($result["status"] == 0) {
        $longitude = $result["result"][0]["x"];
        $latitude = $result["result"][0]["y"];
        $url = "http://api.map.baidu.com/geocoder/v2/?location={$latitude},{$longitude}&output=json&ak=84ospYGfUQkPivaavHrXlHzXyWpRRzVe";
        $result = ihttp_get($url);
        $result = @json_decode($result["content"], true);
        if ($result["status"] == "OK") {
            return $result["result"]["formatted_address"];
        }
    }
    return '';
}
function orderQuery($out_trade_no)
{
    global $_W, $config;
    $url = "https://api.mch.weixin.qq.com/pay/orderquery";
    $pars = array();
    $pars["appid"] = $config["appid"];
    $pars["mch_id"] = $config["mchid"];
    $pars["out_trade_no"] = $out_trade_no;
    $pars["nonce_str"] = random(32);
    ksort($pars, SORT_STRING);
    $string1 = '';
    foreach ($pars as $k => $v) {
        $string1 .= "{$k}={$v}&";
    }
    $string1 .= "key={$config["password"]}";
    $pars["sign"] = strtoupper(md5($string1));
    $xml = array2xml($pars);
    load()->func("communication");
    $flag = false;
    $procResult = null;
    $resp = ihttp_request($url, $xml);
    if (is_error($resp)) {
        $procResult = $resp;
    } else {
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . $resp["content"];
        $dom = new DOMDocument();
        if ($dom->loadXML($xml)) {
            $xpath = new DOMXPath($dom);
            $code = $xpath->evaluate("string(//xml/return_code)");
            $ret = $xpath->evaluate("string(//xml/result_code)");
            if (strtolower($code) == "success" && strtolower($ret) == "success") {
                $flag = true;
                $procResult = array();
                $procResult["trade_state"] = $xpath->evaluate("string(//xml/trade_state)");
                $procResult["total_fee"] = intval($xpath->evaluate("string(//xml/total_fee)"));
                $procResult["trade_state"] = $xpath->evaluate("string(//xml/trade_state)");
                $procResult["transaction_id"] = $xpath->evaluate("string(//xml/transaction_id)");
                $procResult["out_trade_no"] = $xpath->evaluate("string(//xml/out_trade_no)");
                $procResult["time_end"] = $xpath->evaluate("string(//xml/time_end)");
            } else {
                $error = $xpath->evaluate("string(//xml/err_code_des)");
                $code = $xpath->evaluate("string(//xml/err_code)");
                $procResult = error(-2, array("code" => $code, "error" => $error));
            }
        } else {
            $procResult = error(-1, "error response");
        }
    }
    return array("flag" => $flag, "info" => $procResult);
}
function replaceDieDomain($config, $url, $user_id = 0, $activity_id = 0, $share_user_id = 0)
{
    if (isHttps()) {
        $domain = "https://" . $_SERVER["HTTP_HOST"] . "/";
    } else {
        $domain = "http://" . $_SERVER["HTTP_HOST"] . "/";
    }
    if ($config["domain_types"] == 1) {
        include_once MODULE_ROOT . "/inc/class/Hashids.class.php";
        $hashids = Hashids::instance(6, "lywyztb", '');
        $activity_domain = strtolower($hashids->encode($activity_id));
        $user_domain = strtolower($hashids->encode($share_user_id));
    }
    if ($config["share_types"] == 1 && !empty($config["die_domain"]) && !empty($config["site_domain"])) {
        $die_arr = explode("\r\n", trim($config["die_domain"]));
        $die_count = count($die_arr);
        $die_domain = $die_arr[$user_id % $die_count];
        if ($config["domain_types"] == 1) {
            $die_domain_arr = explode(".", trim($die_domain));
            if (strpos(strtolower($die_domain), "www") !== false) {
                unset($die_domain_arr[0]);
                $url_domain_str = implode(".", $die_domain_arr);
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($die_domain), "https://") !== false) {
                        $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            } else {
                $url_domain_str = str_replace("http://", '', str_replace("https://", '', $die_domain));
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($die_domain), "https://") !== false) {
                        $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            }
        }
        return str_replace($domain, $die_domain, $url);
    } else {
        if ($config["share_types"] != 1 && !empty($config["die_domain"]) && !empty($config["site_domain"])) {
            return str_replace($domain, $config["site_domain"], $url);
        } else {
            $site_domain = $config["site_domain"];
            if (empty($site_domain)) {
                if (isHttps()) {
                    $site_domain = "https://" . $_SERVER["HTTP_HOST"] . "/";
                } else {
                    $site_domain = "http://" . $_SERVER["HTTP_HOST"] . "/";
                }
            }
            if ($config["domain_types"] == 1) {
                $site_domain_arr = explode(".", trim($site_domain));
                if (strpos(strtolower($site_domain), "www") !== false) {
                    unset($site_domain_arr[0]);
                    $url_domain_str = implode(".", $site_domain_arr);
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($site_domain), "https://") !== false) {
                                $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                } else {
                    $url_domain_str = str_replace("http://", '', str_replace("https://", '', $site_domain));
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($site_domain), "https://") !== false) {
                                $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                }
            }
            return str_replace($domain, $site_domain, $url);
        }
    }
}
function replaceDieDomain2($config, $url, $user_id = 0, $activity_id = 0, $share_user_id = 0)
{
    if (isHttps()) {
        $domain = "https://" . $_SERVER["HTTP_HOST"] . "/";
    } else {
        $domain = "http://" . $_SERVER["HTTP_HOST"] . "/";
    }
    if ($config["domain_types"] == 1) {
        include_once MODULE_ROOT . "/inc/class/Hashids.class.php";
        $hashids = Hashids::instance(6, "lywyztb", '');
        $activity_domain = strtolower($hashids->encode($activity_id));
        $user_domain = strtolower($hashids->encode($share_user_id));
    }
    if (!empty($config["die_domain"]) && !empty($config["site_domain"])) {
        $die_arr = explode("\r\n", trim($config["die_domain"]));
        $die_count = count($die_arr);
        $die_domain = $die_arr[$user_id % $die_count];
        if ($config["domain_types"] == 1) {
            $die_domain_arr = explode(".", trim($die_domain));
            if (strpos(strtolower($die_domain), "www") !== false) {
                unset($die_domain_arr[0]);
                $url_domain_str = implode(".", $die_domain_arr);
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($die_domain), "https://") !== false) {
                        $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            } else {
                $url_domain_str = str_replace("http://", '', str_replace("https://", '', $die_domain));
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($die_domain), "https://") !== false) {
                        $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            }
        }
        return str_replace($domain, $die_domain, $url);
    } else {
        $site_domain = $config["site_domain"];
        if (empty($site_domain)) {
            if (isHttps()) {
                $site_domain = "https://" . $_SERVER["HTTP_HOST"] . "/";
            } else {
                $site_domain = "http://" . $_SERVER["HTTP_HOST"] . "/";
            }
        }
        if ($config["domain_types"] == 1) {
            $site_domain_arr = explode(".", trim($site_domain));
            if (strpos(strtolower($site_domain), "www") !== false) {
                unset($site_domain_arr[0]);
                $url_domain_str = implode(".", $site_domain_arr);
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($site_domain), "https://") !== false) {
                        $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            } else {
                $url_domain_str = str_replace("http://", '', str_replace("https://", '', $site_domain));
                if ($activity_id > 0 && $share_user_id > 0) {
                    if (strpos(strtolower($site_domain), "https://") !== false) {
                        $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    } else {
                        $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                    }
                } else {
                    if ($activity_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                        }
                    }
                }
            }
        }
        return str_replace($domain, $site_domain, $url);
    }
}
function jumpDieDomain($config, $siteurl, $user_id = 0, $activity_id = 0, $share_user_id = 0)
{
    if ($config["domain_types"] == 1) {
        include_once MODULE_ROOT . "/inc/class/Hashids.class.php";
        $hashids = Hashids::instance(6, "lywyztb", '');
        $activity_domain = strtolower($hashids->encode($activity_id));
        $user_domain = strtolower($hashids->encode($share_user_id));
    }
    if (!empty($config["die_domain"])) {
        $die_arr = explode("\r\n", trim($config["die_domain"]));
        $die_count = count($die_arr);
        $die_domain = rtrim($die_arr[$user_id % $die_count], "/");
        $site_domain_subject = $url_domain_str = str_replace("/", '', str_replace("https://", '', str_replace("http://", '', str_replace("www.", '', $die_domain))));
        if ($config["domain_types"] == 1 && $activity_id > 0 && $share_user_id > 0) {
            $site_domain_subject = $user_domain . "-" . $activity_domain . "." . $site_domain_subject;
        }
        if (strpos($siteurl, $site_domain_subject) === false) {
            if ($config["domain_types"] == 1) {
                $die_domain_arr = explode(".", trim($die_domain));
                if (strpos(strtolower($die_domain), "www") !== false) {
                    unset($die_domain_arr[0]);
                    $url_domain_str = implode(".", $die_domain_arr);
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($die_domain), "https://") !== false) {
                                $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                } else {
                    $url_domain_str = str_replace("http://", '', str_replace("https://", '', $die_domain));
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($die_domain), "https://") !== false) {
                            $die_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $die_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($die_domain), "https://") !== false) {
                                $die_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $die_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                }
            }
            header("Location: " . $die_domain . $_SERVER["REQUEST_URI"]);
            exit;
        }
    } else {
        if ($config["domain_types"] == 1 && $activity_id > 0 && $share_user_id > 0) {
            $site_domain = rtrim($config["site_domain"], "/");
            $site_domain_subject = $url_domain_str = str_replace("/", '', str_replace("https://", '', str_replace("http://", '', str_replace("www.", '', $site_domain))));
            $site_domain_subject = $user_domain . "-" . $activity_domain . "." . $site_domain_subject;
            if (strpos($siteurl, $site_domain_subject) === false) {
                $site_domain_arr = explode(".", trim($site_domain));
                if (strpos(strtolower($site_domain), "www") !== false) {
                    unset($site_domain_arr[0]);
                    $url_domain_str = implode(".", $site_domain_arr);
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($site_domain), "https://") !== false) {
                                $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                } else {
                    $url_domain_str = str_replace("http://", '', str_replace("https://", '', $site_domain));
                    if ($activity_id > 0 && $share_user_id > 0) {
                        if (strpos(strtolower($site_domain), "https://") !== false) {
                            $site_domain = "https://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        } else {
                            $site_domain = "http://" . $user_domain . "-" . $activity_domain . "." . $url_domain_str;
                        }
                    } else {
                        if ($activity_id > 0) {
                            if (strpos(strtolower($site_domain), "https://") !== false) {
                                $site_domain = "https://" . $activity_domain . "." . $url_domain_str;
                            } else {
                                $site_domain = "http://" . $activity_domain . "." . $url_domain_str;
                            }
                        }
                    }
                }
                header("Location: " . $site_domain . $_SERVER["REQUEST_URI"]);
                exit;
            }
        }
    }
}
function encryption($string, $operation = "DECODE", $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key ? $key : "www");
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? $operation == "DECODE" ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length) : '';
    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == "DECODE" ? base64_decode(substr($string, $ckey_length)) : sprintf("%010d", $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    $i = 0;
    while ($i <= 255) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        $i++;
    }
    $j = $i = 0;
    while ($i < 256) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
        $i++;
    }
    $a = $j = $i = 0;
    while ($i < $string_length) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
        $i++;
    }
    if ($operation == "DECODE") {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace("=", '', base64_encode($result));
    }
}
function getUserById($id)
{
    return getDataById(ztbTable("user_account"), $id);
}
function Filter_array_ListDate($array, $pay_status)
{
    $newListData = array();
    foreach ($array as $val) {
        if ($val["is_pay"] == $pay_status) {
            $newval = $val;
            $newval["is_pay"] = $val["is_pay"] == 1 ? "未下单" : ($val["is_pay"] == 2 ? "未支付" : "已支付");
            $newListData[] = $newval;
        }
    }
    return $newListData;
}
function getUserByOpenID($openid)
{
    global $_W;
    $model = pdo_get("lywywl_ztb_user_account", array("openid" => $openid, "uniacid" => $_W["uniacid"]));
    return $model;
}
function addUser($openid, $nickname, $headimgurl, $sex, $area)
{
    global $_W;
    $insert = array("uniacid" => $_W["uniacid"], "openid" => $openid, "nickname" => $nickname, "headurl" => $headimgurl, "sex" => $sex, "area" => $area, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
    pdo_insert("lywywl_ztb_user_account", $insert);
}
function updateUser($nickname, $headimgurl, $sex, $area, $id)
{
    $update = array("nickname" => $nickname, "headurl" => $headimgurl, "sex" => $sex, "area" => $area, "updatetime" => TIMESTAMP);
    pdo_update("lywywl_ztb_user_account", $update, array("id" => $id));
}
function getObject($oid)
{
    global $_W;
    if (empty($oid)) {
        return array();
    }
    $objModel = pdo_get(ztbNopreTable("obj_activity"), array("id" => $oid, "uniacid" => $_W["uniacid"]));
    return $objModel;
}
function supplyAgain($item, $config)
{
    $flag = false;
    $message = "未知";
    if ($item["types"] == 1) {
        $storeModel = pdo_get(ztbTable("store_account", false), array("id" => $item["store_id"], "deltime" => 0));
        if ($item["is_store_sell"] == 0) {
            if ($storeModel["money"] >= $item["money"]) {
                $actModel = pdo_get(ztbTable("obj_activity", false), array("id" => $item["activity_id"], "deltime" => 0));
                $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $item["uniacid"], "store_id" => $item["store_id"], "openid" => $item["openid"], "deltime" => 0));
                $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $actModel["title"] . "，获得红包：" . $item["money"] . "元";
                pdo_update(ztbTable("store_account", false), array("money -=" => $item["money"]), array("id" => $storeModel["id"]));
                $storeRecordMoneyModel = array();
                $storeRecordMoneyModel["uniacid"] = $storeModel["uniacid"];
                $storeRecordMoneyModel["store_id"] = $storeModel["id"];
                $storeRecordMoneyModel["types"] = 5;
                $storeRecordMoneyModel["detail_id"] = $item["draw_id"];
                $storeRecordMoneyModel["money"] = $item["money"];
                $storeRecordMoneyModel["balance"] = $storeModel["money"] - $item["money"];
                $storeRecordMoneyModel["note"] = $note;
                $storeRecordMoneyModel["createtime"] = TIMESTAMP;
                pdo_insert(ztbTable("store_bill", false), $storeRecordMoneyModel);
                $result = sendWeixinMchPay($item["openid"], $item["money"] * 100, $item["desc"], false, $item["uniacid"], $config);
                if ($result === true) {
                    $flag = true;
                    pdo_update(ztbTable("sys_reissue", false), array("status" => 1, "is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
                } else {
                    pdo_update(ztbTable("sys_reissue", false), array("is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
                    $message = $result["message"];
                }
            } else {
                $message = "商家账户余额不足，补发失败！";
            }
        } else {
            $result = sendWeixinMchPay($item["openid"], $item["money"] * 100, $item["desc"], false, $item["uniacid"], $config);
            if ($result === true) {
                $flag = true;
                pdo_update(ztbTable("sys_reissue", false), array("status" => 1, "is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
            } else {
                $message = $result["message"];
            }
        }
    } else {
        if ($item["types"] == 2) {
            $storeModel = pdo_get(ztbTable("store_account", false), array("id" => $item["store_id"], "deltime" => 0));
            if ($storeModel["money"] >= $item["money"]) {
                $actModel = pdo_get(ztbTable("obj_activity", false), array("id" => $item["activity_id"], "deltime" => 0));
                $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $item["uniacid"], "store_id" => $item["store_id"], "openid" => $item["openid"], "deltime" => 0));
                pdo_update(ztbTable("user_account", false), array("money +=" => $item["money"]), array("id" => $userModel["id"]));
                $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $userModel["nickname"] . "】参与活动：" . $actModel["title"] . "，获得零钱：" . $item["money"] . "元";
                $userRecordMoneyModel = array();
                $userRecordMoneyModel["uniacid"] = $userModel["uniacid"];
                $userRecordMoneyModel["store_id"] = $userModel["store_id"];
                $userRecordMoneyModel["openid"] = $userModel["openid"];
                $userRecordMoneyModel["nickname"] = $userModel["nickname"];
                $userRecordMoneyModel["headurl"] = $userModel["headurl"];
                $userRecordMoneyModel["types"] = 3;
                $userRecordMoneyModel["detail_id"] = $item["draw_id"];
                $userRecordMoneyModel["money"] = $item["money"];
                $userRecordMoneyModel["balance"] = $userModel["money"] + $item["money"];
                $userRecordMoneyModel["note"] = $note;
                $userRecordMoneyModel["createtime"] = TIMESTAMP;
                pdo_insert(ztbTable("user_bill", false), $userRecordMoneyModel);
                if ($item["is_store_sell"] == 0) {
                    pdo_update(ztbTable("store_account", false), array("money -=" => $item["money"]), array("id" => $storeModel["id"]));
                    $storeRecordMoneyModel = array();
                    $storeRecordMoneyModel["uniacid"] = $storeModel["uniacid"];
                    $storeRecordMoneyModel["store_id"] = $storeModel["id"];
                    $storeRecordMoneyModel["types"] = 5;
                    $storeRecordMoneyModel["detail_id"] = $item["draw_id"];
                    $storeRecordMoneyModel["money"] = $item["money"];
                    $storeRecordMoneyModel["balance"] = $storeModel["money"] - $item["money"];
                    $storeRecordMoneyModel["note"] = $note;
                    $storeRecordMoneyModel["createtime"] = TIMESTAMP;
                    pdo_insert(ztbTable("store_bill", false), $storeRecordMoneyModel);
                }
                $flag = true;
                pdo_update(ztbTable("sys_reissue", false), array("status" => 1, "is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
            } else {
                $message = "商家账户余额不足，补发失败！";
            }
        } else {
            if ($item["types"] == 3) {
                $storeModel = pdo_get(ztbTable("store_account", false), array("id" => $item["store_id"], "deltime" => 0));
                if ($item["is_store_sell"] == 0) {
                    if ($storeModel["money"] >= $item["money"]) {
                        $arr = explode("_", $item["desc"]);
                        $invite_id = $arr[1];
                        $inviteModel = pdo_get(ztbTable("store_invite", false), array("id" => $invite_id, "deltime" => 0));
                        $or_rebate2 = $inviteModel["or_rebate2"] == 1 ? "二级返利" : "一级返利";
                        $note = "业务分销返利：" . date("Y-m-d H:i:s", time()) . " 【{$storeModel["name"]}】下业务员【{$item["nickname"]}】获得商家分销{$or_rebate2}：{$item["money"]}元";
                        pdo_update(ztbTable("store_account", false), array("money -=" => $item["money"]), array("id" => $storeModel["id"]));
                        $storeRecordMoneyModel = array();
                        $storeRecordMoneyModel["uniacid"] = $storeModel["uniacid"];
                        $storeRecordMoneyModel["store_id"] = $storeModel["id"];
                        $storeRecordMoneyModel["types"] = 14;
                        $storeRecordMoneyModel["detail_id"] = $invite_id;
                        $storeRecordMoneyModel["money"] = $item["money"];
                        $storeRecordMoneyModel["balance"] = $storeModel["money"] - $item["money"];
                        $storeRecordMoneyModel["note"] = $note;
                        $storeRecordMoneyModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbTable("store_bill", false), $storeRecordMoneyModel);
                        $result = sendWeixinMchPay($item["openid"], $item["money"] * 100, $item["desc"], false, $item["uniacid"], $config);
                        if ($result === true) {
                            $flag = true;
                            pdo_update(ztbTable("sys_reissue", false), array("status" => 1, "is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
                        } else {
                            pdo_update(ztbTable("sys_reissue", false), array("is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
                            $message = $result["message"];
                        }
                    } else {
                        $message = "商家账户余额不足，补发失败！";
                    }
                } else {
                    $result = sendWeixinMchPay($item["openid"], $item["money"] * 100, $item["desc"], false, $item["uniacid"], $config);
                    if ($result === true) {
                        $flag = true;
                        pdo_update(ztbTable("sys_reissue", false), array("status" => 1, "is_store_sell" => 1, "updatetime" => time()), array("id" => $item["id"]));
                    } else {
                        $message = $result["message"];
                    }
                }
            }
        }
    }
    return array("flag" => $flag, "message" => $message);
}
function tip_redirect($msg, $types = 0)
{
    header("Location: " . __MURL("tip", array("msg" => urlencode($msg), "types" => $types)));
    exit;
}
function getWriteCode($id)
{
    include_once MODULE_ROOT . "/inc/class/Hashids.class.php";
    $hashids = Hashids::instance(6, "lywyztb", '');
    $encode_id = $hashids->encode($id);
    return $encode_id;
}
function zucp_mt($sn, $pwd, $mobiles, $content, $ext, $stime, $rrid)
{
    $flag = 0;
    $argv = array("sn" => $sn, "pwd" => strtoupper(md5($sn . $pwd)), "mobile" => $mobiles, "content" => iconv("UTF-8", "gb2312//IGNORE", $content), "ext" => $ext, "stime" => '', "rrid" => '');
    $params = '';
    foreach ($argv as $key => $value) {
        if ($flag != 0) {
            $params .= "&";
            $flag = 1;
        }
        $params .= $key . "=";
        $params .= urlencode($value);
        $flag = 1;
    }
    $length = strlen($params);
    $fp = fsockopen("sdk2.entinfo.cn", 8060, $errno, $errstr, 10) or exit($errstr . "---------->" . $errno);
    $header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
    $header .= "Host:sdk2.entinfo.cn\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . $length . "\r\n";
    $header .= "Connection: Close\r\n\r\n";
    $header .= $params . "\r\n";
    fputs($fp, $header);
    $inheader = 1;
    while (!feof($fp)) {
        $line = fgets($fp, 1024);
        if ($inheader && ($line == "\n" || $line == "\r\n")) {
            $inheader = 0;
        }
    }
    $line = str_replace("<string xmlns=\"http://tempuri.org/\">", '', $line);
    $line = str_replace("</string>", '', $line);
    $result = explode("-", $line);
    if (count($result) > 1) {
        return $line;
    } else {
        return true;
    }
}
function updateActivity($table_name, $model, $id)
{
    $model2["activity_types"] = $model["activity_types"];
    $model2["tmp_id"] = $model["tmp_id"];
    $model2["title"] = $model["title"];
    $model2["pic_url"] = $model["pic_url"];
    $model2["start_time"] = $model["start_time"];
    $model2["end_time"] = $model["end_time"];
    $model2["status"] = $model["status"];
    $model2["updatetime"] = $model["updatetime"];
    $model2["bogus_join_num"] = isset($model["bogus_join_num"]) ? $model["bogus_join_num"] : 0;
    $model2["bogus_join_gender"] = isset($model["bogus_join_gender"]) ? $model["bogus_join_gender"] : 0;
    $model2["bogus_buy_num"] = isset($model["bogus_buy_num"]) ? $model["bogus_buy_num"] : 0;
    $model2["bogus_buy_gender"] = isset($model["bogus_buy_gender"]) ? $model["bogus_buy_gender"] : 0;
    $model2["bogus_repost_num"] = isset($model["bogus_repost_num"]) ? $model["bogus_repost_num"] : 0;
    $model2["bogus_get_num"] = isset($model["bogus_get_num"]) ? $model["bogus_get_num"] : 0;
    $model2["bogus_click_num"] = isset($model["bogus_click_num"]) ? $model["bogus_click_num"] : 0;
    $model2["check_status"] = $model["check_status"];
    $model2["check_note"] = $model["check_note"];
    $model2["tel"] = $model["tel"];
    unset($model["activity_types"]);
    unset($model["token"]);
    unset($model["tmp_id"]);
    unset($model["title"]);
    unset($model["pic_url"]);
    unset($model["start_time"]);
    unset($model["end_time"]);
    unset($model["status"]);
    unset($model["updatetime"]);
    unset($model["bogus_join_num"]);
    unset($model["bogus_join_gender"]);
    unset($model["bogus_buy_num"]);
    unset($model["bogus_buy_gender"]);
    unset($model["bogus_repost_num"]);
    unset($model["bogus_get_num"]);
    unset($model["bogus_click_num"]);
    unset($model["check_status"]);
    unset($model["check_note"]);
    unset($model["tel"]);
    pdo_update("lywywl_ztb_obj_activity", $model2, array("id" => $id));
    pdo_update($table_name, $model, array("activity_id" => $id));
}
function insertActivity($table_name, $model)
{
    $model2["uniacid"] = $model["uniacid"];
    $model2["store_id"] = $model["store_id"];
    $model2["activity_types"] = $model["activity_types"];
    $model2["tmp_id"] = $model["tmp_id"];
    $model2["token"] = $model["token"];
    $model2["title"] = $model["title"];
    $model2["pic_url"] = $model["pic_url"];
    $model2["start_time"] = $model["start_time"];
    $model2["end_time"] = $model["end_time"];
    $model2["status"] = $model["status"];
    $model2["is_case"] = $model["is_case"];
    $model2["join_num"] = $model["join_num"];
    $model2["repost_num"] = $model["repost_num"];
    $model2["get_num"] = $model["get_num"];
    $model2["buy_num"] = $model["buy_num"];
    $model2["click_num"] = $model["click_num"];
    $model2["bogus_join_num"] = isset($model["bogus_join_num"]) ? $model["bogus_join_num"] : 0;
    $model2["bogus_join_gender"] = isset($model["bogus_join_gender"]) ? $model["bogus_join_gender"] : 0;
    $model2["bogus_buy_num"] = isset($model["bogus_buy_num"]) ? $model["bogus_buy_num"] : 0;
    $model2["bogus_buy_gender"] = isset($model["bogus_buy_gender"]) ? $model["bogus_buy_gender"] : 0;
    $model2["bogus_repost_num"] = isset($model["bogus_repost_num"]) ? $model["bogus_repost_num"] : 0;
    $model2["bogus_get_num"] = isset($model["bogus_get_num"]) ? $model["bogus_get_num"] : 0;
    $model2["bogus_click_num"] = isset($model["bogus_click_num"]) ? $model["bogus_click_num"] : 0;
    $model2["updatetime"] = $model["updatetime"];
    $model2["createtime"] = $model["createtime"];
    $model2["check_status"] = $model["check_status"];
    $model2["check_note"] = $model["check_note"];
    $model2["tel"] = $model["tel"];
    $model2["batches_join_code"] = substr(genToken(), 0, 6);
    unset($model["activity_types"]);
    unset($model["tmp_id"]);
    unset($model["token"]);
    unset($model["title"]);
    unset($model["pic_url"]);
    unset($model["start_time"]);
    unset($model["end_time"]);
    unset($model["status"]);
    unset($model["is_case"]);
    unset($model["join_num"]);
    unset($model["repost_num"]);
    unset($model["get_num"]);
    unset($model["buy_num"]);
    unset($model["click_num"]);
    unset($model["bogus_join_num"]);
    unset($model["bogus_join_gender"]);
    unset($model["bogus_buy_num"]);
    unset($model["bogus_buy_gender"]);
    unset($model["bogus_repost_num"]);
    unset($model["bogus_get_num"]);
    unset($model["bogus_click_num"]);
    unset($model["updatetime"]);
    unset($model["createtime"]);
    unset($model["check_status"]);
    unset($model["check_note"]);
    unset($model["tel"]);
    pdo_insert("lywywl_ztb_obj_activity", $model2);
    $model["activity_id"] = pdo_insertid();
    pdo_insert($table_name, $model);
    pdo_update(ztbTable("sys_tmp_data", false), array("use_num +=" => 1), array("tmp_id" => $model2["tmp_id"], "uniacid" => $model2["uniacid"]));
    return $model["activity_id"];
}
function insertCopyActivity($table_name, $model)
{
    $model2["uniacid"] = $model["uniacid"];
    $model2["store_id"] = $model["store_id"];
    $model2["activity_types"] = $model["activity_types"];
    $model2["tmp_id"] = $model["tmp_id"];
    $model2["token"] = $model["token"];
    $model2["title"] = $model["title"];
    $model2["pic_url"] = $model["pic_url"];
    $model2["start_time"] = $model["start_time"];
    $model2["end_time"] = $model["end_time"];
    $model2["status"] = $model["status"];
    $model2["is_case"] = $model["is_case"];
    $model2["join_num"] = $model["join_num"];
    $model2["repost_num"] = $model["repost_num"];
    $model2["get_num"] = $model["get_num"];
    $model2["buy_num"] = $model["buy_num"];
    $model2["click_num"] = $model["click_num"];
    $model2["bogus_join_num"] = isset($model["bogus_join_num"]) ? $model["bogus_join_num"] : 0;
    $model2["bogus_join_gender"] = isset($model["bogus_join_gender"]) ? $model["bogus_join_gender"] : 0;
    $model2["bogus_buy_num"] = isset($model["bogus_buy_num"]) ? $model["bogus_buy_num"] : 0;
    $model2["bogus_buy_gender"] = isset($model["bogus_buy_gender"]) ? $model["bogus_buy_gender"] : 0;
    $model2["bogus_repost_num"] = isset($model["bogus_repost_num"]) ? $model["bogus_repost_num"] : 0;
    $model2["bogus_get_num"] = isset($model["bogus_get_num"]) ? $model["bogus_get_num"] : 0;
    $model2["bogus_click_num"] = isset($model["bogus_click_num"]) ? $model["bogus_click_num"] : 0;
    $model2["updatetime"] = $model["updatetime"];
    $model2["createtime"] = $model["createtime"];
    $model2["check_status"] = $model["check_status"];
    $model2["check_note"] = $model["check_note"];
    $model2["tel"] = $model["tel"];
    $model2["batches_join_code"] = substr(genToken(), 0, 6);
    unset($model["activity_types"]);
    unset($model["tmp_id"]);
    unset($model["token"]);
    unset($model["title"]);
    unset($model["pic_url"]);
    unset($model["start_time"]);
    unset($model["end_time"]);
    unset($model["status"]);
    unset($model["is_case"]);
    unset($model["join_num"]);
    unset($model["repost_num"]);
    unset($model["get_num"]);
    unset($model["buy_num"]);
    unset($model["click_num"]);
    unset($model["bogus_join_num"]);
    unset($model["bogus_join_gender"]);
    unset($model["bogus_buy_num"]);
    unset($model["bogus_buy_gender"]);
    unset($model["bogus_repost_num"]);
    unset($model["bogus_get_num"]);
    unset($model["bogus_click_num"]);
    unset($model["updatetime"]);
    unset($model["createtime"]);
    unset($model["check_status"]);
    unset($model["check_note"]);
    unset($model["tel"]);
    pdo_insert("lywywl_ztb_obj_activity", $model2);
    $model["activity_id"] = pdo_insertid();
    pdo_insert($table_name, $model);
    pdo_update(ztbTable("sys_tmp_data", false), array("use_num +=" => 1), array("tmp_id" => $model2["tmp_id"], "uniacid" => $model2["uniacid"]));
    return $model["activity_id"];
}
function store_hash($passwordinput, $salt)
{
    $passwordinput = "{$passwordinput}-{$salt}";
    return sha1($passwordinput);
}
function getStoreConfig($uniacid, $store_id)
{
    $store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "uniacid" => $uniacid, "id" => $store_id));
    $set_config = iunserializer($store["config"]);
    $set_config["name"] = $store["name"];
    return $set_config;
}
function smsCkMobile($mobile, $sms_code, $token, $openid)
{
    if (empty($mobile)) {
        resultMsg(["status" => 0, "msg" => "请输入手机号码！"]);
    }
    if (!preg_match("/^(1[3,4,5,6,7,8,9]{1}\\d{9})\$/", $mobile)) {
        resultMsg(["status" => 0, "msg" => "手机号码格式错误！"]);
    }
    if (empty($sms_code)) {
        resultMsg(["status" => 0, "msg" => "请输入手机验证码！"]);
    }
    if (!preg_match("/^(\\d{6})\$/", $sms_code)) {
        resultMsg(["status" => 0, "msg" => "请输入六位数字验证码！"]);
    }
    session_start();
    $session_name = "public_sendObjSms_code_" . $token . "_" . $openid;
    $code = $_SESSION[$session_name];
    if (empty($code)) {
        resultMsg(["status" => 0, "msg" => "验证码未发送或已过期，请重新发送！"]);
    }
    $code_arr = explode(",", $code);
    if (is_array($code_arr)) {
        if ($mobile == $code_arr[0]) {
            if ($sms_code == $code_arr[1]) {
                if (time() - $code_arr[2] <= 600) {
                    unset($_SESSION[$session_name]);
                } else {
                    resultMsg(["status" => 0, "msg" => "验证码已过期，请重新发送！"]);
                }
            } else {
                resultMsg(["status" => 0, "msg" => "验证码填写错误！"]);
            }
        } else {
            resultMsg(["status" => 0, "msg" => "验证码未发送或已过期，请重新发送！"]);
        }
    } else {
        resultMsg(["status" => 0, "msg" => "验证码未发送或已过期，请重新发送！"]);
    }
    unset($mobile);
    unset($sms_code);
    unset($session_name);
    unset($code);
    unset($code_arr);
    return true;
}
function Convert_BD09_To_GCJ02($lat, $lng)
{
    $x_pi = 3.141592653589793 * 3000.0 / 180.0;
    $x = $lng - 0.0065;
    $y = $lat - 0.006;
    $z = sqrt($x * $x + $y * $y) - 2.0E-5 * sin($y * $x_pi);
    $theta = atan2($y, $x) - 3.0E-6 * cos($x * $x_pi);
    $lng = $z * cos($theta);
    $lat = $z * sin($theta);
    return array("lng" => $lng, "lat" => $lat);
}
function get_random_cut_rule($cur_val, $rules)
{
    if (empty($cur_val) || empty($rules)) {
        return 0;
    }
    $rule_key = 0;
    if (is_array($rules)) {
        foreach ($rules as $key => $value) {
            if (!($cur_val <= $value["price"])) {
                break;
            }
            $rule_key = $key;
        }
    }
    if ($rules[$rule_key]["min"] > $rules[$rule_key]["max"]) {
        $temp = $rules[$rule_key]["min"];
        $rules[$rule_key]["min"] = $rules[$rule_key]["max"];
        $rules[$rule_key]["max"] = $temp;
    }
    $rules[$rule_key]["money"] = mt_rand($rules[$rule_key]["min"] * 100, $rules[$rule_key]["max"] * 100) / 100;
    return $rules[$rule_key];
}
function setCache($key, $con, $time = 0)
{
    $key = "lywywl_ztb_cache_" . $key;
    if (!is_error(redis())) {
        if (redisGet($key) != 2) {
            return redisSet($key, $con, $time);
        } else {
            return false;
        }
    } else {
        $path = getCachePath($key);
        return file_put_contents($path, $con);
    }
}
function getCache($key, $time = 0)
{
    $key = "lywywl_ztb_cache_" . $key;
    if (!is_error(redis())) {
        return redisGet($key);
    } else {
        $path = getCachePath($key);
        if (!is_file($path)) {
            return false;
        }
        if ($time && filemtime($path) + $time < time()) {
            unlink($path);
            return false;
        }
        return file_get_contents($path);
    }
}
function getCachePath($key)
{
    load()->func("file");
    $key = md5($key);
    $keyDir = MODULE_ROOT . "/resource/cache/" . $key . "/";
    mkdirs($keyDir);
    return $keyDir . $key;
}
function redis()
{
    global $_W;
    static $redis;
    if (is_null($redis)) {
        if (!extension_loaded("redis")) {
            return error(-1, "PHP 未安装 redis 扩展");
        }
        if (!isset($_W["config"]["setting"]["redis"])) {
            return error(-1, "未配置 redis, 请检查站点目录 data/config.php 中参数设置");
        }
        $config = $_W["config"]["setting"]["redis"];
        if (empty($config["server"])) {
            $config["server"] = "127.0.0.1";
        }
        if (empty($config["port"])) {
            $config["port"] = "6379";
        }
        $redis_temp = new Redis();
        try {
            if ($config["pconnect"]) {
                $connect = $redis_temp->pconnect($config["server"], $config["port"], $config["timeout"]);
            } else {
                $connect = $redis_temp->connect($config["server"], $config["port"], $config["timeout"]);
            }
            if (!$connect) {
                return error(-1, "redis 连接失败, 请检查 data/config.php 中参数设置");
            }
            if (!empty($config["auth"])) {
                $auth = $redis_temp->auth($config["auth"]);
            }
        } catch (Exception $e) {
            return error(-1, "redis连接失败，错误信息：" . $e->getMessage());
        }
        if (!empty($config["requirepass"])) {
            $redis_temp->auth($config["requirepass"]);
        }
        try {
            $ping = $redis_temp->ping();
        } catch (Exception $e) {
            return error(-1, "redis 无法正常工作，请检查 redis 服务");
        }
        if ($ping != "+PONG") {
            return error(-1, "redis 无法正常工作，请检查 redis 服务");
        }
        $redis = $redis_temp;
    } else {
        try {
            $ping = $redis->ping();
        } catch (Exception $e) {
            goto SZW1k;
            FEp1l:
            $redis = redis();
            goto kZq_V;
            SZW1k:
            $redis = NULL;
            goto FEp1l;
            kZq_V:
            $ping = $redis->ping();
            goto J1QwL;
            J1QwL:
        }
        if ($ping != "+PONG") {
            $redis = NULL;
            $redis = redis();
        }
    }
    return $redis;
}
function redisSet($key, $value, $expire = 0)
{
    if (!$key || !$value) {
        return false;
    }
    $redis = redis();
    $value = is_array($value) ? json_encode($value) : $value;
    return $expire > 0 ? $redis->setex(getenv("REDIS_PREFIX") . $key, $expire, $value) : $redis->set(getenv("REDIS_PREFIX") . $key, $value);
}
function redisGet($key)
{
    $redis = redis();
    $result = $redis->get(getenv("REDIS_PREFIX") . $key);
    return is_null(json_decode($result)) ? $result : json_decode($result, true);
}
function fileLock($key)
{
    include_once MODULE_ROOT . "/inc/class/FileLock.class.php";
    static $fileLock;
    if (is_null($fileLock)) {
        $fileLock = new FileLock($key);
    }
    return $fileLock;
}
function thread_lock($key)
{
    $key = "lywywl_ztb" . $key;
    if (!is_error(redis())) {
        $redis = redis();
        $key = getenv("REDIS_PREFIX") . $key;
        if ($redis->incr($key) == 1) {
            $redis->expire($key, 90);
            return true;
        } else {
            return false;
        }
    } else {
        $lock = fileLock($key);
        return $lock->lock(false);
    }
}
function thread_unlock($key)
{
    $key = "lywywl_ztb" . $key;
    if (!is_error(redis())) {
        $redis = redis();
        $key = getenv("REDIS_PREFIX") . $key;
        $redis->setex($key, 90, 0);
    } else {
        $lock = fileLock($key);
        $lock->unlock();
    }
}
function create_activity_location($arr, $type = 0)
{
    if ($type == 0) {
        pdo_delete("lywywl_ztb_obj_activity_location", array("activity_id" => $arr["activity_id"], "uniacid" => $arr["uniacid"], "store_id" => $arr["store_id"]));
    } else {
        pdo_delete("lywywl_ztb_obj_activity_location", array("activity_id" => $arr["activity_id"], "uniacid" => $arr["uniacid"], "store_id" => $arr["store_id"], "other_store_id" => $arr["other_store_id"]));
    }
    $temp_store_map = iunserializer($arr["store_map_list"]);
    foreach ($temp_store_map as $value) {
        $temp_store_map_data = array("tmp_id" => $arr["tmp_id"], "activity_id" => $arr["activity_id"], "activity_types" => $arr["activity_types"], "activity_check_status" => $arr["activity_check_status"], "uniacid" => $arr["uniacid"], "store_id" => $arr["store_id"], "activity_status" => $arr["activity_status"], "shop_name" => $value["name"], "shop_address" => $value["address"], "shop_tel" => $value["tel"], "other_store_id" => $arr["other_store_id"], "lat" => $value["lat"], "lng" => $value["lng"], "start_time" => $arr["start_time"], "end_time" => $arr["end_time"], "createtime" => TIMESTAMP);
        $id = pdo_insert("lywywl_ztb_obj_activity_location", $temp_store_map_data);
    }
}
function distance_convert($value)
{
    if (intval($value) < 500) {
        return "<500m";
    } else {
        if (intval($value) >= 1000) {
            return round(intval($value) / 1000, 1) . "km";
        } else {
            return $value . "m";
        }
    }
}
function utf8_strcut($str, $start, $length = null)
{
    preg_match_all("/./us", $str, $match);
    $chars = is_null($length) ? array_slice($match[0], $start) : array_slice($match[0], $start, $length);
    unset($str);
    return implode('', $chars);
}
function checkAuthStatus($uniacid, $iscount)
{
    return true;
    load()->func("file");
    if (file_exists(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt")) {
        $fileContent = file_get_contents(MODULE_ROOT . "/resource/auth/validate" . $uniacid . ".txt");
        $fileArr = explode(",", $fileContent);
        $types = intval($fileArr[5]);
        if ($types == 2) {
            if ($iscount) {
                $storeTotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("store_account") . " where `uniacid`=:uniacid and `deltime`=0 ", array(":uniacid" => $uniacid));
                if ($storeTotal > 5) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    } else {
        return false;
    }
}
function answerDataToStr($answer_data)
{
    if (empty($answer_data)) {
        return '';
    } else {
        $retrunStr = '';
        foreach ($answer_data as $value) {
            $retrunStr .= $value["question"] . ":" . $value["answer"] . " ";
        }
        return $retrunStr;
    }
}
function msToSecTime($interval, $ms)
{
    if ($interval == 1) {
        $sec = intval($ms / 1000);
        $mss = intval($ms % 1000 / 100);
        $sec = $sec < 10 ? "0" . $sec : $sec;
        return $sec . "." . $mss;
    } else {
        if ($interval == 2) {
            $sec = intval($ms / 1000);
            $mss = intval($ms % 1000 / 10);
            $sec = $sec < 10 ? "0" . $sec : $sec;
            $mss = $mss < 10 ? "0" . $mss : $mss;
            return $sec . "." . $mss;
        } else {
            $sec = intval($ms / 1000);
            $mss = intval($ms % 1000);
            $sec = $sec < 10 ? "0" . $sec : $sec;
            return $sec . "." . $mss;
        }
    }
}
function storeInviteBusiness($store, $setmeal, $config)
{
    global $_W;
    $uniacid = $store["uniacid"];
    $store_id = $store["id"];
    $rec_storeid = intval($store["rec_storeid"]);
    $parent_rec_storeid = intval($store["parent_rec_storeid"]);
    $promoter_id = intval($store["promoter_id"]);
    $parent_promoter_id = intval($store["parent_promoter_id"]);
    $setmeal_id = $setmeal["id"];
    $invite_rebate_money = floatval($setmeal["invite_rebate_money"]);
    $invite_rebate2_money = floatval($setmeal["invite_rebate2_money"]);
    if ($rec_storeid > 0) {
        $rec_store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid));
        if ($rec_store) {
            if ($rec_store["is_invite"] == 1) {
                pdo_insert("lywywl_ztb_store_invite", array("uniacid" => $uniacid, "store_id" => $rec_storeid, "promoter_id" => 0, "invite_storeid" => $store_id, "setmeal_id" => $setmeal_id, "money" => $invite_rebate_money, "or_rebate2" => 0, "status" => 0, "note" => "【{$store["name"]}】购买套餐：{$setmeal["name"]}，【{$rec_store["name"]}】获得一级返利金额：{$invite_rebate_money}元", "createtime" => time()));
                $invite_id = pdo_insertid();
                pdo_update("lywywl_ztb_store_account", array("money +=" => $invite_rebate_money, "invite_money +=" => $invite_rebate_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid));
                pdo_insert("lywywl_ztb_store_bill", array("uniacid" => $uniacid, "store_id" => $rec_storeid, "types" => 13, "detail_id" => $invite_id, "money" => $invite_rebate_money, "balance" => pdo_getcolumn("lywywl_ztb_store_account", array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid), "money"), "note" => "商家分销返利：" . date("Y-m-d H:i:s", time()) . " 商家【{$store["name"]}】购买套餐：{$setmeal["name"]}，获得一级返利：{$invite_rebate_money}元", "createtime" => time()));
                if ($promoter_id > 0) {
                    $promoter = pdo_get("lywywl_ztb_store_promoter", array("deltime" => 0, "id" => $promoter_id, "uniacid" => $uniacid));
                    if ($promoter && $promoter["store_id"] == $rec_storeid) {
                        $royalty_money = $invite_rebate_money * (intval($promoter["royalty"]) / 100);
                        if (intval($promoter["status"]) == 0) {
                            pdo_update("lywywl_ztb_store_invite", array("promoter_id" => $promoter["id"]), array("id" => $invite_id));
                            pdo_update("lywywl_ztb_store_promoter", array("invite_money +=" => $royalty_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $promoter_id, "uniacid" => $uniacid));
                        } else {
                            $rec_store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid));
                            if ($rec_store["money"] >= $royalty_money) {
                                pdo_update("lywywl_ztb_store_account", array("money -=" => $royalty_money), array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid));
                                pdo_insert("lywywl_ztb_store_bill", array("uniacid" => $uniacid, "store_id" => $rec_storeid, "types" => 14, "detail_id" => $invite_id, "money" => $royalty_money, "balance" => pdo_getcolumn("lywywl_ztb_store_account", array("deltime" => 0, "id" => $rec_storeid, "uniacid" => $uniacid), "money"), "note" => "业务分销返利：" . date("Y-m-d H:i:s", time()) . " 【{$rec_store["name"]}】下业务员【{$promoter["name"]}】获得商家分销一级返利：{$invite_rebate_money}*{$promoter["royalty"]}% = {$royalty_money}元", "createtime" => time()));
                                $result = sendWeixinMchPay($promoter["openid"], $royalty_money * 100, "邀请商家返利", true, $uniacid, $config);
                                if (!($result === true)) {
                                    $sysReissueModel = array();
                                    $sysReissueModel["uniacid"] = $uniacid;
                                    $sysReissueModel["store_id"] = $rec_storeid;
                                    $sysReissueModel["activity_types"] = 0;
                                    $sysReissueModel["activity_id"] = 0;
                                    $sysReissueModel["draw_id"] = 0;
                                    $sysReissueModel["types"] = 3;
                                    $sysReissueModel["openid"] = $promoter["openid"];
                                    $sysReissueModel["nickname"] = $promoter["name"];
                                    $sysReissueModel["headurl"] = $promoter["headurl"];
                                    $sysReissueModel["status"] = 0;
                                    $sysReissueModel["money"] = $royalty_money;
                                    $sysReissueModel["desc"] = "邀请商家返利_{$invite_id}";
                                    $sysReissueModel["is_store_sell"] = 1;
                                    $sysReissueModel["updatetime"] = time();
                                    $sysReissueModel["createtime"] = time();
                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                }
                            } else {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $uniacid;
                                $sysReissueModel["store_id"] = $rec_storeid;
                                $sysReissueModel["activity_types"] = 0;
                                $sysReissueModel["activity_id"] = 0;
                                $sysReissueModel["draw_id"] = 0;
                                $sysReissueModel["types"] = 3;
                                $sysReissueModel["openid"] = $promoter["openid"];
                                $sysReissueModel["nickname"] = $promoter["name"];
                                $sysReissueModel["headurl"] = $promoter["headurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $royalty_money;
                                $sysReissueModel["desc"] = "邀请商家返利_{$invite_id}";
                                $sysReissueModel["is_store_sell"] = 0;
                                $sysReissueModel["updatetime"] = time();
                                $sysReissueModel["createtime"] = time();
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            }
                            pdo_update("lywywl_ztb_store_invite", array("promoter_id" => $promoter["id"], "status" => 1, "note" => "【{$store["name"]}】购买套餐：{$setmeal["name"]}，【{$rec_store["name"]}】下业务员【{$promoter["name"]}】获得一级返利金额：{$invite_rebate_money}*{$promoter["royalty"]}% = {$royalty_money}元"), array("id" => $invite_id));
                            pdo_update("lywywl_ztb_store_promoter", array("invite_money +=" => $royalty_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $promoter_id, "uniacid" => $uniacid));
                            $promoter_pushtmp = getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "promoter_pushtmp");
                            if ($promoter["openid"] && $promoter_pushtmp) {
                                if (isFollow($promoter["openid"], $uniacid)) {
                                    $postdata = array("first" => array("value" => "恭喜您，一笔佣金结算成功", "color" => "#173177"), "keyword1" => array("value" => $store["name"], "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i", time()), "color" => "#173177"), "keyword3" => array("value" => "下级商家购买套餐获得佣金", "color" => "#173177"), "keyword4" => array("value" => "商家分销 一级返佣 比例" . $promoter["royalty"] . "%", "color" => "#173177"), "keyword5" => array("value" => $royalty_money, "color" => "#173177"), "remark" => array("value" => "点击详情，可以看一看TA", "color" => "#173177"));
                                    $template_id = $promoter_pushtmp;
                                    $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=user.admins_storeinvite&m=lywywl_ztb&store_id={$promoter["store_id"]}";
                                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                                    $result = sendTplNotice($uniacid, $promoter["openid"], $postdata, $template_id, $url);
                                }
                            }
                            if ($config["rebatepushtmp_sub"] && $promoter["openid"]) {
                                $touser = $promoter["openid"];
                                $template_id = $config["rebatepushtmp_sub"];
                                $postdata = array("thing1" => array("value" => $store["name"]), "thing6" => array("value" => "下级商家购买套餐获得佣金"), "amount4" => array("value" => $royalty_money), "date3" => array("value" => date("Y-m-d H:i", time())), "thing7" => array("value" => "商家分销 一级返佣 比例" . $promoter["royalty"] . "%"));
                                $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=user.admins_storeinvite&m=lywywl_ztb&store_id={$promoter["store_id"]}";
                                $url = replaceDieDomain($config, $url, 0, 0, 0);
                                $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                            }
                        }
                    }
                }
                $rebate_pushtmp = getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "rebate_pushtmp");
                if ($rec_store["openid"] && $rebate_pushtmp) {
                    if (isFollow($rec_store["openid"], $uniacid)) {
                        $postdata = array("first" => array("value" => "恭喜您，一笔佣金结算成功", "color" => "#173177"), "keyword1" => array("value" => $store["name"], "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i", time()), "color" => "#173177"), "keyword3" => array("value" => "下级商家购买套餐获得佣金", "color" => "#173177"), "keyword4" => array("value" => "商家分销 一级返佣", "color" => "#173177"), "keyword5" => array("value" => $invite_rebate_money, "color" => "#173177"), "remark" => array("value" => "点击详情，可以看一看TA", "color" => "#173177"));
                        $template_id = $rebate_pushtmp;
                        $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.invite_center&m=lywywl_ztb";
                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                        $result = sendTplNotice($uniacid, $rec_store["openid"], $postdata, $template_id, $url);
                    }
                }
                if ($config["rebatepushtmp_sub"] && $rec_store["openid"]) {
                    $touser = $rec_store["openid"];
                    $template_id = $config["rebatepushtmp_sub"];
                    $postdata = array("thing1" => array("value" => $store["name"]), "thing6" => array("value" => "下级商家购买套餐获得佣金"), "amount4" => array("value" => $invite_rebate_money), "date3" => array("value" => date("Y-m-d H:i", time())), "thing7" => array("value" => "商家分销 一级返佣"));
                    $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                    $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.invite_center&m=lywywl_ztb";
                    $url = replaceDieDomain($config, $url, 0, 0, 0);
                    $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                }
                $or_open_rebate2 = getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "or_open_rebate2");
                if ($or_open_rebate2 && $parent_rec_storeid > 0) {
                    $parent_rec_store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid));
                    if ($parent_rec_store) {
                        pdo_insert("lywywl_ztb_store_invite", array("uniacid" => $uniacid, "store_id" => $parent_rec_storeid, "promoter_id" => 0, "invite_storeid" => $store_id, "setmeal_id" => $setmeal_id, "money" => $invite_rebate2_money, "or_rebate2" => 1, "status" => 0, "note" => "【{$store["name"]}】购买套餐：{$setmeal["name"]}，【{$parent_rec_store["name"]}】获得二级返利金额：{$invite_rebate2_money}元", "createtime" => time()));
                        $invite_id = pdo_insertid();
                        pdo_update("lywywl_ztb_store_account", array("money +=" => $invite_rebate2_money, "invite_money +=" => $invite_rebate2_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid));
                        pdo_insert("lywywl_ztb_store_bill", array("uniacid" => $uniacid, "store_id" => $parent_rec_storeid, "types" => 13, "detail_id" => $invite_id, "money" => $invite_rebate2_money, "balance" => pdo_getcolumn("lywywl_ztb_store_account", array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid), "money"), "note" => "商家分销返利：" . date("Y-m-d H:i:s", time()) . " 商家【{$store["name"]}】购买套餐：{$setmeal["name"]}，获得二级返利：{$invite_rebate2_money}元", "createtime" => time()));
                        if ($parent_promoter_id > 0) {
                            $parent_promoter = pdo_get("lywywl_ztb_store_promoter", array("deltime" => 0, "id" => $parent_promoter_id, "uniacid" => $uniacid));
                            if ($parent_promoter && $parent_promoter["store_id"] == $parent_rec_storeid) {
                                $parent_royalty_money = $invite_rebate2_money * (intval($parent_promoter["royalty"]) / 100);
                                if (intval($parent_promoter["status"]) == 0) {
                                    pdo_update("lywywl_ztb_store_invite", array("promoter_id" => $parent_promoter["id"]), array("id" => $invite_id));
                                    pdo_update("lywywl_ztb_store_promoter", array("invite_money +=" => $parent_royalty_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $parent_promoter_id, "uniacid" => $uniacid));
                                } else {
                                    $parent_rec_store = pdo_get("lywywl_ztb_store_account", array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid));
                                    if ($parent_rec_store["money"] >= $parent_royalty_money) {
                                        pdo_update("lywywl_ztb_store_account", array("money -=" => $parent_royalty_money), array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid));
                                        pdo_insert("lywywl_ztb_store_bill", array("uniacid" => $uniacid, "store_id" => $parent_rec_storeid, "types" => 14, "detail_id" => $invite_id, "money" => $parent_royalty_money, "balance" => pdo_getcolumn("lywywl_ztb_store_account", array("deltime" => 0, "id" => $parent_rec_storeid, "uniacid" => $uniacid), "money"), "note" => "业务分销返利：" . date("Y-m-d H:i:s", time()) . " 【{$parent_rec_store["name"]}】下业务员【{$parent_promoter["name"]}】获得商家分销二级返利：{$invite_rebate2_money} * {$parent_promoter["royalty"]}% = {$parent_royalty_money}元", "createtime" => time()));
                                        $result = sendWeixinMchPay($parent_promoter["openid"], $parent_royalty_money * 100, "邀请商家返利", true, $uniacid, $config);
                                        if (!($result === true)) {
                                            $sysReissueModel = array();
                                            $sysReissueModel["uniacid"] = $uniacid;
                                            $sysReissueModel["store_id"] = $parent_rec_storeid;
                                            $sysReissueModel["activity_types"] = 0;
                                            $sysReissueModel["activity_id"] = 0;
                                            $sysReissueModel["draw_id"] = 0;
                                            $sysReissueModel["types"] = 3;
                                            $sysReissueModel["openid"] = $parent_promoter["openid"];
                                            $sysReissueModel["nickname"] = $parent_promoter["name"];
                                            $sysReissueModel["headurl"] = $parent_promoter["headurl"];
                                            $sysReissueModel["status"] = 0;
                                            $sysReissueModel["money"] = $parent_royalty_money;
                                            $sysReissueModel["desc"] = "邀请商家返利_{$invite_id}";
                                            $sysReissueModel["is_store_sell"] = 1;
                                            $sysReissueModel["updatetime"] = time();
                                            $sysReissueModel["createtime"] = time();
                                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                        }
                                    } else {
                                        $sysReissueModel = array();
                                        $sysReissueModel["uniacid"] = $uniacid;
                                        $sysReissueModel["store_id"] = $parent_rec_storeid;
                                        $sysReissueModel["activity_types"] = 0;
                                        $sysReissueModel["activity_id"] = 0;
                                        $sysReissueModel["draw_id"] = 0;
                                        $sysReissueModel["types"] = 3;
                                        $sysReissueModel["openid"] = $parent_promoter["openid"];
                                        $sysReissueModel["nickname"] = $parent_promoter["name"];
                                        $sysReissueModel["headurl"] = $parent_promoter["headurl"];
                                        $sysReissueModel["status"] = 0;
                                        $sysReissueModel["money"] = $parent_royalty_money;
                                        $sysReissueModel["desc"] = "邀请商家返利_{$invite_id}";
                                        $sysReissueModel["is_store_sell"] = 0;
                                        $sysReissueModel["updatetime"] = time();
                                        $sysReissueModel["createtime"] = time();
                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                    }
                                    pdo_update("lywywl_ztb_store_invite", array("promoter_id" => $parent_promoter["id"], "status" => 1, "note" => "【{$store["name"]}】购买套餐：{$setmeal["name"]}，【{$parent_rec_store["name"]}】下业务员【{$parent_promoter["name"]}】获得二级返利金额：{$invite_rebate2_money} * {$parent_promoter["royalty"]}% = {$parent_royalty_money}元"), array("id" => $invite_id));
                                    pdo_update("lywywl_ztb_store_promoter", array("invite_money +=" => $parent_royalty_money, "invite_count +=" => 1), array("deltime" => 0, "id" => $parent_promoter_id, "uniacid" => $uniacid));
                                    $promoter_pushtmp = getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "promoter_pushtmp");
                                    if ($parent_promoter["openid"] && $promoter_pushtmp) {
                                        if (isFollow($parent_promoter["openid"], $uniacid)) {
                                            $postdata = array("first" => array("value" => "恭喜您，一笔佣金结算成功", "color" => "#173177"), "keyword1" => array("value" => $store["name"], "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i", time()), "color" => "#173177"), "keyword3" => array("value" => "下级商家购买套餐获得佣金", "color" => "#173177"), "keyword4" => array("value" => "商家分销 二级返佣 比例" . $parent_promoter["royalty"] . "%", "color" => "#173177"), "keyword5" => array("value" => $parent_royalty_money, "color" => "#173177"), "remark" => array("value" => "点击详情，可以看一看TA", "color" => "#173177"));
                                            $template_id = $promoter_pushtmp;
                                            $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=user.admins_storeinvite&m=lywywl_ztb&store_id={$parent_promoter["store_id"]}";
                                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                                            $result = sendTplNotice($uniacid, $parent_promoter["openid"], $postdata, $template_id, $url);
                                        }
                                    }
                                    if ($config["rebatepushtmp_sub"] && $parent_promoter["openid"]) {
                                        $touser = $parent_promoter["openid"];
                                        $template_id = $config["rebatepushtmp_sub"];
                                        $postdata = array("thing1" => array("value" => $store["name"]), "thing6" => array("value" => "下级商家购买套餐获得佣金"), "amount4" => array("value" => $parent_royalty_money), "date3" => array("value" => date("Y-m-d H:i", time())), "thing7" => array("value" => "商家分销 二级返佣 比例" . $parent_promoter["royalty"] . "%"));
                                        $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                                        $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=user.admins_storeinvite&m=lywywl_ztb&store_id={$parent_promoter["store_id"]}";
                                        $url = replaceDieDomain($config, $url, 0, 0, 0);
                                        $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                                    }
                                }
                            }
                        }
                        $rebate_pushtmp = getPluginConfig($uniacid, "lywywl_ztb_plugin_storeinvite", "rebate_pushtmp");
                        if ($parent_rec_store["openid"] && $rebate_pushtmp) {
                            if (isFollow($parent_rec_store["openid"], $uniacid)) {
                                $postdata = array("first" => array("value" => "恭喜您，一笔佣金结算成功", "color" => "#173177"), "keyword1" => array("value" => $store["name"], "color" => "#173177"), "keyword2" => array("value" => date("Y-m-d H:i", time()), "color" => "#173177"), "keyword3" => array("value" => "下级商家购买套餐获得佣金", "color" => "#173177"), "keyword4" => array("value" => "商家分销 二级返佣", "color" => "#173177"), "keyword5" => array("value" => $invite_rebate2_money, "color" => "#173177"), "remark" => array("value" => "点击详情，可以看一看TA", "color" => "#173177"));
                                $template_id = $rebate_pushtmp;
                                $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                                $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.invite_center&m=lywywl_ztb";
                                $url = replaceDieDomain($config, $url, 0, 0, 0);
                                $result = sendTplNotice($uniacid, $parent_rec_store["openid"], $postdata, $template_id, $url);
                            }
                        }
                        if ($config["rebatepushtmp_sub"] && $parent_rec_store["openid"]) {
                            $touser = $parent_rec_store["openid"];
                            $template_id = $config["rebatepushtmp_sub"];
                            $postdata = array("thing1" => array("value" => $store["name"]), "thing6" => array("value" => "下级商家购买套餐获得佣金"), "amount4" => array("value" => $invite_rebate2_money), "date3" => array("value" => date("Y-m-d H:i", time())), "thing7" => array("value" => "商家分销 二级返佣"));
                            $domain = str_replace("/addons/lywywl_ztb/", '', $_W["siteroot"]);
                            $url = "{$domain}/app/index.php?i={$uniacid}&c=entry&act=index&do=store.invite_center&m=lywywl_ztb";
                            $url = replaceDieDomain($config, $url, 0, 0, 0);
                            $result = sendWeixinTemplate($touser, $template_id, $postdata, $url);
                        }
                    }
                }
            }
        }
    }
}
function cut_write_Off($uniacid, $aid, $openid, $config)
{
    $activity_types = 15;
    $activity = pdo_get(ztbNopreTable("obj_activity"), array("deltime" => 0, "uniacid" => $uniacid, "id" => $aid));
    $object = pdo_get(ztbNopreTable("obj_cut"), array("deltime" => 0, "activity_id" => $activity["id"]));
    if ($object["models"] != 0 || $object["is_offline_pay"] != 1) {
        return;
    }
    $store_id = $activity["store_id"];
    $join_model = pdo_get(ztbNopreTable("obj_cut_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    $joinModel = pdo_get(ztbNopreTable("obj_cut_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_model["pid"], "deltime" => 0));
    $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "deltime" => 0));
    $origin_id = $join_model["origin_id"];
    if (!empty($origin_id)) {
        $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $activity["id"], "uniacid" => $uniacid));
    }
    if (!empty($joinModel)) {
        if ($joinModel["openid"] != $openid) {
            pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $joinModel["id"]));
            $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $joinModel["openid"]));
            if (isset($object["or_open_rebate2"])) {
                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 0), array(), '', "sort asc");
            } else {
                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array(), '', "sort asc");
            }
            if (!empty($prizeList)) {
                $prizeModel = null;
                foreach ($prizeList as $key => $val) {
                    if (!(intval($val["surplus"]) <= 0)) {
                        if (!(intval($val["odds"]) <= 0)) {
                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                    if (!($count >= intval($val["limitnum"]))) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                    }
                                }
                            } else {
                                $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                                if (!($count >= intval($val["limitnum"]))) {
                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                        if (!($count >= intval($val["limitnum"]))) {
                                            $arr[$key] = $val["odds"];
                                        } else {
                                        }
                                    }
                                } else {
                                }
                            }
                        } else {
                        }
                    } else {
                    }
                }
                if (empty($prizeModel) && !empty($arr)) {
                    $rid = getRand($arr);
                    $prizeModel = $prizeList[$rid];
                }
                if (!empty($prizeModel)) {
                    $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $joinModel["register_data"], "updatetime" => time(), "createtime" => time());
                    $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
                    $writecode = '';
                    if (!empty($result)) {
                        $draw_id = pdo_insertid();
                        $hashids = Hashids::instance(6, "lywyztb", '');
                        $encode_id = $hashids->encode($draw_id);
                        $join_draw_data = array("writecode" => $encode_id);
                        pdo_update(ztbNopreTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
                        $writecode = $encode_id;
                    }
                    if (intval($prizeModel["types"]) == 1) {
                        if (intval($prizeModel["create_types"]) == 1) {
                            list($min, $max) = explode("-", $prizeModel["score"]);
                            $prizeModel["score"] = mt_rand($min, $max);
                        }
                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"] . "个";
                        pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("id" => $joinUserModel["id"]));
                        $userScoreModel = array();
                        $userScoreModel["uniacid"] = $uniacid;
                        $userScoreModel["store_id"] = $store_id;
                        $userScoreModel["openid"] = $joinUserModel["openid"];
                        $userScoreModel["nickname"] = $joinUserModel["nickname"];
                        $userScoreModel["headurl"] = $joinUserModel["headurl"];
                        $userScoreModel["types"] = 1;
                        $userScoreModel["activity_types"] = $activity_types;
                        $userScoreModel["detail_id"] = $draw_id;
                        $userScoreModel["score"] = $prizeModel["score"];
                        $userScoreModel["note"] = $note;
                        $userScoreModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                        pdo_update(ztbNopreTable("user_draw"), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                    } else {
                        if (intval($prizeModel["types"]) == 2) {
                            if (intval($prizeModel["create_types"]) == 1) {
                                list($min, $max) = explode("-", $prizeModel["sys"]);
                                $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                            }
                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                            if ($storeModel["money"] >= $prizeModel["sys"]) {
                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $joinUserModel["id"]));
                                $userBillModel = array();
                                $userBillModel["uniacid"] = $uniacid;
                                $userBillModel["store_id"] = $store_id;
                                $userBillModel["openid"] = $joinUserModel["openid"];
                                $userBillModel["nickname"] = $joinUserModel["nickname"];
                                $userBillModel["headurl"] = $joinUserModel["headurl"];
                                $userBillModel["types"] = 3;
                                $userBillModel["detail_id"] = $draw_id;
                                $userBillModel["money"] = $prizeModel["sys"];
                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                                $userBillModel["note"] = $note;
                                $userBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
                                $storeBillModel = array();
                                $storeBillModel["uniacid"] = $uniacid;
                                $storeBillModel["store_id"] = $store_id;
                                $storeBillModel["types"] = 11;
                                $storeBillModel["detail_id"] = $draw_id;
                                $storeBillModel["money"] = $prizeModel["sys"];
                                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                $storeBillModel["note"] = $note;
                                $storeBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                            } else {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                $sysReissueModel["draw_id"] = $draw_id;
                                $sysReissueModel["types"] = 2;
                                $sysReissueModel["openid"] = $joinUserModel["openid"];
                                $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $prizeModel["sys"];
                                $sysReissueModel["desc"] = $prizeModel["name"];
                                $sysReissueModel["is_store_sell"] = 0;
                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                $sysReissueModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            }
                            pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                            pdo_update(ztbTable("obj_cut_join", false), array("money +=" => floatval($prizeModel["sys"])), array("id" => $joinModel["id"]));
                        } else {
                            if (intval($prizeModel["types"]) == 3) {
                                if (intval($prizeModel["create_types"]) == 1) {
                                    list($min, $max) = explode("-", $prizeModel["money"]);
                                    $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                                }
                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                if ($storeModel["money"] >= $prizeModel["money"]) {
                                    pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["money"])), array("id" => $store_id));
                                    $storeBillModel = array();
                                    $storeBillModel["uniacid"] = $uniacid;
                                    $storeBillModel["store_id"] = $store_id;
                                    $storeBillModel["types"] = 11;
                                    $storeBillModel["detail_id"] = $draw_id;
                                    $storeBillModel["money"] = $prizeModel["money"];
                                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                    $storeBillModel["note"] = $note;
                                    $storeBillModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                    $result = sendWeixinMchPay($joinUserModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                                    if (!($result === true)) {
                                        $sysReissueModel = array();
                                        $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                        $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                        $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                        $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                        $sysReissueModel["draw_id"] = $draw_id;
                                        $sysReissueModel["types"] = 1;
                                        $sysReissueModel["openid"] = $joinUserModel["openid"];
                                        $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                        $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                        $sysReissueModel["status"] = 0;
                                        $sysReissueModel["money"] = $prizeModel["money"];
                                        $sysReissueModel["desc"] = $prizeModel["name"];
                                        $sysReissueModel["is_store_sell"] = 1;
                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                    }
                                } else {
                                    $sysReissueModel = array();
                                    $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                    $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                    $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                    $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                    $sysReissueModel["draw_id"] = $draw_id;
                                    $sysReissueModel["types"] = 1;
                                    $sysReissueModel["openid"] = $joinUserModel["openid"];
                                    $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                    $sysReissueModel["headurl"] = $joinUserModel["headimgurl"];
                                    $sysReissueModel["status"] = 0;
                                    $sysReissueModel["money"] = $prizeModel["money"];
                                    $sysReissueModel["desc"] = $prizeModel["name"];
                                    $sysReissueModel["is_store_sell"] = 0;
                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                }
                                pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                pdo_update(ztbTable("obj_cut_join", false), array("money +=" => floatval($prizeModel["money"])), array("id" => $joinModel["id"]));
                            } else {
                                if (intval($prizeModel["types"]) == 5) {
                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                    if (!empty($storeCard)) {
                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                    }
                                }
                            }
                        }
                    }
                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                    }
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                    if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                        if (!empty($prizeModel["sms_tmp"])) {
                            if (!empty($joinUserModel["mobile"])) {
                                $sms_uid = $config["sms_uid"];
                                $sms_key = $config["sms_key"];
                                $mobile = $joinUserModel["mobile"];
                                $sms_content = $prizeModel["sms_tmp"];
                                $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                if (empty($storeModel["zucp_ext"])) {
                                    $sms_content .= "【{$config["name"]}】";
                                } else {
                                    $sms_content .= "【{$storeModel["name"]}】";
                                }
                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                if ($result === true) {
                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                }
                            }
                        }
                    } else {
                        if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                            if (!empty($object["draw_sms_tmp"])) {
                                if (!empty($joinUserModel["mobile"])) {
                                    $sms_uid = $config["sms_uid"];
                                    $sms_key = $config["sms_key"];
                                    $mobile = $joinUserModel["mobile"];
                                    $sms_content = $object["draw_sms_tmp"];
                                    $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                    $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                    if (empty($storeModel["zucp_ext"])) {
                                        $sms_content .= "【{$config["name"]}】";
                                    } else {
                                        $sms_content .= "【{$storeModel["name"]}】";
                                    }
                                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                    if ($result === true) {
                                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $plug_rebate2 = getPluginStatus($object["uniacid"], "lywywl_ztb_plugin_twoinvite");
        if ($plug_rebate2) {
            if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $activity["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                if (!empty($draw2Model)) {
                    $join2Model = pdo_get(ztbTable("obj_cut_join", false), array("uniacid" => $uniacid, "activity_id" => $activity["id"], "openid" => $draw2Model["openid"]));
                    if (!empty($join2Model)) {
                        if ($join2Model["openid"] != $openid && $join2Model["openid"] != $joinModel["openid"]) {
                            pdo_update(ztbTable("obj_cut_join", false), array("invite +=" => 1), array("id" => $join2Model["id"]));
                            $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $join2Model["openid"]));
                            $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                            if (!empty($prize2List)) {
                                $prize2Model = null;
                                foreach ($prize2List as $key => $val) {
                                    if (!(intval($val["surplus"]) <= 0)) {
                                        if (!(intval($val["odds"]) <= 0)) {
                                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                    $arr2[$key] = $val["odds"];
                                                } else {
                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                    if (!($count >= intval($val["limitnum"]))) {
                                                        $arr2[$key] = $val["odds"];
                                                    } else {
                                                    }
                                                }
                                            } else {
                                                $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $join2UserModel["openid"]), "count(*)");
                                                if (!($count >= intval($val["limitnum"]))) {
                                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                        $arr2[$key] = $val["odds"];
                                                    } else {
                                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                        if (!($count >= intval($val["limitnum"]))) {
                                                            $arr2[$key] = $val["odds"];
                                                        } else {
                                                        }
                                                    }
                                                } else {
                                                }
                                            }
                                        } else {
                                        }
                                    } else {
                                    }
                                }
                                if (empty($prize2Model) && !empty($arr2)) {
                                    $rid2 = getRand($arr2);
                                    $prize2Model = $prize2List[$rid2];
                                }
                                if (!empty($prize2Model)) {
                                    $join_draw_data2 = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prize2Model["id"], "types" => $prize2Model["types"], "name" => $prize2Model["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prize2Model["picurl"], "writeoff_types" => $prize2Model["writeoff_types"], "openid" => $join2UserModel["openid"], "nickname" => $join2UserModel["nickname"], "headurl" => $join2UserModel["headurl"], "register_data" => '', "or_rebate2" => 1, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                    $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data2);
                                    $writecode = '';
                                    if (!empty($result)) {
                                        $draw_id = pdo_insertid();
                                        $hashids = Hashids::instance(6, "lywyztb", '');
                                        $encode_id = $hashids->encode($draw_id);
                                        $join_draw_data2 = array("writecode" => $encode_id);
                                        pdo_update(ztbNopreTable("user_draw", false), $join_draw_data2, array("id" => $draw_id));
                                        $writecode = $encode_id;
                                    }
                                    if (intval($prize2Model["types"]) == 1) {
                                        if (intval($prize2Model["create_types"]) == 1) {
                                            list($min, $max) = explode("-", $prize2Model["score"]);
                                            $prize2Model["score"] = mt_rand($min, $max);
                                        }
                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prize2Model["score"];
                                        pdo_update(ztbNopreTable("user_account"), array("score +=" => $prize2Model["score"]), array("id" => $join2UserModel["id"]));
                                        $userScoreModel = array();
                                        $userScoreModel["uniacid"] = $uniacid;
                                        $userScoreModel["store_id"] = $store_id;
                                        $userScoreModel["openid"] = $join2UserModel["openid"];
                                        $userScoreModel["nickname"] = $join2UserModel["nickname"];
                                        $userScoreModel["headurl"] = $join2UserModel["headurl"];
                                        $userScoreModel["types"] = 1;
                                        $userScoreModel["activity_types"] = $activity_types;
                                        $userScoreModel["detail_id"] = $draw_id;
                                        $userScoreModel["score"] = $prize2Model["score"];
                                        $userScoreModel["note"] = $note;
                                        $userScoreModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                        pdo_update(ztbNopreTable("user_draw"), array("score" => $prize2Model["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                    } else {
                                        if (intval($prize2Model["types"]) == 2) {
                                            if (intval($prize2Model["create_types"]) == 1) {
                                                list($min, $max) = explode("-", $prize2Model["sys"]);
                                                $prize2Model["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                            }
                                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prize2Model["sys"] . "元";
                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                            if ($storeModel["money"] >= $prize2Model["sys"]) {
                                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prize2Model["sys"]), array("id" => $join2UserModel["id"]));
                                                $userBillModel = array();
                                                $userBillModel["uniacid"] = $uniacid;
                                                $userBillModel["store_id"] = $store_id;
                                                $userBillModel["openid"] = $join2UserModel["openid"];
                                                $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                $userBillModel["types"] = 3;
                                                $userBillModel["detail_id"] = $draw_id;
                                                $userBillModel["money"] = $prize2Model["sys"];
                                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                $userBillModel["note"] = $note;
                                                $userBillModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["sys"])), array("id" => $store_id));
                                                $storeBillModel = array();
                                                $storeBillModel["uniacid"] = $uniacid;
                                                $storeBillModel["store_id"] = $store_id;
                                                $storeBillModel["types"] = 11;
                                                $storeBillModel["detail_id"] = $draw_id;
                                                $storeBillModel["money"] = $prize2Model["sys"];
                                                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                $storeBillModel["note"] = $note;
                                                $storeBillModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                            } else {
                                                $sysReissueModel = array();
                                                $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                $sysReissueModel["draw_id"] = $draw_id;
                                                $sysReissueModel["types"] = 2;
                                                $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                $sysReissueModel["status"] = 0;
                                                $sysReissueModel["money"] = $prize2Model["sys"];
                                                $sysReissueModel["desc"] = $prize2Model["name"];
                                                $sysReissueModel["is_store_sell"] = 0;
                                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                                $sysReissueModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                            }
                                            pdo_update(ztbNopreTable("user_draw"), array("sys" => $prize2Model["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                            pdo_update(ztbTable("obj_cut_join", false), array("money +=" => floatval($prize2Model["sys"])), array("id" => $join2Model["id"]));
                                        } else {
                                            if (intval($prize2Model["types"]) == 3) {
                                                if (intval($prize2Model["create_types"]) == 1) {
                                                    list($min, $max) = explode("-", $prize2Model["money"]);
                                                    $prize2Model["money"] = mt_rand($min * 100, $max * 100) / 100;
                                                }
                                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prize2Model["money"] . "元";
                                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                if ($storeModel["money"] >= $prize2Model["money"]) {
                                                    pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["money"])), array("id" => $store_id));
                                                    $storeBillModel = array();
                                                    $storeBillModel["uniacid"] = $uniacid;
                                                    $storeBillModel["store_id"] = $store_id;
                                                    $storeBillModel["types"] = 11;
                                                    $storeBillModel["detail_id"] = $draw_id;
                                                    $storeBillModel["money"] = $prize2Model["money"];
                                                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                    $storeBillModel["note"] = $note;
                                                    $storeBillModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                    $result = sendWeixinMchPay($join2UserModel["openid"], floatval($prize2Model["money"]) * 100, $prize2Model["name"], true, $uniacid, $config);
                                                    if (!($result === true)) {
                                                        $sysReissueModel = array();
                                                        $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                        $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                        $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                        $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                        $sysReissueModel["draw_id"] = $draw_id;
                                                        $sysReissueModel["types"] = 1;
                                                        $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                        $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                        $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                        $sysReissueModel["status"] = 0;
                                                        $sysReissueModel["money"] = $prize2Model["money"];
                                                        $sysReissueModel["desc"] = $prize2Model["name"];
                                                        $sysReissueModel["is_store_sell"] = 1;
                                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                    }
                                                } else {
                                                    $sysReissueModel = array();
                                                    $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                    $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                    $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                    $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                    $sysReissueModel["draw_id"] = $draw_id;
                                                    $sysReissueModel["types"] = 1;
                                                    $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                    $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                    $sysReissueModel["headurl"] = $join2UserModel["headimgurl"];
                                                    $sysReissueModel["status"] = 0;
                                                    $sysReissueModel["money"] = $prize2Model["money"];
                                                    $sysReissueModel["desc"] = $prize2Model["name"];
                                                    $sysReissueModel["is_store_sell"] = 0;
                                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                }
                                                pdo_update(ztbNopreTable("user_draw"), array("money" => $prize2Model["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                pdo_update(ztbTable("obj_cut_join", false), array("money +=" => floatval($prize2Model["money"])), array("id" => $join2Model["id"]));
                                            } else {
                                                if (intval($prize2Model["types"]) == 5) {
                                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prize2Model["card_id"], "status" => 1));
                                                    if (!empty($storeCard)) {
                                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prize2Model["id"]));
                                    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                    if (!empty($origin_id)) {
                                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                    }
                                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                    if ($prize2Model["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                        if (!empty($prize2Model["sms_tmp"])) {
                                            if (!empty($join2UserModel["mobile"])) {
                                                $sms_uid = $config["sms_uid"];
                                                $sms_key = $config["sms_key"];
                                                $mobile = $join2UserModel["mobile"];
                                                $sms_content = $prize2Model["sms_tmp"];
                                                $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                if (empty($storeModel["zucp_ext"])) {
                                                    $sms_content .= "【{$config["name"]}】";
                                                } else {
                                                    $sms_content .= "【{$storeModel["name"]}】";
                                                }
                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                if ($result === true) {
                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                }
                                            }
                                        }
                                    } else {
                                        if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                                            if (!empty($object["draw_sms_tmp"])) {
                                                if (!empty($join2UserModel["mobile"])) {
                                                    $sms_uid = $config["sms_uid"];
                                                    $sms_key = $config["sms_key"];
                                                    $mobile = $join2UserModel["mobile"];
                                                    $sms_content = $object["draw_sms_tmp"];
                                                    $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                    $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                    if (empty($storeModel["zucp_ext"])) {
                                                        $sms_content .= "【{$config["name"]}】";
                                                    } else {
                                                        $sms_content .= "【{$storeModel["name"]}】";
                                                    }
                                                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                    if ($result === true) {
                                                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
function collage_write_Off($uniacid, $aid, $openid, $config)
{
    $activity_types = 16;
    $activity = pdo_get(ztbNopreTable("obj_activity"), array("deltime" => 0, "uniacid" => $uniacid, "id" => $aid));
    $object = pdo_get(ztbNopreTable("obj_collage"), array("deltime" => 0, "activity_id" => $activity["id"]));
    if ($object["models"] != 0 || $object["is_offline_pay"] != 1) {
        return;
    }
    $store_id = $activity["store_id"];
    $join_model = pdo_get(ztbNopreTable("obj_collage_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "openid" => $openid, "deltime" => 0));
    $joinModel = pdo_get(ztbNopreTable("obj_collage_join"), array("uniacid" => $uniacid, "store_id" => $store_id, "activity_id" => $activity["id"], "id" => $join_model["invite_id"], "deltime" => 0));
    if ($join_model["is_direct_pay"] == 0) {
        return;
    }
    $userModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $store_id, "openid" => $openid, "deltime" => 0));
    $origin_id = $join_model["origin_id"];
    if (!empty($origin_id)) {
        $originModel = pdo_get("lywywl_ztb_marketing_user", array("id" => $origin_id, "activity_id" => $activity["id"], "uniacid" => $uniacid));
    }
    if (!empty($joinModel)) {
        if ($joinModel["openid"] != $openid) {
            pdo_update(ztbTable("obj_collage_join", false), array("joins +=" => 1), array("id" => $joinModel["id"]));
            $joinUserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $joinModel["openid"]));
            if (isset($object["or_open_rebate2"])) {
                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 0), array(), '', "sort asc");
            } else {
                $prizeList = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1), array(), '', "sort asc");
            }
            if (!empty($prizeList)) {
                $prizeModel = null;
                foreach ($prizeList as $key => $val) {
                    if (!(intval($val["odds"]) <= 0)) {
                        if (!(intval($val["surplus"]) <= 0)) {
                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE deltime = 0 AND prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                    if (!($count >= intval($val["limitnum"]))) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                    }
                                }
                            } else {
                                $count = pdo_getcolumn(ztbTable("user_draw", false), array("deltime" => 0, "prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                                if (!($count >= intval($val["limitnum"]))) {
                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                        $arr[$key] = $val["odds"];
                                    } else {
                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE deltime = 0 AND prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                        if (!($count >= intval($val["limitnum"]))) {
                                            $arr[$key] = $val["odds"];
                                        } else {
                                        }
                                    }
                                } else {
                                }
                            }
                        } else {
                        }
                    } else {
                    }
                }
                if (empty($prizeModel)) {
                    $rid = getRand($arr);
                    $prizeModel = $prizeList[$rid];
                }
                if (!empty($prizeModel)) {
                    $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $activity["id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $joinModel["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                    $result = pdo_insert(ztbTable("user_draw", false), $join_draw_data);
                    $writecode = '';
                    if (!empty($result)) {
                        $draw_id = pdo_insertid();
                        $hashids = Hashids::instance(6, "lywyztb", '');
                        $encode_id = $hashids->encode($draw_id);
                        $join_draw_data = array("writecode" => $encode_id);
                        pdo_update(ztbTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
                        $writecode = $encode_id;
                    }
                    if (intval($prizeModel["types"]) == 1) {
                        if (intval($prizeModel["create_types"]) == 1) {
                            list($min, $max) = explode("-", $prizeModel["score"]);
                            $prizeModel["score"] = mt_rand($min, $max);
                        }
                        $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"] . "个";
                        pdo_update(ztbNopreTable("user_account"), array("score +=" => intval($prizeModel["score"])), array("id" => $joinUserModel["id"]));
                        $userScoreModel = array();
                        $userScoreModel["uniacid"] = $uniacid;
                        $userScoreModel["store_id"] = $store_id;
                        $userScoreModel["openid"] = $joinUserModel["openid"];
                        $userScoreModel["nickname"] = $joinUserModel["nickname"];
                        $userScoreModel["headurl"] = $joinUserModel["headurl"];
                        $userScoreModel["types"] = 1;
                        $userScoreModel["activity_types"] = $activity_types;
                        $userScoreModel["detail_id"] = $draw_id;
                        $userScoreModel["score"] = $prizeModel["score"];
                        $userScoreModel["note"] = $note;
                        $userScoreModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                        pdo_update(ztbTable("user_draw", false), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                    } else {
                        if (intval($prizeModel["types"]) == 2) {
                            if (intval($prizeModel["create_types"]) == 1) {
                                list($min, $max) = explode("-", $prizeModel["sys"]);
                                $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                            }
                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id), array("money", "sms"));
                            $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得零钱：" . $prizeModel["sys"] . "元";
                            if ($storeModel["money"] >= $prizeModel["sys"]) {
                                pdo_update(ztbNopreTable("store_account"), array("money -=" => $prizeModel["sys"]), array("id" => $store_id));
                                $storeBillModel = array();
                                $storeBillModel["uniacid"] = $uniacid;
                                $storeBillModel["store_id"] = $store_id;
                                $storeBillModel["types"] = 11;
                                $storeBillModel["detail_id"] = $draw_id;
                                $storeBillModel["money"] = $prizeModel["sys"];
                                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                $storeBillModel["note"] = $note;
                                $storeBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $joinUserModel["id"]));
                                $userBillModel = array();
                                $userBillModel["uniacid"] = $uniacid;
                                $userBillModel["store_id"] = $store_id;
                                $userBillModel["openid"] = $joinUserModel["openid"];
                                $userBillModel["nickname"] = $joinUserModel["nickname"];
                                $userBillModel["headurl"] = $joinUserModel["headurl"];
                                $userBillModel["types"] = 3;
                                $userBillModel["detail_id"] = $draw_id;
                                $userBillModel["money"] = $prizeModel["sys"];
                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("id" => $joinUserModel["id"]), "money");
                                $userBillModel["note"] = $note;
                                $userBillModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                            } else {
                                $sysReissueModel = array();
                                $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                $sysReissueModel["draw_id"] = $draw_id;
                                $sysReissueModel["types"] = 2;
                                $sysReissueModel["openid"] = $joinUserModel["openid"];
                                $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                $sysReissueModel["status"] = 0;
                                $sysReissueModel["money"] = $prizeModel["sys"];
                                $sysReissueModel["desc"] = $prizeModel["name"];
                                $sysReissueModel["is_store_sell"] = 0;
                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                $sysReissueModel["createtime"] = TIMESTAMP;
                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                            }
                            pdo_update(ztbTable("user_draw", false), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                            pdo_update(ztbTable("obj_collage_join", false), array("money +=" => floatval($prizeModel["sys"])), array("id" => $joinModel["id"]));
                        } else {
                            if (intval($prizeModel["types"]) == 3) {
                                if (intval($prizeModel["create_types"]) == 1) {
                                    list($min, $max) = explode("-", $prizeModel["money"]);
                                    $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                                }
                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id), array("money", "sms"));
                                $note = "返利获得：" . date("Y-m-d H:i:s", TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                                if ($storeModel["money"] >= $prizeModel["money"]) {
                                    pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["money"])), array("id" => $store_id));
                                    $storeBillModel = array();
                                    $storeBillModel["uniacid"] = $uniacid;
                                    $storeBillModel["store_id"] = $store_id;
                                    $storeBillModel["types"] = 11;
                                    $storeBillModel["detail_id"] = $draw_id;
                                    $storeBillModel["money"] = $prizeModel["money"];
                                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                    $storeBillModel["note"] = $note;
                                    $storeBillModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                    $result = sendWeixinMchPay($joinUserModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                                    if (!($result === true)) {
                                        $sysReissueModel = array();
                                        $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                        $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                        $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                        $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                        $sysReissueModel["draw_id"] = $draw_id;
                                        $sysReissueModel["types"] = 1;
                                        $sysReissueModel["openid"] = $joinUserModel["openid"];
                                        $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                        $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                        $sysReissueModel["status"] = 0;
                                        $sysReissueModel["money"] = $prizeModel["money"];
                                        $sysReissueModel["desc"] = $prizeModel["name"];
                                        $sysReissueModel["is_store_sell"] = 1;
                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                    }
                                } else {
                                    $sysReissueModel = array();
                                    $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                    $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                    $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                    $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                    $sysReissueModel["draw_id"] = $draw_id;
                                    $sysReissueModel["types"] = 1;
                                    $sysReissueModel["openid"] = $joinUserModel["openid"];
                                    $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                    $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                    $sysReissueModel["status"] = 0;
                                    $sysReissueModel["money"] = $prizeModel["money"];
                                    $sysReissueModel["desc"] = $prizeModel["name"];
                                    $sysReissueModel["is_store_sell"] = 0;
                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                }
                                pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                pdo_update(ztbTable("obj_collage_join", false), array("money +=" => floatval($prizeModel["money"])), array("id" => $joinModel["id"]));
                            } else {
                                if (intval($prizeModel["types"]) == 5) {
                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("uniacid" => $uniacid, "store_id" => $store_id, "deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                                    if (!empty($storeCard)) {
                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                    }
                                }
                            }
                        }
                    }
                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
                    pdo_update(ztbTable("obj_activity", false), array("get_num +=" => 1), array("id" => $activity["id"]));
                    if (!empty($origin_id)) {
                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                    }
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("id" => $store_id), array("money", "sms", "name", "zucp_ext"));
                    if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                        if (!empty($prizeModel["sms_tmp"])) {
                            if (!empty($joinUserModel["mobile"])) {
                                $sms_uid = $config["sms_uid"];
                                $sms_key = $config["sms_key"];
                                $mobile = $joinUserModel["mobile"];
                                $sms_content = $prizeModel["sms_tmp"];
                                $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                if (empty($storeModel["zucp_ext"])) {
                                    $sms_content .= "【{$config["name"]}】";
                                } else {
                                    $sms_content .= "【{$storeModel["name"]}】";
                                }
                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                if ($result === true) {
                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                }
                            }
                        }
                    } else {
                        if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                            if (!empty($object["draw_sms_tmp"])) {
                                if (!empty($joinUserModel["mobile"])) {
                                    $sms_uid = $config["sms_uid"];
                                    $sms_key = $config["sms_key"];
                                    $mobile = $joinUserModel["mobile"];
                                    $sms_content = $object["draw_sms_tmp"];
                                    $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                                    $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                    if (empty($storeModel["zucp_ext"])) {
                                        $sms_content .= "【{$config["name"]}】";
                                    } else {
                                        $sms_content .= "【{$storeModel["name"]}】";
                                    }
                                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                    if ($result === true) {
                                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $plug_rebate2 = getPluginStatus($object["uniacid"], "lywywl_ztb_plugin_twoinvite");
        if ($plug_rebate2) {
            if (isset($object["or_open_rebate2"]) && $object["or_open_rebate2"] == 1) {
                $draw2Model = pdo_get(ztbNopreTable("user_draw"), array("deltime" => 0, "uniacid" => $uniacid, "activity_id" => $activity["id"], "pay_openid" => $joinModel["openid"], "or_rebate2" => 0, "types >" => 0));
                if (!empty($draw2Model)) {
                    $join2Model = pdo_get(ztbTable("obj_collage_join", false), array("uniacid" => $uniacid, "activity_id" => $activity["id"], "openid" => $draw2Model["openid"]));
                    if (!empty($join2Model)) {
                        if ($join2Model["openid"] != $openid && $join2Model["openid"] != $joinModel["openid"]) {
                            pdo_update(ztbTable("obj_collage_join", false), array("joins +=" => 1), array("id" => $join2Model["id"]));
                            $join2UserModel = pdo_get(ztbTable("user_account", false), array("uniacid" => $uniacid, "store_id" => $object["store_id"], "openid" => $join2Model["openid"]));
                            $prize2List = pdo_getall(ztbNopreTable("obj_prize"), array("deltime" => 0, "activity_id" => $object["activity_id"], "status" => 1, "or_rebate2" => 1), array(), '', "sort asc");
                            if (!empty($prize2List)) {
                                $prize2Model = null;
                                foreach ($prize2List as $key => $val) {
                                    if (!(intval($val["surplus"]) <= 0)) {
                                        if (!(intval($val["odds"]) <= 0)) {
                                            if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                                                if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                    $arr2[$key] = $val["odds"];
                                                } else {
                                                    $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                    if (!($count >= intval($val["limitnum"]))) {
                                                        $arr2[$key] = $val["odds"];
                                                    } else {
                                                    }
                                                }
                                            } else {
                                                $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $join2UserModel["openid"]), "count(*)");
                                                if (!($count >= intval($val["limitnum"]))) {
                                                    if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                                        $arr2[$key] = $val["odds"];
                                                    } else {
                                                        $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $join2UserModel["openid"]));
                                                        if (!($count >= intval($val["limitnum"]))) {
                                                            $arr2[$key] = $val["odds"];
                                                        } else {
                                                        }
                                                    }
                                                } else {
                                                }
                                            }
                                        } else {
                                        }
                                    } else {
                                    }
                                }
                                if (empty($prize2Model) && !empty($arr2)) {
                                    $rid2 = getRand($arr2);
                                    $prize2Model = $prize2List[$rid2];
                                }
                                if (!empty($prize2Model)) {
                                    $join_draw_data2 = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prize2Model["id"], "types" => $prize2Model["types"], "name" => $prize2Model["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prize2Model["picurl"], "writeoff_types" => $prize2Model["writeoff_types"], "openid" => $join2UserModel["openid"], "nickname" => $join2UserModel["nickname"], "headurl" => $join2UserModel["headurl"], "register_data" => '', "or_rebate2" => 1, "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
                                    $result = pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data2);
                                    $writecode = '';
                                    if (!empty($result)) {
                                        $draw_id = pdo_insertid();
                                        $hashids = Hashids::instance(6, "lywyztb", '');
                                        $encode_id = $hashids->encode($draw_id);
                                        $join_draw_data2 = array("writecode" => $encode_id);
                                        pdo_update(ztbNopreTable("user_draw", false), $join_draw_data2, array("id" => $draw_id));
                                        $writecode = $encode_id;
                                    }
                                    if (intval($prize2Model["types"]) == 1) {
                                        if (intval($prize2Model["create_types"]) == 1) {
                                            list($min, $max) = explode("-", $prize2Model["score"]);
                                            $prize2Model["score"] = mt_rand($min, $max);
                                        }
                                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prize2Model["score"];
                                        pdo_update(ztbNopreTable("user_account"), array("score +=" => $prize2Model["score"]), array("id" => $join2UserModel["id"]));
                                        $userScoreModel = array();
                                        $userScoreModel["uniacid"] = $uniacid;
                                        $userScoreModel["store_id"] = $store_id;
                                        $userScoreModel["openid"] = $join2UserModel["openid"];
                                        $userScoreModel["nickname"] = $join2UserModel["nickname"];
                                        $userScoreModel["headurl"] = $join2UserModel["headurl"];
                                        $userScoreModel["types"] = 1;
                                        $userScoreModel["activity_types"] = $activity_types;
                                        $userScoreModel["detail_id"] = $draw_id;
                                        $userScoreModel["score"] = $prize2Model["score"];
                                        $userScoreModel["note"] = $note;
                                        $userScoreModel["createtime"] = TIMESTAMP;
                                        pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                                        pdo_update(ztbNopreTable("user_draw"), array("score" => $prize2Model["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                    } else {
                                        if (intval($prize2Model["types"]) == 2) {
                                            if (intval($prize2Model["create_types"]) == 1) {
                                                list($min, $max) = explode("-", $prize2Model["sys"]);
                                                $prize2Model["sys"] = mt_rand($min * 100, $max * 100) / 100;
                                            }
                                            $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prize2Model["sys"] . "元";
                                            $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                            if ($storeModel["money"] >= $prize2Model["sys"]) {
                                                pdo_update(ztbNopreTable("user_account"), array("money +=" => $prize2Model["sys"]), array("id" => $join2UserModel["id"]));
                                                $userBillModel = array();
                                                $userBillModel["uniacid"] = $uniacid;
                                                $userBillModel["store_id"] = $store_id;
                                                $userBillModel["openid"] = $join2UserModel["openid"];
                                                $userBillModel["nickname"] = $join2UserModel["nickname"];
                                                $userBillModel["headurl"] = $join2UserModel["headurl"];
                                                $userBillModel["types"] = 3;
                                                $userBillModel["detail_id"] = $draw_id;
                                                $userBillModel["money"] = $prize2Model["sys"];
                                                $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $join2UserModel["openid"]), "money");
                                                $userBillModel["note"] = $note;
                                                $userBillModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                                pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["sys"])), array("id" => $store_id));
                                                $storeBillModel = array();
                                                $storeBillModel["uniacid"] = $uniacid;
                                                $storeBillModel["store_id"] = $store_id;
                                                $storeBillModel["types"] = 11;
                                                $storeBillModel["detail_id"] = $draw_id;
                                                $storeBillModel["money"] = $prize2Model["sys"];
                                                $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                $storeBillModel["note"] = $note;
                                                $storeBillModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                            } else {
                                                $sysReissueModel = array();
                                                $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                $sysReissueModel["draw_id"] = $draw_id;
                                                $sysReissueModel["types"] = 2;
                                                $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                $sysReissueModel["status"] = 0;
                                                $sysReissueModel["money"] = $prize2Model["sys"];
                                                $sysReissueModel["desc"] = $prize2Model["name"];
                                                $sysReissueModel["is_store_sell"] = 0;
                                                $sysReissueModel["updatetime"] = TIMESTAMP;
                                                $sysReissueModel["createtime"] = TIMESTAMP;
                                                pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                            }
                                            pdo_update(ztbNopreTable("user_draw"), array("sys" => $prize2Model["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                            pdo_update(ztbTable("obj_collage_join", false), array("money +=" => floatval($prize2Model["sys"])), array("id" => $join2Model["id"]));
                                        } else {
                                            if (intval($prize2Model["types"]) == 3) {
                                                if (intval($prize2Model["create_types"]) == 1) {
                                                    list($min, $max) = explode("-", $prize2Model["money"]);
                                                    $prize2Model["money"] = mt_rand($min * 100, $max * 100) / 100;
                                                }
                                                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $join2UserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prize2Model["money"] . "元";
                                                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                                if ($storeModel["money"] >= $prize2Model["money"]) {
                                                    pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prize2Model["money"])), array("id" => $store_id));
                                                    $storeBillModel = array();
                                                    $storeBillModel["uniacid"] = $uniacid;
                                                    $storeBillModel["store_id"] = $store_id;
                                                    $storeBillModel["types"] = 11;
                                                    $storeBillModel["detail_id"] = $draw_id;
                                                    $storeBillModel["money"] = $prize2Model["money"];
                                                    $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                                                    $storeBillModel["note"] = $note;
                                                    $storeBillModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                                                    $result = sendWeixinMchPay($join2UserModel["openid"], floatval($prize2Model["money"]) * 100, $prize2Model["name"], true, $uniacid, $config);
                                                    if (!($result === true)) {
                                                        $sysReissueModel = array();
                                                        $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                        $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                        $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                        $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                        $sysReissueModel["draw_id"] = $draw_id;
                                                        $sysReissueModel["types"] = 1;
                                                        $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                        $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                        $sysReissueModel["headurl"] = $join2UserModel["headurl"];
                                                        $sysReissueModel["status"] = 0;
                                                        $sysReissueModel["money"] = $prize2Model["money"];
                                                        $sysReissueModel["desc"] = $prize2Model["name"];
                                                        $sysReissueModel["is_store_sell"] = 1;
                                                        $sysReissueModel["updatetime"] = TIMESTAMP;
                                                        $sysReissueModel["createtime"] = TIMESTAMP;
                                                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                    }
                                                } else {
                                                    $sysReissueModel = array();
                                                    $sysReissueModel["uniacid"] = $prize2Model["uniacid"];
                                                    $sysReissueModel["store_id"] = $prize2Model["store_id"];
                                                    $sysReissueModel["activity_types"] = $prize2Model["activity_types"];
                                                    $sysReissueModel["activity_id"] = $prize2Model["activity_id"];
                                                    $sysReissueModel["draw_id"] = $draw_id;
                                                    $sysReissueModel["types"] = 1;
                                                    $sysReissueModel["openid"] = $join2UserModel["openid"];
                                                    $sysReissueModel["nickname"] = $join2UserModel["nickname"];
                                                    $sysReissueModel["headurl"] = $join2UserModel["headimgurl"];
                                                    $sysReissueModel["status"] = 0;
                                                    $sysReissueModel["money"] = $prize2Model["money"];
                                                    $sysReissueModel["desc"] = $prize2Model["name"];
                                                    $sysReissueModel["is_store_sell"] = 0;
                                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                                }
                                                pdo_update(ztbNopreTable("user_draw"), array("money" => $prize2Model["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                                                pdo_update(ztbTable("obj_collage_join", false), array("money +=" => floatval($prize2Model["money"])), array("id" => $join2Model["id"]));
                                            } else {
                                                if (intval($prize2Model["types"]) == 5) {
                                                    $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prize2Model["card_id"], "status" => 1));
                                                    if (!empty($storeCard)) {
                                                        pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prize2Model["id"]));
                                    pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
                                    if (!empty($origin_id)) {
                                        pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
                                    }
                                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                                    if ($prize2Model["is_sms"] == 1 && $storeModel["sms"] > 0) {
                                        if (!empty($prize2Model["sms_tmp"])) {
                                            if (!empty($join2UserModel["mobile"])) {
                                                $sms_uid = $config["sms_uid"];
                                                $sms_key = $config["sms_key"];
                                                $mobile = $join2UserModel["mobile"];
                                                $sms_content = $prize2Model["sms_tmp"];
                                                $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                if (empty($storeModel["zucp_ext"])) {
                                                    $sms_content .= "【{$config["name"]}】";
                                                } else {
                                                    $sms_content .= "【{$storeModel["name"]}】";
                                                }
                                                $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                if ($result === true) {
                                                    pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                    pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                }
                                            }
                                        }
                                    } else {
                                        if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                                            if (!empty($object["draw_sms_tmp"])) {
                                                if (!empty($join2UserModel["mobile"])) {
                                                    $sms_uid = $config["sms_uid"];
                                                    $sms_key = $config["sms_key"];
                                                    $mobile = $join2UserModel["mobile"];
                                                    $sms_content = $object["draw_sms_tmp"];
                                                    $sms_content = str_replace("{NICKNAME}", $join2UserModel["nickname"], $sms_content);
                                                    $sms_content = str_replace("{PRIZE}", $prize2Model["name"], $sms_content);
                                                    $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                                                    $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                                                    if (empty($storeModel["zucp_ext"])) {
                                                        $sms_content .= "【{$config["name"]}】";
                                                    } else {
                                                        $sms_content .= "【{$storeModel["name"]}】";
                                                    }
                                                    $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                                                    if ($result === true) {
                                                        pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                                        pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
function searchDir($dir, &$files)
{
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    searchDir($dir . "/" . $file, $files);
                }
            }
            closedir($dh);
        }
    }
    if (!is_dir($dir)) {
        $files[] = $dir;
    }
}
function random_headurl()
{
    $path = MODULE_ROOT . "/resource/mobile/tmp/head";
    $files = array();
    searchDir($path, $files);
    if (!empty($files)) {
        $index = rand(0, count($files) - 1);
        $headurl = $files[$index];
    }
    return tomedia($headurl);
}
function random_nickname()
{
    $a = "赵 钱 孙 李 周 吴 郑 王 冯 陈 楮 卫 蒋 沈 韩 杨 朱 秦 尤 许 何 吕 施 张 孔 曹 严 华 金 魏 陶 姜 戚 谢 邹 喻 柏 水 窦 章 云 苏 潘 葛 奚 范 彭 郎 鲁 韦 昌 马 苗 凤 花 方 俞 任 袁 柳 酆 鲍 史 唐 费 廉 岑 薛 雷 贺 倪 汤 滕 殷 罗 毕 郝 邬 安 常 乐 于 时 傅 皮 卞 齐 康 伍 余 元 卜 顾 孟 平 黄 和 穆 萧 尹 姚 邵 湛 汪 祁 毛 禹 狄 米 贝 明 臧 计 伏 成 戴 谈 宋 茅 庞 熊 纪 舒 屈 项 祝 董 梁 杜 阮 蓝 闽 席 季 麻 强 贾 路 娄 危 江 童 颜 郭 梅 盛 林 刁 锺 徐 丘 骆 高 夏 蔡 田 樊 胡 凌 霍 虞 万 支 柯 昝 管 卢 莫 经 房 裘 缪 干 解 应 宗 丁 宣 贲 邓 郁 单 杭 洪 包 诸 左 石 崔 吉 钮 龚 程 嵇 邢 滑 裴 陆 荣 翁 荀 羊 於 惠 甄 麹 家 封 芮 羿 储 靳 汲 邴 糜 松 井 段 富 巫 乌 焦 巴 弓 牧 隗 山 谷 车 侯 宓 蓬 全 郗 班 仰 秋 仲 伊 宫 宁 仇 栾 暴 甘 斜 厉 戎 祖 武 符 刘 景 詹 束 龙 叶 幸 司 韶 郜 黎 蓟 薄 印 宿 白 怀 蒲 邰 从 鄂 索 咸 籍 赖 卓 蔺 屠 蒙 池 乔 阴 郁 胥 能 苍 双 闻 莘 党 翟 谭 贡 劳 逄 姬 申 扶 堵 冉 宰 郦 雍 郤 璩 桑 桂 濮 牛 寿 通 边 扈 燕 冀 郏 浦 尚 农 温 别 庄 晏 柴 瞿 阎 充 慕 连 茹 习 宦 艾 鱼 容 向 古 易 慎 戈 廖 庾 终 暨 居 衡 步 都 耿 满 弘 匡 国 文 寇 广 禄 阙 东 欧 殳 沃 利 蔚 越 夔 隆 师 巩 厍 聂 晁 勾 敖 融 冷 訾 辛 阚 那 简 饶 空 曾 毋 沙 乜 养 鞠 须 丰 巢 关 蒯 相 查 后 荆 红 游 竺 权 逑 盖 益 桓 公 万俟 司马 上官 欧阳 夏侯 诸葛 闻人 东方 赫连 皇甫 尉迟 公羊 澹台 公冶 宗政 濮阳 淳于 单于 太叔 申屠 公孙 仲孙 轩辕 令狐 锺离 宇文 长孙 慕容 鲜于 闾丘 司徒 司空 丌官 司寇 仉 督 子车 颛孙 端木 巫马 公西 漆雕 乐正 壤驷 公良 拓拔 夹谷 宰父 谷梁 晋 楚 阎 法 汝 鄢 涂 钦 段干 百里 东郭 南门 呼延 归 海 羊舌 微生 岳 帅 缑 亢 况 后 有 琴 梁丘 左丘 东门 西门 商 牟 佘 佴 伯 赏 南宫 墨 哈 谯 笪 年 爱 阳 佟 第五 言 福";
    $aa = explode(" ", $a);
    $b = "彬 轩 含 蒲 乒 虚 行 亭 仑 蓝 影 韬 函 克 盛 衡 芝 晗 昊 诗 琦 至 涵 伦 时 映 志 菱 纶 士 永 致 嘉 旷 示 咏 智 安 轮 世 勇 中 昂 律 业 友 忠 敖 齐 轼 桓 林 言 群 书 有 宣 颁 略 伟 骢 州 清 宏 充 佑 洲 庭 马 濮 丹 乐 邦 迈 卫 平 乾 榜 宸 蔚 旲 东 宝 昴 树 材 纪 保 茂 泓 棋 竹 葆 浩 魏 妤 铸 劻 玫 晔 渝 壮 羚 阳 文 瑜 卓 掣 奎 船 与 萱 豹 梅 汶 旭 濯 驾 和 航 宇 孜 邶 望 武 羽 崊 霆 美 希 雨 淑 冰 蒙 才 凰 腾 备 密 溪 泰 子 辈 冕 帅 语 茜 蓓 淼 曦 玉 梓 弼 民 奇 禾 综 碧 洋 霞 连 祖 厚 晨 先 昱 选 昪 旻 虹 朔 济 彪 淏 贤 儋 冬 龄 馗 娴 钰 栋 飙 传 舷 御 端 澜 然 磊 裕 段 挺 名 春 誉 天 飚 明 灏 堂 碫 莱 鸣 双 渊 琳 坚 茗 一 元 倩 宾 村 宪 辉 铎 妍 铭 献 彭 思 策 谋 祥 序 伯 骞 牧 翔 启 恩 建 慕 向 沅 发 汗 穆 骁 溓 帆 健 恒 洪 媛 汉 键 威 晓 源 冀 勒 成 笑 远 弘 龙 仁 蕾 棠 凡 江 魁 伊 德 方 城 铿 顺 月 飞 萍 皓 朴 悦 学 骄 楠 啸 绪 强 鲛 妮 勰 跃 霖 劼 宁 兵 越 芬 杰 弩 淳 起 丰 洁 攀 心 云 风 柴 旁 昕 会 沣 婕 薇 欣 良 泊 同 沛 新 芸 川 悍 佩 依 颇 封 金 松 鸿 耘 峰 岩 日 竦 韵 勋 辰 朋 沂 坤 骥 晴 岚 怡 泽 锋 津 荣 信 增 澔 锦 容 立 波 乔 瑾 鹏 宜 登 凤 进 铖 达 承 豪 晋 榕 华 展 福 菁 韦 以 章 俯 彤 融 来 彰 恬 景 力 亿 涛 辅 炎 茹 义 梁 迅 璟 儒 瀚 浦 富 禅 采 艺 基 澉 颔 襦 星 钊 刚 庆 锐 议 昭 博 珑 斌 亦 照 纲 敬 瑞 佚 哲 合 靖 澎 励 喆 佳 驹 睿 易 绮 钢 聚 垒 奕 真 苓 万 尧 益 臻 阔 颜 若 淇 焘 聪 涓 飒 骅 沧 罡 娟 弛 朗 帝 高 军 森 兴 缜 歌 钧 砂 大 畅 弓 筠 山 谊 亮 功 丞 河 逸 稹 巩 全 善 意 舱 固 俊 超 溢 振 钦 隆 频 毅 朕 冠 翰 候 利 谦 部 彦 为 茵 震 谱 韩 劭 英 理 廷 昌 绍 琪 滔 家 骏 社 雄 镇 凌 珺 升 崇 征 光 竣 生 鹰 正 广 凯 圣 迎 诤 晷 铠 驰 寒 政 贵 康 胜 桦 琛 国 泉 晟 盈 殿 海 科 礼 代 之 卿 诚 耀 滢 吉 鑫 谚 亨 瀛 舜 延 可 维 逸";
    $bb = explode(" ", $b);
    $c = "菡 娆 炫 源 卉 娘 蕊 娜 纤 蔓 凡 怡 蒙 嫔 敏 花 叶 琰 汇 妃 莲 娥 娴 雪 露 素 菁 然 青 艳 薰 苑 莺 晶 岚 卿 香 艺 亚 滟 璟 娉 爽 霄 美 瑗 惠 婧 霭 风 水 影 月 蓓 靖 平 纨 嵘 呤 柳 蓝 眉 评 聪 丹 咏 秋 银 茗 丝 宛 晓 悠 曼 明 静 苹 菀 晴 诗 玥 紫 宁 舒 囡 心 俞 楚 漫 璧 梅 娈 芯 可 炎 玟 林 屏 忆 音 姹 妙 慧 蓉 嫦 若 代 华 瑶 念 英 莓 婉 蝶 淼 悦 火 姗 莉 盈 欣 如 馥 姬 馡 依 谷 翎 瑜 娅 珆 燕 菱 琳 伶 羽 越 姞 菊 萍 琬 荣 梓 枫 冽 娟 芮 薇 炅 思 云 佳 君 艾 烟 瑞 含 芸 玲 茵 叆 好 歆 嫣 韵 嘉 筠 琪 媚 媱 珴 昭 冰 珂 纯 宜 琼 妮 芳 妆 姳 琦 冉 蕾 海 涵 白 咛 姲 荭 馨 淞 怀 珊 伊 棋 文 星 雨 贞 丽 凝 绮 仪 楠 语 珍 姜 奴 芊 梦 秀 玉 草 菲 女 茜 纹 旭 渺 姝 娇 桃 霜 雯 絮 育 涟 姣 偀 彤 妩 萱 采 偲 妹 凤 倩 南 亿 钰 璐 洁 盼 嫱 姯 滢 彨 颜 玫 婵 柔 希 妶 倪 茹 芬 清 红 翠 旋 煜 真 碧 赫 慕 曦 雁 瑷 芝 姑 婷 漪 宝 桂 竹 欢 姿 澜 彩 冷 听 画 枝 婕 淑 芙 禧 波 雅 芷 姐 沛 巧 霖 萌 晗 荔 莎 兰 怜 寻 黛 毓 珠 春 俪 晨 莹 容 妍 寒 锦 佩 芹 娣 灵 园 烁 倰 瑛 琴 情 漩 媛 环 霏 芃 湾 贻 璇 荷 嫂 檀 融 勤 霞 颖 安 幻 瑾 飘 爱";
    $cc = explode(" ", $c);
    $a_num = rand(0, count($aa) - 1);
    $b_num = rand(0, count($bb) - 1);
    $c_num = rand(0, count($cc) - 1);
    $type = rand(1, 3);
    if ($type == 1) {
        $name = $aa[$a_num] . $bb[$b_num] . $cc[$c_num];
    } else {
        if ($type == 2) {
            $name = $aa[$a_num] . $bb[$b_num];
        } else {
            $name = $aa[$a_num] . $cc[$c_num];
        }
    }
    return $name;
}
function checkIsjoin($openid, $store_id, $activity_id)
{
    global $_W;
    if (empty($openid)) {
        tip_redirect("对不起，您没有权限参加活动！");
    }
    $order = pdo_get(ztbNopreTable("sys_pay"), array("openid" => $openid, "uniacid" => $_W["uniacid"], "store_id" => $store_id, "activity_id" => $activity_id, "status" => 1, "deltime" => 0));
    if (empty($order)) {
        tip_redirect("对不起，您没有权限参加活动！");
    }
    return true;
}
function getMobile($register_data)
{
    if (empty($register_data)) {
        return '';
    } else {
        $register_arr = iunserializer($register_data);
        if (is_array($register_arr)) {
            foreach ($register_arr as $value) {
                if (strtolower($value["Name"]) == "mobile") {
                    return $value["Value"];
                }
            }
        } else {
            return '';
        }
    }
}
function vaptcha_verify($token, $scene)
{
    global $_W;
    load()->func("communication");
    $posturl = "http://0.vaptcha.com/verify";
    $post = array("id" => getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "vid"), "secretkey" => getPluginConfig($_W["uniacid"], "lywywl_ztb_plugin_vaptcha", "key"), "scene" => $scene, "token" => $token, "ip" => $_W["clientip"]);
    $response = ihttp_post($posturl, $post);
    if (is_error($response)) {
        return false;
    }
    if ($response["code"] == "200") {
        $result = (array) json_decode($response["content"], true);
        if ($result["success"] == 1) {
            return true;
        }
    }
    return false;
}
function is_blacklist($uniacid, $openid)
{
    if (empty($uniacid) || empty($openid)) {
        return false;
    }
    $blackModel = pdo_get(ztbNopreTable("user_blacklist"), array("uniacid" => $uniacid, "openid" => $openid, "deltime" => 0));
    return !empty($blackModel);
}
function prize_create_log($prize, $source)
{
    global $_W;
    if ($source == 0) {
        $note = "平台用户：【" . $_W["username"] . "】（PC端操作）";
    } else {
        if ($source == 1) {
            $note = "商家用户：【" . $_W["store_name"] . "】（PC端操作）";
        } else {
            if ($source == 2) {
                $note = "商家用户：【" . $_W["store_name"] . "】（手机端操作）";
            }
        }
    }
    $model = array("uniacid" => $_W["uniacid"], "store_id" => $prize["store_id"], "activity_types" => $prize["activity_types"], "activity_id" => $prize["activity_id"], "prize_id" => $prize["id"], "types" => 1, "before" => '', "after" => iserializer($prize), "ip" => $_W["clientip"], "note" => $note, "createtime" => time());
    pdo_insert(ztbNopreTable("sys_prize_log"), $model);
}
function prize_update_log($prize_old, $prize_new, $source)
{
    global $_W;
    if ($source == 0) {
        $note = "平台用户：【" . $_W["username"] . "】（PC端操作）";
    } else {
        if ($source == 1) {
            $note = "商家用户：【" . $_W["store_name"] . "】（PC端操作）";
        } else {
            if ($source == 2) {
                $note = "商家用户：【" . $_W["store_name"] . "】（手机端操作）";
            }
        }
    }
    $model = array("uniacid" => $_W["uniacid"], "store_id" => $prize_old["store_id"], "activity_types" => $prize_old["activity_types"], "activity_id" => $prize_old["activity_id"], "prize_id" => $prize_old["id"], "types" => 2, "before" => iserializer($prize_old), "after" => iserializer($prize_new), "ip" => $_W["clientip"], "note" => $note, "createtime" => time());
    unset($prize_old["updatetime"]);
    unset($prize_new["updatetime"]);
    $prize_compare = array();
    foreach ($prize_new as $key => $value) {
        $prize_compare[$key] = $prize_old[$key];
    }
    if ($prize_compare != $prize_new) {
        pdo_insert(ztbNopreTable("sys_prize_log"), $model);
    }
}
function prize_del_log($ids, $source)
{
    global $_W;
    if ($source == 0) {
        $note = "平台用户：【" . $_W["username"] . "】（PC端操作）";
    } else {
        if ($source == 1) {
            $note = "商家用户：【" . $_W["store_name"] . "】（PC端操作）";
        } else {
            if ($source == 2) {
                $note = "商家用户：【" . $_W["store_name"] . "】（手机端操作）";
            }
        }
    }
    $list = pdo_getall(ztbNopreTable("obj_prize"), array("id" => $ids, "uniacid" => $_W["uniacid"]));
    if (!empty($list)) {
        foreach ($list as $item) {
            $model = array("uniacid" => $_W["uniacid"], "store_id" => $item["store_id"], "activity_types" => $item["activity_types"], "activity_id" => $item["activity_id"], "prize_id" => $item["id"], "types" => 3, "before" => iserializer($item), "after" => '', "ip" => $_W["clientip"], "note" => $note, "createtime" => time());
            pdo_insert(ztbNopreTable("sys_prize_log"), $model);
        }
    }
}
function getstoreprizelist($storeid, $activity_types, $activity_id)
{
    global $_W;
    if (empty($storeid) || empty($activity_types) || empty($activity_id)) {
        return array();
    }
    $uniacid = $_W["uniacid"];
    $prizeArr = pdo_fetchall("SELECT * FROM " . ztbTable("obj_prize") . "where `uniacid`=:uniacid and activity_types=:activity_types and activity_id=:activity_id and voice_store_id=:voice_store_id and types>0 and status=1 and deltime=0 order by sort asc , id desc ", array(":uniacid" => $uniacid, "activity_types" => $activity_types, "activity_id" => $activity_id, "voice_store_id" => $storeid));
    return $prizeArr;
}
function getSpecialChars($str)
{
    $char = "。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）￥ ～ …… ，｝·";
    $pattern = array("/[[:punct:]]/i", "/[" . $char . "]/u", "/[ ]{2,}/");
    $str = preg_replace($pattern, " ", $str);
    $str = trimall($str);
    return $str;
}
function trimall($strtrim)
{
    $oldchar = array(" ", "　", "\t", "\n", "\r");
    $newchar = array('', '', '', '', '');
    return str_replace($oldchar, $newchar, $strtrim);
}
function getDrawTypesList()
{
    $list = array();
    $list[0] = array("types" => 0, "name" => "谢谢参与");
    $list[1] = array("types" => 1, "name" => "账户积分");
    $list[2] = array("types" => 2, "name" => "账户余额");
    $list[3] = array("types" => 3, "name" => "微信红包");
    $list[4] = array("types" => 4, "name" => "实物商品");
    $list[5] = array("types" => 5, "name" => "商家卡券");
    return $list;
}
function addWeixinTemplate($tid, $kidList, $sceneDesc)
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/wxaapi/newtmpl/addtemplate?access_token={$token}";
    $data = array("tid" => $tid, "kidList" => $kidList, "sceneDesc" => $sceneDesc);
    $res = ihttp_post($sendapi, $data);
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return $res["priTmplId"];
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function deleteWeixinTemplate($priTmplId)
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/wxaapi/newtmpl/deltemplate?access_token={$token}";
    $data = array("priTmplId" => $priTmplId);
    $res = ihttp_post($sendapi, $data);
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return true;
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function getWeixinCategory()
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/wxaapi/newtmpl/getcategory?access_token={$token}";
    $res = ihttp_get($sendapi);
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return $res["data"];
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function getWeixinPubTemplateTitleList($ids, $start, $limit)
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/wxaapi/newtmpl/getpubtemplatetitles?access_token={$token}";
    $sendapi = $sendapi . "&ids={$ids}&start={$start}&limit={$limit}";
    $res = ihttp_get($sendapi);
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return array("count" => $res["count"], "data" => $res["data"]);
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function getWeixinTemplateList()
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/wxaapi/newtmpl/gettemplate?access_token={$token}";
    $res = ihttp_get($sendapi);
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return $res["data"];
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function sendWeixinTemplate($touser, $template_id, $data, $page = '')
{
    global $_W;
    $acc = WeAccount::createByUniacid($_W["uniacid"]);
    $token = $acc->getAccessToken();
    $sendapi = "https://api.weixin.qq.com/cgi-bin/message/subscribe/bizsend?access_token={$token}";
    foreach ($data as $key => &$item) {
        $key = strtolower(preg_replace("/\\d+/", '', $key));
        $len = mb_strlen($item["value"], "utf8");
        if ($key == "thing") {
            if ($len > 20) {
                $item["value"] = mb_substr($item["value"], 0, 20, "utf8");
            }
        } else {
            if ($key == "number") {
                if ($len > 32) {
                    $item["value"] = mb_substr($item["value"], 0, 32, "utf8");
                }
            } else {
                if ($key == "letter") {
                    if ($len > 32) {
                        $item["value"] = mb_substr($item["value"], 0, 32, "utf8");
                    }
                } else {
                    if ($key == "symbol") {
                        if ($len > 5) {
                            $item["value"] = mb_substr($item["value"], 0, 5, "utf8");
                        }
                    } else {
                        if ($key == "character_string") {
                            if ($len > 32) {
                                $item["value"] = mb_substr($item["value"], 0, 32, "utf8");
                            }
                        } else {
                            if (!($key == "time")) {
                                if (!($key == "date")) {
                                    if ($key == "amount") {
                                        $amount = trim($item["value"], "元");
                                        $amount = sprintf("%.2f", $amount);
                                        $item["value"] = $amount . "元";
                                    } else {
                                        if ($key == "phone_number") {
                                            if ($len > 17) {
                                                $item["value"] = mb_substr($item["value"], 0, 17, "utf8");
                                            }
                                        } else {
                                            if ($key == "car_number") {
                                                if ($len > 8) {
                                                    $item["value"] = mb_substr($item["value"], 0, 8, "utf8");
                                                }
                                            } else {
                                                if ($key == "name") {
                                                    if ($len > 10) {
                                                        $item["value"] = mb_substr($item["value"], 0, 10, "utf8");
                                                    }
                                                } else {
                                                    if ($key == "phrase") {
                                                        if ($len > 5) {
                                                            $item["value"] = mb_substr($item["value"], 0, 5, "utf8");
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    unset($item);
    $para = array("touser" => $touser, "template_id" => $template_id, "data" => $data, "page" => $page);
    $res = ihttp_post($sendapi, json_encode($para));
    if ($res["code"] == "200") {
        $res = @json_decode($res["content"], true);
        if ($res["errcode"] == 0) {
            return true;
        } else {
            return error($res["errcode"], $res["errmsg"]);
        }
    } else {
        return error(-1, "网络错误！");
    }
}
function addWeixinPriTemplate($priTemplateList)
{
    $categoryList = getWeixinCategory();
    if (is_error($categoryList)) {
        return $categoryList;
    }
    if (count($categoryList) == 0) {
        return error(-1, "请先添加公众号订阅通知类目：IT科技->软件服务提供商、电商平台->电商平台");
    }
    $category_1 = 0;
    $category_2 = 0;
    foreach ($categoryList as $item) {
        if ($item["name"] == "软件服务提供商") {
            $category_1 = $item["id"];
        }
        if ($item["name"] == "电商平台") {
            $category_2 = $item["id"];
        }
    }
    if ($category_1 == 0) {
        return error(-1, "请先添加公众号订阅通知类目：IT科技->软件服务提供商");
    }
    if ($category_2 == 0) {
        return error(-1, "请先添加公众号订阅通知类目：电商平台->电商平台");
    }
    foreach ($priTemplateList as &$item) {
        $priTmplId = addWeixinTemplate($item["tid"], $item["kidList"], $item["title"]);
        if (is_error($priTmplId)) {
            return $priTmplId;
        }
        $item["priTmplId"] = $priTmplId;
    }
    unset($item);
    return $priTemplateList;
}
function delWeixinPriTemplate($priTemplateList, $config)
{
    foreach ($priTemplateList as $item) {
        if (!empty($config[$item["name"]])) {
            $res = deleteWeixinTemplate($config[$item["name"]]);
            if (is_error($res)) {
                return $res;
            }
        }
    }
    return true;
}
function getActivityObjForLadderInvite($tableName, $aid)
{
    global $_W;
    $activitySql = "SELECT id, or_open_unfixed FROM " . ztbTable($tableName) . " where `deltime`=0 and `uniacid`=:uniacid and `activity_id`=:activity_id order by id asc ";
    $activityParams = array(":uniacid" => $_W["uniacid"], ":activity_id" => $aid);
    $activityObj = pdo_fetch($activitySql, $activityParams);
    if (empty($activityObj)) {
        exit("活动不存在或已被删除！");
    } else {
        return $activityObj;
    }
}
function rebatePrize(&$params)
{
    $prizeList = $params["prizeList"];
    if (!empty($prizeList)) {
        global $config;
        $uniacid = $params["uniacid"];
        $store_id = $params["store_id"];
        $activity_types = $params["activity_types"];
        $origin_id = $params["origin_id"];
        $object = $params["object"];
        $originModel = $params["originModel"];
        $userModel = $params["userModel"];
        $joinUserModel = $params["joinUserModel"];
        $joinModel = $params["joinModel"];
        $activity = $params["activity"];
        $rebateMethod = $params["rebateMethod"];
        $join_id = $joinModel["id"];
        $objJoinTableName = $params["objJoinTableName"];
        foreach ($prizeList as $key => $val) {
            if (!(intval($val["surplus"]) <= 0)) {
                if (!(intval($val["odds"]) <= 0)) {
                    if (!(intval($val["limittypes"]) == 0 && intval($val["limitnum"]) > 0)) {
                        if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                            $arr[$key] = $val["odds"];
                        } else {
                            $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                            if (!($count >= intval($val["limitnum"]))) {
                                $arr[$key] = $val["odds"];
                            } else {
                            }
                        }
                    } else {
                        $count = pdo_getcolumn(ztbNopreTable("user_draw"), array("prize_id" => $val["id"], "openid" => $joinUserModel["openid"]), "count(*)");
                        if (!($count >= intval($val["limitnum"]))) {
                            if (!(intval($val["limittypes"]) == 1 && intval($val["limitnum"]) > 0)) {
                                $arr[$key] = $val["odds"];
                            } else {
                                $count = pdo_fetchcolumn("SELECT COUNT(*) FROM " . ztbTable("user_draw") . " WHERE  prize_id = :prize_id AND openid = :openid AND FROM_UNIXTIME(createtime, '%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')", array(":prize_id" => $val["id"], ":openid" => $joinUserModel["openid"]));
                                if (!($count >= intval($val["limitnum"]))) {
                                    $arr[$key] = $val["odds"];
                                } else {
                                }
                            }
                        } else {
                        }
                    }
                } else {
                }
            } else {
            }
        }
        $prizeModel = null;
        if (!empty($arr)) {
            $rid = getRand($arr);
            $prizeModel = $prizeList[$rid];
        }
        if (!empty($prizeModel)) {
            $join_draw_data = array("uniacid" => $uniacid, "store_id" => $store_id, "activity_types" => $activity_types, "activity_id" => $object["activity_id"], "origin_team_id" => $originModel["team_id"], "origin_id" => $origin_id, "prize_id" => $prizeModel["id"], "types" => $prizeModel["types"], "name" => $prizeModel["name"], "pay_openid" => $userModel["openid"], "pay_nickname" => $userModel["nickname"], "pay_headurl" => $userModel["headurl"], "prize_pic_url" => $prizeModel["picurl"], "writeoff_types" => $prizeModel["writeoff_types"], "openid" => $joinUserModel["openid"], "nickname" => $joinUserModel["nickname"], "headurl" => $joinUserModel["headurl"], "register_data" => $joinModel["register_data"], "updatetime" => TIMESTAMP, "createtime" => TIMESTAMP);
            if ($rebateMethod == "ladder") {
                $join_draw_data["or_ladder"] = 1;
            }
            if ($rebateMethod == "rebate2") {
                $join_draw_data["or_rebate2"] = 1;
            }
            pdo_insert(ztbNopreTable("user_draw", false), $join_draw_data);
            $draw_id = pdo_insertid();
            $hashids = Hashids::instance(6, "lywyztb", '');
            $encode_id = $hashids->encode($draw_id);
            $join_draw_data = array("writecode" => $encode_id);
            pdo_update(ztbNopreTable("user_draw", false), $join_draw_data, array("id" => $draw_id));
            $writecode = $encode_id;
            if (intval($prizeModel["types"]) == 1) {
                if (intval($prizeModel["create_types"]) == 1) {
                    list($min, $max) = explode("-", $prizeModel["score"]);
                    $prizeModel["score"] = mt_rand($min, $max);
                }
                $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得积分：" . $prizeModel["score"];
                pdo_update(ztbNopreTable("user_account"), array("score +=" => $prizeModel["score"]), array("id" => $joinUserModel["id"]));
                $userScoreModel = array();
                $userScoreModel["uniacid"] = $uniacid;
                $userScoreModel["store_id"] = $store_id;
                $userScoreModel["openid"] = $joinUserModel["openid"];
                $userScoreModel["nickname"] = $joinUserModel["nickname"];
                $userScoreModel["headurl"] = $joinUserModel["headurl"];
                $userScoreModel["types"] = 1;
                $userScoreModel["activity_types"] = $activity_types;
                $userScoreModel["detail_id"] = $draw_id;
                $userScoreModel["score"] = $prizeModel["score"];
                $userScoreModel["note"] = $note;
                $userScoreModel["createtime"] = TIMESTAMP;
                pdo_insert(ztbNopreTable("user_score"), $userScoreModel);
                pdo_update(ztbNopreTable("user_draw"), array("score" => $prizeModel["score"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
            } else {
                if (intval($prizeModel["types"]) == 2) {
                    if (intval($prizeModel["create_types"]) == 1) {
                        list($min, $max) = explode("-", $prizeModel["sys"]);
                        $prizeModel["sys"] = mt_rand($min * 100, $max * 100) / 100;
                    }
                    $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得金额：" . $prizeModel["sys"] . "元";
                    $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                    if ($storeModel["money"] >= $prizeModel["sys"]) {
                        pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["sys"]), array("id" => $joinUserModel["id"]));
                        $userBillModel = array();
                        $userBillModel["uniacid"] = $uniacid;
                        $userBillModel["store_id"] = $store_id;
                        $userBillModel["openid"] = $joinUserModel["openid"];
                        $userBillModel["nickname"] = $joinUserModel["nickname"];
                        $userBillModel["headurl"] = $joinUserModel["headurl"];
                        $userBillModel["types"] = 3;
                        $userBillModel["detail_id"] = $draw_id;
                        $userBillModel["money"] = $prizeModel["sys"];
                        $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                        $userBillModel["note"] = $note;
                        $userBillModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                        pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["sys"])), array("id" => $store_id));
                        $storeBillModel = array();
                        $storeBillModel["uniacid"] = $uniacid;
                        $storeBillModel["store_id"] = $store_id;
                        $storeBillModel["types"] = 11;
                        $storeBillModel["detail_id"] = $draw_id;
                        $storeBillModel["money"] = $prizeModel["sys"];
                        $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                        $storeBillModel["note"] = $note;
                        $storeBillModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                    } else {
                        $sysReissueModel = array();
                        $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                        $sysReissueModel["store_id"] = $prizeModel["store_id"];
                        $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                        $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                        $sysReissueModel["draw_id"] = $draw_id;
                        $sysReissueModel["types"] = 2;
                        $sysReissueModel["openid"] = $joinUserModel["openid"];
                        $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                        $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                        $sysReissueModel["status"] = 0;
                        $sysReissueModel["money"] = $prizeModel["money"];
                        $sysReissueModel["desc"] = $prizeModel["name"];
                        $sysReissueModel["is_store_sell"] = 0;
                        $sysReissueModel["updatetime"] = TIMESTAMP;
                        $sysReissueModel["createtime"] = TIMESTAMP;
                        pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                    }
                    pdo_update(ztbNopreTable("user_draw"), array("sys" => $prizeModel["sys"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                    pdo_update(ztbTable($objJoinTableName, false), array("money +=" => floatval($prizeModel["sys"])), array("id" => $join_id));
                } else {
                    if (intval($prizeModel["types"]) == 3) {
                        if (intval($prizeModel["create_types"]) == 1) {
                            list($min, $max) = explode("-", $prizeModel["money"]);
                            $prizeModel["money"] = mt_rand($min * 100, $max * 100) / 100;
                        }
                        $note = "返利获得：" . timeToStr(TIMESTAMP) . " 会员【" . $joinUserModel["nickname"] . "】参与活动：" . $activity["title"] . "，获得红包：" . $prizeModel["money"] . "元";
                        $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                        if ($storeModel["money"] >= $prizeModel["money"]) {
                            pdo_update(ztbNopreTable("store_account"), array("money -=" => floatval($prizeModel["money"])), array("id" => $store_id));
                            $storeBillModel = array();
                            $storeBillModel["uniacid"] = $uniacid;
                            $storeBillModel["store_id"] = $store_id;
                            $storeBillModel["types"] = 11;
                            $storeBillModel["detail_id"] = $draw_id;
                            $storeBillModel["money"] = $prizeModel["money"];
                            $storeBillModel["balance"] = pdo_getcolumn(ztbNopreTable("store_account"), array("id" => $store_id), "money");
                            $storeBillModel["note"] = $note;
                            $storeBillModel["createtime"] = TIMESTAMP;
                            pdo_insert(ztbNopreTable("store_bill"), $storeBillModel);
                            $result = sendWeixinMchPay($joinUserModel["openid"], floatval($prizeModel["money"]) * 100, $prizeModel["name"], true, $uniacid, $config);
                            if (!($result === true)) {
                                $store_config = iunserializer($storeModel["config"]);
                                $is_mchpayfail_usermoney = isset($store_config["is_mchpayfail_usermoney"]) ? $store_config["is_mchpayfail_usermoney"] : 0;
                                if ($is_mchpayfail_usermoney == 0) {
                                    $sysReissueModel = array();
                                    $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                                    $sysReissueModel["store_id"] = $prizeModel["store_id"];
                                    $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                                    $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                                    $sysReissueModel["draw_id"] = $draw_id;
                                    $sysReissueModel["types"] = 1;
                                    $sysReissueModel["openid"] = $joinUserModel["openid"];
                                    $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                                    $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                                    $sysReissueModel["status"] = 0;
                                    $sysReissueModel["money"] = $prizeModel["money"];
                                    $sysReissueModel["desc"] = $prizeModel["name"];
                                    $sysReissueModel["is_store_sell"] = 1;
                                    $sysReissueModel["updatetime"] = TIMESTAMP;
                                    $sysReissueModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                                } else {
                                    pdo_update(ztbNopreTable("user_account"), array("money +=" => $prizeModel["money"]), array("id" => $joinUserModel["id"]));
                                    $userBillModel = array();
                                    $userBillModel["uniacid"] = $uniacid;
                                    $userBillModel["store_id"] = $store_id;
                                    $userBillModel["openid"] = $joinUserModel["openid"];
                                    $userBillModel["nickname"] = $joinUserModel["nickname"];
                                    $userBillModel["headurl"] = $joinUserModel["headurl"];
                                    $userBillModel["types"] = 3;
                                    $userBillModel["detail_id"] = $draw_id;
                                    $userBillModel["money"] = $prizeModel["money"];
                                    $userBillModel["balance"] = pdo_getcolumn(ztbNopreTable("user_account"), array("store_id" => $store_id, "openid" => $joinUserModel["openid"]), "money");
                                    $userBillModel["note"] = $note;
                                    $userBillModel["createtime"] = TIMESTAMP;
                                    pdo_insert(ztbNopreTable("user_bill"), $userBillModel);
                                }
                            }
                        } else {
                            $sysReissueModel = array();
                            $sysReissueModel["uniacid"] = $prizeModel["uniacid"];
                            $sysReissueModel["store_id"] = $prizeModel["store_id"];
                            $sysReissueModel["activity_types"] = $prizeModel["activity_types"];
                            $sysReissueModel["activity_id"] = $prizeModel["activity_id"];
                            $sysReissueModel["draw_id"] = $draw_id;
                            $sysReissueModel["types"] = 1;
                            $sysReissueModel["openid"] = $joinUserModel["openid"];
                            $sysReissueModel["nickname"] = $joinUserModel["nickname"];
                            $sysReissueModel["headurl"] = $joinUserModel["headurl"];
                            $sysReissueModel["status"] = 0;
                            $sysReissueModel["money"] = $prizeModel["money"];
                            $sysReissueModel["desc"] = $prizeModel["name"];
                            $sysReissueModel["is_store_sell"] = 0;
                            $sysReissueModel["updatetime"] = TIMESTAMP;
                            $sysReissueModel["createtime"] = TIMESTAMP;
                            pdo_insert(ztbNopreTable("sys_reissue"), $sysReissueModel);
                        }
                        pdo_update(ztbNopreTable("user_draw"), array("money" => $prizeModel["money"], "status" => 1, "updatetime" => TIMESTAMP), array("id" => $draw_id));
                        pdo_update(ztbTable($objJoinTableName, false), array("money +=" => floatval($prizeModel["money"])), array("id" => $join_id));
                    } else {
                        if (intval($prizeModel["types"]) == 5) {
                            $storeCard = pdo_get(ztbNopreTable("store_card"), array("deltime" => 0, "id" => $prizeModel["card_id"], "status" => 1));
                            if (!empty($storeCard)) {
                                pdo_update(ztbNopreTable("user_draw"), array("card_id" => $storeCard["id"], "card_use_num" => $storeCard["writeoff_num"], "card_writeoff_num" => 0, "card_money" => $storeCard["money"], "card_use_limit" => $storeCard["use_limit"], "card_end_time" => $storeCard["time_types"] == 0 ? TIMESTAMP + intval($storeCard["time_day"]) * 24 * 60 * 60 : $storeCard["time_end"], "card_pic_url" => $storeCard["pic_url"]), array("id" => $draw_id));
                            }
                        }
                    }
                }
            }
            pdo_update(ztbNopreTable("obj_prize"), array("surplus -=" => 1), array("id" => $prizeModel["id"]));
            pdo_update(ztbNopreTable("obj_activity"), array("get_num +=" => 1), array("id" => $object["activity_id"]));
            if (!empty($origin_id)) {
                pdo_update(ztbNopreTable("marketing_user"), array("get_num +=" => 1), array("id" => $origin_id));
            }
            if (!empty($joinUserModel["mobile"])) {
                $storeModel = pdo_get(ztbNopreTable("store_account"), array("uniacid" => $uniacid, "id" => $store_id));
                if ($prizeModel["is_sms"] == 1 && $storeModel["sms"] > 0) {
                    if (!empty($prizeModel["sms_tmp"])) {
                        $sms_uid = $config["sms_uid"];
                        $sms_key = $config["sms_key"];
                        $mobile = $joinUserModel["mobile"];
                        $sms_content = $prizeModel["sms_tmp"];
                        $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                        $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                        $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                        $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                        if (empty($storeModel["zucp_ext"])) {
                            $sms_content .= "【{$config["name"]}】";
                        } else {
                            $sms_content .= "【{$storeModel["name"]}】";
                        }
                        $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                        if ($result === true) {
                            pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                            pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                        }
                    }
                } else {
                    if (intval($object["draw_is_sms"]) == 1 && $storeModel["sms"] > 0) {
                        if (!empty($object["draw_sms_tmp"])) {
                            $sms_uid = $config["sms_uid"];
                            $sms_key = $config["sms_key"];
                            $mobile = $joinUserModel["mobile"];
                            $sms_content = $prizeModel["sms_tmp"];
                            $sms_content = str_replace("{NICKNAME}", $joinUserModel["nickname"], $sms_content);
                            $sms_content = str_replace("{PRIZE}", $prizeModel["name"], $sms_content);
                            $sms_content = str_replace("{WRITEOFFCODE}", $writecode, $sms_content);
                            $sms_content = str_replace("{OBJ}", $activity["title"], $sms_content);
                            if (empty($storeModel["zucp_ext"])) {
                                $sms_content .= "【{$config["name"]}】";
                            } else {
                                $sms_content .= "【{$storeModel["name"]}】";
                            }
                            $result = zucp_mt($sms_uid, $sms_key, $mobile, $sms_content, $storeModel["zucp_ext"], '', '');
                            if ($result === true) {
                                pdo_update(ztbNopreTable("store_account"), array("sms -=" => 1), array("id" => $store_id));
                                pdo_insert(ztbNopreTable("sys_sms"), array("uniacid" => $uniacid, "store_id" => $store_id, "mobile" => $mobile, "reason" => "返利通知", "note" => $sms_content, "createtime" => TIMESTAMP));
                            }
                        }
                    }
                }
            }
        }
    }
}