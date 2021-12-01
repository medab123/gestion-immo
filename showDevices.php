<?php include_once "includes/header.inc.php"; ?>
  <div class="form-row">
    <div class="col-2">
      <input type="date" id="SDate" class="form-control" placeholder="DATE Debut">
    </div>
    <div class="col-2">
      <input type="date" id="FDate" class="form-control" placeholder="DATE Fin">
    </div>
    <div class="col-2">
      <select type="text" class="form-control" id="etat">
        <option value="">Select état ...</option>
        <option value="NOT AFECTED">NON AFFICTER</option>
        <option value="AFECTED">AFFECTER</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2" onclick="rechercherSurInventaire();">Rechercher</button>
    </div>
  </div>
<div class="table-responsive" style="max-height: 400px;margin-top: 20px;">
<table class="table table-striped " style="">
  <thead style="position:sticky;top:0;background: white;" >
    <tr>
      <th scope="col" style='white-space: nowrap;'>ID</th>
      <th scope="col" style='white-space: nowrap;'>DESIGNATION</th>
      <th scope="col" style='white-space: nowrap;'>REFERENCE</th>
      <th scope="col" style='white-space: nowrap;'>DATE D'AMORTISSEMENT</th>
      <th scope="col" style='white-space: nowrap;'>DATE MISE EN SERVICE</th>
      <th scope="col" style='white-space: nowrap;'>DUREE D'AMORITISSEMENT</th>
      <th scope="col" style='white-space: nowrap;'>VALEUR HT</th> 
      <th scope="col" style='white-space: nowrap;'>SN/IMEI</th>
      <th scope="col" style='white-space: nowrap;'>FOURNISSEUR</th>
      <th scope="col" style='white-space: nowrap;'>DATE D'ACHATE</th>
      <th scope="col" style='white-space: nowrap;'>TYPE IMMOBILISATION</th>
      <th scope="col" style='white-space: nowrap;'>SECTION ANLYTIQUE</th>
      <th scope="col" style='white-space: nowrap;'>AFECTATION A</th> 
      <th scope="col" style='white-space: nowrap;'>NUM INVENTAIRE</th>
      <th scope="col" style='white-space: nowrap;'>FACTEUR/BL (PJ)</th>
      <th scope="col" style='white-space: nowrap;'>CODE A BARRE</th>
    </tr>
  </thead>
  <tbody id="tbody">
  </tbody>

  	<script type="text/javascript">
      $(document).ready(function() {
        getInventaire();
      });
      function getInventaire() {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "includes/dataEchange.inc.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("getInventaire");
        ajax.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            document.getElementById("tbody").innerHTML += data;
          }
        }
      }
      function rechercherSurInventaire(){
        var ajax = new XMLHttpRequest();
        var StartDate = document.getElementById('SDate').value;
        var FintDate = document.getElementById('FDate').value;
        var etat = $("#etat option:selected").text();
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