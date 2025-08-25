<STYLE>
H1.SaltoDePagina
{
PAGE-BREAK-AFTER: always
}
</STYLE>
<?php
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

if($_GET['ti']==3)
 {
   //Clientes de facturas de consumidor final
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_avisoscf($_GET['fd'],$_GET['fh'],$_GET['cod'],$_GET['bod']);
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
	  //if(!(intval(substr($filaz['ulfepago1'],5,2))==$xmex1 and intval(substr($filaz['ulfepago2'],5,2))==$xmex2) and $filaz['ulfepago1']!='Null' and $filaz['ulfepago2']!='Null');
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
              //$ufp1=$filaz['ulfepago2'];
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


                $debedias=0;

                   if(intval(substr($ff2,5,2))==intval(substr($ff1,5,2)))   //esto se da cuando el periodo inicia con da diferente de 01 (dias de servicio)
                   {
                   //Calculando monto por dias de servicio
	            $fechadehoy=date('d/m/Y');
                $debedias=1;

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
  		     $sentencia="update clientes set fechap1='".$f1."',fechap2='".$f2."',dias_reconexion='".$dias_diferencia."',pago_por_dias='".$apagarday."',parametromon='".$apagarday."' where cod_cliente='".$cliente."' and fechap2!='Null' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);
                   }
              		 if($debedias==1)
               			{
                		 $mesasumarww=$mesasumar-1;                 
                		 $mesasumar=$mesasumarww;
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
		     $xdui=$filaz['dui'];
		     $xfechai=$filaz['fechaip'];
		     $xfechaul=$filaz['fechaul'];
				    $xdepto=$filaz['cod_depto'];
				    $xmuni=$filaz['cod_ciudad'];
				    $xcanton=$filaz['cod_canton'];
				    $xbarrio=$filaz['cod_barrio'];
			     	    $xcaserio=$filaz['cod_caserio'];
				    $xpasaje=$filaz['pasaje'];
				    $xpoligono=$filaz['poligono'];
		      		    $xcasa=$filaz['casa'];
		                    $xblocke=$filaz['blocke'];
		                    $xcalle=$filaz['calle'];
		                    $xave=$filaz['ave'];
		                    $otraref=$filaz['otraref'];
		                    $xtelefono=$filaz['telefono'];
	
				//buscando nombre de departamento
				  $xndepto="";
				  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
				  $resultadon = mysql_query($sentencian);
				  if(isset($resultadon))
				   {
				    if(mysql_num_rows ( $resultadon )!=0)
				    {
				     $rown=mysql_fetch_array($resultadon);
				     $xndepto=$rown['nom_depto'];
				    }
			   	   }

			   	//buscando nombre de municipio
			  	$xnmuni="";
			  	$sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
			  	$resultadon = mysql_query($sentencian);
			  	if(isset($resultadon))
			  	 {
			   	 if(mysql_num_rows ( $resultadon )!=0)
			   	  {
			     		$rown=mysql_fetch_array($resultadon);
			     		$xnmuni=$rown['nomb_ciudad'];
			    	  }
			   	 }

				//buscando nombre de canton
				  $xncanton="";
				  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
				  $resultadon = mysql_query($sentencian);
				  if(isset($resultadon))
				   {
				    if(mysql_num_rows ( $resultadon )!=0)
				    {
				     $rown=mysql_fetch_array($resultadon);
				     $xncanton=$rown['nombrecant'];
				    }
				   }

	
				//buscando nombre de barrio
				  $xnbarrio="";
				  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
				  $resultadon = mysql_query($sentencian);
				  if(isset($resultadon))
				   {
				    if(mysql_num_rows ( $resultadon )!=0)
				    {
				     $rown=mysql_fetch_array($resultadon);
				     $xnbarrio=$rown['nombrebarrio'];
				    }
				   }
		
				//buscando nombre de colonia
				  $xncaserio="";
				  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
				  $resultadon = mysql_query($sentencian);
				  if(isset($resultadon))
				   {
				    if(mysql_num_rows ( $resultadon )!=0)
				    {
				     $rown=mysql_fetch_array($resultadon);
				     $xncaserio=$rown['nombrecaserio'];
				    }
				   }
		
				//armando la direccion
				$tbarrio="";
				if($xnbarrio!="")
				{
				 $tbarrio="Barrio";
				}
				
				$tcaserio="";
				if($xncaserio!="")
				{
				 $tcaserio="Col.";
				}
				
				$tcalle="";
				if($xcalle!="")
				{
				 $tcalle="Calle";
				}	
	
				$tave="";
				if($xave!="")
				{
				 $tave="Ave.";
				}				

				$tpasaje="";
				if($xpasaje!="")
				{
				 $tpasaje="Pje.";
				}	

				$tpoligono="";
				if($xpoligono!="")
				{
				 $tpoligono="Pol.";
				}

				$tbloque="";
				if($xblocke!="")
				{
				 $tbloque="Block.";
				}
			
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

       
        if($estemes>=13)
	{
	 $messig=1;
	 $aniosig=$esteanio+1;
	}
         if($estemes<13)
	{
	 $messig=$estemes;
	 $aniosig=$esteanio;
	}
         $xdia="01";


         $mesesborrar1=strtotime($aniosig."-".$messig."-".$xdia);
	 $mesesborrar=date('Y-m-d',$mesesborrar1);

         $anula=0;
	 $desconectado=0;
	 $sentencia="update clientes set parametroprint='".$anula."' where (sucursal='".$cod_bodega."' and fechap2>'".$mesesborrar."') or (sucursal='".$cod_bodega."' and parametrompendi<1) or (sucursal='".$cod_bodega."' and estatus='".$desconectado."') or (sucursal='".$cod_bodega."' and parametromon=parametroapa)";
         $resultado2 = mysql_query($sentencia);

	//****FIN DE MARCAR REGISTROS *******************


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
<title>CUSTOMERSCABLETV - Lista de clientes que deberian desconectarse</title>
</head>
<body>
	<div >

				

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Lista de clientes a desconectar - Fecha de informe:</strong>'.date('d/m/Y').'</span>
			</div>
			<div style="position:absolute;left:200px;top:60px;width:650px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Cobrador:</strong>'.$xcobrador.'</span>
			</div>
			<div style="position:absolute;left:150px;top:90px;width:800px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Clientes que pagan desde: </strong>'.$xdesde.'</span>
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Hasta: </strong>'.$xhasta.'</span>
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>de cada mes</strong></span>
			</div>
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px;font-size:20px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px;font-size:20px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px;width:200px;font-size:20px"><strong>Pendiente desde el periodo</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;font-size:20px"><strong>Valor</strong></td>
			</tr>';	


                        $cuentafila=1;
                        $sumalineas=0;

			$cuentalin=45;
			$cuentalin2=10;
			$cvppag=0;
                        $sumamonto=0;

			$resultadofin=log_obtener_clientes_avisoscfsegundo($xdesde,$xhasta,$cod_cobrador,$cod_bodega);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
 		          $xdui=$filad['dui'];
			  $xfechai=$filad['fechaip'];
			  $xfechaul=$filad['fechaul'];
			  $xfecha1=$filad['fechap1'];
			  $xfecha2=$filad['fechap2'];
			  $xdireccion=$filad['parametrodire'];
			  $xorden=$filad['ordenvisi'];
			  $xabonos=$filad['parametroabo'];
			  $xmonto=$filad['parametromon'];
                          $xttplan=$filad['ttplan'];
			  $xmesespen=$filad['parametrompendi'];
			  $xotraref=$filad['otraref'];
     			  $xnumedia=intval(substr($xfecha1,8,2));
     			  $xnumemes=intval(substr($xfecha1,5,2));		
     			  $xnumeanio=intval(substr($xfecha1,0,4));
	             	  $ttfecha1=$xnumedia."/".$xnumemes."/".$xnumeanio;
		          $ynumedia=intval(substr($xfecha2,8,2));
     			  $ynumemes=intval(substr($xfecha2,5,2));
		          $ynumeanio=intval(substr($xfecha2,0,4));
	                  $ttfecha2=$ynumedia."/".$ynumemes."/".$ynumeanio;

			  $xapagar=intval($filad['parametroapa']);
                          $sumamonto=$sumamonto+$xapagar;


    $content .= '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:80px;height:37px;font-size:20px;text-align:left">'.$cliente.'</td>
    <td style="position:absolute;left:20px;top:'.$cuentalin.'px;width:150px;height:37px;font-size:20px;text-align:left">'.$ncliente.'</td>
    <td style="position:absolute;left:80px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">DEBE DESDE: '.$ttfecha1.' A: '.$ttfecha2.'</td>
    <td style="position:absolute;left:100px;top:'.$cuentalin.'px;width:100px;height:37px;font-size:20px;text-align:left">'.$xmonto.'</td>
    </tr>';
    $cuentalin=$cuentalin+2;

    $content .= '
    <tr>
    <td style="position:absolute;left:120px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Cedula:'.$xdui.'</td>
    <td style="position:absolute;left:400px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Abonos:'.$xabonos.'</td>
    <td style="position:absolute;left:550px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:18px">Total a pagar:'.$xapagar.'</td>
    </tr>';
    $cuentalin=$cuentalin+2;

    $content .= '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:900px;height:37px;font-size:17px">Direccion:'.$xdireccion.'</td>
    </tr>';
    $cuentalin=$cuentalin+2;

    $content .= '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">Observaciones:</td>
    </tr>';
    $cuentalin=$cuentalin+2;

    $cuentafila=$cuentafila+2;
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
				        $cuentalin=$cuentalin+5;
	       	                 	$espacios+=1;
					}
				    $cuentafila=1;
				}

      }  //fin del while
    }  //fin de SI el clientes es parte del reporte
    $content .= '
    <tr>
    <td style="position:absolute;left:800px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">Total a cobrar: $ '.$sumamonto.'</td>
    </tr>';


