<?php
  //solo clientes conectados
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_coneccontrat($_GET['bod']);

	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay datos para esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
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
<title>SICCAE - Reporte de clientes con contratos vencidos o por vencer</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Clientes con contrato vencido o por vencer</strong></span>
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
				<td class="FilaN" style="height: 22px"><strong>Fecha contrato</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Meses de contrato</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Meses para caducar</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Direccion</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
		        $xdireccion="";
			while ( $filaz = mysql_fetch_array($resultado))
			{
			    $cliente=$filaz['cod_cliente'];
			    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
			    $xfechai=$filaz['fechai'];
			    $xfechaul=$filaz['fechaul'];
		            $xvivienda=$filaz['vivienda'];
		            $cerouno=1;
				$periodocon=$filaz['numeperi'];
				$fe1=$filaz['fechai'];                                                                        
				$fe2=date('Y/m/d');
				$fechainicial = new DateTime($fe1);
				$fechafinal = new DateTime($fe2);
				$diferencia = $fechainicial->diff($fechafinal);
				$meseshastahoy = ( $diferencia->y * 12 ) + $diferencia->m;
                                $diferencia=$filaz['numeperi']-$meseshastahoy;
			    if($diferencia<0)
				{
                                 $diferencia=0;    
			   	}
                               
                            if($diferencia<=2)
				{
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

                                $periodocon=number_format($periodocon,0);


			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$xfechai.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$periodocon.'</td>
						<td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$diferencia.'</td>
						<td class="FilaNF" style="height: 22px;font-size:10px; text-align:left">'.$xdireccion.'</td>
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
				<td class="FilaNI2" style="height: 22px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Fecha contrato</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Meses de contrato</strong></td>
				<td class="FilaN2" style="height: 22px"><strong>Meses para caducar</strong></td>
				<td class="FilaNF2" style="height: 22px;text-align: center;padding-right:0px;"><strong>Direccion</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			    }   //si faltan menos de 2 meses para caducar el contrato
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px;width:50px; font-size:10px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:10px; text-align: left"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';

?>