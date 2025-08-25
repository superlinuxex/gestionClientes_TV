<?php
require "dat_base.php";  

function dat_validar_gasto($id)
{
    global $parametros , $conexion ;
    $sentencia = "select * from facturap where codigo_gasto='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}
                           

function dat_insertar_gasto($codigo,$factura,$fovial,$partida,$proveedor,$tipo,$fecha1,$bodega_ent,$renta,$codigoempl,$lugarcon,$descuento,$usuario,$observaciones,$justifica,$remesa)
{
global $parametros , $conexion ;

if($tipo=="1")
    {
	$tipon="CF";
    }
if($tipo=="2")
    {
	$tipon="CR";
    }
if($tipo=="3")
    {
	$tipon="RE";
    }
if($tipo=="4")
    {
	$tipon="TK";
    }
if($tipo=="5")
    {
	$tipon="VA";
    }

//buscando el nombre del proveedor
 $xnprovee="";
 $sentencia = "select nombre FROM proveedores where codigo_prv=".$proveedor.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnprovee=$row['nombre'];
  }
 }

//buscando el nombre de la partida
 $xnpartida="";
 $sentencia = "select npartida FROM partidas where partida='".$partida."' and sucursal=".$bodega_ent.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnpartida=$row['npartida'];
  }
 }

//$usuario=$_SESSION["idusuarios"];


if($descuento=="")
 {
  $descuento=0;
 }
if($lugarcon=="")
 {
  $lugarcon=1;
 }
if($renta=="")
 {
  $renta=0;
 }
if($fovial=="")
 {
  $fovial=0;
 }

$xjusti=$justifica;
$xremesa=$remesa;
$xobs=$observaciones;
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);




$sentencia = "insert into facturap (codigo_gasto,sucursal,numero,tipofac,tipo,fechafac,codprove,nomprove,emplepago,idusuarios,fechareg,partida,npartida,descuento,tipopago,renta,fovial,observaciones,justificacion,remesa) 
 					VALUES (".$codigo.",".$bodega_ent.",'".$factura."',".$tipo.",'".$tipon."','".$fecha."',".$proveedor.",'".$xnprovee."','".$codigoempl."',".$usuario.",now(),'".$partida."','".$xnpartida."',".$descuento.",".$lugarcon.",".$renta.",".$fovial.",'".$xobs."','".$xjusti."','".$xremesa."')";

    $resultado = mysql_query($sentencia);



	return $resultado;
	exit;
}

