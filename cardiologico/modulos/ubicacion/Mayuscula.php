<?php
$nombre="".$_POST['nombre']."";
$str = strtoupper($nombre);
include("../../datos/datos.php");
	if (empty($resultado)){
	$resultado="";
	}
	$resultado.="<input name=\"nombre\" type=\"text\" id=\"nombre\" size=\"70\" value=\"$str\">";
echo $resultado;
?>