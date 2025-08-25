<?php
require "dat_base.php";  

function dat_obtener_remesucu_cmb($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de proveedores para  poblar combobox
    $sentencia = "select codigo_prv Codigo, nombre Nombre from proveedores
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_remesas_cmb($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select numero Codigo, remesa Documento, fecha Fecha, monto Monto, saldo Saldo from remesucu where sucursal='".$bodega."'
					order by fecha";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_remesucus($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;

    $sentencia = "select a.numero 'No.', a.remesa 'Remesa', DATE_FORMAT(a.fecha,'%d/%m/%Y') 'Fecha remesa',DATE_FORMAT(a.fechadia,'%d/%m/%Y') 'Fecha venta', a.monto 'Monto', b.nombre 'Sucursal', a.saldo 'Saldo' 
        FROM remesucu a, bodegas b where a.sucursal=b.idbodegas and a.sucursal='".$bodega."' order by a.numero LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_remesucus_filtro($bodega,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    
    $sentencia="select count(*) from remesucu where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_remesucus_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{

    global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);


    $sentencia="select a.numero 'No.', a.remesa 'Remesa', DATE_FORMAT(a.fecha,'%d/%m/%Y') 'Fecha remesa',DATE_FORMAT(a.fechadia,'%d/%m/%Y') 'Fecha venta', a.monto 'Monto', b.nombre 'Sucursal', a.saldo 'Saldo' 
        FROM remesucu a, bodegas b where a.sucursal=b.idbodegas AND a.sucursal='".$bodega."' and a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y')
                    order by a.fecha DESC LIMIT $comienzo, $cant";
  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_remesucu($id,$bodega)
{
    global $parametros , $conexion ;
    $sentencia = "select numero 'Codigo', fecha 'Fecha',fechadia 'Fechadia',remesa 'Remesa',monto 'Monto',cuenta 'Cuenta',responsable 'Responsable',banco 'Banco',sucursal 'Sucursal',saldo 'Saldo' 
    FROM remesucu  where numero='$id' and sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_remesucu($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM remesucu where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_remesucu($datos,$bodega)
{
global $parametros , $conexion ;

$fecha1=$datos['Fecha'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fechadia=$datos['Fechadia'];
$fecha2=substr($fechadia,6,4)."-".substr($fechadia,3,2)."-".substr($fechadia,0,2);


	$sentencia="select case IFNULL(max(cast(numero as decimal)),0) when '0' then 1 else max(cast(numero as decimal))+1 end cod_entrada 
				FROM remesucu";
	$cod_tab=mysql_query($sentencia);
	$xnumereme=mysql_fetch_array($cod_tab);

    $sentencia = "insert into remesucu (numero,remesa,fecha,fechadia,responsable,monto,sucursal,banco,cuenta,saldo)
					values('".$xnumereme['cod_entrada']."','".$datos['Remesa']."','".$fecha."','".$fecha2."','".$datos['Responsable']."','".$datos['Monto']."','".$bodega."','".$datos['Banco']."','".$datos['Cuenta']."','".$datos['Monto']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_remesucu($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "delete from  remesucu where numero='$id' and sucursal='".$bodega."';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_remesucu($datos, $id,$bodega)
{
global $parametros , $conexion ;
 $fecha1=$datos['Fecha'];
 $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    if(intval(substr($fecha1,6,4))>1900)
    {
    $sentencia = "update remesucu set fecha='".$fecha."'
    where numero='$id' and sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    }



 $fecha1=$datos['Fechadia'];
 $fecha2=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    if(intval(substr($fecha1,6,4))>1900)
    {
    $sentencia = "update remesucu set fechadia='".$fecha2."'
    where numero='$id' and sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    }


    $sentencia = "update remesucu set remesa='".$datos['Remesa']."', responsable='".$datos['Responsable']."',monto='".$datos['Monto']."',sucursal='".$bodega."',banco='".$datos['Banco']."',cuenta='".$datos['Cuenta']."' 
    where numero='$id' and sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>