<?php include_once "includes/header.inc.php"; ?>
  <div class="form-row">
    <div class="col-2">
      <input type="date" id="SDate" class="form-control" placeholder="DATE Debut">
    </div>
    <div class="col-2">
      <input type="date" id="FDate" class="form-control" placeholder="DATE Fin">
    </div>
    <div class="col-2">
      <select  class="form-control" id="etat">
        <option value="">Select état ...</option>
        <option value="1">NON AFFECTE</option>
        <option value="2">AFFECTE</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2" onclick="rechercherSurInventaire();">Rechercher</button>
    </div>
    <input type="text" class="form-control col-3 " id="codebarre" placeholder="CODE BARRE">
    <div class="col">
      <a href="addDevice.php" class="float-right btn btn-success ml-2" >Ajouter bien</a>
    </div>
  </div>
  
<div class="table-responsive" style="max-height: 400px;margin-top: 20px;">
<table class="table table-striped " style="">
  <thead style="position:sticky;top:0;background: white;" >
    <tr>
      <th scope="col" style='white-space: nowrap;'>ID</th>
      <th scope="col" style='white-space: nowrap;'>SITE</th>
      <th scope="col" style='white-space: nowrap;'>SOUS SITE</th>
      <th scope="col" style='white-space: nowrap;'>EMPLACEMENT</th>
      <th scope="col" style='white-space: nowrap;'>CODE BARE</th>

      <th scope="col" style='white-space: nowrap;'>DESIGNATION</th>
      <th scope="col" style='white-space: nowrap;'>REFERENCE</th>
      <th scope="col" style='white-space: nowrap;'>DATE D'AMORTISSEMENT</th>
      <th scope="col" style='white-space: nowrap;'>DATE MISE EN SERVICE</th>
      <th scope="col" style='white-space: nowrap;'>DUREE D'AMORITISSEMENT</th>
      <th scope="col" style='white-space: nowrap;'> AMMORTISSEMENT</th> 
      <th scope="col" style='white-space: nowrap;'>VALEUR HT</th> 
      <th scope="col" style='white-space: nowrap;'>SN/IMEI</th>
      <th scope="col" style='white-space: nowrap;'>FOURNISSEUR</th>
      <th scope="col" style='white-space: nowrap;'>CODE COMPTABLE</th>
      <th scope="col" style='white-space: nowrap;'>COMPTE COMPTABLE</th>
      <th scope="col" style='white-space: nowrap;'>DATE D'ACHATE</th>
      <th scope="col" style='white-space: nowrap;'>TYPE IMMOBILISATION</th>
      <th scope="col" style='white-space: nowrap;'>SECTION ANLYTIQUE</th>
      <th scope="col" style='white-space: nowrap;'>AFECTATION A</th> 
      <th scope="col" style='white-space: nowrap;'>N°-BC</th>
      <th scope="col" style='white-space: nowrap;'>PRIX D'ACHAT</th>
      <th scope="col" style='white-space: nowrap;'>TAUX D'AMMORTISSEMENT</th>
      <th scope="col" style='white-space: nowrap;'>FACTEUR/BL (PJ)</th>
      <th scope="col" style='white-space: nowrap;'>CODE A BARRE</th>
      <th scope="col" style='white-space: nowrap;'>SOUS FAMILLE</th>
      <th scope="col" style='white-space: nowrap;'>DESCRIPTION FAMILLE</th>
      <th scope="col" style='white-space: nowrap;'></th>

    </tr>
  </thead>
  <tbody id="tbody">
  </tbody>


<script type="text/javascript">
   $(document).ready(function(){
    getInventaire();
    $('#codebarre').keyup(function(){
      $('#tbody').html('');
 
      var codebarre = $(this).val();
       if(codebarre != ""){
        $.ajax({
          type: 'POST',
          url: 'includes/dataEchange.inc.php',
          data: {codebarre:codebarre},
          success: function(data){
            if(data != ""){
              $('#tbody').html(data);
            }else{
              document.getElementById('result').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun Bien</div>";
            }
          }
        });
      }else{
        getInventaire();
      }
    });
  })
  function deleteInv(id){
    if(confirm("")){
      var ajax = new XMLHttpRequest();
      ajax.open("POST", "includes/dataEchange.inc.php", true);
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send("delete=&id="+id);
      ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = this.responseText;
          getInventaire();
        }
      }
    }
  }
  function getInventaireRow(id){
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "includes/dataEchange.inc.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("getInventaire");
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = this.responseText;
        document.getElementById("tbody").innerHTML = data;
      }
    }
  }
  function getInventaire() {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "includes/dataEchange.inc.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("getInventaire");
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var data = this.responseText;
        document.getElementById("tbody").innerHTML = data;
      }
    }
  }


      function rechercherSurInventaire(){
        var ajax = new XMLHttpRequest();
        var StartDate = document.getElementById('SDate').value;
        var FintDate = document.getElementById('FDate').value;
        var etat = document.getElementById('etat').value;
        ajax.open("POST", "includes/dataEchange.inc.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("searchInventaire=&dateS="+StartDate+"&dateF="+FintDate+"&etat="+etat);
        ajax.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            document.getElementById("tbody").innerHTML = data;
          }
        }
      }
    </script>
  </tbody>
</table>
<?php include_once "includes/footer.inc.php"; ?>