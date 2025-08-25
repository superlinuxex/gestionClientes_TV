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
        $bodega=$_SESSION["idBodega"];
	require_once("logica/log_facturas.php");
	$tabla=log_obtener_factura($_GET["id"],$_GET["id2"],$_GET["id3"]);
	$registro=mysql_fetch_array($tabla);

	$_SESSION['factura']=$registro['numero'];
	$_SESSION['tipo']=$registro['tipofac'];
	$_SESSION['fecha']=substr($registro['fechafac'],8,2)."-".substr($registro['fechafac'],5,2)."-".substr($registro['fechafac'],0,4);
	//$_SESSION['fecha']=$registro['tipofac'];   //substr($registro['fechafac'],8,2)."/".substr($registro['fechafac'],5,2)."/".substr($registro['fechafac'],0,4);

        //substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2)
	$_SESSION['cliente']=$registro['cod_cliente'];
	$_SESSION['autoriza']=$registro['emplepago'];
	$_SESSION['lugarpago']=$registro['lugardepago'];
	$_SESSION['descuento']=$registro['descuento'];
	$_SESSION['sucursal']=$registro['sucursal'];

	
	//$params[0]=$registro['numero'];
	//$params[1]=$registro['tipofac'];
	//$params[2]=$_SESSION["idusuarios"];
	//$params[3]=$_SESSION["idBodega"];
	//$params[4]=$registro['fechafac'];
	//$params[5]=null;
	//$params[9]=$registro['cod_cliente'];
	//$params[12]=$registro['emplepago'];
	//$params[13]=$registro['lugardepago'];
	//$params[14]=substr($params[4],8,2)."-".substr($params[4],5,2)."-".substr($params[4],0,4);
	//$params[15]=$registro['descuento'];

	//$_SESSION['parametros']=$params;
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalleanu.php">';
?>
</body>
</html>