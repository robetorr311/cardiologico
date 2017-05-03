<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.::TELEGRAMA::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="stylesheet" type="text/css" href="../cardiologico/subModal.css">
<link href="../cardiologico/estilos/Site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript" src="submodal.js"></script>
<script type="text/javascript" src="funciones.js"></script>
</head>
<body onFocus="ocultaMensaje();">
<center>
<div id="encab" width="*" height="90" class="encabezado">
	<img src="../cardiologico/Imagenes/encabezado.png"></img>
</div>	
	<?php
	$nombre=buscarUsuario($log);
	$husuario=buscarIdUsuario($log,$pwd);
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
	echo "<marquee width=\"800\" SCROLLDELAY=200><font color=\"#930000\"><span style=\"font-size: 10pt; font-family: sans-serif;\" lang=\"-none-\">Bienvenido $nombre al Sistema de Informaci&oacute;n Computarizado para el Desarrollo de Actividades de Telemedicina Destinadas a la Interconsulta Cardiol&oacute;gica &nbsp; |&nbsp; Maracay,	$dia2 $dd de $mes2 de $anio | Hora: $hora:$minutos&nbsp;$ampm </span></color></marquee>";
	echo "<img src=\"Imagenes/pixel.png\" width=\"990\" height=\"1\" border=\"0\"></img>";
	?>
<img src="../cardiologico/Imagenes/salir.png" onClick="CerrarSesion();"></img>	
<div id="transparencia">
	<div id="transparenciaMensaje"></div>
</div>
<div id="session">
	<div id="formContenedor">
		<form id="formulario" name="formulario">
		<table cellspacing="0" width="700" border="1">
				<tr>
				<td class="head" width="67">Fecha:</td>
				<td class="formulario" width="233"><input name="fecha" type="text" id="fecha" disabled class="textbox" ></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Fecha')"></td>
				<td class="head" width="88">Numero:</td>
				<td class="formulario" width="158"><input name="numero"  type="text" id="numero" disabled class="textbox" ></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Numero')"></td>
				</tr>
				</table>
			<div id="paciente">
				<table cellspacing="0" width="700" border="1">
				<tr>
				<td class="head" width="113">Cedula del Paciente : </td>
				<td class="formulario" width="97"><input id="idpaciente" type="hidden" class="textbox" ><input name="cedula" type="text" id="cedulap"  class="textbox" size="15" maxlength="15" onChange="paciente();"></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Cedulap')"></td>
				<td class="head" width="116">Nombre y Apellido:</td>
				<td class="formulario" width="306"><input name="nombrep" type="text" id="nombrep" size="50" maxlength="50" disabled class="textbox" ></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Nombrep')"></td>
				</tr>
				</table>
				<table cellspacing="0" width="700" border="1">
				<tr>
				<td class="head">Edad:</td>
				<td class="formulario"><input name="edad"  type="text" id="edad" size="5" maxlength="5" disabled class="textbox" ></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Edad')"></td>
				<td class="head">Sexo:</td>
				<td class="formulario"><select name="sexo" id="sexo" disabled class="textbox" >
				<option value="M">M</option>
				<option value="F">F</option>
				</select></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Sexo')"></td>
				<td class="head" width="66">Telefono:</td>
				<td class="formulario" width="97"><input name="telefono"  class="textbox" type="text" id="telefono" size="15" maxlength="15" disabled></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Telefono')"></td>
				</tr>
				<tr>
				<td class="head" width="64">email:</td>
				<td class="formulario" width="215"><input name="email"  class="textbox" type="text" id="email" size="30" maxlength="30" disabled></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Email')"></td>
				<td class="formulario"></td><td class="formulario"></td><td class="formulario"></td><td class="formulario"></td><td class="formulario"></td><td class="formulario"></td></tr>
				</table>
				<table cellspacing="0" width="700" border="1">			
				<tr>
				<td class="head" colspan="2">Direcci&oacute;n del Paciente </td>
				</tr>
				<tr>
				<td class="formulario"><textarea name="direccion"  class="textbox" cols="80" rows="2" id="direccion" disabled></textarea></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Direccion')"></td>
				</tr>
				<tr>
				<td colspan="2" class="formulario"><input type="hidden" name="hubicacion" id="hubicacion"><input type="button" class="button" name="Submit" value="Ubicacion" disabled>
				<input type="button" class="button" name="Submit2" value="Editar" onClick="editarPacientes()" disabled></td>
				</tr>
				</table>
			</div>
			<div id="diagex">
				<table cellspacing="0" width="700" border="1">
				<tr>
				<td  class="head" colspan="2">Diagnostico</td>
				</tr>
				<tr>
				<td class="formulario"><textarea name="diagnostico"  class="textbox" cols="100" rows="2" id="diagnostico" disabled></textarea></td><td class="formulario"><img src="../cardiologico/Imagenes/info.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Diagnostico')"></td>
				</tr>
				</table>
			</div>
			<div id="botones">
				<table cellspacing="0"><tr><td><input type="button" class="button" name="guardar" value="Guardar" onClick="validaForm()" disabled>
				<input name="himagen" type="hidden">
				<input type="button" class="button" name="anexar" value="Anexar Examen Fisico" onClick="levantapopup('examen','0');" disabled>
			</td></tr></table>
			</div>
			<input type="hidden" name="usuario" id="usuario" value="<?=$log?>">
			<input type="hidden" name="husuario" id="husuario" value="<?=$husuario?>">
			<input type="hidden" name="hecg" id="hecg">
			<input type="hidden" name="hexamen" id="hexamen">		
		</form>
	</div>	
	<div id="respuestas">
			<?php
			$salida=repuestasPendientes($log);
			echo $salida;
			?>
	</div>
	<div id="mensajes">
			<?php
			$salida=mensajeriapendientetelegrama($husuario);
			echo $salida;
			?>
	</div>
</div>
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>
</center>
</body>
</html>
