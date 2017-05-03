/**
* SUBMODAL v1.6
* Used for displaying DHTML only popups instead of using buggy modal windows.
*
* By Subimage LLC
* http://www.subimage.com
*
* Contributions by:
* 	Eric Angel - tab index code
* 	Scott - hiding/showing selects for IE users
*	Todd Huss - inserting modal dynamically and anchor classes
*
* Up to date code can be found at http://submodal.googlecode.com
*/

// Popup code
var gPopupMask = null;
var gPopupContainer = null;
var gPopFrame = null;
var gReturnFunc;
var gPopupIsShown = false;
var gDefaultPage = "../conector/loading.html";
var gHideSelects = false;
var gReturnVal = null;

var gTabIndexes = new Array();
// Pre-defined list of tags we want to disable/enable tabbing into
var gTabbableTags = new Array("A", "BUTTON", "TEXTAREA", "INPUT", "IFRAME");

// If using Mozilla or Firefox, use Tab-key trap.
if (!document.all) {
    document.onkeypress = keyDownHandler;
}

/**
* Initializes popup code on load.	
*/
function initPopUp() {
    // Add the HTML to the body
    theBody = document.getElementsByTagName('BODY')[0];
    popmask = document.createElement('div');
    popmask.id = 'popupMask';
    popcont = document.createElement('div');
    popcont.id = 'popupContainer';
    popcont.innerHTML = '' +
		'<div id="popupInner">' +
			'<div id="popupTitleBar">' +
				'<div id="popupTitle"></div>' +
				'<div id="popupControls">' +
					'<img src="../Imagenes/topwin.gif"  id="popCloseBox" />' +
				'</div>' +
			'</div>' +
			'<iframe src="' + gDefaultPage + '" style="width:100%;height:100%;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="100%" height="100%"></iframe>' +
		'</div>';
    theBody.appendChild(popmask);
    theBody.appendChild(popcont);

    gPopupMask = document.getElementById("popupMask");
    gPopupContainer = document.getElementById("popupContainer");
    gPopFrame = document.getElementById("popupFrame");

    //onclick="hidePopWin(false);" check to see if this is IE version 6 or lower. hide select boxes if so
    // maybe they'll fix this in version 7?
    var brsVersion = parseInt(window.navigator.appVersion.charAt(0), 10);
    if (brsVersion <= 6 && window.navigator.userAgent.indexOf("MSIE") > -1) {
        gHideSelects = true;
    }

    // Add onclick handlers to 'a' elements of class submodal or submodal-width-height
    var elms = document.getElementsByTagName('a');
    for (i = 0; i < elms.length; i++) {
        if (elms[i].className.indexOf("submodal") == 0) {
            // var onclick = 'function (){showPopWin(\''+elms[i].href+'\','+width+', '+height+', null);return false;};';
            // elms[i].onclick = eval(onclick);
            elms[i].onclick = function () {
                // default width and height
                var width = 400;
                var height = 200;
                // Parse out optional width and height from className
                params = this.className.split('-');
                if (params.length == 3) {
                    width = parseInt(params[1]);
                    height = parseInt(params[2]);
                }
                showPopWin(this.href, width, height, null); return false;
            }
        }
    }
}
addEvent(window, "load", initPopUp);

/**
* @argument width - int in pixels
* @argument height - int in pixels
* @argument url - url to display
* @argument returnFunc - function to call when returning true from the window.
* @argument showCloseBox - show the close box - default true
*/
function showPopWin(url, width, height, htipo, returnFunc, showCloseBox) {
    // show or hide the window close widget
    if (showCloseBox == null || showCloseBox == true) {
        document.getElementById("popCloseBox").style.display = "block";
    } else {
        document.getElementById("popCloseBox").style.display = "none";
    }
    gPopupIsShown = true;
    disableTabIndexes();
    gPopupMask.style.display = "block";
    gPopupContainer.style.display = "block";
    // calculate where to place the window on screen
    centerPopWin(width, height);

    var titleBarHeight = parseInt(document.getElementById("popupTitleBar").offsetHeight, 10);


    gPopupContainer.style.width = width + "px";
    gPopupContainer.style.height = (height + titleBarHeight) + "px";

    setMaskSize();

    // need to set the width of the iframe to the title bar width because of the dropshadow
    // some oddness was occuring and causing the frame to poke outside the border in IE6
    gPopFrame.style.width = parseInt(document.getElementById("popupTitleBar").offsetWidth, 10) + "px";
    gPopFrame.style.height = (height) + "px";

    // set the url
    gPopFrame.src = url;

    gReturnFunc = returnFunc;
    // for IE
    if (gHideSelects == true) {
        hideSelectBoxes();
    }

    window.setTimeout("setPopTitle();", 600);
}

