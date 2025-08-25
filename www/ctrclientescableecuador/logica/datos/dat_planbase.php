<?php
require "dat_base.php";  

function dat_obtener_planbase_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, nombre Nombre from planbase order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_planbase2($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM planbase
				  order by codigo LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_planbase($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM planbase
				  where codigo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_planbase()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM planbase";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_planbase($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into planbase (codigo,nombre) values('".$datos['Codigo']."','".$datos['Nombre']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_planbase($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  planbase where codigo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_planbase($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update planbase set nombre='".$datos['Nombre']."' where codigo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>