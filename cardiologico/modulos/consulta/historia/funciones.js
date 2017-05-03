// Variables para setear
onload=function() {
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
	ayuda["Cedula"]="Ingresa el numero de cedula del Paciente. OBLIGATORIO";
	ayuda["Nombre"]="Ingresa nombre y apellido del Paciente. De 4 a 20 caracteres. OBLIGATORIO";
	ayuda["Establecimiento"]="Selecciona el establecimiento al cual esta adscrito.";
	ayuda["Historia"]="Haz Click para ver la historia medica de este paciente";
	ayuda["Eliminar"]="Haz Click para eliminar el registro";
	ayuda["Buscar"]="Haz Click para buscar registros";
	ayuda["Primeros"]="Haz Click para ver los primeros 6 registros";
	ayuda["Previo"]="Haz Click para ver los 6 registros anteriores";
	ayuda["Proximo"]="Haz Click para ver los proximos 6 registros";
	ayuda["Ultimos"]="Haz Click para ver los ultimos 6 registros";
	ayuda["Cerrar"]="Haz Click para cerrar la consulta";
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
function verExamenes(){
	var id;
	id=dialogArguments;
	var ajax=nuevoAjax();
	var divdivant=document.getElementById("Divcons");
	ajax.open("POST","listexam.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+id);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divdivant.innerHTML=respuesta;
		}
	}
}
function recuperarDatos(){
	var id;
	id=dialogArguments;
	var ajax=nuevoAjax();
	var divdivant=document.getElementById("historia");
	ajax.open("POST","historiaMedica.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+id);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divdivant.innerHTML=respuesta;
		}
	}
}
function historia(id){
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('modalHistoria.php',id,'dialogWidth:750px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
} 
function consulta(id){
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('examenes.php',id,'dialogWidth:700px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
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
function campoError(campo){
	campo.className=claseError;
	error=1;
}
function ocultaMensaje(){
	document.getElementById("transparencia").style.display="none";
}
function muestraMensaje(mensaje){
	document.getElementById("transparenciaMensaje").innerHTML=mensaje;
	document.getElementById("transparencia").style.display="block";
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
function listadoexamen(registro,valor,id){
	var ajax=nuevoAjax();
	var divConsulta=document.getElementById("Divcons");
	ajax.open("POST","listado_examen.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("registro="+registro+"&valor="+valor+"&id="+id);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divConsulta.innerHTML=respuesta;
			}
		}
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
