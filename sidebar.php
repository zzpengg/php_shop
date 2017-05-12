<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
$name = $_SESSION['user_id'];
$sql21 = "SELECT * FROM cart where name = '$name'  ";// 指定SQL查詢字串
$result21 = mysqli_query($link, $sql21);
$total_records=mysqli_num_rows($result21); //總筆數


?>

<div id="sidebar" class="span3">
		<div class="well well-small"><a id="myCart" href="product_summary.php"><img src="themes/images/ico-cart.png" alt="cart">已選購商品(<?= $total_records ?>)  <span class="badge badge-warning pull-right"><!--PHP寫在這裡啦靠杯--></span></a></div>
    <div class="span6">
			<ul>
		<?

		  for($i=1;$i<=$total_records;$i++){
			  $row10 = mysqli_fetch_row($result21);
				$which2 = substr("$row10[3]",23,-4);
						echo "<li><a href=\"product_details.php?which=".$which2."&page=1\">".$row10[1]."</a></li>";
					}
			?>
		</ul>
	</div>


		<ul id="sideManu" class="nav nav-tabs nav-stacked">
			<li class="subMenu"><a> 線上遊戲周邊 <!--PHP寫在這裡啦靠杯--></a>
				<ul style="display:none">
				<li><a href="products.php?which=c&page=1"><i class="icon-chevron-right"></i>衣服</a></li>
				<li><a href="products.php?which=p&page=1"><i class="icon-chevron-right"></i>海報</a></li>
				<li><a href="products.php?which=d&page=1"><i class="icon-chevron-right"></i>公仔</a></li>
				<li><a href="products.php?which=do&page=1"><i class="icon-chevron-right"></i>絨毛玩具</a></li>
			</ul>
			</li>
		</ul>
		<br/>
		  <div class="thumbnail">
			<img src="themes/images/products/T毛帽.jpg" alt="Bootshop panasonoc New camera"/>
			<div class="caption">
			  <h5>提摩</h5>
				<h4 style="text-align:center"><a class="btn"> <i class="icon-zoom-in"></i></a>
					<a class="btn">非賣品<i class="icon-shopping-cart"></i></a> <a class="btn btn-primary">我老婆</a></h4>
			</div>
		  </div><br/>

	</div>
