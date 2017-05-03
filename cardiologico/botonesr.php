<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<input type=\"button\" value=\"Guardar\" onClick=\"guardar(document.formulario.iddocumento.value,document.formulario.idestablecimiento.value,document.formulario.recomendacion.value,document.formulario.hmedico.value)\">";
	echo $resultado;
?>