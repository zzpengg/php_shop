<?php
// Include the main TCPDF library (search for installation path).
set_time_limit(0);
ini_set('memory_limit', '640M'); //Set Proper memory limit in your php file
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData("",40, "", "購物車", array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array('msungstdlight', '', 15));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT,18, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('msungstdlight', '', 16);
// Add a page
$pdf->AddPage();

// Set some content to print
$html = "<table border=\"1\"><tr align=\"center\"><td width=\"20%\">帳號</td><td width=\"60%\">商品名稱</td><td width=\"10%\">數量</td><td width=\"10%\">價格</td></tr>";

$link = mysqli_connect("localhost","root","123456","group_10")// 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");

// 送出查詢的SQL指令
if ( $result = mysqli_query($link, "SELECT * FROM cart") ) {
while( $row = mysqli_fetch_assoc($result) ){
$html .= "<tr align=\"center\"><td width=\"20%\">".$row["name"]."</td><td width=\"60%\">".$row["products"]."</td><td width=\"10%\">".$row["quantity"]."</td><td width=\"10%\">".$row["price"] ."</td></tr>";
}
mysqli_free_result($result); // 釋放佔用的記憶體
}
mysqli_close($link); // 關閉資料庫連結

$html .= "</table>";
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('example.pdf', 'I');
?>
