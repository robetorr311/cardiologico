<?php
$id="".$_POST['parroquia']."";
include("../../datos/datos.php");
$resultado.="<table width=\"660\" border=\"1\">";
$resultado.="<tr>";
$resultado.="<td class=\"head\">Sector:</td>";
$resultado.="<td><select name=\"sector\" id=\"sector\">";
$resultado.="<option value=\"xx\">Seleccione un Sector</option>";
$resultado.=Sectores($id);
$resultado.="</select></td>";
$resultado.="<td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Sectores')\" ></td>";
$resultado.="</tr>";
$resultado.="</table>";
echo $resultado;
?>