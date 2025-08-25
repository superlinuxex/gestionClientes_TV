<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_avisoscr($_GET['fd'],$_GET['fh'],$_GET['cod'],$_GET['bod']);
	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos para esas fechas en esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }
         $xdesde=$_GET['fd'];
         $xhasta=$_GET['fh'];
 	 $row=mysql_fetch_array($resultado);
	 $cod_cobrador=$_GET['cod'];
	 $xcobrador="";
         $cod_bodega=$_GET['bod'];
         $sentencia2 = "select nombre,apellido FROM empleados where cod_emple='".$cod_cobrador."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $xcobrador=$row['nombre']." ".$row['apellido'];
             }
          }
        
         $uno=0;
         $sentencia="update clientes set parametroprint='".$uno."' where sucursal='".$cod_bodega."'";
         $resultado2 = mysql_query($sentencia);
     
	 mysql_data_seek($resultado, 0); 

	//****************MARCANDO LOS REGISTROS QUE SE IMPRIMIRAN ****************
	$fechat1=date('d/m/Y');
	$xmex2=intval(substr($fechat1,3,2));
        if($xmex2==1)
	{
          $xmex1=12;
	}
        else
	{
         $xmex1=$xmex2-1;
	}
	while ( $filaz = mysql_fetch_array($resultado))
	 {
 	  $cliente=$filaz['cod_cliente'];
          $cod_bodega=$filaz['sucursal'];
          $valplan=$filaz['valorplan'];
	  if(!(intval(substr($filaz['ulfepago1'],5,2))==$xmex1 and intval(substr($filaz['ulfepago2'],5,2))==$xmex2) and $filaz['ulfepago1']!='Null' and $filaz['ulfepago2']!='Null');
	   {
            if($filaz['ulfepago2']!='Null')  //si la fecha final del ultimo pago existe
	    {
             $ufp1=$filaz['ulfepago2'];
             $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
             $resultado2=mysql_query($sentencia);
	     $numedia=intval(substr($filaz['ulfepago2'],8,2));
	     $numemes=intval(substr($filaz['ulfepago2'],5,2));
	     $numeanio=intval(substr($filaz['ulfepago2'],0,4));
             if($numemes==12)
	      {
               $numemes=1;
	       $numeanio=$numeanio+1;
              }
              else
	      {
               $numemes=$numemes+1;
              }
              $ufp2=$numeanio."/".$numemes."/".$numedia;
              $sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
              $resultado2 = mysql_query($sentencia);
            }  
            if($filaz['ulfepago2']=='Null')       //si no hay fecha final de un pago anterior toma como inicio la fecha de conexion
     	    {  
             if($filaz['fechaip']!='Null')
	      {
               $ufp1=$filaz['fechaip']; 
	       $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
               $resultado2 = mysql_query($sentencia);
 	       $numedia=intval(substr($filaz['fechaip'],8,2));
	       $numemes=intval(substr($filaz['fechaip'],5,2));
	       $numeanio=intval(substr($filaz['fechaip'],0,4));
             if($numemes==12)
	      {
               $numemes=1;
	       $numeanio=$numeanio+1;
              }
              else
	      {
               $numemes=$numemes+1;
              }
                $ufp2=$numeanio."/".$numemes."/".$numedia;
		$sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                $resultado2 = mysql_query($sentencia);
               }  
              }  
              //buscando si hay abonos por la factura que se va a cancelar
              $ff1="";
              $ff2="";
              $abonos=0;
	      $sentencia2 = "select fechap1,fechap2 FROM clientes where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'"; 
 	      $resultado2 = mysql_query($sentencia2);
              if(isset($resultado2))
       	       {
   	        if(mysql_num_rows ( $resultado2 )!=0)
	         {
  	          $rowq=mysql_fetch_array($resultado2);
	          $ff1=$rowq['fechap1'];
	          $ff2=$rowq['fechap2'];
                 }
                }
		$sentencia2 = "select abonos FROM periodos where pagado=0 and cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'"; 
		$resultado2 = mysql_query($sentencia2);
                if(isset($resultado2))
                 {
   	          if(mysql_num_rows ( $resultado2 )!=0)
	           {
  	            $rowq=mysql_fetch_array($resultado2);
	            $abonos=$rowq['abonos'];
                   }
                  }

                   $monto=$valplan-$abonos;
		   $sentencia="update clientes set parametromon='".$valplan."',parametroabo='".$abonos."' where cod_cliente='".$cliente."' and fechap2!='Null' and sucursal='".$cod_bodega."'";
                   $resultado2 = mysql_query($sentencia);

		  //calculando los meses que debe hasta la fecha
		   $hoymes1=date('d/m/Y');
		   $hoymes=intval(substr($hoymes1,3,2));
		   $numemedddd=intval(substr($ff2,5,2));
                   $mesasumar=1;
		   $xxxx=$numemedddd;
	 	   for ($xxxx = $numemedddd; $xxxx < $hoymes; $xxxx++) 
                   {
                    $mesasumar=$mesasumar+1;
   		   }

                     $apagar=$monto+($valplan*($mesasumar-1));
		     $sentencia="update clientes set parametrompendi='".$mesasumar."',parametroapa='".$apagar."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);

		     $ncliente=$filaz['nombre']." ".$filaz['apellido'];
		     $xfechai=$filaz['fechaip'];
		     $xfechaul=$filaz['fechaul'];
		     $xvivienda=$filaz['vivienda'];
		
                        $cerouno=1;
			$xdireccion=$xvivienda;
		        $sentencia="update clientes set parametrodire='".$xdireccion."',parametroprint='".$cerouno."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);

      		}  //fin de SI esta en el rango de fechas del ultimo mes pagado para calcular monto 
	}  //fin del while

	//desmarcando lo que no debe imprimirse

	$estemes1=date('d/m/Y');
	$estemes=intval(substr($estemes1,3,2));
	$esteanio1=date('d/m/Y');
	$esteanio=intval(substr($esteanio1,6,2));
        if($estemes=12)
	{
	 $messig=1;
	 $aniosig=$esteanio+1;
	}
         if($estemes<=11)
	{
	 $messig=$estemes+1;
	 $aniosig=$esteanio;
	}
         $xdia="01";
         $mesesborrar1=strtotime($aniosig."-".$messig."-".$xdia);
	 $mesesborrar=date('Y-m-d',$mesesborrar1);
         $anula=0;
	 $sentencia="update clientes set parametroprint='".$anula."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."' and fechap2>=$mesesborrar";
         $resultado2 = mysql_query($sentencia);

	//****FIN DE MARCAR REGISTROS *******************

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
<title>SICCAE - Avisos de cobro a clientes de factura de consumidor final</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Clientes que cancelan cuotas con factura de consumidor final Fecha:</strong>'.date('d/m/Y').'</span>
			</div>
			<div style="position:absolute;left:200px;top:60px;width:650px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Cobrador:</strong>'.$xcobrador.'</span>
			</div>
			<div style="position:absolute;left:150px;top:80px;width:600px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Clientes que pagan desde: </strong>'.$xdesde.'</span>
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Hasta: </strong>'.$xhasta.'</span>
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>de cada mes</strong></span>
			</div>
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px;font-size:20px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px;font-size:20px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px;width:300px;font-size:20px"><strong>Pendiente desde el periodo</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;font-size:20px"><strong>Valor cuota</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;

			$cuentalin=45;
			$cuentalin2=10;
			$cvppag=0;

			$resultadofin=log_obtener_clientes_avisoscr($xdesde,$xhasta,$cod_cobrador,$cod_bodega);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
			  $xfechai=$filad['fechaip'];
			  $xfechaul=$filad['fechaul'];
			  $xfecha1=$filad['fechap1'];
			  $xfecha2=$filad['fechap2'];
			  $xdireccion=$filad['parametrodire'];
			  $xorden=$filad['ordenvisi'];
			  $xabonos=$filad['parametroabo'];
			  $xmonto=$filad['parametromon'];
			  $xapagar=$filad['parametroapa'];
			  $xmesespen=$filad['parametrompendi'];
			  $xotraref=$filad['otraref'];
			  if($filad['parametroprint']==1);
			   {
	     $xnumedia=intval(substr($xfecha1,8,2));
	     $xnumemes=intval(substr($xfecha1,5,2));
	     $xnumeanio=intval(substr($xfecha1,0,4));
             $ttfecha1=$xnumedia."/".$xnumemes."/".$xnumeanio;
	     $ynumedia=intval(substr($xfecha2,8,2));
	     $ynumemes=intval(substr($xfecha2,5,2));
	     $ynumeanio=intval(substr($xfecha2,0,4));
             $ttfecha2=$ynumedia."/".$ynumemes."/".$ynumeanio;


    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px;text-align:left">'.$cliente.'</td>
    <td style="position:absolute;left:75px;top:'.$cuentalin.'px;width:500px;height:37px;font-size:20px;text-align:left">'.$ncliente.'</td>
    <td style="position:absolute;left:500px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">De: '.$ttfecha1.' A: '.$ttfecha2.'</td>
    <td style="position:absolute;left:850px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px;text-align:left">'.$xmonto.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:120px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Orden de visita:'.$xorden.'</td>
    <td style="position:absolute;left:400px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Abonos:'.$xabonos.'</td>
    <td style="position:absolute;left:550px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Total a pagar:'.$xapagar.'</td>
    <td style="position:absolute;left:750px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Meses pendientes:'.$xmesespen.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:900px;height:37px;font-size:17px">Direccion:'.$xdireccion.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Observaciones:</td>
    </tr>';
    $cuentalin=$cuentalin+18;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:405px;height:37px">_________________________________________________________________________________________________________________________</td>
    </tr>';
    $imprivalesig=2;
    $cuentalin=$cuentalin+40;
    $cvppag=$cvppag+1;



                           }  //fin de SI el clientes es parte del reporte
			}  //fin del while
                       } //si encontro registros en el rango de fechas del repporte
			echo'
		</table>
	</div>
</body>
</html>';
?>