<?php
	$himagen = "".$_POST["himagen"]."";
	$examen="".$_POST["examen"]."";
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table><tr><td><input type=\"button\" name=\"guardar\" value=\"Guardar\" onClick=\"validaForm()\" ><input id=\"examen\" name=\"examen\" type=\"hidden\" value=\"$examen\"><input id=\"himagen\" name=\"himagen\" type=\"hidden\" value=\"$himagen\"><input type=\"button\" name=\"anexar\" value=\"Anexar Imagen\" onClick=\"SubirImagen(document.formulario.idpaciente.value)\" >";
	$resultado.="<input type=\"button\" name=\"consultar\" value=\"Consulta\" onClick=\"consulta()\" ></td></tr></table>";
	echo $resultado;
?>