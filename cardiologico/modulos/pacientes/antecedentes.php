<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="shortcut icon" HREF="../../Imagenes/logo.ico" TYPE="image/x-icon">
<link href="../../estilos/Site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body>
<form id="formulario">
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td width="41"><img src="../../Imagenes/antecedentes.png" width="36" height="36"></td>
      <td width="543" class="titulo_form">Ficha Registro de Antecedentes del paciente </td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head"><div align="center">Antecedentes Personales </div></td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="personales" id="personales"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Personales')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head"><div align="center">Antecedentes Familiares </div></td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="familiares" id="familiares"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Familiares')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td class="formulario"><input type="button"  class="button" name="Submit" value="Enviar" onClick="devuelveAntecedentes()"></td>
    </tr>
  </table>
</form>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>	
</body>
</html>
