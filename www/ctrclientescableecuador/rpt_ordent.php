<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_activ_ordent($_GET['fd'],$_GET['fh'],$_GET['bod']);
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

			if (isset ($_POST['bod']))
			{
				$bodega1=$_POST['bod'];
				if($bodega1!="")
				{
				 $bodega=$_POST['bod'];
				 $_SESSION["labodega"]=$bodega;
				}       
				else                                    
				{
				 $bodega=$_SESSION["labodega"];
				}       
			}
			else
			{
				$bodega1=$_GET['bod'];
				if($bodega1!="")
				{
				 $bodega=$_GET['bod'];
				 $_SESSION["labodega"]=$bodega;
				}       
				else                                    
				{
				 $bodega=$_SESSION["labodega"];
				}       
			}

	 $cod_bodega=$bodega;
	 $nom_bodega="";
         $sentencia2 = "select nombre FROM bodegas where idbodegas=$bodega"; 
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
<title>SICCAE - Orden de trabajo para los tecnicos</title>
</head>
<body>
	<div style="position:absolute;left:80px;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:130px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>ORDEN DE TRABAJO</strong></span>
		</div>
		<div style="position:absolute;left:870px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

		<div style="position:absolute;left:10px;top:120px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Bobina RG6: </strong></span>
		</div>

		<div style="position:absolute;left:10px;top:140px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Odometro Inicial: </strong></span>
		</div>

		<div style="position:absolute;left:10px;top:160px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Odometro Final: </strong></span>
		</div>
				
		<div style="position:absolute;left:10px;top:180px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Cable inicial: </strong></span>
		</div>

		<div style="position:absolute;left:10px;top:200px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Cable final: </strong></span>
		</div>

		<hr style="margin:0;padding:0;position:absolute;left:1px;top:220px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:230px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:10px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px;width:80px"><strong>Direccion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Zona</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Actividad a realizar</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Telefono</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Detalles</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>Fecha</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>HORA INICIO</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>CABLE RG6</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>CONECT RG6</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>GRAPAS</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>UNION RG6</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>SPLITTER 1x2</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>SPLITTER 1x3</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>CABLE MODEM</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>CONECT PRES</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>FILTRO RUIDO</strong></td>
				<td class="FilaN" style="height: 22px; font-size:10px"><strong>HORA FIN</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:10px;text-align: center;padding-right:0px;"><strong>Observaciones y firma</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumatotal=0;
			while ( $fila = mysql_fetch_array($resultado))
			{
                         if(intval(substr($fila['fechareali'],0,4))<2000)
                          {
			 //Buscando el nombre del cliente
			 $ncliente="";
			 $codcliente=$fila['cod_cliente'];
			 $ncliente=$fila['nomclie'];
			 $tarea=$fila['tarea'];
			 $xxfecha1=$fila['fecha'];
			 $xxfecha2=$fila['fecharepro'];
                         $lasucu=$fila['sucursal'];
		         if(intval(substr($xxfecha2,0,4))>2000)
			  {
                            $xfecha=$xxfecha2;
                            $xtarea=$tarea."(Reprogramada)";
			  }
			   else
			  {
                            $xfecha=$xxfecha1;
		            $xtarea=$tarea;
			  }

			 $sentencia = "select * from clientes where cod_cliente='".$codcliente."' and sucursal='".$lasucu."'";  
			 $resultado2 = mysql_query($sentencia);
			 if(mysql_num_rows ( $resultado2 )!=0)
			   {
			    $filaz=mysql_fetch_array($resultado2);
				    //$ncliente=$filaz['nombre']." ".$filaz['apellido'];
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
				$xdireccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa."-".$otraref;
			  }

                                //$total1=$fila['total'];
                                //$total=number_format($total1, 2, ".", ",");
				$xfecha1=substr($xfecha,8,2)."-".substr($xfecha,5,2)."-".substr($xfecha,0,4);

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$codcliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xdireccion.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xnmuni.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$fila['nomservi'].'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xtelefono.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xtarea.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center">'.$xfecha1.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align: right"></td>
					</tr>';	
                          	$cuentafila+=1;
                          	
				if($cuentafila>10)
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
				 <td class="FilaNI2" style="height: 22px; font-size:10px;width:50px"><strong>Codigo</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>Nombre del cliente</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px;width:80px"><strong>Direccion</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>Zona</strong></td>
			 	 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>Actividad a realzar</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>Telefono</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>Detalles</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>fecha</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>HORA INICIO</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>CABLE RG6</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>CONECT RG6</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>GRAPAS</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>UNION RG6</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>SPLITTER 1x2</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>SPLITTER 1x3</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>CABLE MODEM</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>CONECT PRES</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>FILTRO RUIDO</strong></td>
				 <td class="FilaN2" style="height: 22px; font-size:10px"><strong>HORA FIN</strong></td>
				 <td class="FilaNF2" style="height: 22px; font-size:10px;text-align: center;padding-right:0px;"><strong>Observaciones y firma</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
                              }
                            }

			}  //fin del while
			//$sumatotalgen=number_format($sumatotal, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:10px; text-align: center"></td>
			<td class="FilaNF" style="height: 22px;font-size:10px; text-align: right"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
?>