<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	Eliminar_registrados($id);
	$resultado="OK";
	echo $resultado;
?>