<?php
	$id = $_GET['id'];
	include("../cardiologico/datos/datos.php");
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
?>
<link href="estilos.css" rel="stylesheet" type="text/css">
<form id="formulario">
<table cellspacing="0" width="600" border="1">
<tr>
<td  class="formulario" width="43"><img src="../cardiologico/Imagenes/examen.png" width="33" height="32"></td>
<td width="601" class="formulario" >FICHA EXAMEN FISICO</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="head">Tensi&oacute;n Arterial: </td>
<td class="formulario"><input name="tensarte" type="text" class="textbox" id="tensarte" size="10" value="<?=$tensarte?>" disabled>
</td>
<td class="formulario">&nbsp;</td>
<td class="head">Frecuencia Cardiaca: </td>
<td class="formulario" ><input name="freqcard" type="text" class="textbox" id="freqcard" size="10"  value="<?=$freqcard?>" disabled></td>
<td class="formulario">&nbsp;</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="head">Frecuencia Respiratoria: </td>
<td class="formulario" ><input name="freqresp" type="text" class="textbox" id="freqresp" size="10"  value="<?=$freqresp?>" disabled></td>
<td class="formulario">&nbsp;</td>
<td class="head">Peso:</td>
<td class="formulario" ><input name="peso" type="text" class="textbox" id="peso" size="10"  value="<?=$peso?>" disabled></td>
<td class="formulario">&nbsp;</td>
<td class="head">Talla:</td>
<td class="formulario" ><input name="talla" type="text" class="textbox" id="talla" size="10"  value="<?=$talla?>" disabled></td>
<td class="formulario">&nbsp;</td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td  class="formulario" colspan="2" class="head"><div align="center">Aspecto General del Paciente</div></td>
</tr>
<tr>
<td class="formulario"><textarea name="aspecto" class="textbox" id="aspecto" disabled><?=$aspecto?></textarea></td>
<td class="formulario" class="ayuda">&nbsp; </td>
</tr>
<table cellspacing="0" width="600" border="1">
<tr>
<td class="head">ECG</td>
<td class="formulario"><a href="download.php?id=<?=$hecg?>&amp;f=1&amp;idexamen=<?=$id?>" title="Descargar ECG">Descargar ECG</a></td>
</tr>
</table>
<table cellspacing="0" width="600" border="1">
<tr>
<td  class="formulario"><p align="center">
  <input type="button" class="button" name="Submit2" value="Cerrar" onClick="window.parent.hidePopWin(true,'0','0','0','examen');">
</p>
</td>
</tr>
</table>
</form>

