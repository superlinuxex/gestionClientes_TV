<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_ventas_cuotas($_GET['fd'],$_GET['fh'],$_GET['bod']);
        
	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos para esas fechas en esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 $fechai=$_GET['fd'];
         $fechaf=$_GET['fh'];
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

$fechai=substr($fechai,0,2)."-".substr($fechai,3,2)."-".substr($fechai,6,4);
$fechaf=substr($fechaf,0,2)."-".substr($fechaf,3,2)."-".substr($fechaf,6,4);


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
<title>SICCAE - Reporte cuotas pagadas por clientes</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Cuotas pagadas por clientes</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Factura</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Tipo</strong></td>
				<td class="FilaN" style="height: 22px";width:70px><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Concepto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Precio</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Descuento</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Total</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Anulada</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumatotal=0;
                        $sumaiva=0;
                        $sumamonto=0;
			while ( $fila = mysql_fetch_array($resultado))
			{
				  if($fila['anulada']==1)
				  {
				   $xanulada="SI";
				  }
					else
			 	 {
				   $xanulada="NO";
				  }

				//Buscando el nombre del cliente
				$xncliente="";
				$codcliente=$fila['cod_cliente'];
				$sentencia = "select nombre,apellido from clientes where cod_cliente='".$codcliente."' and sucursal='".$cod_bodega."'";  
				$resultado2 = mysql_query($sentencia);
				if(mysql_num_rows ( $resultado2 )!=0)
				  {
				    $filaz=mysql_fetch_array($resultado2);
				    $xncliente=$filaz['nombre']." ".$filaz['apellido'];
				  }


                                $total1=$fila['total'];
                                $total=number_format($total1, 2, ".", ",");

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px; font-size:10px; text-align: center">'.$fila['cod_cliente'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['numero'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['tipo'].'</td>
						<td class="FilaN" style="height: 22px;width:70px;font-size:10px; text-align: center">'.$fila['fechafac'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['concepto'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['precio'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['descuento'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['total'].'</td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align: right">'.$xanulada.'</td>
					</tr>';	
                          	$cuentafila+=1;
				$sumatotal+=$total;
                          	
				if($cuentafila>48)
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
				<td class="FilaNI2" style="height: 22px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Factura</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Tipo</strong></td>
				<td class="FilaN2" style="height: 22px";width:70px><strong>Fecha</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Concepto</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Precio</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Descuento</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Total</strong></td>
				<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Anulada</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumatotal, 2, ".", ",");

		        echo '
			<tr>
						<td class="FilaNI2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px;width:70px;font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumatotalgen.'</td>
						<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: right"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
?>