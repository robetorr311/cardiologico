<?php
	$cedula="".$_POST['cedula']."";
	if (empty($resultado)){
	$resultado="";
	}
	include("datos/datos.php");
	$datos=Buscar_medicos_cedula($cedula);
	$id=$datos[0];
	$nombre=$datos[2];
	$resultado.="<input name=\"idmedico\" type=\"hidden\" id=\"idmedico\" value=\"$id\" disabled><input name=\"nombremc\" type=\"text\" id=\"nombremc\" size=\"50\" value=\"$nombre\" disabled>";
	echo $resultado;
?>