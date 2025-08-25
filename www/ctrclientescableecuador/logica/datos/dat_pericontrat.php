<?php
require "dat_base.php";  

function dat_obtener_pericon_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigoper Codigo, nombreper Nombre from pericon order by nombreper";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_pericon($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de marcas del sistema
    $sentencia = "select codigo_mar 'Codigo', nombre 'Nombre' FROM marcas
				  order by codigo_mar LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_pericontrat($id)
{
	global $parametros , $conexion ;
	//obtine la lista de marca del sistema
    $sentencia = "select codigo_mar 'Codigo', nombre 'Nombre' FROM marcas
				  where codigo_mar='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_pericon()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM pericon";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_pericontrat($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marca
    $sentencia = "insert into marcas (codigo_mar,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_pericontrat($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "delete from  marcas where codigo_mar='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_pericontrat($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla marcas
    $sentencia = "update marcas set nombre='".$datos['Nombre']."',codigo_mar='".$datos['Codigo']."' where codigo_mar='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>