<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_partidas_repo1($_GET['fd'],$_GET['fh'],$_GET['proy'],$_GET['bod']);

	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
	No hay datos para esas fechas, bodega o proyecto. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 $fechai=$_GET['fd'];
         $fechaf=$_GET['fh'];
	 $cod_obra=$row['cod_proyecto'];
	 $nom_obra=$row['nombre_proyecto'];
	 $cod_bodega=$row['cod_bodega'];
	 $nom_bodega=$row['nombre_bodega'];

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
.FilaN {
	font-weight: normal;
	color: black;
	text-align: center;
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
</style>
<title>S I C I O - Reporte de Costos en un Período</title>
</head>
<body>
	<div style="position:absolute;left:15%;top:15px;border:1px no-solid;width:820px;height:95%;">
		<div style="position:absolute;left:10px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></div>
		
		<div style="position:absolute;left:40px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de Costos en un Periodo</strong></span>
		</div>
		<div style="position:absolute;left:690px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:50px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:50px;top:90px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Proyecto: </strong>'.$nom_obra.'</span>
		</div>
		<div style="position:absolute;left:50px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Bodega: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:10px;top:120px;width:800px;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:130px;width:800px;">
			<tr>
				<td class="FilaNI" style="height: 22px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Descripcion.</strong></td>
				<td class="FilaN" style="height: 22px"><strong>U.Med.</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Cantidad</strong></td>
				<td class="FilaN" style="height: 22px"><strong>PrecioU.</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Total $</strong></td>
			</tr>';	
                        $cambiapar="";
			$cambiasubpar="";
			$cambiasubpar_a="";
			$cambiasubpar_b="";
			while ( $fila = mysql_fetch_array($resultado))
			{
                          if($fila['tipo_art']!="2")
                            {
                             $cod_articulo=$fila['cod_articulo'];
                             //$cod_partida=$fila['num_partida'];
                             //$cod_subpartida=$fila['num_subpartida'];
                             //$cod_subpartida_a=$fila['num_supartida_a'];
                             //$cod_subpartida_b=$fila['num_subpartida_b'];

				if($fila['num_partida']!=$cambiapar or $fila['num_subpartida']!=$cambiasubpar or $fila['num_supartida_a']!=$cambiasubpar_a)
                                {
                                 $xnompart="";
                                 $cod_partida=$fila['num_partida'];
                                 $cod_subpartida=$fila['num_subpartida'];
                                 $cod_subpartida_a=$fila['num_supartida_a'];
                                 $cod_subpartida_b=$fila['num_subpartida_b'];
				 if($cod_subpartida_b!="")
                                  {
				  $sentencia2 = "select Nombre FROM subpartidas_b where idproyecto='".$cod_obra."' and idpartida='".$cod_partida."' and idsubpartida='".$cod_subpartida."' and idsubpartida_a='".$cod_subpartida_a."' and idsubpartida_b='".$cod_subpartida_b."'"; 
				  $resultado2 = mysql_query($sentencia2);
	                	  if(isset($resultado2))
	    	                   {
			           if(mysql_num_rows ( $resultado2 )!=0)
			            {
			             $row=mysql_fetch_array($resultado2);
			 	     $xnompart=$row['Nombre'];
                           	    }
                                   }

//este parrafo hay que quitarlo para usar el GROUP
			 	$sumapart=0;
                         	$sentenciaw="select sum(cantidad*preciou) AS xsumapart  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."' and num_supartida_b='".$cod_subpartida_b."' ";
                         	$resultadow = mysql_query($sentenciaw);
	                 	if(isset($resultadow))
    	                  	 {
		           	  if(mysql_num_rows ( $resultadow )!=0)
		           	  {
  		            	  $filaw=mysql_fetch_array($resultadow);
			    	  $sumapart1=$filaw['xsumapart'];
				  $sumapart=number_format($sumapart1, 2, ".", ",");
                           	  }
                          	 }

//FIN DE PARRAFO
			 		//$sumapart=0;
                         		//$sentenciaw="select sum(cantidad*preciou) AS xsumapart  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."' and num_subpartida_b='".$cod_subpartida_b."' ";
                         		//$resultadow = mysql_query($sentenciaw);
	                 		//if(isset($resultadow))
    	                  		 //{
		           		  //if(mysql_num_rows ( $resultadow )!=0)
		           	 	 //{
  		            		  //$filaw=mysql_fetch_array($resultadow);
			    	 	 //$sumapart1=$filaw['xsumapart'];
					  //$sumapart=number_format($sumapart1, 2, ".", ",");
                           		  //}
                          		 //}
                                  }
                                   else
                                  {
				  $sentencia2 = "select Nombre FROM subpartidas_a where idproyecto='".$cod_obra."' and idpartida='".$cod_partida."' and idsubpartida='".$cod_subpartida."' and idsubpartida_a='".$cod_subpartida_a."'"; 
				  $resultado2 = mysql_query($sentencia2);
	                	  if(isset($resultado2))
	    	                   {
			           if(mysql_num_rows ( $resultado2 )!=0)
			            {
			             $row=mysql_fetch_array($resultado2);
			 	     $xnompart=$row['Nombre'];
                           	    }
                                   }

//este parrafo hay que quitarlo para usar el GROUP
			 	$sumapart=0;
                         	$sentenciaw="select sum(cantidad*preciou) AS xsumapart  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."'";
                         	$resultadow = mysql_query($sentenciaw);
	                 	if(isset($resultadow))
    	                  	 {
		           	  if(mysql_num_rows ( $resultadow )!=0)
		           	  {
  		            	  $filaw=mysql_fetch_array($resultadow);
			    	  $sumapart1=$filaw['xsumapart'];
				  $sumapart=number_format($sumapart1, 2, ".", ",");
                           	  }
                          	 }

//FIN DE PARRAFO

			 		//$sumapart=0;
                         		//$sentenciaw="select sum(cantidad*preciou) AS xsumapart  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."'";
                         		//$resultadow = mysql_query($sentenciaw);
	                 		//if(isset($resultadow))
    	                  		 //{
		           		  //if(mysql_num_rows ( $resultadow )!=0)
		           	 	 //{
  		            		  //$filaw=mysql_fetch_array($resultadow);
			    	 	 //$sumapart1=$filaw['xsumapart'];
					  //$sumapart=number_format($sumapart1, 2, ".", ",");
                           		  //}
                          		 //}

                                   }


 				  echo '
					<tr>
						<td class="FilaNI" style="height: 22px; text-align: left;background-color: #E3E3E3">Part.:'.$cod_partida.'-'.$cod_subpartida.'-'.$cod_subpartida_a.'-'.$cod_subpartida_b.'</td>
						<td class="FilaN" style="height: 22px; text-align: left;background-color: #E3E3E3">'.$xnompart.'</td>
						<td class="FilaN" style="height: 22px; text-align: left;background-color: #E3E3E3">-</td>
						<td class="FilaN" style="height: 22px; text-align: left;background-color: #E3E3E3">-</td>
						<td class="FilaN" style="height: 22px; text-align: left;background-color: #E3E3E3">-</td>
						<td class="FilaNF" style="height: 22px; text-align: right;background-color: #E3E3E3">'.$sumapart.'</td>
					</tr>';	
				
				 } //fin si hubo cambio de partida

			 	//sumando las cantidades por un producto especifico
             		       //if($cod_subpartida_b!="")
                                //{
				//$sumaarti=0;
                         	//$sentenciay="select sum(cantidad) AS xsumaarti, sum(preciou) AS xsumapre  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and cod_articulo='".$cod_articulo."'  and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."' and num_subpartida_b='".$cod_subpartida_b."'";
                         	//$resultadoy = mysql_query($sentenciay);
	                 	//if(isset($resultadoy))
    	                  	 //{
		           	  //if(mysql_num_rows ( $resultadoy)!=0)
		           	  //{
  		            	  //$filay=mysql_fetch_array($resultadoy);
			    	  //$sumaart1=$filay['xsumaarti'];
				  //$sumapre1=$filay['xsumapre'];
				  //$sumaarti=number_format($sumaart1, 2, ".", ",");
				  //$sumapre2=$sumapre1/$sumaart1;
                           	  //}
                          	 //}
				//}
                                //else
                                //{
				//$sumaarti=0;
                         	//$sentenciay="select sum(cantidad) AS xsumaarti, sum(preciou) AS xsumapre  from vw_rpt_costos_par where fecha>=str_to_date('$fechai','%d-%m-%Y') and fecha<=str_to_date('$fechaf','%d-%m-%Y') and cod_bodega='".$cod_bodega."' and cod_proyecto='".$cod_obra."' and cod_articulo='".$cod_articulo."'  and num_partida='".$cod_partida."' and num_subpartida='".$cod_subpartida."' and num_supartida_a='".$cod_subpartida_a."'";
                         	//$resultadoy = mysql_query($sentenciay);
	                 	//if(isset($resultadoy))
    	                  	 //{
		           	  //if(mysql_num_rows ( $resultadoy)!=0)
		           	  //{
  		            	  //$filay=mysql_fetch_array($resultadoy);
			    	  //$sumaart1=$filay['xsumaarti'];
				  //$sumapre1=$filay['xsumapre'];
				  //$sumaarti=number_format($sumaart1, 2, ".", ",");
				  //$sumapre2=$sumapre1/$sumaart1;
                           	  //}
                          	 //}
				 //}

                                $total1=(($fila['preciou'])*($fila['cantidad']));
                                $total=number_format($total1, 2, ".", ",");
				$preciou1=$fila['preciou'];
				$preciou=number_format($preciou1, 2, ".", ",");
				$cantidad1=$fila['cantidad'];
				$cantidad=number_format($cantidad1, 2, ".", ",");	
			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px; text-align: center">'.$fila['cod_articulo'].'</td>
						<td class="FilaN" style="height: 22px; text-align: left">'.$fila['nom_articulo'].'</td>
						<td class="FilaN" style="height: 22px; text-align: center">'.$fila['umedida'].'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$cantidad.'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$preciou.'</td>
						<td class="FilaNF" style="height: 22px;text-align: right">'.$total.'</td>
					</tr>';	
				$cambiapar=$fila['num_partida'];
				$cambiasubpar=$fila['num_subpartida'];		
				$cambiasubpar_a=$fila['num_supartida_a'];		
				$cambiasubpar_b=$fila['num_subpartida_b'];		
                         } 
			}
			echo'
		</table>
	</div>
</body>
</html>';
?>