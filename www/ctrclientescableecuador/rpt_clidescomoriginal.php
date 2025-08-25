<?php

if($_GET['ti']==1)
 {
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_descom($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);

	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos para esas fechas en esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
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
<title>SICCAE - Reporte de clientes conectados</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de clientes desconectados con mora</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Fecha Ul.Pago</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Fecha Desconexion</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Mora</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Direccion</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
                        $sumamora=0;
			$xdireccion="";
			while ( $filaz = mysql_fetch_array($resultado))
			{
			    $cliente=$filaz['cod_cliente'];
			    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
			    $xfechai=$filaz['fedesco'];
			    $xfechaul=$filaz['fechaul'];
			    $xvivienda=$filaz['vivienda'];
			    $xmora=$filaz['morahoy'];
			    $xdireccion=$xvivienda;
			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$xfechaul.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$xfechai.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$xmora.'</td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align:left">'.$xdireccion.'</td>
					</tr>';	

                          	$cuentafila+=1;
				$sumalineas+=1;
				$sumamora=$sumamora+$xmora;
                          	
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
				<td class="FilaNI2" style="height: 22px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Fecha Ul.Pago</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Fecha Desconexion</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Mora</strong></td>
				<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Direccion</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
			$sumamorag=number_format($sumamora, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center">Total</td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$sumamorag.'</td>
			<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: left"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}

if($_GET['ti']==2)
 {

 $fecha_in1=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fi1=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);

//  require_once("./logica/log_reportes.php");
//  $resultado=log_obtener_clientes_descom($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);

  $cod_bodega=$_GET['bod'];


   $fechat1=date('Y-m-d');
   $xmex2=intval(substr($fechat1,5,2));


   $sentencia="select cod_cliente,nombre,apellido,fechaul,parametrodire,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
   otraref,valorplan,fechap1,fechap2,fechaip,cod_vende,ulmespago,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal,parametromes1,parametromes2,parametromes3,
   parametromes4,parametromes5,parametromes6,parametromes7,parametromes8,parametromes9,parametromes10,parametromes11,parametromes12
   from clientes where estatus=1 and sucursal=$bod";
   $resultado = mysql_query($sentencia);

         //rastreando todos los registros de clientes un por uno para.................
	 while ( $filaz = mysql_fetch_array($resultado))
	 {
 	  $cliente=$filaz['cod_cliente'];
          $cod_bodega=$filaz['sucursal'];
          $valplan=$filaz['valorplan'];
	  $xdepto=$filaz['cod_depto'];
	  $xmuni=$filaz['cod_ciudad'];
	  $xcanton=$filaz['cod_canton'];
          $costoplan=$filaz['valorplan'];
	  $xbarrio=$filaz['cod_barrio'];
	  $xcaserio=$filaz['cod_caserio'];
	  $xpasaje=$filaz['pasaje'];
	  $xpoligono=$filaz['poligono'];
	  $xcasa=$filaz['casa'];
	  $xblocke=$filaz['blocke'];
	  $xcalle=$filaz['calle'];
	  $xave=$filaz['ave'];
	  $otraref=$filaz['otraref'];
          $debe=0;
          $xmonto=0;

          //Evalua si el mes pagado (segunda fecha del periodo) es igual al mes actual y el dia de pago del cliente es mayor o igual al dia de hoy
          if(intval(substr($filaz['ulfepago2'],5,2))==$xmex2 and ($filaz['fechap']>=intval(substr($fechat1,8,2))))
	   {
            $restar=1;
	   }
	    else
	   {
            $restar=0;
	   }

          $d1="";
          $d2="";

          //Buscando el ultimo periodo pagado por el cliente
          $sentencia2 = "select fechafin,fechaini,pagado FROM periodos where sucursal='".$cod_bodega."' and cod_cliente='".$cliente."' and pagado=1 order by fechafin"; 
          $resultado2 = mysql_query($sentencia2);
          if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
    	      $fx0=$row['fechaini'];
	      $fx1=$row['fechafin'];
	      $pp=$row['pagado'];
	      while ( $row = mysql_fetch_array($resultado2))
		{
		  if($row['fechafin']>=$fx1) 
		   {
		    $fx1=$row['fechafin'];
		    $fx0=$row['fechaini'];
		    $pp=$row['pagado'];
		   }
 	        }

		$numedia=substr($fx0,8,2);
		$numemes=substr($fx0,5,2);
		$numeanio=substr($fx0,0,4);
                $nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
                $fx0=date('Y-m-d',$nuevaf);


		$numedia=substr($fx1,8,2);
		$numemes=substr($fx1,5,2);
		$numeanio=substr($fx1,0,4);
                $nuevaf= strtotime($numeanio."-".$numemes."-".$numedia);
                $fx1=date('Y-m-d',$nuevaf);

           $d1=$fx0;
           $d2=$fx1;

          //evalua si el ultimo periodo programado para el cliente FX0 en un mes menos que FX1. o si es de diciembre a enero, solo asi pasa en el lazo
          //si el mes del inicio del periodo es menor que el mes del final del periodo o el mes inicial del periodo es 12 y el mes final del periodo es 1 o sea que cambio de año
	  if(intval(substr($fx0,5,2))<intval(substr($fx1,5,2)) or (intval(substr($fx0,5,2))==12 and intval(substr($fx1,5,2))==1))
	   {
            if($fechat1>=$fx1)    //si la fecha del hoy es mayor o igual a la fecha final del periodo pagado
	      {
                if($pp==1)   //si esta pagado
 		      {
                       $xdebe=0;
        	      }
                       else
 		      {
                       $xdebe=1;
        	      }
             
  	         while ($fechat1>=$fx1)    //mientras la fecha de hoy sea mayor o igual a la fecha mayor del periodo de pago
		 {
		     $numedia=intval(substr($fx1,8,2));
		     $numemes=intval(substr($fx1,5,2));
		     $numeanio=intval(substr($fx1,0,4));
		     if(intval(substr($fx1,5,2))<12)	
			{
                         $nf1=intval(substr($fx1,5,2))+1;
			 $ntf1=intval(substr($fx1,0,4));
			}
                         else	
			{
                          $nf1=1;
			  $ntf1=intval(substr($fx1,0,4))+1;
			}
                       $numemes=$nf1;
                       $numeanio=$ntf1;
                       if($numedia==31)	
 		        {
                          $numedia=30;
        	        }
			if($numemes==2 and $numedia>28)
 		         {
			  $numedia=28;
        	         }

			if($fechat1>=$fx1) 
		         {
			  $debe+=1;
        	         }


		     $nuevaf=strtotime($numeanio."-".$numemes."-".$numedia);
                     $fx1=date('Y-m-d',$nuevaf);


 	         }   //fin del while
              }

        $debe-=1;


                 if($restar==1)
	          {
		   $debe=$debe-1;
                   if($debe>0)
	            {
                      if($debe>99)
	               {
		        $debe=99;
	  	       }
	               $sentencia="update clientes set debemeses='".$debe."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
	       	       $resultado2 = mysql_query($sentencia);
	  	    }
       	          }
                  else
	          {
                   if($debe>99)
	           {
		    $debe=99;
	  	   }
	           $sentencia="update clientes set debemeses='".$debe."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
	       	   $resultado2 = mysql_query($sentencia);
      	          }
           }// fin de SI FX0<FX1
          } //fin de IF si encontro periodo en tabla PERIODOS (evaluacion1)
         } //fin de IF si encontro periodo en tabla PERIODOS
          

            $xmonto=$debe*$costoplan;

           //antes de cambiar de cliente hay que armar la direccion y  marcarlo como registro a imprimir

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
			$xdireccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa;
		        $sentencia="update clientes set parametrodire='".$xdireccion."',parametromon='".$xmonto."',parametroprint='".$cerouno."',fechap1='".$d1."',fechap2='".$d2."'  where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);

                //actualizando los pagos segun las facturas
                $mesanterior=intval(substr($fechat1,5,2))-1;
		$anio=intval(substr($fechat1,0,4));
                if($mesanterior==0)
		 {
		  $mesanterior=12;
                  $anio=$anio-1;
		 }
		 $numemedddd=1;
                 $doce=12;
	 	 for ($xxxx = $numemedddd; $xxxx <= $doce; $xxxx++) 
                 {
                  $montof=0;
                  $cadex=$mesanterior;
		  $res=mysql_query("select total from facturas where substr(fechafac,5,2)='".$mesanterior."' and substr(fechafac,0,4)='".$anio."' and cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'");
	          while($row=mysql_fetch_assoc($res)) 
                    {
                     $montof+=$row['total'];
                    }
                  if($xxxx==1)
                   {
		        $sentencia="update clientes set parametromes12='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==2)
                   {
		        $sentencia="update clientes set parametromes11='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==3)
                   {
		        $sentencia="update clientes set parametromes10='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==4)
                   {
		        $sentencia="update clientes set parametromes9='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==5)
                   {
		        $sentencia="update clientes set parametromes8='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==6)
                   {
		        $sentencia="update clientes set parametromes7='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==7)
                   {
		        $sentencia="update clientes set parametromes6='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==8)
                   {
		        $sentencia="update clientes set parametromes5='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==9)
                   {
		        $sentencia="update clientes set parametromes4='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==10)
                   {
		        $sentencia="update clientes set parametromes3='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==11)
                   {
		        $sentencia="update clientes set parametromes2='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                  if($xxxx==12)
                   {
		        $sentencia="update clientes set parametromes1='".$montof."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);
   		   }
                 $mesanterior=$mesanterior-1;
                 if($mesanterior==0)
                   {
		      $mesanterior=12;
                      $anio=$anio-1;
   		   }
   		 }//fin del FOR

	}  //fin del while general rastreando los registros que cumplen la condicion
  }

  //Tomando el nombre de la sucursal
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
<title>SICCAE - Historial de pagos de clientes con mora</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">

			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Historial de pagos de clientes con mora</span>
			</div>
		<div style="position:absolute;left:850px;top:30px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:50px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:70px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:80px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px;font-size:15px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>F.conexion</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Cobrador</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Dia pago</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Ultimo periodo pagado</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes pagado</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>F.Ulpago</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Valor Cuota</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Meses Mora</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Otra referencia</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes1</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes2</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes3</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes4</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes5</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes6</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes7</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes8</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes9</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes10</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes11</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Mes12</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;

			$cuentalin=65;
			$cuentalin2=10;
			$cvppag=0;

		        $sentencia2="select * from clientes where sucursal='".$cod_bodega."' and parametroprint=1"; 
			$resultadofin = mysql_query($sentencia2);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
			  $xfechai=$filad['fechaip'];
			  $cod_vende=$filad['cod_vende'];
			  $fechap=$filad['fechap'];
                          $mespa=$filad['ulmespago'];
			  $xfechaul=$filad['fechaul'];
			  $xfecha1=$filad['fechap1'];
			  $xfecha2=$filad['fechap2'];
			  $valorplan=$filad['valorplan'];

			  $xdireccion=$filad['parametrodire'];
			  $xmonto=$filad['parametromon'];
			  $xmesespen=$filad['debemeses'];
			  $xotraref=$filad['otraref'];
			  $montomes1=$filad['parametromes1'];
			  $montomes2=$filad['parametromes2'];
			  $montomes3=$filad['parametromes3'];
			  $montomes4=$filad['parametromes4'];
			  $montomes5=$filad['parametromes5'];
			  $montomes6=$filad['parametromes6'];
			  $montomes7=$filad['parametromes7'];
			  $montomes8=$filad['parametromes8'];
			  $montomes9=$filad['parametromes9'];
			  $montomes10=$filad['parametromes10'];
			  $montomes11=$filad['parametromes11'];
			  $montomes12=$filad['parametromes12'];

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
   			    <td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$cliente.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xfechai.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$cod_vende.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$fechap.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">De: '.$ttfecha1.' A: '.$ttfecha2.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$mespa.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xfechaul.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$valorplan.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmesespen.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmonto.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xdireccion.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xotraref.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes1.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes2.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes3.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes4.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes5.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes6.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes7.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes8.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes9.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes10.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes11.'</td>
			    <td class="FilaNF" style="height: 22px;font-size:10px; text-align: left">'.$montomes12.'</td>
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
					<td class="FilaNI2" style="height: 22px;width:50px;font-size:15px"><strong>Codigo</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Nombre del cliente</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>F.conexion</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Cobrador</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Dia pago</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Ultimo periodo pagado</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes pagado</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>F.Ulpago</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Valor Cuota</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Meses Mora</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Otra referencia</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes1</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes2</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes3</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes4</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes5</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes6</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes7</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes8</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes9</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes10</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes11</strong></td>
					<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Mes12</strong></td>
					</tr>';	
					$cuentafila=1;
				}
			}  //fin del while

		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px;font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">TOTAL</td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: left"></td>
			</tr>';	


                       } //si encontro registros en el rango de fechas del repporte
			echo'
		</table>
	</div>
</body>
</html>';


 }


if($_GET['ti']==3)   &&rastrea tambien el comportamiento del clientes en sus pagos mensuales
 {
  require_once("./logica/log_reportes.php");
  $resultado=log_obtener_clientes_descom($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);


 // $labodega=$_GET['bod'];
 // if($labodega!="")
 //  {
 //   $_SESSION["bode"]=$labodega;
 //   $cod_bodega=$_SESSION["bode"];
 //  }
 //   else
 //  {
 //   $cod_bodega=$_SESSION["bode"];
 //  }

  $cod_bodega=$resultado;

  //Tomando el nombre de la sucursal
  //$row=mysql_fetch_array($resultado);
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
<title>SICCAE - Historial de pagos de clientes con mora</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">

			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Historial de pagos de clientes con mora</span>
			</div>
		<div style="position:absolute;left:850px;top:30px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:50px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:70px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:80px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px;width:50px;font-size:15px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>F.conexion</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Cobrador</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Dia pago</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Ultimo periodo pagado</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes pagado</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>F.Ulpago</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Valor Cuota</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Meses Mora</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Otra referencia</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes1</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes2</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes3</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes4</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes5</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes6</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes7</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes8</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes9</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes10</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Mes11</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Mes12</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;

			$cuentalin=65;
			$cuentalin2=10;
			$cvppag=0;

		        $sentencia2="select * from clientes where sucursal='".$cod_bodega."' and parametroprint=1"; 
			$resultadofin = mysql_query($sentencia2);
			if( mysql_num_rows($resultadofin)!=0)
		         {
	  		 while ( $filad = mysql_fetch_array($resultadofin))
			 {
 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido'];
			  $xfechai=$filad['fechaip'];
			  $cod_vende=$filad['cod_vende'];
			  $fechap=$filad['fechap'];
                          $mespa=$filad['ulmespago'];
			  $xfechaul=$filad['fechaul'];
			  $xfecha1=$filad['fechap1'];
			  $xfecha2=$filad['fechap2'];
			  $valorplan=$filad['valorplan'];

			  $xdireccion=$filad['parametrodire'];
			  $xmonto=$filad['parametromon'];
			  $xmesespen=$filad['debemeses'];
			  $xotraref=$filad['otraref'];
			  $montomes1=$filad['parametromes1'];
			  $montomes2=$filad['parametromes2'];
			  $montomes3=$filad['parametromes3'];
			  $montomes4=$filad['parametromes4'];
			  $montomes5=$filad['parametromes5'];
			  $montomes6=$filad['parametromes6'];
			  $montomes7=$filad['parametromes7'];
			  $montomes8=$filad['parametromes8'];
			  $montomes9=$filad['parametromes9'];
			  $montomes10=$filad['parametromes10'];
			  $montomes11=$filad['parametromes11'];
			  $montomes12=$filad['parametromes12'];

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
   			    <td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$cliente.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xfechai.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$cod_vende.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$fechap.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">De: '.$ttfecha1.' A: '.$ttfecha2.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$mespa.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xfechaul.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$valorplan.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmesespen.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmonto.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xdireccion.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xotraref.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes1.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes2.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes3.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes4.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes5.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes6.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes7.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes8.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes9.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes10.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$montomes11.'</td>
			    <td class="FilaNF" style="height: 22px;font-size:10px; text-align: left">'.$montomes12.'</td>
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
					<td class="FilaNI2" style="height: 22px;width:50px;font-size:15px"><strong>Codigo</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Nombre del cliente</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>F.conexion</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Cobrador</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Dia pago</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Ultimo periodo pagado</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes pagado</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>F.Ulpago</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Valor Cuota</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Meses Mora</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Otra referencia</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes1</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes2</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes3</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes4</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes5</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes6</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes7</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes8</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes9</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes10</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Mes11</strong></td>
					<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Mes12</strong></td>
					</tr>';	
					$cuentafila=1;
				}
			}  //fin del while

		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px;font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">TOTAL</td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: left"></td>
			</tr>';	


                       } //si encontro registros en el rango de fechas del repporte
			echo'
		</table>
	</div>
</body>
</html>';


 }

?>