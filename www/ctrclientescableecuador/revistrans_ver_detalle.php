<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv</title>
 <?php
error_reporting (5);
 include "./utils/validar_sesion.php";
 ?>
</head>
<body>
<?php
	require_once("logica/log_revistrans.php");
	$tabla=log_obtener_revistrans_id($_GET["id"]);
	$registro=mysql_fetch_array($tabla);
	$params[0]=$registro['Codigo'];/*Codigo_salida*/
	$params[1]=$_SESSION["idusuarios"];/*idusuario*/
	$params[2]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
	$params[3]=$registro['Bodega_Origen'];/*Codigo_bodega_sal*/
	$params[4]=$registro['Observaciones'];
	$params[5]=$registro['Fecha'];
	$params[6]=$registro['Codigoempl'];
	$params[7]=$registro['Envio'];
	$_SESSION['parametros']=$params;
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=revistrans_detalle.php">';
?>
</body>
</html>