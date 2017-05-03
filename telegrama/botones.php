<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table><tr><td><input type=\"button\" name=\"guardar\" id=\"guardar\" value=\"Guardar\" onClick=\"validaForm()\" >";
	$resultado.="<input type=\"button\" name=\"anexar\" id=\"anexar\" value=\"Anexar Examen Fisico\" onClick=\"levantapopup('examen','0');\" >";
	$resultado.="</td></tr></table>";
	echo $resultado;
?>