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
	require_once("logica/log_gastos.php");
	$tabla=log_obtener_gasto($_GET["id"]);
	$registro=mysql_fetch_array($tabla);

	$_SESSION['Codigo']=$registro['Codigo'];/*Codigo_entrada*/
	$_SESSION['tipo']=$registro['Tipo'];/*tipo entrada*/
	//$_SESSION['']=$_SESSION["idusuarios"];/*idusuario*/
	//$params[3]=$_SESSION["idBodega"];
	$_SESSION['lugarcon']=$registro['Lugarcon'];
	$_SESSION['proveedor']=$registro['Proveedor'];
	$_SESSION['partida']=$registro['Partida'];
	$_SESSION['documento']=$registro['Documento'];
	$_SESSION['fovial']=$registro['Fovial'];
	$_SESSION['observaciones']=$registro['Observaciones'];
	$_SESSION['justifica']=$registro['Justificacion'];
	$_SESSION['fecha']=$registro['Fecha'];
	$_SESSION['renta']=$registro['Renta'];
	$_SESSION['codigoempl']=$registro['Codigoempl'];
	$_SESSION['descuento']=$registro['Descuento'];
	$_SESSION['remesa']=$registro['Remesa'];

	//$_SESSION['parametros']=$params;

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$_SESSION['fecha'].'">';
?>
</body>
</html>