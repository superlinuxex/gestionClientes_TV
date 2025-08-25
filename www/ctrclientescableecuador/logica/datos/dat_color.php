<?php
require "dat_base.php";  

function dat_obtener_color_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_color Codigo, nombre Nombre from colores
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_color($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_color 'Codigo', nombre 'Nombre' FROM colores
				  order by codigo_color LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_color2($id)
{
	global $parametros , $conexion ;

    $sentencia = "select codigo_color 'Codigo', nombre 'Nombre' FROM colores
				  where codigo_color='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_color()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM colores";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_color($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into colores (codigo_color,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_color($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  colores where codigo_color='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_color($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update colores set nombre='".$datos['Nombre']."',codigo_color='".$datos['Codigo']."' where codigo_color='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>