<?php 
$host = "localhost";
$user = "root";
$pwd = "";
$dbName = "Gestion_stock";
$conStat = true;
$con = mysqli_connect($host,$user,$pwd,$dbName);
if(!$con){
        $conStat = false;
}
?>
