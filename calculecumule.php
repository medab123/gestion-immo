<?php include_once "includes/header.inc.php"; ?>

<style>

  .center {
  margin: auto;
  width: 70%;
  border: 3px solid #73AD21;
  padding: 50px;
}
</style>


<?php

if(isset($_GET['id'])){
	echo "";
	//15
	$id = $_GET['id'];
	$sql = "Select * from inventaire where ID=".$id;
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($res) > 0){
	 $row =mysqli_fetch_assoc($res);
     //$hidden = "<input type='hidden' name='id' id='.$id' ><input type='hidden' name='ID' value='".$row['ID']."' >";
    }
}
?>



<form  >

<div class="center " >
<div class="form-row ">

    <div class="form-group  col-md-4" >
      <td><label for="">PRIX</label></td>
     <input type="text" class="form-control " id="prix_achat" name="prix_achat"  value="<?php echo $row['prix_achat']; ?>" >
    </div>

    <div class="form-group  col-md-4" >
        <label for="">taux</label>
        <input type="text" class="form-control" id="taux" name="taux"  value="<?php echo (100/$row["duree_ammortissement"]) ?>">
    </div>

    <div class="form-group col-md-4 " >
      <label for="">DUREE</label>
      <input type="text" class="form-control  " id="duree" name="duree">
    </div>

    </div>
 
    <div class="form-row  ">
  <div class="form-group col-md-6">
    <label for="">CUMULE</label>
    <input type="text" class="form-control  " id="cumule" name="cumule" >
  </div>

  <div class="form-group col-md-6 " >
    <label for="">VNA</label>
    <input type="text" class="form-control "  name="var" id="var" >
  </div>
  </div>
<center>
  <button type="submit" class="btn btn-primary button" id="submit" >CALCULER</button>
</center>
  </div>
  <input type="hidden" id="id" value="<?php echo $row['ID']; ?>" >
</form>

<script>
$(document).ready(function(){

$(".button").on("click",function(){
  var c =parseInt($("#duree").val());
  var a =parseFloat($("#prix_achat").val());
  var b =parseInt($("#taux").val());
var sum = a * b * c; 
$('#cumule').val(sum);

$('#var').val(sum-sum);

   });
 }); 
 

</script>
<script>
 //
 $(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      duree: $("#duree").val(),
      id: $("#id").val(),
      
    };

    $.ajax({
      type: "POST",
      url: "includes/dataEchange.inc.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
    });

    event.preventDefault();
  });
});
 




 
</script>
  