<?php
require "dat_base.php";  

function dat_obtener_promocion_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, nombre Nombre, descripcion Descripcion from promociones order by codigo";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_promocion2($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre', descripcion 'Descripcion' FROM promociones
				  order by codigo LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_promocion($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', nombre 'Nombre', descripcion 'Descrip' FROM promociones
				  where codigo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_promocion()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM promociones";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_promocion($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into promociones (codigo,nombre,descripcion) values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Descrip']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_promocion($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  promociones where codigo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_promocion($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update promociones set nombre='".$datos['Nombre']."',descripcion='".$datos['Descrip']."' where codigo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>