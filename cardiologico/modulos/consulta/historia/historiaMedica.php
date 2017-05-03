<?php
include("../../../datos/datos.php");
$idpaciente="".$_POST['id']."";
$datos=buscarHistoriaMedica($idpaciente);
$cedula=$datos[0];
$nombre=$datos[1];
$edad=$datos[2];
$sexo=$datos[3];
$telefono=$datos[4];
$correo=$datos[5];
$direccion=$datos[6];
$ubicacion=$datos[7];
$idhistoria=$datos[8];
$numero=$datos[9];
$fecha=$datos[10];
$tabaco=$datos[11];
$alcohol=$datos[12];
$ejercicio=$datos[13];
$alimentacion=$datos[14];
$personales=$datos[15];
$familiares=$datos[16];
if ($cedula==0){
	require("sinHistoria.php");
}
else {
	require("ficha.php");
}
?>

