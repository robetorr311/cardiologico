<?php
$csolicitud=pg_connect("host=localhost dbname=solicitud user=postgres password=rt988311");
if (!$csolicitud) {
echo "<center>Problemas con la Conexi�n</center>";
exit();
}
?>
