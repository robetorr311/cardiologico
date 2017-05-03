<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.::Consulta de Pacientes::.</title>
<link rel="stylesheet" type="text/css" href="../cardiologico/estilos.css">
<link REL="shortcut icon" HREF="../cardiologico/Imagenes/logo.ico" TYPE="image/x-icon">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body>
<div id="Divcons">
<?php
		$inicio=0;
		include '../cardiologico/datos/datos.php';
		$salida=listar_telegrama_adelante($inicio);
		echo $salida;
?>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</body>
</html>