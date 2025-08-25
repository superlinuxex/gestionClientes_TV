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
	require_once("logica/log_salidas.php");
	$tabla=log_obtener_salida($_GET["id"]);
	$registro=mysql_fetch_array($tabla);
	
	$params[0]=$registro['Codigo'];/*Codigo_entrada*/
	$params[1]=$registro['Tipo'];/*tipo entrada*/
	$params[2]=$_SESSION["idusuarios"];/*idusuario*/
	$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
	if($registro['Tipo']=='1')
	{
		$params[4]=$registro['Bodega_Destino'];/*Codigo_bodega_ent*/
	}
	else
	{
		$params[4]=null;/*Codigo_bodega_ent*/
	}	
	$params[5]=$registro['Vale'];/*Codigo_vale*/
	$params[6]=$registro['NOTADE'];
	$params[8]=$registro['RegFis'];
	$params[9]=$registro['Cod_tecnico'];
	$params[11]=$registro['MOTIVO'];
	$params[12]=$registro['Autoriza'];
	$params[13]=$registro['Observaciones'];/*Observaciones*/
	$params[14]=$registro['Fecha'];/*fecha*/
	$params[15]=$registro['Fecha2'];/*fecha*/

	$_SESSION['parametros']=$params;

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
?>
</body>
</html>