<?php 
	define("PATH_HOST", (($_SERVER["SERVER_PORT"] == 443) ? 'https' : 'http').'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'); 
	define("PATH_ROOT",  $_SERVER['DOCUMENT_ROOT'].'/');
	define("PATH_RACIN", "EV_Inv_IMMO/");
	define("PATH_INCLUDES", PATH_RACIN."includes/");
	define("PATH_QR", PATH_RACIN."PDF/");
	define("PATH_FACTUR", PATH_RACIN."FACTUR/");
?>