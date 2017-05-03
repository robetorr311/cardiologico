<?php
$usuario="".$_POST['usuario']."";
$husuario="".$_POST['husuario']."";
$idpaciente="".$_POST['idpaciente']."";
$diagnostico="".$_POST['diagnostico']."";
$hexamen="".$_POST['hexamen']."";
$htipo=1;
include ("../cardiologico/datos/datos.php");
$hestablecimiento=buscarhestablecimientoRegistrados($husuario);
$numero=numeroDocumento($htipo);
$estatus=0;
if (empty($observacion)){
	$observacion="NINGUNA";
}
	if (empty($resultado)){
	$resultado="";
	}
finsert_telegrama($htipo ,  $hestablecimiento ,  "0" ,  "1" ,  $hexamen ,  $idpaciente ,  $diagnostico ,  $husuario ,  $observacion );
$resultado.="<form name=\"form1\" method=\"post\" action=\"index.php\"><p></p><table width=\"600\" border=\"1\">";
$resultado.="<tr><td>La solicitud se ha insertado correctamente...</td></tr><tr><td>Para finalizar haga click en Aceptar </td></tr>";
$resultado.="</table><p><input type=\"submit\" class=\"button\" name=\"Submit\" value=\"Aceptar\"></p><p>&nbsp;</p></form>";
echo $resultado;
?>