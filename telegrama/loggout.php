<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>.::TELEGRAMA::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../cardiologico/estilos/Site.css">
<script type="text/javascript">
function logout() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
    }
    // code for IE
    else if (window.ActiveXObject) {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (window.ActiveXObject) {
      // IE clear HTTP Authentication
      document.execCommand("ClearAuthenticationCache");
      window.location.href='index.php';
    } else {
        xmlhttp.open("GET", '/path/that/will/return/200/OK', true, "logout", "logout");
        xmlhttp.send("");
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {window.location.href='index.php';}
        }


    }


    return false;
}
</script>
</head>
<body>
<center>
<div id="encab" width="*" height="90" class="encabezado">
	<img src="../cardiologico/Imagenes/encabezado.png"></img>
</div>	
<div id="transparencia">
	<div id="transparenciaMensaje"></div>
</div>
<p>
</p>
<p>&nbsp;</p>
<p><img src="../cardiologico/Imagenes/logo_fondo_n.png" width="199" height="200"></p>
<p>&nbsp;</p>
<p>SU CONEXION CON EL SISTEMA HA FINALIZADO </p>
<p>&nbsp;</p>
<form name="form1" method="post" action="index.php">
  <input type="button" name="Submit" class="button" value="FINALIZAR" onclick="logout();">
</form>
<p>&nbsp;</p>
</center>
</body>
</html>
