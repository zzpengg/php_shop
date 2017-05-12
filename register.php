<?
session_start();

if(!isset($_SESSION['decide'])){
$_SESSION['decide'] = 0;
}
//若尚未處理過，在送出表單時，SESSION值會為0，因此在判斷時(0=0)會成立，並繼續處理表單資料
if ($_SESSION['decide']==$_POST['decide']) {

//正常透過表單按鈕送出資料，則將SESSION的值+1，並處理表單資料
$_SESSION['decide'] += 1;
$link = mysqli_connect("localhost","root","123456","group_10")
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

//處理表單資料
$account = $_POST['account'];
$sql = "select * from member where account = '$account' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);
if($row[3] == $account && $_POST['account']!=null)
{
  echo '<script type="text/javascript">alert("可是帳號重複!請重新輸入!!");</script>';
  mysqli_close($link); // 關閉資料庫連結
}
else if ($account != null)
{
  $limit = 2;
  $sql="insert into member values ('" . "','" . $limit . "','" . $_POST['gender'] . "','" . $_POST['account']. "','" . $_POST['email'] ."','" . $_POST['pwd'] ."')";

  if ( $result = mysqli_query($link, $sql) ) // 送出查詢的SQL指令
  {
    $msg= "<span style='color:#0000FF'>資料新增成功!<br>影響記錄數: ". mysqli_affected_rows($link) . "筆</span>";
    echo '<script type="text/javascript">alert("驗證成功!");</script>';
    echo '<script type="text/javascript">window.location="index.php";</script>';
  }
  else
    $msg= "<span style='color:#FF0000'>資料新增失敗！<br>錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" .mysqli_error($link) ."</span>";

  mysqli_close($link); // 關閉資料庫連結
}

}
else if($_POST['account']!=null)
{
  echo '<script type="text/javascript">alert("重複提交!");</script>';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
<title>表單驗證--jQuery</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



<script>
$(document).ready(function($) {
  $("#form1").submit(function() {
      var message = "";
      var id_check = /[^a-zA-Z0-9]/g;
      var mail_check = /.+@.+\..+/;
      var account = $("#account").val();

      if (account == "")
            message = "請輸入帳號!!";
      else if (account.indexOf(' ') >= 0)
            message = "帳號不可有空格!!";
      else if (account.length < 4 || account.length > 10)
            message = "帳號長度限制 : 4-10 ";
      else if (account.match(id_check))
            message = "帳號僅限英數字!!";

      if (message) {
            $("#message").html(message);
            $("#account").focus();
            return false;
      }

      if ($("#pwd").val().length < 6 || $("#pwd").val().length > 12) {
            $("#message").html("密碼長度限制 : 6-12 ");
            $("#pwd").focus();
            return false;
      }
      if ($("#pwd").val() != $("#pwd2").val()) {
            $("#message").html("2次密碼輸入不相同!!");
            $("#pwd2").focus();
            return false;
      }
      if (!$("#email").val().match(mail_check)) {
            $("#message").html("E-mail格式錯誤!");
            $("#email").focus();
            return false;
      }

      if (!$("input:radio[name=gender]").is(":checked")) {
            $("#message").html("請選擇性別!!");
            $("#gender").focus();
            return false;
      }

      if ($("input:checkbox:checked[name='agree']").length == 0) {
            $("#message").html("是否同意?");
            return false;
      }


});


});
</script>
<style type="text/css">
#message {
color: #D82424;
font-weight: normal;
font-family: "微軟正黑體";
display: inline;
padding: 1px;
}
</style>

<script language = JavaScript>
var xmlHttp;
function sendRequest(){
  if (window.XMLHttpRequest)    xmlHttp = new XMLHttpRequest(); //建立XMLHttpRequest物件
  else if (window.ActiveXObject)  xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  var url='ajx_check_account.php?account=' + document.form1.account.value + '&timeStamp='+new Date().getTime();
  xmlHttp.open('GET',url,true);//建立XMLHttpRequest連線要求
  xmlHttp.onreadystatechange=catchResult; //指定處理程式
  xmlHttp.send(null);
}

function catchResult(){
  if (xmlHttp.readyState==4 || xmlHttp.readyState=='complete'){ //取得XMLHttpRequest物件的狀態值,4--動作完成
      if (xmlHttp.status == 200) { //執行狀態：200：OK 、403：Forbidden 、404：Not Found.......
          var str = xmlHttp.responseText; //接收以文字方式傳回的執行結果
          if (str=='1')   document.getElementById('show_msg').innerHTML = '此帳號已存在!';
          else   document.getElementById('show_msg').innerHTML = '';
      }else{
          alert('執行錯誤,代碼:'+xmlHttp.status+'\('+xmlHttp.statusText+'\)');
     }
  }
}
</script>

</head>

<body>
<div class="container">
<div class="row">
<div class="col-sm-4 col-sm-offset-4">

<a><h2>會員註冊</h2><a>
<form class="form-horizontal" role="form" id="form1" name="form1" method="POST">
<div class="form-group">
<label class="col-sm-4 control-label" for="account">帳號</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="account" name="account" placeholder="限4-10個字" onkeyup=sendRequest();>
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label">密碼</label>
<div class="col-sm-8">
<input type="password" class="form-control" id="pwd" name="pwd" placeholder="限6-12個字">
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label">密碼確認</label>
<div class="col-sm-8">
<input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="">
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label">E-mail</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="email" name="email" placeholder="">
</div>
</div>
<div class="form-group">
<label class="col-sm-4 control-label">性別</label>
<div class="col-sm-8">
<input type="radio" class="radio-inline" id="gender1" name="gender" value="M">男
<input type="radio" class="radio-inline" id="gender2" name="gender" value="F">女
</div>
</div>

<div class="form-group">
<div class="col-sm-8 col-sm-offset-4">
<div class="checkbox">
<label>
<input type="checkbox" id="agree" name="agree">我同意相關服務條款
</label>
<label class="error" for="agree"></label>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-7s col-sm-offset-5">
<div id="message" class="form-group"></div>
<br/>
<label>
<input type="hidden" name="decide" value="<? echo $_SESSION['decide']; ?>">
<button type="submit" class="btn btn-primary">送　出</button>
<button type="reset" class="btn btn-primary">重　填</button>
<a href="index.php"><h3>回首頁</h3><a>
</label>
</div>
</div>
</form>
<?= $msg ?>
<center>訊息：<span id='show_msg' style="color:red"></span></center>
</div>
</div>
</div>
</body>

</html>
