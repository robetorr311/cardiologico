<?php
$hdestino="".$_POST['hmedico']."";
$horigen="".$_POST['husuario']."";
$hpaciente="".$_POST['hpaciente']."";
$respuesta="".$_POST['respuesta']."";
$hdocumento="".$_POST['hdocumento']."";
$hpadre="".$_POST['hpadre']."";
include ("../cardiologico/datos/datos.php");
if (empty($resultado)){
	$resultado="";
}
if (empty($hpadre)){
	$hpadre="0";
}
insertMensajeRespuesta  ($horigen ,  $hdestino ,  $respuesta ,  $hdocumento ,  $hpaciente, $hpadre );
$resultado.="<form name=\"formulario\" id=\"formulario\"><p></p><table width=\"600\" border=\"1\">";
$resultado.="<tr><td>El mensaje se ha enviado correctamente...</td></tr><tr><td>Para finalizar haga click en Aceptar </td></tr>";
$resultado.="</table><p><input type=\"button\" name=\"Submit\" value=\"Aceptar\" onClick=\"window.parent.hidePopWin();\"></p><p>&nbsp;</p></form>";
echo $resultado;
?>