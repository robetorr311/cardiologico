<?php
	if (empty($resultado)){
		$resultado="";
	}
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	$datos=Activar_registrados($id);
	echo "Usuario Activado";
?>