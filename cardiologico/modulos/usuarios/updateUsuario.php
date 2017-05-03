<?php
	$id="".$_POST['id']."";
	$cedula="".$_POST['cedula']."";
	$nombre="".$_POST['nombre']."";
	$edad="".$_POST['edad']."";
	$sexo="".$_POST['sexo']."";
	$telefono="".$_POST['telefono']."";
	$correo="".$_POST['correo']."";
	$direccion="".$_POST['direccion']."";
	$establecimiento="".$_POST['establecimiento']."";
	$sector="".$_POST['sector']."";
	include("../../datos/datos.php");
	updateMedicos($id,$cedula,$nombre,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$sector);
	include ("update.php");
?>