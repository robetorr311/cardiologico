<?php
	echo "<form id=\"formulario\">";
			include("datos/datos.php");
			$datos=telegramasPendientes();
			echo $datos;
	echo "</form>";
?>