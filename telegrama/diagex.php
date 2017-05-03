<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table width=\"700\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\" colspan=\"2\">Diagnostico</td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td  class=\"formulario\" ><textarea name=\"diagnostico\" cols=\"100\" rows=\"2\" id=\"diagnostico\" ></textarea></td><td class=\"formulario\" ><img src=\"../cardiologico/Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Diagnotico')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>