<?php 
  include_once "includes/DbConnection.inc.php";
  session_start();
  if(isset($_SESSION["userId"])){
    $sql = "select users.*,role.* from users,role where role.ID_role = users.ID_role and ID_user = ".$_SESSION['userId'];
    $res = mysqli_query($con,$sql);
    if(mysqli_num_rows($res) > 0){
      $infoUser = mysqli_fetch_assoc($res);
      $userName = $infoUser['user_name'];
      $userLName = $infoUser['user_Last_Name'];
      $role = $infoUser['role'];
    }
  }else{
    header('location: login.php');
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/><script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

</head>
<style type="text/css">
.navbar{
  height: 60px;
}

.container1{
  margin: 80px 0;
  width: 100%;
  padding: 60px;
}
.container1{
  margin: 80px 0;
  width: 100%;
  padding: 60px;
}
.name{
  margin: auto 20px;
  color: white;
}.btn-group{
  margin-left: 30px;
}.navbar-nav{
  margin-left:100px;
}
@media screen and (max-width: 980px) {
  .navbar{
    height: auto;
  }.logoInstituFrance{
    display: none;
  }.btn-group{
    margin: 10px 0 20px 0;
  }.navbar-nav{
    margin: 0;
  }
}
</style>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background: #008000;">
  <!-- Container wrapper -->
  <div class="container-fluid">
     <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
    <i class="fas fa-bars"></i>
    </button>
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
        <img class="logoInstituFrance" src="img/LOGO-EV_FR.png" style="width:130px;margin-top:45px" />
      <!-- Left links -->
      <ul   class="navbar-nav me-auto mb-2 mb-lg-0">
        <div  class="btn-group">
          <button  style="background: #32CD32;"  type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false" > inventaire </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="addDevice.php">Ajouter un Bien</a></li>
            <li><a class="dropdown-item" href="showDevices.php">Afficher un Bien</a></li>
          </ul>
        </div>
        <div class="btn-group" >
          <button  style="background: #32CD32;"  type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false"> utilisateur </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="addUser.php">Ajouter un Utilisateur</a></li>
            <li><a class="dropdown-item" href="showUsers.php">Afficher les Utilisateur</a></li>
          </ul>
        </div>
        
        <!---<li class="nav-item">
          <a class="nav-link" href="#">Projects</a>
        </li>---->
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      

      <!-- Notifications -->

      <!-- Avatar -->
      <label class="name"><?=$userName?> <?=$userLName?></label>
      <a
        class="dropdown-toggle d-flex align-items-center hidden-arrow"
        href="#"
        id="navbarDropdownMenuLink"
        role="button"
        data-mdb-toggle="dropdown"
        aria-expanded="false"
      >
        <img
          src="https://mdbootstrap.com/img/new/avatars/2.jpg"
          class="rounded-circle"
          height="40"
          alt=""
          loading="lazy"
        />
      </a>
      <ul
        class="dropdown-menu dropdown-menu-end"
        aria-labelledby="navbarDropdownMenuLink"
      >
        <li>
          <a class="dropdown-item" href="">Mon Compte</a>
        </li>
        <li>
          <a class="dropdown-item" href="login.php?logout">Déconnectée</a>
        </li>
      </ul>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
<div class="container1">
