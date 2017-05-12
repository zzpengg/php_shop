<?
session_start();

date_default_timezone_set("Asia/Taipei");
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

  $which = $_GET['which'] ;
  $kind = $which;
  if($which=='c')
    $sql="SELECT * from products where kind = '$which' or kind = 't' ";
  else if($which == 'do')
    $sql="SELECT * from products where kind = '$which' or kind = 'm' ";
  else
    $sql="SELECT * from products where kind = '$which' ";

  $select = $_GET['select'];

  if($select==1 && $which=='c')
  {
    $sql="SELECT * from products where kind = '$which' or kind = 't' order by cost ";
  }
  else if($select==1 && $which == 'do')
  {
    $sql="SELECT * from products where kind = '$which' or kind = 't' order by cost ";
  }
  else if($select==1)
    $sql="SELECT * from products where kind = '$which' order by cost";



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>產品介紹</title>
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
		<li><a href="index.php">首頁</a> <span class="divider">/</span></li>
		<li class="active">產品</li>
    </ul>
	<h3> 產品 <small class="pull-right"> 40個產品 </small></h3>
	<hr class="soft"/>
  <? echo $kind; ?>
	<? echo "<form class=\"form-horizontal span6\" action=\"products.php? \">"; ?>
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
			<select name="select">
              <option value="0">產品</option>
              <option value="1">低價優先</option>
      </select>
      <input type="hidden" name="which" value="<?= $kind ?>">
      <input type="hidden" name="page" value="1">
      <button type="submit" class="btn">確認</button>
		</div>
	  </form>

<div id="myTab" class="pull-right">
 <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content">
	<div class="tab-pane  active" id="listView">
    <?
    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result); //總筆數
    $total_page= ceil($total_records / 6) ; //計算頁數

    mysqli_data_seek($result, ($_GET['page']-1)*6); //指標移至該頁第一筆記錄
    if(($total_records-($_GET['page']-1)*6)>=6)
      $pag=6;
    else
      $pag=$total_records-($_GET['page']-1)*6;
    for($j=1;$j<=$pag;$j++)
    {
         $row = mysqli_fetch_row($result) ;



    echo "<hr class=\"soft\"/>
		<div class=\"row\">
		<div class=\"span2\">
				<img src=\"" . $row[4] . "\" alt=\"\"/>
			</div>";
		echo "<div class=\"span4\">
				<h3>" . $row[1] . "</h3>
				<hr class=\"soft\"/>
				<h5>產品 </h5>";
				echo "<p>" . $row[3] . "</p>
				<a class=\"btn btn-small pull-right\" href=\"product_details.php?which=".$row[4] ."&page=1\">詳細資料</a>
				<br class=\"clr\"/>
			</div>
			<div class=\"span3 alignR\">
			<form class=\"form-horizontal qtyFrm\">";
      $which = substr("$row[4]",23,-4);
			echo "<h3>" . $row[2] . " NTD</h3>
			<br/>

			  <a href=\"cart.php?which=".$which."\" class=\"btn btn-large btn-primary\"> 加入 <i class=\" icon-shopping-cart\"></i></a>
			  <a href=\"#\" class=\"btn btn-large\"><i class=\"icon-zoom-in\"></i></a>

				</form>
			</div>
		</div>";
    }

    ?>



	</div>

	<div class="tab-pane" id="blockView">
		<ul class="thumbnails">
      <?
      mysqli_data_seek($result, ($_GET['page']-1)*6); //指標移至該頁第一筆記錄
      if(($total_records-($_GET['page']-1)*6)>=6)
        $pag=6;
      else
        $pag=$total_records-($_GET['page']-1)*6;

      for($j=1;$j<=$pag;$j++)
      {
           $row = mysqli_fetch_row($result) ;
			echo "<li class=\"span3\">
			  <div class=\"thumbnail\">";
			echo "	<a href=\"product_details.php?which=" .$row[4]. "&page=1\"><img src=\"". $row[4] ." \" /></a>";
			echo "	<div class=\"caption\">";
			echo "	  <h5>".$row[1]."</h5>";
      $which = substr("$row[4]",23,-4);
			echo "	   <h4 style=\"text-align:center\">
                 <a class=\"btn\" href=\"product_details.php?which=".$row[4]."&page=1\"> <i class=\"icon-zoom-in\"></i></a>
                 <a class=\"btn\" href=\"cart.php?which=".$which."\">加入 <i class=\"icon-shopping-cart\"></i></a>
                 <a class=\"btn btn-primary\" href=\"#\">".$row[2]." NTD</a></h4>";
			echo"	</div>
			  </div>
			</li>";
    }
      ?>
		  </ul>
	<hr class="soft"/>
	</div>
</div>
	<div class="pagination">
			<?
      echo "<ul>";
      for($j=1;$j<=$total_page;$j++){
      if ($j==$_GET['page']) echo "" ;
			else echo "<li><a href='".$_SERVER['PHP_SELF'] ."?page=$j&which=$kind&select=$select'> $j </a></li>";


      }
      "</ul> " ;
      mysqli_close($link); // 關閉資料庫連結
      ?>
			</div>
			<br class="clr"/>
</div>
</div>
</div>
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
