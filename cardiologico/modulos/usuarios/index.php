<?php
session_start();
if (!isset($_SESSION['login'])){
		require ("error.php");
	exit();
}
else {
	include("../../datos/datos.php");
	$log= "".$_SESSION['login']."";
	$pwd= "".$_SESSION['password']."";
	$reg=buscarPassword($log,$pwd);
	if ($reg==0){
		require ("error.php");
		exit();
	}
	else {
		include("usuarios.php");
	}
}
/*
if (!isset($_SERVER['PHP_AUTH_USER'])){
	header('WWW-Authenticate: Basic realm=" Zona Restringida "');
	header('HTTP/1.0 401 Unauthorized');
		require ("error.php");
	exit();
}
else {
	include("../../datos/datos.php");
	$log= "{$_SERVER['PHP_AUTH_USER']}";
	$pwd= "{$_SERVER['PHP_AUTH_PW']}";
	$reg=buscarPassword($log,$pwd);
	if ($reg==0){
		header('WWW-Authenticate: Basic realm=" Zona Restringida "');
		header('HTTP/1.0 401 Unauthorized');
		require ("error.php");
		exit();
	}
	else {
		$nivel=buscarNivel($log,$pwd);
		if ($nivel==1){
			include("usuarios.php");
		}
		else {
			require ("error.php");		
		}
	}
}*/

?>