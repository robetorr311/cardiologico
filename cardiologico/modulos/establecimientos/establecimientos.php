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
<div id="formContenedor">
<div id="establecimiento">
	<form id="formulario">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td width="31" class="titulo_form"><img src="../../Imagenes/establecimientos.png" width="27" height="27"></td>
		  <td width="613" class="titulo_form"> Ficha de Establecimientos </td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Nombre</td>
		  <td class="formulario"><input name="nombre" type="text" class="textbox" id="nombre" size="70" disabled></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Telefono:</td>
		  <td class="formulario"><input name="telefono" type="text" class="textbox" id="telefono" disabled></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Telefono')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td colspan="2" class="head"><div align="center">Direcci&oacute;n</div></td>
		</tr>
		<tr>
		  <td class="formulario"><textarea name="direccion" class="textbox" id="direccion" disabled></textarea></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Direccion')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Estado:</td>
		  <td class="formulario"><select name="estado" class="textbox" id="estado" onchange="verMunicipios()" disabled>
		  <option value="xx">Seleccione un Estado</option>
		  <?php
		  $estados=Estados();
		  echo $estados;
		  ?>
		  </select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Estado')"></td>
		</tr>
	  </table>
	<div id="muni">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Municipio:</td>
		  <td class="formulario"><select name="municipio" disabled class="textbox" id="municipio" disabled>
				</select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Municipio')"></td>
		</tr>
	  </table>
	</div>
	<div id="parr">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Parroquia:</td>
		  <td class="formulario"><select name="parroquia" disabled class="textbox" id="parroquia" disabled>
		  
		    </select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
		</tr>
	  </table>
	</div>
	<div id="sect">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="head">Sector:</td>
		  <td class="formulario"><select name="sector" disabled class="textbox" id="sector" disabled>
				</select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sector')"></td>
		</tr>
	  </table>
	</div>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario"><input name="button" type="button" class="button" id="button" value="Agregar" onClick="newEstablecimiento()"><input name="button" type="button" class="button" id="button" value="Consultar" onClick="consulta()"></td>
		</tr>
	  </table>
	</form>
</div>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>	
</body>
</html>
