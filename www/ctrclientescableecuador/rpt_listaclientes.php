<?php
unset($_POST);
error_reporting(0);
  //Lista de datos contractuales ordenado por dia de pago ascendente y fecha de conexion descendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_listaclientes($_GET['fd'],$_GET['fh'],$_GET['estado'],$_GET['muni'],$_GET['pobla'],$_GET['caja'],$_GET['barrio']);

	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 $cod_bodega=$row['sucursal'];
	 $nom_bodega="";
         $sentencia2 = "select nombre FROM bodegas where idbodegas='".$cod_bodega."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $nom_bodega=$row['nombre'];
             }
          }

	 mysql_data_seek($resultado, 0); 


echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<style type="text/css">
.Tabla1 {
	font-weight: normal;
	color: black;
	border-top: 1pt solid black;
	background-color: white;
}
.FilaNI {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-bottom: 1pt solid black;
}
.FilaNI2 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-bottom: 1pt solid black;
	border-top: 1pt solid black;

}

.FilaN {
	font-weight: normal;
	color: black;
	text-align: center;
	border-bottom: 1pt solid black;
	border-left: 1pt solid black;
}
.FilaN2 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
	border-left: 1pt solid black;
}

.FilaNF {
	font-weight: normal;
	color: black;
	text-align: right;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	padding-right:10px;
}
.FilaNF2 {
	font-weight: normal;
	color: black;
	text-align: right;
	border-top: 1pt solid black;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	padding-right:10px;
}
</style>

<title>CUSTOMERSCABLETV - Reporte de datos de localizacion</title>
</head> 

<body>

	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de datos de localizacion de clientes</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
			<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Municipio</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Poblacion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Sector</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Caja</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Direccion</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Referencias</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $municipio=$filaz['nmuni'];
    $poblacion=$filaz['ncan'];
    $barrio=$filaz['nbar'];
    $direccion=$filaz['otraref'];
    $sector=$filaz['zona'];
    $referencia=$filaz['calle'];
    $caja=$filaz['poligono'];


			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$municipio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$poblacion.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$sector.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$caja.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$direccion.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$referencia.'</td>
					</tr>';	

                          	$cuentafila+=1;
				$sumalineas+=1;
                          	
				if($cuentafila>37)
				{
				    $espacios=1;
				    while ($espacios<100)
					{
	       	                         echo '
					<tr>
					<td></td>
				 	</tr>';	
	       	                 	$espacios+=1;
					}
				 echo '			
				 <tr>
				<td class="FilaNI2" style="height: 22px; font-size:14px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Municipio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Poblacion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Sector</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Caja</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Direccion</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Referencias</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas);
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center">Total: '.$sumatotalgen.'</td>
			</tr>';	
			echo'
		</table>
	</div>


</body>
</html>';

?>