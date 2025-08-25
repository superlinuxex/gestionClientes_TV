<?php
require "dat_base.php";  

function dat_obtener_marcas_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_mar Codigo, nombre Nombre from marcas order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_marcas($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de marcas del sistema
    $sentencia = "select codigo_mar 'Codigo', nombre 'Nombre' FROM marcas
				  order by codigo_mar LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_marca($id)
{
	global $parametros , $conexion ;
	//obtine la lista de marca del sistema
    $sentencia = "select codigo_mar 'Codigo', nombre 'Nombre' FROM marcas
				  where codigo_mar='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_marcas()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "SELECT COUNT(*) FROM marcas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_marca($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marca
    $sentencia = "insert into marcas (codigo_mar,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_marca($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "delete from  marcas where codigo_mar='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_marca($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "update marcas set nombre='".$datos['Nombre']."',codigo_mar='".$datos['Codigo']."' where codigo_mar='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>