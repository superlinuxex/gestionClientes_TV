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
    $sentencia = "Select codigoper Codigo, nombreper Periodo, meses Meses from pericon 
				  order by codigoper LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_pericontrat($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigoper 'Codigo', nombreper 'Nombre',meses 'Meses' FROM pericon
				  where codigoper='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_pericontrat()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM pericon";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_pericon($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into pericon (codigoper,nombreper,meses)
					values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Meses']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_pericontrat($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  pericon where codigoper='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_pericontrat($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update pericon set nombreper='".$datos['Nombre']."',meses='".$datos['Meses']."' where codigoper='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>