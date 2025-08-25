<?php
require "dat_base.php";  

function dat_obtener_equiad_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, nombre Nombre, descripcion Descripcion from equiadi order by codigo";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_equiad2($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre', descripcion 'Descripcion' FROM equiadi
				  order by codigo LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_equiad($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre', descripcion 'Descrip' FROM equiadi
				  where codigo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_equiad()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM equiadi";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_equiad($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into equiadi (codigo,nombre,descripcion) values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Descrip']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_equiad($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  equiadi where codigo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_equiad($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update equiadi set nombre='".$datos['Nombre']."',descripcion='".$datos['Descrip']."' where codigo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>