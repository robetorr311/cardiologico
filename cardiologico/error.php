<?php
	$_SESSION = array();
	$_SESSION["activa"]	= 0;
    session_destroy();
    $_SERVER['PHP_AUTH_USER'] = '';
    $_SERVER['PHP_AUTH_PW'] = '';	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos/Site.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	font-size: 24px;
	color: #000000;
}
.Estilo2 {
	color: #000000;
	font-weight: bold;
	font-size: 14px;
}
.Estilo3 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body class="bodycentral"><center>
<table width="660" border="1">
  <tr>
    <td class="titulo_form"><p align="center" class="Estilo1"><img src="Imagenes/logo_fondo_n.png" width="199" height="200"></p>
      <p align="center" class="Estilo1">&nbsp;</p>
      <p align="center" class="Estilo1">ERROR CONTRASE&Ntilde;A INCORRECTA O NO EXISTE EL USUARIO!!</p>      <p align="center" class="Estilo1">Esta trantando de ingresar a una zona restringida!!</p>
      <p align="center" class="Estilo1 Estilo3"><span class="Estilo1"><img src="Imagenes/error.gif" width="32" height="32"></span></p>      <p align="center" class="Estilo3">Si desea ingresar al sistema deber&aacute; comunicarse con el Centro Docente Cardiol&oacute;gico Bolivariano de Aragua y solicitar una clave de acceso al sistema de informacion!! </p>      
      <p align="center" class="Estilo2">&nbsp;</p></td>
  </tr>
</table>
</center>
</body>
</html>
