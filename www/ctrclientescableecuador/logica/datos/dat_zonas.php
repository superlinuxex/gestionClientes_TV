<?php
require "dat_base.php";  

function dat_obtener_zona_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_zona Codigo, nombre Nombre from zonas
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_zonas($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_zona 'Codigo', nombre 'Nombre' FROM zonas
				  order by codigo_zona LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_zona2($id)
{
	global $parametros , $conexion ;

    $sentencia = "select codigo_zona 'Codigo', nombre 'Nombre' FROM zonas
				  where codigo_zona='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_zonas()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM zonas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_zona($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into zonas (codigo_zona,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_zona($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  zonas where codigo_zona='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_zona($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update zonas set nombre='".$datos['Nombre']."',codigo_zona='".$datos['Codigo']."' where codigo_zona='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>