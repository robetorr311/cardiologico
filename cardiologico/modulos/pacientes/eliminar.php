<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	Eliminar_pacientes($id);
	$resultado="OK";
	echo $resultado;
?>