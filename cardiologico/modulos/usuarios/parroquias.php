<?php
$id="".$_POST['municipio']."";
include("../../datos/datos.php");
$resultado.="<table width=\"660\" border=\"1\">";
$resultado.="<tr>";
$resultado.="<td class=\"head\">Parroquia:</td>";
$resultado.="<td><select name=\"parroquia\" id=\"parroquia\" onChange=\"verSectores()\">";
$resultado.="<option value=\"xx\">Seleccione una Parroquia</option>";
$resultado.=Parroquias($id);
$resultado.="</select></td>";
$resultado.="<td class=\"ayuda\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Parroquia')\" ></td>";
$resultado.="</tr>";
$resultado.="</table>";
echo $resultado;
?>