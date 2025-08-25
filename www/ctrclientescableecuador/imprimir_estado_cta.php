<?php
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_datosclie($_GET['id'],$_GET['bod']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $xnombre=$row['nombre'];
    $xapellido=$row['apellido'];
    $xsucursal=$row['sucursal'];
    $xcliente=$row['cod_cliente'];
    $diapago=$row['fechap'];
    $feul1=$row['ulfepago1'];
    $feul2=$row['ulfepago2'];
    $feul=$row['fechaul'];
    $fechahoy=date('d/m/Y');
    $xdepto=$row['cod_depto'];
    $xmuni=$row['cod_ciudad'];
    $xcanton=$row['cod_canton'];
    $xbarrio=$row['cod_barrio'];
    $xcaserio=$row['cod_caserio'];
    $xcalle=$row['calle'];
    $xave=$row['ave'];
    $xpasaje=$row['pasaje'];
    $xpoligono=$row['poligono'];
    $xblocke=$row['blocke'];
    $xcasa=$row['casa'];
    $xxestado=$row['estatus'];
    $xvalorplan=$row['valorplan'];

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

if($xxestado=="1")
{

//buscando nombre de sucursal
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


$direccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa;


    echo '
    <tr>
    <td style="position:absolute;left:300px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:30px">ESTADO DE CUENTA DEL CLIENTE</td>
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
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:850px;height:45px;font-size:25px">Direccion:&nbsp'.$direccion.'</td>
    </tr>';
    $cuentalin=$cuentalin+80;


//Buscando dias y monto pendiente de pago
$fechalimite=date('Y-m-d');
$xdebemeses=0;
$montodebe=0;


//Evalua si el dia de pago pactado por el cliente es menor que el dia de hoy y si el ultimo mes pagado por el cliente es igual al mes de hoy
if($diapago>=intval(substr($fechalimite,9,2)) and intval(substr($feul2,5,2))==intval(substr($fechalimite,5,2)))
{
 $restar=1;
}
else
{
 $restar=0;
}

 //Buscando datos en la tabla de periodos programados de pagos mensuales
 $sentencia = "select * FROM periodos where sucursal='".$xsucursal."' and cod_cliente='".$xcliente."'"; 
 $resultadox = mysql_query($sentencia);
 if(isset($resultadox))
  {
    if(mysql_num_rows ( $resultadox )!=0)
     {
      $rowxx=mysql_fetch_array($resultadox);
      $fx1=$rowxx['fechafin'];
     }
   }

//Contando cuantos periodos debe el cliente a partir del ultimo pagado
 $xdebe=0;
 $sentencia = "select * FROM periodos where sucursal='".$xsucursal."' and cod_cliente='".$xcliente."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ($fila = mysql_fetch_array($resultadow))
       {
        if($fila['fechafin']>=$fx1)
         {
          $fx1=$fila['fechafin'];
          $fx0=$fila['fechaini'];
          $pp=$fila['pagado'];
         }
       }
       if((intval(substr($fx0,5,2))<intval(substr($fx1,5,2))) or (intval(substr($fx0,5,2))==12 and intval(substr($fx1,5,2))==1))
       {
        if($fechalimite>=$fx1)
         {
          if($pp="1")
           {
            $xdebe=0;
           }
	    else
           {
            $xdebe=1;
           }

           while($fechalimite>=$fx1)
           {
	    $xdia=intval(substr($fx1,9,2));
            $xanio=intval(substr($fx1,0,4));
            $xmesante=intval(substr($fx1,5,2));
            if(intval(substr($fx1,5,2))<12)
             {
              $nif1=intval(substr($fx1,5,2))+1;
             }
              else
             {
              $nif1=1;
              $xanio=intval(substr($fx1,0,4))+1;
             }
             $xmes=$nif1;
             if($xdia==31)
             {
              $xdia="30";
             }
             if($xmes==2 and $xdia>28)
             {
              $xdia="28";
             }
             $nuevaf= strtotime($xanio."-".$xmes."-".$xdia);
             $fx1=date('Y-m-d',$nuevaf);
             if($fechalimite>=$fx1)
             {
              $xdebe=$xdebe+1;
             }
           }
         }
         //actualice en tabla de clientes DEBEMESES
         if($restar==1)
             {
              if($xdebe>0)
               {
                $xdebe=$xdebe-1;
		$sentencia2="update clientes set debemeses='".$xdebe."' where sucursal='".$xsucursal."' and cod_cliente='".$xcliente."'";
		$resultado2 = mysql_query($sentencia2);
               }
             }
             else
               {
		$sentencia2="update clientes set debemeses='".$xdebe."' where sucursal='".$xsucursal."' and cod_cliente='".$xcliente."'";
		$resultado2 = mysql_query($sentencia2);
               }
        }
     }
  }
//Fin de contar cuantos periodos hasta la fecha tiene pendientes el cliente
 
 $sentencia = "select debemeses FROM clientes where sucursal='".$xsucursal."' and cod_cliente='".$xcliente."'"; 
 $resultadox = mysql_query($sentencia);
 if(isset($resultadox))
  {
    if(mysql_num_rows ( $resultadox )!=0)
     {
      $rowxx=mysql_fetch_array($resultadox);
      $xdebemeses=$rowxx['debemeses'];
     }
   }

   $montodebe=$xvalorplan*$xdebemeses;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:850px;height:45px;font-size:25px">Meses en mora:&nbsp'.$xdebemeses.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:10px;top:'.$cuentalin.'px;width:850px;height:45px;font-size:25px">Monto en mora:&nbsp'.$montodebe.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;


}
else
{
    echo '
    <tr>
    <td style="position:absolute;left:300px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:30px">CLIENTE DESCONECTADO</td>
    </tr>';
    $cuentalin=$cuentalin+40;

    echo '
    <tr>
    <td style="position:absolute;left:300px;top:'.$cuentalin.'px;width:800px;height:45px;font-size:30px">ESTADO DE CUENTA CERRADO</td>
    </tr>';
    $cuentalin=$cuentalin+40;

}
  echo'
  </table>

</body>
</html>';
?>