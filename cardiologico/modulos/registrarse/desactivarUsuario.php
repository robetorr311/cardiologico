<?php
	if (empty($resultado)){
		$resultado="";
	}
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	$datos=Desactivar_registrados($id);
	echo "Usuario Desactivado";
?>