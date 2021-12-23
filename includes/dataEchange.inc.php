<?php
include_once "DbConnection.inc.php";
include_once "functions.inc.php";
include_once "pdf.php";
include_once "../Conf/config.php";
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_SESSION['userId']) ){
//--/////////////////////// ajouter une invantair ////////////////////////
	//Categorie=1&DESIGNATION=&REFERENCE=&SN_IMEI=&FOURNISSEUR=&DACHATE=//
	if (isset($_POST['InsertBine']) || isset($_POST['updateBine'])){
		$Categorie = protectedVar($_POST['Categorie'],$con);
		$DESIGNATION = protectedVar($_POST['DESIGNATION'],$con);
		$REFERENCE = protectedVar($_POST['REFERENCE'],$con);
		$prix_achat = protectedVar($_POST['prix_achat'],$con);
		$n_bc = protectedVar($_POST['n_bc'],$con);
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
		$site = protectedVar($_POST['site'],$con);
		$sous_site = protectedVar($_POST['sous_site'],$con);
		$emplacement = protectedVar($_POST['emplacement'],$con);
		$code_bare = protectedVar($_POST['code_bare'],$con);;
		$dure = protectedVar($_POST['dure'],$con);
		$sfamille = protectedVar($_POST['sfamille'],$con);
		$dfamille = protectedVar($_POST['dfamille'],$con);
		echo $sfamille;
		$num_immo = strtoupper(protectedVar($_POST['num_immo'],$con));
		/////////////// Create NUM_INVENTAIRE ///////////////////////
		
		if(isset($_POST['updateBine'])){
			if(!empty($_FILES["FACTEUR_Upload"]["name"])){
				$target_dir = "../FACTUR/";
				$target_file = $target_dir . basename($_FILES["FACTEUR_Upload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				move_uploaded_file($_FILES["FACTEUR_Upload"]["tmp_name"], $target_file);
				$target_file="FACTUR='".basename($target_file)."',";
			}else{
				$target_file="";
			}
			$QRCODE = generateQrCode($code_bare);
			$date = $datemiseservice;
			$date = strtotime($date);
			$date = strtotime( $dure."year", $date);
			$DATE = date('Y-m-d', $date);
			$sql = "update inventaire set num_immo='$num_immo',site='$site' ,sous_site='$sous_site', emplacement='$emplacement', code_bare='".basename($QRCODE)."', DESIGNATION='$DESIGNATION',DATE_D_ACHATE='$DACHATE',FOURNISSEUR='$FOURNISSEUR',REFERENCE='$REFERENCE ',$target_file SN_IMEI='$SN_IMEI',IMMOBILISATION='$immobilisation',SECTION_ANLYTIQUE='$anlytique',AJECTATION='$affection',VALEUR_HORS_TAXTE='$valeur',D_enservice='$datemiseservice', code_comptable='$codecomptable',compte_comptable='$comptecomtable',duree_ammortissement='$dure',DATE='$DATE' where ID=".protectedVar($_POST['ID'],$con);
			$result=mysqli_query($con,$sql);
			echo $sql;
			if ($result){
				echo '<div class="alert alert-success">bien ajouter</div>';
			}
			exit();
		}
		/*$sql = "select * from categore where ID_cat = ".$Categorie;
		$R_cat = mysqli_query($con,$sql);
		$R_cat = mysqli_fetch_assoc($R_cat)['R_cat'];
		$sql = "select NUM_INVENTAIRE from inventaire where NUM_INVENTAIRE like '$R_cat%' order by ID desc limit 1";
		$NUM_INVENTAIRE = mysqli_query($con,$sql);
		if(mysqli_num_rows($NUM_INVENTAIRE) > 0){
			$NUM_INVENTAIRE = mysqli_fetch_assoc($NUM_INVENTAIRE)['NUM_INVENTAIRE'];
			$NUM = intval(substr($NUM_INVENTAIRE,14));
			$NUM += 1;
			$NUM = sprintf('%06d',$NUM);
			$NUM_INVENTAIRE = $R_cat.$NUM;			

		}else{
			$NUM_INVENTAIRE = $R_cat.sprintf('%07d',1);
		}*/
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
		$QRCODE = generateQrCode($code_bare);
		$sql = "insert into inventaire (num_immo,site,sous_site,emplacement,code_bare,DESIGNATION,DATE_D_ACHATE,FOURNISSEUR,REFERENCE,FACTUR,SN_IMEI,CODE_BARRE,ID_cat,statu,IMMOBILISATION,SECTION_ANLYTIQUE,AJECTATION,VALEUR_HORS_TAXTE,D_enservice, code_comptable,compte_comptable,duree_ammortissement,DATE,sfamille,dfamille,n_bc,prix_achat) values ('$num_immo','$site','$sous_site','$emplacement','$code_bare','$DESIGNATION','$DACHATE','$FOURNISSEUR','$REFERENCE','".basename($target_file)."','$SN_IMEI','".basename($QRCODE)."','$Categorie','true','$immobilisation','$anlytique','$affection','$valeur','$datemiseservice','$codecomptable','$comptecomtable','$dure','$DATE','$sfamille','$dfamille','$n_bc','$prix_achat')";
		  $result=mysqli_query($con,$sql);

		 if ($result){
		 	echo '<div class="alert alert-success">bien ajouter</div>';
		 }
		echo json_encode(array('NUM_INVENTAIRE' => $NUM_INVENTAIRE,'QRCODE'=> PATH_HOST.PATH_QR.basename($QRCODE),'Path' => $QRCODE,"SQL" => $sql));
		//echo $sql;
	}

	/////////////////////////////////// addDevice Finished ////////////////////////////////////
	/////////////////////////////////// afficher les device ///////////////////////////////////
	else if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "delete from inventaire where ID=".$id;
		mysqli_query($con,$sql);
		echo "deleted";
	}
	
	else if(isset($_POST['getInventaire'])){
		//echo PATH_HOST.PATH_QR;
		$sql = "Select * from inventaire";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
				echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["sous_site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["emplacement"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["code_bare"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DESIGNATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["REFERENCE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["D_enservice"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["duree_ammortissement"]."</td>";
				echo "<td style='white-space: nowrap;'>".(($row["duree_ammortissement"])*($row["prix_achat"])*(100/$row["duree_ammortissement"]))."</td>";
				echo "<td style='white-space: nowrap;'>".$row["VALEUR_HORS_TAXTE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SN_IMEI"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["FOURNISSEUR"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["code_comptable"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["compte_comptable"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE_D_ACHATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["IMMOBILISATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SECTION_ANLYTIQUE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["AJECTATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["n_bc"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["prix_achat"]."</td>";
				echo "<td style='white-space: nowrap;'>".(100/$row["duree_ammortissement"])."</td>";
				echo '<td style="white-space: nowrap;""><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';
				echo '<td><a target="_blank" rel="noopener noreferrer" href='.PATH_HOST.PATH_QR.$row["code_bare"].'><img width="100px" src="'.PATH_HOST.PATH_QR.$row["code_bare"].'"></a></td>';
				echo "<td style='white-space: nowrap;'>".$row["sfamille"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["dfamille"]."</td>";
				echo "<td><a class='btn btn-primary btn-sm mr-1'  href='addDevice.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
				echo "<a class='btn btn-danger btn-sm' href='javascript:void(0);' onclick='deleteInv(".$row["ID"].")'><i class='fas fa-trash'></i></a></td>";
				echo "</tr>";
			}		
		}
	}
	else if(isset($_POST['searchInventaire'])){
		$etateInventair = protectedVar($_POST['etat']);
		$sql = "Select * from inventaire where statu ".((1 == $etateInventair) ? " is null " : "is not null");
		
		if(isset($_POST['dateS']) && isset($_POST['dateF']) && !empty($_POST['dateF']) && !empty($_POST['dateS'])){
			$StartDate = protectedVar($_POST['dateS']); 
			$FinDate = protectedVar($_POST['dateF']);
			$sql .= " and DATE_D_ACHATE BETWEEN '$StartDate' AND '$FinDate'";
		}//echo $sql;

		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_assoc($res)){
				echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
				echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";

				echo "<td style='white-space: nowrap;'>".$row["site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["sous_site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["emplacement"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["code_bare"]."</td>";

				echo "<td style='white-space: nowrap;'>".$row["DESIGNATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["REFERENCE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["D_enservice"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["duree_ammortissement"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["VALEUR_HORS_TAXTE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SN_IMEI"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["FOURNISSEUR"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["code_comptable"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["compte_comptable"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["DATE_D_ACHATE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["IMMOBILISATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["SECTION_ANLYTIQUE"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["AJECTATION"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["NUM_INVENTAIRE"]."</td>";
				echo '<td style="white-space: nowrap;""><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';
				echo '<td><a target="_blank" rel="noopener noreferrer" href='.PATH_HOST.PATH_QR.$row["code_bare"].'><img width="100px" src="'.PATH_HOST.PATH_QR.$row["code_bare"].'"></a></td>';
				echo "<td><a class='text-primary stretched-link'  href='addDevice.php?id=".$row['ID']."'><i class='fas fa-edit'></i></a>";
				echo "<a class='text-danger stretched-link' onclick='deleteInv(".$row["ID"].")'><i class='far fa-trash-alt'></i></a></td>";
				echo "</tr>";
				
			}		
		}
	}
////////////////////////

  /////////////////////////////////// afficher les users ///////////////////////////////////
	else if(isset($_POST['getUses'])){
			$sql = "select ID_user,user_name,user_Last_Name,role, mail from users,role where role.ID_role=users.ID_role";
			$res = mysqli_query($con,$sql);
			// echo $sql;
		if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
		echo "<tr id=".$row["ID_user"].">";
		echo "<td>".$row["user_name"]."</td>";
		echo "<td>".$row["user_Last_Name"]."</td>";
		echo "<td>".$row["role"]."</td>";
		echo "<td>".$row["mail"]."</td>";
		}
		}
	}



////////////////////// rechercher/////////////
 else if (isset($_POST['utilisateur'])) {
  		$utilisateur = $_POST['utilisateur'];

      $query = "SELECT * FROM users where user_name LIKE '{$utilisateur}%' or user_Last_Name LIKE '{$utilisateur}%' or mail LIKE '{$utilisateur}%'  ";

      $result= mysqli_query($con,$query);
		
      if(mysqli_num_rows($result) > 0){

      		while($row = mysqli_fetch_assoc($result)){

	        echo "<tr id=".$row["ID_user"].">";
	        echo "<td>".$row["user_name"]."</td>";
	        echo "<td>".$row["user_Last_Name"]."</td>";
	        echo "<td>".$row["ID_role"]."</td>";
	        echo "<td>".$row["mail"]."</td>";


	        }
      
	      }
      
	      
     }

else if (isset( $_POST['codebarre'])) {
  		$codebarre =  trim($_POST['codebarre']);


      $query = "SELECT * FROM inventaire where NUM_INVENTAIRE LIKE '{$codebarre}%'";

      $result= mysqli_query($con,$query);
		
      if(mysqli_num_rows($result) > 0){

      		while($row = mysqli_fetch_assoc($result)){

      	echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
				echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["sous_site"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["emplacement"]."</td>";
				echo "<td style='white-space: nowrap;'>".$row["code_bare"]."</td>";
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
							     
	      }else{


	      }
      
	      
     }

}
?>
