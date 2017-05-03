// Variables para setear
onload=function() {
	cAyuda=document.getElementById("mensajesAyuda");
	cNombre=document.getElementById("ayudaTitulo");
	cTex=document.getElementById("ayudaTexto");
	divTransparente=document.getElementById("transparencia");
	divMensaje=document.getElementById("transparenciaMensaje");
	form=document.getElementById("formulario");
	modal=document.getElementById("modal");
	urlDestino="insert.php";
	
	claseNormal="input";
	claseError="inputError";
	
	ayuda=new Array();
	ayuda["Fecha"]="Fecha de envio del reporte. OBLIGATORIO";
	ayuda["Numero"]="Numero de Reporte. De 4 a 20 caracteres. OBLIGATORIO";
	ayuda["Cedulap"]="Ingresa el numero de cedula del paciente. OBLIGATORIO";
	ayuda["Nombrep"]="Ingresa nombre y apellido del paciente. De 4 a 20 caracteres. OBLIGATORIO";
	ayuda["Edad"]="Ingresa la edad del paciente. Campo numerico De 1 a 3 digitos.";
	ayuda["Email"]="Ingresa un correo electronico del paciente";
	ayuda["Sexo"]="Seleccione el sexo del paciente. OBLIGATORIO";
	ayuda["Telefono"]="Ingresa un teléfono de contacto del paciente.";
	ayuda["Direccion"]="Ingresa la direccion de la vivienda del paciente OBLIGATORIO";
	ayuda["Ubicacion"]="Haz Click en el boton para ubicar geograficamente el Domicilio del paciente. OBLIGATORIO";
	ayuda["Diagnostico"]="Diagnostico preliminar sobre la condicion del paciente OBLIGATORIO";
	ayuda["Examen"]="Examenes fisicos realicados al paciente. OBLIGATORIO";
	ayuda["Cedulam"]="Ingresa el numero de cedula del medico. OBLIGATORIO";
	ayuda["Nombrem"]="Ingresa nombre y apellido del medico. De 4 a 20 caracteres. OBLIGATORIO";
	ayuda["Establecimiento"]="Selecciona el establecimiento al cual esta adscrito.";	
	ayuda["Buscar"]="Haz Click para buscar registros";
	ayuda["Primeros"]="Haz Click para ver los primeros 6 registros";
	ayuda["Previo"]="Haz Click para ver los 6 registros anteriores";
	ayuda["Proximo"]="Haz Click para ver los proximos 6 registros";
	ayuda["Ultimos"]="Haz Click para ver los ultimos 6 registros";
	ayuda["Cerrar"]="Haz Click para cerrar la consulta";
	ayuda["Devuelve"]="Haz Click para seleccionar el registro";

	
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
function SubirImagen(){
	var punto =".";
	muestraMensaje(punto);
	var id=document.getElementById("formulario").idpaciente.value;	
	datosModal=window.showModalDialog('examen.php',id,'dialogWidth:750px;dialogHeight:400px;dialogLeft:10;dialogTop:200;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		himagen=datosModal[0];
		examen=datosModal[1];
		var ajax=nuevoAjax();
		var divbotones=document.getElementById("botones");
		ajax.open("POST","botonesImagen.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("himagen="+himagen+"&examen="+examen);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divbotones.innerHTML=respuesta;
			}
		}
	}
}
function consulta(){
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('consulta.php',id,'dialogWidth:650px;dialogHeight:400px;dialogLeft:10;dialogTop:200;status:0;unadorned:yes;toolbar:0;help:no');
	if (datosModal!=null){
		var ajax=nuevoAjax();
		var divVerRegistro=document.getElementById("formContenedor");
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
function agregarPacientes(){
	var alerta=0;
	var ajax=nuevoAjax();
	var divpaciente=document.getElementById("paciente");
	var cedula=document.getElementById("formulario").cedulap.value;
	var idpaciente=document.getElementById("formulario").idpaciente.value;
	var nombrep=document.getElementById("formulario").nombrep.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var email=document.getElementById("formulario").email.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var hubicacion=document.getElementById("formulario").hubicacion.value;
	if(!comprueba(edad)) alerta=1;
	if(!comprueba(telefono)) alerta=1;
	if(!nombrep) alerta=1;
	if(!edad) alerta=1;
	if(!sexo) alerta=1;
	if(!telefono) alerta=1;
	if(!direccion) alerta=1;
	if(!hubicacion) alerta=1;
	if(alerta==1){
		if(!comprueba(edad)) alert('La edad debe ser expresada en digitos numericos');
		if(!comprueba(telefono)) alert('El telefono debe expresarse solo en caracteres numericos');
		if(!nombrep) alert('Falto ingresar el Nombre');
		if(!edad) alert('Falto ingresar la Edad');
		if(!sexo) alert('Falto ingresar el Sexo');
		if(!direccion) alert('Falto ingresar la direccion');
		if(!hubicacion) alert('Falto ingresar la ubicacion');		
	}
	else{
		ajax.open("POST","agregarPacientes.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("cedulap="+cedula+"&nombrep="+nombrep+"&edad="+edad+"&sexo="+sexo+"&telefono="+telefono+"&email="+email+"&direccion="+direccion+"&hubicacion="+hubicacion);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divpaciente.innerHTML=respuesta;
			}
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
	var hrxtorax=document.getElementById("formulario").hrxtorax.value;
	var hecg=document.getElementById("formulario").hecg.value;
	ajax.open("POST","agregarExamen.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
	ajax.send("hpaciente="+hpaciente+"&tensarte="+tensarte+"&freqcard="+freqcard+"&freqresp="+freqresp+"&peso="+peso+"&talla="+talla+"&aspecto="+aspecto+"&hrxtorax="+hrxtorax+"&hecg="+hecg);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divexamen.innerHTML=respuesta;
		}
	}
}
function ValorRxN(){
	var ajax=nuevoAjax();
	var divrx=document.getElementById("rx");
	ajax.open("POST","rxn.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divrx.innerHTML=respuesta;
		}
	}
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
function ValorRxS(){
	var ajax=nuevoAjax();
	var divrx=document.getElementById("rx");
	ajax.open("POST","rx.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divrx.innerHTML=respuesta;
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
function editarPacientes(){
	var ajax=nuevoAjax();
	var divpaciente=document.getElementById("paciente");
	var cedula=document.getElementById("formulario").cedulap.value;
	var idpaciente=document.getElementById("formulario").idpaciente.value;
	var nombrep=document.getElementById("formulario").nombrep.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var email=document.getElementById("formulario").email.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var hubicacion=document.getElementById("formulario").hubicacion.value;
	ajax.open("POST","actualizarPacientes.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idpaciente="+idpaciente+"&cedulap="+cedula+"&nombrep="+nombrep+"&edad="+edad+"&sexo="+sexo+"&telefono="+telefono+"&email="+email+"&direccion="+direccion+"&hubicacion="+hubicacion);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divpaciente.innerHTML=respuesta;
		}
	}
}
function updatePacientes(){
	var alerta=0;
	var ajax=nuevoAjax();
	var divpaciente=document.getElementById("paciente");
	var cedula=document.getElementById("formulario").cedulap.value;
	var idpaciente=document.getElementById("formulario").idpaciente.value;
	var nombrep=document.getElementById("formulario").nombrep.value;
	var edad=document.getElementById("formulario").edad.value;
	var sexo=document.getElementById("formulario").sexo.value;
	var telefono=document.getElementById("formulario").telefono.value;
	var email=document.getElementById("formulario").email.value;
	var direccion=document.getElementById("formulario").direccion.value;
	var hubicacion=document.getElementById("formulario").hubicacion.value;
	if(!comprueba(edad)) alerta=1;
	if(!comprueba(telefono)) alerta=1;
	if(!nombrep) alerta=1;
	if(!edad) alerta=1;
	if(!sexo) alerta=1;
	if(!telefono) alerta=1;
	if(!direccion) alerta=1;
	if(!hubicacion) alerta=1;
	if(alerta==1){
		if(!comprueba(edad)) alert('La edad debe ser expresada en digitos numericos');
		if(!comprueba(telefono)) alert('El telefono debe expresarse solo en caracteres numericos');
		if(!nombrep) alert('Falto ingresar el Nombre');
		if(!edad) alert('Falto ingresar la Edad');
		if(!sexo) alert('Falto ingresar el Sexo');
		if(!direccion) alert('Falto ingresar la direccion');
		if(!hubicacion) alert('Falto ingresar la ubicacion');		
	}
	else{
		ajax.open("POST","updatePaciente.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("idpaciente="+idpaciente+"&cedulap="+cedula+"&nombrep="+nombrep+"&edad="+edad+"&sexo="+sexo+"&telefono="+telefono+"&email="+email+"&direccion="+direccion+"&hubicacion="+hubicacion);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divpaciente.innerHTML=respuesta;
			}
		}
	}
}
function paciente(){
	var ajax=nuevoAjax();
	var divpaciente=document.getElementById("paciente");
	var cedula=form.cedulap.value;
	ajax.open("POST","paciente.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("cedula="+cedula);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divpaciente.innerHTML=respuesta;
		}
	}
}
function diagex(){
	var ajax=nuevoAjax();
	var divdiagex=document.getElementById("diagex");
	ajax.open("POST","diagex.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divdiagex.innerHTML=respuesta;
		}
	}
}
function modalRespuesta(){
	datos=dialogArguments;
	var ajax=nuevoAjax();
	var divmodalResp=document.getElementById("modalResp");
	ajax.open("POST","modalRespuesta.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id="+datos);
	ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divmodalResp.innerHTML=respuesta;
			}
		}
}
function abrirRespuestas(id){
	var res=0;
	var id;
	var punto =".";
	muestraMensaje(punto);
	datosModal=window.showModalDialog('respuesta.php',id,'dialogWidth:655px;dialogHeight:300px;dialogLeft:320;dialogTop:320;status:0;unadorned:yes;toolbar:0;help:no');
	if(!datosModal) res=1;
	if(res==0){
		var ajax=nuevoAjax();
		var divmodalResp=document.getElementById("respuestas");
		ajax.open("POST","updateRespuesta.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("id="+datosModal);
		ajax.onreadystatechange=function()
			{
				if (ajax.readyState==4)
				{
					var respuesta=ajax.responseText;
					divmodalResp.innerHTML=respuesta;
				}
			}
	}
}
function validaForm(){
	error=0;
	var ajax=nuevoAjax();
	var divformContenedor=document.getElementById("formContenedor");
	var idmedico=document.getElementById("formulario").idmedico.value;
	var idpaciente=document.getElementById("formulario").idpaciente.value;
	var examen=document.getElementById("formulario").examen.value;
	var diagnostico=document.getElementById("formulario").diagnostico.value;
	var himagen=document.getElementById("formulario").himagen.value;
	var establecimiento=document.getElementById("formulario").establecimiento.value;
	if (!idmedico) error=1;
	if (!idpaciente) error=1;
	if (!examen) error=1;
	if (!diagnostico) error=1;
	if (!himagen) error=1;
 	if (error==1)
	{
		if (!idmedico) alert("Falta Ingresar los datos del medico");
		if (!idpaciente) alert("Falta Ingresar los datos del paciente");
		if (!examen) alert("Falta Ingresar los examenes fisicos");
		if (!diagnostico) alert("Falta Ingresar el diagnostico");
		if (!himagen) alert("Falta anexar la imagen");
	}
	else
	{ 
		ajax.open("POST", "insert_reporte.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("idmedico="+idmedico+"&idpaciente="+idpaciente+"&examen="+examen+"&diagnostico="+diagnostico+"&himagen="+himagen+"&establecimiento="+establecimiento);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				var respuesta=ajax.responseText;
				divformContenedor.innerHTML=respuesta;
			}
		} 
 	} 
}
function editarMedico(){
	var ajax=nuevoAjax();
	var divmedico=document.getElementById("medico");
	var idmedico=document.getElementById("formulario").idmedico.value;
	var cedulam=document.getElementById("formulario").cedulam.value;
	var nombrem=document.getElementById("formulario").nombrem.value;
	var establecimiento=document.getElementById("formulario").establecimiento.value;	
	ajax.open("POST","editarMedico.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idmedico="+idmedico+"&cedulam="+cedulam+"&nombrem="+nombrem+"&establecimiento="+establecimiento);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmedico.innerHTML=respuesta;
		}
	}
}
function guardarMedico(){
	var ajax=nuevoAjax();
	var divmedico=document.getElementById("medico");
	var idmedico=document.getElementById("formulario").idmedico.value;
	var cedulam=document.getElementById("formulario").cedulam.value;
	var nombrem=document.getElementById("formulario").nombrem.value;
	var establecimiento=document.getElementById("formulario").establecimiento.value;	
	ajax.open("POST","guardarMedico.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idmedico="+idmedico+"&cedulam="+cedulam+"&nombrem="+nombrem+"&establecimiento="+establecimiento);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmedico.innerHTML=respuesta;
		}
	}
}
function medico(){
	var ajax=nuevoAjax();
	var divmedico=document.getElementById("medico");
	ajax.open("POST","medico.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("cedula="+medico);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmedico.innerHTML=respuesta;
		}
	}
}
function frmmedico(){
	var ajax=nuevoAjax();
	var divmedico=document.getElementById("medico");
	var cedulam=document.getElementById("formulario").cedulam.value;
	ajax.open("POST","frmmedico.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("cedula="+cedulam);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divmedico.innerHTML=respuesta;
		}
	}
}
function botones(){
	var ajax=nuevoAjax();
	var divbotones=document.getElementById("botones");
	ajax.open("POST","botones.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			divbotones.innerHTML=respuesta;
		}
	}
}
function ubicacion(){
	var id;
	datosModal=window.showModalDialog('modal.php',id,'dialogWidth:550px;dialogHeight:400px;dialogLeft:10;dialogTop:200;status:0;unadorned:yes;toolbar:0;help:no');
	form.hubicacion.value=datosModal;	
}
function cerrarRespuesta(id){
	returnValue = id;
	window.close();
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
function limpiaForm(){
	for(i=0; i<=4; i++)
	{
		form.elements[i].className=claseNormal;
	}
	document.getElementById("inputDireccion").className=claseNormal;
}
function campoError(campo){
	campo.className=claseError;
	error=1;
}
function ocultaMensaje(){
	divTransparente.style.display="none";
}
function muestraMensaje(mensaje){
	divMensaje.innerHTML=mensaje;
	divTransparente.style.display="block";
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
function validaCorreo(valor){
	var reg=/(^[a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30}$)/;
	if(reg.test(valor)) return true;
	else return false;
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
var listadoSelects=new Array();
listadoSelects[0]="municipio";
listadoSelects[1]="parroquia";
function buscarEnArray(array, dato){
	// Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
	var x=0;
	while(array[x])
	{
		if(array[x]==dato) return x;
		x++;
	}
	return null;
}
function cargaContenido(idSelectOrigen){
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
	if(opcionSeleccionada==0)
	{
		var x=posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x])
		{
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1])
	{
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		//ajax.open("GET", "select_dependientes_proceso.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);
		ajax.open("GET", "parroquia.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.modal.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
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
function devuelve(id){
	returnValue = id;
	window.close();
}
