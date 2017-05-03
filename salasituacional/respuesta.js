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
function muestraMensaje(mensaje){
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
}
function cerrarRespuesta(){
	var ajax=nuevoAjax();
	var hdocumento=document.getElementById("formulario").hdocumento.value;
	var recomendaciones=document.getElementById("formulario").recomendaciones.value;
	var diagnostico=document.getElementById("formulario").diagnostico.value;	
	var hmedico=document.getElementById("formulario").hmedico.value;
	var med=0;
	if(!recomendaciones) med=1;
	if(!diagnostico) med=1;
	if(!hmedico) med=1;	
	if(med==1){
		if(!recomendaciones) alert("Falta ingresar recomendacion");
		if(!diagnostico) alert("Falta ingresar diagnostico");
		if(!hmedico) alert("Falto ingresar medico");
	}
	else {	
		ajax.open("POST","guardarRespuesta.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("hdocumento="+hdocumento+"&recomendacion="+recomendaciones+"&hmedico="+hmedico+"&diagnostico="+diagnostico);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
					var respuesta=ajax.responseText;
					if (respuesta=="OK"){
					window.parent.hidePopWin(true,diagnostico,recomendaciones,hmedico,'respuesta');
					}
					else {
					alert(respuesta);
					}
			}
		}
	}
}