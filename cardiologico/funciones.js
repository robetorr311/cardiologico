// Variables para setear
onload=function() {
	form=document.getElementById("formulario");
	modal=document.getElementById("modal");
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
function modalRespuesta(){
	var ajax=nuevoAjax();
	var divmodalResp=document.getElementById("modalResp");
	ajax.open("POST","modalRespuesta.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divmodalResp.innerHTML=respuesta;
			}
		}
}
function botonesr(){
	var ajax=nuevoAjax();
	var divbotonresp=document.getElementById("botonresp");
	ajax.open("POST","botonesr.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divbotonresp.innerHTML=respuesta;
			}
		}
}
function buscarmed(cedula){
	var ajax=nuevoAjax();
	var dividmed=document.getElementById("idmed");
	ajax.open("POST","buscarmed.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("cedula="+cedula);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				dividmed.innerHTML=respuesta;
			}
		}
}
function modalPaciente(){
	datos=dialogArguments;
	var ajax=nuevoAjax();
	var divpaciente=document.getElementById("paciente");
	ajax.open("POST","modalPaciente.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+datos);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divpaciente.innerHTML=respuesta;
			}
		}
}
function modalExamen(){
	datos=dialogArguments;
	var ajax=nuevoAjax();
	var divventana=document.getElementById("ventana");
	ajax.open("POST","examen.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+datos);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divventana.innerHTML=respuesta;
			}
		}
}
function modal(){
	datos=dialogArguments;
	var ajax=nuevoAjax();
	var divventana=document.getElementById("ventana");
	ajax.open("POST","modal.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+datos);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divventana.innerHTML=respuesta;
			}
		}
}
function cerrarRespuesta(idmedico,recomendaciones){
	var datos = new Array();
	datos[0]=idmedico;
	datos[1]=recomendaciones;
	returnValue = datos;
	window.close();
}
function respuesta(){
	var punto =".";
	muestraMensaje(punto);
	var datosModal = new Array();
	var id=0;
	datosModal=window.showModalDialog('respuesta.php',null,'dialogWidth:655px;dialogHeight:300px;dialogLeft:320;dialogTop:320;status:0;unadorned:yes;toolbar:0;help:no');
	if(!datosModal[0]) id=1;
	if(!datosModal[1]) id=1;
	if(id==0){
	document.getElementById("formulario").hmedico.value=datosModal[0];
	document.getElementById("formulario").recomendacion.value=datosModal[1];
	botonesr();
	}
}
function datospaciente(id){
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('paciente.php',id,'dialogWidth:620px;dialogHeight:250px;dialogLeft:320;dialogTop:320;status:0;unadorned:yes;toolbar:0;help:no');
}
window.setInterval("actualizarSession()", 2000);
function finalizarSession(){
	window.document.forms[0].target = '_parent';
	window.document.forms[0].action = 'cerrarsession.php';
	window.document.forms[0].submit();
}
function actualizarSession(){
	var ajax=nuevoAjax();
	var divpendientes=document.getElementById("pendientes");
	ajax.open("POST","session.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				if (respuesta=="true"){
					window.document.forms[0].target = '_parent';
					window.document.forms[0].action = 'cerrarsession.php';
					window.document.forms[0].submit();
				}
			}
		}
}
function abrirModal(id){
	var datosModalR = new Array();
	var punto =".";
	muestraMensaje(punto);
	datosModalR=window.showModalDialog('ventana.php',id,'dialogWidth:620px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	iddocumento=datosModalR[0];
	idestablecimiento=datosModalR[1];
	recomendacion=datosModalR[2];
	hmedico=datosModalR[3];
	var ajax=nuevoAjax();
	var divpendientes=document.getElementById("pendientes");
	ajax.open("POST","guardarRespuesta.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("iddocumento="+iddocumento+"&idestablecimiento="+idestablecimiento+"&recomendacion="+recomendacion+"&hmedico="+hmedico);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divpendientes.innerHTML=respuesta;
			}
		}
}
function abrirExamen(id){
	var datosModalR = new Array();
	var punto =".";
	muestraMensaje(punto);
	datosModalR=window.showModalDialog('ModalExamen.php',id,'dialogWidth:620px;dialogHeight:400px;dialogLeft:400;dialogTop:400;status:0;unadorned:yes;toolbar:0;help:no');
}
function ubicacion(){
	var punto =".";
	muestraMensaje(punto);
	var id;
	datosModal=window.showModalDialog('modal.php',id,'dialogWidth:550px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	form.inputHlocalidad.value=datosModal;	
}
function devubic(){
	var datos
	datos=modal.parroquia.value;
	returnValue = datos;
	window.close();
}
function agregar(){
	var ajax=nuevoAjax();
	var divVerRegistro=document.getElementById("VerRegistro");
	ajax.open("POST","agregar.php", true);
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
function guardar(iddocumento,idestablecimiento,recomendacion,hmedico){
	var datosGuardar = new Array();
	datosGuardar[0]=iddocumento;
	datosGuardar[1]=idestablecimiento;
	datosGuardar[2]=recomendacion;
	datosGuardar[3]=hmedico;
	returnValue = datosGuardar;
	window.close();
}
function ocultaMensaje(){
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divTransparente.style.display="none";
}
function muestraMensaje(mensaje){
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}