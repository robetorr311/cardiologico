<?php
	$id = $_GET['id'];
	include("../cardiologico/datos/datos.php");
	$datos=Buscar_respuestas($id);
	DocumentoProcesado($id);	
	$fecha=$datos[3];
	$medico=$datos[4];
	$diagnostico=$datos[6];
	$respuesta=$datos[7];
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<form name=\"formulario\" id=\"formulario\">";
	$resultado.="<table cellspacing=\"0\" width=\"600\" border=\"1\">";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" >Fecha:</td>";
	$resultado.="<td class=\"formulario\" ><input name=\"fecha\" type=\"text\" id=\"fecha\" size=\"50\" value=\"$fecha\"  class=\"textbox\" disabled></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" >Nombre y Apellido:</td>";
	$resultado.="<td class=\"formulario\" ><div id=\"idmed\"><input type=\"hidden\" id=\"idmedico\"><input name=\"nombremc\" type=\"text\" id=\"nombremc\"  class=\"textbox\" size=\"50\" value=\"$medico\" disabled></div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\" ><div align=\"center\">Diagnostico</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><textarea name=\"diagnostico\" cols=\"200\" rows=\"2\" id=\"diagnostico\"  class=\"textbox\" disabled>$diagnostico</textarea></td>";
	$resultado.="</tr>";	
	$resultado.="<td class=\"formulario\" colspan=\"2\" ><div align=\"center\">Recomendaciones</div></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><textarea name=\"recomendaciones\" cols=\"200\" rows=\"2\" id=\"recomendaciones\"  class=\"textbox\" disabled>$respuesta</textarea></td>";
	$resultado.="</tr>";
	$resultado.="<tr>";
	$resultado.="<td class=\"formulario\" colspan=\"2\"><input name=\"button\" type=\"button\" class=\"button\" id=\"button\" value=\"Aceptar\" onClick=\"window.parent.hidePopWin(true, 'respuesta', '0','0');\"><input name=\"button\" type=\"button\" class=\"button\" id=\"button\" value=\"Responder\" onClick=\"levantapopup('responder','$id');\"></td>";
	$resultado.="</tr>";
	$resultado.="</table>";
	$resultado.="</form>";
	echo $resultado;
?>