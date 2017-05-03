// Variables para setear
onload=function() 
{
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
	ayuda["Nombre"]="Ingresa el nombre y apellido del usuario. OBLIGATORIO";
	ayuda["Login"]="El nombre que el usuario utilizara para ingresar al sistema (Maximo 8 caracteres) OBLIGATORIO";
	ayuda["Password"]="Ingrese la clave de acceso al sistema.";
	ayuda["Nivel"]="Selecciona el nivel de acceso que el usuario tendra al ingresar al sistema.";
	ayuda["RePassword"]="Ingrese nuevamente la clave de acceso.";
	ayuda["Devuelve"]="Haz Click para seleccionar el registro";
	ayuda["Eliminar"]="Haz Click para eliminar el registro";
	ayuda["Buscar"]="Haz Click para buscar registros";
	ayuda["Primeros"]="Haz Click para ver los primeros 6 registros";
	ayuda["Previo"]="Haz Click para ver los 6 registros anteriores";
	ayuda["Proximo"]="Haz Click para ver los proximos 6 registros";
	ayuda["Ultimos"]="Haz Click para ver los ultimos 6 registros";
	ayuda["Cerrar"]="Haz Click para cerrar la consulta";
	preCarga("../../Imagenes/ok.gif", "../../Imagenes/loading.gif", "../../Imagenes/error.gif");
}

function preCarga()
{
	imagenes=new Array();
	for(i=0; i<arguments.length; i++)
	{
		imagenes[i]=document.createElement("img");
		imagenes[i].src=arguments[i];
	}
}

function nuevoAjax()
{ 
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
		ocultaMensaje();
		var ajax=nuevoAjax();
		var divVerRegistro=document.getElementById("Usuarios");
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
function editUsuario(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idusuario.value;
	var divVerRegistro=document.getElementById("Usuarios");
	ajax.open("POST","editUsuario.php", true);
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
function newUsuario(){
	var ajax=nuevoAjax();
	var divVerRegistro=document.getElementById("Usuarios");
	ajax.open("POST","newUsuario.php", true);
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
function limpiaForm()
{
	for(i=0; i<=4; i++)
	{
		form.elements[i].className=claseNormal;
	}
}

function campoError(campo)
{
	campo.className=claseError;
	error=1;
}

function ocultaMensaje()
{
	divTransparente.style.display="none";
}

function muestraMensaje(mensaje)
{
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}

function eliminaEspacios(cadena)
{
	// Funcion para eliminar espacios delante y detras de cada cadena
	while(cadena.charAt(cadena.length-1)==" ") cadena=cadena.substr(0, cadena.length-1);
	while(cadena.charAt(0)==" ") cadena=cadena.substr(1, cadena.length-1);
	return cadena;
}

function validaLongitud(valor, permiteVacio, minimo, maximo)
{
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

function validaCorreo(valor)
{
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}$)/;
	if(reg.test(valor)) return true;
	else return false;
}

// Mensajes de ayuda

if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
else navegador=1;

function colocaAyuda(event)
{
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

function ocultaAyuda()
{
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

function muestraAyuda(event, campo)
{
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

function listado(registro,valor)
{
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
function devuelve(id)
{
	returnValue = id;
	window.close();
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
function guardarUsuarios(){
	var ajax=nuevoAjax();
	var nombre=document.getElementById("formulario").nombre.value;
	var login=document.getElementById("formulario").login.value;
	var password=document.getElementById("formulario").password.value;
	var nivel=document.getElementById("formulario").nivel.value;
	var divUsuarios=document.getElementById("Usuarios");
	var med=0;
	if(!nombre) med=1;
	if(!login) med=1;
	if(!password) med=1;
	if(!comprueba(nivel)) med=1;
	if(med==1){
		if(!nombre) alert("Falto ingresar el nombre");
		if(!login) alert("Falto ingresar login");
		if(!password) alert("Falto ingresar el password");
		if(!comprueba(nivel)) alert("Falto seleccionar el nivel de acceso");
	}
	else {
		ajax.open("POST","guardarUsuarios.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("nombre="+nombre+"&login="+login+"&password="+password+"&nivel="+nivel);
		var divUsuarios=document.getElementById("Usuarios");
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divUsuarios.innerHTML=respuesta;
			}
		}
	}
}
function updateUsuario(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idusuario.value;
	var nombre=document.getElementById("formulario").nombre.value;
	var login=document.getElementById("formulario").login.value;
	var password=document.getElementById("formulario").password.value;
	var nivel=document.getElementById("formulario").nivel.value;
	var divUsuarios=document.getElementById("Usuarios");
	var med=0;
	if(!nombre) med=1;
	if(!login) med=1;
	if(!password) med=1;
	if(!comprueba(nivel)) med=1;
	if(med==1){
		if(!nombre) alert("Falto ingresar el nombre");
		if(!login) alert("Falto ingresar login");
		if(!password) alert("Falto ingresar el password");
		if(!comprueba(nivel)) alert("Falto seleccionar el nivel de acceso");
	}
	else {
		ajax.open("POST","updateUsuario.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id+"&nombre="+nombre+"&login="+login+"&password="+password+"&nivel="+nivel);
		var divUsuarios=document.getElementById("Usuarios");
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divUsuarios.innerHTML=respuesta;
			}
		}
	}
}