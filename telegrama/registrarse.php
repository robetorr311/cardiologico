<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Ficha Registro de Usuarios Sistema de Telemedicina Cedocabar</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../cardiologico/estilos/Site.css">
<script type="text/javascript" src="registrados.js"></script>
</head>
<body onFocus="ocultaMensaje();">
	<center>
	<img src="../cardiologico/Imagenes/encabezado.png"></img>
	<?php
	include("../cardiologico/datos/datos.php");
	$fecha=time();
	$dia= strftime("%A",$fecha);
	if ($dia == "Sunday" ) {
	$dia2="Domingo";
	}
	if ($dia == "Monday" ) {
	$dia2="Lunes";
	}
	if ($dia == "Tuesday" ) {
		$dia2="Martes";
	}
	if ($dia == "Wednesday" ) {
		$dia2="Miercoles";
	}
	if ($dia == "Thursday" ) {
		$dia2="Jueves";
	}
	if ($dia == "Friday" ) {
		$dia2="Viernes";
	}
	if ($dia == "Saturday" ) {
		$dia2="Sabado";
	}
		$dd = strftime("%d",$fecha);
		$mes=strftime("%B",$fecha);
	if ($mes == "January" ) {
		$mes2="Enero";
	}
	if ($mes == "February" ) {
		$mes2="Febrero";
	}
	if ($mes == "March" ) {
		$mes2="Marzo";
	}
	if ($mes == "April" ) {
		$mes2="Abril";
	}
	if ($mes == "May" ) {
		$mes2="Mayo";
	}
	if ($mes == "June" ) {
		$mes2="Junio";
	}
	if ($mes == "July" ) {
		$mes2="Julio";
	}
	if ($mes == "August" ) {
		$mes2="Agosto";
	}
	if ($mes == "September" ) {
		$mes2="Septiembre";
	}
	if ($mes == "October" ) {
		$mes2="Octubre";
	}
	if ($mes == "November" ) {
		$mes2="Noviembre";
	}
	if ($mes == "December" ) {
		$mes2="Diciembre";
	}
	$anio= strftime("%Y",$fecha);
	$hora= strftime("%I",$fecha);
	$minutos = strftime("%M",$fecha);
	$ampm =strftime("%p",$fecha);
	echo "<marquee width=\"800\" SCROLLDELAY=200><font color=\"#930000\"><span style=\"font-size: 10pt; font-family: sans-serif;\" lang=\"-none-\">Bienvenido al Sistema de Informaci&oacute;n Computarizado para el Desarrollo de Actividades de Telemedicina Destinadas a la Interconsulta Cardiol&oacute;gica &nbsp; |&nbsp; Maracay,	$dia2 $dd de $mes2 de $anio | Hora: $hora:$minutos&nbsp;$ampm </span></color></marquee>";
	echo "<img src=\"Imagenes/pixel.png\" width=\"990\" height=\"1\" border=\"0\"></img>";
	?>

<div id="transparencia">
	<div id="transparenciaMensaje">aaaaaaaaaaaa</div>
