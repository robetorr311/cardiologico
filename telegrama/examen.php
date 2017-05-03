<?php
	$idpaciente = $_GET['idpaciente'];
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
<link rel="stylesheet" type="text/css" href="../cardiologico/subModal.css">
<link href="../cardiologico/estilos/Site.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="funcionesexamen.js"></script>
</head>
<body>
<form action="imagen.php" method="post" enctype="multipart/form-data" name="formulario" id="formulario">
<div id="examen">
		  <table cellspacing="0" width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" width="43"><img src="../cardiologico/Imagenes/examen.png" width="33" height="32"></td>
			  <td class="formulario" width="601" >FICHA EXAMEN FISICO </td>
			</tr>
		  </table>
		  <table cellspacing="0" width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario">Tensi&oacute;n Arterial: </td>
			  <td class="formulario" class="formulario"><input type="hidden" name="usuario" id="usuario"><input name="tensarte" type="text" class="textbox" id="tensarte" size="10" value="<?=$tensarte?>" disabled>
			  <input type="hidden" id="hpaciente" name="hpaciente" value="<?=$idpaciente?>" disabled></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			  <td class="formulario">Frecuencia Cardiaca: </td>
			  <td class="formulario" class="formulario"><input name="freqcard" type="text" class="textbox" id="freqcard" size="10" value="<?=$freqcard?>" disabled></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
		  <table cellspacing="0" width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario">Frecuencia Respiratoria: </td>
			  <td class="formulario" class="formulario"><input name="freqresp" type="text" class="textbox" id="freqresp" size="10" value="<?=$freqresp?>" disabled></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			  <td class="formulario">Peso:</td>
			  <td class="formulario" class="formulario"><input name="peso" type="text" class="textbox" id="peso" size="10" value="<?=$peso?>" disabled></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			  <td class="formulario">Talla:</td>
			  <td class="formulario" class="formulario"><input name="talla" type="text" class="textbox" id="talla" size="10" value="<?=$talla?>" disabled></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
		  <table cellspacing="0" width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario" colspan="2"><div align="center">Aspecto General del Paciente</div></td>
			</tr>
			<tr>
			  <td class="formulario" class="formulario"><textarea name="aspecto" class="textbox" id="aspecto" disabled><?=$aspecto?></textarea></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"> </td>
			</tr>
		  </table>
		  <table cellspacing="0" width="660" border="1" cellspacing="0">
			<tr>
			  <td class="formulario">ECG ? </td>
			  <td class="formulario" class="formulario"><input name="ecg" type="radio" value="1" disabled>
			  Si
				<input name="ecg" type="radio" value="0" checked disabled>
			  No
			  <div id="Divhecgd"><input name="hecg" type="hidden" id="hecg"  value="0" value="<?=$hecg?>"></div></td>
			  <td class="formulario" class="formulario"><img src="../cardiologico/Imagenes/info.gif" width="16" height="16"></td>
			</tr>
		  </table>
	  <table cellspacing="0" width="660" border="1" cellspacing="0">
		<tr>
		  <td class="formulario" class="formulario"><input type="button" class="button" name="Submit" value="Agregar" onClick="agregarExamen()"></td>
		</tr>
	  </table>
</div>
</form>
</body>
</html>
