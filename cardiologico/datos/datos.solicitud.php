<?php
function buscarNombrelargo($id){
	include ("conectar.php");
	$lista= "select * from org_geografica where num_region=$id;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$nombreLargo= "" .pg_result($rlista, $d, 37)."";
	}
	pg_free_result($rlista);
	$resultado=explode(", ", $nombreLargo);
	include ("desconectar.php");
	return $resultado;
}
function Estados(){
	include ("conectar.php");
	if (empty($resultado)){
	$resultado="";
	}
	$lista= "select * from org_geografica where region_precedente=1 order by des_region;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=1; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 3)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function Municipios($id){
	include ("conectar.php");
	if (empty($resultado)){
	$resultado="";
	}
	$lista= "select * from org_geografica where region_precedente=$id order by des_region;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 3)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function Parroquias($id){
	include ("conectar.php");
	if (empty($resultado)){
	$resultado="";
	}
	$lista= "select * from org_geografica where region_precedente=$id order by des_region;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 3)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function Servicios(){
	include ("csolicitud.php");
	if (empty($resultado)){
	$resultado="";
	}
	$lista= "select * from unidad;"; 
	$rlista=pg_exec($csolicitud,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 1)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("csolicitud.php");
	return $resultado;
}
function Sectores($id){
	if (empty($resultado)){
	$resultado="";
	}
	include ("conectar.php");
	$lista= "select * from org_geografica where region_precedente=$id order by des_region;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 3)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function insertPacientes($cedula,$nombre,$edad,$sexo,$telefono,$correo,$direccion,$hlocalidad){
	include ("csolicitud.php");
	$sql="insert into pacientes (cedula,nombre,edad,sexo,telefono,correo,direccion,hlocalidad) values ('$cedula','$nombre','$edad','$sexo','$telefono','$correo','$direccion',$hlocalidad);";
	$consulta=pg_exec($csolicitud,$sql);
   	$lista="select * from id_p;";
	$rlista=pg_exec($csolicitud,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}
	pg_free_result($consulta);
	include ("dsolicitud.php");
	return $lastvalue;
}
function Buscar_pacientes_cedula($cedula){
	include ("csolicitud.php");
   	$lista="SELECT * from pacientes WHERE cedula='$cedula';";
	$rlista=pg_exec($csolicitud,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$edad="" .pg_result($rlista, $d, 3)."";	
		$sexo= "" .pg_result($rlista, $d, 4)."";
		$telefono="" .pg_result($rlista, $d, 5)."";
		$direccion="" .pg_result($rlista, $d, 6)."";	
		$ubicacion= "" .pg_result($rlista, $d, 7)."";
		$correo="" .pg_result($rlista, $d, 8)."";
	}	
	pg_free_result($rlista);
	include ("dsolicitud.php");
	if (empty($id)){
	$id="";
	}
	if (empty($cedula)){
	$cedula="";
	}
	if (empty($nombre)){
	$nombre="";
	}
	if (empty($edad)){
	$edad="";
	}
	if (empty($sexo)){
	$sexo="";
	}
	if (empty($telefono)){
	$telefono="";
	}
	if (empty($direccion)){
	$direccion="";
	}
	if (empty($ubicacion)){
	$ubicacion="";
	}
	if (empty($correo)){
	$correo="";
	}
	$datos= array($id,$cedula,$nombre,$edad,$sexo,$telefono,$direccion,$ubicacion,$correo);
	return $datos;
}
function NumeroDocumento($cedula){
	$fecha=time();
	$mm= strftime("%m", $fecha);
	$yy= strftime("%y", $fecha);	
	$datos=Buscar_pacientes_cedula($cedula);
	include ("csolicitud.php");
	$idpaciente=$datos[0];
	$lista= "select * from id_em;"; 
	$rlista=pg_exec($csolicitud,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$last_value= "" .pg_result($rlista, $d, 1)."";
	}
	include ("dsolicitud.php");
	pg_free_result($rlista);
	$next_value=$last_value+1;
	$conteo=strlen($idpaciente);
	if ($conteo<6){
		$ndc=str_pad($idpaciente,6,"0",STR_PAD_LEFT);
	}
	if ($conteo>=6){
		$ndc=$idpaciente;
	}
	$idf=strlen($next_value);
	if ($idf<10){
		$ndi=str_pad($next_value,10,"0",STR_PAD_LEFT);
	}
	if ($idf>=10){
		$ndi=$next_value;
	}
	$numero=$yy.$mm.$ndc.$ndi;
	return $numero;
}
function cupos($hdocumento,$unidad,$hpaciente){
    $f = time();
	$cita=0;
	require ('csolicitud.php');
	$yy= strftime("%y", $f);
	$yyyy= strftime("%Y", $f);	
	$mm= strftime("%m", $f);
	$dd= strftime("%d", $f);	
	$fecha="$yyyy/$mm/$dd";
	while ($cita==0){
		$bcita="select * from cupo where fecha='$fecha';";
		$rbcita=pg_exec($csolicitud,$bcita);
		$fbcita=pg_numrows($rbcita);
		pg_free_result($rbcita);
		if ($fbcita < 500){
			$gcita="insert into cupo (hdocumento,hunidad,hpaciente,fecha) values ($hdocumento,$unidad,$hpaciente,'$fecha');";
			$rgcita=pg_exec($csolicitud,$gcita);
			$lista= "select * from id_cupo;"; 
			$rlista=pg_exec($csolicitud,$lista);
			$reg = pg_numrows($rlista);
			for ($d=0; $d < $reg; $d++){
				$last_value= "" .pg_result($rlista, $d, 1)."";
			}
			require ('dsolicitud.php');
			$cita++;
		}
		else {
			if (empty($ff)){
				$ff= $f + 86446;								
				$yy= strftime("%y", $ff);
				$yyyy= strftime("%Y", $ff);	
				$mm= strftime("%m", $ff);
				$dd= strftime("%d", $ff);
				$w=	strftime("%w", $ff);
				$fecha="$yyyy/$mm/$dd";
				if ($w==0){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if ($w==6){
					$fff=$ff+172892;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/01/01") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/04/19") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/05/01") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/07/05") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/07/24") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/10/12") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/12/25") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/12/31") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
			}
			else {
				$ff= $ff + 86446;								
				$yy= strftime("%y", $ff);
				$yyyy= strftime("%Y", $ff);	
				$mm= strftime("%m", $ff);
				$dd= strftime("%d", $ff);
				$w=	strftime("%w", $ff);
				$fecha="$yyyy/$mm/$dd";
				if ($w==0){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if ($w==6){
					$fff=$ff+172892;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/01/01") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/04/19") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/05/01") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/07/05") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/07/24") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/10/12") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/12/25") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
				if (($fecha=="$yyyy/12/31") and ($w>0) and ($w<6)){
					$fff=$ff+86446;
					$yy= strftime("%y", $fff);
					$yyyy= strftime("%Y", $fff);	
					$mm= strftime("%m", $fff);
					$dd= strftime("%d", $fff);
					$fecha="$yyyy/$mm/$dd";
				}
			}

		}
	}
	$datos=array($last_value,$fecha);
	return $datos; 
}
function insertSolicitud($cedula,$numero,$htipo,$horigen,$hdestino,$observacion,$estatus,$usuario){
	$fecha=time();
	$mm= strftime("%m", $fecha);
	$yy= strftime("%y", $fecha);	
	$datos=Buscar_pacientes_cedula($cedula);
	include ("csolicitud.php");
	$idpaciente=$datos[0];
	$lista= "select * from id_em;"; 
	$rlista=pg_exec($csolicitud,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$last_value= "" .pg_result($rlista, $d, 1)."";
	}
	pg_free_result($rlista);
	include ("dsolicitud.php");
	$next_value=$last_value+1;
	$conteo=strlen($idpaciente);
	if ($conteo<6){
		$ndc=str_pad($idpaciente,6,"0",STR_PAD_LEFT);
	}
	if ($conteo>=6){
		$ndc=$idpaciente;
	}
	$idf=strlen($next_value);
	if ($idf<10){
		$ndi=str_pad($next_value,10,"0",STR_PAD_LEFT);
	}
	if ($idf>=10){
		$ndi=$next_value;
	}
	$numero=$yy.$mm.$ndc.$ndi;
	$cupo=cupos($next_value,$hdestino,$idpaciente);
	include ("csolicitud.php");
	$fechacupo=$cupo[1];
	$numerocupo=$cupo[0];
	$insert="insert into documento (numero,htipo,horigen,hdestino,observacion,estatus,usuario,fecha,fechacupo,numerocupo) values ('$numero',1,$idpaciente,$hdestino,'$observacion',0,'$usuario',now(),'$fechacupo',$numerocupo);";
	$rinsert=pg_exec($csolicitud,$insert);
	include ("dsolicitud.php");
	return $insert;
}
/* 
    $query = "public.adicionar_uno();";
    $datos = $conn1->Execute("$query");
*/
?>

