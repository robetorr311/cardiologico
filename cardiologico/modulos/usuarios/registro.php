<?php
	$id="".$_POST['id']."";
	include '../../datos/datos.php';
	$datos=Buscar_usuarios($id);
	$id=$datos[0];
	$nombre=$datos[1];
	$login=$datos[2];
	$hnivel=$datos[3];
	$nivel=$datos[4];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form id=\"formulario\">";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td width=\"50\" class=\"titulo_form\"><img src=\"../../Imagenes/fusuarios.png\" width=\"40\" height=\"40\"></td>";
	$resultado.="<td width=\"594\" class=\"titulo_form\">Ficha para Ingresar Usuarios al Sistema </td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nombres y Apellidos </td>";
	$resultado.="<td class=\"formulario\"><input type=\"hidden\" id=\"idusuario\" value=\"$id\"><input name=\"nombre\" type=\"text\" class=\"textbox\" id=\"nombre\" size=\"50\" value=\"$nombre\" disabled></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombre')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Login</td>";
	$resultado.="<td class=\"formulario\"><input name=\"login\" type=\"text\" class=\"textbox\" id=\"login\" size=\"20\" maxlength=\"8\" value=\"$login\" disabled></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Login')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Password</td>";
	$resultado.="<td class=\"formulario\"><input name=\"password\" type=\"password\" class=\"textbox\" id=\"password\"  disabled></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Nivel:</td>";
	$resultado.="<td class=\"formulario\"><select name=\"nivel\" class=\"textbox\" id=\"nivel\"  disabled>";
	$resultado.="<option selected value=\"$hnivel\">$nivel</option>";
	$resultado.=TipoUsuario();
	$resultado.="</select></td>";
	$resultado.="<td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nivel')\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<table width=\"660\" border=\"1\" cellspacing=\"0\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\"><div align=\"center\">";
	$resultado.="<td class=\"formulario\"><input type=\"button\" class=\"button\" name=\"Submit\" value=\"Editar\" onClick=\"editUsuario()\">";
	$resultado.="<input type=\"button\" class=\"button\" name=\"Submit2\" value=\"Consultar\" onclick=\"consulta()\"></td>";
	$resultado.="</div></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="<p>&nbsp;</p>";
	$resultado.="</form>";	
	echo $resultado;
?>