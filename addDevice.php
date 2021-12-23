<?php include_once "includes/header.inc.php"; ?>
<?php include_once "includes/popUp.inc.php"; ?>
<?php include_once "includes/pdf.php";
if(isset($_GET['id'])){
	echo "mode edit";
	//15
	$id = $_GET['id'];
	$sql = "Select * from inventaire where ID=".$id;
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($res) > 0){
		$inputs = mysqli_fetch_assoc($res);
		$hidden = "<input type='hidden' name='updateBine' ><input type='hidden' name='ID' value='".$inputs['ID']."' >";
	}else{
		echo "error ! ";
		exit();
	}
}else{
	$hidden = "<input type='hidden' name='InsertBine' >";
}
?>
<iframe name="content" style="display: none;"></iframe>

<form  method="POST" target="content" id="form" enctype="multipart/form-data" >
	<?=$hidden?>
	<div class="form-row my-1">
		<div class="form-group col-md-3 ">
		  <label for="inputState" style="font-weight: bold;">CATEGORIE</label>
		  <select name="Categorie" id="inputState" class="form-control" required="" onchange="CategorieChnaged(this);" value="<?=$inputs["ID_cat"]?>" <?php echo empty($inputs["ID_cat"]) ? "" : "disabled" ?> >
		    <option value="0" <?php echo (0 == $inputs["ID_cat"]) ? "selected" : "" ?>>choisir...</option>
		    <option value="1" <?php echo (1 == $inputs["ID_cat"]) ? "selected" : "" ?>>Équipement Informatique</option>
		    <option value="2" <?php echo (2 == $inputs["ID_cat"]) ? "selected" : "" ?>>Équipement bâtiment</option>
		    <option value="3" <?php echo (3 == $inputs["ID_cat"]) ? "selected" : "" ?>>Équipement Industrielle</option>
		    <option value="4" <?php echo (4 == $inputs["ID_cat"]) ? "selected" : "" ?>>Équipement Labo</option>
		    <option value="5" <?php echo (5 == $inputs["ID_cat"]) ? "selected" : "" ?>>Imobile Incorprelle</option>
		  </select>
		</div>
		<div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">VALEUR HORS TAXTE</label>
      <input type="text" name="valeur" class="form-control" id="valeur" placeholder="VALEUR HORS TAXTE" required value="<?=$inputs["VALEUR_HORS_TAXTE"]?>">
    </div>
    <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">DUREE D'AMORTISSEMENT</label>
      <input type="text" name="dure" class="form-control" id="dure" placeholder="DUREE D'AMORTISSEMENT" required value="<?=$inputs["duree_ammortissement"]?>">
    </div>
	<div class="form-group has-error col-md-3">
		<label for="num_immo" style="font-weight: bold;">NUM IMMO</label>
		<input type="text" name="num_immo" class="form-control" id="num_immo" placeholder="NUM IMMO" required value="<?=$inputs["num_immo"]?>">
	</div>
	</div>
	<div class="form-row my-4">
		<div class="form-group has-error col-md-3">
			<label for="sfamille" style="font-weight: bold;">SOUS FAMILLE</label>
			<input type="text" name="sfamille" class="form-control" id="sfamille" placeholder="SOUS FAMILLE" required value="<?=$inputs["sfamille"]?>">
		</div>
		<div class="form-group has-error col-md-6">
			<label for="dfamille" style="font-weight: bold;">DESCRIPTION DE SOUS FAMILLE</label>
			<input type="text" name="dfamille" class="form-control" id="dfamille" placeholder="SOUS SITE" required value="<?=$inputs["dfamille"]?>">
		</div>
		<div class="form-group has-error col-md-6">
			<label for="dfamille" style="font-weight: bold;">PRIX D'ACHT</label>
			<input type="text" name="prix_achat" class="form-control" id="prix_achat" placeholder=" PRIX D'ACHT" required value="<?=$inputs["prix_achat"]?>">
		</div>
		<div class="form-group has-error col-md-6">
			<label for="dfamille" style="font-weight: bold;">N°_BC</label>
			<input type="text" name="n_bc" class="form-control" id="n_bc" placeholder="N°_BC" required value="<?=$inputs["N°_BC"]?>">
		</div>
	</div>
	<div class="form-row my-4">
		<div class="form-group has-error col-md-3">
			<label for="site" style="font-weight: bold;">SITE</label>
			<input type="text" name="site" class="form-control" id="site" placeholder="SITE" required value="<?=$inputs["site"]?>">
		</div>
		<div class="form-group has-error col-md-3">
			<label for="sous_site" style="font-weight: bold;">SOUS SITE</label>
			<input type="text" name="sous_site" class="form-control" id="sous_site" placeholder="SOUS SITE" required value="<?=$inputs["sous_site"]?>">
		</div>
		<div class="form-group has-error col-md-3">
			<label for="emplacement" style="font-weight: bold;">EMPLACEMENT</label>
			<input type="text" name="emplacement" class="form-control" id="emplacement" placeholder="EMPLACEMENT" required value="<?=$inputs["emplacement"]?>">
		</div>
		<div class="form-group has-error col-md-3">
			<label for="code_bare" style="font-weight: bold;">CODE BARE</label>
			<input type="text" name="code_bare" class="form-control" id="code_bare" placeholder="CODE BARE" required value="<?=$inputs["code_bare"]?>">
		</div>
	</div>
		

  <div class="form-row my-4">
    <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">DESIGNATION</label>
      <input type="text" name="DESIGNATION" class="form-control" id="inputEmail4" placeholder="DESIGNATION" required value="<?=$inputs["DESIGNATION"]?>">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4" style="font-weight: bold;" style="font-weight: bold;">REFERENCE</label>
      <input type="text" name="REFERENCE" class="form-control" style="font-weight: bold;"  id="inputPassword4" placeholder="REFERENCE" required value="<?=$inputs["REFERENCE"]?>">
    </div>

   <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">TYPE IMMOBILISATION</label>
      <input list="immobilisation" type="text" name="immobilisation" class="form-control" id="immobilisation" placeholder="IMMOBILISTION" required value="<?=$inputs["IMMOBILISATION"]?>">
       <?php
			$sql = "select DISTINCT IMMOBILISATION from inventaire ";
			$result = mysqli_query($con, $sql) or die("Error " . mysqli_error($con));
		?>
		<datalist id="immobilisation">
			<?php while($row = mysqli_fetch_array($result)) { ?>
				<option value="<?php echo $row['IMMOBILISATION']; ?>"><?php echo $row['IMMOBILISATION']; ?></option>
			<?php } ?>
		</datalist>
    </div>
    <div class="form-group col-md-3">
      <label for="inputCity" style="font-weight: bold;">DATE MISE EN SERVICE</label>
      <input type="date" name="datemiseservice"  class="form-control" id="DATE D'ACHATE" required value="<?=$inputs["DATE_D_ACHATE"]?>">
  </div>
  </div>
  <div class="form-row my-3">

	  <div class="form-group col-md-3">
	    <label for="inputAddress" style="font-weight: bold;">SN/IMEI</label>
	    <input type="text" name="SN_IMEI" class="form-control" style="font-weight: bold;"  id="inputAddress" placeholder="SN/IMEI" required value="<?=$inputs["SN_IMEI"]?>">
	  </div>
	  <div class="form-group col-md-3">
	    <label for="inputAddress2" style="font-weight: bold;">FOURNISSEUR</label>
	    <input type="text" name="FOURNISSEUR" class="form-control" id="inputAddress2" placeholder="FOURNISSEUR" required value="<?=$inputs["FOURNISSEUR"]?>">
	  </div>
         <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">AFFECTATION</label>
            <input  type="text" name="affection" class="form-control" id="inputAddress3" placeholder="AFFECTATION" required value="<?=$inputs["AJECTATION"]?>">
          </div>
         <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">SECTION ANALYTIQUE</label>
            <input list="ANALYTIQUE" type="text" name="anlytique" class="form-control" id="anlytique" placeholder="S ANALYTIQUE" required value="<?=$inputs["SECTION_ANLYTIQUE"]?>">
			<?php
				$sql = "select DISTINCT SECTION_ANLYTIQUE from inventaire ";
				$result = mysqli_query($con, $sql) or die("Error " . mysqli_error($con));
			?>
            <datalist id="ANALYTIQUE">
				<?php while($row = mysqli_fetch_array($result)) { ?>
					<option value="<?php echo $row['SECTION_ANLYTIQUE']; ?>"><?php echo $row['SECTION_ANLYTIQUE']; ?></option>
				<?php } ?>
			</datalist>
          </div>
  </div>
  <div class="form-row my-4">
  	<div class="form-group col-md-3">
      <label for="inputCity" style="font-weight: bold;">DATE D'ACHATE</label>
      <input type="date" name="DACHATE"  class="form-control" id="DATE D'ACHATE" required value="<?=$inputs["DATE_D_ACHATE"]?>">
  </div>
 <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">COMPTE COMTABLE</label>
            <input type="text" name="comptecomtable" class="form-control" id="inputAddress2" placeholder="COMPTE COMPTABLE" required value="<?=$inputs["compte_comptable"]?>">
          </div>
  
  <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">CODE COMPTABLE</label>
            <input type="text" name="codecomptable" class="form-control" id="inputAddress2" placeholder="CODE COMPTABLE" required value="<?=$inputs["code_comptable"]?>">
          </div>
