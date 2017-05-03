<?php
$selectDestino=$_GET["select"]; 
$opcionSeleccionada=$_GET["opcion"];
include '../../datos/datos.php';
$parroquias=generaParroquias($opcionSeleccionada);
echo $parroquias;
?>