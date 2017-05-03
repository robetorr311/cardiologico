<?php
	$id="".$_POST['id']."";
	include '../cardiologico/datos/datos.php';
	Actualizarenrespuesta($id);
	$resultado="OK";
	echo $resultado;
?>