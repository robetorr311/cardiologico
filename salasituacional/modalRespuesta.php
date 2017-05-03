<?php
	$id = $_GET['id'];
	$hmedico = $_GET['hmedico'];
	include("../cardiologico/datos/datos.php");	
	if (empty($resultado)){
	$resultado="";
	}
	$datos=Buscar_medicos($hmedico);
	$cedulamc=$datos[1];
	$nombremc=$datos[2];
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<table cellspacing=\"0\" width=\"600\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" >Cedula del Medico: </td>";
	$resultado.="<td class=\"formulario\" ><input name=\"cedulamc\" type=\"text\" id=\"cedulamc\" value=\"$cedulamc\" disabled ></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" >Nombre y Apellido:</td>";
	$resultado.="<td class=\"formulario\" ><div id=\"idmed\"><input type=\"hidden\" id=\"hdocumento\" value=\"$id\"><input type=\"hidden\" id=\"hmedico\" value=\"$hmedico\"><input name=\"nombremc\" type=\"text\" id=\"nombremc\" value=\"$nombremc\" size=\"50\" disabled></div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\" ><div align=\"center\">Diagnostico</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><textarea name=\"diagnostico\" cols=\"200\" rows=\"2\" id=\"diagnostico\"></textarea></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\" ><div align=\"center\">Recomendaciones</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><textarea name=\"recomendaciones\" cols=\"200\" rows=\"2\" id=\"recomendaciones\"></textarea></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><input name=\"button\" type=\"button\" class=\"button\" id=\"button\" value=\"Aceptar\" onClick=\"cerrarRespuesta();\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>