<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	Eliminar_medico($id);
	$resultado="OK";
	echo $resultado;
?>