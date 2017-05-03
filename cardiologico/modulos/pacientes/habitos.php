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
      <td width="36"><img src="../../Imagenes/antecedentes.png" width="36" height="36"></td>
      <td width="548" class="titulo_form">Ficha Registro de Habitos del Paciente </td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Consumo de tabaco </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="tabaco" id="tabaco"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Tabaco')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Consumo de alcohol </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="alcohol" id="alcohol"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Alcohol')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Ejercicio F&iacute;sico </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="ejercicio" id="ejercicio"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Ejercicio')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Habitos Alimenticios </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="alimentacion" id="alimentacion"></textarea></td>
      <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Alimentacion')"></td>
    </tr>
  </table>
  <table width="600" border="1" cellspacing="0">
    <tr>
      <td class="formulario"><input type="button" class="button" name="Submit" value="Enviar" onClick="devuelveHabitos()"></td>
    </tr>
  </table>
</form>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>	
</body>
</html>
