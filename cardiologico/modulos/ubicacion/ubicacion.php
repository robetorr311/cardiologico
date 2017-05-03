<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../estilos/Site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body onFocus="ocultaMensaje();">
<div id="transparencia">
	<div id="transparenciaMensaje"></div>
</div>
<div id="Ubicacion">
	<form id="formulario">
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td width="39" class="titulo_form"><img src="../../Imagenes/ubicacion.gif" width="39" height="30"></td>
			  <td width="605" class="titulo_form">Ficha Ubicacion Geogr&aacute;fica </td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre del Sector: </td>
			  <td class="formulario"><input name="nombre" type="text" id="nombre" size="70" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" onmouseover="muestraAyuda(event, 'Nombre')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre del Estado: </td>
			  <td class="formulario"><select name="estado" id="estado" disabled>
			  </select></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" onmouseover="muestraAyuda(event, 'Estado')"></td>
			</tr>
		  </table>
	<div id="muni">
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre del Municipio: </td>
			  <td class="formulario"><select name="municipio" id="municipio" disabled>
			  </select></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" onmouseover="muestraAyuda(event, 'Municipio')"></td>
			</tr>
		  </table>
	</div>
	<div id="parr">
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre de la Parroquia: </td>
			  <td class="formulario"><select name="parroquia" id="parroquia" disabled>
			  </select></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
			</tr>
		  </table>
	</div>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario"><input type="button" class="button" name="Submit" value="Agregar" onClick="newUbicacion();"></td>
			</tr>
		  </table>
	</form>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</body>
</html>
