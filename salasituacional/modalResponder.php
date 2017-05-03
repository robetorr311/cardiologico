<?php
	$id = $_GET['id'];
	include("../cardiologico/datos/datos.php");
	$datos=Buscarmensajeriapendientecardiologico($id);
			$usuario=$datos[1];
			$husuario=$datos[2];			
			$hmedico=$datos[3];
			$fech=$datos[4];			
			$hdocumento=$datos[5];
			$hpaciente=$datos[6];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<input id=\"hdocumento\" type=\"hidden\" value=\"$hdocumento\">";
	$resultado.="<input id=\"hpaciente\" type=\"hidden\" value=\"$hpaciente\">";
	$resultado.="<input id=\"hmedico\" type=\"hidden\" value=\"$hmedico\">";
	$resultado.="<input id=\"husuario\" type=\"hidden\" value=\"$husuario\">";
	$resultado.="<input id=\"hpadre\" type=\"hidden\" value=\"$id\">";	
	$resultado.="<table cellspacing=\"0\" width=\"600\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" ><div align=\"center\">Responder</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" ><textarea name=\"respuesta\" cols=\"200\" rows=\"2\" id=\"respuesta\"  class=\"textbox\" ></textarea></td>";
	$resultado.="</tr>";	
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" ><input name=\"button\" type=\"button\" class=\"button\" id=\"button\" value=\"Cerrar\" onClick=\"window.parent.hidePopWin();\"><input name=\"button\" type=\"button\" class=\"button\" id=\"button\" value=\"Enviar\" onClick=\"Enviar();\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>