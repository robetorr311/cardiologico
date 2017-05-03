<?php
	session_start();
	$_SESSION = array();
	$_SESSION["activa"]	= 0;
    session_destroy();
    $_SERVER['PHP_AUTH_USER'] = '';
    $_SERVER['PHP_AUTH_PW'] = '';	
    header("Location: loggout.php", TRUE, 301); 

?>