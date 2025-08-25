<?php
require "dat_base.php";  

function dat_obtener_motidesco_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigomot Codigo, nombremot Nombre from tablamoti
					order by nombremot";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_motidesco($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigomot 'Codigo', nombremot 'Nombre' FROM tablamoti
				  order by codigomot LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_motidescouno($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigomot 'Codigo', nombremot 'Nombre' FROM tablamoti
				  where codigomot='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_motidesco()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM tablamoti";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_motidesco($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into tablamoti (codigomot,nombremot)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_motidesco($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  tablamoti where codigomot='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_motidesco($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update tablamoti set nombremot='".$datos['Nombre']."' where codigomot='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>