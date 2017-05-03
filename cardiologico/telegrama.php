<?php
	$id = $_GET['id'];
	if (empty($resultado)){
	$resultado="";
	}
			include("datos/datos.php");	
	$datos=buscartelegramasPendientes($id);
	$hdocumento= $datos[0];
	$numero= $datos[1];
	$fechan= $datos[2];
	$paciente= $datos[3];
	$idpaciente= $datos[4];
	$establecimiento= $datos[5];
	$idusuario= $datos[6];
	$cedulau= $datos[7];
	$nombreu= $datos[8];
	$diagnostico= $datos[9];
	$hexamen= $datos[10];
	$hecg= $datos[11];
	$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
	$resultado.="<form id=\"formulario\" name=\"formulario\">";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"74\" class=\"head\">Numero de Solicitud: </td>";
	$resultado.="<td width=\"150\"><input type=\"hidden\" id=\"iddocumento\" value=\"$id\"><input type=\"hidden\" id=\"establecimiento\" value=\"$establecimiento\"><input type=\"text\" name=\"numero\" id=\"numero\" value=\"$numero\" class=\"textbox\" disabled></td>";
	$resultado.="<td width=\"42\" class=\"head\">Fecha:</td>";
	$resultado.="<td width=\"266\"><input type=\"text\" name=\"fecha\" id=\"fecha\" value=\"$fecha\"  class=\"textbox\" disabled></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombre del Paciente: </td>";
	$resultado.="<td><input type=\"text\" name=\"nombrep\" id=\"nombrep\" value=\"$paciente\" disabled class=\"textbox\" ><input type=\"hidden\" id=\"idpaciente\" value=\"$idpaciente\"><input type=\"button\" value=\"Ver datos\" onClick=\"datospaciente('$idpaciente')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"120\" class=\"head\">Cedula del Medico: </td>";
	$resultado.="<td width=\"128\"><input name=\"cedulam\" type=\"text\" id=\"cedulam\" size=\"20\" maxlength=\"20\" value=\"$cedulau\" disabled class=\"textbox\" ></td>";
	$resultado.="<td width=\"122\" class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td width=\"162\"><input name=\"nombrem\" type=\"text\" id=\"nombrem\" value=\"$nombreu\" disabled class=\"textbox\" ></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"120\" class=\"head\">Establecimiento: </td>";
	$resultado.="<td><input name=\"establecimiento\" type=\"text\" id=\"establecimiento\" value=\"$establecimiento\" size=\"50\" disabled class=\"textbox\" ></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"550\" class=\"head\">Diagnostico Preliminar </td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td><textarea name=\"diagnostico\" cols=\"100\" rows=\"2\" id=\"diagnostico\" disabled class=\"textbox\" >$diagnostico</textarea></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td><input type=\"hidden\" id=\"examen\" value=\"$hexamen\"><input type=\"button\" value=\"Examen Fisico\" onClick=\"abrirExamen('$hexamen')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"550\" class=\"head\">Electrocardiograma </td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td>";
	/*if (rtrim($extension)==".ctk"){
		$resultado.="Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($imagen).".ctk\"><img src=\"Imagenes/CARDIOTK.ICO\"></a>";	}
	else {
		$resultado.="<img src=\"$destino\" width=\"540\"  height=\"50\">";
	}*/
	$resultado.="</td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"560\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td><input type=\"hidden\" id=\"hmedico\" onChange=\"botonesr()\"><input type=\"hidden\" id=\"recomendacion\" onChange=\"botonesr()\"><div id=\"botonresp\"><input type=\"button\" value=\"Responder\" onClick=\"respuesta()\"></div></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>