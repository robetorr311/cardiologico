<?php
	$id="".$_POST['id']."";
	include("../../datos/datos.php");
	$datos=Buscar_respuestas($id);
	$fecha=$datos[1];
	$medico=$datos[2];
	$respuesta=$datos[3];
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<table width=\"600\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Fecha:</td>";
	$resultado.="<td><input name=\"fecha\" type=\"text\" id=\"fecha\" size=\"50\" value=\"$fecha\"  class=\"textbox\" disabled></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td><div id=\"idmed\"><input type=\"hidden\" id=\"idmedico\"><input name=\"nombremc\" type=\"text\" id=\"nombremc\"  class=\"textbox\" size=\"50\" value=\"$medico\" disabled></div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\" class=\"head\"><div align=\"center\">Recomendaciones</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\"><textarea name=\"recomendaciones\" cols=\"200\" rows=\"2\" id=\"recomendaciones\"  class=\"textbox\" disabled>$respuesta</textarea></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\"><input name=\"button\" type=\"button\" id=\"button\" value=\"Aceptar\" onClick=\"cerrarRespuesta('$id')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>