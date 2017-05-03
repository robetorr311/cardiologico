<?php
$conexion=pg_connect("host=localhost dbname=cardiologico user=cardiologico password=c4rd1olog1co");
if (!$conexion) {
echo "<center>Problemas con la Conexión</center>";
exit();
}
?>
