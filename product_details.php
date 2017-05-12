<?
session_start();

$arr_cart = array_filter(explode(",",$_SESSION['cart']));

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$limits = $_SESSION['limits'];
$which = $_GET['which'] ;
$page = $_GET['page'] ;

$sql = "SELECT * FROM products where addr like '%$which%' ";// 指定SQL查詢字串

// 送出Big5編碼的MySQL指令
// 送出查詢的SQL指令
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);

$products_name = $row[1];
$pn = $row[1];

$sql2 = "SELECT * FROM products2 where name like '$products_name' ";// 指定SQL查詢字串
$result2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_row($result2);

$name = $_SESSION['user_id'];
$sql4 = "SELECT * FROM cart where name = '$name' and products = '$products_name'";// 指定SQL查詢字串
$result4 = mysqli_query($link, $sql4);
$row4 = mysqli_fetch_row($result4);

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
    <li class="active">product Details</li>
    </ul>
	<div class="row">
			<div id="gallery" class="span3">
            <a href="<?= $row[4] ?>" title="<? echo $row[1] ;?>" >
				       <img src="<?= $row[4] ?>" style="width:100%" alt="<? echo $row[1] ;?>"/>
            </a>

			 <div class="btn-toolbar">
			</div>
			</div>
			<div class="span6">
				<h3><?= $row[1] ; ?></h3>
				<hr class="soft"/>
				<? echo "<form class=\"form-horizontal qtyFrm\" name=\"form2\" method=\"GET\" action=\"cart.php\">"; ?>
				  <div class="control-group">
					<label class="control-label"><span><?= "$" .$row[2] ?></span></label>
					<div class="controls">
					<input type="number" class="span1" name="num" placeholder="Qty."/>
            <? $which = substr("$row[4]",23,-4) ?>
            <input type="hidden" name="which" value="<?= $which ?>" >
					  <button type="submit" class="btn btn-large btn-primary pull-right" > Add to cart <i class=" icon-shopping-cart"></i></button>
					</div>
				  </div>
				</form>

				<hr class="soft clr"/>
				<p>
				<?= $row[3] ?>
				</p>

			<hr class="soft"/>
      <p>
        <ul>
          <? if($row2[1] != null) echo "<li> .$row2[1]. </li> "; ?>
          <? if($row2[2] != null) echo "<li> .$row2[2]. </li> "; ?>
          <? if($row2[3] != null) echo "<li> .$row2[3]. </li> "; ?>
          <? if($row2[4] != null) echo "<li> .$row2[4]. </li> "; ?>
        </ul>

      </p>

			</div>

			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">顯示留言</a></li>
              <li><a href="#profile" data-toggle="tab">留下評論</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
                <?php
                date_default_timezone_set("Asia/Taipei");
                $link = mysqli_connect("localhost","root","123456","group_10")
                or die("無法開啟MySQL資料庫連結!<br>");
                mysqli_query($link, 'SET CHARACTER SET utf8');
                mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

                $sql = "select * from board where subject = '$pn' order by time desc";//讓資料由最新呈現到最舊
                $result = mysqli_query($link, $sql);
                $total_records=mysqli_num_rows($result); //總筆數
                ?>

                    <?php
                    $total_page= ceil($total_records / 4) ; //計算頁數
                    mysqli_data_seek($result, ($_GET['page']-1)*4); //指標移至該頁第一筆記錄

                    if(($total_records-($_GET['page']-1)*4)>=4)
                      $pag=4;
                    else
                      $pag=$total_records-($_GET['page']-1)*4;

                    for($i=1;$i<=$pag;$i++){
                     $rs=mysqli_fetch_assoc($result);
                    ?>
                      <table border="1" align="center">
                        <? if($limits==1){ ?>
                            <tr>
                              <td><button class="btn btn-success"><a href="delete.php?id=<?php echo $rs['id']?>">刪除</a></button></td>
                            </tr>
                        <? }    ;?>
                            <tr>
                              <td>留言主題</td>
                              <td><? echo $rs['subject']?></td>
                            </tr>
                            <tr>
                              <td width="200px">暱稱</td>
                              <td width="500px"><?php echo $rs['name']?></td>
                            </tr>
                            <tr>
                              <td>留言內容</td>
                              <td><?php echo $rs['content']?></td>
                            </tr>
                            <tr>
                              <td>留言時間</td>
                              <td><?php echo $rs['time']?></td>
                            </tr>

                        </table>
                        <hr class="soft"/>
                      <?php } ?>


                <br />

                <?

                for($i=1;$i<=$total_page;$i++)
                {

                if ($i==$_GET['page']){}
                else {

                echo "<a href='".$_SERVER['PHP_SELF'] ."?which=$which&page=$i'> $i </a>&nbsp;&nbsp;";
              }
                }
                echo "</td></tr>";
                if($rs['subject'] ==null) echo "<h3>目前尚未有人留言<h3>";

                ?>


                  </div>
		<div class="tab-pane fade" id="profile">

		<div class="tab-content">
      <h4>留言板</h4>
      <div align="center">
      <span style="font-size:15pt;color:blue;font-weight:bold">訪客留言版</span>
      <? if($limits==2 || $limits==1){echo "<form name=\"form2\" method=\"POST\" action=\"insert_board.php\">"; ?>
        <table border="1" width="500" id="table1">
          <tr>
            <td width="100" align="center">姓 名</td>
            <td align="center"><h3><?= $_SESSION['user_id'] ?> </h3></td>
          </tr>
          <tr>
            <td width="100" align="center">標  題</td>
            <? $pn = $row[1]; ?>
            <td align="center"><h3><?= $pn ?> </h3></td>
          </tr>
          <tr>
            <td width="100" align="center">留言內容</td>
            <td align="center"><textarea name='content' rows='10' cols='50'></textarea></td>
          </tr>
          <tr>
            <td colspan='2' align="center">
              <input type="hidden" value="<?= $which?>" name="which">
              <button type="submit" class="btn btn-success" name="B1">送出</button>
            </td>
          </tr>
        </table>
        <? }else {echo "<h3>需先登入<h3>";}?>
      </form>
      <span></span>
      </div>

		</div>
				<br class="clr">
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
