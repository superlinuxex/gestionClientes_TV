<?php
require "dat_base.php";  

function dat_obtener_partidas($comienzo, $cant)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas
    $sentencia = "select a.idpartida Codigo, b.nombre Division, c.nombre Proyecto, 
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo,
					a.iddivision cod_div,a.idproyecto cod_pro
					FROM partidas a, divisiones b, proyectos c
					where a.iddivision = b.iddivisiones and a.idproyecto = c.idproyectos
					order by a.idproyecto,cast(a.idpartida as decimal)  LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_partida($id,$div,$pro)
{
	global $parametros , $conexion ;
	//obtine un partida
    $sentencia = "select idpartida Codigo, iddivision Division, idproyecto Proyecto, 
					Nombre Nombre, cargos Cargos, abonos Abonos, saldo Saldo
					FROM partidas where idpartida='$id' and iddivision='$div' and idproyecto='$pro'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_partida_sub($id,$div,$pro)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas
    $sentencia = "select a.idpartida Codigo, b.nombre Division, c.nombre Proyecto, 
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					FROM partidas a, divisiones b, proyectos c
					where a.iddivision = b.iddivisiones and a.idproyecto = c.idproyectos
					and idpartida='$id' and a.iddivision='$div' and a.idproyecto='$pro'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_partidas()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "SELECT COUNT(*) FROM partidas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_partida($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de partidas
    $sentencia = "insert into partidas (idpartida,iddivision,idproyecto,Nombre,cargos,abonos,saldo,idbodegas) 
					VALUES ('".$datos['Codigo']."','".$datos['Division']."','".$datos['Proyecto']."',
					'".$datos['Nombre']."',0,".$datos['Abonos'].",0,'".$datos['Bodega']."')";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_partida($id,$div,$pro)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de partidas
    $sentencia = "delete from  partidas where iddivision='$div' and idproyecto='$pro' and idpartida='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_partida($datos,$id,$div,$pro)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "update partidas SET Nombre = '".$datos['Nombre']."',abonos = ".$datos['Abonos']." WHERE iddivision='$div' and idproyecto='$pro' and idpartida = '$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_partidas_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo', nombre 'Nombre', idbodegas 'Bod' FROM partidas";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_partidas_cmbdos()
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo', nombre 'Nombre' FROM partidas";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_partidas_cmbtres($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox

    $sentencia = "select idpartida 'Codigo', substr(nombre,1,90) 'Nombre' FROM partidas where idbodegas='$bodega'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_validar_existencia_partida($cod, $division,$proyecto)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo' FROM partidas where idpartida='".$cod."' and iddivision='".$division."' and idproyecto='".$proyecto."'";  
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
function dat_validar_existencia_subpartida1($cod, $division,$proyecto)
{
	global $parametros , $conexion ;
	//validar si existe un registro hijo
    $sentencia = "select idpartida 'Codigo' FROM subpartidas where idpartida='".$cod."' and iddivision='".$division."' and idproyecto='".$proyecto."'";  
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



function dat_obtener_x_partidas_cmb($bod)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo', nombre 'Nombre' FROM partidas where idbodegas='".$bod."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


?>