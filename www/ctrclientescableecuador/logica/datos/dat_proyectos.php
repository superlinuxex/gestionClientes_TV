<?php
require "dat_base.php";  

function dat_obtener_proyectos($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de proyectos
    $sentencia = "select a.idproyectos Codigo, a.nombre Nombre, b.nombre Division, 
					a.responsable Responsable, FORMAT(a.presupuesto, 2) 
					Presupuesto, a.ubicacion Ubicacion FROM proyectos a 
					left join divisiones b on a.iddivision=b.iddivisiones
					order by a.idproyectos LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_proyecto($id)
{
	global $parametros , $conexion ;
	//obtine un proyecto
    $sentencia = "select a.idproyectos Codigo, a.nombre Nombre, a.iddivision Division, 
					a.responsable Usuario, FORMAT(a.presupuesto, 2) Presupuesto, 
					a.ubicacion Ubicacion FROM proyectos a
					where a.idproyectos = '$id' order by a.idproyectos"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_proyectos_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de proyectos para combobox
    $sentencia = "select a.idproyectos Codigo, a.nombre Nombre FROM proyectos a
					order by a.idproyectos"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_proyectos_cmb2($divixx)
{
	global $parametros , $conexion ;
	//obtine la lista de proyectos para combobox
    $sentencia = "select a.idproyectos Codigo, a.nombre Nombre FROM proyectos a
					where iddivision=$divixx order by a.idproyectos"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_num_proyectos()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla proyectos
    $sentencia = "SELECT COUNT(*) FROM proyectos";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_proyecto($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de proyectos
    $sentencia = "insert into  proyectos (idproyectos,nombre,iddivision,responsable,presupuesto,ubicacion) 
					VALUES ('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Division']."','".
					$datos['Usuario']."','".str_replace(',','',$datos['Presupuesto'])."','".$datos['Ubicacion']."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_proyecto($id)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de proyectos
    $sentencia = "delete from  proyectos where idproyectos=$id;";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_proyecto($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla usuarios
    $sentencia = "update proyectos set idproyectos='".$datos['Codigo']."', nombre='".$datos['Nombre'].
					"',responsable='".$datos['Usuario'].
					"',presupuesto='".str_replace(',','',$datos['Presupuesto'])."',ubicacion='".$datos['Ubicacion']."' where idproyectos='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

?>