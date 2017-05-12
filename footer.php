<?
session_start();
$limits = $_SESSION['limits'];
?>
<div  id="footerSection">
<div class="container">
  <div class="row">
    <div class="span3">
      <h5>帳號</h5>
      <a href="account.php">個人資訊</a>
      <a href="update_account.php">修改帳戶</a>
     </div>
     <?
     if($limits==1){ ?>
     <div class="span3">
       <h5>管理員權限</h5>
       <a href="new_products.php">新增商品</a>
       <a href="tcpdf.php">會員名單</a>
       <a href="tcpdf_cart.php">購物車名單</a>
       <a href="tcpdf_products.php">商品名單</a>
      </div>
      <? }?>
   </div>
  <p class="pull-right"><br>開發人員：資工二孫子朋  資工二潘柏維 資工二劉子彬</p>
</div><!-- Container End -->
</div>
