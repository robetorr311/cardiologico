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
function DevolverImagen(id,examen){
	var datos=new Array();
	datos[0]=id;
	datos[1]=examen;
	returnValue = datos;
	window.close();
}
function procesarImagen(hpaciente,archivo,desc){
		var ajax=nuevoAjax();
		var divpostform=document.getElementById("postform");
		ajax.open("POST","imagen.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("hpaciente="+hpaciente+"&archivo="+archivo+"&desc="+desc);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divpostform.innerHTML=respuesta;
			}
		}
}
function RecuperaDatos(hpaciente){
	datos=dialogArguments;
	if (datos==undefined){
	datos=hpaciente;
	}
	document.formulario.hpaciente.value=datos;
} 
function ValorECGN(){
	var ajax=nuevoAjax();
	var divecg=document.getElementById("ecg");
	ajax.open("POST","ecgn.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divecg.innerHTML=respuesta;
		}
	}
}
function ValorECGS(){
	var ajax=nuevoAjax();
	var divecg=document.getElementById("ecg");
	ajax.open("POST","ecg.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divecg.innerHTML=respuesta;
		}
	}
}
function agregarExamen(){
	var ajax=nuevoAjax();
	var divexamen=document.getElementById("examen");
	var hpaciente=document.getElementById("formulario").hpaciente.value;
	var tensarte=document.getElementById("formulario").tensarte.value;
	var freqcard=document.getElementById("formulario").freqcard.value;
	var freqresp=document.getElementById("formulario").freqresp.value;
	var peso=document.getElementById("formulario").peso.value;
	var talla=document.getElementById("formulario").talla.value;
	var aspecto=document.getElementById("formulario").aspecto.value;
	var hecg=document.getElementById("formulario").hecg.value;
	ajax.open("POST","agregarExamen.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("hpaciente="+hpaciente+"&tensarte="+tensarte+"&freqcard="+freqcard+"&freqresp="+freqresp+"&peso="+peso+"&talla="+talla+"&aspecto="+aspecto+"&hecg="+hecg);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divexamen.innerHTML=respuesta;
		}
	}
}
function Subirecg(){
	var ajax=nuevoAjax();
	var divelectro=document.getElementById("electro");
	ajax.open("POST","hecg.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divelectro.innerHTML=respuesta;
		}
	}
}
function Ocultarecg(){
	var ajax=nuevoAjax();
	var divelectro=document.getElementById("electro");
	ajax.open("POST","Ohecg.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divelectro.innerHTML=respuesta;
		}
	}
}
function Ocultarxtorax(){
	var ajax=nuevoAjax();
	var divrayosx=document.getElementById("rayosx");
	ajax.open("POST","Ohrxtorax.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divrayosx.innerHTML=respuesta;
		}
	}
}
function Subirrxtorax(){
	var ajax=nuevoAjax();
	var divrayosx=document.getElementById("rayosx");
	ajax.open("POST","hrxtorax.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divrayosx.innerHTML=respuesta;
		}
	}
}
function cerrar(){
	window.close();
}
function devuelve(id){
	returnValue = id;
	window.close();
}