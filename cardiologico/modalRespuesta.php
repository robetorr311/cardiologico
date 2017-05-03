<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<table width=\"600\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Cedula del Medico: </td>";
	$resultado.="<td><input name=\"cedulamc\" type=\"text\" id=\"cedulamc\" onChange=\"buscarmed(document.formulario.cedulamc.value)\"></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td><div id=\"idmed\"><input type=\"hidden\" id=\"idmedico\"><input name=\"nombremc\" type=\"text\" id=\"nombremc\" size=\"50\" disabled></div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\" class=\"head\"><div align=\"center\">Recomendaciones</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\"><textarea name=\"recomendaciones\" cols=\"200\" rows=\"2\" id=\"recomendaciones\"></textarea></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\"><input name=\"button\" type=\"button\" id=\"button\" value=\"Aceptar\" onClick=\"cerrarRespuesta(document.formulario.idmedico.value,document.formulario.recomendaciones.value)\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>