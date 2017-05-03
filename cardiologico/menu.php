<?php
	include("datos/datos.php");
	session_start();	
	$log= "".$_SESSION['login']."";
	$pwd= "".$_SESSION['password']."";
	$tipo=buscarNivel($log,$pwd);
	if ($tipo==1){
		$nivel1= array("Codificadores","Estadisticas","Herramientas","Consultas");
		$nivel2=array("Registro de Pacientes","Registro de Establecimientos","Registro de Medicos","Usuarios de Sistema","Usuarios Registrados","Sala de Chat","Foros","Historia Medica de Pacientes", "Registro de Sectores");
		require_once('HTML_TreeMenu-1.2.0/TreeMenu.php');
		$icon         = 'folder.gif';
		$menu    = '../../Imagenes/menu.png';
		$pacientes    = '../../Imagenes/pacientes.png';
		$medicos    = '../../Imagenes/medicos.png';
		$establecimientos    = '../../Imagenes/establecimientos.png';
		$usuarios    = '../../Imagenes/usuarios.png';
		$codificadores    = '../../Imagenes/codificadores.png';
		$estadisticas    = '../../Imagenes/estadisticas.png';
		$herramientas    = '../../Imagenes/herramientas.png';
		$consultas    = '../../Imagenes/consultas.png';
		$historia    = '../../Imagenes/historia.png';
		$chat    = '../../Imagenes/chat.png';
		$foro    = '../../Imagenes/foro.png';
		$ubicacion    = '../../Imagenes/ubicacion.gif';
		$expandedIcon = 'folder-expanded.gif';
		$menu  = new HTML_TreeMenu();
		$node1   = new HTML_TreeNode(array('text' => "Menu", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('foo'); return false", 'onexpand' => "alert('Expanded')"));
		$nivel1_1 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[0], 'icon' => $codificadores, 'expandedIcon' => $codificadores)));
		$nivel1_2 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[1], 'icon' => $estadisticas, 'expandedIcon' => $estadisticas)));
		$nivel1_3 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[2], 'icon' => $herramientas, 'expandedIcon' => $herramientas)));
		$nivel1_4 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[3], 'icon' => $consultas, 'expandedIcon' => $consultas)));
		$nivel2_1 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[0], 'link' => "modulos/pacientes/", 'icon' => $pacientes, 'expandedIcon' => $expandedIcon)));
		$nivel2_2 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[1], 'link' => "modulos/establecimientos/", 'icon' => $establecimientos, 'expandedIcon' => $expandedIcon)));
		$nivel2_3 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[2], 'link' => "modulos/medicos/", 'icon' => $medicos, 'expandedIcon' => $expandedIcon)));
		$nivel2_4 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[3], 'link' => "modulos/usuarios/", 'icon' => $usuarios, 'expandedIcon' => $expandedIcon)));
		$nivel2_4 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[4], 'link' => "modulos/registrarse/", 'icon' => $usuarios, 'expandedIcon' => $expandedIcon)));
		$nivel2_5 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[5], 'link' => "modulos/chat/", 'icon' => $chat, 'expandedIcon' => $expandedIcon)));
		$nivel2_6 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[6], 'link' => "modulos/foro/", 'icon' => $foro, 'expandedIcon' => $expandedIcon)));
		$nivel2_7 = &$nivel1_4->addItem(new HTML_TreeNode(array('text' => $nivel2[7], 'link' => "modulos/consulta/historia/", 'icon' => $historia, 'expandedIcon' => $expandedIcon)));
		$nivel2_8 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[8], 'link' => "modulos/ubicacion/", 'icon' => $ubicacion, 'expandedIcon' => $expandedIcon)));
	}
	if ($tipo==2){
		$nivel1= array("Codificadores","Estadisticas","Herramientas","Consultas");
		$nivel2=array("Registro de Pacientes","Registro de Establecimientos","Registro de Medicos","Usuarios de Sistema","Usuarios Registrados","Sala de Chat","Foros","Historia Medica de Pacientes", "Registro de Sectores");
		require_once('HTML_TreeMenu-1.2.0/TreeMenu.php');
		$icon         = 'folder.gif';
		$menu    = '../../Imagenes/menu.png';
		$pacientes    = '../../Imagenes/pacientes.png';
		$medicos    = '../../Imagenes/medicos.png';
		$establecimientos    = '../../Imagenes/establecimientos.png';
		$usuarios    = '../../Imagenes/usuarios.png';
		$codificadores    = '../../Imagenes/codificadores.png';
		$estadisticas    = '../../Imagenes/estadisticas.png';
		$herramientas    = '../../Imagenes/herramientas.png';
		$consultas    = '../../Imagenes/consultas.png';
		$historia    = '../../Imagenes/historia.png';
		$chat    = '../../Imagenes/chat.png';
		$foro    = '../../Imagenes/foro.png';
		$ubicacion    = '../../Imagenes/ubicacion.gif';
		$expandedIcon = 'folder-expanded.gif';
		$menu  = new HTML_TreeMenu();
		$node1   = new HTML_TreeNode(array('text' => "Menu", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('foo'); return false", 'onexpand' => "alert('Expanded')"));
		$nivel1_1 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[0], 'icon' => $codificadores, 'expandedIcon' => $codificadores)));
		$nivel1_2 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[1], 'icon' => $estadisticas, 'expandedIcon' => $estadisticas)));
		$nivel1_3 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[2], 'icon' => $herramientas, 'expandedIcon' => $herramientas)));
		$nivel1_4 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[3], 'icon' => $consultas, 'expandedIcon' => $consultas)));
		$nivel2_1 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[0], 'link' => "modulos/pacientes/", 'icon' => $pacientes, 'expandedIcon' => $expandedIcon)));
		$nivel2_2 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[1], 'link' => "modulos/establecimientos/", 'icon' => $establecimientos, 'expandedIcon' => $expandedIcon)));
		$nivel2_3 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[2], 'link' => "modulos/medicos/", 'icon' => $medicos, 'expandedIcon' => $expandedIcon)));
		$nivel2_5 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[5], 'link' => "modulos/chat/", 'icon' => $chat, 'expandedIcon' => $expandedIcon)));
		$nivel2_7 = &$nivel1_4->addItem(new HTML_TreeNode(array('text' => $nivel2[7], 'link' => "modulos/consulta/historia/", 'icon' => $historia, 'expandedIcon' => $expandedIcon)));
		$nivel2_8 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[8], 'link' => "modulos/ubicacion/", 'icon' => $ubicacion, 'expandedIcon' => $expandedIcon)));
	}
	if ($tipo==3){
		$nivel1= array("Codificadores","Estadisticas","Herramientas","Consultas");
		$nivel2=array("Registro de Pacientes","Registro de Establecimientos","Registro de Medicos","Usuarios de Sistema","Usuarios Registrados","Sala de Chat","Foros","Historia Medica de Pacientes", "Registro de Sectores");
		require_once('HTML_TreeMenu-1.2.0/TreeMenu.php');
		$icon         = 'folder.gif';
		$menu    = '../../Imagenes/menu.png';
		$pacientes    = '../../Imagenes/pacientes.png';
		$medicos    = '../../Imagenes/medicos.png';
		$establecimientos    = '../../Imagenes/establecimientos.png';
		$usuarios    = '../../Imagenes/usuarios.png';
		$codificadores    = '../../Imagenes/codificadores.png';
		$estadisticas    = '../../Imagenes/estadisticas.png';
		$herramientas    = '../../Imagenes/herramientas.png';
		$consultas    = '../../Imagenes/consultas.png';
		$historia    = '../../Imagenes/historia.png';
		$chat    = '../../Imagenes/chat.png';
		$foro    = '../../Imagenes/foro.png';
		$ubicacion    = '../../Imagenes/ubicacion.gif';
		$expandedIcon = 'folder-expanded.gif';
		$menu  = new HTML_TreeMenu();
		$node1   = new HTML_TreeNode(array('text' => "Menu", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('foo'); return false", 'onexpand' => "alert('Expanded')"));
		$nivel1_1 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[0], 'icon' => $codificadores, 'expandedIcon' => $codificadores)));
		$nivel1_2 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[1], 'icon' => $estadisticas, 'expandedIcon' => $estadisticas)));
		$nivel1_3 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[2], 'icon' => $herramientas, 'expandedIcon' => $herramientas)));
		$nivel1_4 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[3], 'icon' => $consultas, 'expandedIcon' => $consultas)));
		$nivel2_1 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[0], 'link' => "modulos/pacientes/", 'icon' => $pacientes, 'expandedIcon' => $expandedIcon)));
		$nivel2_3 = &$nivel1_1->addItem(new HTML_TreeNode(array('text' => $nivel2[2], 'link' => "modulos/medicos/", 'icon' => $medicos, 'expandedIcon' => $expandedIcon)));
		$nivel2_5 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[5], 'link' => "modulos/chat/", 'icon' => $chat, 'expandedIcon' => $expandedIcon)));
		$nivel2_7 = &$nivel1_4->addItem(new HTML_TreeNode(array('text' => $nivel2[7], 'link' => "modulos/consulta/historia/", 'icon' => $historia, 'expandedIcon' => $expandedIcon)));
	}
	if ($tipo==4){
		$nivel1= array("Codificadores","Estadisticas","Herramientas","Consultas");
		$nivel2=array("Registro de Pacientes","Registro de Establecimientos","Registro de Medicos","Usuarios de Sistema","Usuarios Registrados","Sala de Chat","Foros","Historia Medica de Pacientes", "Registro de Sectores");
		require_once('HTML_TreeMenu-1.2.0/TreeMenu.php');
		$icon         = 'folder.gif';
		$menu    = '../../Imagenes/menu.png';
		$pacientes    = '../../Imagenes/pacientes.png';
		$medicos    = '../../Imagenes/medicos.png';
		$establecimientos    = '../../Imagenes/establecimientos.png';
		$usuarios    = '../../Imagenes/usuarios.png';
		$codificadores    = '../../Imagenes/codificadores.png';
		$estadisticas    = '../../Imagenes/estadisticas.png';
		$herramientas    = '../../Imagenes/herramientas.png';
		$consultas    = '../../Imagenes/consultas.png';
		$historia    = '../../Imagenes/historia.png';
		$chat    = '../../Imagenes/chat.png';
		$foro    = '../../Imagenes/foro.png';
		$ubicacion    = '../../Imagenes/ubicacion.gif';
		$expandedIcon = 'folder-expanded.gif';
		$menu  = new HTML_TreeMenu();
		$node1   = new HTML_TreeNode(array('text' => "Menu", 'icon' => $icon, 'expandedIcon' => $expandedIcon, 'expanded' => true), array('onclick' => "alert('foo'); return false", 'onexpand' => "alert('Expanded')"));
		$nivel1_3 = &$node1->addItem(new HTML_TreeNode(array('text' => $nivel1[2], 'icon' => $herramientas, 'expandedIcon' => $herramientas)));
		$nivel2_5 = &$nivel1_3->addItem(new HTML_TreeNode(array('text' => $nivel2[4], 'link' => "modulos/chat/", 'icon' => $chat, 'expandedIcon' => $expandedIcon)));
	}	
	$menu->addItem($node1);
    $treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => 'HTML_TreeMenu-1.2.0/images', 'defaultClass' => 'treeMenuDefault'));
?>
<html>
<head>

    <script src="HTML_TreeMenu-1.2.0/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
    <link href="estilos/Site.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="adios.js"></script>
</head>
<body>
<form id="formulario">
<script language="JavaScript" type="text/javascript">
<!--
    a = new Date();
    a = a.getTime();
//-->
</script>

<?php $treeMenu->printMenu(); ?><br /><br />
<img src="Imagenes/salir.png" onClick="finalizarSession();"></img>
</form>
</body>
</html>
