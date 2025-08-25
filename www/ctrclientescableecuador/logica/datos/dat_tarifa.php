<?php
require "dat_base.php";  

function dat_obtener_tarifa_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, costo Costo from tarifas
					order by costo";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_tarifa($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_plan 'Codigo', nombre_plan 'Nombre', costo 'Costo' FROM planes
				  order by cod_plan LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_tarifa($id)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_plan 'Codigo', nombre_plan 'Nombre' FROM planes
				  where cod_plan='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_tarifa()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM planes";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_tarifa($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into planes (cod_plan,nombre_plan,costo)
					values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Costo']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_tarifa($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "delete from  planes where cod_plan='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_tarifa($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update planes set nombre_plan='".$datos['Nombre']."',cod_plan='".$datos['Codigo']."' where cod_plan='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>