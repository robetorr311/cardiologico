<?php
$postback = (isset($_POST["loggin"])) ? true : false;
$postback2 = (isset($_POST["login"])&&(isset($_POST["password"]))) ? true : false;
include("../cardiologico/datos/datos.php");
session_start();
if (!$postback){
	if (!isset($_SESSION['login']) && (!isset($_SESSION["k"])) && (!$postback2)) {
		$_SESSION['k']=1;
		require ("loggin.php");
		exit();	
	}
	else {
		if ((!isset($_POST['login'])) && (!isset($_POST['password'])) && (!isset($_SESSION["k"]))) {
			require ("loggin.php");
			exit();	
		}
		else {
			if ($postback2){
				$log= "".$_POST['login']."";
				$pwd= "".$_POST['password']."";
				$reg=buscarPassword($log,$pwd);
				if ($reg==0){
					require ("error.php");
					exit();
				}
				else {
						$_SESSION['login']=$log;
						$_SESSION['password']=$pwd;	
						$_SESSION['activa']=1;
						ActualizarmensajeOtrodia();
						include("telegrama.php");	
				}			
			}
			else {
				if (!isset($_SESSION['login'])) {
					$_SESSION['k']=1;
					require ("loggin.php");
					exit();	
				}
				else {
					$log= "".$_SESSION['login']."";
					$pwd= "".$_SESSION['password']."";
					$reg=buscarPassword($log,$pwd);
					if ($reg==0){
						require ("error.php");
						exit();
					}
					else {
							$_SESSION['login']=$log;
							$_SESSION['password']=$pwd;	
							$_SESSION['activa']=1;
							ActualizarmensajeOtrodia();
							include("telegrama.php");	
					}			
				}
			}	
		}
	}
	
}
else {
	unset($_SESSION["activa"]);
	header("Location: loggout.php", TRUE, 301); 
	exit();	
}






/*session_start();
if (isset($_POST['loggin'])){
	unset($_SESSION["activa"]);
	header("Location: loggout.php", TRUE, 301); 
	exit();	
}
else {
	if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
		require ("loggin.php");
		exit();	
	}
	else {
		include("../cardiologico/datos/datos.php");
		$log= "".$_POST['login']."";
		$pwd= "".$_POST['password']."";
		$reg=buscarPassword($log,$pwd);
		if ($reg==0){
			require ("error.php");
			exit();
		}
		else {
				$_SESSION['login']=$log;
				$_SESSION['password']=$pwd;	
				$_SESSION['activa']=1;				
				ActualizarmensajeOtrodia();
				include("telegrama.php");	
		}
	
	}
}*/
/*
session_start();
if (isset($_POST['loggin']) && ($_SESSION["activa"]==0)){
	$_SESSION["activa"]=0;
	header('HTTP/1.0 401 Unauthorized');
	header("Location: loggout.php", TRUE, 301); 
	exit();	
}
if (!isset($_SERVER['PHP_AUTH_USER'])){
	header('WWW-Authenticate: Basic realm=" Zona Restringida "');
	header('HTTP/1.0 401 Unauthorized');
	$_SESSION["activa"]=1;	
	require ("error.php");
	exit();
}
else {
	include("../cardiologico/datos/datos.php");
	$log= "{$_SERVER['PHP_AUTH_USER']}";
	$pwd= "{$_SERVER['PHP_AUTH_PW']}";
	$reg=buscarPassword($log,$pwd);
	if ($reg==0){
		header('WWW-Authenticate: Basic realm=" Zona Restringida "');
		header('HTTP/1.0 401 Unauthorized');
		require ("error.php");
		exit();
	}
	else {
			$_SESSION['login']=$log;
			$_SESSION['password']=$pwd;	
			$_SESSION['activa']=1;	
			ActualizarmensajeOtrodia();
			include("telegrama.php");
	}
}*/
?>