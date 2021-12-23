<?php include_once "includes/header.inc.php"; ?>
<?php include_once "includes/popUp.inc.php"; ?>
<?php  include_once 'includes/DbConnection.inc.php'; ?>
<?php
$result="";
if (isset($_POST['role']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['pas1']) && isset($_POST['pas2'])){
  // récupérer le nom ET le prenom d'utilisateur 
  $nom = stripslashes($_POST['nom']);
 
  $nom = mysqli_real_escape_string($con, $nom); 
  $prenom = stripslashes($_POST['prenom']);
  $prenom = mysqli_real_escape_string($con, $prenom);
  //
  $role = stripslashes($_POST['role']);
  $role = mysqli_real_escape_string($con, $role); 
  
  // récupérer l'email 
  $email = stripslashes($_POST['email']);
  $email = mysqli_real_escape_string($con, $email);
  // récupérer le mot de passe 
  $pas1 = stripslashes($_POST['pas1']);
  $pas1 = mysqli_real_escape_string($con, $pas1);
  $pas2 = stripslashes($_POST['pas2']);
  $pas2 = mysqli_real_escape_string($con,$pas2);
///////


if ( $_POST['pas1'] != $_POST['pas2'] )
{
       
$result='<div class="alert alert-danger">Les deux mots de passes sont differents .Re-essayer de nouveau</div>';
echo $result;
     
}
////////////////////

///////////////////


  else{
   $query = "INSERT into users (user_name, user_Last_Name, ID_role, password,mail) VALUES ('$nom', '$prenom','$role' ,md5('".$pas1."'), '$email' )";
   $res = mysqli_query($con, $query);
   $result='<div class="alert  alert-success">Utilisateur été bien ajouter. </div>';
  echo $result;
 // echo $query;

}

///////


/////


}

?>
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


<?php include_once "includes/footer.inc.php"; ?>
