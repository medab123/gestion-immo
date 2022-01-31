


<?php
include_once "DbConnection.inc.php";
include_once "functions.inc.php";
include_once "./modal.php";
include_once "pdf.php";
include_once "../Conf/config.php";
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>




<?php

$table="";
$table.="'
<table >

<thead  >
<tr>

<th >ID</th>
<th>REF </th>

<th>SITE ></span></th>

<th >SOUS SITE </th>

<th >EMPLACEMENT  </th>

<th >CODE BARE  </th>

<th > DESIGNATION </th>
<th >DATE D'ACHATE  </th>
<th > FOURNISSEUR </th>

<th  > SN/IMEI </th>
<th  > FACTEUR/BL (PJ) </th>
<!-- <th  > TYPE IMMOBILISATION </th>-->

<th  > SECTION ANLYTIQUE </th>
<th  >AFFECTATION  </th>


<th  > VALEUR HT </th>
<th  >DATE MISE EN SERVICE  </th>
<th  >CODE COMPTABLE  </th>


<th  >COMPTE COMPTABLE  </th>

<th  >DUREE D'AMORITISSEMENT  </th>

<th>DATE D'AMORTISSEMENT  </th>

<th  >SOUS FAMILLE  </th>

<th  > DESCRIPTION FAMILLE </th>

<th  > N°-BC </th>

<th  >PRIX D'ACHAT  </th>

<th > TAUX D'AMMORTISSEMENT</th>
<th> duree </th>
<th > cumul </th>
<th > var </th>
<th > calcul </th>
<th >  </th>
</tr>";




?>

  


  <?php

        //$page = 0;
        //$path_only = basename($_SERVER['REQUEST_URI']);
        //echo $path_only;
        $filter = "";
        $data ='';
        if(isset($_GET['conntry'])) {
          $conntry = protectedVar($_GET["conntry"],$con);
          $filter = "where ID_cat ='$conntry'";
        }
        
        $header='';
     echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");

    header("Pragma: public");

    header("Expires: 0");

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    header("Content-Type: application/force-download");

    header("Content-Type: application/octet-stream");

    header("Content-Type: application/download");

    header("Content-Disposition: attachment;filename=immobilisation.xls ");

    header("Content-Transfer-Encoding: binary ");
      echo $table;
       //echo $header."\n".$data;echo "<table border='1'>";
        mysqli_set_charset($con, "utf8mb4");
    		$sql = "Select * from inventaire $filter ORDER BY ID  ";
         
        $res = mysqli_query($con,$sql);
        echo $sql;
        if(mysqli_num_rows($res) > 0){
          while($row = mysqli_fetch_assoc($res)){
        
            echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
            echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["num_immo"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["site"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["sous_site"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["emplacement"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["code_bare"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["DESIGNATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["DATE_D_ACHATE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["FOURNISSEUR"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["SN_IMEI"]."</td>";
            echo '<td style="white-space: nowrap;""><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';
            //echo "<td style='white-space:nowrap;'>".$row["IMMOBILISATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["SECTION_ANLYTIQUE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["AJECTATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["VALEUR_HORS_TAXTE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["D_enservice"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["code_comptable"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["compte_comptable"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["duree_ammortissement"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["DATE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["sfamille"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["dfamille"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["n_bc"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["prix_achat"]."</td>";
            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }else{
                echo "<td style='white-space: nowrap;'>".(100/$row["duree_ammortissement"])."</td>";
            }
            if($row["dure_act"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".$row["dure_act"]."</td>";
            }
            if($row["dure_act"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".((($row["dure_act"])*(100/$row["duree_ammortissement"])*($row["prix_achat"]))/100)."</td>";
            }
            if($row["dure_act"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".floatval(($row["prix_achat"])-(($row["dure_act"])*(100/$row["duree_ammortissement"])*($row["prix_achat"]))/100)."</td>";
            }
            
            echo "<td><a class='btn btn-primary btn-sm mr-1'  href='calculecumule.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
            echo "<td><a class='btn btn-primary btn-sm mr-1'  href='addDevice.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
            echo "<a class='btn btn-danger btn-sm' href='javascript:void(0);' onclick='deleteInv(".$row["ID"].")'><i class='fas fa-trash'></i></a></td>";//28
            echo "</tr>";
        
           //$table.='<tr><td>'.$row['ID'].'</td><td>'.$row['site'].'</td><td>'.$row['sous_site'].'</td></tr>';

          

         	
           
                  
          }
         //echo $table;
        }
?>


<?php
//header('Content-type: application/excel');
//header('Content-disposition: attachment; filename=myfile.excel');

//readfile('myfile.xlsx');
?>


