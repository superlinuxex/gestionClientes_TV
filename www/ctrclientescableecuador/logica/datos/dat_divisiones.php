<?php
require "dat_base.php";  

function dat_obtener_divisiones($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de divisiones del sistema
    $sentencia = "select iddivisiones 'Codigo', nombre 'Nombre' FROM divisiones
				  order by iddivisiones LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_division($id)
{
	global $parametros , $conexion ;
	//obtine la lista de divisiones del sistema
    $sentencia = "select iddivisiones 'Codigo', nombre 'Nombre' FROM divisiones
				  where iddivisiones='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_divisiones_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de divisiones del sistema
    $sentencia = "select iddivisiones 'Codigo', nombre 'Nombre' FROM divisiones
				  order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_divisiones()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla divisiones
    $sentencia = "SELECT COUNT(*) FROM divisiones";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_division($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla divisiones
    $sentencia = "insert into divisiones (iddivisiones,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_division($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla divisiones
    $sentencia = "delete from  divisiones where iddivisiones='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_division($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla divisiones
    $sentencia = "update divisiones set nombre='".$datos['Nombre']."',iddivisiones='".$datos['Codigo']."' where iddivisiones='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>