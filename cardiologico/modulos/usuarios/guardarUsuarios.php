<?php
	$nombre="".$_POST['nombre']."";
	$login="".$_POST['login']."";
	$password="".$_POST['password']."";
	$nivel="".$_POST['nivel']."";
	include("../../datos/datos.php");
	insertarUsuarios($nombre,$login,$password,$nivel);
	include ("insert.php");
?>