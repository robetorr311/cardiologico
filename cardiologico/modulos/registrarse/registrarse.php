<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<div id="registro">
		<form id="formulario">
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td width="60" class="titulo_form"><img src="../../Imagenes/usuarios.png" width="30" height="30"></td>
			  <td width="584" class="titulo_form">Ficha Activacion de Usuarios Registrados</td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">C&eacute;dula</td>
			  <td class="formulario"><input name="cedula" type="text" class="textbox" id="cedula" size="20" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Cedula')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre:</td>
			  <td class="formulario"><input name="nombre" type="text" class="textbox" id="nombre" size="50" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td width="77" class="head">Edad:</td>
			  <td width="248" class="formulario"><input name="edad" type="text" class="textbox" id="edad" size="5" disabled></td>
			  <td width="67" class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Edad')"></td>
			  <td width="72" class="head">Sexo:</td>
			  <td width="98" class="formulario"><select name="sexo" class="textbox" id="sexo" disabled>
				<option value="M">M</option>
				<option value="F">F</option>
			  </select></td>
			  <td width="58" class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sexo')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Tel&eacute;fono:</td>
			  <td class="formulario"><input name="telefono" type="text" class="textbox" id="telefono" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Telefono')"></td>
			  <td class="head">Correo Electr&oacute;nico </td>
			  <td class="formulario"><input name="correo" type="text" class="textbox" id="correo" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Correo')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Establecimiento:</td>
			  <td class="formulario"><select name="establecimiento" class="textbox" id="establecimiento" disabled>
					<?php
					$salida=selectEstablecimiento();
					echo $salida;
					?>			  
			  </select></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Establecimiento')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td colspan="2" class="head"><div align="center">Direcci&oacute;n</div></td>
			</tr>
			<tr>
			  <td class="formulario"><textarea name="direccion" class="textbox" id="direccion" disabled></textarea></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Direccion')"></td>
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
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Estado')"></td>
			</tr>
		  </table>
	<div id="muni">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="head">Municipio:</td>
				<td class="formulario"><select name="municipio" disabled class="textbox" id="municipio">
				</select></td>
				<td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Municipio')"></td>
			  </tr>
			</table>
	</div>
	<div id="parr">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="head">Parroquia:</td>
				<td class="formulario"><select name="parroquia" disabled class="textbox" id="parroquia">
				</select></td>
				<td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
			  </tr>
			</table>
	</div>
	<div id="sect">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="head">Sector:</td>
				<td class="formulario"><select name="sector" disabled class="textbox" id="sector">
				</select></td>
				<td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sector')"></td>
			  </tr>
			</table>
	</div>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="head">Nombre de Usuario:</td>
			  <td class="formulario"><input name="loggin" type="text" class="textbox" id="loggin" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Loggin')"></td>
			  <td class="head">Contraseña</td>
			  <td class="formulario"><input name="password" type="text" class="textbox" id="password" disabled></td>
			  <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Password')"></td>
			</tr>
		  </table>	
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario"><input type="button" class="button" name="Submit" value="Agregar" onClick="newRegistro()">
			  <input type="button" class="button" name="Submit2" value="Consultar" onclick="consulta()"></td>
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