<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_mov_sema($_GET['fd'],$_GET['fh'],$_GET['proy'],$_GET['bod']);
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


	$cod_bodega=$row['idbodega'];
	mysql_data_seek($resultado, 0); 
	$alturaLinea=145;
	$alturaTabla=155;

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
<title>S I C I O - Reporte de Movimientos en un periodo </title>
</head>
<body>
	<div style="position:absolute;left:10%;top:15px;border:1px solid black;width:1100px;height:95%;">
		<div style="position:absolute;left:10px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></div>
		
		<div style="position:absolute;left:40px;top:55px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de movimientos en un periodo</strong></span>
		</div>
			
		<div style="position:absolute;left:690px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>


		<div style="position:absolute;left:50px;top:90px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:14px;"><strong>Desde el:'.$fechai.'  Hasta el:'.$fechaf.'</strong></span>
		</div>

		<div style="position:absolute;left:50px;top:110px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Bodega: </strong>'.$_GET['bod'].'</span>
		</div>


		<hr style="margin:0;padding:0;position:absolute;left:10px;top:'.$alturaLinea.'px;width:990px;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:'.$alturaTabla.'px;width:990px;">
			<tr>
				<td class="FilaNI" style="height: 22px"><strong>Codigo Articulo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Articulo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Unidad</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Existencia Anterior</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Entrada</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Salida</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Saldo</strong></td>
			</tr>';	
			while ( $fila = mysql_fetch_array($resultado))
			{
        		 $fe1=$row['fechapigo'];
			 $umedi="";
                         $xarti=$fila['idarticulo'];
                         $sentencia="select unidadmed from articulos where idarticulos='".$xarti."'"; 
                         $resultadob = mysql_query($sentencia);
	                 if(isset($resultadob))
    	                  {
		           if(mysql_num_rows ( $resultadob )!=0)
		           {
  		            $filaxyz=mysql_fetch_array($resultadob);
			    $umedi=$filaxyz['unidadmed'];
                           }
                          }

           		 $yentran=$fila['entradas'];
        		 $ysalen=$fila['salidas'];

                         $xsaldo=0;
                         $diferencia=0;
			 $kentran=0;
			 $xarti=$fila['idarticulo'];
                         $sentencia="select sum(entradas) AS xentran from movimientos where idbodega='".$cod_bodega."' and idarticulo='".$xarti."' and fecha<str_to_date('$fe1','%Y-%m-%d')"; 
                         $resultado2 = mysql_query($sentencia);
	                 if(isset($resultado2))
    	                  {
		           if(mysql_num_rows ( $resultado2 )!=0)
		           {
  		            $filax=mysql_fetch_array($resultado2);
			    $kentran=$filax['xentran'];
                           }
                          }
                         
			 $ksalen=0;
			 $xarti=$fila['idarticulo'];
                         $sentencia="select sum(salidas) AS xsalen  from movimientos where idbodega='".$cod_bodega."' and idarticulo='".$xarti."' and fecha<str_to_date('$fe1','%Y-%m-%d')"; 
                         $resultado3 = mysql_query($sentencia);
	                 if(isset($resultado3))
    	                  {
		           if(mysql_num_rows ( $resultado3 )!=0)
		           {
  		            $filax=mysql_fetch_array($resultado3);
			    $ksalen=$filax['xsalen'];
                           }
                          }
                          $diferencia=$kentran-$ksalen;
                          $xsaldo=($diferencia+$yentran)-$ysalen;
                          $fila['existencia_origen']=$diferencia;
                          $fila['saldo']=$xsaldo;
                       
			  $variable1=$fila['existencia_origen'];
                          $variablex1=number_format($variable1, 2, ".", ",");

			  $variable2=$fila['entradas'];
                          $variablex2=number_format($variable2, 2, ".", ",");
                       
			  $variable3=$fila['salidas'];
                          $variablex3=number_format($variable3, 2, ".", ",");

			  $variable4=$xsaldo;
                          $variablex4=number_format($variable4, 2, ".", ",");


				echo '
					<tr>
						<td class="FilaNI" style="height: 22px; text-align: left">'.$fila['idarticulo'].'</td>
						<td class="FilaN" style="height: 22px; text-align: left">'.$fila['nombrear'].'</td>
						<td class="FilaN" style="height: 22px">'.$umedi.'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$variablex1.'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$variablex2.'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$variablex3.'</td>
						<td class="FilaNF" style="height: 22px; text-align: right">'.$variablex4.'</td>
					</tr>';			
			}
			 echo'
		</table>
	</div>
</body>
</html>';
?>