<?php
	$cedula="".$_POST['cedula']."";
	require("../cardiologico/datos/datos.php");
	$datos=Buscar_pacientes_cedula($cedula);
	$id=$datos[0];
	if (empty($id)){
	$id="0";
	}	
	echo $id;
?>