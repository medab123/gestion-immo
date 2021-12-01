<?php include_once "includes/header.inc.php"; ?>
<?php include_once "includes/popUp.inc.php"; ?>
<?php include_once "includes/pdf.php";?>

<iframe name="content" style="display: none;"></iframe>

<form  method="POST" target="content" id="form" enctype="multipart/form-data">
	<div class="form-row my-1">
		<div class="form-group col-md-3 ">
		  <label for="inputState" style="font-weight: bold;">CATEGORIE</label>
		  <select name="Categorie" id="inputState" class="form-control" required="" onchange="CategorieChnaged(this);">
		    <option value="0" selected>choisir...</option>
		    <option value="1">Équipement Informatique</option>
		    <option value="2">Équipement bâtiment</option>
		    <option value="3">Équipement Industrielle</option>
		    <option value="4">Équipement Labo</option>
		    <option value="5">Imobile Incorprelle</option>
		  </select>
		</div>
		<div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">VALEUR HORS TAXTE</label>
      <input type="text" name="valeur" class="form-control" id="valeur" placeholder="VALEUR HORS TAXTE" required>
    </div>
    <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">DUREE D'AMORTISSEMENT</label>
      <input type="text" name="dure" class="form-control" id="dure" placeholder="DUREE D'AMORTISSEMENT" required>
    </div>
    <!--
    <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">DATE D'AMORTISSEMENT</label>
      <input   class="form-control" id="BIEN"   disabled="true">
    </div>
  -->
	</div>

  <div class="form-row my-4">
    <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">DESIGNATION</label>
      <input type="text" name="DESIGNATION" class="form-control" id="inputEmail4" placeholder="DESIGNATION" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4" style="font-weight: bold;" style="font-weight: bold;">REFERENCE</label>
      <input type="text" name="REFERENCE" class="form-control" style="font-weight: bold;"  id="inputPassword4" placeholder="REFERENCE" required>
    </div>

   <div class="form-group has-error col-md-3">
      <label for="inputEmail4" style="font-weight: bold;">TYPE IMMOBILISATION</label>
      <input list="immobilisation" type="text" name="immobilisation" class="form-control" id="immobilisation" placeholder="IMMOBILISTION" required>
       <?php
								//fetch data from database
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
      <input type="date" name="datemiseservice"  class="form-control" id="DATE D'ACHATE" required>
  </div>
     <!--
  <div class="form-group col-md-3">
      <label for="inputCity" style="font-weight: bold;">DATE D'AMORTISSEMENT</label>
      <input type="date" name="dateammorissemeent"  class="form-control" id="DATE D'ACHATE" required>
  </div>
 -->
  </div>
  <div class="form-row my-3">

	  <div class="form-group col-md-3">
	    <label for="inputAddress" style="font-weight: bold;">SN/IMEI</label>
	    <input type="text" name="SN_IMEI" class="form-control" style="font-weight: bold;"  id="inputAddress" placeholder="SN/IMEI" required>
	  </div>
	  <div class="form-group col-md-3">
	    <label for="inputAddress2" style="font-weight: bold;">FOURNISSEUR</label>
	    <input type="text" name="FOURNISSEUR" class="form-control" id="inputAddress2" placeholder="FOURNISSEUR" required>
	  </div>
         <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">AFFECTATION</label>
            <input  type="text" name="affection" class="form-control" id="inputAddress3" placeholder="AFFECTATION" required>
          </div>
         <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">SECTION ANALYTIQUE</label>
            <input list="ANALYTIQUE" type="text" name="anlytique" class="form-control" id="anlytique" placeholder="S ANALYTIQUE" required>
            <?php
								//fetch data from database
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
      <input type="date" name="DACHATE"  class="form-control" id="DATE D'ACHATE" required>
  </div>
 <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">COMPTE COMTABLE</label>
            <input type="text" name="comptecomtable" class="form-control" id="inputAddress2" placeholder="COMPTE COMPTABLE" required>
          </div>
  
  <div class="form-group col-md-3">
            <label for="inputAddress2" style="font-weight: bold;">CODE COMPTABLE</label>
            <input type="text" name="codecomptable" class="form-control" id="inputAddress2" placeholder="CODE COMPTABLE" required>
          </div>
<div class="form-group col-md-3">
      <label for="inputZip" style="font-weight: bold;">FACTEUR/BL(PJ)</label>
      <input type="file" name="FACTEUR_Upload" class="form-control" required>
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
