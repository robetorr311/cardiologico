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
	ayuda["Hacia adelante"]="Ver los proximos 6 registros";
	ayuda["Hacia atras"]="Ver los 6 registros anteriores";
	ayuda["Primero"]="Ir al principio de la tabla";
	ayuda["Ultimo"]="Ir al final de la tabla";
	ayuda["Buscar"]="Buscar registro segun el numero de cedula";
	ayuda["Cerrar"]="Cerrar ventana";
	ayuda["Imprimir"]="Ver planilla en formato pdf";	
	ayuda["Eliminar"]="Eliminar registro";
	ayuda["Ver Registro"]="Ver registro";
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
function cerrar(){
	window.close();
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