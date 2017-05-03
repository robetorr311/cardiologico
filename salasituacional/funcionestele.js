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
function ocultaMensaje(){
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divTransparente.style.display="none";
}
window.setInterval("botoncierre()", 2000);
function muestraMensaje(mensaje){
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}
function eliminar(id){
	var answer = confirm("Desea eliminar el registro?")
	if (answer){

	}
	else{

	}
}
function abrirRespuesta(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").iddocumento.value;	
	var hmedico=document.getElementById("formulario").hmedico.value;
			ajax.open("POST","estatusenrespuesta.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id="+id);
			ajax.onreadystatechange=function()
				{
					if (ajax.readyState==4)
					{
						var respuesta=ajax.responseText; 
						if(respuesta=="OK")	{
						document.getElementById("formulario").hboton.value='2';						
						levantapopup('respuesta',id);							
						}
					}
				}	
}
function cerrarTele(){
	var ajax=nuevoAjax();
	var med=0;
	var id=document.getElementById("formulario").iddocumento.value;	
	var recomendacion=document.getElementById("formulario").recomendacion.value;
	var diagnostico=document.getElementById("formulario").diagnostico.value;	
	if(!recomendacion) med=1;
	if(!diagnostico) med=1;
	if(med==1){
		if (confirm("Desea salir sin responder el telegrama?")){
				window.parent.hidePopWin();	
		}
		else{
			ajax.open("POST","estatusenrespuesta.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("id="+id);
			ajax.onreadystatechange=function()
				{
					if (ajax.readyState==4)
					{
						var respuesta=ajax.responseText;
						if(respuesta=="OK")	document.getElementById("formulario").cierre.disabled=true;
					}
				}	
		}
	}
	else {	
			window.parent.hidePopWin();
	}
}
function botoncierre(){
	var boton=document.getElementById("formulario").hboton.value;
	if(boton=='1') document.getElementById("formulario").cierre.disabled=false;
	if(boton=='2') document.getElementById("formulario").cierre.disabled=true;
	if(boton=='3') document.getElementById("formulario").cierre.disabled=false;	
}
