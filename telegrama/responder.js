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
function Enviar(){
    var	error=0;
	var ajax=nuevoAjax();
	var divmodalResp=document.getElementById("modalResp");
	var hpaciente=document.getElementById("formulario").hpaciente.value;
	var respuesta=document.getElementById("formulario").respuesta.value;	
	var hmedico=document.getElementById("formulario").hmedico.value;
	var hdocumento=document.getElementById("formulario").hdocumento.value;
	var husuario=document.getElementById("formulario").husuario.value;
	var hpadre=document.getElementById("formulario").hpadre.value;	
	if (!respuesta) error=1;
 	if (error==1)
	{
		alert("Falta Ingresar el mensaje");
	}
	else
	{ 
		ajax.open("POST", "insert_respuesta.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("hpaciente="+hpaciente+"&husuario="+husuario+"&hmedico="+hmedico+"&hdocumento="+hdocumento+"&respuesta="+respuesta+"&hpadre="+hpadre);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var resultado=ajax.responseText;
				modalResp.innerHTML=resultado;
			}
		} 
 	} 
}