<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Sistema de Informacion Computarizado para el desarrollo de actividades de telemedicina destinadas a la interconsulta cardiológica</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos/Site.css" rel="stylesheet" type="text/css">
</head>
<body>
<center>
<table id="encab" width="*" height="90" class="encabezado">
<tr>
<td>
<img src="Imagenes/encabezado.png"></img>
</td>
</tr>
</table>
<?php
	include("datos/datos.php");
	session_start();
	$usuario= "".$_SESSION['login']."";
	$nombre=buscarUsuario($usuario);
	$fecha=time();
	$dia= strftime("%A",$fecha);
	if ($dia == "Sunday" ) {
		$dia2="Domingo";
	}
	if ($dia == "Monday" ) {
		$dia2="Lunes";
	}
	if ($dia == "Tuesday" ) {
		$dia2="Martes";
	}
	if ($dia == "Wednesday" ) {
		$dia2="Miercoles";
	}
	if ($dia == "Thursday" ) {
		$dia2="Jueves";
	}
	if ($dia == "Friday" ) {
		$dia2="Viernes";
	}
	if ($dia == "Saturday" ) {
		$dia2="Sabado";
	}
		$dd = strftime("%d",$fecha);
		$mes=strftime("%B",$fecha);
	if ($mes == "January" ) {
		$mes2="Enero";
	}
	if ($mes == "February" ) {
		$mes2="Febrero";
	}
	if ($mes == "March" ) {
		$mes2="Marzo";
	}
	if ($mes == "April" ) {
		$mes2="Abril";
	}
	if ($mes == "May" ) {
		$mes2="Mayo";
	}
	if ($mes == "June" ) {
		$mes2="Junio";
	}
	if ($mes == "July" ) {
		$mes2="Julio";
	}
	if ($mes == "August" ) {
		$mes2="Agosto";
	}
	if ($mes == "September" ) {
		$mes2="Septiembre";
	}
	if ($mes == "October" ) {
		$mes2="Octubre";
	}
	if ($mes == "November" ) {
		$mes2="Noviembre";
	}
	if ($mes == "December" ) {
		$mes2="Diciembre";
	}
	$anio= strftime("%Y",$fecha);
	$hora= strftime("%I",$fecha);
	$minutos = strftime("%M",$fecha);
	$ampm =strftime("%p",$fecha);
	echo "<marquee width=\"800\" SCROLLDELAY=200><font color=\"#930000\"><span style=\"font-size: 10pt; font-family: sans-serif;\" lang=\"-none-\">Bienvenido $nombre al Sistema de Informaci&oacute;n Computarizado para el Desarrollo de Actividades de Telemedicina Destinadas a la Interconsulta Cardiol&oacute;gica &nbsp; |&nbsp; Maracay,	$dia2 $dd de $mes2 de $anio | Hora: $hora:$minutos&nbsp;$ampm </span></color></marquee>";
	echo "<img src=\"Imagenes/pixel.png\" width=\"990\" height=\"1\" border=\"0\"></img>";
?>
</center>
</body>
</html>