//
var gi = 0;
function centerPopWin(width, height) {
    if (gPopupIsShown == true) {
        if (width == null || isNaN(width)) {
            width = gPopupContainer.offsetWidth;
        }
        if (height == null) {
            height = gPopupContainer.offsetHeight;
        }

        //var theBody = document.documentElement;
        var theBody = document.getElementsByTagName("BODY")[0];
        //theBody.style.overflow = "hidden";
        var scTop = parseInt(getScrollTop(), 10);
        var scLeft = parseInt(theBody.scrollLeft, 10);

        setMaskSize();

        //window.status = gPopupMask.style.top + " " + gPopupMask.style.left + " " + gi++;

        var titleBarHeight = parseInt(document.getElementById("popupTitleBar").offsetHeight, 10);

        var fullHeight = getViewportHeight();
        var fullWidth = getViewportWidth();

        gPopupContainer.style.top = (scTop + ((fullHeight - (height + titleBarHeight)) / 2)) + "px";
        gPopupContainer.style.left = (scLeft + ((fullWidth - width) / 2)) + "px";
        //alert(fullWidth + " " + width + " " + gPopupContainer.style.left);
    }
}
addEvent(window, "resize", centerPopWin);
addEvent(window, "scroll", centerPopWin);
window.onscroll = centerPopWin;


/**
* Sets the size of the popup mask.
*
*/
function setMaskSize() {
    var theBody = document.getElementsByTagName("BODY")[0];

    var fullHeight = getViewportHeight();
    var fullWidth = getViewportWidth();

    // Determine what's bigger, scrollHeight or fullHeight / width
    if (fullHeight > theBody.scrollHeight) {
        popHeight = fullHeight;
    } else {
        popHeight = theBody.scrollHeight;
    }

    if (fullWidth > theBody.scrollWidth) {
        popWidth = fullWidth;
    } else {
        popWidth = theBody.scrollWidth;
    }

    gPopupMask.style.height = popHeight + "px";
    gPopupMask.style.width = popWidth + "px";
}

