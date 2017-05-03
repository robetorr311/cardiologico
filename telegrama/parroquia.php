<?php
$selectDestino=$_GET["select"]; 
$opcionSeleccionada=$_GET["opcion"];
include '../cardiologico/datos/datos.php';
$parroquias=generaParroquias($opcionSeleccionada);
echo $parroquias;
?>