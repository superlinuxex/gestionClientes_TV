<?php
if($_GET['ti']==3)
 {

        //Clientes de recibos (pago de mes adelantado)
        //Todos entran a la lista
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_avisosre($_GET['fd'],$_GET['fh'],$_GET['bod']);
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
	 $cod_cobrador="";
	 $xcobrador="";
         $cod_bodega=$_GET['bod'];
     
	 mysql_data_seek($resultado, 0); 

	//****************MARCANDO LOS REGISTROS QUE SE IMPRIMIRAN ****************
	$fechat1=date('d/m/Y');
	//$fechat1=$_GET['fd'];

	$xmex2=intval(substr($fechat1,3,2));
	$xanio2=intval(substr($fechat1,6,4));
        $xmex1=$xmex2;
	while ( $filaz = mysql_fetch_array($resultado))
	 {
 	  $cliente=$filaz['cod_cliente'];
          $cod_bodega=$filaz['sucursal'];
          $valplan=$filaz['valorplan'];
          //Filtar: Mes de fecha actual debe ser menor o igual al mes de la fecha 2 del periodo, o si el año de fecha actual es mayor al año de la fecha 2 del periodo.
	  if(((intval(substr($filaz['ulfepago2'],5,2)))<=$xmex2 or $xanio2>intval(substr($filaz['ulfepago2'],0,4))) and $filaz['ulfepago1']!='Null' and $filaz['ulfepago2']!='Null');	   
	   {
            if($filaz['ulfepago2']!='Null')  //si la fecha final del ultimo pago existe
	    {
             if($filaz['ulfepago2']!=$filaz['ulfepago1'])    //si son dieferentes quiere decir que no es nueva conexion
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
             else
             {
              // es una conexion nueva o reconexion y la fecha inicial de sevicio es igual a la final en el registro del cliente
              //entonces agrego un mes a la fecha inicial del periodo que debe
             
               //Primero buscamos si fue nueva conexion o reconexion
                $finicial="";
		$sentencia2 = "select fechaini FROM periodos where pagado=0 and cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'"; 
		$resultado2 = mysql_query($sentencia2);
                if(isset($resultado2))
                 {
   	          if(mysql_num_rows ( $resultado2 )!=0)
	           {
  	            $rowq=mysql_fetch_array($resultado2);
	            $finicial=$rowq['fechaini'];
                   }
                  }
            if(intval(substr($finicial,8,2))==1)   //si el dia de la fecha inicial es 01 (periodos completos)
              {
	      $numedia=1;
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
              $ufp1=$numeanio."/".$numemes."/".$numedia;
              $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
              $resultado2=mysql_query($sentencia);

	      $numedia=1;
	      $numemes=intval(substr($ufp1,5,2));
	      $numeanio=intval(substr($ufp1,0,4));
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
             else       //si el periodo dice que inicia la fecha inicial en diferente de dia 1 (son dias de servicio)
             {
              $ufp1=$filaz['ulfepago2'];
              $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
              $resultado2=mysql_query($sentencia);
	      $numemes=intval(substr($filaz['ulfepago2'],5,2));
	      $numeanio=intval(substr($filaz['ulfepago2'],0,4));
      if($numemes==1)
       {
        $numedia="31";
       }
      if($numemes==2)
       {
       $numedia="28";
       }
      if($numemes==3)
       {
        $numedia="31";
       }
      if($numemes==4)
       {
        $numedia="30";
       }
      if($numemes==5)
       {
        $numedia="31";
      }
      if($numemes==6)
       {
        $numedia="30";
       }
      if($numemes==7)
       {
       $numedia="31";
       }
      if($numemes==8)
       {
        $numedia="31";
       }
      if($numemes==9)
       {
        $numedia="30";
       }
      if($numemes==10)
       {
        $numedia="31";
       }
      if($numemes==11)
       {
        $numedia="30";
       }
      if($numemes==12)
       {
        $numedia="31";
       }

              $ufp2=$numeanio."/".$numemes."/".$numedia;
              $sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
              $resultado2 = mysql_query($sentencia);

             }
             }
            }  
            if($filaz['ulfepago2']=='Null')       //si no hay fecha final de un pago anterior toma como inicio la fecha de conexion
     	    {  
             if($filaz['fechaip']!='Null' and intval(substr($filaz['fechaip'],5,2))<=$xmex2)
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
                $abonos=0;
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

		  //calculando los meses que debe hasta la fecha (independientemente del mes limite del reporte debe contar los meses que debe hasta la fecha actual del sistema)
	    $hoymes1=date('d/m/Y');
	    //sumamos 1 al mes porque es pago adelantado
	    $hoymes=intval(substr($hoymes1,3,2)+1);
	    $numemedddd=intval(substr($ff2,5,2));
            if(intval(substr($ff2,0,4))==intval(substr($hoymes1,6,4)))    //si el mes pagado es noviembre o diciembre 
            {
             $mesasumar=1;    //inicio con 1 por pago de mes adelantado segun politica de la empresa
	     $xxxx=$numemedddd;
	     for ($xxxx = $numemedddd; $xxxx < $hoymes; $xxxx++) 
             {
              $mesasumar=$mesasumar+1;
   	     }
	    }
            if(intval(substr($ff2,0,4))<intval(substr($hoymes1,6,4)))   //si el mes pagado es menor de noviembre    
	    {
             $mesasumar=1;  //inicio con 1 por pago de mes adelantado segun politica de la empresa
	     $xxxx=$numemedddd;
             $diciembre=12+($hoymes-1);
	     for ($xxxx = $numemedddd; $xxxx <= $diciembre; $xxxx++) 
             {
              $mesasumar=$mesasumar+1;
	     }
            }
            if(intval(substr($ff2,0,4))>intval(substr($hoymes1,6,4)))   //si el mes pagado es menor de noviembre    
	    {
		 $mesasumar=0;
            }

                   if(intval(substr($ff2,5,2))==intval(substr($ff1,5,2)))   //esto se da cuando el periodo inicia con da diferente de 01 (dias de servicio)
                   {
                   //Calculando monto por dias de servicio
	            $fechadehoy=date('d/m/Y');
  		    require_once("logica/log_facturas.php");
 		    $tabla1=log_obtener_cuotaapagar_cliente($cod_bodega,$cliente);
		    $regis1=mysql_fetch_array($tabla1);
		    $cuota=$regis1['valorplan'];
		    $cuotafija=$regis1['valorplan'];
		    $estatus=$regis1['estatus'];
		    $tabla2=log_obtener_periodoapagar_cliente($cod_bodega,$cliente);
	 	    $regis2=mysql_fetch_array($tabla2);
		    $f1=$regis2['fechaini'];
		    $f2=$regis2['fechafin'];
                    //pago de 200 si paga cualquier dia del mes pero es del mismo mes en curso que la fecha limite inferior del periodo
                    if(substr($f1,5,2)==substr($fechadehoy,3,2)) 
		     {
                       $cuota=$cuotafija;
	             }	
	             $xanio1=substr($f1,0,4);
		     $xmes1=substr($f1,5,2);
		     $xdia1=substr($f1,8,2);
                     $xanio2=substr($f2,0,4);
		     $xmes2=substr($f2,5,2);
		     $xdia2=substr($f2,8,2);
   		     $timestamp1 = mktime(0,0,0,$xmes1,$xdia1,$xanio1); 
   		     $timestamp2 = mktime(0,0,0,$xmes2,$xdia2,$xanio2); 
		     $segundos_diferencia = $timestamp1 - $timestamp2;
		     $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
		     $dias_diferencia = abs($dias_diferencia);
		     $dias_diferencia = floor($dias_diferencia);
		     //$apagarday=0;
                     //$dias_diferencia=(intval($xdia2)-intval($xdia1));
                     //$pordia=0;
                     $i=INTVAL($xmes1);
                     switch ($i) 
		     {
                       CASE 1:
     		        $apagarday=($cuotafija/31)*$dias_diferencia;
		        $delmesx="Enero";
			break;
                       CASE 2:
     		        $apagarday=($cuotafija/28)*$dias_diferencia;
			$delmesx="Febrero";
			break;
                       CASE 3:
 		        $apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Marzo";
			break;
                       CASE 4:
     			$apagarday=($cuotafija/30)*$dias_diferencia;
			$delmesx="Abril";
			break;
                       CASE 5:
     			$apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Mayo";
			break;
                       CASE 6:
     			$apagarday=($cuotafija/30)*$dias_diferencia;
			$delmesx="Junio";
			break;
                       CASE 7:
     			$apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Julio";
			break;
                       CASE 8:
     			$apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Agosto";
			break;
                       CASE 9:
     			$apagarday=($cuotafija/30)*$dias_diferencia;
			$delmesx="Septiembre";
			break;
                       CASE 10:
     			$apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Octubre";
			break;
                       CASE 11:
     			$apagarday=($cuotafija/30)*$dias_diferencia;
			$delmesx="Noviembre";
			break;
                       CASE 12:
     			$apagarday=($cuotafija/31)*$dias_diferencia;
			$delmesx="Diciembre";
			break;
		      }
                     $mesasumar=$mesasumar-1;
                     $monto=$apagarday-$abonos;
  		     $sentencia="update clientes set dias_reconexion='".$dias_diferencia."',pago_por_dias='".$apagarday."',parametromon='".$apagarday."' where cod_cliente='".$cliente."' and fechap2!='Null' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);
                   }
                     

                     //modificando el recargo segun el tipo de plan para mexico
                     $recargo=0;
                     $xttplan=$filaz['ttplan'];
		     if($xttplan=="0100O1OO121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*30;
			}
		      }

		     if($xttplan=="0401O822121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*30;
			}
		      }

		     if($xttplan=="0501O822121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*50;
			}
		      }

		     if($xttplan=="0703O522121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*200;
			}
		      }

		     if($xttplan=="0804O422121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*100;
			}
		      }

		     if($xttplan=="1407123OO121")
                     {
                     if($mesasumar>1)
			{
                          $recargo=($mesasumar-1)*100;
			}
		      }



                     $apagar=$monto+($valplan*($mesasumar-1))+$recargo;
		     $sentencia="update clientes set parametrompendi='".$mesasumar."',parametroapa='".$apagar."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);

		     $ncliente=$filaz['nombre']." ".$filaz['apellido'];
		     $xdui=$filaz['nit'];
		     $xfechai=$filaz['fechaip'];
		     $xfechaul=$filaz['fechaul'];
                     $otraref=$filaz['otraref'];

			
        	                $cerouno=1;


				$xdireccion=$otraref;
		        $sentencia="update clientes set parametrodire='".$xdireccion."',parametroprint='".$cerouno."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);

      		}  //fin de SI esta en el rango de fechas del ultimo mes pagado para calcular monto 
	}  //fin del while

	//desmarcando lo que no debe imprimirse

	$estemes1=date('d/m/Y');
        //$estemes1=$_GET['fd'];        
        //sumamos 1 porque es pago de cuota mensual adelantado
	$estemes=intval(substr($estemes1,3,2))+1;
	$esteanio1=date('d/m/Y');
        //$esteanio1=$_GET['fd'];
	$esteanio=intval(substr($esteanio1,6,4));

       
        if($estemes>12)
	{
	 $messig=1;
	 $aniosig=$esteanio+1;
	}
         if($estemes<=12)
	{
	 $messig=$estemes;
	 $aniosig=$esteanio;
	}
         $xdia="01";


         $mesesborrar1=strtotime($aniosig."-".$messig."-".$xdia);
	 $mesesborrar=date('Y-m-d',$mesesborrar1);

         $anula=0;
	 $desconectado=0;
	 $sentencia="update clientes set parametroprint='".$anula."' where (sucursal='".$cod_bodega."' and fechap2>'".$mesesborrar."') or (sucursal='".$cod_bodega."' and parametrompendi<1) or (sucursal='".$cod_bodega."' and estatus='".$desconectado."')";
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
<title>CUSTOMERSCABLETV - Avisos de cobro a clientes de Recibos</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Clientes con uno o mas meses pendientes de pago              Fecha:</strong>'.$_GET['fd'].'</span>
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
                        $sumamonto=0;
                        $sumacuotas=0;

			$resultadofin=log_obtener_clientes_avisosresegundo($xdesde,$xhasta,$cod_bodega);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
 		          $xdui=$filad['nit'];
 		          $xsector=$filad['zona'];
 		          $xcaja=$filad['poligono'];
			  $xfechai=$filad['fechaip'];
			  $xfechaul=$filad['fechaul'];
			  $xtel=$filad['telefono'];
			  $xcel=$filad['celu'];
			  $xfecha1=$filad['fechap1'];
			  $xfecha2=$filad['fechap2'];
			  $xdireccion=$filad['parametrodire'];
			  $xorden=$filad['ordenvisi'];
			  $xabonos=$filad['parametroabo'];
			  $xmonto=$filad['parametromon'];
			  $xapagar=$filad['parametroapa'];
			  $xmesespen=$filad['parametrompendi'];
			  $xrefer=$filad['calle'];
			  $xotraref=$filad['otraref'];
     			  $xnumedia=intval(substr($xfecha1,8,2));
     			  $xnumemes=intval(substr($xfecha1,5,2));		
     			  $xnumeanio=intval(substr($xfecha1,0,4));
	             	  $ttfecha1=$xnumedia."/".$xnumemes."/".$xnumeanio;
		          $ynumedia=intval(substr($xfecha2,8,2));
     			  $ynumemes=intval(substr($xfecha2,5,2));
		          $ynumeanio=intval(substr($xfecha2,0,4));
	                  $ttfecha2=$ynumedia."/".$ynumemes."/".$ynumeanio;
		          $sumamonto=$sumamonto+$xapagar;
                          //if($xmesespen>1)
                          // {
                          //  $xmonto=$xmonto+30;
                          // }
                          $sumacuotas=$sumacuotas+$xmonto;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px;text-align:left">'.$cliente.'</td>
    <td style="position:absolute;left:85px;top:'.$cuentalin.'px;width:500px;height:37px;font-size:20px;text-align:left">'.$ncliente.'</td>
    <td style="position:absolute;left:550px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Desde Periodo:'.$ttfecha1.' - '.$ttfecha2.'</td>
    <td style="position:absolute;left:900px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px;text-align:left">'.$xmonto.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Sector:'.$xsector.'</td>
    <td style="position:absolute;left:100px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Caja de Distribucion:'.$xcaja.'</td>
    <td style="position:absolute;left:400px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Abonos:'.$xabonos.'</td>
    <td style="position:absolute;left:550px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Total a pagar:'.$xapagar.'</td>
    <td style="position:absolute;left:750px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Meses pendientes:'.$xmesespen.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:900px;height:37px;font-size:17px">Direccion:'.$xdireccion.' Telefono: '.$xtel.' Celular:'.$xcel.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:900px;height:37px;font-size:17px">Referencia:'.$xrefer.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">ESTATUS:</td>
    </tr>';
    $cuentalin=$cuentalin+18;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:605px;height:37px">___________________________________________________________________________________________________________________________________</td>
    </tr>';

    $cuentalin=$cuentalin+20;
    $cuentafila=$cuentafila+6;
    $imprivalesig=2;
    $cvppag=$cvppag+1;
				if($cuentafila>55)
				{
				    $espacios=1;
				    while ($espacios<8)
					{
	       	                         echo '
					<tr>
				        <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px"></td>
				 	</tr>';	
				        $cuentalin=$cuentalin+20;
	       	                 	$espacios+=1;
					}
				    $cuentafila=1;
				}

      }  //fin del while
    }  //fin de SI el clientes es parte del reporte
    echo '
    <tr>
    <td style="position:absolute;left:800px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">Total deuda: $ '.$sumamonto.'</td>
    <td style="position:absolute;left:400px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">Total por un mes vencido: $ '.$sumacuotas.'</td>
    </tr>';


		echo'
		</table>
	</div>

</body>
</html>';
}


?>
