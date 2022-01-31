
<?php 
    session_start();

    //after insert or update 
    //$_SESSION['status'] = "<Type Your success message here>";
?>


<?php include_once "includes/header.inc.php"; ?>
    <?php include_once "includes/popUp.inc.php"; ?> 
    <?php  include_once 'includes/DbConnection.inc.php';?>
    <?php include_once "Dbconion.inc.php";
            include_once "functions.inc.php";
            include_once "./modal.php";
            include_once "pdf.php";
            include_once "../Conf/config.php";
            
            session_start();
            //error_reporting(E_ALL);
            //ini_set("display_errors", 1);
       ?>
<?php  



 if(!empty($_FILES["employee_file"]["name"]))  
 {  
      $result=""; 
      $output = '';  
      $allowed_ext = array("csv");  
      $extension = end(explode(".", $_FILES["employee_file"]["name"]));  
      if(in_array($extension, $allowed_ext))  
      {  
           $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');  
           fgetcsv($file_data);  
           while($row = fgetcsv($file_data))  
           {        
                
                $name = mysqli_real_escape_string($con, $row[0]);  
                $address = mysqli_real_escape_string($con, $row[1]);  
                $gender = mysqli_real_escape_string($con, $row[2]);  
                $designation = mysqli_real_escape_string($con, $row[3]);  
                $age = mysqli_real_escape_string($con, $row[4]);  
                $query = "  
                INSERT INTO tbl_employee  
                     (name, address, gender, designation, age)  
                     VALUES ('$name', '$address', '$gender', '$designation', '$age')  
                "; 
                //print_r ($query);
                $result = mysqli_query($con, $query);
                header("Location: showDevices.php"); 
         
           } 
           /* 

           $select = "SELECT * FROM tbl_employee ORDER BY id DESC";  
           $result = mysqli_query($con, $select);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="5%">ID</th>  
                          <th width="25%">Name</th>  
                          <th width="35%">Address</th>  
                          <th width="10%">Gender</th>  
                          <th width="20%">Designation</th>  
                          <th width="5%">Age</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'.$row["id"].'</td>  
                          <td>'.$row["name"].'</td>  
                          <td>'.$row["address"].'</td>  
                          <td>'.$row["gender"].'</td>  
                          <td>'.$row["designation"].'</td>  
                          <td>'.$row["age"].'</td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
           echo $output; 
           */ 
      }  
      else  
      {  
          
          //after insert or update 
          //$_SESSION['status'] = "<Type Your success message here>";
          header("Location: upload.php");
      }
        
 }  
 else 
 {  
     
     //$_SESSION['status'] = "<Type Your success message here>";
     header("Location: upload.php");
     
   exit();
       
 } 
 ob_end_flush(); 

 ?>  