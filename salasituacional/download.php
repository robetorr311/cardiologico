<?
	# El parámetro f=1 indica que se va a forzar a bajar el archivo
	$id = $_GET['id'];	
	$f=$_GET['f'];
	$idexamen=$_GET['idexamen'];
	include("../cardiologico/datos/conectar.php");
	# Recupera el archivo en base al ID
	$sql = "select id,hpaciente,fecha,archivo,tipo,size,coalesce(product_image,'-1') as product_image from ecg where id=$id";
	$result=pg_query($conexion, $sql);
	/* select id,hpaciente,fecha,archivo,tipo,size,coalesce(product_image,'-1')
	
	*/
	# Si no existe, redirecciona a la página principal
	if(!$result || pg_num_rows($result)<1){
		header("Location: examen.php?id=$idexamen");
		exit();
	}
	# Recupera los atributos del archivo
	$row=pg_fetch_array($result,0);
	pg_free_result($result);
	# Para determinar si archivo a bajar fue ingresado al campo archivo_oid (es de tipo "oid")
	$isoid=false;
	if($row['product_image']==-1) $isoid=true;
	if($row['product_image']==-1) die('No existe el archivo para mostrar o bajar');
	if($isoid){
		# Inicia la transacción
		pg_query($link, "begin");
		# Abre el objeto blob
		$file=pg_lo_open($link, $row['product_image'], "r");
	}
	else{
		# Hace el proceso inverso a pg_escape_bytea, para que el archivo esté en su estado original
		$file=pg_unescape_bytea($row['product_image']);
	}
	# Envío de cabeceras
	header("Cache-control: private");
	header("Content-type: $row[tipo]");
	if($f==1)
	header("Content-Disposition: attachment; filename=\"$row[archivo]\"");
	header("Content-length: $row[size]");
	header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	
	if($isoid){
		# Imprime el contenido del objeto blob
		pg_lo_read_all($file);
		# Cierra el objeto
		pg_lo_close($file);
		# Compromete la transacción
		pg_query($link, "commit");
	}
	else{
		# Imprime el contenido del archivo
		print $file;
	}
	pg_close($link);	
?>
