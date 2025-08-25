<?php
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_hojaiden($_GET['id']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $fecha1=$row['fecha'];
    $em1=$row['cod_respon'];
    $em2=$row['cod_tecnico'];
    $em3=$row['emple_recibotran'];
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



<title>SICCAE - Hoja de transferencia a sucursal</title>
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
 $sentenciax = "select nombre,apellido FROM empleados where cod_emple='".$em1."'"; 
 $resultadox = mysql_query($sentenciax);
 if(isset($resultadox))
 {
 if(mysql_num_rows ( $resultadox )!=0)
 {
  $row2=mysql_fetch_array($resultadox);
  $emplee=$row2['nombre']." ".$row2['apellido'];
  }
 }
 }

$empler="";
if($em2!="")
 {
 $sentenciay1 = "select nombre,apellido FROM empleados where cod_emple='".$em2."'"; 
 $resultadoy1 = mysql_query($sentenciay1);
 if(isset($resultadoy1))
  {
   if(mysql_num_rows ($resultadoy1)!=0)
   {
    $row3=mysql_fetch_array($resultadoy1);
    $empler=$row3['nombre']." ".$row3['apellido'];
   }
  }
 }


$emplesuc="";
if($em3!="")
 {
 $sentenciaz = "select nombre,apellido FROM empleados where cod_emple='".$em3."'"; 
 $resultadoz = mysql_query($sentenciaz);
 if(isset($resultadoz))
  {
   if(mysql_num_rows ( $resultadoz )!=0)
   {
    $row4=mysql_fetch_array($resultadoz);
    $emplesuc=$row4['nombre']." ".$row4['apellido'];
   }
  }
 }



    echo '
    <tr>
    <td style="position:absolute;left:250px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:20px">HOJA DE TRANSFERENCIA O ENVIO A SUCURSAL</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:200px;height:45px;font-size:20px">Fecha:'.$fecha.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Numero de transferencia:'.$envio.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Bodega que despacha:'.$bodeorigen.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Bodega que recibe:'.$xnbodega.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Observaciones:'.$observa.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Requisicion No.:'.$requi.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Despacha:'.$emplee.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Traslada:'.$empler.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:20px">Recibe:'.$emplesuc.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;

    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;

	 echo '
    	<tr>
    	<td  style="position:absolute;left:2px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">ITEM</td>
    	<td  style="position:absolute;left:50px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">CODIGO</td>
    	<td  style="position:absolute;left:160px;top:'.$cuentalin.'px;width;400px;height:45px;font-size:15px">DESCRIPCION</td>
    	<td  style="position:absolute;left:675px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">CANT.ENVIADO</td>
    	<td  style="position:absolute;left:800px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">CANT.RECIBIDO</td>
    	<td  style="position:absolute;left:925px;top:'.$cuentalin.'px;width:75px;height:45px;font-size:15px">U.MEDIDA</td>
    	</tr>';
    	$cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;


 //Creando el detalle de la transferencia
 $sentencia = "select codigo_detalle,idarticulos,cantidad,unidadmed,cant_recibesucu FROM salidas_deta where codigo_salida='".$codsalida."'"; 
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
        $canti2=$fila['cant_recibesucu'];
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
    	<td  style="position:absolute;left:2px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">'.$item.'</td>
    	<td  style="position:absolute;left:50px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">'.$cod.'</td>
    	<td style="position:absolute;left:160px;top:'.$cuentalin.'px;width:400px;height:45px;font-size:15px">'.$xnombrear.'</td>
    	<td  style="position:absolute;left:725px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">'.$canti.'</td>
    	<td  style="position:absolute;left:850px;top:'.$cuentalin.'px;width:100px;height:45px;font-size:15px">'.$canti2.'</td>
    	<td style="position:absolute;left:925px;top:'.$cuentalin.'px;width:75px;height:45px;font-size:15px">'.$medida.'</td>
    	</tr>';
    	$cuentalin=$cuentalin+47;
       }
     }

  }

    $cuentalin=$cuentalin+80;

  echo'
  </table>

</body>
</html>';
?>