<?php
function setUserInfo($con){
	if(isset($_SESSION["matricule"])){
		$id = $_SESSION["matricule"];
		$sql = "select user.*,identifiant.* from user,identifiant where user.ID_user = identifiant.ID_user and  user.ID_user = '$id' ";
		$rst = mysqli_query($con,$sql);
		if(mysqli_num_rows($rst) > 0){
			$rw = mysqli_fetch_assoc($rst);
			$GLOBALS['avatar']  = $rw["avatar"];
			$GLOBALS['name'] = $rw["nom_user"];
			$GLOBALS['userLastName'] = $rw['prenom_user'];
			$GLOBALS['post_EV'] = $rw['post_ev'];
			$GLOBALS['mail'] = $rw['login'];
		}else{
			header("location: index.php?er=1");
		}
	}else{
		header("location: index.php");
	}
}
function getMatricule(){
	if(isset($_SESSION["matricule"])){ return $_SESSION["matricule"]; }
	else { return null;}
}
function GetUserIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function GetUrl(){
	$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	return $link;
}
function writeLog($Action = ''){
	include("DbConnection.php");
	mysqli_select_db($con,$dbName);
	$sql = "INSERT INTO log (IP,ID_user,URL,action) VALUES('".GetUserIpAddress()."',".intval(getMatricule()).",'".GetUrl()."','".$Action."')";
	mysqli_query($con,$sql);
}
function protectedVar($string,object $Dbconnection = null){
	// To prevent XSS injection
	$arg = strip_tags($string);
	// trim function removes space before and after the strings
	$arg = trim($arg);
	// To protect MySQL injection
	$arg = stripslashes($arg);
	if($Dbconnection != null){
		$arg = mysqli_real_escape_string($Dbconnection,$arg);
	}
	return $arg;
}
function contWeek($startdate){
	$date1 = strtotime($startdate);
	$date2 = date('Y-m-d');
	$date3 = $date1;
	$i=0;
	$weekConter = 0;
	while ($date3 != $date2) {
		$i++;
		$date3 = date('Y-m-d', strtotime("+".$i." day", $date1));
		if(date("l",strtotime($date3)) == "Sunday" || date("l",strtotime($date3)) == "Saturday"){
			$weekConter ++;
		}
	}
	return $weekConter;
}

?>