/**
* @argument callReturnFunc - bool - determines if we call the return function specified
* @argument returnVal - anything - return value 
*/
function hidePopWin(callReturnFunc, valor1, valor2, valor3, valor4, valor5) {
    gPopupIsShown = false;
    var theBody = document.getElementsByTagName("BODY")[0];
    theBody.style.overflow = "";
    restoreTabIndexes();
    if (gPopupMask == null) {
        return;
    }
    gPopupMask.style.display = "none";
    gPopupContainer.style.display = "none";
    if (callReturnFunc == true && gReturnFunc != null) {
        // Set the return code to run in a timeout.
        // Was having issues using with an Ajax.Request();
        gReturnVal = window.frames["popupFrame"].returnVal;
        window.setTimeout('gReturnFunc(gReturnVal);', 1);
    }
    gPopFrame.src = gDefaultPage;
    // display all select boxes
    if (gHideSelects == true) {
        displaySelectBoxes();
    }
    if (valor1 == "geo") {
        document.getElementById("form1").TextBox1.value = valor2;
        document.getElementById("form1").num_region.value = valor3;
    }
    if (valor1 == "herp") {
        document.getElementById("form1").herenciap.value = valor2;
    }
    if (valor1 == "herm") {
        document.getElementById("form1").herenciam.value = valor2;
    }
    if (valor1 == "herh") {
        document.getElementById("form1").herenciah.value = valor2;
    }
    if (valor1 == "antecedentes") {
        document.getElementById("form1").Hvhantecedentes.value = valor2;
    }
    if (valor1 == "angina") {
        document.getElementById("form1").vhangina.value = valor2;
    }
    if (valor1 == "examenf") {
        document.getElementById("form1").vhexamenf.value = valor2;
        document.getElementById("form1").vhpa.value = valor3;
        document.getElementById("form1").vhfc.value = valor4;
        document.getElementById("form1").vhpeso.value = valor5;
    }
    if (valor1 == "ecgi") {
        document.getElementById("form1").vhecgi.value = valor2;
    }
    if (valor1 == "ecg") {
        document.getElementById("form1").vhecg.value = valor2;
    }
    if (valor1 == "laboratoriomax") {
        document.getElementById("form1").vhlaboratoriomax.value = valor2;
    }
    if (valor1 == "laboratorio") {
        document.getElementById("form1").vhlaboratorio.value = valor2;
        document.getElementById("form1").vhcreatinina.value = valor3;
        document.getElementById("form1").vhifglom.value = valor4;
    }
    if (valor1 == "ecocardiograma") {
        document.getElementById("form1").vhecocardiograma.value = valor2;
    }
    if (valor1 == "angiograma") {
        document.getElementById("form1").vhangiograma.value = valor2;
    }
    if (valor1 == "enfermedad") {
        document.getElementById("form1").vhenfermedad.value = valor2;
    }
    if (valor1 == "diagnostico") {
        document.getElementById("form1").vhdiagnostico.value = valor2;
    }
    if (valor1 == "diagnosticoi") {
        document.getElementById("form1").vhdiagnosticoi.value = valor2;
    }
    if (valor1 == "tratamiento") {
        document.getElementById("form1").vhtratamiento.value = valor2;
    }
    if (valor1 == "rxtorax") {
        document.getElementById("form1").vhrxtorax.value = valor2;
    }
    if (valor1 == "motivo") {
        document.getElementById("form1").vhmotivo.value = valor2;
    }
    if (valor1 == "egreso") {
        document.getElementById("form1").vhegreso.value = valor2;
    }
    if (valor1 == "nyha") {
        document.getElementById("form1").vhnyha.value = valor2;
    }
}

/**
* Sets the popup title based on the title of the html document it contains.
* Uses a timeout to keep checking until the title is valid.
*/
function setPopTitle() {
    return;
    if (window.frames["popupFrame"].document.title == null) {
        window.setTimeout("setPopTitle();", 10);
    } else {
        document.getElementById("popupTitle").innerHTML = window.frames["popupFrame"].document.title;
    }
}

// Tab key trap. iff popup is shown and key was [TAB], suppress it.
// @argument e - event - keyboard event that caused this function to be called.
function keyDownHandler(e) {
    if (gPopupIsShown && e.keyCode == 9) return false;
}

// For IE.  Go through predefined tags and disable tabbing into them.
function disableTabIndexes() {
    if (document.all) {
        var i = 0;
        for (var j = 0; j < gTabbableTags.length; j++) {
            var tagElements = document.getElementsByTagName(gTabbableTags[j]);
            for (var k = 0; k < tagElements.length; k++) {
                gTabIndexes[i] = tagElements[k].tabIndex;
                tagElements[k].tabIndex = "-1";
                i++;
            }
        }
    }
}

// For IE. Restore tab-indexes.
function restoreTabIndexes() {
    if (document.all) {
        var i = 0;
        for (var j = 0; j < gTabbableTags.length; j++) {
            var tagElements = document.getElementsByTagName(gTabbableTags[j]);
            for (var k = 0; k < tagElements.length; k++) {
                tagElements[k].tabIndex = gTabIndexes[i];
                tagElements[k].tabEnabled = true;
                i++;
            }
        }
    }
}


