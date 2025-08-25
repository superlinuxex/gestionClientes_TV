<?php
 {
error_reporting (5);
	$elusuario=$_GET['ti'];
        require_once("logica/log_usuarios.php");
        $datosusuario=log_obtener_usuario($elusuario);
	$datou3=mysql_fetch_array($datosusuario);
        $nomusu=$datou3['Nombre'];
        $apeusu=$datou3['Apellido'];

	require_once("logica/log_facturas.php");
	$tabla3=log_obtener_ventausuario($elusuario);
	$regis3=mysql_fetch_array($tabla3);
        $montousuario=$regis3['ventas'];
        $nombre=$regis3['nombre'];
        $apellido=$regis3['apellido'];
	$fecha_ini=$_GET['fd'];
	$fecha_fin=$_GET['fh'];
	//$bod=$regis3['idbodega'];
	$bod=$_GET['bod'];

	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_ventas_usuario($fecha_ini,$fecha_fin,$elusuario,$bod);
        
	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
No hay registros con esas fechas para ese cajero </strong>
	</div>';
	exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 $fechai=$_GET['fd'];
//         $fechaf=$_GET['fh'];
	 $cod_bodega=$bod;
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


         $xyzfecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
         $xyzfecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
         $xyzsentencia2 = "select * FROM cortescaja where usuario='".$elusuario."'  and fecha>=str_to_date('$xyzfecha_ini','%d-%m-%Y') and fecha<=str_to_date('$xyzfecha_fin','%d-%m-%Y')";
         $xyzresultado2 = mysql_query($xyzsentencia2);


	 mysql_data_seek($resultado, 0); 

$fechai=substr($fechai,0,2)."-".substr($fechai,3,2)."-".substr($fechai,6,4);
//$fechaf=substr($fechaf,0,2)."-".substr($fechaf,3,2)."-".substr($fechaf,6,4);

        require_once('tcpdf/tcpdf.php');
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Erving Chamagua');
	//$pdf->SetTitle($_POST['reporte_name']);
	$pdf->setPrintHeader(false); 
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(20, 20, 20, false); 
	$pdf->SetAutoPageBreak(true, 20); 
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();
 	$content = '';

ob_start();

$content .= '


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
<title>Customerscabletv - Reporte de ventas por pagos de recibos</title>
</head>
<body>
	<div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:20px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>
	
		<div style="position:absolute;left:100px;top:20px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Cobros realizados por cajero</strong></span>
		</div>
		<div style="position:absolute;left:400px;top:50px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:20px;"><strong>Nombre: </strong>'.$nomusu.'<strong>Apellido: </strong>'.$apeusu.'</span>
		</div>
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:100%;height:1px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>


		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
		<tr>
				<td class="FilaNI" style="height: 22px;width:40px"><strong>No.</strong></td>
				<td class="FilaN" style="height: 22px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Cliente</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Recibo</strong></td>
				<td class="FilaN" style="height: 22px;width:70px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px;width:100px"><strong>Concepto de Pago</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Precio</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Desc.</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Total</strong></td>
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
				$xsucu=$fila['sucursal'];
				$sentencia = "select nombre,apellido from clientes where cod_cliente='".$codcliente."' and sucursal='".$xsucu."'";  
				$resultado2 = mysql_query($sentencia);
				if(mysql_num_rows ( $resultado2 )!=0)
				  {
				    $filaz=mysql_fetch_array($resultado2);
				    $xncliente=$filaz['nombre']." ".$filaz['apellido'];
				  }

				//Buscando el descuento general de la factura para que cuadre con el detalle
				$xydescuento=0;
				$xynumero=$fila['numero'];
				$xyfechafac=$fila['fechafac'];
				$xytipofac=$fila['tipofac'];
				$sentencia = "select descuento from facturas where numero='".$xynumero."' and fechafac='".$xyfechafac."' and tipofac='".$xytipofac."' and sucursal='".$cod_bodega."'";  
				$resultado2 = mysql_query($sentencia);
				if(mysql_num_rows ( $resultado2 )!=0)
				  {
				    $filaz=mysql_fetch_array($resultado2);
				    $xydescuento=$filaz['descuento'];
				  }

                                $total1=$fila['total']-$xydescuento;
                                $total=number_format($total1, 2, ".", ",");
                                $xydescuento2=number_format($xydescuento, 2, ".", ",");

			        $content .= '
					<tr>
						<td class="FilaNI" style="height: 22px; font-size:20px; text-align: center">'.$cuentafila.'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$fila['cod_cliente'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$xncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$fila['numero'].'</td>
						<td class="FilaN" style="height: 22px;width:70px;font-size:20px; text-align: center">'.$fila['fechafac'].'</td>
						<td class="FilaN" style="height: 22px;width:100px; font-size:20px; text-align: center">'.$fila['concepto'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$fila['precio'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$xydescuento2.'</td>
						<td class="FilaNF" style="height: 22px;font-size:20px; text-align: right">'.$total.'</td>
					</tr>';	
                          	$cuentafila+=1;

				if($fila['anulada']==0 or $fila['anulada']=="")  //suma solo si no esta anulada
				  {
					$sumatotal+=$total1;
				  } 
                          	
				if($cuentafila>48)
				{
				    $espacios=1;
				    while ($espacios<100)
					{
	       	                         $content .= '
					<tr>
					<td></td>
				 	</tr>';	
	       	                 	$espacios+=1;
					}
				 $content .= '			
				 <tr>
				<td class="FilaNI2" style="height: 22px"><strong>No.</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Cliente</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Recibo</strong></td>
				<td class="FilaN2" style="height: 22px;width:70px"><strong>Fecha</strong></td>
				<td class="FilaN2" style="height: 22px;width:70px"><strong>Concepto de pago</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Precio</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Desc.</strong></td>
				<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Total</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumatotal, 2, ".", ",");

		        $content .= '
			<tr>
						<td class="FilaNI2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px;width:70px;font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaNF2" style="height: 22px;font-size:20px; text-align: right">'.$sumatotalgen.'</td>

			</tr>';	
                          	$cuentafila+=1;
                                $saldoinicial=$montousuario+$total;
                                $gastos=0;
                                $totalefectivo=$saldoinicial-gastos;

   	 		mysql_data_seek($xyzresultado2, 0); 
			 $content .= '			
			 <tr>
			<td class="FilaNI2" style="height: 22px"><strong>Fecha</strong></td>
			<td class="FilaN2" style="height: 22px"><strong>Hora Inicio</strong></td>
			<td class="FilaN2" style="height: 22px"><strong>Monto Inicial</strong></td>
			<td class="FilaN2" style="height: 22px;width:70px"><strong>Ventas</strong></td>
			<td class="FilaN2" style="height: 22px;width:100px"><strong>Observaciones</strong></td>
			<td class="FilaN2" style="height: 22px"><strong>Hora Final</strong></td>
			<td class="FilaN2" style="height: 22px"><strong>Monto Final</strong></td>
			<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Dif.</strong></td>
			 </tr>';	

			while ( $prfila = mysql_fetch_array($xyzresultado2))
			{
		        $content .= '
						<tr>
						<td class="FilaNI" style="height: 22px; font-size:20px; text-align: center">'.$prfila['fecha'].'</td>
						<td class="FilaN" style="height: 22px;  font-size:20px; text-align: center">'.$prfila['hora'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$prfila['montoabre'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$prfila['ventas'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$prfila['observa'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$prfila['horacierre'].'</td>
						<td class="FilaN" style="height: 22px; font-size:20px; text-align: center">'.$prfila['montocierra'].'</td>
						<td class="FilaNF" style="height: 22px;font-size:20px; text-align: right">'.$prfila['diferencia'].'</td>
					</tr>';	
                          	$cuentafila+=1;
                         	
			}  //fin del while

			$content .= '
		</table>
	</div>
</body>
</html>';
 }

ob_end_clean();
$pdf->writeHTML($content, true, 0, true, 0);
$pdf->lastPage();
$pdf->output('pdfRep_pagosreci.pdf', 'I');

?>