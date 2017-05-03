<?php
	$id="".$_POST['id']."";
	include("../../datos/datos.php");
	DocumentoProcesado($id);
	$salida=repuestasPendientes($log);
	echo $salida;
?>