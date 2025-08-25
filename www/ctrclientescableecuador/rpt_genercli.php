<?php
if($_GET['ti']==1)
 {
  //Lista de datos contractuales ordenado por dia de pago ascendente y fecha de conexion descendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);

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
<title>CUSTOMERSCABLETV - Reporte de datos contractuales</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de datos contractuales del cliente</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Cobrador</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Tipo Factura</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Dia pago</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Valor del Plan</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Fecha conexion</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Ultimo periodo pagado</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $tipofac1=$filaz['ttfactura'];
    $diapago=$filaz['fechap'];
    $xfechaix=$filaz['fechaip'];
    $xplan=$filaz['valorplan'];
    $xfecha1x=$filaz['ulfepago1'];
    $xfecha2x=$filaz['ulfepago2'];
    $cobrador=$filaz['cod_vende'];


    $xfecha1=substr($xfecha1x,8,2)."-".substr($xfecha1x,5,2)."-".substr($xfecha1x,0,4);
    $xfecha2=substr($xfecha2x,8,2)."-".substr($xfecha2x,5,2)."-".substr($xfecha2x,0,4);
    $xfechai=substr($xfechaix,8,2)."-".substr($xfechaix,5,2)."-".substr($xfechaix,0,4);


if($tipofac1==1)
{
 $tipofac="Consumidor Final";
}
else
{
 $tipofac="Credito fiscal";
}


			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:14px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$cobrador.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$tipofac.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$diapago.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$xplan.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$xfechai.'</td>
						<td class="FilaNF" style="height: 22px;font-size:14px; text-align:left">'.$xfecha1.'   al   '.$xfecha2.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Cobrador</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Tipo Factura</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Dia pago</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Valor del Plan</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Fecha conexion</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Ultimo periodo pagado</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:14px; text-align: left"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';

}

