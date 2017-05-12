<?php
session_start();

$id=$_GET['id'];

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$sql = "delete from board where id = '$id' ";//讓資料由最新呈現到最舊
$result = mysqli_query($link, $sql);

echo'<script>window.history.back();</script>';

?>
