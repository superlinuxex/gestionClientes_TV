<?php
if($_GET['ti']==1)
 {
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_ventas($_GET['fd'],$_GET['fh'],$_GET['bod']);

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
	$fx0x=$_GET['fd'];
	$fx1x=$_GET['fh'];


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
<title>SICCAE - Reporte de remesas en un periodo</title>
</head>
<body>
	<div style="position:absolute;top:15px;left:200px;border:1px no-solid;width:60%;height:98%;">
	
		<div style="position:absolute;left:110px;top:50px;width:800px;height:37px;text-align:left;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Remesas de sucursal</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;font-size:14px;width:50px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Venta</strong></td>
				<td class="FilaNF" style="height: 22px;font-size:14px;width:50px;text-align: center;padding-right:0px;"><strong>Remesado</strong></td>
			</tr>';	
                        $sumareme=0;
			$sumatotal=0;


			$numedia=substr($fx0x,0,2);
			$numemes=substr($fx0x,3,2);
			$numeanio=substr($fx0x,6,4);
                	$nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
	                $fx0=date('Y-m-d',$nuevaf);

			$numedia=substr($fx1x,0,2);
			$numemes=substr($fx1x,3,2);
			$numeanio=substr($fx1x,6,4);
	                $nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
	                $fx1=date('Y-m-d',$nuevaf);


                        $cuentafila=1;
                        $sumatotal=0;
			while ($fx1>=$fx0) 
			{
			  $totaldia1=0;
			  $totaldia=0;
                          $totaliva=0;
			  $sentencia2 = "select sum(monto) as total1, sum(iva) as total1x, sum(descuento) as totaldes FROM facturas where fechafac='".$fx0."' and anulada!=1 and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $totaldia1=$row['total1'];
                              $totaliva=$row['total1x'];
                              $totaldes=$row['totaldes'];
                             }
                           }

			  $remedia=0;
			  $sentencia2 = "select sum(monto) as total2 FROM remesucu where fecha='".$fx0."' and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $remedia=$row['total2'];
                             }
                           }

                          $totaldia=(($totaldia1+$totaliva)-$totaldes);
                          $sumatotal+=$totaldia;
                          $sumareme+=$remedia;

		          $numedia=intval(substr($fx0,8,2));
			  $numemes=intval(substr($fx0,5,2));
			  $numeanio=intval(substr($fx0,0,4));
                          


			     echo '
    			    <tr>
   			    <td class="FilaNI" style="height: 22px; width:50px; font-size:13px; text-align: center">'.$fx0.'</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$totaldia.'</td>
			    <td class="FilaNF" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$remedia.'</td>
			    </tr>';


			  if(intval(substr($fx0,5,2))==1)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==2)	
			   {
                            $dias=28;
			   }
			  if(intval(substr($fx0,5,2))==3)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==4)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==5)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==6)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==7)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==8)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==9)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==10)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==11)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==12)	
			   {
                            $dias=31;
			   }

                          if($numedia<$dias)
			   {
                            $numedia+=1;
			   } 
			    else
			   {
                            $numedia=1;
                            $numemes+=1;
			   } 
                          if($numemes>12)
			   {
                            $numeanio+=1;
			    $numemes=1;
			   } 

  		           $nuevaf=strtotime($numeanio."-".$numemes."-".$numedia);
	                   $fx0=date('Y-m-d',$nuevaf);

                       	   $cuentafila+=1;
                          	
			}  //fin del while


			$sumatotalgen=number_format($sumatotal, 2, ".", ",");
			$sumaremet=number_format($sumareme, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI" style="height: 22px;width:50px;font-size:13px; text-align: center">TOTALES</td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$sumatotalgen.'</td>
			<td class="FilaNF" style="height: 22px;width:50px;font-size:13px; text-align: center">'.$sumaremet.'</td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
} 


