<?php
	include '../../../datos/datos.php';
	$id="".$_POST['id']."";
	$registro="".$_POST['registro']."";
	$valor="".$_POST['valor']."";
	if ($valor==1){
		$salida=listar_examenes_adelante($registro,$id);
	}
	if ($valor==0) {
		$salida=listar_examenes_atras($registro,$id);
	}
	echo $salida;
?>