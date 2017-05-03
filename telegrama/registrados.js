// Variables para setear
onload=function(){
	cAyuda=document.getElementById("mensajesAyuda");
	cNombre=document.getElementById("ayudaTitulo");
	cTex=document.getElementById("ayudaTexto");
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	form=document.getElementById("formulario");
	urlDestino="insert.php";
	
	claseNormal="input";
	claseError="inputError";
	
	ayuda=new Array();
	ayuda["Cedula"]="Ingresa el numero de cedula del medico. OBLIGATORIO";
	ayuda["Nombre"]="Ingresa nombre y apellido del medico. OBLIGATORIO";
	ayuda["Edad"]="Indique la edad del medico.";
	ayuda["Sexo"]="Seleccione el sexo del medico";
	ayuda["Telefono"]="Indique el numero telefonico del medico";
	ayuda["Email"]="Indique el correo electronico del medico";
	ayuda["Direccion"]="Indique la direccion de domicilio del medico";	
	ayuda["Establecimiento"]="Selecciona el establecimiento al cual esta adscrito el medico.";
	ayuda["Devuelve"]="Haz Click para seleccionar el registro";
	ayuda["Eliminar"]="Haz Click para eliminar el registro";
	ayuda["Buscar"]="Haz Click para buscar registros";
	ayuda["Primeros"]="Haz Click para ver los primeros 6 registros";
	ayuda["Previo"]="Haz Click para ver los 6 registros anteriores";
	ayuda["Proximo"]="Haz Click para ver los proximos 6 registros";
	ayuda["Ultimos"]="Haz Click para ver los ultimos 6 registros";
	ayuda["Cerrar"]="Haz Click para cerrar la consulta";
	ayuda["Estado"]="Selecciona el estado donde se encuentra ubicado el  el domicilio del medico. OBLIGATORIO";
	ayuda["Municipio"]="Selecciona el municipio donde se encuentra ubicado el  el domicilio del medico. OBLIGATORIO";
	ayuda["Parroquia"]="Selecciona la parroquia donde se encuentra ubicado el  el domicilio del medico. OBLIGATORIO";
	ayuda["Sector"]="Selecciona el sector donde se encuentra ubicado el  el domicilio del medico. OBLIGATORIO";
	preCarga("../../Imagenes/ok.gif", "../../Imagenes/loading.gif", "../../Imagenes/error.gif");
}
function preCarga(){
	imagenes=new Array();
	for(i=0; i<arguments.length; i++)
	{
		imagenes[i]=document.createElement("img");
		imagenes[i].src=arguments[i];
	}
}
function nuevoAjax(){ 
	var xmlhttp=false; 
	try 
	{ 
		// No IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}
function comprueba(obj){
	if (isNaN(obj)){
		return false;
	}
	else {
		return true;
	}
} 
function consulta(){
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('consulta.php',id,'dialogWidth:550px;dialogHeight:300px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		var ajax=nuevoAjax();
		var divVerRegistro=document.getElementById("medicos");
		ajax.open("POST","registro.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+datosModal);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divVerRegistro.innerHTML=respuesta;
			}
		}
	}
}
function editRegistro(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idmedico.value;
	var divVerRegistro=document.getElementById("registro");
	ajax.open("POST","editRegistro.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+id);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divVerRegistro.innerHTML=respuesta;
		}
	}
}
function newRegistro(){
	var ajax=nuevoAjax();
	var divVerRegistro=document.getElementById("registro");
	ajax.open("POST","newRegistro.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divVerRegistro.innerHTML=respuesta;
		}
	}
}
function cerrar(){
	window.close();
}
function limpiaForm(){
	for(i=0; i<=4; i++)
	{
		form.elements[i].className=claseNormal;
	}
}
function eliminar(id){
	var answer = confirm("Desea eliminar el registro?")
	if (answer){
		var ajax=nuevoAjax();
		ajax.open("POST","eliminar.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id);
		ajax.onreadystatechange=function()
			{
				if (ajax.readyState==4)
				{
					var respuesta=ajax.responseText;
					if(respuesta=="OK")	alert("Se ha eliminado el registro");
				}
			}
	}
	else{
		alert ("No se ha eliminado ningun registro!!");
	}
}
function campoError(campo){
	campo.className=claseError;
	error=1;
}
function ocultaMensaje(){
	divTransparente.style.display="none";
}
function muestraMensaje(mensaje){
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}
function eliminaEspacios(cadena){
	// Funcion para eliminar espacios delante y detras de cada cadena
	while(cadena.charAt(cadena.length-1)==" ") cadena=cadena.substr(0, cadena.length-1);
	while(cadena.charAt(0)==" ") cadena=cadena.substr(1, cadena.length-1);
	return cadena;
}
function validaLongitud(valor, permiteVacio, minimo, maximo){
	var cantCar=valor.length;
	if(valor=="")
	{
		if(permiteVacio) return true;
		else return false;
	}
	else
	{
		if(cantCar>=minimo && cantCar<=maximo) return true;
		else return false;
	}
}
function validaCorreo(valor){
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}$)/;
	if(reg.test(valor)) return true;
	else return false;
}
// Mensajes de ayuda
if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
else navegador=1;
function colocaAyuda(event){
	if(navegador==0)
	{
		var corX=window.event.clientX+document.documentElement.scrollLeft;
		var corY=window.event.clientY+document.documentElement.scrollTop;
	}
	else
	{
		var corX=event.clientX+window.scrollX;
		var corY=event.clientY+window.scrollY;
	}
	cAyuda.style.top=corY+20+"px";
	cAyuda.style.left=corX+15+"px";
}
function ocultaAyuda(){
	cAyuda.style.display="none";
	if(navegador==0) 
	{
		document.detachEvent("onmousemove", colocaAyuda);
		document.detachEvent("onmouseout", ocultaAyuda);
	}
	else 
	{
		document.removeEventListener("mousemove", colocaAyuda, true);
		document.removeEventListener("mouseout", ocultaAyuda, true);
	}
}
function muestraAyuda(event, campo){
	colocaAyuda(event);
	
	if(navegador==0) 
	{ 
		document.attachEvent("onmousemove", colocaAyuda); 
		document.attachEvent("onmouseout", ocultaAyuda); 
	}
	else 
	{
		document.addEventListener("mousemove", colocaAyuda, true);
		document.addEventListener("mouseout", ocultaAyuda, true);
	}
	
	cNombre.innerHTML=campo;
	cTex.innerHTML=ayuda[campo];
	cAyuda.style.display="block";
}
function listado(registro,valor){
	var ajax=nuevoAjax();
	var divConsulta=document.getElementById("Divcons");
	ajax.open("POST","listado.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("registro="+registro+"&valor="+valor);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divConsulta.innerHTML=respuesta;
			}
		}
}
function devuelve(id){
	returnValue = id;
	window.close();
}
function verMunicipios(){
	var ajax=nuevoAjax();
	var estado=document.getElementById("formulario").estado.value;
	var divmuni=document.getElementById("muni");
	ajax.open("POST","municipios.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("estado="+estado);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmuni.innerHTML=respuesta;
		}
	}
}
function verSectores(){
	var ajax=nuevoAjax();
	var parroquia=document.getElementById("formulario").parroquia.value;
	var divsect=document.getElementById("sect");
	ajax.open("POST","sectores.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("parroquia="+parroquia);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divsect.innerHTML=respuesta;
		}
	}
}
function verParroquias(){
	var ajax=nuevoAjax();
	var municipio=document.getElementById("formulario").municipio.value;
	var divparr=document.getElementById("parr");
	ajax.open("POST","parroquias.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("municipio="+municipio);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divparr.innerHTML=respuesta;
		}
	}
}
function guardarRegistro(){
	var ajax=nuevoAjax();
	var cedula=document.getElementById("formulario").cedula.value;
	var nombre=document.getElementById("formulario").nombre.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var telefonoest=document.getElementById("formulario").telefonoest.value;
	var correo=document.getElementById("formulario").correo.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var direccionest=document.getElementById("formulario").direccionest.value;
	var establecimiento=document.getElementById("formulario").establecimiento.value;
	var sectorest=document.getElementById("formulario").sectorest.value;
	var sector=document.getElementById("formulario").sector.value;
	var password=document.getElementById("formulario").password.value;
	var loggin=document.getElementById("formulario").loggin.value;	
	var divregistro=document.getElementById("registro");
	var med=0;
	if(!cedula) med=1;
	if(!nombre) med=1;
	if(!edad) med=1;
	if(!loggin) med=1;
	if(!password) med=1;	
	if(!telefono) med=1;
	if(!direccion) med=1;
	if(!direccionest) med=1;	
	if(!establecimiento) med=1;
	if(!comprueba(sectorest)) med=1;	
	if(!comprueba(sector)) med=1;
	if(!comprueba(edad)) med=1;
	if(!comprueba(cedula)) med=1;
	if(!telefono) med=1;
	if(!telefonoest) med=1;	
	if(med==1){
		if(!cedula) alert("Falto ingresar el numero de cedula");
		if(!nombre) alert("Falto ingresar el nombre");
		if(!edad) alert("Falto ingresar edad");
		if(!sexo) alert("Falto ingresar el sexo");
		if(!loggin) alert("Falto ingresar nombre de usuario");
		if(!password) alert("Falto ingresar la contraseña");		
		if(!telefono) alert("Falto ingresar el numero de telefono");
		if(!direccion) alert("Falto ingresar la direccion");
		if(!direccionest) alert("Falto ingresar la direccion del establecimiento");
		if(!establecimiento) alert("Falto seleccionar el sector donde vive");		
		if(!comprueba(sectorest)) alert("Falto seleccionar el sector donde esta ubicado el establecimiento");
		if(!comprueba(sector)) alert("Falto seleccionar el sector donde vive");
		if(!comprueba(edad)) alert("La edad debe ser expresada en digitos numericos!!");
		if(!comprueba(cedula)) alert("La cedula debe ser expresada en digitos numericos!");
		if(!telefono) alert("Falta numero telefonico El numero telefonico debe ser expresado en digitos numericos!");
		if(!telefonoest) alert("Falta numero telefonico del establecimiento El numero telefonico debe ser expresado en digitos numericos!");
		}
	else {
		ajax.open("POST","guardarRegistro.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("cedula="+cedula+
		"&nombre="+nombre+
		"&edad="+edad+
		"&sexo="+sexo+
		"&telefono="+telefono+
		"&correo="+correo+
		"&direccion="+direccion+
		"&establecimiento="+establecimiento+
		"&sector="+sector+
		"&loggin="+loggin+
		"&password="+password+
		"&telefonoest="+telefonoest+
		"&sectorest="+sectorest+
		"&direccionest="+direccionest);
		var divregistro=document.getElementById("registro");
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divregistro.innerHTML=respuesta;
			}
		}
	}
}
function verificarloggin(){
	var ajax=nuevoAjax();
	var loggin=document.getElementById("formulario").loggin.value;
	var divlogg=document.getElementById("logg");
	ajax.open("POST","VerificaLoggin.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("loggin="+loggin);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			if (respuesta=="1")
			{
				var contenido="<div id=\"logg\"><input name=\"loggin\" type=\"text\" class=\"textbox\" id=\"loggin\" onChange=\"verificarloggin();\" value=\"\" ></div>";
				alert ("Ya esiste usuario con ese loggin");
				divlogg.innerHTML=contenido;
			}
			else 
			{
				var contenido="<div id=\"logg\"><input name=\"loggin\" type=\"text\" class=\"textbox\" id=\"loggin\" onChange=\"verificarloggin();\" value=\""+loggin+"\" ></div>";
				divlogg.innerHTML=contenido;			
			}
		}
	}
}
function verificarpassword(){
	var ajax=nuevoAjax();
	var password=document.getElementById("formulario").password.value;
	var password2=document.getElementById("formulario").password2.value;	
	var divpass=document.getElementById("pass");
	ajax.open("POST","VerificaPass.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("password="+password+"&password2="+password2);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			if (respuesta=="1")
			{
				var contenido="<div id=\"pass\"><table width=\"660\" border=\"1\" cellspacing=\"0\"><tr><td class=\"head\">Contraseña </td><td class=\"formulario\"><input name=\"password\" type=\"password\" class=\"textbox\" id=\"password\"  value=\""+password+"\" ></td><td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td></tr></table>	<table width=\"660\" border=\"1\" cellspacing=\"0\"><tr><td class=\"head\">Repetir Contraseña </td><td class=\"formulario\"><input name=\"password2\" type=\"password\" class=\"textbox\" id=\"password2\"  value=\""+password2+"\" onChange=\"verificarpassword();\"  ></td><td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td></tr></table></div>";
				divpass.innerHTML=contenido;
			}
			else 
			{
				alert ("No coinciden las claves");
				var contenido="<div id=\"pass\"><table width=\"660\" border=\"1\" cellspacing=\"0\"><tr><td class=\"head\">Contraseña </td><td class=\"formulario\"><input name=\"password\" type=\"password\" class=\"textbox\" id=\"password\"  value=\"\" ></td><td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td></tr></table>	<table width=\"660\" border=\"1\" cellspacing=\"0\"><tr><td class=\"head\">Repetir Contraseña </td><td class=\"formulario\"><input name=\"password2\" type=\"password\" class=\"textbox\" id=\"password2\" onChange=\"verificarpassword();\"  value=\"\" ></td><td class=\"formulario\"><img src=\"../../Imagenes/info.gif\" width=\"16\" height=\"16\" alt=\"Ayuda\" onmouseover=\"muestraAyuda(event, 'Password')\"></td></tr></table></div>";
				divpass.innerHTML=contenido;			
			}
		}
	}
}
function verMunicipiosest(){
	var ajax=nuevoAjax();
	var estado=document.getElementById("formulario").estadoest.value;
	var divmuni=document.getElementById("muniest");
	ajax.open("POST","municipiosest.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("estadoest="+estado);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmuni.innerHTML=respuesta;
		}
	}
}
function verSectoresest(){
	var ajax=nuevoAjax();
	var parroquia=document.getElementById("formulario").parroquiaest.value;
	var divsect=document.getElementById("sectest");
	ajax.open("POST","sectoresest.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("parroquiaest="+parroquia);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divsect.innerHTML=respuesta;
		}
	}
}
function verParroquiasest(){
	var ajax=nuevoAjax();
	var municipio=document.getElementById("formulario").municipioest.value;
	var divparr=document.getElementById("parrest");
	ajax.open("POST","parroquiasest.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("municipioest="+municipio);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divparr.innerHTML=respuesta;
		}
	}
}
