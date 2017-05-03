<?php
	if (!isset($_POST["tensarte"])){
	$tensarte="";
	}
	else {
	$tensarte = "".$_POST["tensarte"]."";
	}
	if (!isset($_POST["freqcard"])){
	$freqcard="";
	}
	else {
	$freqcard = "".$_POST["freqcard"]."";
	}
	if (!isset($_POST["freqresp"])){
	$freqresp="";
	}
	else {
	$freqresp = "".$_POST["freqresp"]."";
	}
	if (!isset($_POST["hpaciente"])){
	$hpaciente="";
	}
	else {
	$hpaciente = "".$_POST["hpaciente"]."";
	}
	if (!isset($_POST["peso"])){
	$peso="";
	}
	else {
	$peso = "".$_POST["peso"]."";
	}
	if (!isset($_POST["talla"])){
	$talla="";
	}
	else {
	$talla = "".$_POST["talla"]."";
	}
	if (!isset($_POST["aspecto"])){
	$aspecto="";
	}
	else {
	$aspecto = "".$_POST["aspecto"]."";
	}
	if (!isset($_POST["hrxtorax"])){
	$hrxtorax="";
	}
	else {
	$hrxtorax = "".$_POST["hrxtorax"]."";
	}
	if (!isset($_POST["hecg"])){
	$hecg="";
	}
	else {
	$hecg = "".$_POST["hecg"]."";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body onLoad="RecuperaDatos('<?=$hpaciente?>')">
<form action="imagen.php" method="post" enctype="multipart/form-data" name="formulario" id="formulario">
<div id="examen">
		  <table width="660" border="1">
			<tr>
			  <td width="43"><img src="../../Imagenes/examen.png" width="33" height="32"></td>
			  <td width="601" class="titulo_form">FICHA EXAMEN FISICO </td>
			</tr>
		  </table>
		  <table width="660" border="1">
			<tr>
			  <td class="head">Tensi&oacute;n Arterial: </td>
			  <td><input name="tensarte" type="text" class="textbox" id="tensarte" size="10" value="<?=$tensarte?>" disabled>
			  <input type="hidden" id="hpaciente" name="hpaciente"></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			  <td class="head">Frecuencia Cardiaca: </td>
			  <td><input name="freqcard" type="text" class="textbox" id="freqcard" size="10" value="<?=$freqcard?>" disabled></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
		  <table width="660" border="1">
			<tr>
			  <td class="head">Frecuencia Respiratoria: </td>
			  <td><input name="freqresp" type="text" class="textbox" id="freqresp" size="10" value="<?=$freqresp?>" disabled></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			  <td class="head">Peso:</td>
			  <td><input name="peso" type="text" class="textbox" id="peso" size="10" value="<?=$peso?>" disabled></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			  <td class="head">Talla:</td>
			  <td><input name="talla" type="text" class="textbox" id="talla" size="10" value="<?=$talla?>" disabled></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
		  <table width="660" border="1">
			<tr>
			  <td colspan="2" class="head"><div align="center">Aspecto General del Paciente</div></td>
			</tr>
			<tr>
			  <td><textarea name="aspecto" class="textbox" id="aspecto" disabled><?=$aspecto?></textarea></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"> </td>
			</tr>
		  </table>
		  <table width="660" border="1">
			<tr>
			  <td class="head">RX Torax ? </td>
			  <td><input name="rx" type="radio" value="1" disabled>
				Si
				  <input name="rx" type="radio" value="0" checked disabled>
			  No
			  <div id="Divrxtoraxd"><input name="hrxtorax" type="hidden" id="hrxtorax" value="0" value="<?=$hrxtorax?>"></div></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
		  <table width="660" border="1">
			<tr>
			  <td class="head">ECG ? </td>
			  <td><input name="ecg" type="radio" value="1" disabled>
			  Si
				<input name="ecg" type="radio" value="0" checked disabled>
			  No
			  <div id="Divhecgd"><input name="hecg" type="hidden" id="hecg"  value="0" value="<?=$hecg?>"></div></td>
			  <td class="ayuda"><img src="../../Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
	  <table width="660" border="1">
		<tr>
		  <td><input type="button" name="Submit" value="Agregar" onClick="agregarExamen()"></td>
		</tr>
	  </table>
</div>
</form>
</body>
</html>
