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
	$estatus=0;
	$loggin="".$_POST['loggin']."";
	$password="".$_POST['password']."";		
	include("../../datos/datos.php");
	updateRegistrados($id,$cedula,$nombre,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$sector,$loggin,$password);
	include ("update.php");
?>