<?php
	$idmedico="".$_POST['idmedico']."";
	$cedulam="".$_POST['cedulam']."";
	$nombrem="".$_POST['nombrem']."";
	$establecimiento="".$_POST['establecimiento']."";
	require("../../datos/datos.php");
	ActualizarMedicos($idmedico,$cedulam,$nombrem,$establecimiento);
	$datos=Buscar_medicos_cedula($cedulam);
	$establec=$datos[4];	
	if (empty($resultado)){
		$resultado="";
	}
	$resultado.="<table width=\"700\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"label\">Cedula del Medico : </td>";
	$resultado.="<td class=\"campo\"><input name=\"idmedico\" type=\"hidden\" value=\"$idmedico\"><input name=\"cedulam\" type=\"text\" value=\"$cedulam\" id=\"cedulam\" size=\"15\" maxlength=\"15\" onChange=\"frmmedico()\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulam')\"></td>";
	$resultado.="<td class=\"label\">Nombre y Apellido:</td>";
	$resultado.="<td class=\"campo\"><input name=\"nombrem\" type=\"text\" class=\"textbox\"  value=\"$nombrem\" id=\"nombrem\" size=\"50\" maxlength=\"50\" disabled class=\"textbox\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrem')\"></td>";
	$resultado.="</tr></table>";
	$resultado.="<table width=\"700\" border=\"1\"><tr>";
	$resultado.="<td class=\"label\">Establecimiento:";
	$resultado.="</td><td><select name=\"establecimiento\" id=\"establecimiento\"  class=\"textbox\" disabled class=\"textbox\"><option selected value=\"$establecimiento\">$establec</option></select></td></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Establecimiento')\">";
	$resultado.="</td><td><input type=\"button\" name=\"med\" value=\"Editar\" onClick=\"editarMedico()\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>