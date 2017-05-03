<?php
	$loggin="".$_POST['loggin']."";
	include("../../datos/datos.php");
	$i=buscarlogginMedico($loggin);
	echo $i;
?>