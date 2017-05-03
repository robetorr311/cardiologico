<?php
	include '../../../datos/datos.php';
	$id="".$_POST['id']."";
	$inicio=0;
	$salida=listar_examenes_adelante($inicio,$id);
	echo $salida;
?>