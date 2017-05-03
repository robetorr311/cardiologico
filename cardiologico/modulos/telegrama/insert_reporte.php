<?php
$idmedico="".$_POST['idmedico']."";
$idpaciente="".$_POST['idpaciente']."";
$examen="".$_POST['examen']."";
$diagnostico="".$_POST['diagnostico']."";
$himagen="".$_POST['himagen']."";
$establecimiento="".$_POST['establecimiento']."";
$usuario="{$_SERVER['PHP_AUTH_USER']}";
$htipo=1;
include ("../../datos/datos.php");
$numero=numeroDocumento($htipo);
$estatus=0;
if (empty($observacion)){
	$observacion="NINGUNA";
}
	if (empty($resultado)){
	$resultado="";
	}
$salida=insertDocumento($diagnostico,$examen,$estatus,$numero,$usuario,$himagen,$htipo,$idpaciente,$idmedico,$observacion,$establecimiento);
$resultado.="<form name=\"form1\" method=\"post\" action=\"index.php\"><p></p><table width=\"600\" border=\"1\">";
$resultado.="<tr><td>La solicitud se ha insertado correctamente...</td></tr><tr><td>Para finalizar haga click en Aceptar </td></tr>";
$resultado.="</table><p><input type=\"submit\" name=\"Submit\" value=\"Aceptar\"></p><p>&nbsp;</p></form>";
echo $resultado;
?>