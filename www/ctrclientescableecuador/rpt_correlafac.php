<?php
error_reporting (5);

 include "./utils/validar_sesion.php";

$f1="";
$f2="";
$bod=$_SESSION["idBodega"];
//Buscando los rangos de facturas en base a las fechas,sucursal y tipo de facturas dadas

	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_rangosdefacturas($_GET['fd'],$_GET['fh'],$_GET['bod'],$_GET['ti']);

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
	$fx0x=$_GET['fd'];
	$fx1x=$_GET['fh'];
        $tipof=$_GET['ti'];


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
<title>SICCAE - Reporte de comparacion de correlativos de facturas ingresadas al sistema</title>
</head>
<body>
	<div style="position:absolute;top:15px;left:200px;border:1px no-solid;width:60%;height:98%;">
	
		<div style="position:absolute;left:80px;top:50px;width:800px;height:37px;text-align:left;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>CONTROL DE CORRELATIVOS</strong></span>
		</div>
		<div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
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
				<td class="FilaNI" style="height: 22px;width:50px"><strong>Correlativo</strong></td>
				<td class="FilaN" style="height: 22px;width:50px"><strong>Factura ingresada</strong></td>
				<td class="FilaNF" style="height: 22px;width:50px;text-align: center;padding-right:0px;"><strong>Fecha factura</strong></td>
			</tr>';	

                //Leer el vector de los talonarios declarados para tomar los rangos de numeros de facturas
                $fechacompa="2014/01/01";
		while ( $fila = mysql_fetch_array($resultado))
 		 {
			$fx0=$fila['facini'];
			$fx1=$fila['facfin'];

                        $cuentafila=1;
                        $sumatotal=0;
			while ($fx1>=$fx0) 
			{
                          $xnumero="Falta";
                          $xfecha="";
                          if($tipof==1)
                          {
			   $sentencia2 = "select numero,fechafac FROM facturas where numero='".$fx0."' and sucursal='".$cod_bodega."' and tipofac=1 and fechafac>'2014/01/01'"; 
			   $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			   if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $xnumero=$row['numero'];
                              $xfecha=$row['fechafac'];
                             }
                           }
                          }

                          if($tipof==2)
                          {
			   $sentencia2 = "select numero,fechafac FROM facturas where numero='".$fx0."' and sucursal='".$cod_bodega."' and tipofac=2 and fechafac>'2014/01/01'"; 
			   $resultado2 = mysql_query($sentencia2) OR die(mysql_error());
 			   if(isset($resultado2))
   			   {
    			    if(mysql_num_rows ( $resultado2 )!=0)
                             {
                              $row=mysql_fetch_array($resultado2);
                              $xnumero=$row['numero'];
                              $xfecha=$row['fechafac'];
                             }
                           }
                          }

                           $xxfecha=substr($xfecha,8,2)."-".substr($xfecha,5,2)."-".substr($xfecha,0,4);

			     echo '
    			    <tr>
   			    <td class="FilaNI" style="height: 22px; width:50px; font-size:10px; text-align: center">'.$fx0.'</td>
			    <td class="FilaN" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$xnumero.'</td>
			    <td class="FilaNF" style="height: 22px; width:50px;font-size:10px; text-align: center">'.$xxfecha.'</td>
			    </tr>';


	                   $fx0+=1;

                       	   $cuentafila+=1;
                          	
			}  //fin del while

		}  //fin del while en el vector de talonarios declarados
			echo'
		</table>
	</div>
</body>
</html>';

?>