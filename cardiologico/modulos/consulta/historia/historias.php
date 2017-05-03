<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="shortcut icon" HREF="../../../Imagenes/logo.ico" TYPE="image/x-icon">
<link href="../../../estilos/Site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="funciones.js"></script>
</head>

<body onFocus="ocultaMensaje();">
<div id="transparencia">
	<div id="transparenciaMensaje"></div>
</div>
  <table width="700" border="1">
    <tr>
      <td width="33"><img src="../../../Imagenes/pacientes.png" width="33" height="33"></td>
      <td width="651" class="titulo_form">Listado de Pacientes Registrados en el Sistema </td>
    </tr>
  </table>
<div id="Divcons">
<?php
		$inicio=0;
		$salida=listar_historia_adelante($inicio);
		echo $salida;
?>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</body>
</html>