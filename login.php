<?php 
///////////////la recherche 
////////////////rechercher article ////////////
// --------- nem inventaire 
// --------- date d'achate

include_once 'includes/DbConnection.inc.php';
include_once 'includes/functions.inc.php';
session_start();
if(isset($_GET['logout'])){
	session_destroy();
}
if(isset($_SESSION['userId'])){
	header('location: index.php');
}else if(isset($_POST['submit'])){
  	$mail = protectedVar($_POST['mail']);
	$pwd = protectedVar($_POST['pwd']);
	if(strpos($mail,"@elephant-vert.com") == false){
		$mail .= "@elephant-vert.com";
	}
	$sql = "select users.*,role.* from users,role where role.ID_role = users.ID_role and password=md5('".$pwd."') and mail='$mail'";
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($res) > 0){
		$infoUser = mysqli_fetch_assoc($res);
		$userId = $infoUser['ID_user'];
		$role = $infoUser['role'];
		$_SESSION['userId'] = $userId;
		$_SESSION['role'] = $role;
		header("location:index.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
	body{



 
  background-image: url('img/EV-usinM.png');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
  	form{
  		border-radius: 10px;
  		padding: 20px 20px 0 20px;
  		text-align: center;
  		background-color: rgba(0, 0, 0, 0.3);
  		margin: 200px auto;
  		width: 590px;
                color : #fff;


  	}.loginForm{
  		width: 80%;
  		margin: 40px auto;
        button{
                margin: 30px auto;
        }
  


  </style>
</head>
<body>
<div class="bg"></div>

<h2 style="text-align: center;color:#3AA319;position: relative;top: 94px; left: 0px; "> Gestion des inventaires Immo Elephant Vert   </h2>
<form class="form-horizontal" action="login.php" method="POST">
	<h2>Login</h2>
	<div class="loginForm">
	 <form action="/action_page.php">
	  <div class="form-group">
	    <input type="text" class="form-control" name="mail" placeholder="Email address">
	  </div>
	  <div class="form-group">
	    <input type="password" class="form-control" name="pwd" placeholder="Password">
	  </div>
           <div class ="sbtn" style=" position: relative;top:-10px; left: 0px; color:green;">
	  <button type="submit" name="submit" class="btn btn-primary btn-lg" style="background-color:green;">Connecter</button>
          </div>
</form>
</div>
	
</form>
</body>
</html>
