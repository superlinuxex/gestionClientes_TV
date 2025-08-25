<?php
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_hojaiden($_GET['id']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $fecha1=$row['fecha'];
    $em1=$row['cod_respon'];
    $em2=$row['cod_tecnico'];
    $xbodegasali=$row['sucursal'];
    $fecha=substr($fecha1,8,2)."-".substr($fecha1,5,2)."-".substr($fecha1,0,4);
    $envio=$row['cod_crf'];
    $bodegadesti=$row['codigo_bodega_destino'];
    $bodega=$row['sucursal'];
    $observa=$row['observaciones'];
    $respon=$row['nombrerespon'];
    $requi=$row['requisicion'];
    $codsalida=$row['codigo_salida'];
    mysql_data_seek($resultado, 0); 
    $alturaLinea=10;
    $alturaTabla=15;

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
    text-align: left;
    border-left: 1pt solid black;
    border-bottom: 1pt solid black;
}
.FilaN {
    font-weight: normal;
    color: black;
    text-align: left;
    border-bottom: 1pt solid black;
    border-left: 1pt solid black;
}
.FilaU {
    font-weight: normal;
    color: black;
    text-align: left;
    border-left: 1pt solid black;
    border-bottom: 1pt solid black;
    border-right: 1pt solid black;

}

.FilaNF {
    font-weight: normal;
    color: black;
    text-align: left;
    border-left: 1pt solid black;
    border-right: 1pt solid black;
    border-bottom: 1pt solid black;
    padding-right:10px;
}
</style>

<style>
H1.saltodepagina
{
PAGE-BREAK-AFTER:always
}
</style>



<title>SICCAE- HOJA DE TRANSFERENCIA DE MATERIALES A SUCURSAL</title>
</head>
<body>
<table cellspacing="0" class="Tabla1" style="position:absolute;left:5px;top:1px'.$alturaTabla.'px;border:1px simple ;width:1100px;page-break-after:always">
 <tr>
 </tr>';    

 $cuentavales=1;
 $xautoriza="";
 $cuentalin=10;
 $cuentalin2=10;
 $cvppag=0;

  $sentencian = "select nombre FROM bodegas where idbodegas='".$bodegadesti."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnbodega=$rown['nombre'];
    }
   }



  $bodeorigen="";
  $sentencian = "select nombre FROM bodegas where idbodegas='".$xbodegasali."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $bodeorigen=$rown['nombre'];
    }
   }

 $emplee="";
if($em1!="")
 {
 $sentencia = "select nombre FROM empleados where cod_emple=".$em1.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row2=mysql_fetch_array($resultado);
  $emplee=$row2['nombre'];
  }
 }
 }

$empler="";
if($em2!="")
 {
 $sentencia = "select nombre FROM empleados where cod_emple=".$em2.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
  {
   if(mysql_num_rows ( $resultado )!=0)
   {
    $row3=mysql_fetch_array($resultado);
    $empler=$row3['nombre'];
   }
  }
 }

    echo '
    <tr>
    <td style="position:absolute;left:300px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:30px">HOJA DE TRANSFERENCIA O ENVIO A SUCURSAL</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:200px;height:45px;font-size:25px">Fecha:'.$fecha.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Numero de transferencia:'.$envio.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Bodega que despacha:'.$bodeorigen.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Bodega que recibe:'.$xnbodega.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Observaciones:'.$observa.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Requisicion No.:'.$requi.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;

	 echo '
    	<tr>
    	<td  style="position:absolute;left:5px;top:'.$cuentalin.'px;width:205px;height:45px;font-size:25px">ITEM</td>
    	<td  style="position:absolute;left:110px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">CODIGO</td>
    	<td style="position:absolute;left:310px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">DESCRIPCION</td>
    	<td  style="position:absolute;left:710px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">CANTIDAD</td>
    	<td  style="position:absolute;left:900px;top:'.$cuentalin.'px;width:120px;height:45px;font-size:25px">U.MEDIDA</td>
    	</tr>';
    	$cuentalin=$cuentalin+47;
    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;


 //Buscando el detalle de la transferencia
 $sentencia = "select codigo_detalle,idarticulos,cantidad,unidadmed FROM salidas_deta where codigo_salida='".$codsalida."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ( $fila = mysql_fetch_array($resultadow))
       {
      	$item=$fila['codigo_detalle'];
        $cod=$fila['idarticulos'];
        $canti=$fila['cantidad'];
        $medida=$fila['unidadmed'];

   	$sentencia4 = "select descripcion FROM articulos where idarticulos='".$cod."'"; 
   	$resultado4 = mysql_query($sentencia4);
   	if(isset($resultado4))
         {
          if(mysql_num_rows ( $resultado4 )!=0)
           {
            $row4=mysql_fetch_array($resultado4);
            $xnombrear=$row4['descripcion'];
           }
         }

	 echo '
    	<tr>
    	<td  style="position:absolute;left:5px;top:'.$cuentalin.'px;width:205px;height:45px;font-size:25px">'.$item.'</td>
    	<td  style="position:absolute;left:110px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">'.$cod.'</td>
    	<td style="position:absolute;left:310px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">'.$xnombrear.'</td>
    	<td  style="position:absolute;left:710px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">'.$canti.'</td>
    	<td style="position:absolute;left:900px;top:'.$cuentalin.'px;width:120px;height:45px;font-size:25px">'.$medida.'</td>
    	</tr>';
    	$cuentalin=$cuentalin+47;
       }
     }

  }

    $cuentalin=$cuentalin+80;
    echo '
    <tr>
    <td style="position:absolute;left:40px;top:'.$cuentalin.'px;width:500px;height:45px;font-size:25px">Entrega:'.$emplee.'</td>
    <td style="position:absolute;left:600px;top:'.$cuentalin.'px;width:500px;height:45px;font-size:25px">Recibe:'.$empler.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

  echo'
  </table>

</body>
</html>';
?>