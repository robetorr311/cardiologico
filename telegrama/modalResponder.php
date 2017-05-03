<?php
	$id = $_GET['id'];
	include("../cardiologico/datos/datos.php");
	$datos=buscarVistaDocumento($id);
			$hdocumento= $datos[0];
			$numero= $datos[1];
			$horigen= $datos[2];
			$hdestino= $datos[3];			
			$medico= $datos[4];
			$hmedico= $datos[5];
			$estatus= $datos[6];
			$fech= $datos[7];
			$hexamen= $datos[8];
			$paciente= $datos[9];
			$hpaciente= $datos[10];
			$diagnostico= $datos[11];
			$nombreusuario= $datos[12];		
			$login= $datos[13];
			$husuario= $datos[14];
			$observacion= $datos[15];
			$fecharesp= $datos[16];
			$respuesta= $datos[17];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<input id=\"hdocumento\" type=\"hidden\" value=\"$id\">";
	$resultado.="<input id=\"hpaciente\" type=\"hidden\" value=\"$hpaciente\">";
	$resultado.="<input id=\"hmedico\" type=\"hidden\" value=\"$hmedico\">";
	$resultado.="<input id=\"husuario\" type=\"hidden\" value=\"$husuario\">";
	$resultado.="<input id=\"hpadre\" type=\"hidden\" value=\"0\">";	
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