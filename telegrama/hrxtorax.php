<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<div id=\"rayosx\"><table width=\"660\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Seleccione una Imagen (gif/jpj/png): </td>";
	$resultado.="<td><input name=\"archrxtorax\" type=\"file\" class=\"textbox\" id=\"archrxtorax\" size=\"50\"></td>";
	$resultado.="<td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\"></td>";
	$resultado.="</tr>";
	$resultado.="</table></div>";
	echo $resultado;
?>