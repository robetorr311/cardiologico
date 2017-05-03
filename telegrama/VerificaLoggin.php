<?php
	$loggin="".$_POST['loggin']."";
	include("../cardiologico/datos/datos.php");
	$i=buscarloggin($loggin);
	echo $i;
?>