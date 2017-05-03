<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<title>.::Insertar Imagen::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../estilos.css">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body onLoad="RecuperaDatos()">
<div id="contenedor">
        <div id="cabecera">		<img src="../../Imagenes/pixel.png" width="600" height="1">
			<table class="tabla_form"><tr><td align="center" class="titulo">Insertar Imagen</td></tr></table>
			<img src="../../Imagenes/pixel.png" width="600" height="1">
			<br><br>
			<img src="../../Imagenes/pixel.png" width="600" height="1">
		</div>
        <span class="msg"><?=$msg?></span>
        <div id="postform">
                <form name="formulario" id="formulario" action="imagen.php" method="post" enctype="multipart/form-data">
					<input type="hidden" id="hpaciente" name="hpaciente">
					<table width="600" border="1">
					<tr>
					<td class="head">Archivo:</td>
					<td><input type="file" id="archivo" name="archivo" size="40"></td>
					</tr>
					<tr>
					<td class="head">Descripci&oacute;n del archivo: </td>
					<td><input type="text" id="desc" name="desc" size="55"></td>
					</tr>
					</table>
					<input type="submit" name="enviar" id="enviar" value="Guardar">
                </form>
        </div>
</div>
</body>
</html>