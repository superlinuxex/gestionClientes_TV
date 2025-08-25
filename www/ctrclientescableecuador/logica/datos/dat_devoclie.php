<?php
require "dat_base.php";  

function dat_obtener_devoclie($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select movimiento Correlativo, cod_cliente 'Cod.cliente',fecha 'Fecha', factura 'Factura', concepto 'Concepto', monto 'Monto'
          FROM devoclie where sucursal='".$bodega."' order by fecha LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_listamateriales($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.numero Factura, a.fechafac Fecha,a.concepto Concepto, a.cantidad Cantidad, precio Precio, total Total 
          FROM detafac a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_devoclie_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select movimiento Correlativo, cod_cliente 'Cod.cliente',fecha 'Fecha', factura 'Factura', concepto 'Concepto', monto 'Monto'
          FROM devoclie where sucursal='".$bodega."' and
		  (factura like '%".$filtro."%')
          order by movimiento LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_devoclie_filtro2($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
$filtro1=substr($filtro,0,2)."-".substr($filtro,3,2)."-".substr($filtro,6,4);

    $sentencia="select movimiento Correlativo, cod_cliente 'Cod.cliente',fecha 'Fecha', factura 'Factura', concepto 'Concepto', monto 'Monto'
          FROM devoclie where sucursal='".$bodega."' and fecha=str_to_date('$filtro1','%d-%m-%Y')
                    order by fecha LIMIT $comienzo, $cant";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_devoclie2($id,$bodega)
{
global $parametros , $conexion ;

    $sentencia = "select cod_cliente Codigo, fecha Fecha,fechafac Fechafac, tipofac Tipofac, monto Monto, cod_emple Empleado, factura Factura,codconcep Codconcep
          FROM devoclie where sucursal='".$bodega."' and movimiento='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_devoclie($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM devoclie where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_listamateriales($clie,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM cambiopl where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_num_devoclie_filtro($bodega,$filtro)
{
global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM devoclie where sucursal='".$bodega."' and (factura like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}
function dat_obtener_num_devoclie_filtro2($bodega,$filtro)
{
global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM devoclie where sucursal='".$bodega."' and (fecha like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_insertar_devoclie($datos,$bode,$usuario)
{
global $parametros , $conexion ;

//obteniendo un correlativo para codigo correlativo
$nummovi=0;
$codigomov="DEVOCLIE";
$sentencia="select numero id FROM correla2 where agencia='".$bode."' and codigo='".$codigomov."'";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id']+1;
    }
	else
    {
	$nummovi=1;
    }

$a="DEVOCLIE";
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

//Buscando concepto
$nconcepto="";
$templeado=$datos['Codconcep'];
$sentencia = "select nombre from tipodev where codigo='".$templeado."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $nconcepto=$filaz['nombre'];
  }


$fecha1=$datos['Fecha'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha1=$datos['Fechafac'];
$fechafac=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$usuario=$_SESSION["idusuarios"];

    $sentencia = "insert into devoclie (movimiento,fecha,cod_cliente,codconcep,monto,factura,fechafac,tipofac,concepto,cod_emple,idusuarios,sucursal,fechareg)  
					VALUES ('".$nummovi."','".$fecha."','".$datos['Cliente']."','".$datos['Codconcep']."','".$datos['Monto']."','".$datos['Factura']."','".$fechafac."','".$datos['Tipofac']."','".$nconcepto."','".$datos['Empleado']."','".$usuario."','".$bode."',now())";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_eliminar_devoclie($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "delete from  devoclie where sucursal='".$bodega."' and movimiento='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_actualizar_devoclie($datos, $id,$bodega)
{
global $parametros , $conexion ;

//Buscando concepto
$nconcepto="";
$templeado=$datos['Codconcep'];
$sentencia = "select nombre from tipodev where codigo='".$templeado."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $nconcepto=$filaz['nombre'];
  }

$fecha1=$datos['Fechafac'];
$fechafac=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$sentencia = "update devoclie SET factura='".$datos['Factura']."',tipofac='".$datos['Tipofac']."',monto='".$datos['Monto']."',codconcep='".$datos['Codconcep']."',cod_emple='".$datos['Empleado']."',fechafac='".$fechafac."',concepto='".$nconcepto."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
$resultado = mysql_query($sentencia);
echo mysql_error($conexion);



if(intval(substr($fecha1,6,4))>2000)
{
        $sentencia = "update devoclie SET fechafac='".$fechafac."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
}

	return $resultado;
	exit;
}

function dat_reprogramar_devoclie($datos, $id,$bodega)
{
global $parametros , $conexion ;

$resultado=0;

$fecha1=$datos['Fecharepro'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

if(intval(substr($fecha1,6,4))>2012)
{
 $sentencia = "update activi SET fecharepro='".$fecha."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
 $resultado = mysql_query($sentencia);
 echo mysql_error($conexion);
}
 return $resultado;
 exit;
}


function dat_ejecutar_devoclie($datos, $id,$bodega)
{
global $parametros , $conexion ;

$resultado=0;
//buscando el valor de la cuota que paga el cliente para calcularle el monto de mora si es actividad de desconexion
$xpaga=1;
$sentencia = "select valorplan from clientes WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $fila5=mysql_fetch_array($resultado);
    $xpaga=$fila5['valorplan'];
  }



$fecha1=$datos['Fechaeje'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

//Buscando tipo de servicio para ver si es conexion o desconexion
$ntiposervi="";
$sentencia = "select codservi from activi WHERE sucursal='".$bodega."' and movimiento= '$id';";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ntiposervi=$filaz['codservi'];
  }

$servicone="";
$sentencia = "select conectacl from servicios WHERE codservi='".$ntiposervi."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $servicone=$filaz['conectacl'];
  }

//si SERVICONE es 1, estamos hablando de una conexion o reconexion de servicio, si SERVICONE es un 0, estamos hablando de una desconexion.

if(intval(substr($fecha1,6,4))>2012)
{
 $sentencia = "update activi SET fechareali='".$fecha."',observa='".$datos['Observa']."',tecnireali='".$datos['Tecnicor']."',cone='".$datos['Mcone']."',poste='".$datos['Mposte']."',longilati='".$datos['Mlongilati']."',marcha='".$datos['Mmarcha']."',georeferencia='".$datos['Mgeo']."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
 $resultado = mysql_query($sentencia);
 echo mysql_error($conexion);
 
 //actualizando lo datos del cliente que recibe el servicio
 if($datos['Mcone']!=0)
  {
   $sentencia2 = "update clientes SET cone='".$datos['Mcone']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }
 
 if($datos['Mposte']!="")
  {
   $sentencia2 = "update clientes SET poste='".$datos['Mposte']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }

 if($datos['Mlongilati']!="")
  {
   $sentencia2 = "update clientes SET longilati='".$datos['Mlongilati']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }

 if($datos['Mmarcha']!="")
  {
   $sentencia2 = "update clientes SET marcha='".$datos['Mmarcha']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }

 if($datos['Mgeo']!="")
  {
   $sentencia2 = "update clientes SET georeferencia='".$datos['Mgeo']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }


 //actualizando datos SI ES ACTIVIDAD DE CONEXION DE SERVICIO
 if($servicone=="1")   
  {
   $estatus="1";
   $sentencia2 = "update clientes SET fechaip='".$fecha."',estatus='".$estatus."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
   //iniciando el registro de periodos
   $xfechaini=$fecha;
   $b1=intval(substr($fecha1,0,2));
   $b2=intval(substr($fecha1,3,2));
   $b3=intval(substr($fecha1,6,4));
   $c1=$b1;
   $c2=$b2;
   $c3=$b3;
   if($b2==12)
    {
     $c2=1;
     $c3=$b3+1;
    }
    else
    {
     $c2=$b2+1;
    }
    $xmespagar=$b2;
    if($c1==31)
     {
      $c1=$c1-1;
     }
    if($c2==2 and $c1>28)
     {
      $c1=28;
     }

    $xfechafin=strval($c3)."-".strval($c2)."-".strval($c1);
    if($xmespagar==1)
     {
      $xmesnpagar="ENERO";
     }
    if($xmespagar==2)
     {
      $xmesnpagar="FEBRERO";
     }
    if($xmespagar==3)
     {
      $xmesnpagar="MARZO";
     }
    if($xmespagar==4)
     {
      $xmesnpagar="ABRIL";
     }
    if($xmespagar==5)
     {
      $xmesnpagar="MAYO";
     }
    if($xmespagar==6)
     {
      $xmesnpagar="JUNIO";
     }
    if($xmespagar==7)
     {
      $xmesnpagar="JULIO";
     }
    if($xmespagar==8)
     {
      $xmesnpagar="AGOSTO";
     }
    if($xmespagar==9)
     {
      $xmesnpagar="SEPTIEMBRE";
     }
    if($xmespagar==10)
     {
      $xmesnpagar="OCTUBRE";
     }
    if($xmespagar==11)
     {
      $xmesnpagar="NOVIEMBRE";
     }
    if($xmespagar==12)
     {
      $xmesnpagar="DICIEMBRE";
     }

    //Borramos todo historial del cliente por ser nueva conexion, nueva fecha inicial de servicio
    $sentencia = "delete from periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'; ";
    $resultadop = mysql_query($sentencia);

    $xpagado="0";
    //Creamos el nuevo periodo de arranque de los periodos del cliente
    $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,idusuarios,sucursal,fechareg,pagado)  
					VALUES ('".$datos['Codigo']."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$usuario."','".$bodega."',now(),'".$xpagado."')";
    $resultadoQ = mysql_query($sentencia);
    
    //Actualizamos el registro del cliente 
   $sentencia2 = "update clientes SET ulfepago1='".$fecha."',ulfepago2='".$xfechafin."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
   $resultadot = mysql_query($sentencia2);
  }




 //actualizando datos SI ES ACTIVIDAD DE DESCONEXION DE SERVICIO
if($servicone=="0")   
 {
  $estatus="0";
  $sentencia2 = "update clientes SET estatus='".$estatus."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
  $resultado2 = mysql_query($sentencia2);
    
//Buscando dias y monto pendiente de pago
$fecha1=$datos['Fechaeje'];
$fecha2=strtotime(substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2));
$fechalimite=date('Y-m-d',$fecha2);
$xdebemeses=0;
$montodebe=0;


$fecha1=date('d-m-Y');
$fecha2=strtotime(substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2));
$fx1=date('Y-m-d',$fecha2);

 //Buscando datos en la tabla de periodos programados de pagos mensuales
 $sentencia = "select * FROM periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'"; 
 $resultadox = mysql_query($sentencia);
 if(isset($resultadox))
  {
    if(mysql_num_rows ( $resultadox )!=0)
     {
      $rowxx=mysql_fetch_array($resultadox);
      $fx1=$rowxx['fechafin'];
     }
   }


//Contando cuantos periodos debe el cliente a partir del ultimo pagado a la fecha de desconexion
 $xdebe=0;
 $sentencia = "select * FROM periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'"; 
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
	    $hulfe=$fx1;
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
 	      $hulfe=$fx1;
             }
           }
           if($xdebe>=1)
            {
             //Calculando mora en dias
             $xpagadia=$xpaga/30;
             $fracdias=$fechalimite-$hulfe;
             $moraendias=$fracdias*$xpagadia;
            }

         }
         //actualice en tabla de clientes 
         $morahoy=($xdebe*$xpaga)+$moraendias;
	 $sentencia2="update clientes set morahoy='".$morahoy."',fedesco='".$fechalimite."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'";
	 $resultado2 = mysql_query($sentencia2);
       }
     }
  }
