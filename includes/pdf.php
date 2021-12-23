<?php
include_once "../Conf/config.php";
function generateQrCode($refInvontaire){
	$url = 'https://barcode.tec-it.com/barcode.ashx?data='.$refInvontaire.'&code=&multiplebarcodes=true&translate-esc=true&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&codepage=Default&qunit=Mm&quiet=0&hidehrt=False';
	$qrPngLink = "../PDF/".$refInvontaire.".png";
	file_put_contents($qrPngLink,file_get_contents($url));
	return $qrPngLink;
}
?>