<?php
session_start();
if (!isset($_SESSION['login'])){
		require ("error.php");
	exit();
}
else {
	include("../../../datos/datos.php");
	$log= "".$_SESSION['login']."";
	$pwd= "".$_SESSION['password']."";
	$reg=buscarPassword($log,$pwd);
	if ($reg==0){
		require ("error.php");
		exit();
	}
	else {
		include("historias.php");
	}
}
?>
