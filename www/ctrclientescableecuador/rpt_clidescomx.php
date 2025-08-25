<?php

  require_once("./logica/log_reportes.php");
  $resultado=log_obtener_clientes_descom($_GET['fd'],$_GET['fh'],$_GET['ti'],$_GET['bod']);

  $cod_bodega=4;

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
				<td class="FilaN" style="height: 22px;font-size:15px"><strong>Pendiente desde el periodo</strong></td>
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
					<td class="FilaN2" style="height: 22px;font-size:15px"><strong>Pendiente desde el periodo</strong></td>
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

?>