if($_GET['ti']==2)
 {
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_gastosreme($_GET['fd'],$_GET['fh'],$_GET['bod']);

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
	$fx0x=$_GET['fd'];
	$fx1x=$_GET['fh'];


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
<title>SICCAE - Reporte de remesas a caja chica</title>
</head>
<body>
	<div style="position:absolute;top:15px;left:200px;border:1px no-solid;width:60%;height:98%;">
	
		<div style="position:absolute;left:110px;top:50px;width:800px;height:37px;text-align:left;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Remesas a caja chica</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:13px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:13px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;font-size:14px;width:50px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Remesa a caja</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Gastos</strong></td>
				<td class="FilaNF" style="height: 22px;font-size:14px;width:50px;text-align: center;padding-right:0px;"><strong>Saldo</strong></td>

			</tr>';	

                        $sumareme=0;
			$sumatotal=0;
                        $sumasaldo=0;
                        $saldo=0;

			$numedia=substr($fx0x,0,2);
			$numemes=substr($fx0x,3,2);
			$numeanio=substr($fx0x,6,4);
                	$nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
	                $fx0=date('Y-m-d',$nuevaf);



                        //tomando del saldo en toda la historia del sistema
			  $totaldia="";
			  $sentencia2 = "select sum(total) as total1 FROM facturap where fechafac<'".$fx0."' and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $totaldia=$row['total1'];
                             }
                           }

			  $remedia="";
			  $sentencia2 = "select sum(monto) as total2 FROM remecaja where fecha<'".$fx0."' and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $remedia=$row['total2'];
                             }
                           }

			  $saldo=$remedia-$totaldia;


			   $a1=number_format($remedia, 2, ".", ",");
			   $a2=number_format($totaldia, 2, ".", ",");
			   $a3=number_format($saldo, 2, ".", ",");

			     echo '
    			    <tr>
   			    <td class="FilaNI" style="height: 22px; width:50px; font-size:13px; text-align: center">Saldo anterior</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$a1.'</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$a2.'</td>
			    <td class="FilaNF" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$a3.'</td>
			    </tr>';


                          $sumatotal+=$totaldia;
                          $sumareme+=$remedia;
                          $sumasaldo+=$saldo;
                       

                       //incial el calculo del saldo desde la fecha solicitada
			$numedia=substr($fx0x,0,2);
			$numemes=substr($fx0x,3,2);
			$numeanio=substr($fx0x,6,4);
                	$nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
	                $fx0=date('Y-m-d',$nuevaf);

			$numedia=substr($fx1x,0,2);
			$numemes=substr($fx1x,3,2);
			$numeanio=substr($fx1x,6,4);
	                $nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
	                $fx1=date('Y-m-d',$nuevaf);


                        $cuentafila=1;
                        $sumatotal=0;
			while ($fx1>=$fx0) 
			{
			  $totaldia="";
			  $sentencia2 = "select sum(total) as total1 FROM facturap where fechafac='".$fx0."' and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $totaldia=$row['total1'];
                             }
                           }

			  $remedia="";
			  $sentencia2 = "select sum(monto) as total2 FROM remecaja where fecha='".$fx0."' and sucursal='".$cod_bodega."'"; 
			  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			  if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $remedia=$row['total2'];
                             }
                           }

			  $saldo=$remedia-$totaldia;


                          $sumatotal+=$totaldia;
                          $sumareme+=$remedia;
                          $sumasaldo+=$saldo;

		          $numedia=intval(substr($fx0,8,2));
			  $numemes=intval(substr($fx0,5,2));
			  $numeanio=intval(substr($fx0,0,4));

			   $a1=number_format($remedia, 2, ".", ",");
			   $a2=number_format($totaldia, 2, ".", ",");
			   $a3=number_format($sumasaldo, 2, ".", ",");



			     echo '
    			    <tr>
   			    <td class="FilaNI" style="height: 22px; width:50px; font-size:13px; text-align: center">'.$fx0.'</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$a1.'</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$a2.'</td>
			    <td class="FilaNF" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$a3.'</td>
			    </tr>';


			  if(intval(substr($fx0,5,2))==1)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==2)	
			   {
                            $dias=28;
			   }
			  if(intval(substr($fx0,5,2))==3)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==4)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==5)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==6)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==7)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==8)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==9)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==10)	
			   {
                            $dias=31;
			   }
			  if(intval(substr($fx0,5,2))==11)	
			   {
                            $dias=30;
			   }
			  if(intval(substr($fx0,5,2))==12)	
			   {
                            $dias=31;
			   }

                          if($numedia<$dias)
			   {
                            $numedia+=1;
			   } 
			    else
			   {
                            $numedia=1;
                            $numemes+=1;
			   } 
                          if($numemes>12)
			   {
                            $numeanio+=1;
			    $numemes=1;
			   } 

  		           $nuevaf=strtotime($numeanio."-".$numemes."-".$numedia);
	                   $fx0=date('Y-m-d',$nuevaf);

                       	   $cuentafila+=1;
                          	
			}  //fin del while


			$sumatotalgen=number_format($sumatotal, 2, ".", ",");
			$sumaremet=number_format($sumareme, 2, ".", ",");
			$sumasaldog=number_format($sumasaldo, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI" style="height: 22px;width:50px;font-size:14px; text-align: center">TOTALES</td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$sumaremet.'</td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$sumatotalgen.'</td>
			<td class="FilaNF" style="height: 22px;width:50px;font-size:13px; text-align: center">'.$sumasaldog.'</td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';

 } 


