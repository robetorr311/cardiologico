<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	$datos=Buscar_pacientes($id);
	$id=$datos[0];
	$cedula=$datos[1];
	$nombre=$datos[2];
	$edad=$datos[3];
	$sexo=$datos[4];
	$telefono=$datos[5];
	$direccion=$datos[6];
	$hlocalidad=$datos[7];
	$correo=$datos[8];
	$datoshistoria=buscarHistoria($id);
	$hhistoria=$datoshistoria[0];
	$hantecedentes=$datoshistoria[2];
	$hhabitos=$datoshistoria[3];
	$datosHabitos=buscarHabitos($hhabitos);
	$tabaco=$datosHabitos[1];
	$alcohol=$datosHabitos[2];
	$ejercicio=$datosHabitos[3];
	$alimentacion=$datosHabitos[4];
	$datosAntecedentes=buscarAntecedentes($hantecedentes);
	$personales=$datosAntecedentes[1];
	$familiares=$datosAntecedentes[2];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<div id=\"transparencia\">";
	$resultado.="<div id=\"transparenciaMensaje\">aaaaaaaaaaaa</div>";
	$resultado.="</div>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"titulo_form\" width=\"45\"><img src=\"../../Imagenes/fpacientes.png\" width=\"33\" height=\"33\"></td>";
	$resultado.="<td class=\"titulo_form\" width=\"599\">REGISTRO DE PACIENTES </td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Cedula del Paciente: </td>";
	$resultado.="<td class=\"formulario\"><input type=\"hidden\" id=\"idpaciente\" value=\"$id\"><input name=\"cedula\" type=\"text\" class=\"textbox\" id=\"cedula\"  value=\"$cedula\"></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedula')\"></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombre del Paciente:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"nombre\" type=\"text\" class=\"textbox\" id=\"nombre\" size=\"50\"  value=\"$nombre\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombre')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Edad:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"edad\" type=\"text\" class=\"textbox\" id=\"edad\"  value=\"$edad\"></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Edad')\"></td>";
	$resultado.="<td class=\"head\">Sexo:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"sexo\" class=\"textbox\" id=\"sexo\" >";
	$resultado.="<option selected value=\"$sexo\">$sexo</option>";
	$resultado.="<option value=\"M\">M</option><option value=\"F\">F</option></select>";
	$resultado.="</td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sexo')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Correo Electr&oacute;nico:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"correo\" type=\"text\" class=\"textbox\" id=\"correo\"  value=\"$correo\"></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Email')\"></td>";
	$resultado.="<td class=\"head\">Telefono:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"telefono\" type=\"text\" class=\"textbox\" id=\"telefono\"  value=\"$telefono\"></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Telefono')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\" class=\"head\">Direcci&oacute;n</td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\"><textarea name=\"direccion\" cols=\"100\" rows=\"3\" class=\"textbox\" id=\"direccion\" >$direccion</textarea></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Direccion')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Estado:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"estado\" class=\"textbox\" id=\"estado\" onchange=\"verMunicipios()\" >";
	$resultado.="<option value=\"xx\">Seleccione un Estado</option>";
	$estados=Estados();
	$resultado.="$estados";
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Estado')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<div id=\"muni\">";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Municipio:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"municipio\"  class=\"textbox\" id=\"municipio\">";
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Municipio')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</div>";
	$resultado.="<div id=\"parr\">";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Parroquia:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"parroquia\"  class=\"textbox\" id=\"parroquia\">";
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Parroquia')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</div>";
	$resultado.="<div id=\"sect\">";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Sector:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"sector\"  class=\"textbox\" id=\"sector\">";
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sector')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</div>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\"><input type=\"button\" class=\"button\" name=\"Submit\" value=\"Guardar\" onClick=\"updatePaciente()\">";
	$resultado.="<input type=\"button\" class=\"button\" name=\"Submit2\" value=\"Consultar\" onclick=\"consulta()\">";
	if(empty($hantecedentes)){
	$resultado.="<input type=\"button\" class=\"button\" name=\"Submit3\" value=\"Antecedentes\" onclick=\"ModalAntecedentes()\">";
	}
	if(empty($hhabitos)){
	$resultado.="<input type=\"button\" class=\"button\" name=\"Submit4\" value=\"Habitos\" onclick=\"ModalHabitos()\">";
	}	
	$resultado.="</td>";	
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<div id=\"divant\">";
	$resultado.="<input type=\"hidden\" id=\"personales\" value=\"$personales\">";
	$resultado.="<input type=\"hidden\" id=\"familiares\" value=\"$familiares\">";
	$resultado.="</div>";
	$resultado.="<div id=\"divhab\">";
	$resultado.="<input type=\"hidden\" id=\"tabaco\" value=\"$tabaco\">";
	$resultado.="<input type=\"hidden\" id=\"alcohol\" value=\"$alcohol\">";
	$resultado.="<input type=\"hidden\" id=\"ejercicio\" value=\"$ejercicio\">";
	$resultado.="<input type=\"hidden\" id=\"alimentacion\" value=\"$alimentacion\">";
	$resultado.="</div>";
	$resultado.="</form>";	
	echo $resultado;
?>