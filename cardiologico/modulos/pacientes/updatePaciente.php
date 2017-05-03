<?php
	$id="".$_POST['id']."";
	$cedula="".$_POST['cedula']."";
	$nombre="".$_POST['nombre']."";
	$edad="".$_POST['edad']."";
	$sexo="".$_POST['sexo']."";
	$telefono="".$_POST['telefono']."";
	$correo="".$_POST['correo']."";
	$direccion="".$_POST['direccion']."";
	$sector="".$_POST['sector']."";
	$personales="".$_POST['personales']."";
	$familiares="".$_POST['familiares']."";
	$tabaco="".$_POST['tabaco']."";
	$alcohol="".$_POST['alcohol']."";
	$ejercicio="".$_POST['ejercicio']."";
	$alimentacion="".$_POST['alimentacion']."";
	include("../../datos/datos.php");
	updatePacientes($id,$cedula,$nombre,$edad,$sexo,$telefono,$direccion,$sector,$correo);
	$datoshistoria=buscarHistoria($id);
	$hhistoria=$datoshistoria[0];
	$hantecedentes=$datoshistoria[2];
	$hhabitos=$datoshistoria[3];
	if (empty($hhistoria) or ($hhistoria==0)){
		$hhistoria=insertHistoria($id, $hantecedentes, $hhabitos);
		$hhabitos=insertHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion);
		$hantecedentes=insertAntecedentes($hhistoria,$personales,$familiares);
		updateHistoria($hhistoria,$hhabitos,$hantecedentes);	
	}
	else {
		if (empty($hantecedentes) or ($hantecedentes==0)){
			$hantecedentes=insertAntecedentes($hhistoria,$personales,$familiares);
		}
		else {
			updateAntecedentes($hhistoria,$personales,$familiares);
		}
		if (empty($hhabitos) or ($hhabitos==0)){
			$hhabitos=insertHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion);
		}
		else {
			updateHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion);
		}
		updateHistoria($hhistoria,$hhabitos,$hantecedentes);
	}
	include ("update.php");
?>