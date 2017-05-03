<?php
	if (empty($resultado)){
	$resultado="";
	}	
	$hdocumento="".$_POST['hdocumento']."";
	$recomendacion="".$_POST['recomendacion']."";
	$hmedico="".$_POST['hmedico']."";
	$diagnostico="".$_POST['diagnostico']."";
	include("../cardiologico/datos/datos.php");
	GuardarRespuesta($hdocumento,$hmedico,$recomendacion,$diagnostico);	
	$resultado="OK";
	echo $resultado;
?>