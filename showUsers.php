<?php include_once "includes/header.inc.php"; ?>
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
  <button  class=" btn btn-success float-right my-3"><a href="addUser.php"> AJOUTER UTILISATEUR</a></button>
  	<script type="text/javascript">
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
    </script>
  </tbody>
</table>
<?php include_once "includes/footer.inc.php"; ?>
