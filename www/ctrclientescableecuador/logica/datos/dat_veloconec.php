<?php
require "dat_base.php";  

function dat_obtener_veloconec_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, nombre Nombre from velocidades order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_veloconec2($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM velocidades
				  order by codigo LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_veloconec($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM velocidades
				  where codigo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_veloconec()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM velocidades";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_veloconec($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into velocidades (codigo,nombre) values('".$datos['Codigo']."','".$datos['Nombre']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_veloconec($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  velocidades where codigo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_veloconec($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update velocidades set nombre='".$datos['Nombre']."' where codigo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>