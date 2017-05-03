<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<title>.::Insertar Imagen::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../cardiologico/estilos/Site.css" rel="stylesheet" type="text/css">
<link REL="shortcut icon" HREF="../cardiologico/Imagenes/logo.ico" TYPE="image/x-icon">
<script type="text/javascript" src="funcionesexamen.js"></script>
</head>
<body>
<?php
	if (empty($hantecedentes)){
		$hantecedentes="null";
	}
	if (empty($hhabitos)){
		$hhabitos="null";
	}	
	if(empty($resultado)){
	$resultado="";
	}

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
	$hpaciente="0";
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
	include ("../cardiologico/datos/datos.php");
	$hpaciente = "".$_POST["hpaciente"]."";
	$tensarte = "".$_POST["tensarte"]."";
	$freqcard = "".$_POST["freqcard"]."";
	$freqresp = "".$_POST["freqresp"]."";
	$peso = "".$_POST["peso"]."";
	$talla = "".$_POST["talla"]."";
	$aspecto = "".$_POST["aspecto"]."";
	$typeecg = $_FILES["arhecg"]["type"];
	$sizeecg = $_FILES["arhecg"]["size"];

	$nombreecg = basename($_FILES["arhecg"]["name"]);
	$tamecgenkb=round($sizeecg/1024);
	$ext = strrchr($nombreecg,'.');
	$fecha=time();
	$id=$fecha.$hpaciente;
		if ($tamecgenkb<2000){
			$tmp_nameecg = $_FILES["arhecg"]["tmp_name"];
			$tmp_name = $_FILES["arhecg"]["tmp_name"];	
			$fp = fopen($tmp_name, "rb");
			$buffer = fread($fp, filesize($tmp_name));
			fclose($fp);
			if (($typeecg=="image/gif") or  ($typeecg=="image/jpeg") or ($typeecg=="image/png") or ($typeecg=="application/octet-stream")){
				if ($nombreecg != "") {
					if ($typeecg=="image/gif"){
						$destinoecg =  "../cardiologico/Imagenes/ecg/".$id.".gif";
					}
					if ($typeecg=="image/jpeg"){
						$destinoecg =  "../cardiologico/Imagenes/ecg/".$id.".jpg";
					}
					if ($typeecg=="image/png"){
						$destinoecg =  "../cardiologico/Imagenes/ecg/".$id.".png";
					}
					if (($typeecg=="application/octet-stream") and ($ext==".ctk")){
						$destinoecg =  "../cardiologico/datos/ctk/".$id.".ctk";
					}
					$idecg=finsertecg($hpaciente,$nombreecg,$typeecg,$sizeecg,$buffer);
					if ($idecg>0) {
						$datosHistoria=buscarHistoria($hpaciente);
						$hhistoria=$datosHistoria[0];
						if (empty($hhistoria) or ($hhistoria==0)){
							$hhistoria=insertHistoria($hpaciente, $hantecedentes, $hhabitos);
						}
						if (empty($hrxtorax)){
						$hrxtorax="null";
						}
						$examen=insertExamen($hhistoria,$tensarte,$freqcard,$freqresp,$peso,$talla,$aspecto,$hrxtorax,$idecg,$id,$idecg);
						$resultado.="<form id=\"formulario\">";
						$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
						$resultado.="<tr>";
						$resultado.="<td class=\"formulario\" width=\"43\"><img src=\"../cardiologico/Imagenes/examen.png\" width=\"33\" height=\"32\"></td>";
						$resultado.="<td class=\"formulario\" width=\"601\" >FICHA EXAMEN FISICO </td>";
						$resultado.="</tr>";
						$resultado.="</table>";
						$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
						$resultado.="<tr>";
						$resultado.="<td class=\"formulario\" >Tensi&oacute;n Arterial: </td>";
						$resultado.="<td  class=\"formulario\"><input name=\"tensarte\" type=\"text\" class=\"textbox\" id=\"tensarte\" size=\"10\" disabled value=\"$tensarte\">";
						$resultado.="</td>";
						$resultado.="<td  class=\"formulario\">&nbsp;</td>";
						$resultado.="<td class=\"formulario\" >Frecuencia Cardiaca: </td>";
						$resultado.="<td  class=\"formulario\"><input name=\"freqcard\" type=\"text\" class=\"textbox\" id=\"freqcard\" size=\"10\" disabled value=\"$freqcard\"></td>";
						$resultado.="<td  class=\"formulario\">&nbsp;</td>";
						$resultado.="</tr>";
						$resultado.="</table>";
						$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
						$resultado.="<tr>";
						$resultado.="<td class=\"formulario\" >Frecuencia Respiratoria: </td>";
						$resultado.="<td  class=\"formulario\"><input name=\"freqresp\" type=\"text\" class=\"textbox\" id=\"freqresp\" size=\"10\" disabled value=\"$freqresp\"></td>";
						$resultado.="<td  class=\"formulario\">&nbsp;</td>";
						$resultado.="<td class=\"formulario\" >Peso:</td>";
						$resultado.="<td  class=\"formulario\"><input name=\"peso\" type=\"text\" class=\"textbox\" id=\"peso\" size=\"10\" disabled value=\"$peso\"></td>";
						$resultado.="<td  class=\"formulario\">&nbsp;</td>";
						$resultado.="<td class=\"formulario\" >Talla:</td>";
						$resultado.="<td  class=\"formulario\"><input name=\"talla\" type=\"text\" class=\"textbox\" id=\"talla\" size=\"10\" disabled value=\"$talla\"></td>";
						$resultado.="<td  class=\"formulario\">&nbsp;</td>";
						$resultado.="</tr>";
						$resultado.="</table>";
						$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
						$resultado.="<tr>";
						$resultado.="<td class=\"formulario\" colspan=\"2\" ><div align=\"center\">Aspecto General del Paciente</div></td>";
						$resultado.="</tr>";
						$resultado.="<tr>";
						$resultado.="<td  class=\"formulario\"><textarea name=\"aspecto\" class=\"textbox\" id=\"aspecto\" disabled>$aspecto</textarea></td>";
						$resultado.="<td  class=\"formulario\">&nbsp; </td>";
						$resultado.="</tr>";
						$resultado.="</table>";
						if ($ext==".ctk"){
							$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
							$resultado.="<tr>";
							$resultado.="<td class=\"formulario\" ><p align=\"center\">Se ha insertado el registro correctamente!!! </p>";
							$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/ok.gif\" width=\"33\" height=\"44\"></p><p align=\"center\">";
							$resultado.="<input type=\"button\" class=\"button\" name=\"Submit2\" value=\"Enviar\" onClick=\"window.parent.hidePopWin(true, 'examen', '$idecg','$examen');\">";
							$resultado.="</p></td>";
							$resultado.="</tr>";
							$resultado.="</table>";
							$resultado.="</form>";						
						}
						else {
							$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
							$resultado.="<tr>";
							$resultado.="<td class=\"formulario\" >ECG</td>";
							$resultado.="<td  class=\"formulario\"><img src=\"$destinoecg\" width=\"465\" height=\"59\"></td>";
							$resultado.="</tr>";
							$resultado.="</table>";
							$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
							$resultado.="<tr>";
							$resultado.="<td class=\"formulario\" ><p align=\"center\">Se ha insertado el registro correctamente!!! </p>";
							$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/ok.gif\" width=\"33\" height=\"44\"></p><p align=\"center\">";
							$resultado.="<input type=\"button\" class=\"button\" name=\"Submit2\" value=\"Enviar\" onClick=\"window.parent.hidePopWin(true, 'examen', '$idecg','$examen');\">";
							$resultado.="</p></td>";
							$resultado.="</tr>";
							$resultado.="</table>";
							$resultado.="</form>";
							}
					}
					else {
						$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
						$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
						$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
						$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
						$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
						$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
						$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
						$resultado.="<tr>";
						$resultado.="<td class=\"formulario\" ><p align=\"center\">Error no han podido guardarse las imagenes!!!</p>";
						$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
						$resultado.="<p align=\"center\">";
						$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
						$resultado.="</p></td>";
						$resultado.="</tr>";
						$resultado.="</table>";
						$resultado.="</form>";
					}
				}
				else {
					$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
					$resultado.="<input type=\"hidden\" id=\"hpaciente\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
					$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
					$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
					$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
					$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
					$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
					$resultado.="<tr>";
					$resultado.="<td class=\"formulario\" ><p align=\"center\">Error no ha seleccionado ningun archivo!!</p>";
					$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
					$resultado.="<p align=\"center\">";
					$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
					$resultado.="</p></td>";
					$resultado.="</tr>";
					$resultado.="</table>";
					$resultado.="</form>";
				}
			}
			else {
				$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
				$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
				$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
				$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
				$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
				$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
				$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
				$resultado.="<tr>";
				$resultado.="<td class=\"formulario\" ><p align=\"center\">Error tipo de archivo incorrecto! Solo permite formatos (.gif) (.jpg) (.png)</p>";
				$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
				$resultado.="<p align=\"center\">";
				$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
				$resultado.="</p></td>";
				$resultado.="</tr>";
				$resultado.="</table>";
				$resultado.="</form>";
			}
		}
		else {
			$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
			$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
			$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
			$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
			$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
			$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
			$resultado.="<table cellspacing=\"0\"  width=\"660\" border=\"1\" cellspacing=\"0\">";
			$resultado.="<tr>";
			$resultado.="<td class=\"formulario\" ><p align=\"center\">Error el tamaño del archivo no debe ser mayor a 2 Mbytes!!</p>";
			$resultado.="<p align=\"center\"><img src=\"../cardiologico/Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
			$resultado.="<p align=\"center\">";
			$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
			$resultado.="</p></td>";
			$resultado.="</tr>";
			$resultado.="</table>";
			$resultado.="</form>";
		}
	echo $resultado;
?>
</body>
</html>