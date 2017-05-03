<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table><tr><td><input type=\"button\" name=\"guardar\" value=\"Guardar\" onClick=\"validaForm()\" ><input name=\"himagen\" type=\"hidden\"><input type=\"button\" name=\"anexar\" value=\"Anexar Examen Fisico\" onClick=\"SubirImagen()\" >";
	$resultado.="<input type=\"button\" name=\"consultar\" value=\"Consulta\" onClick=\"consulta()\" ></td></tr></table>";
	echo $resultado;
?>