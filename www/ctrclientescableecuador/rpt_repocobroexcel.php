<?php
if($_GET['ti']==2)
 {
        //Clientes de recibos (pago de mes adelantado)
        //Todos entran a la lista
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_avisosre_sec($_GET['fd'],$_GET['fh'],$_GET['zo'],$_GET['zo2'],$_GET['bod']);
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
         //$fechadehoy=date('d/m/Y');
         $fechadehoy=$_GET['fd'];
    
	 mysql_data_seek($resultado, 0); 

	//****************MARCANDO LOS REGISTROS QUE SE IMPRIMIRAN ****************
	//$fechat1=date('d/m/Y');
	//$fechat2=$_GET['fd'];
        $fechat1=$_GET['fd'];
	$fechat2=$_GET['fd'];



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
	    //$hoymes1=date('d/m/Y');
	    $hoymes1=$_GET['fd'];

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
	            //$fechadehoy=date('d/m/Y');
		    $fechadehoy=$_GET['fd'];
		    $apagarday=0;
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



              if(intval(substr($ff1,5,2))==12 and $xmex2==12)       //si el mes inicial del periodo a pagar es 12 o sea diciembre y el mes de reporte es tambien diciembre
               {
                   $mesasumar=1;
	       }


                     $apagar=$monto+($valplan*($mesasumar-1))+$recargo;
		     $sentencia="update clientes set parametrompendi='".$mesasumar."',parametroapa='".$apagar."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);

		     $ncliente=$filaz['nombre']." ".$filaz['apellido'];
		     $xdui=$filaz['nit'];
		     $xfechai=$filaz['fechaip'];
		     $xfechaul=$filaz['fechaul'];
                     $otraref=$filaz['otraref'];

//Aplicando descuento cuando se paga el dia 1 y dia 2 de mes
  $xapagartot=$apagar;
  $xdescuento=0;
  if($xttplan=="0100O1OO121")
   {
   if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02")) 
     {
      $xapagartot=$apagar-50;
      $xdescuento=50;
     }	
   }	
  if($xttplan=="0401O822121")
   {
    if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02")) 
     {
      $xapagartot=$apagar-50;
      $xdescuento=50;
     }	
   }	
  if($xttplan=="0501O822121")
   {
    if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02")) 
     {
      $xapagartot=$apagar-100;
      $xdescuento=100;
     }	
   }	
  if($xttplan=="0602O622121")
   {
    if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02")) 
     {
      //pago de 1500 si paga el 1 o 2 del mes, del mismo mes en curso que la fecha limite inferior del periodo
      $xapagartot=$apagar-100;
      $xdescuento=100;
     }	
   }	
  if($xttplan=="0804O422121")
  {
    if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02")) 
     {
      $xapagartot=$apagar;
      $xdescuento=0;
     }	
  }	
//

                     $pobla=$filaz['ncan'];
                     $munixx=$filaz['nmuni'];
                     $otraref=$filaz['otraref'];
		     $cerouno=1;
        	     $xdireccion=$munixx.', '.$pobla.', '.$otraref;
		        $sentencia="update clientes set parametromes1='".$xdescuento."',parametromes2='".$xapagartot."',parametrodire='".$xdireccion."',parametroprint='".$cerouno."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);

      		}  //fin de SI esta en el rango de fechas del ultimo mes pagado para calcular monto 
	}  //fin del while

	//desmarcando lo que no debe imprimirse

	//$estemes1=date('d/m/Y');
        $estemes1=$_GET['fd'];        
        //sumamos 1 porque es pago de cuota mensual adelantado
	$estemes=intval(substr($estemes1,3,2))+1;
	//$esteanio1=date('d/m/Y');
        $esteanio1=$_GET['fd'];
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


//rutina para enviar a excel
$filename = "reporte_de_cobros.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$show_coloumn = false;
require_once("./logica/log_reportes.php");
$resultadofin=log_obtener_clientes_avisosresegundoexcel($xdesde,$xhasta,$cod_bodega);
if( mysql_num_rows($resultadofin)!=0)
 {
  $developer_records = array();
  while ( $rows = mysql_fetch_assoc($resultadofin))
  {
   $developer_records[] = $rows;
  }
 }

$show_coloumn = false;
if(!empty($developer_records)) {
foreach($developer_records as $record) {
if(!$show_coloumn) {
// display field/column names in first row
echo implode("\t", array_keys($record)) . "\n";
$show_coloumn = true;
}
echo implode("\t", array_values($record)) . "\n";
}
//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
exit;    

}


//fin de rutina excel




}

?>