<?php
unset($_POST);
error_reporting(0);
  //Lista de datos contractuales ordenado por dia de pago ascendente y fecha de conexion descendente

	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_listaclientesp($_GET['fd'],$_GET['bod']);

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

	 $cod_plan=$_GET['fd'];
	 $nom_plan="";
         $sentencia2 = "select nombre_plan FROM planes where cod_plan='".$cod_plan."'"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $nom_plan=$row['nombre_plan'];
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

<title>CUSTOMERSCABLETV - Reporte de clientes por plan</title>
</head> 

<body>

	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>
		<div style="position:absolute;left:100px;top:30px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Lista de clientes a cobrar segun plan contratado</strong></span>
		</div>


		<div style="position:absolute;left:10px;top:70px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

		<div style="position:absolute;left:10px;top:90px;width:700px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Plan Contratado: </strong>'.$nom_plan.'</span>
		</div>
				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
			<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Poblacion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Sector</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Caja</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Direccion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Referencias</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Debe meses</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Desde</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>A PAGAR</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			$sumatotal=0;
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
    $valplan=$filaz['valorplan'];


   //Revisando el pago pendiente de este cliente
   $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
   otraref,valorplan,ttplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where cod_cliente='".$cliente."' and estatus=1 and sucursal='".$cod_bodega."' and ttfactura=3";
   $resultadodebe = mysql_query($sentencia) or die($sentencia.mysql_error());

   $fechat1=date('d/m/Y');
   $xmex2=intval(substr($fechat1,3,2));
   $xanio2=intval(substr($fechat1,6,4));
   $xmex1=$xmex2;
   if(((intval(substr($filaz['ulfepago2'],5,2)))<=$xmex2 or $xanio2>intval(substr($filaz['ulfepago2'],0,4))) and $filaz['ulfepago1']!='Null' and $filaz['ulfepago2']!='Null');	   
   {
    if($filaz['ulfepago2']!='Null')  //si la fecha final del ultimo pago existe
     {
      if($filaz['ulfepago2']!=$filaz['ulfepago1'])    //si son dieferentes quiere decir que no es nueva conexion
       {
        $ufp1=$filaz['ulfepago2'];
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
             $numedia=intval(substr($ufp1,8,2));
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
             }
            }
           }  

            if($filaz['ulfepago2']=='Null')       //si no hay fecha final de un pago anterior toma como inicio la fecha de conexion
     	    {  
             if($filaz['fechaip']!='Null' and intval(substr($filaz['fechaip'],5,2))<=$xmex2)
	      {
               $ufp1=$filaz['fechaip']; 
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
               }  
              } 
 

              $ff1=$ufp1;
              $ff2=$ufp2;

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
  		$sentencia="update clientes set parametromon='".$apagarday."' where cod_cliente='".$cliente."' and fechap2!='Null' and sucursal='".$cod_bodega."'";
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


	//verificando si debe imprimirse el registro
	$estemes1=date('d/m/Y');
	$estemes=intval(substr($estemes1,3,2))+1;
	$esteanio1=date('d/m/Y');
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



         $xeanio1=intval(substr($ufp2,0,4));
	 $xemes1=intval(substr($ufp2,5,2));
	 $xedia1=1;
         $mesesborrar2=strtotime($xeanio1."-".$xemes1."-".$xedia1);
	 $mesesborrarx2=date('Y-m-d',$mesesborrar2);

         if($mesesborrarx2>$mesesborrar)
          {
           $pasa=0;
          }
          else
          {
           $pasa=1;
          }


      		}  //fin de SI esta en el rango de fechas del ultimo mes pagado para calcular monto 

   //fin de calculo de deuda del cliente

 if($mesasumar>0 and $pasa==1)
 {
			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$poblacion.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$barrio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$sector.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$caja.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$direccion.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$otraref.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$mesasumar.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$ufp1.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$apagar.'</td>
					</tr>';	

                          	$cuentafila+=1;
				$sumalineas+=1;
				$sumatotal+=$apagar;

                          	
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
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Poblacion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Sector</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Caja</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Direccion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Referencias</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Debe meses</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Desde</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>A PAGAR</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
                           } //si no cero
			}  //fin del while
			$sumatotalgen=number_format($sumalineas);
			$sumatotalgen2=number_format($sumatotal);
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center">No.Clientes: '.$sumatotalgen.'</td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center">Total: '.$sumatotalgen2.'</td>
			</tr>';	
			echo'
		</table>
	</div>


</body>
</html>';

?>