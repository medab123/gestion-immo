<?php include_once "includes/header.inc.php"; 
include_once "includes/functions.inc.php";
?>






<style>

table {
margin-left:60px;
width: auto;
-webkit-box-flex: 1;
        flex: 1;
display: grid;
border-collapse: collapse;
grid-template-columns: 
  
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr) 
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)

  minmax(210px, 1fr)
  


  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr)
  minmax(210px, 1fr);

 
 
}


.tableFixHead          { overflow: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
thead,
tbody,
tr {
display: contents;

}

th,
td {
padding: 15px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}

th {
position: -webkit-sticky;
position: sticky;
top: 0;
background: #5cb85c;
text-align: left;
font-weight: normal;
font-size: 1.1rem;
color: black;
position: relative;
}

th:last-child {
border: 0;
}

.resize-handle {
position: absolute;
top: 0;
right: 0;
bottom: 0;
background: black;
opacity: 0;
width: 3px;
cursor: col-resize;
}

.resize-handle:hover,
.header--being-resized .resize-handle {
opacity: 0.5;
}

th:hover .resize-handle {
opacity: 0.3;
}

td {
padding-top: 10px;
padding-bottom: 10px;
color: #808080;
}

tr:nth-child(even) td {
background: #f8f6ff;
}
  </style>
  <div   style=" margin-left: 45px;">
<div class="form-row" style="margin: 10PX; margin-left: 10px;">

    <div class="col-2">
      <input type="date" id="SDate" class="form-control" placeholder="DATE Debut">
    </div>
    <div class="col-2">
      <input type="date" id="FDate" class="form-control" placeholder="DATE Fin">
    </div>
    <div class="col-2">
      <select  class="form-control" id="etat">
        <option value="">Select état ...</option>
        <option value="1"> AFFECTE</option>
        <option value="2">NON AFFECTE</option>
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
   
   <div class="d-inline form-row "style="margin-top: 10%; margin-left: 14px;" >
      <select  class="form-control form-control  d-inline col-3" id="categore" >
        <option value=""> SELECT CATEGORIE<i class="fas fa-caret-down"></i></option>
        <?php
          $sql= "select * from categore";
          $do= mysqli_query($con,$sql);
          while($row=mysqli_fetch_array($do)){
            echo '<option value="'.$row['ID_cat'].'">'.$row['type_cat'].'</option>';
          }
        ?>
      </select>

      <label for="inputEmail4" class="d-inline col-3" style="font-weight: bold;"> </label>
		  <select  class="form-control form-control d-inline col-3" id="entreprise" name="entreprise" >
        <option value="">CHOISIR UNE ENTREPRISE<i class="fas fa-caret-down"></i></option>
	      <?php
          $sql= "select * from entreprise";
          $do= mysqli_query($con,$sql);
          while($row=mysqli_fetch_array($do)){
            echo '<option value="'.$row['id_entreprise'].'">'.$row['nom_entreprise'].'</option>';
          }
        ?>
      </select>
     
      <select  class="form-control form-control d-inline col-3" id="vna"  >
        <option value="">CHOISIR UNE vna<i class="fas fa-caret-down"></i></option>
	      
          <option value="0">VNA</option>
      </select>
      
    </div>
    <div  class="" style="margin: 5px;">
    <?php 
        if(isset($_GET['categorie'])) {
          $categorie = protectedVar($_GET["categorie"],$con);
        }
        echo"<a  style='margin: 1em;' class=' btn btn-success' href='includes/excel.php?categorie=".$categorie."'>export</a>";
       // echo "<td><a class='btn btn-primary btn-sm mr-1'  href='calculecumule.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
      ?>
    </div>
    
  
  </div>  
  </div> 
    
 
<div>
<table class="table table-striped table-sm ">
  <thead style="" >
  <tr class=" resize-handle">

      <th data-type="numeric">ID<span class="resize-handle"></span></th>

      <th data-type="text-short">REF <span class="resize-handle"></span></th>

      <th data-type="text-short">SITE <span class="resize-handle"></span></th>

      <th data-type="text-short">SOUS SITE <span class="resize-handle"></span></th>

      <th data-type="text-short">EMPLACEMENT <span class="resize-handle"></span></th>

      <th data-type="text-long">CODE BARE <span class="resize-handle"></span></th>

      <th data-type="text-short"> DESIGNATION<span class="resize-handle"></span></th>
      <th data-type="text-long">DATE D'ACHATE <span class="resize-handle"></span></th>
      <th data-type="text-long"> FOURNISSEUR<span class="resize-handle"></span></th>

      <th data-type="text-long"> SN/IMEI<span class="resize-handle"></span></th>
      <th data-type="text-long"> FACTUR/BL (PJ)<span class="resize-handle"></span></th>
      <!-- <th data-type="text-long"> TYPE IMMOBILISATION<span class="resize-handle"></span></th>-->

      <th data-type="text-long"> SECTION ANLYTIQUE<span class="resize-handle"></span></th>
      <!--<th data-type="text-long">AFFECTATION <span class="resize-handle"></span></th>-->
      
      
      <th data-type="text-long"> QUANTITE<span class="resize-handle"></span></th>
      <th data-type="text-short">DATE MISE EN SERVICE <span class="resize-handle"></span></th>
      <th data-type="text-long">CODE COMPTABLE <span class="resize-handle"></span></th>
   

   <th data-type="text-long">COMPTE COMPTABLE <span class="resize-handle"></span></th>

   <th data-type="text-long">DUREE D'AMORITISSEMENT <span class="resize-handle"></span></th>

   <th data-type="text-short">DATE D'AMORTISSEMENT <span class="resize-handle"></span></th>

   <th data-type="text-long">SOUS FAMILLE <span class="resize-handle"></span></th>

<th data-type="text-long"> DESCRIPTION FAMILLE<span class="resize-handle"></span></th>

<th data-type="text-short"> N°-BC<span class="resize-handle"></span></th>

<th data-type="text-long">PRIX D'ACHAT <span class="resize-handle"></span></th>
<th data-type="text-long">N° FACTUR <span class="resize-handle"></span></th>
<th data-type="text-long"> TAUX D'AMMORTISSEMENT<span class="resize-handle"></span></th>
<th data-type="text-long"> AMMORTISSEMENT<span class="resize-handle"></span></th>
<th data-type="text-long"> CUMULE<span class="resize-handle"></span></th>
<th data-type="text-long"> VNA<span class="resize-handle"></span></th>
<!--<th data-type="text-long"> CALCULER<span class="resize-handle"></span></th>-->
<th data-type="text-long"> <span class="resize-handle"></span></th>
      <!--
      <th data-type="text-long"> AMMORTISSEMENT<span class="resize-handle"></span></th>
      <th data-type="text-long"> TYPE IMMOBILISATION<span class="resize-handle"></span></th>
      <th data-type="text-long"> TAUX D'AMMORTISSEMENT<span class="resize-handle"></span></th>
      <th data-type="numeric">ID<span class="resize-handle"></span></th>
      <th data-type="numeric">ID<span class="resize-handle"></span></th>-->
    </tr>
  </thead>
  <tbody id="tbody">
  <?php 
        $page = 0;
        $path_only = basename($_SERVER['REQUEST_URI']);
        //echo $path_only;
        $filter = "";
        if(isset($_GET["page"])){
          $page = intval(protectedVar($_GET["page"],$con));
        }
        if(isset($_GET['entreprise'])) {
          //$categorie = protectedVar($_GET["categorie"],$con);
          $entreprise = protectedVar($_GET["entreprise"],$con);
          $filter = "where id_entreprise ='$entreprise'";
          //$filter = "where ID_cat ='$categorie'";
        }
        if(isset($_GET['categorie'])) {
          $categorie = protectedVar($_GET["categorie"],$con);
          //$entreprise = protectedVar($_GET["entreprise"],$con);
          //$filter = "where id_entreprise ='$entreprise'";
          $filter = "where ID_cat ='$categorie'";
        }
        if(isset($_GET['entreprise']) && ($_GET["categorie"])) {
          $categorie = protectedVar($_GET["categorie"],$con);
          $entreprise = protectedVar($_GET["entreprise"],$con);
          $filter = "where id_entreprise ='$entreprise' and  ID_cat='$categorie'";
        
        }
        if(isset($_GET['vna'])) {
          $vna = protectedVar($_GET["vna"],$con);
          //$entreprise = protectedVar($_GET["entreprise"],$con);
          $filter = "where (prix_achat - (duree_ammortissement*100/duree_ammortissement)*prix_achat/100) ='$vna'";
        
        }

        mysqli_set_charset($con, "utf8mb4");
    		$sql = "Select * from inventaire $filter ORDER BY ID Asc LIMIT ". strval($page*350) .",350";
        $res = mysqli_query($con,$sql);
        //echo $sql;
        if(mysqli_num_rows($res) > 0){
          while($row = mysqli_fetch_assoc($res)){
            echo "<tr style='white-space: nowrap;' id=".$row["ID"].">";
            echo "<td style='white-space: nowrap;'>".$row["ID"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["num_immo"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["site"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["sous_site"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["emplacement"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["code_bare"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["DESIGNATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["DATE_D_ACHATE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["FOURNISSEUR"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["SN_IMEI"]."</td>";
            echo '<td style="white-space: nowrap;""><a target="_blank" rel="noopener noreferrer"  href='.PATH_HOST.PATH_FACTUR.basename($row["FACTUR"]).'>PDF</a></td>';
            //echo "<td style='white-space: nowrap;'>".$row["IMMOBILISATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["SECTION_ANLYTIQUE"]."</td>";
            //echo "<td style='white-space: nowrap;'>".$row["AJECTATION"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["VALEUR_HORS_TAXTE"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["D_enservice"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["code_comptable"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["compte_comptable"]."</td>";
            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }else{
                echo "<td style='white-space: nowrap;'>".($row["duree_ammortissement"])."</td>";
            }
            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }else{
              echo "<td style='white-space: nowrap;'>".date('Y-m-d',strtotime($row["duree_ammortissement"]."year", strtotime($row["D_enservice"])))."</td>";
            }
           // echo "<td style='white-space: nowrap;'>".$row["duree_ammortissement"]."</td>";
            //echo "<td style='white-space: nowrap;'>".date('Y-m-d',strtotime($row["duree_ammortissement"]."year", strtotime($row["D_enservice"])))."</td>";
            echo "<td style='white-space: nowrap;'>".$row["sfamille"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["dfamille"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["n_bc"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["prix_achat"]."</td>";
            echo "<td style='white-space: nowrap;'>".$row["FACTUR"]."</td>";
            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }else{
              echo "<td style='white-space: nowrap;'>".(100/$row["duree_ammortissement"])."</td>";
            }/*
            if($row["dure_act"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".$row["dure_act"]."</td>";
            }
            */
            //echo "<td style='white-space: nowrap;'>".(($row["prix_achat"])*(100/$row["duree_ammortissement"]))."</td>";

            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".(($row["prix_achat"])*(100/$row["duree_ammortissement"]))."</td>";
            }

            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".((($row["duree_ammortissement"])*(100/$row["duree_ammortissement"])*($row["prix_achat"]))/100)."</td>";
            }
            
            if($row["duree_ammortissement"]==0){
              echo "<td style='white-space: nowrap;'>0</td>";
            }
            else{
              echo "<td style='white-space: nowrap;'>".floatval(($row["prix_achat"])-(($row["duree_ammortissement"])*(100/$row["duree_ammortissement"])*($row["prix_achat"]))/100)."</td>";
            }
            
            //echo "<td><a class='btn btn-primary btn-sm mr-1'  href='calculecumule.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
            echo "<td><a class='btn btn-primary btn-sm mr-1'  href='addDevice.php?id=".$row['ID']."'><i  class='fas fa-edit'></i></a>";
            echo "<a class='btn btn-danger btn-sm' href='javascript:void(0);' onclick='deleteInv(".$row["ID"].")'><i class='fas fa-trash'></i></a></td>";//28
            echo "</tr>";	
          }
        }
?>
  </tbody>
</table>

      </div>
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item ">
       <a class="page-link" href="showDevices.php?page=<?php echo ($page == 0) ? '0' : $page-1; echo  isset($_GET['categorie']) ? "&categorie=".$categorie : ""; ?>" >Previous</a>
    </li>
    <?php if($page != 0){
?>
    <li class="page-item"><a class="page-link" href="showDevices.php?page=<?php echo ($page == 0) ? '0' : $page-1; ?>"><?php echo ($page == 0) ? '0' : $page-1; ?></a></li>

<?php
  }?>
    <li class="page-item active"><a class="page-link" href="showDevices.php?page=<?php echo $page; echo  isset($_GET['categorie']) ? "&categorie=".$categorie : ""; ?>"><?php echo $page; ?> <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="showDevices.php?page=<?php echo $page+1;echo  isset($_GET['categorie']) ? "&categorie=".$categorie : "";  ?>"><?php echo $page+1; ?></a></li>
    <li class="page-item">
      <a class="page-link" href="showDevices.php?page=<?php echo $page+1;echo  isset($_GET['categorie']) ? "&categorie=".$categorie : "";  ?>">Next</a>
    </li>
  </ul>
</nav>


<script>


  
const min = 150;
// The max (fr) values for grid-template-columns
const columnTypeToRatioMap = {
  numeric: 1,
  'text-short': 1.67,
  'text-long': 3.33 };
 
 
const table = document.querySelector('table');
 
                                          
const columns = [];
let headerBeingResized;
 
// The next three functions are mouse event callbacks
 
// Where the magic happens. I.e. when they're actually resizing
const onMouseMove = e => requestAnimationFrame(() => {
  console.log('onMouseMove');
 
  // Calculate the desired width
  horizontalScrollOffset = document.documentElement.scrollLeft;
  const width = horizontalScrollOffset + e.clientX - headerBeingResized.offsetLeft;
 
  // Update the column object with the new size value
  const column = columns.find(({ header }) => header === headerBeingResized);
  column.size = Math.max(min, width) + 'px'; // Enforce our minimum
 
  // For the other headers which don't have a set width, fix it to their computed width
  columns.forEach(column => {
    if (column.size.startsWith('minmax')) {// isn't fixed yet (it would be a pixel value otherwise)
      column.size = parseInt(column.header.clientWidth, 10) + 'px';
    }
  });
 
  /* 
        Update the column sizes
        Reminder: grid-template-columns sets the width for all columns in one value
      */
  table.style.gridTemplateColumns = columns.
  map(({ header, size }) => size).
  join(' ');
});
 
// Clean up event listeners, classes, etc.
const onMouseUp = () => {
  console.log('onMouseUp');
 
  window.removeEventListener('mousemove', onMouseMove);
  window.removeEventListener('mouseup', onMouseUp);
  headerBeingResized.classList.remove('header--being-resized');
  headerBeingResized = null;
};
 
// Get ready, they're about to resize
const initResize = ({ target }) => {
  console.log('initResize');
 
  headerBeingResized = target.parentNode;
  window.addEventListener('mousemove', onMouseMove);
  window.addEventListener('mouseup', onMouseUp);
  headerBeingResized.classList.add('header--being-resized');
};
 
// Let's populate that columns array and add listeners to the resize handles
document.querySelectorAll('th').forEach(header => {
  const max = columnTypeToRatioMap[header.dataset.type] + 'fr';
  columns.push({
    header,
    // The initial size value for grid-template-columns:
    size: `minmax(${min}px, ${max})` });
 
  header.querySelector('.resize-handle').addEventListener('mousedown', initResize);
});


</script>
<script type="text/javascript">
   $(document).ready(function(){
    //getInventaire();
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

<script>
  $(document).ready(function(){

    $('#categore').on('change ',function(){

      var  categorieID = $(this).val();
      if( categorieID){
        window.open("showDevices.php?categorie="+categorieID,"_self");
      }

    });

  });

</script>
<script>
  $(document).ready(function(){

    $('#entreprise').on('change ',function(){

      var  entrepriseid = $(this).val();
      if( entrepriseid){
        window.open("showDevices.php?entreprise="+entrepriseid,"_self");
      }

    });

  });

</script>
<script>
  $(document).ready(function(){

    $('#vna').on('change ',function(){

      var  vna = $(this).val();
      if( vna){
        window.open("showDevices.php?vna="+vna,"_self");
      }

    });

  });

</script>
              
<?php include_once "includes/footer.inc.php"; ?>