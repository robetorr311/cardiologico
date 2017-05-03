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
	ayuda["Nombre"]="Ingresa el nombre del sector. OBLIGATORIO";
	ayuda["Municipio"]="Seleccione el Municipio OBLIGATORIO";
	ayuda["Parroquia"]="Seleccione la Parroquia.";
	ayuda["Estado"]="Selecciona el Estado.";
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
		var divVerRegistro=document.getElementById("Ubicacion");
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
function editUbicacion(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idUbicacion.value;
	var divVerRegistro=document.getElementById("Ubicacion");
	ajax.open("POST","editUbicacion.php", true);
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
function newUbicacion(){
	var ajax=nuevoAjax();
	var divVerRegistro=document.getElementById("Ubicacion");
	ajax.open("POST","newUbicacion.php", true);
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
function Mayuscula(){
	var ajax=nuevoAjax();
	var nombre=document.getElementById("formulario").nombre.value;
	var divparr=document.getElementById("nomb");
	ajax.open("POST","Mayuscula.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("nombre="+nombre);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divparr.innerHTML=respuesta;
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
function guardarUbicacion(){
	var ajax=nuevoAjax();
	var nombre=document.getElementById("formulario").nombre.value;
	var estado=document.getElementById("formulario").estado.value;
	var municipio=document.getElementById("formulario").municipio.value;
	var parroquia=document.getElementById("formulario").parroquia.value;
	var divUbicacion=document.getElementById("Ubicacion");
	var med=0;
	if(!nombre) med=1;	
	if(!estado) med=1;
	if(!municipio) med=1;
	if(!parroquia) med=1;
	if(med==1){
		if(!nombre) alert("Falto ingresar el nombre");
		if(!estado) alert("Falto ingresar el estado");
		if(!municipio) alert("Falto ingresar el municipio");
		if(!parroquia) alert("Falto ingresar la parroquia");
	}
	else {
		ajax.open("POST","guardarUbicacion.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("nombre="+nombre+"&estado="+estado+"&municipio="+municipio+"&parroquia="+parroquia);
		var divUbicacion=document.getElementById("Ubicacion");
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divUbicacion.innerHTML=respuesta;
			}
		}
	}
}