<?php
if (!isset($_SERVER['PHP_AUTH_USER'])){
	header('WWW-Authenticate: Basic realm=" Zona Restringida "');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Zona Restringida: Se requiere autorizacion.';
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
		echo 'Zona Restringida: Se requiere autorizacion.';
		exit();
	}
	else {
		include("telegrama.php");
	}
}
?>