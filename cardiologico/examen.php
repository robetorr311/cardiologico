<?php
	$id = $_GET['id'];
	include("datos/datos.php");
	$datos=buscarExamen($id);
	$hhistoria=$datos[0];
	$tensarte=$datos[1];
	$freqcard=$datos[2];
	$freqresp=$datos[3];
	$peso=$datos[4];
	$talla=$datos[5];
	$aspecto=$datos[6];
	$hrxtorax=$datos[7];
	$hecg=$datos[8];
	$fech=$datos[9];	
/*	$datosecg=buscarECG($hecg);
	$hpacienteecg=$datosecg[0];
	$tipoecg=$datosecg[1];
	$descripcionecg=$datosecg[2];
	$sizeecg=$datosecg[3];
	$fechaecg=$datosecg[4];
	$nombreecg=	$datosecg[5];*/
?>
<link href="estilos.css" rel="stylesheet" type="text/css">
<form id="formulario">
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario" width="43"><img src="Imagenes/examen.png" width="33" height="32"></td>
<td class="formulario" width="601" >FICHA EXAMEN FISICO</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario">Tensi&oacute;n Arterial: </td>
<td><input name="tensarte" type="text" class="textbox" id="tensarte" size="10" value="<?=$tensarte?>" disabled>
</td>
<td class="formulario">&nbsp;</td>
<td class="formulario">Frecuencia Cardiaca: </td>
<td><input name="freqcard" type="text" class="textbox" id="freqcard" size="10"  value="<?=$freqcard?>" disabled></td>
<td class="formulario">&nbsp;</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario">Frecuencia Respiratoria: </td>
<td><input name="freqresp" type="text" class="textbox" id="freqresp" size="10"  value="<?=$freqresp?>" disabled></td>
<td class="formulario">&nbsp;</td>
<td class="formulario">Peso:</td>
<td><input name="peso" type="text" class="textbox" id="peso" size="10"  value="<?=$peso?>" disabled></td>
<td class="formulario">&nbsp;</td>
<td class="formulario">Talla:</td>
<td><input name="talla" type="text" class="textbox" id="talla" size="10"  value="<?=$talla?>" disabled></td>
<td class="formulario">&nbsp;</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario" colspan="2"><div align="center">Aspecto General del Paciente</div></td>
</tr>
<tr>
<td><textarea name="aspecto" class="textbox" id="aspecto" disabled><?=$aspecto?></textarea></td>
<td class="formulario">&nbsp; </td>
</tr>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario">ECG</td>
<td><a href="download.php?id=<?=$hecg?>" title="Descargar ECG">Descargar ECG</a></td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="formulario" ><p align="center">
  <input type="button" name="Submit2" value="Cerrar" onClick="hidePopWin();">
</p>
</td>
</tr>
</table>
</form>