</div>
<div id="registro">
		<form id="formulario">
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td width="60" class="formulario" ><img src="../cardiologico/Imagenes/usuarios.png" width="30" height="30"></td>
			  <td width="584" class="formulario" >Ficha  Ingreso de Usuarios</td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" >C&eacute;dula</td>
			  <td class="formulario"><input name="cedula" type="text" class="textbox" id="cedula" size="20" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Cedula')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" >Nombre:</td>
			  <td class="formulario"><input name="nombre" type="text" class="textbox" id="nombre" size="50" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td width="77" class="formulario" >Edad:</td>
			  <td width="248" class="formulario"><input name="edad" type="text" class="textbox" id="edad" size="5" disabled></td>
			  <td width="67" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Edad')"></td>
			  <td width="72" class="formulario" >Sexo:</td>
			  <td width="98" class="formulario"><select name="sexo" class="textbox" id="sexo" disabled>
				<option value="M">M</option>
				<option value="F">F</option>
			  </select></td>
			  <td width="58" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sexo')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" >Tel&eacute;fono:</td>
			  <td class="formulario"><input name="telefono" type="text" class="textbox" id="telefono" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Telefono')"></td>
			  <td class="formulario" >Correo Electr&oacute;nico </td>
			  <td class="formulario"><input name="correo" type="text" class="textbox" id="correo" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Correo')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td colspan="2" class="formulario" ><div align="center">Direcci&oacute;n</div></td>
			</tr>
			<tr>
			  <td class="formulario"><textarea name="direccion" class="textbox" id="direccion" disabled></textarea></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Direccion')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" >Estado:</td>
			  <td class="formulario"><select name="estado" class="textbox" id="estado" onchange="verMunicipios()" disabled>
				  <option value="xx">Seleccione un Estado</option>
				  <?php
				  $estados=Estados();
				  echo $estados;
				  ?>
			  </select></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Estado')"></td>
			</tr>
		  </table>
	<div id="muni">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="formulario" >Municipio:</td>
				<td class="formulario"><select name="municipio" disabled class="textbox" id="municipio">
				</select></td>
				<td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Municipio')"></td>
			  </tr>
			</table>
	</div>
	<div id="parr">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="formulario" >Parroquia:</td>
				<td class="formulario"><select name="parroquia" disabled class="textbox" id="parroquia">
				</select></td>
				<td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
			  </tr>
			</table>
	</div>
	<div id="sect">
			<table width="660" border="1" cellspacing="0">
			  <tr>
				<td class="formulario" >Sector:</td>
				<td class="formulario"><select name="sector" disabled class="textbox" id="sector">
				</select></td>
				<td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sector')"></td>
			  </tr>
			</table>
	</div>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Establecimiento al que esta adscrito:</td>
		  <td class="formulario"><input name="establecimiento" type="text" class="textbox" id="establecimiento" size="70" disabled></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombre')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Telefono:</td>
		  <td class="formulario"><input name="telefonoest" type="text" class="textbox" id="telefonoest" disabled></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Telefono')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td colspan="2" class="formulario" ><div align="center">Direcci&oacute;n</div></td>
		</tr>
		<tr>
		  <td class="formulario"><textarea name="direccionest" class="textbox" id="direccionest" disabled></textarea></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Direccion')"></td>
		</tr>
	  </table>
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Estado:</td>
		  <td class="formulario"><select name="estadoest" class="textbox" id="estadoest" onchange="verMunicipios()" disabled>
		  <option value="xx">Seleccione un Estado</option>
		  <?php
		  $estados=Estados();
		  echo $estados;
		  ?>
		  </select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Estado')"></td>
		</tr>
	  </table>
	<div id="muniest">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Municipio:</td>
		  <td class="formulario"><select name="municipioest" disabled class="textbox" id="municipioest" disabled>
				</select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Municipio')"></td>
		</tr>
	  </table>
	</div>
	<div id="parrest">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Parroquia:</td>
		  <td class="formulario"><select name="parroquiaest" disabled class="textbox" id="parroquiaest" disabled>
		  
		    </select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
		</tr>
	  </table>
	</div>
	<div id="sectest">
	  <table width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" >Sector:</td>
		  <td class="formulario"><select name="sectorest" disabled class="textbox" id="sectorest" disabled>
				</select></td>
		  <td class="formulario"><img src="../../Imagenes/info.gif"  width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sector')"></td>
		</tr>
	  </table>	
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" >Nombre de Usuario:</td>
			  <td class="formulario"><input name="loggin" type="text" class="textbox" id="loggin" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Loggin')"></td>
			</tr>
		  </table>
		  <table width="660" border="1" cellspacing="0">
			<tr>  
			  <td class="formulario" >Contraseña</td>
			  <td class="formulario"><input name="password" type="text" class="textbox" id="password" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Password')"></td>
			</tr>	
		  </table>	
		  <table width="660" border="1" cellspacing="0">
			<tr>  
			  <td class="formulario" >Repetir Contraseña</td>
			  <td class="formulario"><input name="password2" type="text" class="textbox" id="password2" disabled></td>
			  <td class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16" alt="Ayuda" onmouseover="muestraAyuda(event, 'Password')"></td>
			</tr>	
		  </table>	  
		  <table width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario"><input type="button" class="button" name="Submit" value="Agregar" onClick="newRegistro()">
			  </td>
			</tr>
		  </table>
		  
		</form>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</center>
</body>
</html>