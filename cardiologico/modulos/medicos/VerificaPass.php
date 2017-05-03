<?php
	$password="".$_POST['password']."";
	$password2="".$_POST['password2']."";	
	if ($password==$password2){
	$i=1;
	}
	else {
	$i=0;
	}
	echo $i;
?>