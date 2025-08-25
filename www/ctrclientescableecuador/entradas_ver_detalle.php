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
	require_once("logica/log_entradas.php");
	$tabla=log_obtener_entrada($_GET["id"]);
	$registro=mysql_fetch_array($tabla);

	$params[0]=$registro['Codigo'];/*Codigo_entrada*/
	$params[1]=$registro['Tipo'];/*tipo entrada*/
	$params[2]=$_SESSION["idusuarios"];/*idusuario*/
	$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
	if($registro['Tipo']=='4') /*SI ES TRANSFERENCIA ESPECIFICAR BODEGA DE SALIDA*/
	{
		$params[4]=$registro['Bodega_Origen'];/*Codigo_bodega_sal*/
	}
	else
	{
		$params[4]=null;/*Codigo_bodega_sal*/
	}	
	$params[5]=$registro['Proveedor'];
	$params[6]=$registro['Nenvior'];
	$params[7]=$registro['RegFiscal'];
	$params[8]=$registro['Factura'];
	$params[9]=$registro['Poliza'];
	$params[10]=$registro['Ajuste'];
	$params[11]=$registro['Observaciones'];
	$params[12]=$registro['Ntransr'];
	$params[13]=$registro['Fecha'];
	$params[14]=$registro['Ivap'];
	$params[15]=$registro['Codigoempl'];
	$params[16]=$registro['Descuento'];


	$_SESSION['parametros']=$params;

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
?>
</body>
</html>