/**
* Hides all drop down form select boxes on the screen so they do not appear above the mask layer.
* IE has a problem with wanted select form tags to always be the topmost z-index or layer
*
* Thanks for the code Scott!
*/
function hideSelectBoxes() {
    var x = document.getElementsByTagName("SELECT");

    for (i = 0; x && i < x.length; i++) {
        x[i].style.visibility = "hidden";
    }
}

/**
* Makes all drop down form select boxes on the screen visible so they do not 
* reappear after the dialog is closed.
* 
* IE has a problem with wanting select form tags to always be the 
* topmost z-index or layer.
*/
function displaySelectBoxes() {
    var x = document.getElementsByTagName("SELECT");

    for (i = 0; x && i < x.length; i++) {
        x[i].style.visibility = "visible";
    }
}

function levantapopup(paginaURL) {
    if (paginaURL == "pacientes") {
        showPopWin('frmBPaciente.aspx', 650, 400);
    }
    if (paginaURL == "antecedentes") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Antecedentes.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 400);
    }
    if (paginaURL == "detalle") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Antecedentes.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 400);
    }
    if (paginaURL == "motivo") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('MotivoConsulta.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 400);
    }
    if (paginaURL == "angiograma") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Angiograma.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 200);
    }
    if (paginaURL == "angina") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Angina.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 200);
    }
    if (paginaURL == "ecgi") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Ecgi.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 750, 350);
    }
    if (paginaURL == "ecg") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('ecg.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 750, 350);
    }
    if (paginaURL == "ecocardiograma") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('ecocardiograma.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 430);
    }
    if (paginaURL == "examenf") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Examenf.aspx?hpaciente=' + hpaciente + '&hhistoria=' + hhistoria, 650, 350);
    }
    if (paginaURL == "laboratorio") {
        var hsexo = document.getElementById("form1").vhsexo.value;
        var hraza = document.getElementById("form1").vhraza.value;
        var hedad = document.getElementById("form1").edad.value;
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('laboratorio.aspx?hsexo=' + hsexo + '&hpaciente=' + hpaciente + '&hhistoria=' + hhistoria +
                                    '&hedad=' + hedad + '&hraza=' + hraza, 650, 350);
    }
    if (paginaURL == "laboratoriomax") {
        var hsexo = document.getElementById("form1").vhsexo.value;
        var hraza = document.getElementById("form1").vhraza.value;
        var hedad = document.getElementById("form1").edad.value;
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('laboratorioMax.aspx?hsexo=' + hsexo + '&hpaciente=' + hpaciente + '&hhistoria=' + hhistoria +
                                    '&hedad=' + hedad + '&hraza=' + hraza, 650, 350);
    }
    if (paginaURL == "nyha") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        var fechaingreso = document.getElementById("form1").vfecha.value;
        var hedad = document.getElementById("form1").edad.value;
        var hifglom = document.getElementById("form1").vhifglom.value;
        var hcreatinina = document.getElementById("form1").vhcreatinina.value;
        var hpa = document.getElementById("form1").vhpa.value;
        var hfc = document.getElementById("form1").vhfc.value;
        var hpeso = document.getElementById("form1").vhpeso.value;
        var sexo = document.getElementById("form1").vhsexo.value;
        showPopWin('nyha.aspx?hpaciente=' + hpaciente +
        '&hhistoria=' + hhistoria + '&fechaingreso=' + fechaingreso +
                                    '&hedad=' + hedad + '&hraza=' + hraza
                                    + '&hifglom=' + hifglom + '&hcreatinina=' + hcreatinina
                                    + '&hpa=' + hpa + '&hfc=' + hfc
                                    + '&hpeso=' + hpeso + '&sexo=' + sexo, 650, 400);
    }
    if (paginaURL == "rxtorax") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('RadiologiaTorax.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 350);
    }
    if (paginaURL == "enfermedad") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('EnfermedadActual.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 350);
    }
    if (paginaURL == "diagnosticoi") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('DiagnosticoHistoriai.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 400);
    }
    if (paginaURL == "diagnostico") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('DiagnosticoHistoria.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 400);
    }
    if (paginaURL == "tratamiento") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Tratamiento.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 350);
    }
    if (paginaURL == "egreso") {
        var hhistoria = document.getElementById("form1").vhhistoria.value;
        var hpaciente = document.getElementById("form1").vhpaciente.value;
        showPopWin('Egreso.aspx?hhistoria=' + hhistoria + '&hpaciente=' + hpaciente, 650, 350);
    }
}
function cargar() {
    cAyuda = document.getElementById("mensajesAyuda");
    cNombre = document.getElementById("ayudaTitulo");
    cTex = document.getElementById("ayudaTexto");
    ayuda = new Array();
    ayuda["Agregar"] = "Agregar: Haz click para agregar una nueva historia clinica al sistema!";
    ayuda["Historia"] = "Historia: Numero de historia unico para cada paciente el sistema lo genera automaticamente!";
    ayuda["Cedula"] = "Cedula: Indique el numero de cedula del paciente. Al ingresar el numero de cedula el sistema buscara los datos basicos del paciente. Si no existe el paciente en la base de datos debe ingresar todos los datos!!";
    ayuda["Nombre"] = "Nombres y Apellidos del paciente";
    ayuda["Conyugal"] = "Estado civil del paciente";
    ayuda["Ocupacion"] = "Ocupacion del paciente";
    ayuda["Fecha Nacimiento"] = "Fecha de nacimiento del paciente";
    ayuda["Edad"] = "Edad del paciente el sistema la calcula automaticamente al indicar la fecha de nacimiento";
    ayuda["Sexo"] = "Sexo del paciente";
    ayuda["Raza"] = "Razgos etnicos del paciente";
    ayuda["Direccion"] = "Direccion del domicilio del Paciente";
    ayuda["Ubicacion"] = "Ubicacion geografica del paciente";
    ayuda["Telefono Fijo"] = "Numero de telefono de domicilio del paciente";
    ayuda["Telefono Movil"] = "Numero de telefono celular del paciente";
    ayuda["Correo"] = "Correo Electronico del paciente";
    ayuda["Fecha de Ingreso"] = "Fecha de ingreso del paciente a la Unidad de Cuidados Coronarios";
    ayuda["Ingreso"] = "Haz click para abrir el formulario e ingresar fecha de ingreso y motivo de consulta";
    ayuda["Angina"] = "Angina: Haz click en Si para abrir el formulario de datos de angina";
    ayuda["RX Torax"] = "Aspecto de imagen de rayos x de Torax";
    ayuda["Editar Paciente"] = "Editar Paciente: Haz click para habilitar los campos y hacer modificaciones en datos del paciente";
    ayuda["Guardar Paciente"] = "Guardar Paciente: Haz click para guardar los datos del paciente!!";
    ayuda["Actualizar Paciente"] = "Actualizar Paciente: Haz click para guardar los cambios hechos en datos del paciente!";
    ayuda["Antecedentes"] = "Antecedentes: Haz click para abrir el formulario de antecedentes del paciente";
    ayuda["Examen Fisico"] = "Examen Fisico: Haz click para abrir el formulario para cargar datos del examen fisico!";
    ayuda["Electrocardiograma"] = "Electrocardiograma:  Haz click para abrir el formulario para cargar los datos del electrocardiograma";
    ayuda["Examen de Laboratorio"] = "Examen de Laboratorio: Haz click para abrir el formulario para cargar los datos de examen de laboratorio";
    ayuda["Ecocardiograma"] = "Ecocardiograma: Haz click para abrir el formulario para cargar los datos del ecocardiograma";
    ayuda["Angiograma"] = "Angiograma: Haz click para abrir el formulario para cargar los datos del Angiograma";
    ayuda["NYHA"] = "NYHA: Haz click para abrir el formulario para cargar los datos de Grace Score, Crusade Score, Timi Score, etc...";
    ayuda["Enfermedad Actual"] = "Enfermedad Actual: Haz click para abrir el formulario que permite ingresar los comentarios acerca de la enfermedad actual del paciente";
    ayuda["Diagnostico"] = "Diagnostico: Haz click para abrir el formulario que permite ingresar los comentarios acerca del diagnostico";
    ayuda["Tratamiento"] = "Tratamiento:  Haz click para abrir el formulario que permite ingresar los comentarios acerca del tratamiento aplicado al paciente ";
    ayuda["Comentarios"] = "Comentarios:  Haz click para abrir el formulario que permite ingresar los comentarios adicionales";
    ayuda["Guardar Historia"] = "Guardar Historia:  Haz click para guardar todos los datos";
    ayuda["Seleccionar"] = "Seleccionar:  Haz click para seleccionar este registro";
    ayuda["Ver Planilla"] = "Ver Planilla:  Haz click para ver la planilla de Historia Clinica de la Unidad de Cuidados Coronarios correspondiente a este registro";
    ayuda["Cargar Datos"] = "Cargar Datos:  Haz click para cargar todos los datos de este registro en el formulario principal";
}
var xmlHttp;
function CreateXmlHttp() {

    // Probamos con IE
    try {
        // Funcionará para JavaScript 5.0
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
        try {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (oc) {
            xmlHttp = null;
        }
    }

    // Si no se trataba de un IE, probamos con esto
    if (!xmlHttp && typeof XMLHttpRequest != "undefined") {
        xmlHttp = new XMLHttpRequest();
    }

    return xmlHttp;
}
if (navigator.userAgent.indexOf("MSIE") >= 0) navegador = 0;
else navegador = 1;
function colocaAyuda(event) {
    if (navegador == 0) {
        var corX = window.event.clientX + document.documentElement.scrollLeft;
        var corY = window.event.clientY + document.documentElement.scrollTop;
    }
    else {
        var corX = event.clientX + window.scrollX;
        var corY = event.clientY + window.scrollY;
    }
    cAyuda.style.top = corY + 20 + "px";
    cAyuda.style.left = corX + 15 + "px";
}
function ocultaAyuda() {
    cAyuda.style.display = "none";
    if (navegador == 0) {
        document.detachEvent("onmousemove", colocaAyuda);
        document.detachEvent("onmouseout", ocultaAyuda);
    }
    else {
        document.removeEventListener("mousemove", colocaAyuda, true);
        document.removeEventListener("mouseout", ocultaAyuda, true);
    }
}
function muestraAyuda(event, campo) {
    colocaAyuda(event);

    if (navegador == 0) {
        document.attachEvent("onmousemove", colocaAyuda);
        document.attachEvent("onmouseout", ocultaAyuda);
    }
    else {
        document.addEventListener("mousemove", colocaAyuda, true);
        document.addEventListener("mouseout", ocultaAyuda, true);
    }
    cNombre.innerHTML = campo;
    cTex.innerHTML = ayuda[campo];
    cAyuda.style.display = "block";
}
function ocultaMensaje() {
    divTransparente = document.getElementById("transparencia");
    divMensaje = document.getElementById("transparenciaMensaje");
    divTransparente.style.display = "none";
}
function muestraMensaje(mensaje) {
    divTransparente = document.getElementById("transparencia");
    divMensaje = document.getElementById("transparenciaMensaje");
    divMensaje.innerHTML = mensaje;
    divTransparente.style.display = "block";
}

function botonantecedentes() {
    var Hvhantecedentes = document.getElementById("form1").Hvhantecedentes.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=antecedentes&valor=" + Hvhantecedentes);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button14.className = "buttons2"; } else { document.getElementById("form1").Button14.className = "buttonlleno"; }
        }
    }
}

