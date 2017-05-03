<?php
	session_start();
	$_SESSION = array();
	$_SESSION["activa"]	= 0;
    session_destroy();
    $_SERVER['PHP_AUTH_USER'] = '';
    $_SERVER['PHP_AUTH_PW'] = '';	
    //header("Location: index.php", TRUE, 301); 
	if (empty($salida)){
		$salida="";
	}
    $salida.="<form id=\"form1\" method=\"POST\" action=\"index.php\">";      
    $salida.="<center>";
    $salida.="<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    $salida.="<tr>";
    $salida.="<td align=\"center\" ><input name=\"loggin\" type=\"hidden\" value=\"1\">HASTA LUEGO!!";
    $salida.="</td>";
    $salida.="</tr>";
    $salida.="</table>";
    $salida.="<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    $salida.="<tr>";
    $salida.="<td align=\"left\">";
    $salida.="Su conexion ha finalizado";
    $salida.="</td>";
    $salida.="</tr>";
    $salida.="</table>";
    $salida.="<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    $salida.="<tr>";
    $salida.="<td align=\"center\">";
    $salida.="<input type=\"submit\" value=\"Finalizar\"/>";
    $salida.="</td>";
    $salida.="</tr>";
    $salida.="</table>";
    $salida.="</center>";
    $salida.="</form>";	
	echo $salida;
?>