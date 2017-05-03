<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<div id=\"electro\"><table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Seleccione una Imagen (gif/jpj/png) o un archivo (.ctk): </td>";
	$resultado.="<td class=\"formulario\"><input name=\"arhecg\" type=\"file\" class=\"textbox\" id=\"arhecg\" size=\"50\"></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\"></td>";
	$resultado.="</tr>";
	$resultado.="</table></div>";
	echo $resultado;
?>