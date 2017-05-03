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
<div id="Usuarios">
	<form id="formulario">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td width="50" class="titulo_form"><img src="../../Imagenes/fusuarios.png" width="40" height="40"></td>
		  <td width="594" class="titulo_form">Ficha para Ingresar Usuarios al Sistema </td>
		</tr>
	  </table>
	        <table width="660" border="1" cellspacing="0">
              <tr>
                <td class="head">Nombres y Apellidos </td>
                <td class="formulario"><input name="nombre" type="text" class="textbox" id="nombre" size="50" disabled></td>
                <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
              </tr>
            </table>
            <table width="660" border="1" cellspacing="0">
              <tr>
                <td class="head">Login</td>
                <td class="formulario"><input name="login" type="text" class="textbox" id="login" size="20" maxlength="8" disabled></td>
                <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Login')"></td>
              </tr>
            </table>
            <table width="660" border="1" cellspacing="0">
              <tr>
                <td class="head">Password</td>
                <td class="formulario"><input name="password" type="password" class="textbox" id="password" disabled></td>
                <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Password')"></td>
              </tr>
            </table>
            <table width="660" border="1" cellspacing="0">
              <tr>
                <td class="head">Nivel:</td>
                <td class="formulario"><select name="nivel" class="textbox" id="nivel" disabled>
                  <?
					$usuarios=TipoUsuario();
					echo $usuarios;
				  ?>
                </select></td>
                <td class="formulario"><img src="../../Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nivel')"></td>
              </tr>
            </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario"><div align="center">
            <input type="button" class="button" name="Submit" value="Agregar" onClick="newUsuario()">
            <input type="button" class="button" name="Submit2" value="Consulta" onclick="consulta()">
		  </div></td>
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