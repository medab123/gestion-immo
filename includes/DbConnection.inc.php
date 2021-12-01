<?php 
$host = "localhost";
$user = "root";
$pwd = "P@55w0rd";
$dbName = "IMMO";
$conStat = true;
$con = mysqli_connect($host,$user,$pwd,$dbName);
if(!$con){
	$conStat = false;
}
?>