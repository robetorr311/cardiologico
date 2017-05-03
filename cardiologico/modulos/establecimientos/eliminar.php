<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	Eliminar_establecimiento($id);
	$resultado="OK";
	echo $resultado;
?>