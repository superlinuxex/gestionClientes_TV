<?php
require "dat_base.php";  

function dat_obtener_perfiles($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de perfiles del sistema
    $sentencia = "select idperfiles 'Codigo', nombre 'Nombre', descripcion 'Descripcion' FROM perfiles
				  order by idperfiles LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_perfil($id)
{
	global $parametros , $conexion ;
	//obtine la lista de perfiles del sistema
    $sentencia = "select idperfiles 'Codigo', nombre 'Nombre', descripcion 'Descripcion' FROM perfiles
				  where idperfiles=$id";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_perfiles()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla perfiles
    $sentencia = "SELECT COUNT(*) FROM perfiles";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_perfiles_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de perfiles del sistema para poblar combobox
    $sentencia = "select idperfiles 'Codigo', nombre 'Nombre'FROM perfiles";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_insertar_perfil($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla perfiles
    $sentencia = "insert into perfiles (nombre,descripcion)
					values('".$datos['Nombre']."','".$datos['Descripcion']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_perfil($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla perfiles
    $sentencia = "delete from  perfiles where idperfiles=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_perfil($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla perfiles
    $sentencia = "update perfiles set nombre='".$datos['Nombre']."',Descripcion='".$datos['Descripcion']."' where idperfiles='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>