if($_GET['ti']==3)
 {
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_remesas($_GET['fd'],$_GET['fh'],$_GET['bod']);

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
	$fx0x=$_GET['fd'];
	$fx1x=$_GET['fh'];


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
<title>SICCAE - Reporte de remesas a bancos por las sucursales</title>
</head>
<body>
	<div style="position:absolute;top:15px;left:50px;border:1px no-solid;width:90%;height:98%;">
	
		<div style="position:absolute;left:160px;top:50px;width:800px;height:37px;text-align:left;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Remesas de sucursales a bancos</strong></span>
		</div>
		<div style="position:absolute;left:750px;top:13px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:13px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;font-size:14px;width:50px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Referencia</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Cuenta</strong></td>
				<td class="FilaN" style="height: 22px;font-size:14px;width:50px"><strong>Responsable</strong></td>
				<td class="FilaNF" style="height: 22px;font-size:14px;width:50px;text-align: center;padding-right:0px;"><strong>Banco</strong></td>

			</tr>';	

                        $sumareme=0;
			$sumatotal=0;
                        $sumasaldo=0;
                        $saldo=0;


                        $cuentafila=1;
                        $sumatotal=0;
			while ( $fila = mysql_fetch_array($resultado))
			{
				//Buscando el nombre del empleado
				$xnemple="";
				$codemple=$fila['responsable'];
				$sentencia = "select nombre,apellido from empleados where cod_emple='".$codemple."'";  
				$resultado2 = mysql_query($sentencia);
				if(mysql_num_rows ( $resultado2 )!=0)
				  {
				    $filaz=mysql_fetch_array($resultado2);
				    $xnemple=$filaz['nombre']." ".$filaz['apellido'];
				  }

				//Buscando el nombre del banco
				$xnbanco="";
				$codbanco=$fila['banco'];
				$sentencia = "select nombre from bancos where codigo='".$codbanco."'";  
				$resultado2 = mysql_query($sentencia);
				if(mysql_num_rows ( $resultado2 )!=0)
				  {
				    $filaz=mysql_fetch_array($resultado2);
				    $xnbanco=$filaz['nombre'];
				  }


                                $total1=$fila['monto'];
                                $total=number_format($total1, 2, ".", ",");
			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;width:50px; font-size:13px; text-align: center">'.$fila['fecha'].'</td>
						<td class="FilaN" style="height: 22px; font-size:13px; text-align: center">'.$fila['remesa'].'</td>
						<td class="FilaN" style="height: 22px; font-size:13px; text-align: center">'.$total.'</td>
						<td class="FilaN" style="height: 22px; font-size:13px; text-align: center">'.$fila['cuenta'].'</td>
						<td class="FilaN" style="height: 22px; font-size:13px; text-align: center">'.$xnemple.'</td>
						<td class="FilaNF" style="height: 22px;font-size:13px; text-align: center">'.$xnbanco.'</td>
					</tr>';	
                          	$cuentafila+=1;
				$sumatotal+=$total;
                          	
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
				 <td class="FilaNI2" style="height: 22px;font-size:14px;width:50px"><strong>Fecha</strong></td>
				 <td class="FilaN2" style="height: 22px;font-size:14px"><strong>Referencia</strong></td>
				 <td class="FilaN2" style="height: 22px;font-size:14px"><strong>Monto</strong></td>
				 <td class="FilaN2" style="height: 22px;font-size:14px"><strong>Cuenta</strong></td>
			 	 <td class="FilaN2" style="height: 22px;font-size:14px;"><strong>Responsable</strong></td>
				 <td class="FilaNF2" style="height: 22px;font-size:14px;text-align: center;padding-right:0px;"><strong>Banco</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while

			$sumatotalgen=number_format($sumatotal, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI" style="height: 22px;width:50px;font-size:14px; text-align: center">TOTAL</td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center">'.$sumatotalgen.'</td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; width:50px;font-size:13px; text-align: center"></td>
			<td class="FilaNF" style="height: 22px;width:50px;font-size:13px; text-align: center"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';

 } 

?>