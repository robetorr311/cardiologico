<?php
	$cedula="".$_POST['cedula']."";
	require("../../datos/datos.php");
	$datos=Buscar_pacientes_cedula($cedula);
	$id=$datos[0];
	$cedula=$datos[1];
	$nombre=$datos[2];
	$edad=$datos[3];
	$sexo=$datos[4];
	$telefono=$datos[5];
	$direccion=$datos[6];
	$ubicacion=$datos[7];
	$email=$datos[8];
	if (empty($resultado)){
	$resultado="";
	}
	if (empty($id)){
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"113\">Cedula del Paciente : </td>";
		$resultado.="<td   width=\"97\"><input id=\"idpaciente\" name=\"idpaciente\" type=\"hidden\" value=\"$id\"><input name=\"cedulap\" type=\"text\" id=\"cedulap\" value=\"$cedula\"size=\"15\" maxlength=\"15\" onChange=\"paciente()\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulap')\"></td>";
		$resultado.="<td class=\"head\" width=\"116\">Nombre y Apellido:</td>";
		$resultado.="<td  width=\"306\"><input name=\"nombrep\" type=\"text\" id=\"nombrep\" value=\"$nombre\" size=\"50\" maxlength=\"50\" ></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrep')\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"37\">Edad:</td>";
		$resultado.="<td  width=\"35\"><input name=\"edad\"  type=\"text\" id=\"edad\" size=\"5\" maxlength=\"5\" value=\"$edad\" ></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Edad')\"></td>";
		$resultado.="<td  class=\"head\" width=\"39\">Sexo:</td>";
		$resultado.="<td  width=\"55\"><select name=\"sexo\" id=\"sexo\" >";
		$resultado.="<option selected value=\"$sexo\">$sexo</option>";
		$resultado.="<option value=\"M\">M</option>";
		$resultado.="<option value=\"F\">F</option>";
		$resultado.="</select></td><td><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sexo')\"></td>";
		$resultado.="<td class=\"head\" width=\"66\">Telefono:</td>";
		$resultado.="<td  width=\"97\"><input name=\"telefono\" type=\"text\" id=\"telefono\" size=\"15\" maxlength=\"15\" value=\"$telefono\" ></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Telefono')\"></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"64\">email:</td>";
		$resultado.="<td  width=\"215\"><input name=\"email\" type=\"text\" id=\"email\" size=\"30\" maxlength=\"30\" value=\"$email\" ></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Email')\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" colspan=\"8\">Direcci&oacute;n del Paciente </td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td  colspan=\"8\"><textarea name=\"direccion\" cols=\"80\" rows=\"2\" id=\"direccion\" >$direccion</textarea></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Direccion')\"></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td colspan=\"8\"><input type=\"hidden\" id=\"hubicacion\" value=\"$ubicacion\" ><input type=\"button\" name=\"button\" value=\"Ubicacion\" onClick=\"ubicacion()\">";
		$resultado.="<input type=\"button\" name=\"button2\" value=\"Guardar\" onClick=\"agregarPacientes()\" ></td>";
	}
	else {
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"113\">Cedula del Paciente : </td>";
		$resultado.="<td   width=\"97\"><input id=\"idpaciente\" name=\"idpaciente\" type=\"hidden\" value=\"$id\"><input name=\"cedulap\" type=\"text\" id=\"cedulap\" value=\"$cedula\"size=\"15\" maxlength=\"15\" onChange=\"paciente()\"></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cedulap')\"></td>";
		$resultado.="<td class=\"head\" width=\"116\">Nombre y Apellido:</td>";
		$resultado.="<td  width=\"306\"><input name=\"nombrep\" type=\"text\" id=\"nombrep\" value=\"$nombre\" size=\"50\"  class=\"textbox\" maxlength=\"50\" disabled></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Nombrep')\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"37\">Edad:</td>";
		$resultado.="<td  width=\"35\"><input name=\"edad\"  type=\"text\" id=\"edad\" size=\"5\" maxlength=\"5\" value=\"$edad\"  class=\"textbox\" disabled></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Edad')\"></td>";
		$resultado.="<td  class=\"head\" width=\"39\">Sexo:</td>";
		$resultado.="<td  width=\"55\"><select name=\"sexo\" id=\"sexo\" disabled>";
		$resultado.="<option selected value=\"$sexo\">$sexo</option>";
		$resultado.="<option value=\"M\">M</option>";
		$resultado.="<option value=\"F\">F</option>";
		$resultado.="</select></td><td><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sexo')\"></td>";
		$resultado.="<td class=\"head\" width=\"66\">Telefono:</td>";
		$resultado.="<td  width=\"97\"><input name=\"telefono\" type=\"text\" id=\"telefono\" size=\"15\" maxlength=\"15\" value=\"$telefono\"  class=\"textbox\" disabled></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Telefono')\"></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" width=\"64\">email:</td>";
		$resultado.="<td  width=\"215\"><input name=\"email\" type=\"text\" id=\"email\" size=\"30\" maxlength=\"30\" value=\"$email\"  class=\"textbox\" disabled></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Email')\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"700\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\" colspan=\"8\">Direcci&oacute;n del Paciente </td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td  colspan=\"8\"><textarea name=\"direccion\" cols=\"80\" rows=\"2\" id=\"direccion\" class=\"textbox\"  disabled>$direccion</textarea></td><td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Direccion')\"></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td colspan=\"8\"><input type=\"hidden\" id=\"hubicacion\" value=\"$ubicacion\"><input type=\"button\" name=\"button\" value=\"Ubicacion\" disabled>";
		$resultado.="<input type=\"button\" name=\"button2\" value=\"Editar\" onClick=\"editarPacientes()\" ></td>";
	}
	$resultado.="</tr>";
	$resultado.="</table>";
	echo $resultado;
?>