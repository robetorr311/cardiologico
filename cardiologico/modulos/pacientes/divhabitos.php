<?php
	$tabaco="".$_POST['tabaco']."";
	$alcohol="".$_POST['alcohol']."";
	$ejercicio="".$_POST['ejercicio']."";
	$alimentacion="".$_POST['alimentacion']."";
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<input type=\"hidden\" id=\"tabaco\" value=\"$tabaco\">";
	$resultado.="<input type=\"hidden\" id=\"alcohol\" value=\"$alcohol\">";
	$resultado.="<input type=\"hidden\" id=\"ejercicio\" value=\"$ejercicio\">";
	$resultado.="<input type=\"hidden\" id=\"alimentacion\" value=\"$alimentacion\">";
	echo $resultado;
?>