if($_GET['ti']==2)
{
  //Lista de datos de identificacion ordenado por nombre ascendente y telefono descendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);

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
<title>CUSTOMERSCABLETV - Reporte de datos contractuales</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de datos de identificacion del cliente</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>DUI</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>NIT</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Telefono</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Celular</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Tipo Persona</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Reg.fiscal</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $dui=$filaz['dui'];
    $nit=$filaz['nit'];
    $telefono=$filaz['telefono'];
    $celu=$filaz['celu'];
    $ttpersonax=$filaz['ttpersona'];
    $registro=$filaz['registro'];


if($ttpersonax==1)
{
 $xttpersona="Natural";
}
else
{
 $xttpersona="Jurica";
}

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:14px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$dui.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$nit.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$telefono.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$celu.'</td>
						<td class="FilaN" style="height: 22px; font-size:14px; text-align: center">'.$xttpersona.'</td>
						<td class="FilaNF" style="height: 22px;font-size:14px; text-align:left">'.$registro.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>DUI</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>NIT</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Telefono</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>celular</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Tipo persona</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Registro</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:10px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:14px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:14px; text-align: left"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}
if($_GET['ti']==3)
{
  //Lista de datos de localizacion ordenado por barrio ascendente, caserio,colonia,calle ascencendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);
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

	//construyendo la direccion con nombres
	// mysql_data_seek($resultado, 0); 

         $sentencia2 = "select * FROM clientes where sucursal='".$cod_bodega."'"; 
         $resultado = mysql_query($sentencia2);

	while ( $filac = mysql_fetch_array($resultado))
	{

		     $cod_cliente=$filac['cod_cliente'];
		     $sucursal=$filac['sucursal'];
		     $xdepto=$filac['cod_depto'];
		     $xmuni=$filac['cod_ciudad'];
		     $xcanton=$filac['cod_canton'];
		     $xbarrio=$filac['cod_barrio'];
		     $xcaserio=$filac['cod_caserio'];

			//buscando nombre de departamento
			  //$xndepto="";
			  //$sentencian = "select nom_depto FROM deptos where cod_depto=$xdepto"; 
			  //$resultadon = mysql_query($sentencian) OR die(mysql_error());
			  //if(isset($resultadon))
			  // {
			  //  if(mysql_num_rows ( $resultadon )!=0)
			   // {
			   //  $rown=mysql_fetch_array($resultadon);
			   //  $xndepto=$rown['nom_depto'];
			  //  }
			  //  }

			//buscando nombre de municipio
//			  $xnmuni="";
//			  $sentencian = "select nomb_ciudad FROM munici where cod_depto=$xdepto and cod_ciudad=$xmuni"; 
//			  $resultadon = mysql_query($sentencian);
//			  if(isset($resultadon))
//			   {
//			    if(mysql_num_rows ( $resultadon )!=0)
//			    {
//			     $rown=mysql_fetch_array($resultadon);
//			     $xnmuni=$rown['nomb_ciudad'];
//			    }
//			   }

			//buscando nombre de canton
//			  $xncanton="";
//			  $sentencian = "select nombrecant FROM canton where cod_depto=$xdepto and cod_ciudad=$xmuni and cod_canton=$xcanton"; 
//			  $resultadon = mysql_query($sentencian);
//			  if(isset($resultadon))
//			   {
//			    if(mysql_num_rows ( $resultadon )!=0)
//			    {
//			     $rown=mysql_fetch_array($resultadon);
//			     $xncanton=$rown['nombrecant'];
//			    }
//			   }


			//buscando nombre de barrio
//			  $xnbarrio="";
//			  $sentencian = "select nombrebarrio FROM barrios where cod_depto=$xdepto and cod_ciudad=$xmuni and cod_canton=$xcanton and cod_barrio=$xbarrio";  
//			  $resultadon = mysql_query($sentencian);
//			  if(isset($resultadon))
//			   {
//			    if(mysql_num_rows ( $resultadon )!=0)
//			    {
//			     $rown=mysql_fetch_array($resultadon);
//			     $xnbarrio=$rown['nombrebarrio'];
//			    }
//			   }
		
			//buscando nombre de colonia
//			  $xncaserio="";
//			  $sentencian = "select nombrecaserio FROM caserio where cod_depto=$xdepto and cod_ciudad=$xmuni and cod_canton=$xcanton and cod_barrio=$xbarrio and cod_caserio=$xcaserio";   
//			  $resultadon = mysql_query($sentencian);
//			  if(isset($resultadon))
//			   {
//			    if(mysql_num_rows ( $resultadon )!=0)
//			    {
//			     $rown=mysql_fetch_array($resultadon);
//			     $xncaserio=$rown['nombrecaserio'];
//			    }
//			   }

                        //Activar estas dos lineas  solo si se quiere hacer una actualizacion masiva de nombres de departamentos,municipios, etc en l tabla del cliente
			//$sentenciaabc = "update clientes SET ndep='".$xndepto."',nmuni='".$xnmuni."',ncan='".$xncanton."',nbar='".$xnbarrio."',ncase='".$xncaserio."' WHERE sucursal='".$sucursal."' and cod_cliente= '".$cod_cliente."'";  
			//$resultadoabc = mysql_query($sentenciaabc);
		
	}
        //fin construccion de direccion

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
<title>CUSTOMERSCABLETV - Reporte de datos de localizacion</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de datos de localizacion de clientes</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Canton</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Caserio/Colonia</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Calle</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Avenida</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Pasaje</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Poligono</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Block</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>No.casa</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Cobrador</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $canton=$filaz['ncan'];
    $barrio=$filaz['nbar'];
    $caserio=$filaz['ncase'];
    $calle=$filaz['calle'];
    $avenida=$filaz['ave'];
    $pasaje=$filaz['pasaje'];
    $blocke=$filaz['blocke'];
    $poligono=$filaz['poligono'];
    $casa=$filaz['casa'];
    $cobrador=$filaz['cod_vende'];


			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$canton.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$barrio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$caserio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$calle.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$avenida.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$pasaje.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$poligono.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$blocke.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$casa.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$cobrador.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Canton</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Caserio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Calle</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Avenida</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Pasaje</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Poligono</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Block</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>No.casa</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Cobrador</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
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
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}



if($_GET['ti']==4)
{
  //Lista de datos de instalacion ordenado por fechaconexion ascendente, nombre ascencendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);
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
<title>CUSTOMERSCABLETV - Reporte de datos de instalacion</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de datos de instalacion de clientes</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Ingreso Reg.</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>TV.Extra</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Tipo de servicio</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Valor cuota</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>F.conexion</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $fechareg1=$filaz['fechareg'];
    $fechareg=substr($fechareg1,8,2)."-".substr($fechareg1,5,2)."-".substr($fechareg1,0,4);
    $conec=$filaz['cone'];
    $ttplan1=$filaz['ttplan'];
    $valorplan=$filaz['valorplan'];
    $fechaip1=$filaz['fechaip'];
    $fechaip=substr($fechaip1,8,2)."-".substr($fechaip1,5,2)."-".substr($fechaip1,0,4);


	 $nom_plan="";
         $sentencia2 = "select nombre_plan FROM planes"; 
         $resultado2 = mysql_query($sentencia2);
         if(isset($resultado2))
	  {
	   if(mysql_num_rows ( $resultado2 )!=0)
	     {
	      $row=mysql_fetch_array($resultado2);
	      $nom_plan=$row['nombre_plan'];
             }
          }



			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$fechareg.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$conec.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$nom_plan.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$valorplan.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$fechaip.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Ingreso Reg.</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>TV.Extra</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Tipo de servicio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Valor cuota</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>F.conexion</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}
if($_GET['ti']==5)
{
  //Lista de datos de tiempos de servicio a los clientes desconectados ordenado por meses_servicio descendente, fechadesconexion descendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);
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

	//calculando meses de servicio
	 mysql_data_seek($resultado, 0); 
	while ( $filac = mysql_fetch_array($resultado))
	{
	     $cod_cliente=$filac['cod_cliente'];
	     $sucursal=$filac['sucursal'];
	     $f1=$filac['fechaip'];
	     $f2=$filac['fedesco'];

             $xdia1=substr($f1,8,2);
	     $xmes1=substr($f1,5,2);
             $xanio1=substr($f1,0,4);
             $xdia2=substr($f2,8,2);
	     $xmes2=substr($f2,5,2);
             $xanio2=substr($f2,0,4);
  
	     $timestamp1 = mktime(0,0,0,$xmes1,$xdia1,$xanio1); 
	     $timestamp2 = mktime(0,0,0,$xmes2,$xdia2,$xanio2); 
	     $segundos_diferencia = $timestamp1 - $timestamp2;
	     $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
	     $dias_diferencia = abs($dias_diferencia);
	     $dias_diferencia = floor($dias_diferencia);
             $xmeses=$dias_diferencia/30;
	     $sentenciaabc = "update clientes SET parametromeses='".$xmeses."' WHERE sucursal='".$sucursal."' and cod_cliente= '".$cod_cliente."'";  
	     $resultadoabc = mysql_query($sentenciaabc);
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
<title>CUSTOMERSCABLETV - Reporte de datos de meses de servicio</title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de meses de servicio a clientes desconectados</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>F.conexion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>F.desconexion</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Meses de servicio</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>F.ult.pago</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);
	if( mysql_num_rows($resultado)!=0)

			while ( $filaz = mysql_fetch_array($resultado))
			{

    $cliente=$filaz['cod_cliente'];
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $fechaip1=$filaz['fechaip'];
    $fechaip=substr($fechaip1,8,2)."-".substr($fechaip1,5,2)."-".substr($fechaip1,0,4);

    $fechades1=$filaz['fedesco'];
    $fechades=substr($fechades1,8,2)."-".substr($fechades1,5,2)."-".substr($fechades1,0,4);

    $fechapag1=$filaz['fechaul'];
    $fechapag=substr($fechapag1,8,2)."-".substr($fechapag1,5,2)."-".substr($fechapag1,0,4);

    $meseser=$filaz['parametromeses'];

    if(substr($fechades1,8,2)==0)
	{
          $meseser=0;
        }



			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$fechaip.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$fechades.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$meseser.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$fechapag.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>F.conexion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>F.desconexion</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Meses de servicio</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>F.ult.pago</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
		        echo '
			<tr>
			<td class="FilaNI2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: left"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}
if($_GET['ti']==6)
{
  //Lista de datos de direcciones duplicadas ordenado por barrio ascendente, caserio,colonia,calle ascencendente
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_general1($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);
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

	//construyendo la direccion con nombres
	 mysql_data_seek($resultado, 0); 

        $sentencia = "delete from r_clie_tmp";  
        $resultadoch = mysql_query($sentencia);

 	$sentencia="insert into r_clie_tmp (cod_cliente,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,calle,ave,pasaje,poligono,casa,blocke)
           select cod_cliente,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,calle,ave,pasaje,poligono,casa,blocke from clientes";
        $resultadoch = mysql_query($sentencia);

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
<title>CUSTOMERSCABLETV - Reporte de clientes con direcciones iguales </title>
</head>
<body>
	<div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
	
		<div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de clientes con direcciones iguales</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:10px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Sucursal: </strong>'.$nom_bodega.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:1px;top:120px;width:98%;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:130px;width:98%;">
			<tr>
				<td class="FilaNI" style="height: 22px; font-size:14px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Canton</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Caserio/Colonia</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Calle</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Avenida</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Pasaje</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Poligono</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>Block</strong></td>
				<td class="FilaN" style="height: 22px; font-size:14px"><strong>No.casa</strong></td>
				<td class="FilaNF" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Cobrador</strong></td>
			</tr>';	
                        $cuentafila=1;
                        $sumalineas=0;
			while ( $filaz = mysql_fetch_array($resultado))
			{
			    $cliente=$filaz['cod_cliente'];
			    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
			    $depto=$filaz['cod_depto'];
			    $muni=$filaz['cod_ciudad'];
			    $can=$filaz['cod_canton'];
			    $bar=$filaz['cod_barrio'];
			    $case=$filaz['cod_caserio'];
			    $canton=$filaz['ncan'];
			    $barrio=$filaz['nbar'];
			    $caserio=$filaz['ncase'];
			    $calle=$filaz['calle'];
			    $avenida=$filaz['ave'];
			    $pasaje=$filaz['pasaje'];
			    $blocke=$filaz['blocke'];
			    $poligono=$filaz['poligono'];
			    $casa=$filaz['casa'];
			    $cobrador=$filaz['cod_vende'];

                            
			  $pasa=0;
			  $sentencian = "select * FROM r_clie_tmp where cod_depto='".$depto."' and cod_ciudad='".$muni."' and cod_canton='".$can."' and cod_barrio='".$bar."' and cod_caserio='".$case."' and trim(calle)=trim('".$calle."') and trim(ave)=trim('".$avenida."') and trim(pasaje)=trim('".$pasaje."') and trim(blocke)=trim('".$blocke."') and trim(poligono)=trim('".$poligono."') and trim(casa)=trim('".$casa."')";   
 		 	  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )>=2)
			    {
			     $rown=mysql_fetch_array($resultadon);
                             $pasa=1;
			    }
			   }

			   if($pasa==1)
			   {

			        echo '
					<tr>
						<td class="FilaNI" style="height: 22px;font-size:12px; text-align: center">'.$cliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: left">'.$ncliente.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$canton.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$barrio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$caserio.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$calle.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$avenida.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$pasaje.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$poligono.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$blocke.'</td>
						<td class="FilaN" style="height: 22px; font-size:12px; text-align: center">'.$casa.'</td>
						<td class="FilaNF" style="height: 22px;font-size:12px; text-align:center">'.$cobrador.'</td>
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
				<td class="FilaNI2" style="height: 22px; font-size:14px;width:50px"><strong>Codigo</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Nombre</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Canton</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Barrio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Caserio</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Calle</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Avenida</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Pasaje</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Poligono</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>Block</strong></td>
				<td class="FilaN2" style="height: 22px; font-size:14px"><strong>No.casa</strong></td>
				<td class="FilaNF2" style="height: 22px; font-size:14px;text-align: center;padding-right:0px;"><strong>Cobrador</strong></td>
				 </tr>';	
        	                 $cuentafila=1;
	                        }
			   }

			}  //fin del while
			$sumatotalgen=number_format($sumalineas, 2, ".", ",");
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
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaN2" style="height: 22px; font-size:12px; text-align: center"></td>
			<td class="FilaNF2" style="height: 22px;font-size:12px; text-align: center"></td>
			</tr>';	
			echo'
		</table>
	</div>
</body>
</html>';
}



?>