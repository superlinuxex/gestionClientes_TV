<?php
require "dat_base.php";  

function dat_obtener_modelo_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_model Codigo, nombre Nombre from modelos
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_modelo($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_model 'Codigo', nombre 'Nombre' FROM modelos
				  order by codigo_model LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_modelo2($id)
{
	global $parametros , $conexion ;

    $sentencia = "select codigo_model 'Codigo', nombre 'Nombre' FROM modelos
				  where codigo_model='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_modelo()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM modelos";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_modelo($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into modelos (codigo_model,nombre)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_modelo($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  modelos where codigo_model='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_modelo($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update modelos set nombre='".$datos['Nombre']."',codigo_model='".$datos['Codigo']."' where codigo_model='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>