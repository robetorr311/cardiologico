<?php
	$hexamen="".$_POST["hexamen"]."";
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table><tr><td><input type=\"button\" name=\"guardar\" value=\"Guardar\" onClick=\"validaForm()\" >";
	$resultado.="<input type=\"button\" name=\"anexar\" value=\"Anexar Imagen\" onClick=\"SubirImagen(document.formulario.idpaciente.value)\" >";
	$resultado.="<input type=\"button\" name=\"consultar\" value=\"Consulta\" onClick=\"consulta()\" ></td></tr></table>";
	echo $resultado;
?>