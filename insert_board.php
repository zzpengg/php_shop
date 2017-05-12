<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$which = $_POST['which'] ;
$content = $_POST['content'];

echo $which;
echo $content;
$sql = "SELECT * FROM products where addr like '%$which%' ";// 指定SQL查詢字串

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);
$pn = $row[1];

echo $pn;
if ($_SESSION['user_id'] != null && $content != null)
{
  $sql="insert into board value ('','" . $pn . "','" . $_SESSION['user_id'] . "','"  . $content. "','" . date("Y-m-d H:i:s") ."')";
  if ( $result = mysqli_query($link, $sql) ) // 送出查詢的SQL指令
  {
    echo "OK";
    echo '<script type="text/javascript">alert("留言成功!");</script>';
  }
  else{
    echo "GG";
    echo '<script type="text/javascript">alert("留言失敗!");</script>';
  }
}

//echo'<script>window.history.back();</script>';

?>
