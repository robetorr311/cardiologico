<?php
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
	$hantecedentes="null";
	$hhabitos="null";
	include("../../datos/datos.php");
	$idpaciente=insertPacientes($cedula,$nombre,$edad,$sexo,$telefono,$correo,$direccion,$sector);
	$hhistoria=insertHistoria($idpaciente, $hantecedentes, $hhabitos);
	$hhabitos=insertHabitos($hhistoria,$tabaco,$alcohol,$ejercicio,$alimentacion);
	$hantecedentes=insertAntecedentes($hhistoria,$personales,$familiares);
	updateHistoria($hhistoria,$hhabitos,$hantecedentes);
	include ("insert.php");
?>