<?php
	$nombre="".$_POST['nombre']."";
	$estado="".$_POST['estado']."";
	$municipio="".$_POST['municipio']."";
	$parroquia="".$_POST['parroquia']."";
	include("../../datos/datos.php");
	insertarUbicacion($nombre,$estado,$municipio,$parroquia);
	include ("insert.php");
?>