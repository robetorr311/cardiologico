<?php
	if (empty($diagnostico)){
	$diagnostico="Sin Diagnostico";
	}
	if (empty($examen)){
	$examen="null";
	}	
	if (empty($himagen)){
	$himagen="null";
	}
	if (empty($resultado)){
	$resultado="";
	}	
	$iddocumento="".$_POST['iddocumento']."";
	$idestablecimiento="".$_POST['idestablecimiento']."";
	$recomendacion="".$_POST['recomendacion']."";
	$hmedico="".$_POST['hmedico']."";
	$htipo=4;
	$estatus=0;
	$usuario="{$_SERVER['PHP_AUTH_USER']}";
	include("datos/datos.php");
	$numero=numeroDocumento($htipo);
	insertDocumento($diagnostico,$examen,$estatus,$numero,$usuario,$himagen,$htipo,$iddocumento,$hmedico,$recomendacion,$idestablecimiento);
	DocumentoProcesado($iddocumento);
	$resultado.="<form id=\"formulario\">";
	$resultado.=documentosPendientes();
	$resultado.="<p>&nbsp;</p></form>";
	echo $resultado;
?>