$content .= '
		</table>
	</div>

</body>
</html>';

}


if($_GET['ti']==2)
 {
    //clientes que pagan con credito fiscal
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
	$esteanio=intval(substr($esteanio1,6,4));

        if($estemes==12)
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
	 $sentencia="update clientes set parametroprint='".$anula."' where sucursal='".$cod_bodega."' and fechap2>='".$mesesborrar."'";
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
<title>CUSTOMERCABLETV - Avisos de cobro a clientes de factura de Credito Fiscal</title>
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
			<div style="position:absolute;left:150px;top:90px;width:800px;height:22px;z-index:1;">
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
                        $sumamonto=0;


			$resultadofin=log_obtener_clientes_avisoscrsegundo($xdesde,$xhasta,$cod_cobrador,$cod_bodega);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
			  $xdui=$filad['dui'];
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
	     $xnumedia=intval(substr($xfecha1,8,2));
	     $xnumemes=intval(substr($xfecha1,5,2));
	     $xnumeanio=intval(substr($xfecha1,0,4));
             $ttfecha1=$xnumedia."/".$xnumemes."/".$xnumeanio;
	     $ynumedia=intval(substr($xfecha2,8,2));
	     $ynumemes=intval(substr($xfecha2,5,2));
	     $ynumeanio=intval(substr($xfecha2,0,4));
             $ttfecha2=$ynumedia."/".$ynumemes."/".$ynumeanio;
	     $sumamonto=$sumamonto+$xapagar;



    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px;text-align:left">'.$cliente.'</td>
    <td style="position:absolute;left:75px;top:'.$cuentalin.'px;width:500px;height:37px;font-size:20px;text-align:left">'.$ncliente.'</td>
    <td style="position:absolute;left:600px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">De: '.$ttfecha1.' A: '.$ttfecha2.'</td>
    <td style="position:absolute;left:950px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px;text-align:left">'.$xmonto.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:120px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Cedula:'.$xdui.'</td>
    <td style="position:absolute;left:400px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Abonos:'.$xabonos.'</td>
    <td style="position:absolute;left:550px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Total a pagar:'.$xapagar.'</td>
    <td style="position:absolute;left:750px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">Meses en MORA:'.$xmesespen.'</td>
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
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:605px;height:37px">_________________________________________________________________________________________________________________________</td>
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

                           }  //fin de SI el clientes es parte del reporte
			}  //fin del while
    echo '
    <tr>
    <td style="position:absolute;left:800px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:18px">Total a cobrar: $ '.$sumamonto.'</td>
    </tr>';
			echo'
		</table>
	</div>
</body>
</html>';

  
 }

ob_end_clean();
$pdf->writeHTML($content, true, 0, true, 0);
$pdf->lastPage();
$pdf->output('pdfRep_debem1.pdf', 'I');

?>