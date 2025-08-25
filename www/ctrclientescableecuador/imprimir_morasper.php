<?php
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_datosclie($_GET['id'],$_GET['bod']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $xnombre=$row['nombre'];
    $xapellido=$row['apellido'];
    $xsucursal=$row['sucursal'];
    $xcliente=$row['cod_cliente'];
    $fechahoy=date('d/m/Y');
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



<title>SICCAE- CLIENTES CON MORA PERDONADA</title>
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

  $sentencian = "select nombre FROM bodegas where idbodegas='".$xsucursal."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnbodega=$rown['nombre'];
    }
   }


    echo '
    <tr>
    <td style="position:absolute;left:300px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:30px">MORAS PERDONADAS A UN CLIENTE</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Codigo de cliente:&nbsp'.$xcliente.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;


    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Nombre:&nbsp'.$xnombre.'&nbsp'.$xapellido.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Fecha:&nbsp'.$fechahoy.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:600px;height:45px;font-size:25px">Sucursal:&nbsp'.$xnbodega.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;


    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;

	 echo '
    	<tr>
    	<td  style="position:absolute;left:5px;top:'.$cuentalin.'px;width:205px;height:45px;font-size:25px">FECHA</td>
    	<td  style="position:absolute;left:350px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">CONCEPTO</td>
    	<td style="position:absolute;left:840px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">MONTO</td>
    	</tr>';
    	$cuentalin=$cuentalin+47;
    echo '
    <tr>
    <td style="position:absolute;left:2px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________________________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;


 //Creando la lista de moras perdonadas
 $sentencia = "select fecha,motivo,valmora FROM moracero where cod_cliente='".$xcliente."' and sucursal='".$xsucursal."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ( $fila = mysql_fetch_array($resultadow))
       {
      	$fecha=$fila['fecha'];
        $motivo=$fila['motivo'];
        $valmora=$fila['valmora'];
        echo '
    	<tr>
    	<td  style="position:absolute;left:5px;top:'.$cuentalin.'px;width:205px;height:45px;font-size:25px">'.$fecha.'</td>
    	<td  style="position:absolute;left:150px;top:'.$cuentalin.'px;width:510px;height:45px;font-size:25px">'.$motivo.'</td>
    	<td style="position:absolute;left:840px;top:'.$cuentalin.'px;width:160px;height:45px;font-size:25px">'.$valmora.'</td>
    	</tr>';
    	$cuentalin=$cuentalin+47;
       }
     }

  }

    $cuentalin=$cuentalin+40;

  echo'
  </table>

</body>
</html>';
?>