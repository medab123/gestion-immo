

<?php
/*
$Object = new DateTime();  
$Date = $Object->format("d-m-Y");
$Date1 = $Object->format("Y");
 echo $date=$Date+$Date1;
echo $date;
echo "The current date is $Date.</br>";

$Year = $Object->format("Y"); 

$Object = new DateTime();  
$Date = $Object->format("d-m-Y");  
echo "The current date is $Date.</br>";
echo "\n";
$Year = $Object->format("Y"); 
echo "The current year is $Year.</br>";
echo "\n";
$Year2 = $Object->format("y"); 
echo "The current year in two digits is $Year2.";
//echo "The current year is $Year.";
*/


?>


<?php
$dure=0;
$date = "1970-01-01";
$date = strtotime($row["duree"]);
$date = strtotime( $dure."year", $date);
$date = date('Y-m-d', $date);
echo $date;
////////


$dure=0;
//$= "1970-01-01";
//strtotime($row["duree"]);
 //strtotime($dure."year", strtotime($row["duree"]));
$date = date('Y-m-d',strtotime($dure."year", strtotime($row["duree"])));
//echo $date;

?>