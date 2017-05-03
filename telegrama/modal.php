<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.::Ubicacion Geografica::.</title>
<link rel="stylesheet" type="text/css" href="../cardiologico/estilos.css">
<script type="text/javascript" src="funciones.js"></script>
</head>
	<body>
	<form id="modal">
		<table width="400">
			<tbody>
			<tr>
					<td class="label">Municipios</td>
					<td><div id="demoIzq">
					<?php
						include ("../cardiologico/datos/datos.php");
						$municipios=generaMunicipios();
						echo $municipios;
					?>
					</div></td>
					<td class="ayuda"><img src="../cardiologico/Imagenes/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Municipio')"></td>
				</tr>
				<tr>
				<td class="label">Parroquias</td>
				<td>
				<div id="demoDer">
					<select disabled="disabled" name="parroquia" id="parroquia">
						<option value="0">Selecciona opci&oacute;n...</option>
					</select>
				</div>					
					</td>
					<td class="ayuda"><img src="../cardiologico/Imagenes/ayuda.gif" alt="Ayuda" onmouseover="muestraAyuda(event, 'Parroquia')"></td>
				</tr>
		</table>
		<button id="botonCerrar" onClick="devubic()" type="button">Cerrar</button>
	</form>
	</body>
</html>