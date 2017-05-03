<?php
	$personales="".$_POST['personales']."";
	$familiares="".$_POST['familiares']."";
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<input type=\"hidden\" id=\"personales\" value=\"$personales\">";
	$resultado.="<input type=\"hidden\" id=\"familiares\" value=\"$familiares\">";
	echo $resultado;
?>