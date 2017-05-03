<?php
	include '../../datos/datos.php';
	$registro="".$_POST['registro']."";
	$valor="".$_POST['valor']."";
	if ($valor==1){
		$salida=listar_usuarios_adelante($registro);
	}
	if ($valor==0) {
		$salida=listar_usuarios_atras($registro);
	}
	echo $salida;
?>