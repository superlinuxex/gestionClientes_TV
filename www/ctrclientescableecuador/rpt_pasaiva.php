<?php
if($_GET['ti']==1)
 {
   //genera la tabla del IVA para exportar
 require_once("./logica/log_reportes.php");
 $resultado=log_obtener_ventas_iva($_GET['fd'],$_GET['fh'],$_GET['bod']);
        
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

         $sentencia = "delete from tablaiva";  
	 $resultadoa = mysql_query($sentencia);


	 mysql_data_seek($resultado, 0); 

	$fechai=substr($fechai,0,2)."-".substr($fechai,3,2)."-".substr($fechai,6,4);
	$fechaf=substr($fechaf,0,2)."-".substr($fechaf,3,2)."-".substr($fechaf,6,4);



	while ( $fila = mysql_fetch_array($resultado))
	{
          $numero=$fila['numero'];
          $tipo=$fila['tipofac'];
          $fecha=$fila['fechafac'];
          $cod_cliente=$fila['cod_cliente'];
          //$cliente=$fila['nom_clie'];
          $estado1=$fila['anulada'];
          $monto=$fila['monto'];
          $impuesto=$fila['iva'];
 	  $cod_bodega=$fila['sucursal'];
          $total=$fila['total'];

          //sacando el nombre de la ciudad
         $cod_depto="";
	 $cod_ciudad="";
         $registro="";
         $sentencia2 = "select cod_depto,cod_ciudad,registro FROM clientes where sucursal='".$cod_bodega."' and cod_cliente='".$cod_cliente."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $cod_depto=$row['cod_depto'];
	      $registro=$row['registro'];
	      $cod_ciudad=$row['cod_ciudad'];
             }
          }



         $cliente="";
         $sentencia2 = "select nombre,apellido FROM clientes where sucursal='".$cod_bodega."' and cod_cliente='".$cod_cliente."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $cliente=$row['nombre']." ".$row['apellido'];
             }
          }

          //evaluando estado
          if($estado1==1)
	   {
            $cliente="Anulada";
            $monto=0;
            $impuesto=0;
            $total=0;
	   }



	 $nom_ciudad="";
         $sentencia2 = "select nomb_ciudad FROM munici where cod_depto='".$cod_depto."' and cod_ciudad='".$cod_ciudad."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $nom_ciudad=$row['nomb_ciudad'];
             }
          }
	 $sentencia = "insert into tablaiva (numero,tipo,fecha,cliente,registro,monto,impuesto,total,sucursal,ciudad) 
                  values ('".$numero."','".$tipo."','".$fecha."','".$cliente."','".$registro."','".$monto."','".$impuesto."','".$total."','".$cod_bodega."','".$nom_ciudad."')"; 
	 $resultado3 = mysql_query($sentencia);

           
	}  //fin del while

//Eliminar archivo de excel en la carpeta destino

unlink('/descargassiccae/tablaivaexcel.csv');


//PASANDO EL ARCHIVO GENERADO A EXCEL servidor local (desarrollo)
//$sentencia="SELECT * INTO OUTFILE '/descargassiccae/tablaivaexcel.csv' fields terminated by ',' FROM tablaiva";
//$result = mysql_query($sentencia);


$sentencia="SELECT 'numero','tipo','fecha','cliente','registro','monto','impuesto','total','sucursal','ciudad'
UNION ALL
SELECT numero,tipo,fecha,cliente,registro,monto,impuesto,total,sucursal,ciudad
    FROM tablaiva
    INTO OUTFILE '/descargassiccae/tablaivaexcel.csv' fields terminated by ','";
$result = mysql_query($sentencia);

//PASANDO EL ARCHIVO GENERADO A EXCEL para la web
//$result = mysql_query("SELECT 'numero','tipo','fecha','cliente','registro','monto','impuesto','total','sucursal','ciudad' 
//         UNION ALL (SELECT * INTO OUTFILE '//home1/franconi/public_html/siccae/archivos/'.'tablaivaexcel.csv' fields terminated by ',' FROM tablaiva)");


//$sentencia="SELECT * INTO OUTFILE '//home1/franconi/public_html/siccae/archivos/'.'tablaivaexcel.csv' fields terminated by ',' FROM tablaiva";
//$result = mysql_query($sentencia);


  echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
  Proceso realizado con exito.	
  </div>';

  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=param_pasaiva.php">';    
  exit;    

}
if($_GET['ti']==2)
 {
   //Evaluada y ejecutada desde el script que llama a esta funcion. Lo hacemos con el script DESCARGAARCHIVO.PHP
 }




