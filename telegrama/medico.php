<?php
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table width=\"700\" cellspacing=\"0\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Cedula del Medico : </td>";
	$resultado.="<td class=\"formulario\"><input name=\"idmedico\" type=\"hidden\"><input name=\"cedulam\" type=\"text\" id=\"cedulam\" size=\"15\" maxlength=\"15\" onChange=\"frmmedico()\"></td><td  class=\"formulario\"><img src=\"../cardiologico/Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulam')\"></td>";
	$resultado.="<td class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td  class=\"formulario\"><input name=\"nombrem\" type=\"text\"  class=\"textbox\" id=\"nombrem\" size=\"50\" maxlength=\"50\" disabled></td><td  class=\"formulario\"><img src=\"../cardiologico/Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrem')\"></td>";
	$resultado.="</tr></table>";
	$resultado.="<table width=\"700\" border=\"1\" cellspacing=\"0\"><tr>";
	$resultado.="<td class=\"head\">Establecimiento:";
	$resultado.="</td><td  class=\"formulario\"><select name=\"establecimiento\"  class=\"textbox\" id=\"establecimiento\" disabled></select></td><td  class=\"formulario\"><img src=\"../cardiologico/Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Establecimiento')\">";
	$resultado.="</td><td  class=\"formulario\"><input type=\"button\" name=\"med\" value=\"Editar\" disabled></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>