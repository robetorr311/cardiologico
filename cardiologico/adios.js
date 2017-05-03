function finalizarSession(){
	window.document.forms[0].target = '_parent';
	window.document.forms[0].action = 'cerrarsession.php';
	window.document.forms[0].submit();
}