<?php
	$idmedico="".$_POST['idmedico']."";
	$cedulam="".$_POST['cedulam']."";
	$nombrem="".$_POST['nombrem']."";
	$establecimiento="".$_POST['establecimiento']."";
	include '../../datos/datos.php';
	$est=Buscar_establecimiento($establecimiento);
	$option=selectEstablecimiento();
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<table width=\"700\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"head\">Cedula del Medico : </td>";
	$resultado.="<td><input name=\"idmedico\" type=\"hidden\" value=\"$idmedico\"><input name=\"cedulam\" type=\"text\" id=\"cedulam\" size=\"15\" maxlength=\"15\" value=\"$cedulam\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulam')\"></td>";
	$resultado.="<td class=\"head\">Nombre y Apellido:</td>";
	$resultado.="<td><input name=\"nombrem\" type=\"text\" id=\"nombrem\" size=\"50\" maxlength=\"50\"  value=\"$nombrem\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrem')\"></td>";
	$resultado.="</tr></table>";
	$resultado.="<table width=\"700\" border=\"1\"><tr>";
	$resultado.="<td class=\"head\">Establecimiento:";
	$resultado.="</td><td><select name=\"establecimiento\" id=\"establecimiento\" ><option selected value=\"$establecimiento\">$est[1]</option>$option</select></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Establecimiento')\">";
	$resultado.="</td><td><input type=\"button\" name=\"med\" value=\"Guardar\" onClick=\"guardarMedico()\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>