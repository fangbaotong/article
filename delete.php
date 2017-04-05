<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);
$ui = $_REQUEST['ui'];
$str = $ui . "{**}";
$fp = fopen("./html/html.txt", "r");
$con = fread($fp, filesize("./html/html.txt"));
fclose($fp);
$con = str_replace($str, '', $con);
$fp = fopen("./html/html.txt", "w");
fwrite($fp, $con);
fclose($fp);
$ui = iconv("UTF-8", "gb2312", $ui);
$file = "./html/" . $ui;
$result = unlink($file);
if ($result !== false) {
    echo "删除成功";
} else {
    echo "删除失败";
