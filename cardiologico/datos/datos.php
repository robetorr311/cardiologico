<?php
function updateHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion){
	include ("conectar.php");
	$sql1 = "update habitos set tabaco='$tabaco' where hhistoria=$hhistoria;";
	$sql2 = "update habitos set alcohol='$alcohol' where hhistoria=$hhistoria;";
	$sql3 = "update habitos set ejercicio='$ejercicio' where hhistoria=$hhistoria;";
	$sql4 = "update habitos set alimentacion='$alimentacion' where hhistoria=$hhistoria;";
	$resultado1=pg_exec($conexion, $sql1);
	$resultado2=pg_exec($conexion, $sql2);
	$resultado3=pg_exec($conexion, $sql3);
	$resultado4=pg_exec($conexion, $sql4);
	include ("desconectar.php");
}
function updateAntecedentes($hhistoria,$personales,$familiares){
	include ("conectar.php");
	$sql1 = "update antecedentes set personales='$personales' where hhistoria=$hhistoria;";
	$sql2 = "update antecedentes set familiares='$familiares' where hhistoria=$hhistoria;";
	$resultado1=pg_exec($conexion, $sql1);
	$resultado2=pg_exec($conexion, $sql2);
	include ("desconectar.php");
}
function updateHistoria($hhistoria,$hhabitos,$hantecedentes){
	include ("conectar.php");
	$sql1 = "update historia set hhabitos=$hhabitos where id=$hhistoria;";
	$sql2 = "update historia set hantecedentes=$hantecedentes where id=$hhistoria;";
	$resultado1=pg_exec($conexion, $sql1);
	$resultado2=pg_exec($conexion, $sql2);
	include ("desconectar.php");
}
function insertHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion){
	include ("conectar.php");
	$sql = "INSERT INTO habitos (hhistoria,tabaco,alcohol,ejercicio,alimentacion) VALUES ($hhistoria,'$tabaco','$alcohol','$ejercicio','$alimentacion')";
	$resultado=pg_exec($conexion, $sql);
   	$lista="select * from id_hab;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}	
	pg_free_result($rlista);
	include ("desconectar.php");
	return $lastvalue;
}
function insertAntecedentes($hhistoria,$personales,$familiares){
	include ("conectar.php");
	$sql = "INSERT INTO antecedentes (hhistoria,personales,familiares) VALUES ($hhistoria,'$personales','$familiares')";
	$resultado=pg_exec($conexion, $sql);
   	$lista="select * from id_ant;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}	
	pg_free_result($rlista);
	include ("desconectar.php");
	return $lastvalue;
}
function insertExamen($hhistoria,$tensarte,$freqcard,$freqresp,$peso,$talla,$aspecto,$rxtorax,$ecg,$hrxtorax,$hecg){
	include ("conectar.php");
	if (empty($hrxtorax)){
	$hrxtorax="null";
	}
	$sql = "INSERT INTO examen (hhistoria,tensarte,freqcard,freqresp,peso,talla,aspecto,hrxtorax,hecg,fecha) VALUES ($hhistoria,'$tensarte','$freqcard','$freqresp','$peso','$talla','$aspecto',$hrxtorax,$hecg,now())";
	$resultado=pg_exec($conexion, $sql);
   	$lista="select * from id_exame;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}	
	pg_free_result($rlista);
	include ("desconectar.php");
	return $lastvalue;
}
function insertHistoria($hpaciente, $hantecedentes, $hhabitos){
	if (empty($hantecedentes)){
		$hantecedentes="null";
	}
	if (empty($hhabitos)){
		$hhabitos="null";
	}
	include ("conectar.php");
   	$lista="select * from id_hist;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}
	$nextvalue=$lastvalue++;
	$fecha=time();
	$numero="$fecha-$hpaciente-$nextvalue";
	$sql = "INSERT INTO historia (hpaciente, hantecedentes, hhabitos,numero,fecha) VALUES ($hpaciente, $hantecedentes, $hhabitos, '$numero', now())";
	$resultado=pg_exec($conexion, $sql);
   	$lista2="select * from id_hist;";
	$rlista2=pg_exec($conexion,$lista2);
	$reg2 = pg_numrows($rlista2);
	for ($d2=0; $d2 < $reg2; $d2++){
		$idhistoria= "" .pg_result($rlista2, $d2, 1)."";
	}
	pg_free_result($rlista);
	pg_free_result($rlista2);
	include ("desconectar.php");
	return $idhistoria;
}
function insertECG($id,$hpaciente,$desc,$type,$size,$extension){
	include ("conectar.php");
	$sql = "INSERT INTO ecg(id,hpaciente, fecha, descripcion,tipo,size, nombre,extension) VALUES ($id,$hpaciente, now(),'$desc', '$type', '$size', '$id','$extension')";
	$resultado=pg_exec($conexion, $sql);
	include ("desconectar.php");
	return $sql;
}
function Raza(){
	include ("conectar.php");
	$lista= "select * from raza;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 1)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function TipoUsuario(){
	include ("conectar.php");
	if (empty($resultado)){
	$resultado="";
	}
	$lista= "select * from tipousuario;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 1)."";
		$resultado.="<option value=\"$id\">$nombre</option>";
	}
	pg_free_result($rlista);
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
function insertMensaje($autor,$titulo,$mensaje,$hpadre,$hnivel,$usuario){
	include ("conectar.php");
   	$lista="insert into foro (autor,titulo,mensaje,hpadre,hnivel,usuario,fecha) values ('$autor','$titulo','$mensaje',$hpadre,$hnivel,'$usuario',now());";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
	return $lista;
}
function insertTemaForo($titulo,$nombre,$usuario){
	include ("conectar.php");
   	$lista="insert into foro (titulo,autor,hnivel,usuario,fecha,mensaje) values ('$titulo','$nombre',1,'$usuario',now(),'TEMA PRINCIPAL');";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
	return $lista;
}
function cMensajes($id){
	include ("conectar.php");
	$lista= "select * from foro where hnivel=3 and hpadre=id;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	include ("desconectar.php");
	return $reg;
}
function cTemas($id){
	include ("conectar.php");
	$lista= "select * from foro where hnivel=2 and hpadre=id;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($reg,$id);
	return $datos;
}
function mArgumentos($id){
	include ("conectar.php");
	$lista= "select * from foro where hnivel=2 and hpadre=$id order by id;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$idm= "" .pg_result($rlista, $d, 0)."";
		$titulo= "" .pg_result($rlista, $d, 2)."";
		$nmensajes=cMensajes($temas[1]);
		$resultado.="<tr><td><a href=\"mensajes.php?id=$idm\">$titulo</a></td><td>nmensajes</td><td>usuarios</td></tr>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function mTemas(){
	include ("conectar.php");
	$lista= "select * from foro where hnivel=1 order by id;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$titulo= "" .pg_result($rlista, $d, 2)."";
		$temas=cTemas($id);
		$nmensajes=cMensajes($temas[1]);
		$resultado.="<tr><td><a href=\"temas.php?id=$id\">$titulo</a></td><td>$temas[0]</td><td>$nmensajes</td><td>usuario</td></tr>";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $resultado;
}
function TablaChat(){
	include ("conectar.php");
	if (empty($r)){
	$r =0;
	}
	$resultado="<table class=\"GridTable\"  id=\"chat\" width=\"650\" border=\"1\">";
   	$lista= "select usuario, mensaje from chat order by id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg<22){
		for ($d=$r; $d < $reg; $d++){
			$usuario= "" .pg_result($rlista, $d, 0)."";
			$mensaje= "" .pg_result($rlista, $d, 1)."";
			$resultado.="<tr><td width=\"58\" class=\"GridHeader\">$usuario</td><td width=\"576\">$mensaje</td></tr>";
		}
	}
	else {
		$r=$reg-21;
		for ($d=$r; $d < $reg; $d++){
			$usuario= "" .pg_result($rlista, $d, 0)."";
			$mensaje= "" .pg_result($rlista, $d, 1)."";
			$resultado.="<tr><td width=\"58\" class=\"GridHeader\">$usuario</td><td width=\"576\">$mensaje</td></tr>";
		}
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	$resultado.="</table>";
	return $resultado;
}
function insertChat($mensaje,$usuario){
	include ("conectar.php");
   	$lista="insert into chat (mensaje,usuario) values ('$mensaje','$usuario');";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function insertarUsuarios($nomb,$log,$pass,$nivel){
	include ("conectar.php");
	$nombre=rtrim($nomb);
	$loggin=rtrim($log);
	$password=rtrim($pass);
   	$lista="insert into usuarios (nombre,login,password,estatus,hnivel) values ('$nombre','$loggin',md5('$password'),1,$nivel);";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
	return $lista;
}
function insertarUsuariosr($nomb,$log,$pass,$nivel){
	include ("conectar.php");
	$nombre=rtrim($nomb);
	$loggin=rtrim($log);
	$password=rtrim($pass);
   	$lista="insert into usuarios (nombre,login,password,estatus,hnivel) values ('$nombre','$loggin','$password',1,$nivel);";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
	return $lista;
}
function insertarUbicacion($nomb,$est,$mun,$parr){
	include ("conectar.php");
	$numregion=time();
	$nombre=rtrim($nomb);
	$estado=rtrim($est);
	$municipio=rtrim($mun);
	$parroquia=rtrim($parr);
   	$sql="select * from org_geografica where num_region=$parroquia;";
	$rsql=pg_exec($conexion,$sql);
	$reg = pg_numrows($rsql);
	for ($d=0; $d < $reg; $d++){
		$codest= "" .pg_result($rsql, $d, 32)."";
		$nombrel= "" .pg_result($rsql, $d, 37)."";
	}
	$nombrelargo= rtrim($nombrel)." ".$nombre;
   	$lista="insert into org_geografica (des_region,num_region,region_precedente,cod_categoria,cod_estado,nombrelargo) values ('$nombre',$numregion,$parroquia,50,$codest,'$nombrelargo');";
	$rlista=pg_exec($conexion,$lista);
	pg_free_result($rsql);
	include ("desconectar.php");
	return $lista;
}
function DocumentoProcesado($id){
	include ("conectar.php");
   	$lista="update documento set estatus=4 where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function buscarAntecedentes($id){
	include ("conectar.php");
   	$lista="SELECT * FROM antecedentes where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$personales="" .pg_result($rlista, $d, 1)."";
		$familiares="" .pg_result($rlista, $d, 2)."";	
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	if (empty($id)){
	$id=0;
	}
	if (empty($personales)){
	$personales="";
	}
	if (empty($familiares)){
	$familiares="";
	}
	$datos=array ($id,$personales,$familiares);
	return $datos;
}
function buscarHabitos($id){
	include ("conectar.php");
   	$lista="SELECT * FROM habitos where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$tabaco="" .pg_result($rlista, $d, 1)."";
		$alcohol="" .pg_result($rlista, $d, 2)."";	
		$ejercicio= "" .pg_result($rlista, $d, 3)."";
		$alimentacion= "" .pg_result($rlista, $d, 4)."";
	}		
	include ("desconectar.php");
	pg_free_result($rlista);
	if (empty($id)){
	$id=0;
	}
	if (empty($tabaco)){
	$tabaco="";
	}
	if (empty($alcohol)){
	$alcohol="";
	}
	if (empty($ejercicio)){
	$ejercicio="";
	}
	if (empty($alimentacion)){
	$alimentacion="";
	}
	$datos=array ($id,$tabaco,$alcohol,$ejercicio,$alimentacion);
	return $datos;
}
function buscarHistoria($id){
	include ("conectar.php");
   	$lista="SELECT * FROM historia where hpaciente=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$idhistoria= "" .pg_result($rlista, $d, 0)."";
		$hpaciente="" .pg_result($rlista, $d, 1)."";
		$hantecedentes="" .pg_result($rlista, $d, 2)."";	
		$hhabitos= "" .pg_result($rlista, $d, 3)."";
		$numero= "" .pg_result($rlista, $d, 4)."";
		$fecha= "" .pg_result($rlista, $d, 5)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	if (empty($idhistoria)){
		$idhistoria=0;
	}
	if (empty($hpaciente)){
		$hpaciente="";
	}
	if (empty($hantecedentes)){
		$hantecedentes=0;
	}
	if (empty($hhabitos)){
		$hhabitos=0;
	}
	if (empty($numero)){
		$numero="";
	}
	if (empty($fecha)){
		$fecha="";
	}
	$datos=array ($idhistoria,$hpaciente,$hantecedentes,$hhabitos,$numero,$fecha);
	return $datos;
}
function buscarECG($id){
	include ("conectar.php");
   	$lista="SELECT * FROM ecg where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$hpaciente= "" .pg_result($rlista, $d, 1)."";
		$tipo="" .pg_result($rlista, $d, 3)."";
		$descripcion="" .pg_result($rlista, $d, 2)."";	
		$size= "" .pg_result($rlista, $d, 4)."";
		$fecha= "" .pg_result($rlista, $d, 5)."";
		$nombre= "" .pg_result($rlista, $d, 6)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($hpaciente,$tipo,$descripcion,$size,$fecha,$nombre);
	return $datos;
}
function buscarExamen($id){
	include ("conectar.php");
   	$lista="SELECT * FROM examen where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$hhistoria= "" .pg_result($rlista, $d, 1)."";
		$tensarte="" .pg_result($rlista, $d, 2)."";
		$freqcard="" .pg_result($rlista, $d, 3)."";	
		$freqresp= "" .pg_result($rlista, $d, 4)."";
		$peso= "" .pg_result($rlista, $d, 5)."";
		$talla= "" .pg_result($rlista, $d, 6)."";
		$aspecto="" .pg_result($rlista, $d, 7)."";
		$hrxtorax="" .pg_result($rlista, $d, 9)."";
		$hecg="" .pg_result($rlista, $d, 10)."";
		$fecha="" .pg_result($rlista, $d, 11)."";		
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($hhistoria ,  $tensarte ,  $freqcard ,  $freqresp ,  $peso ,  $talla ,  $aspecto ,  $hrxtorax ,  $hecg ,  $fecha);
	return $datos;
}
function buscarDocumento($id){
	include ("conectar.php");
   	$lista="select documento.numero as numero, documento.fecha as fecha, pacientes.nombre as paciente,documento.horigen as ipaciente, establecimiento.nombre as establecimiento, medicos.cedula as cedulam,medicos.nombre as nombrem, documento.diagnostico, documento.hexamen, ecg.tipo as tipo, ecg.nombre as nombreimg,documento.hdestino,ecg.extension from documento,pacientes,medicos,establecimiento,ecg where documento.horigen=pacientes.id and documento.hdestino=establecimiento.id and documento.hmedico=medicos.id and documento.himagen=ecg.id and documento.id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$numero= "" .pg_result($rlista, $d, 0)."";
		$fecha= "" .pg_result($rlista, $d, 1)."";
		$paciente="" .pg_result($rlista, $d, 2)."";
		$idpaciente="" .pg_result($rlista, $d, 3)."";	
		$establecimiento= "" .pg_result($rlista, $d, 4)."";
		$cedulam= "" .pg_result($rlista, $d, 5)."";
		$nombrem= "" .pg_result($rlista, $d, 6)."";
		$diagnostico="" .pg_result($rlista, $d, 7)."";
		$examen="" .pg_result($rlista, $d, 8)."";	
		$tipoimagen= "" .pg_result($rlista, $d, 9)."";
		$imagen="" .pg_result($rlista, $d, 10)."";
		$idestablecimiento="" .pg_result($rlista, $d, 11)."";
		$extension="" .pg_result($rlista, $d, 12)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($numero,$fecha,$paciente,$idpaciente,$establecimiento,$cedulam,$nombrem,$diagnostico,$examen,$tipoimagen,$imagen,$idestablecimiento,$extension);
	return $datos;
}
function buscarUsuario($login){
	include ("conectar.php");
	$lista= "select * from usuarios where login='$login';"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$usuario= "" .pg_result($rlista, $d, 1)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $usuario;
}
function buscarHistoriaMedica($idpaciente){
	include ("conectar.php");
	$lista= "select * from histmedica where idpaciente=$idpaciente;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$edad="" .pg_result($rlista, $d, 3)."";	
		$sexo= "" .pg_result($rlista, $d, 4)."";
		$telefono="" .pg_result($rlista, $d, 5)."";
		$correo= "" .pg_result($rlista, $d, 6)."";
		$direccion="" .pg_result($rlista, $d, 7)."";	
		$ubicacion= "" .pg_result($rlista, $d, 8)."";
		$idhistoria= "" .pg_result($rlista, $d, 9)."";
		$numero= "" .pg_result($rlista, $d, 10)."";
		$fecha= "" .pg_result($rlista, $d, 11)."";
		$tabaco="" .pg_result($rlista, $d, 12)."";
		$alcohol="" .pg_result($rlista, $d, 13)."";	
		$ejercicio= "" .pg_result($rlista, $d, 14)."";
		$alimentacion= "" .pg_result($rlista, $d, 15)."";
		$personales="" .pg_result($rlista, $d, 16)."";
		$familiares="" .pg_result($rlista, $d, 17)."";	
	}
	if (empty($cedula)){
	$cedula=0;
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
	if (empty($correo)){
	$correo="";
	}
	if (empty($ubicacion)){
	$ubicacion="";
	}
	if (empty($direccion)){
	$direccion="";
	}
	if (empty($idhistoria)){
	$idhistoria="";
	}
	if (empty($numero)){
	$numero="";
	}
	if (empty($fecha)){
	$fecha="";
	}
	if (empty($tabaco)){
	$tabaco="";
	}
	if (empty($alcohol)){
	$alcohol="";
	}
	if (empty($ejercicio)){
	$ejercicio="";
	}
	if (empty($alimentacion)){
	$alimentacion="";
	}
	if (empty($personales)){
	$personales="";
	}
	if (empty($familiares)){
	$familiares="";
	}
	$datos= array($cedula,$nombre,$edad,$sexo,$telefono,$correo,$direccion,$ubicacion,$idhistoria,$numero,$fecha,$tabaco,$alcohol,$ejercicio,$alimentacion,$personales,$familiares);
	pg_free_result($rlista);
	include ("desconectar.php");
	return $datos;
}
function buscarPassword($login,$password){
	include ("conectar.php");
	$lista= "select * from usuarios where login='$login' and password=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	include ("desconectar.php");
	return $reg;
}
function buscarNivel($login,$password){
	include ("conectar.php");
	$lista= "select * from usuarios where login='$login' and password=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$nivel= "" .pg_result($rlista, $d, 5)."";
	}	
	pg_free_result($rlista);
	include ("desconectar.php");
	return $nivel;
}
function Buscar_respuestas($id){
	include ("conectar.php");
   	$lista="select * from respuestas where hdocumento=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero= "" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";
			$fechr="" .pg_result($rlista, $d, 3)."";	
			$medico= "" .pg_result($rlista, $d, 4)."";
			$establecimiento="" .pg_result($rlista, $d, 5)."";
			$diagnostico="" .pg_result($rlista, $d, 6)."";
			$recomendaciones="" .pg_result($rlista, $d, 7)."";	
			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechr));
	}		
	$datos=array($id,$numero,$paciente,$fechr,$medico,$establecimiento,$diagnostico,$recomendaciones);
	pg_free_result($rlista);
	include ("desconectar.php");
	return $datos;	
}
function repuestasPendientes($usuario){
	include ("conectar.php");
   	$lista="select * from respuestas where login='$usuario';";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0){
		$datos="Respuestas <table class=\"GridTable\"  width=\"750\" border=\"1\"><tr><td width=\"60\" class=\"GridHeader\">N&uacute;mero</td><td width=\"130\" class=\"GridHeader\">Paciente</td><td width=\"89\" class=\"GridHeader\">Fecha y hora </td><td width=\"130\" class=\"GridHeader\">Nombre del Medico </td><td class=\"GridHeader\" colspan=\"2\">Establecimiento</td></tr>";
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero= "" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";
			$fechr="" .pg_result($rlista, $d, 3)."";	
			$medico= "" .pg_result($rlista, $d, 4)."";
			$establecimiento="" .pg_result($rlista, $d, 5)."";
			$diagnostico="" .pg_result($rlista, $d, 6)."";
			$recomendaciones="" .pg_result($rlista, $d, 7)."";			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechr));
			$datos.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td>$establecimiento</td><td width=\"26\"><img src=\"../cardiologico/Imagenes/medicina.png\" width=\"24\" height=\"24\" style=\"cursor:pointer\" onClick=\"levantapopup('respuesta','$id');\"></img></td></tr>";
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos.="</table>";
	}
	if (empty($datos)){
	$datos="<IMG src=\"../../Imagenes/pixel.png\" width=\"700\" height=\"1\">";
	}
	return $datos;
}
function secuenciaPacientes(){
	include ("conectar.php");
	$consulta=pg_exec($conexion,"SELECT last_value FROM id_p;");
	$frmsql=pg_numrows($consulta);
    for ($m=0; $m < $frmsql ; $m++){
      $ultimoserial= "" .pg_result($consulta, $m, 0) .  "";
    }
	pg_free_result($consulta);
	include ("desconectar.php");
	return $ultimoserial;
}
function numeroDocumento($tipo){
	include ("conectar.php");
	$consulta=pg_exec($conexion,"SELECT * from tipo_documento where id=$tipo;");
	$frmsql=pg_numrows($consulta);
    for ($m=0; $m < $frmsql ; $m++){
      $ultimoserial= "" .pg_result($consulta, $m, 3) .  "";
    }
	++$ultimoserial;
	$update=pg_exec($conexion,"update tipo_documento set ultimoserial=$ultimoserial where id=$tipo;");
	$frmupdt=pg_numrows($update);	
	pg_free_result($consulta);
	include ("desconectar.php");
	return $ultimoserial;
}
function generaMunicipios(){
	include ("conectar.php");
	$consulta=pg_exec($conexion,"SELECT num_region, des_region FROM org_geografica where region_precedente=6 order by des_region;");
	$salida= "<select name='municipio' id='municipio' onChange='cargaContenido(this.id)'>";
	$salida.= "<option value='0'>Elige</option>";
	$frmsql=pg_numrows($consulta);
    for ($m=0; $m < $frmsql ; $m++){
      $salida.= "<option value='" .pg_result($consulta, $m, 0) .  "'>" . pg_result($consulta, $m, 1)  . "</option>";
    }	
	pg_free_result($consulta);
	include ("desconectar.php");
	$salida.= "</select>";
	return $salida;
}
function generaParroquias($opcion){
	include ("conectar.php");
	$consulta=pg_exec($conexion,"SELECT num_region, des_region FROM org_geografica where region_precedente=$opcion order by des_region;");
	$salida= "<select name='parroquia' id='parroquia' onChange='cargaContenido(this.id)'>";
	$salida.= "<option value='0'>Elige</option>";
	$frpsql=pg_numrows($consulta);
    for ($p=0; $p < $frpsql ; $p++){
      $salida.= "<option value='" .pg_result($consulta, $p, 0) .  "'>" . pg_result($consulta, $p, 1)  . "</option>";
    }	
	$salida.= "</select>";
	pg_free_result($consulta);
	include ("desconectar.php");
	return $salida;
}
function insertDocumento($diagnostico,$examen,$estatus,$numero,$usuario,$himagen,$htipo,$horigen,$hmedico,$observacion,$hdestino){
	include ("conectar.php");
	if (empty($examen)){
	$examen="null";
	}
	if (empty($himagen)){
	$himagen="null";
	}
	if (empty($htipo)){
	$htipo="null";
	}
	if (empty($horigen)){
	$horigen="null";
	}
	if (empty($hdestino)){
	$hdestino="null";
	}
	if (empty($observacion)){
	$observacion="NINGUNA";
	}
	$sql="insert into documento (diagnostico,hexamen,estatus,numero,usuario,himagen,htipo,horigen,hdestino,observacion,fecha,hmedico) values ('$diagnostico',$examen,'$estatus','$numero','$usuario',$himagen,$htipo,$horigen,$hdestino,'$observacion',now(),$hmedico);";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
	return $sql;
}
function insertMensajeRespuesta  ($horigen,$hdestino,$mensaje,$hdocumento,$hpaciente,$hpadre){
	include ("conectar.php");
	$sql="insert into mensajes (horigen,hdestino,fecha,mensaje,hdocumento,hpaciente,hpadre,estatus) values ($horigen,$hdestino,now(),'$mensaje',$hdocumento,$hpaciente,$hpadre,1);";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
	return $sql;
}
function insertPacientes($cedula,$nombre,$edad,$sexo,$telefono,$correo,$direccion,$hlocalidad){
	include ("conectar.php");
	$sql="insert into pacientes (cedula,nombre,edad,sexo,telefono,correo,direccion,hlocalidad) values ('$cedula','$nombre','$edad','$sexo','$telefono','$correo','$direccion',$hlocalidad);";
	$consulta=pg_exec($conexion,$sql);
   	$lista="select * from id_p;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$lastvalue= "" .pg_result($rlista, $d, 1)."";
	}
	pg_free_result($consulta);
	include ("desconectar.php");
	return $lastvalue;
}
function insertEstablecimiento($nombre,$telefono,$direccion,$hlocalidad){
	include ("conectar.php");
	$sql="insert into establecimiento (nombre,telefono,direccion,hlocalidad) values ('$nombre','$telefono','$direccion',$hlocalidad);";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
}
function insertMedicos($nombre,$cedula,$hestablecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad,$loggin,$password){
	include ("conectar.php");
	$sql="insert into medicos (nombre,cedula,hestablecimiento,edad,sexo,direccion,telefono,correo,hlocalidad,login,clave) values ('$nombre','$cedula',$hestablecimiento,'$edad','$sexo','$direccion','$telefono','$correo',$hlocalidad,'$loggin',md5('$password'));";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
}
function Buscar_pacientes($id){
	include ("conectar.php");
   	$lista="SELECT * from pacientes WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
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
		$correo= "" .pg_result($rlista, $d, 8)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$cedula,$nombre,$edad,$sexo,$telefono,$direccion,$ubicacion,$correo);
	return $datos;
}
function Buscar_pacientes_cedula($cedula){
	include ("conectar.php");
   	$lista="SELECT * from pacientes WHERE cedula='$cedula';";
	$rlista=pg_exec($conexion,$lista);
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
	include ("desconectar.php");
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
function Buscar_establecimiento($id){
	include ("conectar.php");
   	$lista="SELECT * from establecimiento WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre="" .pg_result($rlista, $d, 1)."";
		$ubicacion="" .pg_result($rlista, $d, 2)."";
		$telefono="" .pg_result($rlista, $d, 3)."";	
		$direccion= "" .pg_result($rlista, $d, 4)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$nombre,$telefono,$direccion,$ubicacion);
	return $datos;
}
function Buscar_medicos_cedula($cedula){
	include ("conectar.php");
	if (empty($id)){
	$id="";
	}
	if (empty($cedula)){
	$cedula="";
	}	
	if (empty($nombre)){
	$nombre="";
	}	
	if (empty($hestablecimiento)){
	$hestablecimiento="";
	}	
	if (empty($establecimiento)){
	$establecimiento="";
	}		
   	$lista="SELECT medicos.id,medicos.cedula,medicos.nombre,medicos.hestablecimiento,establecimiento.nombre from medicos,establecimiento WHERE (establecimiento.id=medicos.hestablecimiento) and (medicos.cedula='$cedula');";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$hestablecimiento="" .pg_result($rlista, $d, 3)."";	
		$establecimiento= "" .pg_result($rlista, $d, 4)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$cedula,$nombre,$hestablecimiento,$establecimiento);
	return $datos;
}
function Buscar_usuarios($id){
	include ("conectar.php");
   	$lista="SELECT usuarios.id,usuarios.nombre,usuarios.login,usuarios.hnivel,tipousuario.nombre from usuarios, tipousuario where usuarios.hnivel=tipousuario.id and usuarios.id=1;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre= "" .pg_result($rlista, $d, 1)."";
		$login="" .pg_result($rlista, $d, 2)."";
		$hnivel="" .pg_result($rlista, $d, 3)."";
		$nivel="" .pg_result($rlista, $d, 4)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$nombre,$login,$hnivel,$nivel);
	return $datos;
}
function Buscar_medicos($id){
	include ("conectar.php");
   	$lista="SELECT medicos.id,medicos.cedula,medicos.nombre,medicos.hestablecimiento,establecimiento.nombre,medicos.edad,medicos.sexo,medicos.direccion,medicos.telefono,medicos.correo,medicos.hlocalidad from medicos,establecimiento WHERE (establecimiento.id=medicos.hestablecimiento) and (medicos.id=$id);";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$hestablecimiento="" .pg_result($rlista, $d, 3)."";	
		$establecimiento= "" .pg_result($rlista, $d, 4)."";
		$edad= "" .pg_result($rlista, $d, 5)."";
		$sexo= "" .pg_result($rlista, $d, 6)."";
		$direccion="" .pg_result($rlista, $d, 7)."";
		$telefono="" .pg_result($rlista, $d, 8)."";	
		$correo= "" .pg_result($rlista, $d, 9)."";
		$hlocalidad= "" .pg_result($rlista, $d, 10)."";
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$cedula,$nombre,$hestablecimiento,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad);
	return $datos;
}
function Eliminar_pacientes($id){
	include ("conectar.php");
   	$lista="delete from pacientes WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function Eliminar_establecimiento($id){
	include ("conectar.php");
   	$lista="delete from establecimiento WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function Eliminar_medico($id){
	include ("conectar.php");
   	$lista="delete from medicos WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function Eliminar_usuario($id){
	include ("conectar.php");
   	$lista="delete from usuarios WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function updatePacientes($id,$cedula,$nombre,$edad,$sexo,$telefono,$direccion,$hlocalidad,$email){
	include ("conectar.php");
	$sql1="update pacientes set cedula='$cedula' where id=$id";
	$sql2="update pacientes set nombre='$nombre' where id=$id";
	$sql3="update pacientes set edad='$edad' where id=$id";
	$sql4="update pacientes set sexo='$sexo' where id=$id";
	$sql5="update pacientes set telefono='$telefono' where id=$id";
	$sql6="update pacientes set direccion='$direccion' where id=$id";
	$sql7="update pacientes set hlocalidad='$hlocalidad' where id=$id";
	$sql8="update pacientes set correo='$email' where id=$id";
	$consulta1=pg_exec($conexion,$sql1);
	$consulta2=pg_exec($conexion,$sql2);
	$consulta3=pg_exec($conexion,$sql3);
	$consulta4=pg_exec($conexion,$sql4);
	$consulta5=pg_exec($conexion,$sql5);
	$consulta6=pg_exec($conexion,$sql6);
	$consulta7=pg_exec($conexion,$sql7);
	$consulta8=pg_exec($conexion,$sql8);
	include ("desconectar.php");
}
function updateEstablecimiento($id,$nombre,$telefono,$direccion,$hlocalidad){
	include ("conectar.php");
	$sql2="update establecimiento set nombre='$nombre' where id=$id";
	$sql5="update establecimiento set telefono='$telefono' where id=$id";
	$sql6="update establecimiento set direccion='$direccion' where id=$id";
	$sql7="update establecimiento set hlocalidad='$hlocalidad' where id=$id";
	$consulta2=pg_exec($conexion,$sql2);
	$consulta5=pg_exec($conexion,$sql5);
	$consulta6=pg_exec($conexion,$sql6);
	$consulta7=pg_exec($conexion,$sql7);
	include ("desconectar.php");
}
function selectEstablecimiento(){
	include ("conectar.php");
	if (empty($id)){
	$id="";
	}
	if (empty($nombre)){
	$nombre="";
	}	
   	$lista="SELECT * from establecimiento order by nombre;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if (empty($salida)){
	$salida="";
	}
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$nombre="" .pg_result($rlista, $d, 1)."";
		$salida.="<option value=\"$id\">$nombre</option>";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function actualizarMedicos($id,$cedula,$nombre,$establecimiento){
	include ("conectar.php");
	$sql1="update medicos set cedula='$cedula' where id=$id";
	$sql2="update medicos set nombre='$nombre' where id=$id";
	$sql3="update medicos set hestablecimiento=$establecimiento where id=$id";
	$consulta1=pg_exec($conexion,$sql1);
	$consulta2=pg_exec($conexion,$sql2);
	$consulta3=pg_exec($conexion,$sql3);
	include ("desconectar.php");
}
function updateMedicos($id,$cedula,$nombre,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad){
	include ("conectar.php");
	$sql1="update medicos set cedula='$cedula' where id=$id";
	$sql2="update medicos set nombre='$nombre' where id=$id";
	$sql3="update medicos set hestablecimiento=$establecimiento where id=$id";
	$sql4="update medicos set edad='$edad' where id=$id";
	$sql5="update medicos set sexo='$sexo' where id=$id";
	$sql6="update medicos set direccion='$direccion' where id=$id";
	$sql7="update medicos set telefono='$telefono' where id=$id";
	$sql8="update medicos set correo='$correo' where id=$id";
	$sql9="update medicos set hlocalidad=$hlocalidad where id=$id";
	$consulta1=pg_exec($conexion,$sql1);
	$consulta2=pg_exec($conexion,$sql2);
	$consulta3=pg_exec($conexion,$sql3);
	$consulta4=pg_exec($conexion,$sql4);
	$consulta5=pg_exec($conexion,$sql5);
	$consulta6=pg_exec($conexion,$sql6);
	$consulta7=pg_exec($conexion,$sql7);
	$consulta8=pg_exec($conexion,$sql8);
	$consulta9=pg_exec($conexion,$sql9);
	include ("desconectar.php");
}
function listar_medicos_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}
	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\">Cedula</td><td class=\"GridHeader\" >Nombre</td><td colspan=\"3\"  class=\"GridHeader\" >Establecimiento</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT medicos.id,medicos.cedula,medicos.nombre,establecimiento.nombre FROM medicos,establecimiento WHERE medicos.hestablecimiento=establecimiento.id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previos')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximos')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_medicos_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td colspan=\"3\"  class=\"GridHeader\" >Establecimiento</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT medicos.id,medicos.cedula,medicos.nombre,establecimiento.nombre FROM medicos,establecimiento WHERE medicos.hestablecimiento=establecimiento.id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_pacientes_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Edad</td><td class=\"GridHeader\" >Sexo</td><td class=\"GridHeader\" >Telefono</td><td width=\"150\" class=\"GridHeader\" >Direccion</td><td colspan=\"3\"  class=\"GridHeader\" >Ubicaci&oacute;n</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT pacientes.id,pacientes.cedula,pacientes.nombre,pacientes.edad,pacientes.sexo,pacientes.telefono,pacientes.direccion,org_geografica.nombrelargo as ubicacion FROM pacientes,org_geografica WHERE pacientes.hlocalidad=org_geografica.num_region;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
					$id= "" .pg_result($rlista, $d, 0)."";
					$cedula= "" .pg_result($rlista, $d, 1)."";
					$nombre="" .pg_result($rlista, $d, 2)."";
					$edad="" .pg_result($rlista, $d, 3)."";	
					$sexo= "" .pg_result($rlista, $d, 4)."";
					$telefono="" .pg_result($rlista, $d, 5)."";
					$direccion="" .pg_result($rlista, $d, 6)."";	
					$ubicacion= "" .pg_result($rlista, $d, 7)."";
					$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
				$id= "" .pg_result($rlista, $d, 0)."";
				$cedula= "" .pg_result($rlista, $d, 1)."";
				$nombre="" .pg_result($rlista, $d, 2)."";
				$edad="" .pg_result($rlista, $d, 3)."";	
				$sexo= "" .pg_result($rlista, $d, 4)."";
				$telefono="" .pg_result($rlista, $d, 5)."";
				$direccion="" .pg_result($rlista, $d, 6)."";	
				$ubicacion= "" .pg_result($rlista, $d, 7)."";
				$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
				$id= "" .pg_result($rlista, $d, 0)."";
				$cedula= "" .pg_result($rlista, $d, 1)."";
				$nombre="" .pg_result($rlista, $d, 2)."";
				$edad="" .pg_result($rlista, $d, 3)."";	
				$sexo= "" .pg_result($rlista, $d, 4)."";
				$telefono="" .pg_result($rlista, $d, 5)."";
				$direccion="" .pg_result($rlista, $d, 6)."";	
				$ubicacion= "" .pg_result($rlista, $d, 7)."";
				$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_pacientes_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Edad</td><td class=\"GridHeader\" >Sexo</td><td class=\"GridHeader\" >Telefono</td><td width=\"150\" class=\"GridHeader\" >Direccion</td><td colspan=\"3\"  class=\"GridHeader\" >Ubicaci&oacute;n</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT pacientes.id,pacientes.cedula,pacientes.nombre,pacientes.edad,pacientes.sexo,pacientes.telefono,pacientes.direccion,org_geografica.nombrelargo as ubicacion FROM pacientes,org_geografica WHERE pacientes.hlocalidad=org_geografica.num_region;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_establecimiento_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Telefono</td><td colspan=\"3\" class=\"GridHeader\"  >Direccion</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT establecimiento.id,establecimiento.nombre,establecimiento.telefono,establecimiento.direccion FROM establecimiento;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_establecimiento_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Telefono</td><td colspan=\"3\" class=\"GridHeader\"  >Direccion</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT establecimiento.id,establecimiento.nombre,establecimiento.telefono,establecimiento.direccion FROM establecimiento;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre="" .pg_result($rlista, $d, 1)."";
			$telefono="" .pg_result($rlista, $d, 2)."";	
			$direccion= "" .pg_result($rlista, $d, 3)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$telefono</td><td>$direccion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_telegrama_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Numero</td><td class=\"GridHeader\" >Nombre del Paciente</td><td class=\"GridHeader\" >Fecha y Hora</td><td class=\"GridHeader\" >Medico de Cabecera</td><td colspan=\"2\"  class=\"GridHeader\" >ECG</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select documento.id as id, documento.numero as numero, pacientes.nombre as paciente,documento.fecha as fecha,medicos.nombre as medico,documento.himagen as imagen, imagenes.tipo as tipo from documento,pacientes, medicos, imagenes where documento.horigen=pacientes.id and documento.hmedico=medicos.id and documento.himagen=imagenes.id and htipo=1;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if (rtrim($tipo)=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if (rtrim($tipo)=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if (rtrim($tipo)=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\" width=\"100\" height=\"20\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if ($tipo=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if ($tipo=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if ($tipo=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if ($tipo=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if ($tipo=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if ($tipo=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_telegrama_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Numero</td><td class=\"GridHeader\" >Nombre del Paciente</td><td class=\"GridHeader\" >Fecha y Hora</td><td class=\"GridHeader\" >Medico de Cabecera</td><td colspan=\"2\"  class=\"GridHeader\" >ECG</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select documento.id as id, documento.numero as numero, pacientes.nombre as paciente,documento.fecha as fecha,medicos.nombre as medico,documento.himagen as imagen, imagenes.tipo as tipo from documento,pacientes, medicos, imagenes where documento.horigen=pacientes.id and documento.hmedico=medicos.id and documento.himagen=imagenes.id and htipo=1;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if ($tipo=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if ($tipo=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if ($tipo=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if ($tipo=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if ($tipo=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if ($tipo=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero="" .pg_result($rlista, $d, 1)."";
			$paciente="" .pg_result($rlista, $d, 2)."";	
			$fechan= "" .pg_result($rlista, $d, 3)."";
			$medico="" .pg_result($rlista, $d, 4)."";	
			$imagen= "" .pg_result($rlista, $d, 5)."";
			$tipo="" .pg_result($rlista, $d, 6)."";
			if ($tipo=="image/gif"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".gif";
			}
			if ($tipo=="image/jpeg"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".jpg";
			}
			if ($tipo=="image/png"){
				$destino =  "../../Imagenes/electrocardiogramas/".$imagen.".png";
			}			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fechan));
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$numero</td><td>$paciente</td><td>$fecha</td><td>$medico</td><td><img src=\"$destino\"></td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_usuarios_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Login</td><td colspan=\"3\"  class=\"GridHeader\" >Nivel</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select usuarios.id,usuarios.nombre,usuarios.login,tipousuario.nombre from usuarios, tipousuario where usuarios.hnivel=tipousuario.id order by usuarios.login;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_usuarios_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Login</td><td colspan=\"3\" class=\"GridHeader\"  >Nivel</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select usuarios.id,usuarios.nombre,usuarios.login,tipousuario.nombre from usuarios, tipousuario where usuarios.hnivel=tipousuario.id order by usuarios.login;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$nombre= "" .pg_result($rlista, $d, 1)."";
			$login="" .pg_result($rlista, $d, 2)."";
			$nivel="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$login</td><td>$nivel</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function encontrar_pacientes($entrada){
	include ("conectar.php");
	$salida="<table class=\"GridTable\"  border=\"1\"><tr><td width=\"54\">Cedula</td><td width=\"108\">Nombre</td><td width=\"38\">Edad</td><td width=\"33\">Sexo</td><td width=\"73\">Telefono</td><td width=\"150\">Direccion</td><td colspan=\"2\" >Ubicaci&oacute;n</td></tr>";
   	$lista="SELECT pacientes.cedula,pacientes.nombre,pacientes.edad,pacientes.sexo,pacientes.telefono,pacientes.direccion,org_geografica.nombrelargo as ubicacion FROM pacientes,org_geografica WHERE pacientes.hlocalidad=org_geografica.num_region;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0){
		for ($d=0; $d < $reg; $d++){
				$id= "" .pg_result($rlista, $d, 0)."";
				$cedula= "" .pg_result($rlista, $d, 1)."";
				$nombre="" .pg_result($rlista, $d, 2)."";
				$edad="" .pg_result($rlista, $d, 3)."";	
				$sexo= "" .pg_result($rlista, $d, 4)."";
				$telefono="" .pg_result($rlista, $d, 5)."";
				$direccion="" .pg_result($rlista, $d, 6)."";	
				$ubicacion= "" .pg_result($rlista, $d, 7)."";
				$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"20\" height=\"20\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td></tr>";  
		}
	}
	else	{
			$salida.="<tr><td colspan=\"5\">Registro no encontrado!!</td></tr>";
			$r=0;
			$d=0;
	}
	$salida.="</table>";
	$salida.="<table class=\"GridTable\"  border=\"1\">";
	$salida.="<tr><td width=\"47\">&nbsp;</td>";
	$salida.="<td width=\"24\"><img src=\"../../Imagenes/primeros.png\" width=\"20\" height=\"20\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
	$salida.="<td width=\"24\"><img src=\"../../Imagenes/atras.png\" width=\"20\" height=\"20\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')></td>";
	$salida.="<td width=\"24\"><img src=\"../../Imagenes/siguiente.png\" width=\"20\" height=\"20\"  style=\"cursor:pointer\" onClick=\"listado('$r','1')\"></td>";
	$salida.="<td width=\"25\"><img src=\"../../Imagenes/ultimo.png\" width=\"20\" height=\"20\"  style=\"cursor:pointer\" onclick=\"listado('$reg','1')></td>";
	
	$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
	$salida.="</tr>";
	$salida.="</table>";
	$salidab=array($salida,$r,$d);
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_historia_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}
	$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Edad</td><td class=\"GridHeader\" >Sexo</td><td class=\"GridHeader\" >Telefono</td><td width=\"150\" class=\"GridHeader\" >Direccion</td><td colspan=\"2\"  class=\"GridHeader\" >Ubicaci&oacute;n</td></tr>";
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT pacientes.id,pacientes.cedula,pacientes.nombre,pacientes.edad,pacientes.sexo,pacientes.telefono,pacientes.direccion,org_geografica.nombrelargo as ubicacion FROM pacientes,org_geografica WHERE pacientes.hlocalidad=org_geografica.num_region;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
					$id= "" .pg_result($rlista, $d, 0)."";
					$cedula= "" .pg_result($rlista, $d, 1)."";
					$nombre="" .pg_result($rlista, $d, 2)."";
					$edad="" .pg_result($rlista, $d, 3)."";	
					$sexo= "" .pg_result($rlista, $d, 4)."";
					$telefono="" .pg_result($rlista, $d, 5)."";
					$direccion="" .pg_result($rlista, $d, 6)."";	
					$ubicacion= "" .pg_result($rlista, $d, 7)."";
					$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
				$id= "" .pg_result($rlista, $d, 0)."";
				$cedula= "" .pg_result($rlista, $d, 1)."";
				$nombre="" .pg_result($rlista, $d, 2)."";
				$edad="" .pg_result($rlista, $d, 3)."";	
				$sexo= "" .pg_result($rlista, $d, 4)."";
				$telefono="" .pg_result($rlista, $d, 5)."";
				$direccion="" .pg_result($rlista, $d, 6)."";	
				$ubicacion= "" .pg_result($rlista, $d, 7)."";
				$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
				$id= "" .pg_result($rlista, $d, 0)."";
				$cedula= "" .pg_result($rlista, $d, 1)."";
				$nombre="" .pg_result($rlista, $d, 2)."";
				$edad="" .pg_result($rlista, $d, 3)."";	
				$sexo= "" .pg_result($rlista, $d, 4)."";
				$telefono="" .pg_result($rlista, $d, 5)."";
				$direccion="" .pg_result($rlista, $d, 6)."";	
				$ubicacion= "" .pg_result($rlista, $d, 7)."";
				$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"   width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_historia_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"   width=\"660\" border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Edad</td><td class=\"GridHeader\" >Sexo</td><td class=\"GridHeader\" >Telefono</td><td width=\"150\" class=\"GridHeader\" >Direccion</td><td colspan=\"2\"  class=\"GridHeader\" >Ubicaci&oacute;n</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT pacientes.id,pacientes.cedula,pacientes.nombre,pacientes.edad,pacientes.sexo,pacientes.telefono,pacientes.direccion,org_geografica.nombrelargo as ubicacion FROM pacientes,org_geografica WHERE pacientes.hlocalidad=org_geografica.num_region;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"   width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$edad="" .pg_result($rlista, $d, 3)."";	
			$sexo= "" .pg_result($rlista, $d, 4)."";
			$telefono="" .pg_result($rlista, $d, 5)."";
			$direccion="" .pg_result($rlista, $d, 6)."";	
			$ubicacion= "" .pg_result($rlista, $d, 7)."";
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$edad</td><td>$sexo</td><td>$telefono</td><td>$direccion</td><td width=\"102\">$ubicacion</td><td width=\"25\"><img src=\"../../../Imagenes/historia.png\" style=\"cursor:pointer\" width=\"36\" height=\"32\" onClick=\"historia('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Historia')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_examenes_adelante($inicio,$id){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}
	$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Fecha</td><td class=\"GridHeader\" >Tension Arterial</td><td class=\"GridHeader\" >Frecuencia Cardiaca</td><td class=\"GridHeader\" >Frecuencia Respiratoria</td><td class=\"GridHeader\" >Peso</td><td class=\"GridHeader\" >Talla</td><td colspan=\"2\"  class=\"GridHeader\" >Aspecto</td></tr>";
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select * from conshist where hhistoria=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
				$idexamen= "" .pg_result($rlista, $d, 1)."";
				$nombre= "" .pg_result($rlista, $d, 2)."";
				$fec="" .pg_result($rlista, $d, 3)."";
				$tensarte="" .pg_result($rlista, $d, 4)."";	
				$freqcard= "" .pg_result($rlista, $d, 5)."";
				$freqresp="" .pg_result($rlista, $d, 6)."";
				$peso="" .pg_result($rlista, $d, 7)."";	
				$talla= "" .pg_result($rlista, $d, 8)."";
				$aspecto="" .pg_result($rlista, $d, 9)."";
				$ecg="" .pg_result($rlista, $d, 10)."";	
				$extension= "" .pg_result($rlista, $d, 11)."";
				if (rtrim($extension)==".ctk"){
					$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"../../../datos/ctk/".rtrim($ecg).".ctk\"><img src=\"../../../Imagenes/CARDIOTK.ICO\"></a></td></tr>";  
				}
    			else {
					$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"../../../Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
				}
				}	
				$salida.="</table>";
				$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('0','1','$id')\"></td>";
				$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
						$id= "" .pg_result($rlista, $d, 0)."";
						$nombre= "" .pg_result($rlista, $d, 1)."";
						$fec="" .pg_result($rlista, $d, 2)."";
						$tensarte="" .pg_result($rlista, $d, 3)."";	
						$freqcard= "" .pg_result($rlista, $d, 4)."";
						$freqresp="" .pg_result($rlista, $d, 5)."";
						$peso="" .pg_result($rlista, $d, 6)."";	
						$talla= "" .pg_result($rlista, $d, 7)."";
						$aspecto="" .pg_result($rlista, $d, 5)."";
						$ecg="" .pg_result($rlista, $d, 6)."";	
						$extension= "" .pg_result($rlista, $d, 7)."";
						if (rtrim($extension)==".ctk"){
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($ecg)."</td></tr>";  
						}
						else {
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
						}
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$d','0','$id')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$d','1','$id')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('$u','1','$id')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
						$id= "" .pg_result($rlista, $d, 0)."";
						$nombre= "" .pg_result($rlista, $d, 1)."";
						$fec="" .pg_result($rlista, $d, 2)."";
						$tensarte="" .pg_result($rlista, $d, 3)."";	
						$freqcard= "" .pg_result($rlista, $d, 4)."";
						$freqresp="" .pg_result($rlista, $d, 5)."";
						$peso="" .pg_result($rlista, $d, 6)."";	
						$talla= "" .pg_result($rlista, $d, 7)."";
						$aspecto="" .pg_result($rlista, $d, 5)."";
						$ecg="" .pg_result($rlista, $d, 6)."";	
						$extension= "" .pg_result($rlista, $d, 7)."";
						if (rtrim($extension)==".ctk"){
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($ecg)."</td></tr>";  
						}
						else {
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
						}
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"   width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$inicio','0','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$d','1','$id')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('$u','1','$id')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_examenes_atras($final,$id){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}
	$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\"><tr><td class=\"GridHeader\" >Nombre</td><td class=\"GridHeader\" >Fecha</td><td class=\"GridHeader\" >Tension Arterial</td><td class=\"GridHeader\" >Frecuencia Cardiaca</td><td class=\"GridHeader\" >Frecuencia Respiratoria</td><td class=\"GridHeader\" >Peso</td><td class=\"GridHeader\" >Talla</td><td colspan=\"2\"  class=\"GridHeader\" >Aspecto</td></tr>";
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="select * from conshist where hhistoria=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
						$id= "" .pg_result($rlista, $d, 0)."";
						$nombre= "" .pg_result($rlista, $d, 1)."";
						$fec="" .pg_result($rlista, $d, 2)."";
						$tensarte="" .pg_result($rlista, $d, 3)."";	
						$freqcard= "" .pg_result($rlista, $d, 4)."";
						$freqresp="" .pg_result($rlista, $d, 5)."";
						$peso="" .pg_result($rlista, $d, 6)."";	
						$talla= "" .pg_result($rlista, $d, 7)."";
						$aspecto="" .pg_result($rlista, $d, 5)."";
						$ecg="" .pg_result($rlista, $d, 6)."";	
						$extension= "" .pg_result($rlista, $d, 7)."";
						if (rtrim($extension)==".ctk"){
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($ecg)."</td></tr>";  
						}
						else {
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
						}
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"   width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('0','1','$id')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
						$id= "" .pg_result($rlista, $d, 0)."";
						$nombre= "" .pg_result($rlista, $d, 1)."";
						$fec="" .pg_result($rlista, $d, 2)."";
						$tensarte="" .pg_result($rlista, $d, 3)."";	
						$freqcard= "" .pg_result($rlista, $d, 4)."";
						$freqresp="" .pg_result($rlista, $d, 5)."";
						$peso="" .pg_result($rlista, $d, 6)."";	
						$talla= "" .pg_result($rlista, $d, 7)."";
						$aspecto="" .pg_result($rlista, $d, 5)."";
						$ecg="" .pg_result($rlista, $d, 6)."";	
						$extension= "" .pg_result($rlista, $d, 7)."";
						if (rtrim($extension)==".ctk"){
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($ecg)."</td></tr>";  
						}
						else {
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
						}
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('0','1','$id')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
						$id= "" .pg_result($rlista, $d, 0)."";
						$nombre= "" .pg_result($rlista, $d, 1)."";
						$fec="" .pg_result($rlista, $d, 2)."";
						$tensarte="" .pg_result($rlista, $d, 3)."";	
						$freqcard= "" .pg_result($rlista, $d, 4)."";
						$freqresp="" .pg_result($rlista, $d, 5)."";
						$peso="" .pg_result($rlista, $d, 6)."";	
						$talla= "" .pg_result($rlista, $d, 7)."";
						$aspecto="" .pg_result($rlista, $d, 5)."";
						$ecg="" .pg_result($rlista, $d, 6)."";	
						$extension= "" .pg_result($rlista, $d, 7)."";
						if (rtrim($extension)==".ctk"){
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\">Archivo (.ctk) haga click con boton derecho sobre la imagen y seleccionar guardar enlace como -> <a href=\"datos/ctk/".rtrim($ecg)."</td></tr>";  
						}
						else {
							$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected';\" onMouseOut=\"this.className='GridRow';\"><td>$nombre</td><td>$fec</td><td>$tensarte</td><td>$freqcard</td><td>$freqresp</td><td>$peso</td><td>$talla</td><td>$aspecto</td><td width=\"25\"><img src=\"Imagenes/ecg/$nombre\" width=\"540\"  height=\"50\"></td></tr>";  
						}
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  width=\"660\" border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('0','1','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$r','0','$id')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listadoexamen('$d','1','$id')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listadoexamen('$reg','0','$id')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function insertRegistrados($nombre,$cedula,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad,$estatus,$loggin,$password,$direccionest,$telefonoest,$hlocalidadest){
	include ("conectar.php");
	$sql="insert into registrados (nombre,cedula,hestablecimiento,establecimiento,edad,sexo,direccion,telefono,correo,hlocalidad,estatus,loggin,clave,hubicaestable,telefonoestable,direccionestable) values ('$nombre','$cedula',1,'$establecimiento','$edad','$sexo','$direccion','$telefono','$correo',$hlocalidad,$estatus,'$loggin',md5('$password'),$hlocalidadest,'$telefonoest','$direccionest');";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
}
function updateRegistrados($id,$cedula,$nombre,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad,$loggin,$password){
	include ("conectar.php");
	$sql1="update registrados set cedula='$cedula' where id=$id";
	$sql2="update registrados set nombre='$nombre' where id=$id";
	$sql3="update registrados set hestablecimiento=$establecimiento where id=$id";
	$sql4="update registrados set edad='$edad' where id=$id";
	$sql5="update registrados set sexo='$sexo' where id=$id";
	$sql6="update registrados set direccion='$direccion' where id=$id";
	$sql7="update registrados set telefono='$telefono' where id=$id";
	$sql8="update registrados set correo='$correo' where id=$id";
	$sql9="update registrados set hlocalidad=$hlocalidad where id=$id";
	$sql10="update registrados set loggin='$loggin' where id=$id";
	$sql11="update registrados set password=md5('$password') where id=$id";
	$consulta1=pg_exec($conexion,$sql1);
	$consulta2=pg_exec($conexion,$sql2);
	$consulta3=pg_exec($conexion,$sql3);
	$consulta4=pg_exec($conexion,$sql4);
	$consulta5=pg_exec($conexion,$sql5);
	$consulta6=pg_exec($conexion,$sql6);
	$consulta7=pg_exec($conexion,$sql7);
	$consulta8=pg_exec($conexion,$sql8);
	$consulta9=pg_exec($conexion,$sql9);
	$consulta10=pg_exec($conexion,$sql10);
	$consulta11=pg_exec($conexion,$sql11);
	include ("desconectar.php");
}
function listar_registrados_adelante($inicio){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}
	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\">Cedula</td><td class=\"GridHeader\" >Nombre</td><td colspan=\"3\"  class=\"GridHeader\" >Establecimiento</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT registrados.id,registrados.cedula,registrados.nombre,establecimiento.nombre FROM registrados,establecimiento WHERE registrados.hestablecimiento=establecimiento.id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$r=$inicio+6;
	$u=$reg-6;
	if ($r>=$reg){
		if ($reg<6){
			for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
					}	
					$salida.="</table>";
					
					$salida.="<table class=\"GridTable\"  border=\"1\">";
					$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previos')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximos')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
					$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
					
					$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
					$salida.="</tr>";
					$salida.="</table>";
					
			}
		else {
			for ($d=$inicio; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
				}	
				$salida.="</table>";
				
				$salida.="<table class=\"GridTable\"  border=\"1\">";
				$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','0')\"></td>";
				$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
				$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
				
				$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
				$salida.="</tr>";
				$salida.="</table>";
				
		}
	}
	else {
		for ($d=$inicio; $d < $r; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$inicio','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$u','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function listar_registrados_atras($final){
	include ("conectar.php");
	if (empty($salida)){
	$salida="";
	}

	$salida.="<table class=\"GridTable\"  border=\"1\"><tr><td class=\"GridHeader\" >Cedula</td><td class=\"GridHeader\" >Nombre</td><td colspan=\"3\"  class=\"GridHeader\" >Establecimiento</td></tr>";
	
	if (empty($inicio)){
		$inicio=0;
	}
   	$lista="SELECT registrados.id,registrados.cedula,registrados.nombre,establecimiento.nombre FROM registrados,establecimiento WHERE registrados.hestablecimiento=establecimiento.id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	$rf=$final-6;
	$r=$final-12;
	if (($final<=0) or ($r<=0) or ($rf<=0)){
		if ($reg < 6){
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}
		else {
		for ($d=0; $d < 6; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('0','1')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
		}	
		$r=0;
	}
	else	{
		for ($d=$r; $d < $rf; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$cedula= "" .pg_result($rlista, $d, 1)."";
			$nombre="" .pg_result($rlista, $d, 2)."";
			$establecimiento="" .pg_result($rlista, $d, 3)."";	
			$salida.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow';\"><td>$cedula</td><td>$nombre</td><td>$establecimiento</td><td width=\"25\"><img src=\"../../Imagenes/traer.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"devuelve('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Devuelve')\"></td><td width=\"25\"><img src=\"../../Imagenes/eliminar.png\" style=\"cursor:pointer\" width=\"16\" height=\"14\" onClick=\"eliminar('$id')\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Eliminar')\"></td></tr>";  
		}	
		$salida.="</table>";
		
		$salida.="<table class=\"GridTable\"  border=\"1\">";
		$salida.="<tr><td width=\"47\"><img src=\"../../Imagenes/buscar.gif\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Buscar')\"  style=\"cursor:pointer\" onClick=\"buscar()\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/first.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Primeros')\"  style=\"cursor:pointer\" onClick=\"listado('0','1')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/previous.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Previo')\"  style=\"cursor:pointer\" onClick=\"listado('$r','0')\"></td>";
		$salida.="<td width=\"24\"><img src=\"../../Imagenes/next.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Proximo')\"  style=\"cursor:pointer\" onClick=\"listado('$d','1')\"></td>";
		$salida.="<td width=\"25\"><img src=\"../../Imagenes/last.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Ultimos')\"  style=\"cursor:pointer\" onclick=\"listado('$reg','0')\"></td>";
		
		$salida.="<td width=\"91\"><img src=\"../../Imagenes/close.png\" width=\"16\" height=\"16\"  alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Cerrar')\"  style=\"cursor:pointer\" onClick=\"cerrar()\"></td>";
		$salida.="</tr>";
		$salida.="</table>";
		
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $salida;
}
function Eliminar_registrados($id){
	include ("conectar.php");
   	$lista="delete from registrados WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function Buscar_registrados_cedula($cedula){
	include ("conectar.php");
	if (empty($id)){
	$id="";
	}
	if (empty($cedula)){
	$cedula="";
	}	
	if (empty($nombre)){
	$nombre="";
	}	
	if (empty($hestablecimiento)){
	$hestablecimiento="";
	}	
	if (empty($establecimiento)){
	$establecimiento="";
	}		
   	$lista="SELECT registrados.id,registrados.cedula,registrados.nombre,registrados.hestablecimiento,establecimiento.nombre from registrados,establecimiento WHERE (establecimiento.id=registrados.hestablecimiento) and (registrados.cedula='$cedula');";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$hestablecimiento="" .pg_result($rlista, $d, 3)."";	
		$establecimiento= "" .pg_result($rlista, $d, 4)."";
	}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$cedula,$nombre,$hestablecimiento,$establecimiento);
	return $datos;
}
function Buscar_registrados($id){
	include ("conectar.php");
   	$lista="SELECT registrados.id,registrados.cedula,registrados.nombre,registrados.hestablecimiento,establecimiento.nombre,registrados.edad,registrados.sexo,registrados.direccion,registrados.telefono,registrados.correo,registrados.hlocalidad,registrados.estatus,registrados.loggin,registrados.clave from registrados,establecimiento WHERE (establecimiento.id=registrados.hestablecimiento) and (registrados.id=$id);";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
		$cedula= "" .pg_result($rlista, $d, 1)."";
		$nombre="" .pg_result($rlista, $d, 2)."";
		$hestablecimiento="" .pg_result($rlista, $d, 3)."";	
		$establecimiento= "" .pg_result($rlista, $d, 4)."";
		$edad= "" .pg_result($rlista, $d, 5)."";
		$sexo= "" .pg_result($rlista, $d, 6)."";
		$direccion="" .pg_result($rlista, $d, 7)."";
		$telefono="" .pg_result($rlista, $d, 8)."";	
		$correo= "" .pg_result($rlista, $d, 9)."";
		$hlocalidad= "" .pg_result($rlista, $d, 10)."";
		$estatus= "" .pg_result($rlista, $d, 11)."";		
		$loggin= "" .pg_result($rlista, $d, 12)."";
		$password= "" .pg_result($rlista, $d, 13)."";		
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos= array($id,$cedula,$nombre,$hestablecimiento,$establecimiento,$edad,$sexo,$direccion,$telefono,$correo,$hlocalidad,$estatus,$loggin,$password);
	return $datos;
}
function Activar_registrados($id){
	include ("conectar.php");
	$sql1="select * from factivar_usuarios($id)";
	$consulta1=pg_exec($conexion,$sql1);
	include ("desconectar.php");
}
function Desactivar_registrados($id){
	include ("conectar.php");	
	$sql1="update registrados set estatus=0 where id=$id";
	$sql2="delete from usuarios where id=$id";
	$consulta1=pg_exec($conexion,$sql1);
	$consulta2=pg_exec($conexion,$sql2);	
	include ("desconectar.php");
}
function buscarloggin($loggin){
	include ("conectar.php");
	$sql1="select * from fbuscar_usuarios('$loggin')";
	$consulta1=pg_exec($conexion,$sql1);
	$reg = pg_numrows($consulta1);
	for ($d=0; $d < $reg; $d++){
		$i= "" .pg_result($consulta1, $d, 0)."";
		}		
	pg_free_result($consulta1);
	return $i;	
	include ("desconectar.php");
}
function buscarIdUsuario($login,$password){
	include ("conectar.php");
	$lista= "select * from usuarios where login='$login' and password=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $id;
}
function finsert_telegrama($htipo ,  $horigen ,  $hdestino ,  $estatus ,  $hexamen ,  $hpaciente ,  $diagnostico ,  $husuario ,  $observacion ){
	include ("conectar.php");
	$lista= "select * from finsertelegrama($htipo,$horigen,$hdestino,$estatus,$hexamen,$hpaciente,'$diagnostico',$husuario,'$observacion');"; 
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function buscarhestablecimientoRegistrados($husuario){
	include ("conectar.php");
	$lista= "select * from registrados where id=$husuario;"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$hestablecimiento= "" .pg_result($rlista, $d, 3)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $hestablecimiento;
}
function finsertecg($hpaciente,$archivo,$tipo,$size,$product_image){
	include ("conectar.php");
	$buffer=pg_escape_bytea($product_image);	
	$lista= "select * from finsertecg($hpaciente,'$archivo','$tipo','$size','$buffer');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $id;	
}
function telegramasPendientes(){
	include ("conectar.php");
   	$lista="select * from telegramas;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		$datos="<p>Peticiones Pendientes</p><table class=\"GridTable\"  width=\"750\" border=\"1\"><tr><td width=\"60\" class=\"GridHeader\">N&uacute;mero</td><td width=\"130\" class=\"GridHeader\">Nombre del Paciente </td><td width=\"89\" class=\"GridHeader\">Fecha y hora </td><td width=\"130\" class=\"GridHeader\">Nombre del Usuario </td><td colspan=\"2\" class=\"GridHeader\">Establecimiento</td></tr>";
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$numero= "" .pg_result($rlista, $d, 1)."";
			$pacientes="" .pg_result($rlista, $d, 2)."";
			$fech="" .pg_result($rlista, $d, 3)."";	
			$medico= "" .pg_result($rlista, $d, 4)."";
			$establecimiento="" .pg_result($rlista, $d, 5)."";
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
			$datos.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$numero</td><td>$pacientes</td><td>$fecha</td><td>$medico</td><td width=\"168\">$establecimiento</td><td width=\"26\"><img src=\"../cardiologico/Imagenes/medicina.png\" width=\"24\" height=\"24\" style=\"cursor:pointer\" onClick=\"levantapopup('telegrama','$id')\"></img></td></tr>";
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos.="</table>";
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function buscartelegramasPendientes($id){
	include ("conectar.php");
   	$lista="select * from vertelegrama where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		for ($d=0; $d < $reg; $d++){
			$hdocumento= "" .pg_result($rlista, $d, 0)."";
			$numero= "" .pg_result($rlista, $d, 1)."";
			$fech= "" .pg_result($rlista, $d, 2)."";
			$paciente= "" .pg_result($rlista, $d, 3)."";
			$idpaciente= "" .pg_result($rlista, $d, 4)."";
			$establecimiento= "" .pg_result($rlista, $d, 5)."";
			$idmedico= "" .pg_result($rlista, $d, 6)."";
			$cedulam= "" .pg_result($rlista, $d, 7)."";
			$nombrem= "" .pg_result($rlista, $d, 8)."";
			$diagnostico= "" .pg_result($rlista, $d, 9)."";
			$hexamen= "" .pg_result($rlista, $d, 10)."";
			$hecg= "" .pg_result($rlista, $d, 11)."";		
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($hdocumento,$numero, $fecha,$paciente,$idpaciente,$establecimiento,$idmedico,$cedulam,$nombrem,$diagnostico, $hexamen,$hecg);
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function buscarIdUsuarioMed($login,$password){
	include ("conectar.php");
	$lista= "select * from usuarios where login='$login' and password=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $id;
}
function buscarlogginMedico($loggin){
	include ("conectar.php");
	$sql1="select * from fbuscar_loginmedicos('$loggin')";
	$consulta1=pg_exec($conexion,$sql1);
	$reg = pg_numrows($consulta1);
	for ($d=0; $d < $reg; $d++){
		$i= "" .pg_result($consulta1, $d, 0)."";
		}		
	pg_free_result($consulta1);
	return $i;	
	include ("desconectar.php");
}
function buscarPasswordMedicos($login,$password){
	include ("conectar.php");
	$lista= "select * from medicos where login='$login' and clave=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	include ("desconectar.php");
	return $reg;
}
function buscarUsuarioMedico($login){
	include ("conectar.php");
	$lista= "select * from medicos where login='$login';"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$nombre= "" .pg_result($rlista, $d, 11)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $nombre;
}
function buscarIdUsuarioMedico($login, $password){
	include ("conectar.php");
	$lista= "select * from medicos where login='$login' and clave=md5('$password');"; 
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	for ($d=0; $d < $reg; $d++){
		$id= "" .pg_result($rlista, $d, 0)."";
	}
	pg_free_result($rlista);
	include ("desconectar.php");
	return $id;
}
function GuardarRespuesta($id,$hmedico,$respuesta,$diagnostico){
	include ("conectar.php");

	$sql="select * from finserespuesta($id , $hmedico , '$respuesta' , '$diagnostico' );";
	$consulta=pg_exec($conexion,$sql);
	include ("desconectar.php");
	return $sql;
}
function Actualizarenrespuesta($id){
	include ("conectar.php");
   	$lista="update documento set estatus=3 WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function buscarVistaDocumento($id){
	include ("conectar.php");
   	$lista="select * from vistadocumento where hdocumento=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		for ($d=0; $d < $reg; $d++){
			$hdocumento= "" .pg_result($rlista, $d, 0)."";
			$numero= "" .pg_result($rlista, $d, 1)."";
			$htipo= "" .pg_result($rlista, $d, 2)."";			
			$horigen= "" .pg_result($rlista, $d, 3)."";
			$hdestino= "" .pg_result($rlista, $d, 4)."";			
			$medico= "" .pg_result($rlista, $d, 5)."";
			$hmedico= "" .pg_result($rlista, $d, 6)."";
			$estatus= "" .pg_result($rlista, $d, 7)."";
			$fech= "" .pg_result($rlista, $d, 8)."";
			$hexamen= "" .pg_result($rlista, $d, 9)."";
			$paciente= "" .pg_result($rlista, $d, 10)."";
			$hpaciente= "" .pg_result($rlista, $d, 11)."";
			$diagnostico= "" .pg_result($rlista, $d, 12)."";
			$nombreusuario= "" .pg_result($rlista, $d, 13)."";		
			$login= "" .pg_result($rlista, $d, 14)."";
			$husuario= "" .pg_result($rlista, $d, 15)."";
			$observacion= "" .pg_result($rlista, $d, 16)."";
			$fecharesp= "" .pg_result($rlista, $d, 17)."";
			$respuesta= "" .pg_result($rlista, $d, 18)."";
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($hdocumento,$numero,$horigen,$hdestino,$medico,$hmedico,$estatus,$fecha,$hexamen,$paciente,$hpaciente,$diagnostico,$nombreusuario,$login,$husuario,$observacion,$fecharesp,$respuesta);
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function mensajeriapendientecardiologico($husuario){
	include ("conectar.php");
   	$lista="select * from mensajeriapendientecardiologico where hmedico=$husuario;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		$datos="<p>Mensajeria Pendiente</p><table class=\"GridTable\"  width=\"750\" border=\"1\"><tr><td width=\"60\" class=\"GridHeader\">Nombre del Usuario </td><td width=\"130\" class=\"GridHeader\">Nombre del Paciente </td><td width=\"89\" class=\"GridHeader\">Fecha y hora </td><td colspan=\"2\" class=\"GridHeader\">Mensaje</td></tr>";
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$usuario="" .pg_result($rlista, $d, 1)."";
			$fech="" .pg_result($rlista, $d, 4)."";	
			$paciente= "" .pg_result($rlista, $d, 7)."";
			$mensaje="" .pg_result($rlista, $d, 9)."";
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
			$datos.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$usuario</td><td>$paciente</td><td>$fecha</td><td>$mensaje</td><td width=\"26\"><img src=\"../cardiologico/Imagenes/medicina.png\" width=\"24\" height=\"24\" style=\"cursor:pointer\" onClick=\"levantapopup('mensaje','$id')\"></img></td></tr>";
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos.="</table>";
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function Buscarmensajeriapendientecardiologico($id){
	include ("conectar.php");
   	$lista="select * from mensajeriapendientecardiologico where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$usuario= "" .pg_result($rlista, $d, 1)."";
			$husuario= "" .pg_result($rlista, $d, 2)."";			
			$hmedico= "" .pg_result($rlista, $d, 3)."";
			$fech= "" .pg_result($rlista, $d, 4)."";			
			$hdocumento= "" .pg_result($rlista, $d, 5)."";
			$hpaciente= "" .pg_result($rlista, $d, 6)."";
			$hpadre= "" .pg_result($rlista, $d, 7)."";
			$mensaje= "" .pg_result($rlista, $d, 8)."";
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($id,$usuario,$husuario,$hmedico,$fech,$hdocumento,$hpaciente,$hpadre,$mensaje);
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function Actualizarmensajedialogando($id){
	include ("conectar.php");
   	$lista="update mensajes set estatus=3 WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function Actualizarmensajeprocesado($id){
	include ("conectar.php");
   	$lista="update mensajes set estatus=4 WHERE id=$id;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}
function mensajeriapendientetelegrama($husuario){
	include ("conectar.php");
   	$lista="select * from mensajeriapendientecentros where husuario=$husuario;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		$datos="<p>Mensajeria Pendiente</p><table class=\"GridTable\"  width=\"750\" border=\"1\"><tr><td width=\"60\" class=\"GridHeader\">Nombre del Medico </td><td width=\"89\" class=\"GridHeader\">Fecha y hora </td><td colspan=\"2\" class=\"GridHeader\">Mensaje</td></tr>";
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$medico="" .pg_result($rlista, $d, 1)."";
			$husuario="" .pg_result($rlista, $d, 2)."";	
			$fech= "" .pg_result($rlista, $d, 3)."";
			$hdocumento="" .pg_result($rlista, $d, 4)."";
			$hpaciente="" .pg_result($rlista, $d, 5)."";	
			$hpadre= "" .pg_result($rlista, $d, 6)."";
			$mensaje="" .pg_result($rlista, $d, 7)."";			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
			$datos.="<tr class='GridRow' onMouseOver=\"this.className='GridRowSelected'; \" onMouseOut=\"this.className='GridRow'; \"><td>$medico</td><td>$fecha</td><td>$mensaje</td><td width=\"26\"><img src=\"../cardiologico/Imagenes/medicina.png\" width=\"24\" height=\"24\" style=\"cursor:pointer\" onClick=\"levantapopup('mensaje','$id')\"></img></td></tr>";
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos.="</table>";
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function Buscarmensajeriapendientecentros($id){
	include ("conectar.php");
   	$lista="select * from mensajeriapendientecentros where id=$id;";
	$rlista=pg_exec($conexion,$lista);
	$reg = pg_numrows($rlista);
	if ($reg>0) {
		for ($d=0; $d < $reg; $d++){
			$id= "" .pg_result($rlista, $d, 0)."";
			$medico="" .pg_result($rlista, $d, 1)."";
			$husuario="" .pg_result($rlista, $d, 2)."";	
			$fech= "" .pg_result($rlista, $d, 3)."";
			$hdocumento="" .pg_result($rlista, $d, 4)."";
			$hpaciente="" .pg_result($rlista, $d, 5)."";	
			$hpadre= "" .pg_result($rlista, $d, 6)."";
			$mensaje="" .pg_result($rlista, $d, 7)."";
			$hmedico="" .pg_result($rlista, $d, 8)."";			
			$fecha= strftime("%d/%m/%Y %I:%M %P",strtotime($fech));
		}		
	pg_free_result($rlista);
	include ("desconectar.php");
	$datos=array ($id,$medico,$husuario,$fecha,$hdocumento,$hpaciente,$hpadre,$mensaje,$hmedico);
	}
	if (empty($datos)){
	$datos="";
	}
	return $datos;
}
function ActualizarmensajeOtrodia(){
	include ("conectar.php");
   	$lista="select proc001(id, fecha) from mensajes;";
	$rlista=pg_exec($conexion,$lista);
	include ("desconectar.php");
}

?>