function dat_eliminar_gastoff($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  gastos_deta where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_gastos_detalle($comienzo, $cant,$codigo)
{
	global $parametros , $conexion ;
    $sentencia = "Select codigo_detalle Item, codigo_gasto Codigo, concepto Concepto, espeadi Detalle, cantidad Cantidad, precio Precio, total 'Total'
					from detafap
					where codigo_gasto='".$codigo."';"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_detalle_gasto($cod_encabezado, $cod_detalle)
{
global $parametros , $conexion ;
    $sentencia = "Select tipofac Tipofac, codmate Tipogas,espeadi Detalles, cantidad Cantidad, precio Costou, lugarcon Consumo, placa Placa, periodo Corte, nic Nic, zona Zona, kilometrajeini K1, kilometrajefin K2
					from detafap
					where codigo_gasto='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_gastos_detalle($codigo)
{

	global $parametros , $conexion ;
	//obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from gastos_deta where codigo_gasto='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}


function dat_insertar_gasto_detalle($datos,$bodega,$codgasto1,$tipo,$docum,$fecha,$proveedor,$renta,$fovial,$descuento,$numremesa)
{
global $parametros , $conexion ;

//inserta un registro en la tabla de gastos_detalle
//        $xcodgasto=$Encabezado['0'];
//        $tipo=$Encabezado['1'];
//        $documento=$Encabezado['7'];
//        $codprove=$Encabezado['5'];
//        $renta=$Encabezado['14'];
//        $fovial=$Encabezado['8'];
//        $descuento=$Encabezado['16'];
//        $fecha1=$Encabezado['13'];
//        $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$tipogas=$datos['Tipogas'];
$precio=$datos['Costou'];
$cant=$datos['Cantidad'];

$xcodgasto=$codgasto1;
$documento=$docum;
//$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$codprove=$proveedor;



if($tipo=="1")
    {
	$tipon="CF";
    }
if($tipo=="2")
    {
	$tipon="CR";
    }
if($tipo=="3")
    {
	$tipon="RE";
    }
if($tipo=="4")
    {
	$tipon="TK";
    }
if($tipo=="5")
    {
	$tipon="VA";
    }



        //buscando el correlativo del detalle
	$sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_gasto 
				FROM detafap where codigo_gasto='".$xcodgasto."' and sucursal='".$bodega."'";
	$cod_tab=mysql_query($sentencia);
	$cod_gasto_deta=mysql_fetch_array($cod_tab);

	$ntipogas="";
	$xtipogas=$datos['Tipogas'];
        $sentencia="select nombre from maeservi where codigose='".$xtipogas."'";
        $resultado2 = mysql_query($sentencia);
        $ntipogas="";
      	if(isset($resultado2))
         {
          if(mysql_num_rows($resultado2)!=0)
	   {
 	    $fila1=mysql_fetch_array($resultado2);
	    $ntipogas=$fila1['nombre'];
           }
          }
	 $usuario=$_SESSION["idusuarios"];

	$xtotal=$datos['Cantidad']*$datos['Costou'];
        $ese="S";


          $sentencia = "insert into detafap (codigo_gasto,codigo_detalle,numero,tipofac,tipo,fechafac,sucursal,codprove,codmate,concepto,cantidad,precio,total,idusuarios,fechareg,espeadi,lugarcon,placa,periodo,nic,zona,tipogas,kilometrajeini,kilometrajefin) 
		VALUES (".$xcodgasto.",'".$cod_gasto_deta['cod_gasto']."','".$documento."',".$tipo.",'".$tipon."','".$fecha."','".$bodega."',".$codprove.",'".$datos['Tipogas']."','".$ntipogas."','".$datos['Cantidad']."','".$datos['Costou']."','".$xtotal."',".$usuario.",now(),'".$datos['Detalle']."','".$datos['Consumo']."','".$datos['Placa']."','".$datos['Corte']."','".$datos['Nic']."','".$datos['Zona']."','".$ese."','".$datos['K1']."','".$datos['K2']."')";
          $resultado = mysql_query($sentencia);



     //Actualizando el encabezado de la factura
     $stotal=0;
     $res=mysql_query("select total from detafap where codigo_gasto='".$xcodgasto."'");
     while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }

      $sstotal=$stotal;
      $stotalfin=$stotal;
     
      if($descuento>0)
      {
        $stotalfin=$sstotal-$descuento;
      }

     $iva=$stotalfin*0.13;
     if($tipo=="2")  //solo si es credito fiscal
      {
       $smtotal=$stotalfin+$iva-$renta+$fovial;
       $sentencia="update facturap set monto=$sstotal,total=$smtotal,iva=$iva where codigo_gasto='".$xcodgasto."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $smtotal=$stotalfin+$fovial-$renta;
       $sentencia="update facturap set monto=$sstotal,total=$smtotal where codigo_gasto='".$xcodgasto."'";
       $resultado=mysql_query($sentencia);
      }

 
 return $resultado;
 exit;
}

function dat_insertar_existencia($datos,$bodega,$producto,$cant,$codgasto,$precio,$estado,$Encabezado)
{
global $parametros , $conexion;
exit;
}

function dat_actualizar_gasto_detalle($datos,$cod_encabezado,$cod_detalle,$cant_ant,$bodega,$tipo)
{
global $parametros , $conexion ;
 //actualiza un registro en la tabla de gastos_detalle
 $xtotal=$datos['Cantidad']*$datos['Costou'];
 $sentencia = "update detafap set total='".$xtotal."',cantidad='".$datos['Cantidad']."',precio='".$datos['Costou']."'
 ,espeadi='".$datos['Detalles']."',lugarcon='".$datos['Consumo']."',placa='".$datos['Placa']."'
 ,periodo='".$datos['Corte']."',nic='".$datos['Nic']."',zona='".$datos['Zona']."',kilometrajeini='".$datos['K1']."'
 ,kilometrajefin='".$datos['K2']."' 
 where codigo_gasto='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'";
 $resultado = mysql_query($sentencia);


//actualizando el encabezado a partir de los datos del detalle
 $descuento=0;
 $fovial=0;
 $renta=0;
 $ivaanterior=0;

$sentencia2 = "select * from facturap where codigo_gasto='".$cod_encabezado."';";
$resultadoq=mysql_query($sentencia2);
if(isset($resultadoq))
 {
  if(mysql_num_rows ( $resultadoq )!=0)
	{
	 $fila=mysql_fetch_array($resultadoq);
	 $descuento=$fila['descuento'];
	 $fovial=$fila['fovial'];
	 $renta=$fila['renta'];
         $ivaanterior=$fila['iva'];
        }
 }

$stotal=0;
$res=mysql_query("select precio,cantidad,total from detafap where codigo_gasto='".$cod_encabezado."'");

while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }


      $sstotal=$stotal;
      $stotalfin=$stotal;
     
      if($descuento>0)
      {
        $stotalfin=$sstotal-$descuento;
      }

     $iva=$stotalfin*0.13;
     if($ivaanterior>0)  //solo si es credito fiscal
      {
       $smtotal=$stotalfin+$iva-$renta+$fovial;
       $sentencia="update facturap set monto='".$sstotal."',total='".$smtotal."',iva='".$iva."' where codigo_gasto='".$cod_encabezado."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $smtotal=$stotalfin+$fovial-$renta;
       $sentencia="update facturap set monto='".$sstotal."',total='".$smtotal."' where codigo_gasto='".$cod_encabezado."'";
       $resultado=mysql_query($sentencia);
      }


 return $resultado;
 exit;
}

function dat_eliminar_gasto_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$tipo)
{
global $parametros , $conexion ;

$sentencia = "delete from detafap where  codigo_gasto='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'";  
$resultado = mysql_query($sentencia);


//actualizando el encabezado a partir de los datos del detalle

 $descuento=0;
 $fovial=0;
 $renta=0;

$sentencia2 = "select * from facturap where codigo_gasto='".$cod_encabezado."';";
$resultadoq=mysql_query($sentencia2);
if(isset($resultadoq))
 {
  if(mysql_num_rows ( $resultadoq )!=0)
	{
	 $fila=mysql_fetch_array($resultadoq);
	 $descuento=$fila['descuento'];
	 $fovial=$fila['fovial'];
	 $renta=$fila['renta'];
        }
 }

$stotal=0;
$res=mysql_query("select precio,cantidad,total from detafap where codigo_gasto='".$cod_encabezado."'");
while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }


      $sstotal=$stotal;
      $stotalfin=$stotal;
     
      if($descuento>0)
      {
        $stotalfin=$sstotal-$descuento;
      }

     $iva=$stotalfin*0.13;
     if($tipo=="2")  //solo si es credito fiscal
      {
       $smtotal=$stotalfin+$iva-$renta+$fovial;
       $sentencia="update facturap set monto='".$sstotal."',total='".$smtotal."',iva='".$iva."' where codigo_gasto='".$cod_encabezado."'";
       $resultado1=mysql_query($sentencia);
      }
      else
      {
       $smtotal=$stotalfin+$fovial-$renta;
       $sentencia="update facturap set monto='".$sstotal."',total='".$smtotal."' where codigo_gasto='".$cod_encabezado."'";
       $resultado1=mysql_query($sentencia);
      }


	return $resultado;
	exit;
}

