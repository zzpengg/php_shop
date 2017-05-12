<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$limits = $_SESSION['limits'];
$which = $_GET['which'] ;
$_SESSION['which'] = $which;

$sql = "SELECT * FROM products where addr like '%$which%' ";// 指定SQL查詢字串

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);

$products_name = $row[1];
$sql2 = "SELECT * FROM products2 where name like '$products_name' ";// 指定SQL查詢字串
$result2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_row($result2);

$content = $_POST['content'];
$pn = $row[1];

$name = $_SESSION['user_id'];
$sql4 = "SELECT * FROM cart where name = '$name' and products = '$products_name'";// 指定SQL查詢字串
$result4 = mysqli_query($link, $sql4);
$row4 = mysqli_fetch_row($result4);

//************************************************

$value = $_POST['value'];

echo'<ul>';

$query="SELECT name, addr FROM products WHERE name LIKE '%$value%'";
$result2 = mysqli_query($link, $query);
$total_records = mysqli_num_rows($result2);
while($run=mysqli_fetch_array($result2))
{
	$name=$run['name'];
	$addr=$run['addr'];
	if($total_records != 0)
    {
     //總筆數
		echo '<li><a href="product_details.php?which='.$addr .'&page=1\">'.$name.'</a></li>';
	}
}

echo '</ul>';
?>
