<?php
require "dat_base.php";  
function  dat_obtener_menu_ppl($perfil)  
{  
	global $parametros , $conexion ;
     
    //obtine los item del menu principal
    $sentencia = "select a.texto,a.columna, a.url FROM menus a, opciones_menu b where a.idmenu = b.idmenu and a.nivel=1 and b.idperfiles=$perfil;";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_menu_sub($perfil,$columna)
{
	global $parametros , $conexion ;
	//obtine los item de un sub menu
    $sentencia = "select a.texto,a.columna, a.url FROM menus a, opciones_menu b where a.idmenu = b.idmenu and a.nivel=2 
					and a.columna=$columna and b.idperfiles=$perfil;";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_usuarios($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de usuarios del sistema
    $sentencia = "select a.idusuarios Codigo, a.nombre Nombre, a.apellido Apellido, 
					a.usuario Usuario, b.nombre Perfil, a.idbodega,c.nombre Sucursal,case a.estado when 1 then 'Activado' when 0 then 'Desactivado' end Estado
					FROM usuarios a, perfiles b, bodegas c
					where  a.idperfiles = b.idperfiles and a.idbodega=c.idbodegas
					order by a.idusuarios LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_usuario($id)
{
	global $parametros , $conexion ;
	//obtine la lista de usuarios del sistema
    $sentencia = "select a.idusuarios Codigo, a.nombre Nombre, a.apellido Apellido, 
					a.usuario Usuario, a.idperfiles Perfil, a.idbodega Bodega, a.contador Contador
					FROM usuarios a
					where a.idusuarios=$id";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_usuarios_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de usuarios del sistema para  poblar combobox
    $sentencia = "select a.idusuarios Codigo, a.nombre Nombre  FROM usuarios a
					order by a.Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_usuarios()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla usuarios
    $sentencia = "SELECT COUNT(*) FROM usuarios";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_usuario($datos)
{
global $parametros , $conexion ;
 $estado="1";
 $sentencia = "insert into usuarios (nombre,apellido,usuario,clave,idperfiles,idbodega,estado)
					values('".$datos['nombre']."','".$datos['apellido']."','".$datos['usuario'].
					"','".sha1(trim($datos['clave']))."','".$datos['perfiles']."','".$datos['bodega']."','".$estado."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_usuario($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla usuarios
    $sentencia = "delete from  usuarios where idusuarios=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_usuario($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla usuarios
    $sentencia = "update usuarios set nombre='".$datos['Nombre']."',apellido='".$datos['Apellido']."',usuario='".$datos['Usuario'].
					"',idperfiles='".$datos['Perfil']."',idbodega='".$datos['Bodega']."' where idusuarios='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_reiniciar_usuario($nclave, $id)
{
global $parametros , $conexion ;
$estado="1";
    $sentencia = "update usuarios set clave='".sha1(trim($nclave))."',estado='".$estado."' where idusuarios='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_desactivar_usuario($nclave, $id)
{
global $parametros , $conexion ;
$estado="0";
    $sentencia = "update usuarios set clave='".sha1(trim($nclave))."',estado='".$estado."' where idusuarios='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function  dat_validar_clave($user, $pass)  
{  
	global $parametros , $conexion ; 
    	$sentencia = "Select * from usuarios where idusuarios='".$user."' and clave='".$pass."';";  
	$tabla = mysql_query($sentencia);
	$resultado = mysql_result($tabla,0,0);
	return $resultado;

}

function dat_usuarios_cambiar_clave($id, $clave)
{
	$sentencia = "update usuarios set clave='".sha1(trim($clave))."' where idusuarios='".$id."';";  
        $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>