function botonexamenf() {
    var examenf = document.getElementById("form1").vhexamenf.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=examenf&valor=" + examenf);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button1.className = "buttons2" } else { document.getElementById("form1").Button1.className = "buttonlleno" }
        }
    }
}
function botonecgi() {
    var ecgi = document.getElementById("form1").vhecgi.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=ecgi&valor=" + ecgi);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button20.className = "buttons2" } else { document.getElementById("form1").Button20.className = "buttonlleno" }
        }
    }
}
function botonecg() {
    var ecg = document.getElementById("form1").vhecg.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=ecg&valor=" + ecg);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button3.className = "buttons2" } else { document.getElementById("form1").Button3.className = "buttonlleno" }
        }
    }
}
function botonlabmax() {
    var labmax = document.getElementById("form1").vhlabmax.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "labmax.ashx?valor=" + labmax);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button26.className = "buttons2" } else { document.getElementById("form1").Button26.className = "buttonlleno" }
        }
    }
}
function botonlaboratorio() {
    var laboratorio = document.getElementById("form1").vhlaboratorio.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=laboratorio&valor=" + laboratorio);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button4.className = "buttons2" } else { document.getElementById("form1").Button4.className = "buttonlleno" }
        }
    }
}
function botonecocardiograma() {
    var ecocardiograma = document.getElementById("form1").vhecocardiograma.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=ecocardiograma&valor=" + ecocardiograma);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button5.className = "buttons2" } else { document.getElementById("form1").Button5.className = "buttonlleno" }
        }
    }
}
function botonangiograma() {
    var angiograma = document.getElementById("form1").vhangiograma.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=angiograma&valor=" + angiograma);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button7.className = "buttons2" } else { document.getElementById("form1").Button7.className = "buttonlleno" }
        }
    }
}
function botonenfermedad() {
    var enfermedad = document.getElementById("form1").vhenfermedad.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=enfermedad&valor=" + enfermedad);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button13.className = "buttons2" } else { document.getElementById("form1").Button13.className = "buttonlleno" }
        }
    }
}
function botondiagnostico() {
    var diagnostico = document.getElementById("form1").vhdiagnostico.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=diagnostico&valor=" + diagnostico);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button15.className = "buttons2" } else { document.getElementById("form1").Button15.className = "buttonlleno" }
        }
    }
}
function botondiagnosticoi() {
    var diagnostico = document.getElementById("form1").vhdiagnosticoi.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "diagi.ashx?formulario=diagi&valor=" + diagnostico);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button27.className = "buttons2" } else { document.getElementById("form1").Button27.className = "buttonlleno" }
        }
    }
}
function botonangina() {
    var angina = document.getElementById("form1").vhangina.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=angina&valor=" + angina);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button22.className = "buttons2" } else { document.getElementById("form1").Button22.className = "buttonlleno" }
        }
    }
}
function botontratamiento() {
    var tratamiento = document.getElementById("form1").vhtratamiento.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=tratamiento&valor=" + tratamiento);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button16.className = "buttons2" } else { document.getElementById("form1").Button16.className = "buttonlleno" }
        }
    }
}
function botonrxtorax() {
    var rxtorax = document.getElementById("form1").vhrxtorax.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=rxtorax&valor=" + rxtorax);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button24.className = "buttons2" } else { document.getElementById("form1").Button24.className = "buttonlleno" }
        }
    }
}
function botonmotivo() {
    var motivo = document.getElementById("form1").vhmotivo.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=motivo&valor=" + motivo);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button21.className = "buttons2" } else { document.getElementById("form1").Button21.className = "buttonlleno" }
        }
    }
}
function botonegreso() {
    var egreso = document.getElementById("form1").vhegreso.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=egreso&valor=" + egreso);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button23.className = "buttons2" } else { document.getElementById("form1").Button23.className = "buttonlleno" }
        }
    }
}
function botonnyha() {
    var nyha = document.getElementById("form1").vhnyha.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "botones.ashx?formulario=nyha&valor=" + nyha);
    xhr.send(null);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var respuesta = xhr.responseText;
            if (respuesta == "NO") { document.getElementById("form1").Button8.className = "buttons2" } else { document.getElementById("form1").Button8.className = "buttonlleno" }
        }
    }
}
function controlbotones() {
    botonangina();
    botonantecedentes();
    botonexamenf();
    botonecgi();
    botonecg();
    botonlaboratorio();
    botonlabmax();
    botonecocardiograma();
    botonangiograma();
    botonenfermedad();
    botondiagnostico();
    botondiagnosticoi();
    botontratamiento();
    botonrxtorax();
    botonmotivo();
    botonegreso();
    botonnyha();
}
