<?
session_start();


date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$addr = "themes/images/products/" .  $_POST['addr'] ;
if(!isset($_SESSION['decide'])){
$_SESSION['decide'] = 0;
}
//若尚未處理過，在送出表單時，SESSION值會為0，因此在判斷時(0=0)會成立，並繼續處理表單資料
if ($_SESSION['decide']==$_POST['decide']) {

//正常透過表單按鈕送出資料，則將SESSION的值+1，並處理表單資料
$_SESSION['decide'] += 1;
if (isset($_POST['addr']) && isset($_POST['name']))
{
  $sql="insert into products value ('" . $_POST['kind'] . "','" . $_POST['name'] . "','" . $_POST['cost']. "','" . $_POST['content']. "','" . $addr. "')";
  $result = mysqli_query($link, $sql);
  $sql="insert into products2 value ('" . $_POST['name'] . "','" . $_POST['s1']. "','" . $_POST['s2']. "','" . $_POST['s3']. "','" . $_POST['s4'] ."')";
  $result = mysqli_query($link, $sql);
	mysqli_close($link); // 關閉資料庫連結
}

}
else if(isset($_POST['name']))
{
  echo '<script type="text/javascript">alert("重複提交!或有空格沒填!");</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>詳細資訊</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->

<!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
  </head>
<body>
<? include("header.php"); ?>
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<? include ("sidebar.php"); ?>
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.php">Home</a> <span class="divider">/</span></li>    
    <li class="active">new_product</li>
    </ul>
	<div class="row">
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">新增商品</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">

			            <h4>新增商品</h4>
                  <div align="center">
                  <span style="font-size:15pt;color:blue;font-weight:bold">新增商品</span>
                  <form name='form1' method='POST' action=''>
                  	<table border="1" width="500" id="table1">
                  		<tr>
                  			<td width="100" align="center">商品名稱</td>
                  			<td align="center"><input type="text" name="name" value=""></td>
                  		</tr>
                      <tr>
                  			<td width="100" align="center">商品種類</td>
                  			<td align="center">
                          <input type="radio" name="kind" value="c" checked>外套
                          <input type="radio" name="kind" value="d">公仔
                          <input type="radio" name="kind" value="do">玩偶
                          <input type="radio" name="kind" value="m">模型
                          <input type="radio" name="kind" value="p">海報
                          <input type="radio" name="kind" value="t">T-shirt
                        </td>
                  		</tr>
                  		<tr>
                  			<td width="100" align="center">商品價格</td>
                  			<td align="center">
                          <input type='text' name='cost'>
                        </td>
                  		</tr>
                  		<tr>
                  			<td width="100" align="center">商品內容</td>
                  			<td align="center"><input type='text' name='content' size='30'>　</td>
                  		</tr>
                  		<tr>
                  			<td width="100" align="center">商品圖片名稱</td>
                  			<td align="center"><input type='text' name='addr' size='50'>　</td>
                  		</tr>
                  		<tr>
                  			<td width="100" align="center">商品規格1</td>
                  			<td align="center"><textarea name='s1' rows='10' cols='50'></textarea></td>
                  		</tr>
                      <tr>
                  			<td width="100" align="center">商品規格2</td>
                  			<td align="center"><textarea name='s2' rows='10' cols='50'></textarea></td>
                  		</tr>
                      <tr>
                  			<td width="100" align="center">商品規格3</td>
                  			<td align="center"><textarea name='s3' rows='10' cols='50'></textarea></td>
                  		</tr>
                      <tr>
                  			<td width="100" align="center">商品規格4</td>
                  			<td align="center"><textarea name='s4' rows='10' cols='50'></textarea></td>
                  		</tr>
                  		<tr>
                  			<td colspan='2' align="center">
                          <input class="btn" name='B1' type='submit' value=' 送 出 '>　
                          <input class="btn" name='B2' type='reset' value=' 取消 ' onclick="javascript:location.href='new_products.php'">
                        </td>
                  		</tr>
                  	</table>
                  </form>
                  <span></span>
                  </div>


              </div>

		</div>
          </div>

	</div>
</div>
</div> </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer  ================================================================== -->
	<? include("footer.php"); ?>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>

	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>

	<!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
	<div id="themeContainer">
	<div id="hideme" class="themeTitle">樣式選擇</div>
	<div class="themeName">經典樣式</div>
	<div class="images style">
	<a href="themes/css/#" name="bootshop"><img src="themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
	<a href="themes/css/#" name="businessltd"><img src="themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
	</div>
	<div class="themeName">其他樣式 (11)</div>
	<div class="images style">
		<a href="themes/css/#" name="amelia" title="Amelia"><img src="themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spruce" title="Spruce"><img src="themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
		<a href="themes/css/#" name="superhero" title="Superhero"><img src="themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cyborg"><img src="themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cerulean"><img src="themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="journal"><img src="themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="readable"><img src="themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="simplex"><img src="themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="slate"><img src="themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spacelab"><img src="themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="united"><img src="themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
		<p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
	</div>
	<div class="themeName">背景顏色 </div>
	<div class="images patterns">
		<a href="themes/css/#" name="pattern1"><img src="themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
		<a href="themes/css/#" name="pattern2"><img src="themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern3"><img src="themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern4"><img src="themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern5"><img src="themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern6"><img src="themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern7"><img src="themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern8"><img src="themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern9"><img src="themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern10"><img src="themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>

		<a href="themes/css/#" name="pattern11"><img src="themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern12"><img src="themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern13"><img src="themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern14"><img src="themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern15"><img src="themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>

		<a href="themes/css/#" name="pattern16"><img src="themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern17"><img src="themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern18"><img src="themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern19"><img src="themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern20"><img src="themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>

	</div>
	</div>
</div>
<span id="themesBtn"></span>
</body>
</html>
