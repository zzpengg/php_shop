<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
$name = $_SESSION['user_id'];
$sql20 = "SELECT * FROM cart where name = '$name'  ";// 指定SQL查詢字串
$result20 = mysqli_query($link, $sql20);
$total_records=mysqli_num_rows($result20); //總筆數


?>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">歡迎來到召喚峽谷!<strong><?= $_SESSION['user_id'] ?></strong></div>
	<div class="span6">
	<div class="pull-right">
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i id="cart_cnt" ></i>已選購物品[<?= $total_records ?>]</span> </a>
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar" >
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="Bootsshop"/></a>
    <ul id="topMenu" class="nav pull-right">
			<li><a href="search.php">搜尋商品</a></li>
	    <li><a href="register.php">註冊</a></li>

   <?
   if(isset($_SESSION['user_id'])){
	  echo "<a href=\"logout.php\" role=\"button\" style=\"padding-right:0\"><span class=\"btn btn-large btn-success\">Logout</span></a>";
    }
   else
    echo "<a href=\"#login\" role=\"button\" data-toggle=\"modal\" style=\"padding-right:0\"><span class=\"btn btn-large btn-success\">Login</span></a>";
   ?>

  <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>登入</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm" action="index.php" method="POST">
			  <div class="control-group">
				<input type="text" id="account" placeholder="Account" name = "account">
			  </div>
			  <div class="control-group">
				<input type="password" id="password" placeholder="Password" name = "password">
			  </div>
				<div class="control-group">
				<input type="text" name="captcha" size="10" placeholder="驗證碼">　<img src="captcha.php">
			  </div>
			  <div class="control-group">
				<label class="checkbox">
				<input type="checkbox">想勾就勾
				</label>
			  </div>
				<input type="hidden" name="decide" value="1">
        <button type="submit" class="btn btn-success">登入</button>
  			<button class="btn" data-dismiss="modal" aria-hidden="true">關掉啦</button>
			</form>

		  </div>
	</div>
	</li>
    </ul>
  </div>
</div>
</div>
</div>
