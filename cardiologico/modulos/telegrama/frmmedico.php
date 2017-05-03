<?php
	$cedula="".$_POST['cedula']."";
	require("../../datos/datos.php");
	$datos=Buscar_medicos_cedula($cedula);
	$id=$datos[0];
	$cedula=$datos[1];
	$nombre=$datos[2];
	$hestablecimiento=$datos[3];
	$establecimiento=$datos[4];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table width=\"700\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Cedula del Medico : </td>";
	$resultado.="<td><input name=\"idmedico\" type=\"hidden\" value=\"$id\"><input name=\"cedulam\" type=\"text\" value=\"$cedula\" id=\"cedulam\" size=\"15\" maxlength=\"15\" onChange=\"frmmedico()\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulam')\"></td>";
	$resultado.="<td class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td><input name=\"nombrem\" type=\"text\" value=\"$nombre\" id=\"nombrem\" size=\"50\" maxlength=\"50\" disabled class=\"textbox\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrem')\"></td>";
	$resultado.="</tr></table>";
	$resultado.="<table width=\"700\" border=\"1\"><tr>";
	$resultado.="<td class=\"head\">Establecimiento:";
	$resultado.="</td><td><select name=\"establecimiento\" id=\"establecimiento\" disabled class=\"textbox\"><option selected value=\"$hestablecimiento\">$establecimiento</option></select></td></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Establecimiento')\">";
	$resultado.="</td><td><input type=\"button\" name=\"med\" value=\"Editar\" onClick=\"editarMedico()\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>