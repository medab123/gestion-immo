<?php include_once "includes/header.inc.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



 <script >
   
  $(document).ready(function(){
    $('#rechercher').keyup(function(){
      $('#tbody').html('');
 
      var utilisateur = $(this).val();
      if(utilisateur != ""){
        $.ajax({
          type: 'POST',
          url: 'includes/dataEchange.inc.php',
          data: {utilisateur:utilisateur},
          success: function(data){
            if(data != ""){
              $('#tbody').html(data);
            }else{
              document.getElementById('result').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>";
            }
          }
        });
      }else{
        getUsers(); 
      }
    });
  });
</script>
<input type="text" class="form-control col-md-4 float-left" style="margin-left:100px;" id="rechercher" placeholder="rechercher">
<a class=" btn btn-success float-right " style="margin-right:100px;"  href="addUser.php"> AJOUTER UTILISATEUR</a>

 <!-- Trigger the modal with a button -->
  

  <!-- Modal -->


 </script>
<table  class="table table-sm"   style="margin-top: 4em; margin:100px;">
  <thead style=" position: sticky;top: 10px;">
    <tr style=" background-color:#ADF75F ">
      <th > NOM</th>
      <th >PRENOM </span></th>
      <th >ROLE </th>
      <th >E-MAIL </th>
      
       
    </tr>
  </thead>
  <tbody id="tbody"  >
    <script type="text/javascript">
      getUsers(); 
      function getUsers(){
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "includes/dataEchange.inc.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("getUses");
        ajax.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            console.log(data);
            document.getElementById("tbody").innerHTML += data;
          }
        }
      }
      

    </script>
  </tbody>
</table>

<style>





</style>

<?php include_once "includes/footer.inc.php"; ?>
