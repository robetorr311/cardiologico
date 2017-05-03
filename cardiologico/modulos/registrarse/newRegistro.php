<?php
	if (empty($resultado)){
		$resultado="";
	}
	if (empty($cedula)){
		$cedula="";
	}
	if (empty($nombre)){
		$nombre="";
	}
	if (empty($edad)){
		$edad="";
	}
	if (empty($sexo)){
		$sexo="";
	}
	if (empty($telefono)){
		$telefono="";
	}
	if (empty($correo)){
		$correo="";
	}
	if (empty($correo)){
		$correo="";
	}
	if (empty($loggin)){
		$loggin="";
	}
	if (empty($password)){
		$password="";
	}	
	include("../../datos/datos.php");
	$resultado.="<form id=\"formulario\">";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"60\" class=\"titulo_form\"><img src=\"../../Imagenes/fmedicos.png\" width=\"30\" height=\"30\"></td>";
	$resultado.="<td width=\"584\" class=\"titulo_form\">Ficha Registro de Usuarios</td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">C&eacute;dula</td>";
	$resultado.="<td class=\"formulario\"><input name=\"cedula\" type=\"text\" class=\"textbox\" id=\"cedula\" size=\"20\" value=\"$cedula\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedula')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombre:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"nombre\" type=\"text\" class=\"textbox\" id=\"nombre\" size=\"50\" value=\"$nombre\"  ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombre')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"77\" class=\"head\">Edad:</td>";
	$resultado.="<td width=\"248\" class=\"formulario\"><input name=\"edad\" type=\"text\" class=\"textbox\" id=\"edad\" size=\"5\"  value=\"$edad\" ></td>";
	$resultado.="<td width=\"67\" class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Edad')\"></td>";
	$resultado.="<td width=\"72\" class=\"head\">Sexo:</td>";
	$resultado.="<td width=\"98\"  class=\"formulario\"><select name=\"sexo\" class=\"textbox\" id=\"sexo\" >";
	$resultado.="<option selected value=\"$sexo\"></option><option value=\"M\">M</option>";
	$resultado.="<option value=\"F\">F</option>";
	$resultado.="</select></td>";
	$resultado.="<td width=\"58\" class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sexo')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Tel&eacute;fono:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"telefono\" type=\"text\" class=\"textbox\" id=\"telefono\"  value=\"$telefono\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Telefono')\"></td>";
	$resultado.="<td class=\"head\">Correo Electr&oacute;nico </td>";
	$resultado.="<td class=\"formulario\"><input name=\"correo\" type=\"text\" class=\"textbox\" id=\"correo\"  value=\"$correo\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Correo')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Establecimiento:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"establecimiento\" class=\"textbox\" id=\"establecimiento\" >";
	$salida=selectEstablecimiento();
	$resultado.="$salida";
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Establecimiento')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td colspan=\"2\" class=\"head\"><div align=\"center\">Direcci&oacute;n</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\"><textarea name=\"direccion\" class=\"textbox\" id=\"direccion\" ></textarea></td>";
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
	$resultado.="<td class=\"head\">Nombre de Usuario:</td>";
	$resultado.="<td class=\"formulario\"><input name=\"loggin\" type=\"text\" class=\"textbox\" id=\"loggin\"  value=\"$loggin\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Loggin')\"></td>";
	$resultado.="<td class=\"head\">Contraseña; </td>";
	$resultado.="<td class=\"formulario\"><input name=\"password\" type=\"text\" class=\"textbox\" id=\"password\"  value=\"$password\" ></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";	
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\"><input type=\"button\" class=\"button\" name=\"Submit\" value=\"Guardar\" onClick=\"guardarRegistro()\">";
	$resultado.="<input type=\"button\" class=\"button\" name=\"Submit2\" value=\"Consultar\" onclick=\"consulta()\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>