<?php
$cedula="".$_POST['cedula']."";
$nombre="".$_POST['nombre']."";
$edad="".$_POST['edad']."";
$sexo="".$_POST['sexo']."";
$correo="".$_POST['correo']."";
$telefono="".$_POST['telefono']."";
$direccion="".$_POST['direccion']."";
$sector="".$_POST['sector']."";
$servicio="".$_POST['servicio']."";
$atraves="".$_POST['atrav']."";
$observaciones="".$_POST['observaciones']."";
$usuario= "{$_SERVER['PHP_AUTH_USER']}";
$htipo=1;
$estatus=0;
if (empty($observaciones)){
$observaciones="Ninguna";
}
include("../cardiologico/datos/datos.solicitud.php");
$pacientes=Buscar_pacientes_cedula($cedula)
if ((empty($pacientes[0])) or ($pacientes[0]=="")){
	$idpaciente=insertPacientes($cedula,$nombre,$edad,$sexo,$telefono,$correo,$direccion,$sector);
	$numero=NumeroDocumento($cedula);
	$sql=insertSolicitud($numero,$htipo,$horigen,$hdestino,$observacion,$estatus,$usuario);
}
else {
	$numero=NumeroDocumento($cedula);
	$sql=insertSolicitud($numero,$htipo,$pacientes[0],$servicio,$observaciones,$estatus,$usuario)
}
echo $sql;

?>