function dat_obtener_cod_gasto()
{
global $parametros , $conexion ;
	$sentencia="select case IFNULL(max(cast(codigo_gasto as decimal)),0) when '0' then 1 else max(cast(codigo_gasto as decimal))+1 end id FROM facturap";
	$resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
	{
		$fila=mysql_fetch_array($resultado);
		$retorno=$fila['id'];
	}
	else
	{
		$retorno=1;
	}
	
	return $retorno;
	exit;
}

function dat_obtener_gastos($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;

	
	$sentencia="select codigo_gasto Codigo, numero Documento, case tipofac when 1 then 'CF' when 2 then 'CR' when 3 then 'RE' when 4 then 'TK' when 5 then 'VA' end Tipo, DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha,fovial '+Fovial',monto Monto, descuento '-Descuento', iva '+IVA', renta '-Renta',total Total
					from facturap 
					where sucursal='".$bodega."'
					order by fechafac LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_gastos($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*)  from facturap where sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_gasto($id)
{
	global $parametros , $conexion ;
	$sentencia="select codigo_gasto Codigo,tipofac Tipo, fechafac Fecha, tipopago Lugarcon, codprove Proveedor, partida Partida,total Total,iva Iva, monto Monto,
					numero Documento, fovial Fovial,observaciones Observaciones, renta Renta, emplepago Codigoempl, descuento Descuento,justificacion Justificacion, remesa Remesa
					from facturap where codigo_gasto='".$id."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_gasto($datos,$tipo)
{
 global $parametros , $conexion ;
 $usuariocambia=$_SESSION["idusuarios"];
 //buscando el nombre del proveedor
 $xnprovee="";
 $sentencia = "select nombre FROM proveedores where codigo_prv=".$proveedor.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnprovee=$row['nombre'];
  }
 }

 //buscando el nombre de la partida
 $xnpartida="";
 $sentencia = "select npartida FROM partidas where partida=".$partida." and sucursal=".$bodega_ent.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnpartida=$row['npartida'];
  }
 }

 $sentencia = "update facturap set npartida='".$xnpartida."',fechamod=now(),usuariom='".$usuariocambia."',nomprove='".$xnprovee."',codprove='".$datos['Proveedor']."',partida='".$datos['Partida']."',emplepago='".$datos['Codigoempl']."',renta='".$datos['Renta']."',fovial='".$datos['Fovial']."',descuento='".$datos['Descuento']."',tipopago='".$datos['Lugarcon']."',observaciones='".$datos['Observaciones']."',justificacion='".$datos['Justificacion']."'
	      where codigo_gasto='".$datos['Codigo']."';";
		$resultadoprinci = mysql_query($sentencia);


