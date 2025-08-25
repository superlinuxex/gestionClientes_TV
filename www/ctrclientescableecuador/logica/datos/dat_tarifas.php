<?php
require "dat_base.php";  

function dat_obtener_tarifas_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, costo Costo from tarifas order by codigo";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_tarifas2($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', costo 'Costo', por_acum 'Acumulado' FROM tarifas
				  order by cast(codigo as decimal) LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_tarifas($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo 'Codigo', costo 'Costo', por_acum Poracum FROM tarifas
				  where codigo='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_tarifas()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM tarifas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_tarifas($datos)
{
global $parametros , $conexion ;

        //buscando el correlativo del detalle
	$sentencia="select case IFNULL(max(cast(codigo as decimal)),0) when '0' then 1 else max(cast(codigo as decimal))+1 end valortarifa 
				FROM tarifas";
	$cod_tab=mysql_query($sentencia);
	$codtarifa=mysql_fetch_array($cod_tab);

    $sentencia = "insert into tarifas (codigo,costo,por_acum) values('".$codtarifa['valortarifa']."','".$datos['Costo']."','".$datos['Poracum']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_tarifas($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  tarifas where codigo='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_tarifas($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update tarifas set costo='".$datos['Costo']."',por_acum='".$datos['Poracum']."' where codigo='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>