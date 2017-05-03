<?php
	$husuario="".$_POST["husuario"]."";
	include("../cardiologico/datos/datos.php");
	$salida=mensajeriapendientetelegrama($husuario);
	echo $salida;
?>