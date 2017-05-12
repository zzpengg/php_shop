<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$limits = $_SESSION['limits'];
$which = $_GET['which'] ;
echo $which;
$sql = "SELECT * FROM products where addr like '%$which%' ";// 指定SQL查詢字串

// 送出Big5編碼的MySQL指令
// 送出查詢的SQL指令
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);
$products_name = $row[1];

$name = $_SESSION['user_id'];
$sql4 = "SELECT * FROM cart where name = '$name' and products = '$products_name'";// 指定SQL查詢字串
$result4 = mysqli_query($link, $sql4);
$row4 = mysqli_fetch_row($result4);
$num = $_GET['num'];
if($num==null)
  $num = 1;
echo $num;
if ($_SESSION['user_id'] != null && $row4[0]==$name && $row4[1]==$products_name)
{
  $sql3="update cart set quantity =".$num." where name='$name' and products = '$products_name' ";
  if ( $result = mysqli_query($link, $sql3) ) // 送出查詢的SQL指令
  {
    echo '<script type="text/javascript">alert("更新成功!");</script>';
  }
  else{
    echo '<script type="text/javascript">alert("更新失敗!");</script>';
  }
}
else if ($_SESSION['user_id'] != null )
{
  $sql3="insert into cart value ('" . $_SESSION['user_id'] . "','" . $row[1]. "','" . $num ."','" . $row[4] ."','". $row[2] ."','".date("Y-m-d H:i:s") ."')";
  if ( $result = mysqli_query($link, $sql3) ) // 送出查詢的SQL指令
  {
    echo '<script type="text/javascript">alert("加入成功!");</script>';
  }
  else{
    echo '<script type="text/javascript">alert("加入失敗!");</script>';
  }
}

echo'<script>window.history.back();</script>';

?>
