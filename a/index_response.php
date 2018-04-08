<?php

session_start();

require_once('db.php');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (!$db) 
{
  die("无法连接数据库 ，错误信息：".mysql_error());
  exit(0);
}

$rs = "select * from xian";//取得记录总数，计算总页数用 
$count = $db->query($rs);
$numrows = mysqli_num_rows($count);

$num=$numrows+1;
$db->query("SET NAMES UTF8");

$content = $_POST["content"];
$se = $_SESSION['nickname'];
$time = date("Y-m-d h:i:sa");

$query = "INSERT INTO xian (cont,time,th,nickname) VALUES ('$content','$time','$num','$se')";

$db->query($query);

header('Location: '."html.php");



?>