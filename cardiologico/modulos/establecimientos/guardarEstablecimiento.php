<?php
	$nombre="".$_POST['nombre']."";
	$direccion="".$_POST['direccion']."";
	$telefono="".$_POST['telefono']."";
	$hlocalidad="".$_POST['sector']."";
	include("../../datos/datos.php");
	insertEstablecimiento($nombre,$telefono,$direccion,$hlocalidad);
	include("insert.php");
?>