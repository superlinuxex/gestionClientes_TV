<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_activ($_GET['fd'],$_GET['fh'],$_GET['tip'],$_GET['acti'],$_GET['bod']);

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

$fechai=substr($fechai,0,2)."-".substr($fechai,3,2)."-".substr($fechai,6,4);
$fechaf=substr($fechaf,0,2)."-".substr($fechaf,3,2)."-".substr($fechaf,6,4);

$tip=$_GET['tip'];

if($tip==1)
 {
  $titulorep="REPORTE DE ACTIVIDADES TECNICAS NO ASIGNADAS";
 }
if($tip==2)
 {
  $titulorep="REPORTE DE ACTIVIDADES TECNICAS ASIGNADAS NO EJECUTADAS";
 }
if($tip==3)
 {
  $titulorep="REPORTE DE ACTIVIDADES TECNICAS EJECUTADAS";
 }
if($tip==4)
 {
  $titulorep="REPORTE DE ACTIVIDADES TECNICAS REPROGRAMADAS";
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
<title>CustomerCabletv - reporte de actividades tecnicas</title>
</head>
<body>
	<div style="position:absolute;left:10px;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:870px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>

		<div style="position:absolute;left:130px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>'.$titulorep.'</strong></span>
		</div>


		<div style="position:absolute;left:10px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:12px;width:50px"><strong>Tecnico</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px;width:80px"><strong>Direccion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>Actividad a realizar</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>Telefono</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>Detalles</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>F.solicitada</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>F.programada</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>F.realizada</strong></td>
				<td class="FilaN" style="height: 22px; font-size:12px"><strong>F.reprogramada</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:12px;text-align: center;padding-right:0px;"><strong>Observaciones</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumatotal=0;
			$xdireccion="";
			while ( $fila = mysql_fetch_array($resultado))
			{
			 //Buscando el nombre del cliente
			 $ncliente="";
			 $emple=$fila['nomemple'];
			 $codcliente=$fila['cod_cliente'];
			 $ncliente=$fila['nomclie'];
			 $xtarea=$fila['tarea'];
			 $xfecha=$fila['fechasoli'];
			 $yfecha=$fila['fecha'];
			 $zfecha=$fila['fechareali'];
			 $wfecha=$fila['fecharepro'];
			 $sentencia = "select * from clientes where cod_cliente='".$codcliente."'";  
			 $resultado2 = mysql_query($sentencia);
			 if(mysql_num_rows ( $resultado2 )!=0)
			   {
			    $filaz=mysql_fetch_array($resultado2);
		            $xvivienda=$filaz['vivienda'];
                            $cerouno=1;
		            $xtelefono=$filaz['telefono'];
			    $xdireccion=$xvivienda;
			  }

                                //$total1=$fila['total'];
                                //$total=number_format($total1, 2, ".", ",");
				$xfecha1=substr($xfecha,8,2)."-".substr($xfecha,5,2)."-".substr($xfecha,0,4);
				$xfecha2=substr($yfecha,8,2)."-".substr($yfecha,5,2)."-".substr($yfecha,0,4);
				$xfecha3=substr($zfecha,8,2)."-".substr($zfecha,5,2)."-".substr($zfecha,0,4);
				$xfecha4=substr($wfecha,8,2)."-".substr($wfecha,5,2)."-".substr($wfecha,0,4);



			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$emple.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$codcliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xdireccion.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$fila['nomservi'].'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xtelefono.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$fila['tarea'].'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xfecha1.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xfecha2.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xfecha3.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$xfecha4.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align: left">'.$fila['comentario'].'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:12px;width:50px"><strong>Tecnico</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>Nombre del cliente</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px;width:80px"><strong>Direccion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>Actividad a realizar</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>Telefono</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>Detalles</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>F.solicitada</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>F.programada</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>F.realizada</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:12px"><strong>F.reprogramada</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:12px;text-align: center;padding-right:0px;"><strong>Observaciones</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			//$sumatotalgen=number_format($sumatotal, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI" style="height: 22px;width:50px; font-size:12px; text-align: left"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF" style="height: 22px;font-size:12px; text-align: right"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
?>