<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<title>.::Insertar Imagen::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../estilos.css">
<link REL="shortcut icon" HREF="Imagenes/logo.ico" TYPE="image/x-icon">
<script type="text/javascript" src="funciones.js"></script>
</head>
<body>
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
	include ("../../datos/datos.php");
	$hpaciente = "".$_POST["hpaciente"]."";
	$tensarte = "".$_POST["tensarte"]."";
	$freqcard = "".$_POST["freqcard"]."";
	$freqresp = "".$_POST["freqresp"]."";
	$peso = "".$_POST["peso"]."";
	$talla = "".$_POST["talla"]."";
	$aspecto = "".$_POST["aspecto"]."";
	$hrxtorax = "".$_POST["hrxtorax"]."";
	$hecg = "".$_POST["hecg"]."";
	$fecha=time();
	$id=$fecha.$hpaciente;

	if (empty($RXTORAX)){
		$RXTORAX=0;
	}
	if (empty($ECG)){
		$ECG=0;
	}	
	if ($hrxtorax==1){
		$typerx = $_FILES["archrxtorax"]["type"];
		$sizerx = $_FILES["archrxtorax"]["size"];
		$tamrxenkb=round($sizerx/1024);
		if ($tamrxenkb<2000){
		$tmp_namerx = $_FILES["archrxtorax"]["tmp_name"];
		$nombrerx = basename($_FILES["archrxtorax"]["name"]);
				if (($typerx=="image/gif") or  ($typerx=="image/jpeg") or ($typerx=="image/png")){
					if ($nombrerx != "") {
						if ($typerx=="image/gif"){
							$destinorx =  "../../Imagenes/rx/".$id.".gif";
						}
						if ($typerx=="image/jpeg"){
							$destinorx =  "../../Imagenes/rx/".$id.".jpg";
						}
						if ($typerx=="image/png"){
							$destinorx =  "../../Imagenes/rx/".$id.".png";
						}
						if (copy($tmp_namerx,$destinorx)) {
							$RXTORAX=1;
						}
					else {
						$RXTORAX=2;
					}
				}
				else {
					$RXTORAX=4;
				}
			}
			else {
				$RXTORAX=3;
			}
		}
		else {
		$RXTORAX=5;		
		}
	}
	if ($hecg==1){
		$typeecg = $_FILES["arhecg"]["type"];
		$sizeecg = $_FILES["arhecg"]["size"];
		$nombreecg = basename($_FILES["arhecg"]["name"]);
		$tamecgenkb=round($sizeecg/1024);
		if ($tamecgenkb<2000){
		$tmp_nameecg = $_FILES["arhecg"]["tmp_name"];
			if (($typeecg=="image/gif") or  ($typeecg=="image/jpeg") or ($typeecg=="image/png")){
				if ($nombreecg != "") {
					if ($typeecg=="image/gif"){
						$destinoecg =  "../../Imagenes/ecg/".$id.".gif";
					}
					if ($typeecg=="image/jpeg"){
						$destinoecg =  "../../Imagenes/ecg/".$id.".jpg";
					}
					if ($typeecg=="image/png"){
						$destinoecg =  "../../Imagenes/ecg/".$id.".png";
					}
					if (copy($tmp_nameecg,$destinoecg)) {
						$ECG=1;
					}
					else {
					$ECG=2;
					}
				}
				else {
				$ECG=4;
				}
			}
			else {
			$ECG=3;
			}
		}
		else {
		$ECG=5;
		}
	}
	if (empty($hantecedentes)){
		$hantecedentes="null";
	}
	if (empty($hhabitos)){
		$hhabitos="null";
	}	
	if(empty($resultado)){
	$resultado="";
	}
	if (($RXTORAX==1) and ($ECG==1)){
		$hhistoria=insertHistoria($hpaciente, $hantecedentes, $hhabitos);
		$sql1=insertRXTorax($id,$hpaciente,$id,$typerx,$sizerx);
		$sql2=insertECG($id,$hpaciente,$id,$typeecg,$sizeecg);
		$examen=insertExamen($hhistoria,$tensarte,$freqcard,$freqresp,$peso,$talla,$aspecto,$hrxtorax,$hecg,$id,$id);
		$resultado.="<form id=\"formulario\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td width=\"43\"><img src=\"../../Imagenes/examen.png\" width=\"33\" height=\"32\"></td>";
		$resultado.="<td width=\"601\" class=\"titulo_form\">FICHA EXAMEN FISICO </td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">Tensi&oacute;n Arterial: </td>";
		$resultado.="<td><input name=\"tensarte\" type=\"text\" class=\"textbox\" id=\"tensarte\" size=\"10\" disabled value=\"$tensarte\">";
		$resultado.="</td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Frecuencia Cardiaca: </td>";
		$resultado.="<td><input name=\"freqcard\" type=\"text\" class=\"textbox\" id=\"freqcard\" size=\"10\" disabled value=\"$freqcard\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">Frecuencia Respiratoria: </td>";
		$resultado.="<td><input name=\"freqresp\" type=\"text\" class=\"textbox\" id=\"freqresp\" size=\"10\" disabled value=\"$freqresp\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Peso:</td>";
		$resultado.="<td><input name=\"peso\" type=\"text\" class=\"textbox\" id=\"peso\" size=\"10\" disabled value=\"$peso\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Talla:</td>";
		$resultado.="<td><input name=\"talla\" type=\"text\" class=\"textbox\" id=\"talla\" size=\"10\" disabled value=\"$talla\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td colspan=\"2\" class=\"head\"><div align=\"center\">Aspecto General del Paciente</div></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td><textarea name=\"aspecto\" class=\"textbox\" id=\"aspecto\" disabled>$aspecto</textarea></td>";
		$resultado.="<td class=\"ayuda\">&nbsp; </td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">RX Torax</td>";
		$resultado.="<td><img src=\"$destinorx\" width=\"465\" height=\"59\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">ECG</td>";
		$resultado.="<td><img src=\"$destinoecg\" width=\"465\" height=\"59\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Se ha insertado el registro correctamente!!! </p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/ok.gif\" width=\"33\" height=\"44\"></p><p align=\"center\">";
		$resultado.="<input type=\"button\" name=\"Submit2\" value=\"Enviar\" onClick=\"DevolverImagen('$id','$examen')\">";
		$resultado.="</p></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="</form>";	
	}
	if (($RXTORAX==0) and ($ECG==1)){
		$hhistoria=insertHistoria($hpaciente, $hantecedentes, $hhabitos);
		$examen=insertExamen($hhistoria,$tensarte,$freqcard,$freqresp,$peso,$talla,$aspecto,$hrxtorax,$hecg,$id,$id);
		$sql2=insertECG($id,$hpaciente,$id,$typeecg,$sizeecg);
		$resultado.="<form id=\"formulario\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td width=\"43\"><img src=\"../../Imagenes/examen.png\" width=\"33\" height=\"32\"></td>";
		$resultado.="<td width=\"601\" class=\"titulo_form\">FICHA EXAMEN FISICO </td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">Tensi&oacute;n Arterial: </td>";
		$resultado.="<td><input name=\"tensarte\" type=\"text\" class=\"textbox\" id=\"tensarte\" size=\"10\" disabled value=\"$tensarte\">";
		$resultado.="</td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Frecuencia Cardiaca: </td>";
		$resultado.="<td><input name=\"freqcard\" type=\"text\" class=\"textbox\" id=\"freqcard\" size=\"10\" disabled value=\"$freqcard\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">Frecuencia Respiratoria: </td>";
		$resultado.="<td><input name=\"freqresp\" type=\"text\" class=\"textbox\" id=\"freqresp\" size=\"10\" disabled value=\"$freqresp\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Peso:</td>";
		$resultado.="<td><input name=\"peso\" type=\"text\" class=\"textbox\" id=\"peso\" size=\"10\" disabled value=\"$peso\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="<td class=\"head\">Talla:</td>";
		$resultado.="<td><input name=\"talla\" type=\"text\" class=\"textbox\" id=\"talla\" size=\"10\" disabled value=\"$talla\"></td>";
		$resultado.="<td class=\"ayuda\">&nbsp;</td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td colspan=\"2\" class=\"head\"><div align=\"center\">Aspecto General del Paciente</div></td>";
		$resultado.="</tr>";
		$resultado.="<tr>";
		$resultado.="<td><textarea name=\"aspecto\" class=\"textbox\" id=\"aspecto\" disabled></textarea></td>";
		$resultado.="<td class=\"ayuda\">&nbsp; </td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"head\">ECG</td>";
		$resultado.="<td><img src=\"$destinoecg\" width=\"465\" height=\"59\"></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Se ha insertado el registro correctamente!!! </p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/ok.gif\" width=\"33\" height=\"44\"></p><p align=\"center\">";
		$resultado.="<input type=\"button\" name=\"Submit2\" value=\"Enviar\" onClick=\"DevolverImagen('$id','$examen')\">";
		$resultado.="</p></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="</form>";	
	}
	if (($RXTORAX==2) or ($ECG==2)){
		$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
		$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
		$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
		$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
		$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
		$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Error no han podido guardarse las imagenes!!!</p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
		$resultado.="<p align=\"center\">";
		$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
		$resultado.="</p></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="</form>";
	}
	if (($RXTORAX==3) or ($ECG==3)){
		$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
		$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
		$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
		$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
		$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
		$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Error tipo de archivo incorrecto! Solo permite formatos (.gif) (.jpg) (.png)</p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
		$resultado.="<p align=\"center\">";
		$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
		$resultado.="</p></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="</form>";
	}
	if (($RXTORAX==4)  or ($ECG==4)){
		$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
		$resultado.="<input type=\"hidden\" id=\"hpaciente\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
		$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
		$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
		$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
		$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Error no ha seleccionado ningun archivo!!</p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
		$resultado.="<p align=\"center\">";
		$resultado.="<input type=\"submit\" name=\"Submit\" value=\"Enviar\">";
		$resultado.="</p></td>";
		$resultado.="</tr>";
		$resultado.="</table>";
		$resultado.="</form>";
	}
	if (($RXTORAX==5)  or ($ECG==5)){
		$resultado.="<form name=\"formulario\" method=\"post\" action=\"examen.php\">";
		$resultado.="<input type=\"hidden\" name=\"hpaciente\" value=\"$hpaciente\"><input type=\"hidden\" name=\"tensarte\" value=\"$tensarte\">";
		$resultado.="<input type=\"hidden\" name=\"freqcard\" value=\"$freqcard\"><input type=\"hidden\" name=\"freqresp\" value=\"$freqresp\">";
		$resultado.="<input type=\"hidden\" name=\"peso\" value=\"$peso\"><input type=\"hidden\" name=\"talla\" value=\"$talla\">";
		$resultado.="<input type=\"hidden\" name=\"aspecto\" value=\"$aspecto\"><input type=\"hidden\" name=\"hrxtorax\" value=\"$hrxtorax\">";
		$resultado.="<input type=\"hidden\" name=\"hecg\" value=\"$hecg\">";
		$resultado.="<table width=\"660\" border=\"1\">";
		$resultado.="<tr>";
		$resultado.="<td class=\"titulo_form\"><p align=\"center\">Error el tamaño del archivo no debe ser mayor a 2 Mbytes!!</p>";
		$resultado.="<p align=\"center\"><img src=\"../../Imagenes/error.gif\" width=\"32\" height=\"32\"> </p>";
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