<?php
	require_once("./logica/log_reportes.php");
        $resultado=log_obtener_clientes_mora($_GET['fd'],$_GET['ti'],$_GET['bod']);

	$filtromeses=$_GET['fd'];
	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos para esas fechas en esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 //$cod_bodega=$row['sucursal'];
         $cod_bodega=$_GET['bod'];

	 $cod_cobrador="";
	 $xcobrador="";
        
	 mysql_data_seek($resultado, 0); 

	//****************MARCANDO LOS REGISTROS QUE SE IMPRIMIRAN ****************
	$fechat1=date('d/m/Y');
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
            if(intval(substr($finicial,8,2))==1)
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
              $sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
              $resultado2 = mysql_query($sentencia);
             }
             else       //si el periodo dice que inicia la fecha inicial en diferente de dia 1
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
		   //$hoymes1=$_GET['fd'];
		   //sumamos 1 al mes porque es pago adelantado
		   $hoymes=intval(substr($hoymes1,3,2)+1);
		   $numemedddd=intval(substr($ff2,5,2));

                   if(intval(substr($ff2,0,4))<=intval(substr($hoymes1,6,4)))    //si el año a pagar es mayor que el año de hoy
                   {
                    $mesasumar=1;
		    $xxxx=$numemedddd;
	 	    for ($xxxx = $numemedddd; $xxxx < $hoymes; $xxxx++) 
                    {
                     $mesasumar=$mesasumar+1;
   		    }
		   }
                   else
		   {
                    $mesasumar=1;
                   }
                   if(intval(substr($ff2,5,2))==intval(substr($ff1,5,2)))
                   {
                    $mesasumar=1;
                   }
		   $recargo=0;
                     
                     $apagar=$monto+($valplan*($mesasumar-1))+$recargo;
		     $sentencia="update clientes set parametrompendi='".$mesasumar."',parametroapa='".$apagar."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                     $resultado2 = mysql_query($sentencia);

		     $ncliente=$filaz['nombre']." ".$filaz['apellido'];
		     $xdui=$filaz['nit'];
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
				$xdireccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono;
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
	 $sentencia="update clientes set parametroprint='".$anula."' where sucursal='".$cod_bodega."' and fechap2>'".$mesesborrar."'";
         $resultado2 = mysql_query($sentencia);

	//****FIN DE MARCAR REGISTROS *******************





  //Buscando el nombre  de la sucursal
  $nom_bodega="";
  $sentencia2 = "select nombre FROM bodegas where idbodegas='".$cod_bodega."'"; 
  $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
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


<title>Customerscabletv - Clientes con cuotas de pago mensual pendientes</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">

			<div style="position:absolute;left:100px;top:5px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:25px;"><strong>Clientes con cuotas de pago mensual pendientes</span>
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
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Abono</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Otra referencia</strong></td>
			</tr>';	


          $cuentafila=1;
          $sumalineas=0;
	  $cuentalin=65;
	  $cuentalin2=10;
	  $cvppag=0;
                        $sumamonto=0;
                        $sumacuotas=0;


 $sentencia66="select cod_cliente,nombre,apellido,dui,nit,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,telefono,celu,cod_vende,ulmespago,valorplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,zona,sucursal 
 from clientes 
 where estatus=1 and sucursal=$cod_bodega and parametroprint=1";
 $resultadofin = mysql_query($sentencia66) OR die(mysql_error());;
          if(isset($resultadofin))
	  {
   	    if( mysql_num_rows($resultadofin)!=0)
	      {
	        while ( $filad = mysql_fetch_array($resultadofin))
		 {

 		          $cliente=$filad['cod_cliente'];
		          $ncliente=$filad['nombre']." ".$filad['apellido']." Cedula: ".$filad['dui'];
 		          $xdui=$filad['nit'];
 		          $xsector=$filad['zona'];
 		          $xcaja=$filad['poligono'];
			  $xfechai=$filad['fechaip'];
			  $xfechaul=$filad['fechaul'];


			  $xtel=$filad['telefono'];
			  $xcel=$filad['celu'];
			  $xfecha1=$filad['ulfepago1'];
			  $xfecha2=$filad['ulfepago2'];
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

		  $valplan=$filad['valorplan'];
		  $cod_vende=$filad['cod_vende'];
		  $fechap=$filad['fechap'];
                  $mespa=$filad['ulmespago'];

          
if($filtromeses>0)
{
		
                      
                       if($xmesespen>0 and $xmesespen==$filtromeses)
			{
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
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmonto.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmesespen.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xabonos.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xapagar.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xdireccion.'</td>
			    <td class="FilaNF" style="height: 22px; font-size:10px; text-align: left">'.$xotraref.'</td>
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
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Abono</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
					<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Otra referencia</strong></td>
					</tr>';	
					$cuentafila=1;
				}
			   }
}
else
{
                       if($xmesespen>0)
			{
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
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmonto.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xmesespen.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xabonos.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xapagar.'</td>
			    <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$xdireccion.'</td>
			    <td class="FilaNF" style="height: 22px; font-size:10px; text-align: left">'.$xotraref.'</td>
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
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Abono</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Monto</strong></td>
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Direccion</strong></td>
					<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;font-size:15px"><strong>Otra referencia</strong></td>
					</tr>';	
					$cuentafila=1;
				}
			   }


}

			}  //fin del while
}
}
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px;font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
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
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: center">TOTAL </td>
			<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: left">'.$sumamonto.'</td>
			</tr>';	



			echo'
		</table>
	</div>
</body>
</html>';

?>