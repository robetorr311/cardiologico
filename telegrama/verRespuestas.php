<?php
    session_start();
	$usuario="".$_SESSION['login']."";
/* 	if (!isset($_POST["usuario"])){
	$usuario="";
	}
	else {
		$usuario="".$_POST["usuario"]."";
	} */
	include("../cardiologico/datos/datos.php");
	$salida=repuestasPendientes($usuario);
	echo $salida;
?>