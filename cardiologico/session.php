<?php
$session = (isset($_SESSION["activa"]) || ($_SESSION["activa"]==0)) ? true : false;
if ($session){
	echo "true";
}
else {
	echo "false";
}
?>