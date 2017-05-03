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
	ayuda["Cedula"]="Ingresa el numero de cedula del Paciente. OBLIGATORIO";
	ayuda["Nombre"]="Ingresa nombre y apellido del Paciente. OBLIGATORIO";
	ayuda["Edad"]="Indique la edad del paciente.";
	ayuda["Sexo"]="Seleccione el sexo del paciente";
	ayuda["Telefono"]="Indique el numero telefonico del paciente";
	ayuda["Email"]="Indique el correo electronico del paciente";
	ayuda["Direccion"]="Indique la direccion de domicilio del paciente";	
	ayuda["Establecimiento"]="Selecciona el establecimiento al cual esta adscrito.";
	ayuda["Devuelve"]="Haz Click para seleccionar el registro";
	ayuda["Eliminar"]="Haz Click para eliminar el registro";
	ayuda["Buscar"]="Haz Click para buscar registros";
	ayuda["Primeros"]="Haz Click para ver los primeros 6 registros";
	ayuda["Previo"]="Haz Click para ver los 6 registros anteriores";
	ayuda["Proximo"]="Haz Click para ver los proximos 6 registros";
	ayuda["Ultimos"]="Haz Click para ver los ultimos 6 registros";
	ayuda["Cerrar"]="Haz Click para cerrar la consulta";
	ayuda["Estado"]="Selecciona el estado donde se encuentra ubicado el domicilio del paciente. OBLIGATORIO";
	ayuda["Municipio"]="Selecciona el municipio donde se encuentra ubicado el  el domicilio del paciente. OBLIGATORIO";
	ayuda["Parroquia"]="Selecciona la parroquia donde se encuentra ubicado el  el domicilio del paciente. OBLIGATORIO";
	ayuda["Sector"]="Selecciona el sector donde se encuentra ubicado el  el domicilio del paciente. OBLIGATORIO";
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
function devuelveAntecedentes()
{
	var personales=document.getElementById("formulario").personales.value;
	var familiares=document.getElementById("formulario").familiares.value;
	var datos=new Array();
	datos[0]=personales;
	datos[1]=familiares;
	returnValue = datos;
	window.close();
}
function devuelveHabitos()
{
	var tabaco=document.getElementById("formulario").tabaco.value;
	var alcohol=document.getElementById("formulario").alcohol.value;
	var ejercicio=document.getElementById("formulario").ejercicio.value;
	var alimentacion=document.getElementById("formulario").alimentacion.value;
	var datos=new Array();
	datos[0]=tabaco;
	datos[1]=alcohol;
	datos[2]=ejercicio;
	datos[3]=alimentacion;
	returnValue = datos;
	window.close();
}
function ModalAntecedentes(){
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('antecedentes.php',id,'dialogWidth:650px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		var ajax=nuevoAjax();
		var divdivant=document.getElementById("divant");
		ajax.open("POST","divantecedentes.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("personales="+datosModal[0]+"&familiares="+datosModal[1]);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divdivant.innerHTML=respuesta;
			}
		}
	}
}
function ModalHabitos(){
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('habitos.php',id,'dialogWidth:650px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		var ajax=nuevoAjax();
		var divdivhab=document.getElementById("divhab");
		ajax.open("POST","divhabitos.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("tabaco="+datosModal[0]+"&alcohol="+datosModal[1]+"&ejercicio="+datosModal[2]+"&alimentacion="+datosModal[3]);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divdivhab.innerHTML=respuesta;
			}
		}
	}
} 
function consulta(){
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('consulta.php',id,'dialogWidth:650px;dialogHeight:400px;dialogLeft:300;dialogTop:300;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		var ajax=nuevoAjax();
		var divVerRegistro=document.getElementById("Pacientes");
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
function editPaciente(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idpaciente.value;
	var divVerRegistro=document.getElementById("Pacientes");
	ajax.open("POST","editPaciente.php", true);
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
function newPaciente(){
	var ajax=nuevoAjax();
	var divVerRegistro=document.getElementById("Pacientes");
	ajax.open("POST","newPaciente.php", true);
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
function guardarPacientes(){
	var ajax=nuevoAjax();
	var cedula=document.getElementById("formulario").cedula.value;
	var nombre=document.getElementById("formulario").nombre.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var correo=document.getElementById("formulario").correo.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var sector=document.getElementById("formulario").sector.value;
	var personales=document.getElementById("formulario").personales.value;
	var familiares=document.getElementById("formulario").familiares.value;
	var tabaco=document.getElementById("formulario").tabaco.value;
	var alcohol=document.getElementById("formulario").alcohol.value;
	var ejercicio=document.getElementById("formulario").ejercicio.value;
	var alimentacion=document.getElementById("formulario").alimentacion.value;
	var divPacientes=document.getElementById("Pacientes");
	var med=0;
	if(!cedula) med=1;
	if(!nombre) med=1;
	if(!edad) med=1;
	if(!telefono) med=1;
	if(!direccion) med=1;
	if(!comprueba(sector)) med=1;
	if(!comprueba(edad)) med=1;
	if(!comprueba(cedula)) med=1;
	if(!comprueba(telefono)) med=1;
	if(!tabaco) med=1;
	if(!alcohol) med=1;
	if(!ejercicio) med=1;
	if(!alimentacion) med=1;
	if(!personales) med=1;
	if(!familiares) med=1;	
	if(med==1){
		if(!tabaco) alert("Falto especificar si el paciente consume tabaco");
		if(!alcohol) alert("Falto especificar si el paciente consume bebidas alcoholicas");
		if(!ejercicio) alert("Falto especificar si el paciente realiza ejericio periodicamente");
		if(!alimentacion) alert("Falto especificar los habitos alimenticios del paciente");
		if(!personales) alert("Falto especificar los antecedentes personales");
		if(!familiares) alert("Falto especificar los antecedentes familiares");	
		if(!cedula) alert("Falto ingresar el numero de cedula");
		if(!nombre) alert("Falto ingresar el nombre");
		if(!edad) alert("Falto ingresar edad");
		if(!sexo) alert("Falto ingresar el sexo");
		if(!telefono) alert("Falto ingresar el numero de telefono");
		if(!direccion) alert("Falto ingresar la direccion");
		if(!comprueba(sector)) alert("Falto seleccionar el sector donde vive");
		if(!comprueba(edad)) alert("La edad debe ser expresada en digitos numericos!!");
		if(!comprueba(cedula)) alert("La cedula debe ser expresada en digitos numericos!");
		if(!comprueba(telefono)) alert("El numero telefonico debe ser expresado en digitos numericos!");
	}
	else {
		ajax.open("POST","guardarPacientes.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("cedula="+cedula+"&nombre="+nombre+
		"&edad="+edad+"&sexo="+sexo+"&telefono="+
		telefono+"&correo="+correo+"&direccion="+direccion+"&sector="+sector+
		"&tabaco="+tabaco+"&alcohol="+alcohol+"&ejercicio="+
		ejercicio+"&alimentacion="+alimentacion+"&personales="+personales+"&familiares="+familiares
		);
		var divPacientes=document.getElementById("Pacientes");
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divPacientes.innerHTML=respuesta;
			}
		}
	}
}
function updatePaciente(){
	var ajax=nuevoAjax();
	var id=document.getElementById("formulario").idpaciente.value;
	var cedula=document.getElementById("formulario").cedula.value;
	var nombre=document.getElementById("formulario").nombre.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var correo=document.getElementById("formulario").correo.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var sector=document.getElementById("formulario").sector.value;
	var personales=document.getElementById("formulario").personales.value;
	var familiares=document.getElementById("formulario").familiares.value;
	var tabaco=document.getElementById("formulario").tabaco.value;
	var alcohol=document.getElementById("formulario").alcohol.value;
	var ejercicio=document.getElementById("formulario").ejercicio.value;
	var alimentacion=document.getElementById("formulario").alimentacion.value;
	var divPacientes=document.getElementById("Pacientes");
	var med=0;
	if(!cedula) med=1;
	if(!nombre) med=1;
	if(!edad) med=1;
	if(!telefono) med=1;
	if(!direccion) med=1;
	if(!comprueba(sector)) med=1;
	if(!comprueba(edad)) med=1;
	if(!comprueba(cedula)) med=1;
	if(!comprueba(telefono)) med=1;
	if(!tabaco) med=1;
	if(!alcohol) med=1;
	if(!ejercicio) med=1;
	if(!alimentacion) med=1;
	if(!personales) med=1;
	if(!familiares) med=1;	
	if(med==1){
		if(!tabaco) alert("Falto especificar si el paciente consume tabaco");
		if(!alcohol) alert("Falto especificar si el paciente consume bebidas alcoholicas");
		if(!ejercicio) alert("Falto especificar si el paciente realiza ejericio periodicamente");
		if(!alimentacion) alert("Falto especificar los habitos alimenticios del paciente");
		if(!personales) alert("Falto especificar los antecedentes personales");
		if(!familiares) alert("Falto especificar los antecedentes familiares");	
		if(!cedula) alert("Falto ingresar el numero de cedula");
		if(!nombre) alert("Falto ingresar el nombre");
		if(!edad) alert("Falto ingresar edad");
		if(!sexo) alert("Falto ingresar el sexo");
		if(!telefono) alert("Falto ingresar el numero de telefono");
		if(!direccion) alert("Falto ingresar la direccion");
		if(!comprueba(sector)) alert("Falto seleccionar el sector donde vive");
		if(!comprueba(edad)) alert("La edad debe ser expresada en digitos numericos!!");
		if(!comprueba(cedula)) alert("La cedula debe ser expresada en digitos numericos!");
		if(!comprueba(telefono)) alert("El numero telefonico debe ser expresado en digitos numericos!");
	}
	else {
		ajax.open("POST","updatePaciente.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+id+"&cedula="+cedula+"&nombre="+nombre+
		"&edad="+edad+"&sexo="+sexo+"&telefono="+telefono+
		"&correo="+correo+"&direccion="+direccion+"&sector="+sector+
		"&tabaco="+tabaco+"&alcohol="+alcohol+"&ejercicio="+
		ejercicio+"&alimentacion="+alimentacion+"&personales="+personales+"&familiares="+familiares
		);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divPacientes.innerHTML=respuesta;
			}
		}
	}
}