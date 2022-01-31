    
    <?php 
     session_start();
    ob_start();
    include_once "includes/header.inc.php";
    
    ?>
    <?php include_once "includes/popUp.inc.php"; ?> 
    <?php  include_once 'includes/DbConnection.inc.php';?>
    <?php include_once "Dbconion.inc.php";
            include_once "functions.inc.php";
            include_once "./modal.php";
            include_once "pdf.php";
            include_once "../Conf/config.php";
            
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
       ?>

<style>

  .center {
  margin: auto;
  width: 70%;
  margin-left: 35%;
  
  padding: 50
}
</style>
<style>
.alert {
  padding: 15px;
  background-color: #4BB543;
  color: white;
  width: 1000px;;
  margin-left:250px;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>


<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  Selectionnee un Fichier
</div>
                        <div class=" center ">
                              
                           
                              
                       
                                   <form id="upload_csv" method="post" action="import.php" enctype="multipart/form-data">  
                                        
                                             
                                   <div class="form-row ">
                                        <div class="form-group col-md-4">  
                                             <input type="file" name="employee_file" style="margin-top:15px;" />
                                        </div>  
                                        <div class="form-group col-md-4">  
                                             
                                             <input type="submit" name="upload" id="upload" value="IMPORTER" style="margin-top:10px; margin-left:15px;" class="btn btn-success" />   
                                        </div> 
                                          
                                        
                                   </form>  
                            

                                    <div class="table-responsive" id="employee_table">  </div>  
                               
                              </div>
                              </div>
                        </div>
<script>  /*
      $(document).ready(function(){  
           $('#upload_csv').on("submit", function(e){  
                e.preventDefault(); //form will not submitted  
                $.ajax({  
                     url:"import.php",  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,          // To send DOMDocument or non processed data file it is set to false 
                     $('#upload_csv')[0].reset(); 
                      
                     success: function(data){  
                          if(data=='Error1')  
                          {  
                               alert("Invalid File");  
                          }  
                          else if(data == "Error2")  
                          {  
                               alert("Please Select File");  
                          }  
                          else  
                          {  
                               $('#employee_table').html(data);  
                          }  
                     } 
                     
                }) 

           }); 
           //$('#upload_csv')[0].reset();  
      });
      */
</script>  