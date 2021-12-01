<?php
include_once "DbConnection.inc.php";
include_once "functions.inc.php";
include_once "pdf.php";
include_once "../Conf/config.php";
session_start();
if(isset($_SESSION['userId'])){
//--/////////////////////// ajouter une invantair ////////////////////////
	//Categorie=1&DESIGNATION=&REFERENCE=&SN_IMEI=&FOURNISSEUR=&DACHATE=//
	if (isset($_POST['Categorie']) && isset($_POST['DESIGNATION']) && isset($_POST['REFERENCE']) && isset($_POST['SN_IMEI'])){
		$Categorie = protectedVar($_POST['Categorie'],$con);
		$DESIGNATION = protectedVar($_POST['DESIGNATION'],$con);
		$REFERENCE = protectedVar($_POST['REFERENCE'],$con);
		$SN_IMEI = protectedVar($_POST['SN_IMEI'],$con);
		$FOURNISSEUR = protectedVar($_POST['FOURNISSEUR'],$con);
		$DACHATE = protectedVar($_POST['DACHATE'],$con);
    $immobilisation = protectedVar($_POST['immobilisation'],$con);
    //$dateammorissemeent = protectedVar($_POST['dateammorissemeent'],$con);
    $datemiseservice = protectedVar($_POST['datemiseservice'],$con); 
    $codecomptable = protectedVar($_POST['codecomptable'],$con);
    $comptecomtable = protectedVar($_POST['comptecomtable'],$con);
    $affection = protectedVar($_POST['affection'],$con);
    $anlytique = protectedVar($_POST['anlytique'],$con);
    $valeur = protectedVar($_POST['valeur'],$con);
    $dure = protectedVar($_POST['dure'],$con);


    
    






		/////////////// Create NUM_INVENTAIRE ///////////////////////

		$sql = "select * from categore where ID_cat = ".$Categorie;
		$R_cat = mysqli_query($con,$sql);
		$R_cat = mysqli_fetch_assoc($R_cat)['R_cat'];
		$sql = "select NUM_INVENTAIRE from inventaire where NUM_INVENTAIRE like '$R_cat%' order by ID desc limit 1";
		$NUM_INVENTAIRE = mysqli_query($con,$sql);
		if(mysqli_num_rows($NUM_INVENTAIRE) > 0){
			$NUM_INVENTAIRE = mysqli_fetch_assoc($NUM_INVENTAIRE)['NUM_INVENTAIRE'];
			$NUM = intval(substr($NUM_INVENTAIRE, 6));
			$NUM += 1;
			$NUM = sprintf('%07d',$NUM);
			$NUM_INVENTAIRE = $R_cat.$NUM;

		}else{
			$NUM_INVENTAIRE = $R_cat.sprintf('%07d',1);
		}
		////////////////// Creation finished //////////////////////
		/////////////////// Upload facteur ////////////////////////
	
	
	
    $date = $datemiseservice;
    $date = strtotime($date);
    $date = strtotime( $dure."year", $date);
    $DATE = date('Y-m-d', $date);
    echo $DATE;
    //$DATE ="2021-11-19";
		 

		///////////////////////////////////////////
		$target_dir = "../FACTUR/";
		$target_file = $target_dir . basename($_FILES["FACTEUR_Upload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		move_uploaded_file($_FILES["FACTEUR_Upload"]["tmp_name"], $target_file);
		/////////////////////// upload finished ///////////////////
		$QRCODE = generateQrCode($NUM_INVENTAIRE);
		$sql = "insert into inventaire (DESIGNATION,NUM_INVENTAIRE,DATE_D_ACHATE,FOURNISSEUR,REFERENCE,FACTUR,SN_IMEI,CODE_BARRE,ID_cat,statu,IMMOBILISATION,SECTION_ANLYTIQUE,AJECTATION,VALEUR_HORS_TAXTE,D_enservice, code_comptable,compte_comptable,duree_ammortissement,DATE) values ('$DESIGNATION','$NUM_INVENTAIRE','$DACHATE','$FOURNISSEUR','$REFERENCE','".basename($target_file)."','$SN_IMEI','".basename($QRCODE)."','$Categorie','true','$immobilisation','$anlytique','$affection','$valeur','$datemiseservice','$codecomptable','$comptecomtable','$dure','$DATE')";
		  $result=mysqli_query($con,$sql);

		 if ($result){
		 	echo '<div class="alert alert-success">.alert-success</div>';
		 }
		echo json_encode(array('NUM_INVENTAIRE' => $NUM_INVENTAIRE,'QRCODE'=> PATH_HOST.PATH_QR.basename($QRCODE),'Path' => $QRCODE));
		//echo $sql;
	}

	/////////////////////////////////// addDevice Finished ////////////////////////////////////
	/////////////////////////////////// afficher les device ///////////////////////////////////
	else if(isset($_POST['getInventaire'])){
		//echo PATH_HOST.PATH_QR;
		$sql = "Select * from inventaire";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
				echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DESIGNATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["REFERENCE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["D_enservice"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["duree_ammortissement"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["VALEUR_HORS_TAXTE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SN_IMEI"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["FOURNISSEUR"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE_D_ACHATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["IMMOBILISATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SECTION_ANLYTIQUE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["AJECTATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["NUM_INVENTAIRE"]."</td>";
				echo '<td style="white-space: nowrap;""><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';

				echo '<td><a target="_blank" rel="noopener noreferrer" href='.PATH_HOST.PATH_QR.$row["CODE_BARRE"].'>PDF</a></td>';
				echo "</tr>";
			}		
		}
	}
	else if(isset($_POST['searchInventaire'])){
		$etateInventair = protectedVar($_POST['etat']);
		$sql = "Select * from inventaire where statu = '$etateInventair'";
		if(isset($_POST['dateS']) && isset($_POST['dateF']) && !empty($_POST['dateF']) && !empty($_POST['dateS'])){
			$StartDate = protectedVar($_POST['dateS']); 
			$FinDate = protectedVar($_POST['dateF']);
			$sql .= " and DATE_D_ACHATE BETWEEN '$StartDate' AND '$FinDate'";
		}

		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				echo "<tr id=".$row["ID"].">";
				echo "<td>".$row["ID"]."</td>";
				echo "<td>".$row["DESIGNATION"]."</td>";
				echo "<td>".$row["REFERENCE"]."</td>";
				echo "<td>".$row["SN_IMEI"]."</td>";
				echo "<td>".$row["FOURNISSEUR"]."</td>";
				echo "<td>".$row["DATE_D_ACHATE"]."</td>";
				echo "<td>".$row[" "]."</td>";
				echo "<td>".""."</td>";
				echo '<td><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_RACIN.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';
				echo '<td><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_RACIN.PATH_QR.$row["CODE_BARRE"].'>PDF</a></td>';
				echo "</tr>";
				
			}		
		}
	}
////////////////////////

  /////////////////////////////////// afficher les users ///////////////////////////////////
        else if(isset($_POST['getUses'])){
                $sql = "select user_name,user_Last_Name,role, mail from users,role where role.ID_role=users.ID_role";
                $res = mysqli_query($con,$sql);
               // echo $sql;
	      if(mysqli_num_rows($res) > 0){
	        while($row = mysqli_fetch_assoc($res)){
	        echo "<tr id=".$row["ID"].">";
	        echo "<td>".$row["user_name"]."</td>";
	        echo "<td>".$row["user_Last_Name"]."</td>";
	        echo "<td>".$row["role"]."</td>";
	        echo "<td>".$row["mail"]."</td>";
	        }
	      }
        }



//////////////////////







}
?>