//actualizando el encabezado a partir de los datos del detalle
 $descuento=0;
 $fovial=0;
 $renta=0;

$sentencia2 = "select * from facturap where codigo_gasto='".$datos['Codigo']."';";
$resultadoq=mysql_query($sentencia2);
if(isset($resultadoq))
 {
  if(mysql_num_rows ( $resultadoq )!=0)
	{
	 $fila=mysql_fetch_array($resultadoq);
	 $descuento=$fila['descuento'];
	 $fovial=$fila['fovial'];
	 $renta=$fila['renta'];
        }
 }

$stotal=0;
$res=mysql_query("select precio,cantidad,total from detafap where codigo_gasto='".$datos['Codigo']."'");
while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }


      $sstotal=$stotal;
      $stotalfin=$stotal;
     
      if($descuento>0)
      {
        $stotalfin=$sstotal-$descuento;
      }

     $iva=$stotalfin*0.13;
     if($tipo=="2")  //solo si es credito fiscal
      {
       $smtotal=$stotalfin+$iva-$renta+$fovial;
       $sentencia="update facturap set monto=$sstotal,total=$smtotal,iva=$iva where codigo_gasto='".$datos['Codigo']."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $smtotal=$stotalfin+$fovial-$renta;
       $sentencia="update facturap set monto=$sstotal,total=$smtotal where codigo_gasto='".$datos['Codigo']."'";
       $resultado=mysql_query($sentencia);
      }

return $resultado;
exit;
}

function dat_eliminar_gasto2($datos,$tipo)
{
 global $parametros , $conexion ;

 $sentencia = "delete from facturap where codigo_gasto='".$datos['Codigo']."';";
 $resultadoprinci = mysql_query($sentencia);
 $sentencia="delete from detafap where codigo_gasto='".$datos['Codigo']."'";
 $resultado=mysql_query($sentencia);

return $resultado;
exit;
}

function dat_ajustar_gasto2($datos,$tipo)
{
 global $parametros , $conexion ;
     if($tipo=="1" or $tipo=="2")  //solo si es credito fiscal o consumidor final
      {
	 $sentencia = "update facturap set total='".$datos['Total']."' where codigo_gasto='".$datos['Codigo']."';";
	 $resultado=mysql_query($sentencia);
      }
      else
      {
	 $sentencia = "update facturap set monto='".$datos['total1']."',total='".$datos['total1']."' where codigo_gasto='".$datos['Codigo']."';";
	 $resultado=mysql_query($sentencia);
      }

return $resultado;
exit;
}

function dat_obtener_gastos_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{

	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select codigo_gasto Codigo, numero Documento, case tipofac when 1 then 'CF' when 2 then 'CR' when 3 then 'RE' when 4 then 'TK' when 5 then 'VA' end Tipo, DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha,fovial '+Fovial',monto Monto, descuento '-Descuento', iva '+IVA', renta '-Renta',total Total
		from facturap where sucursal='".$bodega."' and fechafac>=str_to_date('$filtro1','%d-%m-%Y') and fechafac<=str_to_date('$filtro2','%d-%m-%Y')
		order by fechafac LIMIT $comienzo, $cant";
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_obtener_num_gastos_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from facturap where sucursal='".$bodega."' and fechafac>=str_to_date('$filtro1','%d-%m-%Y') and fechafac<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_partidas_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select partida 'Codigo',npartida 'Nombre' FROM partidas where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_tipogas_cmb()
{
	global $parametros , $conexion ;
	$sentencia = "select codigose 'Codigo',nombre 'Nombre' FROM maeservi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}




?>