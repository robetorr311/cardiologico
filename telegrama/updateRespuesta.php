<?php
	$id="".$_POST['id']."";
	$usuario="{$_SERVER['PHP_AUTH_USER']}";
	include("../cardiologico/datos/datos.php");
	if (empty($salida)){
	$salida="";
	}
	DocumentoProcesado($id);
	$salida=repuestasPendientes($usuario);
	echo $salida;
?>