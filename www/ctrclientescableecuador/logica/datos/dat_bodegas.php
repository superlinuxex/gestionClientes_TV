<?php
require "dat_base.php";  

function dat_obtener_bodegas($comienzo, $cant)
{
    global $parametros , $conexion ;
    $sentencia = "select a.idbodegas Codigo, a.nombre Nombre, a.ubicacion Ubicacion, 
					a.idencargado Responsable, b.nombre Empresa
					FROM bodegas a, empresas b where a.idempresa=b.idempresa 
					order by a.idbodegas LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_bodega($id)
{
    global $parametros , $conexion ;
    $sentencia = "select a.idbodegas Codigo, a.nombre Nombre, a.ubicacion Ubicacion, 
					a.idencargado Usuario, b.nombre Empresa
					FROM bodegas a, empresas b where idbodegas = '$id' order by idbodegas"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_num_bodegas()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla bodegas
    $sentencia = "SELECT COUNT(*) FROM bodegas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_bodega($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de bodegas
$proyecto="1";
    $sentencia = "insert into bodegas (idbodegas,nombre,ubicacion,idencargado,idempresa) 
VALUES ('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Ubicacion']."','"
.$datos['Usuario']."','".$proyecto."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_bodega($id)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de bodegas
    $sentencia = "delete from  bodegas where idbodegas='".$id."';";
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_bodega($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla bodega
    $sentencia = "update bodegas set idbodegas='".$datos['Codigo']."', nombre='".$datos['Nombre'].
					"',ubicacion='".$datos['Ubicacion']."',idencargado='".$datos['Usuario']."' 
					where idbodegas='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_bodegas_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de bodegas del sistema para poblar combobox
    $sentencia = "select idbodegas 'Codigo', nombre 'Nombre' FROM bodegas";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_bodegas_cmb2($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de bodegas del sistema para poblar combobox
    $sentencia = "select idbodegas 'Codigo', nombre 'Nombre' FROM bodegas where idbodegas!='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_bodegas_cmb3($bodega)
{
global $parametros , $conexion ;
    $sentencia = "select idbodegas 'Codigo', nombre 'Nombre' FROM bodegas where idbodegas='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_validar_existencia_bodega($proyecto)
{
	global $parametros , $conexion ;
	//obtine la lista de bodegas del sistema para poblar combobox
    $sentencia = "select idproyecto 'Codigo' FROM bodegas where idproyecto='".$proyecto."'";  
    $resultado = mysql_query($sentencia);
	$existe=false;
	if (!$resultado)
	{
		$existe=true;
	}
	else
	{
		$number_of_rows = mysql_num_rows($resultado);
		if ($number_of_rows > 0)
		{
			$existe=true;
		}
	}
	return $existe;
	exit;

}

?>