if($_GET['ti']==3)
 {
   //reporte general de la tabla del iva generada
 require_once("./logica/log_reportes.php");
	 $fechai=$_GET['fd'];
         $fechaf=$_GET['fh'];


	$fechai=substr($fechai,0,2)."-".substr($fechai,3,2)."-".substr($fechai,6,4);
	$fechaf=substr($fechaf,0,2)."-".substr($fechaf,3,2)."-".substr($fechaf,6,4);

	 $cod_bodega=$_GET['bod'];
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
<title>SICCAE - Reporte de tabla de IVA generada</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Tabla generada para el IVA</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px"><strong>Numero</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Tipo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Cliente</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Registro</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Impuesto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Total</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Sucursal</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Ciudad</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumatotal=0;
                        $sumaiva=0;
                        $sumamonto=0;

			$sentencia="select * from tablaiva order by fecha,numero";
			$resultado = mysql_query($sentencia);
			//$fila=mysql_fetch_array($resultado);
			//if( mysql_num_rows($resultado)!=0)
         		//{
				while ( $fila = mysql_fetch_array($resultado))
				{


                                $total1=$fila['total'];
                                $total=number_format($total1, 2, ".", ",");

                                $monto1=$fila['monto'];
                                $monto=number_format($monto1, 2, ".", ",");

                                $iva1=$fila['impuesto'];
                                $iva=number_format($iva1, 2, ".", ",");

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px; font-size:10px; text-align: center">'.$fila['numero'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['tipo'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['fecha'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['cliente'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['registro'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['monto'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['impuesto'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['total'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['sucursal'].'</td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align: right">'.$fila['ciudad'].'</td>
					</tr>';	
                          	$cuentafila+=1;
				$sumatotal+=$total;
                                $sumaiva+=$iva;
                                $sumamonto+=$monto;
                          	
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
				<td class="FilaNI2" style="height: 22px"><strong>Numero</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Tipo</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Fecha</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Cliente</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Registro</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Monto</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Impuesto</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Total</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Sucursal</strong></td>
				<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Ciudad</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                      //  }
			}  //fin del while

		}  //fin del if 
			$sumatotalgen=number_format($sumatotal, 2, ".", ",");
			$sumaivagen=number_format($sumaiva, 2, ".", ",");
			$sumamontogen=number_format($sumamonto, 2, ".", ",");

		        echo '
			<tr>
						<td class="FilaNI2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumamontogen.'</td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumaivagen.'</td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumatotalgen.'</td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: right"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';


 }
if($_GET['ti']==4)
 {
   //reporte totalizado por dia desde la tabla generada del IVA
 require_once("./logica/log_reportes.php");

          //sacando la fecha 
         $fechapigote="";
         $sentencia2 = "select fecha,sucursal FROM tablaiva "; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $fechapigote=$row['fecha'];
              $xsucursal=$row['sucursal'];
             }
          }




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
<title>SICCAE - Reporte de tabla de IVA generada</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Tabla generada para el IVA con totales por dia</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Impuesto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Total</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Sucursal</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumatotal=0;
                        $sumaiva=0;
                        $sumamonto=0;
                        $dias=31;

		        $numedia=intval(substr($fechapigote,8,2));
		        $numemes=intval(substr($fechapigote,5,2));
		        $numeanio=intval(substr($fechapigote,0,4));

			for($i = 1; $i <= $dias; ++$i) {
		         $fechaacu=$numeanio."/".$numemes."/".$i;
                         $stotal=0;
                         $siva=0;
                         $smonto=0;
			 $res=mysql_query("select total,impuesto,monto from tablaiva where fecha='".$fechaacu."'");
			 while($row=mysql_fetch_assoc($res))
			  {
			    $stotal+=$row['total'];
			    $siva+=$row['impuesto'];
			    $smonto+=$row['monto'];
			  }
                          	$cuentafila+=1;
				$sumatotal+=$stotal;
                                $sumaiva+=$siva;
                                $sumamonto+=$smonto;

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px; font-size:10px; text-align: center">'.$fechaacu.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$smonto.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$siva.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$stotal.'</td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align: right">'.$xsucursal.'</td>
					</tr>';	
                            
			}



			$sumatotalgen=number_format($sumatotal, 2, ".", ",");
			$sumaivagen=number_format($sumaiva, 2, ".", ",");
			$sumamontogen=number_format($sumamonto, 2, ".", ",");

		        echo '
			<tr>
						<td class="FilaNI2" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumatotalgen.'</td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumaivagen.'</td>
						<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">'.$sumamontogen.'</td>
						<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: right"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';






 }


?>

