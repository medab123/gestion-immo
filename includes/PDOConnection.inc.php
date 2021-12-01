<?php
   try{
      $pdo=new PDO("mysql:host=localhost;dbname=la_une","root","P@55w0rd");
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>