//Fin de actualizar la mora a la fecha de desconexion

  }


}
 return $resultado;
 exit;
}



function dat_obtener_devoclie_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select movimiento 'Ticket',nomclie 'Nombre' FROM activi where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_devoclie_cmbZZZ()
{
	global $parametros , $conexion ;
	$sentencia = "select movimiento 'Ticket',nomclie 'Nombre' FROM activi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_vecodservi_devoclie($codigoservi)
{
	global $parametros , $conexion ;
	$servicone="";
	$sentencia = "select conectacl FROM servicios where codservi='".$codigoservi."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $servicone=$filaz['conectacl'];
	  }
        if($servicone=="1")
         {
          $resultadow=1;
         }
		else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}

function dat_validaconexion_devoclie($tconexion,$cliente,$bodx)
{
	global $parametros , $conexion ;
 	$xestatus="";
	$sentencia = "select estatus FROM clientes where cod_cliente='".$cliente."' and sucursal='".$bodx."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	 {
	  $filax=mysql_fetch_array($resultado);
	  $xestatus=$filax['estatus'];
	 }

	$servicone="";
	$sentencia = "select conectacl FROM servicios where codservi='".$tconexion."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $servicone=$filaz['conectacl'];
	  }

        if($servicone=="1" and $xestatus=="1")
         {
          $resultadow=1;
         }
         else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}
function dat_obtener_tipodev_cmb()
{
	global $parametros , $conexion ;
	$sentencia = "select codigo 'Codigo',nombre 'Nombre' FROM tipodev";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



?>