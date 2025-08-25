<?php
require "dat_base.php";  

function dat_obtener_menus($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de menus del sistema
    $sentencia = "select idmenu Codigo, Nombre, Texto, url, nivel, Columna FROM menus
					order by idmenu LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_menu($id)
{
	global $parametros , $conexion ;
    $sentencia = "select idmenu id, Nombre Nombre, Texto Texto, url Url,
					nivel Nivel, Columna Columna  FROM menus
					where idmenu=$id";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_menus()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla menus
    $sentencia = "SELECT COUNT(*) FROM menus";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_menu($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla menus
    $sentencia = "insert into menus (nombre,texto,url,nivel,columna)
					values('".$datos['Nombre']."','".$datos['Texto']."','".$datos['Url'].
					"','".$datos['Nivel']."','".$datos['Columna']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_menu($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla menus
    $sentencia = "delete from  menus where idmenu=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_menu($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla menus
    $sentencia = "update menus set nombre='".$datos['Nombre']."',Texto='".$datos['Texto']."',Url='".$datos['Url'].
					"',Nivel='".$datos['Nivel']."',Columna='".$datos['Columna']."' where idmenu='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_opciones_menu($id)
{
	global $parametros , $conexion ;
    $sentencia = "select case idopciones_menu>0 when true then 'checked' else '' end asignado,
					a.idmenu id,  a.Nombre Nombre FROM menus a left join opciones_menu b
					on b.idmenu = a.idmenu and b.idperfiles=$id;";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_eliminar_opciones_menu($perfil)
{
global $parametros , $conexion ;
    $sentencia = "delete from  opciones_menu where idperfiles=$perfil;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_insertar_opciones_menu($perfil,$idmenu)
{
global $parametros , $conexion ;
    $sentencia = "insert into opciones_menu(idperfiles,idmenu) VALUES ($perfil,$idmenu);";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

?>