<div class="form-group col-md-3">
      <label for="inputZip" style="font-weight: bold;">FACTEUR/BL(PJ)</label>
      <input type="file" name="FACTEUR_Upload" class="form-control" <?php echo empty($inputs["ID_cat"]) ? "required" : "" ?> >
  </div>

</div>
	<center>
			<div class="form-group col-md-6 my-2">
  				<button type="submit" class="btn btn-primary col align-self-center" style="background:#228B22 ;position: relative;top:-10px; left: 0px;">Enregistrer</button>
  			</div>
		</div>
	</center>

  
</form>
<script type="text/javascript">
	function CategorieChnaged(input){
		input.style.borderColor = "gray";
	}
	$('#form').submit(function(e){
	    e.preventDefault();
	    if(document.getElementById('inputState').value != 0){
		    $.ajax({
		   	url: 'includes/dataEchange.inc.php',
				type: 'post',
				data: new FormData(document.getElementById('form')),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend : function()
				{
					//$("#preview").fadeOut();
					$("#err").fadeOut();
				},
		        success:function(result){
		        	result = JSON.parse(result);
		            document.getElementById('modal-body').innerHTML = '<h1>'+result.NUM_INVENTAIRE+'</h>';
		            document.getElementById('modal-body').innerHTML += '<img src="'+result.QRCODE+'">';
		            document.getElementById("btnPopUp").click();
		        }
		    });
		}else{
			document.getElementById('inputState').style.borderColor = "red";
		}
	});
	function calc(){
   var textValue1 = document.getElementById('valeur').value;
   var textValue2 = document.getElementById('dure').value;

   if($.trim(textValue1) != '' && $.trim(textValue2) != ''){
      document.getElementById('BIEN').value = textValue1 * textValue2 +' '+'Ans'; 
    }
}

$(function(){
   $('#valeur, #dure').blur(calc);
});
	
	
</script>

<?php include_once "includes/footer.inc.php";?>
