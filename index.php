<?
session_start();

$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

$id = $_POST['account'];
$pwd = $_POST['password'];

  $sql="SELECT account , password ,limits FROM member where account = '$id' ";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_row($result);

  $sql2="SELECT * FROM products where kind = 'd' ";
  $result2 = mysqli_query($link, $sql2);

  $sql3="SELECT * FROM products where kind = 'p' ";
  $result3 = mysqli_query($link, $sql3);

  if ($id != null && $pwd != null && $row[0] == $id && $row[1] == $pwd && $_POST['captcha']==$_SESSION['captcha'])
  {
    $_SESSION['user_id'] = $_POST['account'] ;
    $_SESSION['limits'] = $row[2];
    echo '<script type="text/javascript">alert("登入成功!");</script>';
    echo'<script>window.location.href="index.php";</script>';

  }
  else if($_POST['decide']==1)//沒寫出來
  {
    echo '<script type="text/javascript">alert("登入失敗!");</script>';
  }

	mysqli_close($link); // 關閉資料庫連結

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>主頁</title>
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
<? include("header.php") ?>
<!-- Header End====================================================================== -->
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <div class="item active">
		  <div class="container">
			<a href="product_details.php?which=c4&page=1"><img style="width:100%" src="themes/images/carousel/c4.png" alt="special offers"/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="product_details.php?which=d1&page=1"><img style="width:100%" src="themes/images/carousel/d1.png" alt=""/></a>
				<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="product_details.php?which=d11&page=1"><img src="themes/images/carousel/d11.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>

		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="product_details.php?which=d12&page=1"><img src="themes/images/carousel/d12.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>

		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="product_details.php?which=m3&page=1"><img src="themes/images/carousel/m3.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
			</div>
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="product_details.php?which=p1&page=1"><img src="themes/images/carousel/p1.png" alt=""/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div>
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<? include ("sidebar.php"); ?>
<!-- Sidebar end=============================================== -->
		<div class="span9">
			<div class="well well-small">
			<h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
			  <div class="item active">
			  <ul class="thumbnails">
          <?


          for($j=1;$j<=4;$j++)
          {
            if($result2)
            $row2 = mysqli_fetch_row($result2);

				echo "<li class=\"span3\">
				  <div class=\"thumbnail\">
				  <i class=\"tag\"></i>";
          $which = substr("$row2[4]",23,-4);
					echo "<a href=\"product_details.php?which=" . $which . "&page=1 \"><img src=\" ". $row2[4] . "\"></a>";
					echo "<div class=\"caption\">";
					  echo "<h5>" . $row2[1] . "</h5>";
					  echo "<h4><a class=\"btn\" href=\"product_details.php?which=" . $which . "&page=1 \">VIEW</a> <span class=\"pull-right\">". $row2[2] . "</span></h4>
					</div>
				  </div>
				</li>";}
				?>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
          <?

          for($j=1;$j<=4;$j++)
          {
            if($result2)
            $row2 = mysqli_fetch_row($result2);

        echo "<li class=\"span3\">
          <div class=\"thumbnail\">
          <i class=\"tag\"></i>";
          $which = substr("$row2[4]",23,-4);
          echo "<a href=\"product_details.php?which=" . $which . "&page=1 \"><img src=\" ". $row2[4] . "\"></a>
          <div class=\"caption\">
            <h5>" . $row2[1] . "</h5>";
            echo "<h4><a class=\"btn\" href=\"product_details.php?which=" . $which . "&page=1 \">VIEW</a> <span class=\"pull-right\">". $row2[2] . "</span></h4>
          </div>
          </div>
        </li>";}
        ?>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
          <?

          for($j=1;$j<=4;$j++)
          {
            if($result2)
            $row2 = mysqli_fetch_row($result2);

        echo "<li class=\"span3\">
          <div class=\"thumbnail\">
          <i class=\"tag\"></i>";
          $which = substr("$row2[4]",23,-4);
          echo "<a href=\"product_details.php?which=" . $which . "&page=1 \"><img src=\" ". $row2[4] . "\"></a>
          <div class=\"caption\">
            <h5>" . $row2[1] . "</h5>";
            echo "<h4><a class=\"btn\" href=\"product_details.php?which=" . $which . "&page=1 \">VIEW</a> <span class=\"pull-right\">". $row2[2] . "</span></h4>
          </div>
          </div>
        </li>";}
        ?>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
          <?

          for($j=1;$j<=4;$j++)
          {
            if($result2)
            $row2 = mysqli_fetch_row($result2);

        echo "<li class=\"span3\">
          <div class=\"thumbnail\">
          <i class=\"tag\"></i>";
          $which = substr("$row2[4]",23,-4);
          echo "<a href=\"product_details.php?which=" . $which . "&page=1 \"><img src=\" ". $row2[4] . "\"></a>
          <div class=\"caption\">
            <h5>" . $row2[1] . "</h5>";
            echo "<h4><a class=\"btn\" href=\"product_details.php?which=" . $which . "&page=1 \">VIEW</a> <span class=\"pull-right\">". $row2[2] . "</span></h4>
          </div>
          </div>
        </li>";}
        ?>
			  </ul>
			  </div>
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
		<h4>Latest Products </h4>
			  <ul class="thumbnails">
          <?
          for($j=1;$j<=6;$j++)
          {
            if($result3)
            $row3 = mysqli_fetch_row($result3);


				echo "<li class=\"span3\">";;
				echo "<div class=\"thumbnail\">";
        $which = substr("$row3[4]",23,-4);
				echo	"<a  href=\"product_details.php?which=" . $which . "&page=1\"><img src=\" ". $row3[4] ."\" /></a>";
				echo	"<div class=\"caption\">";
				echo	  "<h5>".$row3[1] . "</h5>";

				echo	  "<h4 style=\"text-align:center\">
                 <a class=\"btn\" href=\"product_details.php?which=".$which."&page=1\">
                 <i class=\"icon-zoom-in\"></i></a>";
           echo "<a class=\"btn btn-success\" href=\"cart.php?which=".$which."\">加入購物車</a>";
           echo "<span class=\"pull-right\">$".$row3[2]."</span></h4>";
				echo	"</div>
				  </div>
				</li>";
      } ?>

			  </ul>

		</div>
		</div>
	</div>
</div>
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
