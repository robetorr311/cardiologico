<?php
			include("../cardiologico/datos/datos.php");
			$hmedico="".$_POST['hmedico']."";
			$datos=mensajeriapendientecardiologico($hmedico);
			echo $datos;
?>