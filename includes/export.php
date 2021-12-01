<?php 
// Load the database configuration file 
include_once "DbConnection.inc.php"; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "members-data_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('ID', 'DESIGNATION', 'REFERENCE', 'SN/IMEI', 'FOURNISSEUR', 'DATE D\'ACHATE', 'TYPE IMMOBILISATION', 'DATE D\'AMORTISSEMENT','SECTION ANLYTIQUE','AFECTATION','VALEUR HT','NUM INVENTAIRE','ETAT'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($con,"Select * from inventaire"); 
if(mysqli_num_rows($query) > 0){ 
    // Output each row of the data 
    while($row = mysqli_fetch_assoc($query)){ 
        $lineData = array($row['id'], $row['DESIGNATION'], $row['REFERENCE'], $row['SN_IMEI'], $row['FOURNISSEUR'], $row['DATE_D_ACHATE'], $row['IMMOBILISATION'], $row["D_AMORTISSEMENT"],$row["SECTION_ANLYTIQUE"],$row["AJECTATION"],$row["VALEUR_HORS_TAXTE"],$row["NUM_INVENTAIRE"],$row["statu"]); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;