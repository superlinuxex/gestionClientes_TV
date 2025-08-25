<?php
require "dat_base.php";  

function dat_obtener_num_talonariocr($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM taloncr ";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_talonariocr($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.facini 'Factura inicial de talonario', a.fechaini 'Utilizar desde la fecha', a.facfin 'Factura final de talonario', b.nombre 'Sucursal'
          FROM taloncr a, bodegas b where a.sucursal=b.idbodegas order by a.fechaini LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_talonariocr_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM taloncr facini='".$filtro."')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}
function dat_obtener_talonariocr_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.facini 'Factura inicial de talonario', a.fechaini 'Utilizar desde la fecha', a.facfin 'Factura final de talonario', b.nombre 'Sucursal'
          FROM taloncr a, bodegas b where a.sucursal=b.idbodegas and a.facini='".$filtro."'
          order by a.fechaini LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



function dat_obtener_talonariocr2($id,$id1,$id2)
{
global $parametros , $conexion ;

    $sentencia = "select a.fechaini Mfechaini, a.facini Mfacini, a.facfin Mfacfin, a.sucursal Sucursal
          FROM taloncr a where a.facini='$id' and a.facfin='$id2' and fechaini='$id1'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_insertar_talonariocr($datos,$bode,$usuario)
{
global $parametros , $conexion ;

$fecha1=$datos['Mfechaini'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


    $sentencia = "insert into taloncr (fechaini,facini,facfin,idusuarios,sucursal,fechareg)  
					VALUES ('".$fechai."','".$datos['Mfacini']."','".$datos['Mfacfin']."','".$usuario."','".$datos['Sucursal']."',now())";
    $resultado = mysql_query($sentencia);

	return $resultado;
	exit;
}


function dat_actualizar_talonariocr($datos)
{
global $parametros , $conexion ;


$fecha1=$datos['Mfechaini'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


$resultado=0;
if(intval(substr($fecha1,6,4))>2012)
{
$sentencia = "update taloncr SET fechaini='".$fechai."',facini='".$datos['Mfacini']."',facfin='".$datos['Mfacfin']."',fechamod=now(), sucursal='".$datos['Sucursal']."'
			          WHERE  facini='".$datos['M1']."' and facfin='".$datos['M3']."' and fechaini='".$datos['M2']."';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
}
else
{
$sentencia = "update taloncr SET facini='".$datos['Mfacini']."',facfin='".$datos['Mfacfin']."',fechamod=now(), sucursal='".$datos['Sucursal']."'
			          WHERE facini='".$datos['M1']."' and facfin='".$datos['M3']."' and fechaini='".$datos['M2']."';";
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
}
	return $resultado;
	exit;
}

function dat_eliminar_talonariocr($datos)
{
global $parametros , $conexion ;

$sentencia = "delete from taloncr WHERE facini='".$datos['M1']."' and facfin='".$datos['M3']."' and fechaini='".$datos['M2']."';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_talonariocr_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select cod_cliente 'Codigo',nombre 'Nombre' FROM clientes where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


?>