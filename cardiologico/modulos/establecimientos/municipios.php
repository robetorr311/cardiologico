<?php
	$id="".$_POST['estado']."";
	include("../../datos/datos.php");
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Municipio:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"municipio\" id=\"municipio\" onChange=\"verParroquias()\">";
	$resultado.="<option value=\"xx\">Seleccione un Municipio</option>";
	$resultado.=Municipios($id);
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\"  width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Municipio')\" ></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>