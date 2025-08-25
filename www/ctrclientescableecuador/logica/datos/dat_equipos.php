<?php
require "dat_base.php";  

function dat_obtener_equipos_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de equipos del sistema
    $sentencia = "select codigo_equipo Codigo, nombre Nombre FROM equipos
				  order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_equipos($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de equipos 
    $sentencia = "select codigo_equipo 'Codigo', nombre 'Nombre' FROM equipos
				  order by codigo_equipo LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_equipo($id)
{
	global $parametros , $conexion ;
	//obtine la lista de equipos del sistema
    $sentencia = "select codigo_equipo 'Codigo', nombre 'Nombre', marca 'Marca', modelo 'Modelo', serie 'Serie', placa 'Placa' FROM equipos
				  where codigo_equipo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_equipos()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla equipos
    $sentencia = "SELECT COUNT(*) FROM equipos";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_equipo($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla equipos
    $sentencia = "insert into equipos (codigo_equipo,nombre,marca,modelo,serie,placa)
					values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Marca']."','".$datos['Modelo']."','".$datos['Serie']."','".$datos['Placa']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_equipo($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla equipos
    $sentencia = "delete from  equipos where codigo_equipo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_equipos($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla equipos
    $sentencia = "update equipos set nombre='".$datos['Nombre']."',marca='".$datos['Marca']."',modelo='".$datos['Modelo']."',serie='".$datos['Serie']."',placa='".$datos['Placa']."',codigo_equipo='".$datos['Codigo']."' where codigo_equipo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>

