<?
//captcha.php
//產生圖形驗證碼,並寫入session
session_start();
header("Content-type: image/png");
$image = ImageCreateFromPNG("./themes/images/flowers.png"); //背景圖片
$color_black = ImageColorAllocate($image,0,0,0);

$string = rand(111111,999999); //產生圖形驗證碼
imagestring($image,10,10,5, $string,$color_black);
ImageJPEG($image);
$_SESSION['captcha'] = $string; //寫入session

?>
