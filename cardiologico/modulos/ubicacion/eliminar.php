<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	Eliminar_usuario($id);
	$resultado="OK";
	echo $resultado;
?>