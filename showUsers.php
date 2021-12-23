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
<input type="text" class="form-control col-md-4 float-left" id="rechercher" placeholder=" rechercher ">
<a class=" btn btn-success float-right my-3" href="addUser.php"> AJOUTER UTILISATEUR</a>

 <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form  method="POST" target="content" action="addUser.php"  id="form">
  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputState">Role</label>
      <select   name="role" id="inputState" class="form-control" required >
        <option selected>choisir...</option>
         <?php

        $sql = "SELECT * from role ";
        $rst = mysqli_query($con,$sql);
        if(mysqli_num_rows($rst) > 0){
         while($rw = mysqli_fetch_assoc($rst)){
          echo ' <option value="'.$rw['ID_role'].'">'.$rw['role'].'</option>';
         }
        }
      ?>
    </select>
</div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nom</label>
      <input type="text" name="nom" class="form-control" id="inputEmail4" placeholder="nom" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Prenom</label>
      <input type="text" name="prenom" class="form-control"  id="inputPassword4" placeholder="Prenom" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputAddress">E-mail</label>
      <input type="email" name="email" class="form-control" id="inputAddress" placeholder="e-mail" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputAddress2">Mot de passe</label>
      <input type="password" name="pas1" class="form-control" id="inputAddress2" placeholder="mot de passe" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputAddress2">Confirmer le Mot de passe</label>
      <input type="password" name="pas2" class="form-control" id="inputAddress2" placeholder="Confirmer le Mot de passe" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 offset-md-3">
      <button type="submit" class="btn btn-primary col align-self-center" style="background:#228B22  ;margin: 0 auto;">Enregistrer</button>
    </div>
  </div>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

 </script>
<table  class="table table-striped">
  <thead style=" position: sticky;top: 10px;">
    <tr>
      <th scope="col">NOM</th>
      <th scope="col">PRENOM</th>
      <th scope="col">ROLE</th>
      <th scope="col">E-mail</th>
    
    </tr>
  </thead>
  <tbody id="tbody">
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

<?php include_once "includes/footer.inc.php"; ?>
