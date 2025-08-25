<?php
require "dat_base.php";  

function dat_obtener_muni($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_depto CD,a.cod_ciudad CM, a.nomb_ciudad 'Nombre Municipio',b.nom_depto 'Nombre Departamento'
					FROM munici a, deptos b where a.cod_depto=b.cod_depto
					order by a.cod_ciudad LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_munis($id,$id2)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_ciudad Codigo, nomb_ciudad Nombre, cod_depto Depto FROM munici where cod_ciudad = '$id2' and cod_depto = '$id' order by cod_ciudad"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_munisegundo($id)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_ciudad Codigo, nomb_ciudad Nombre, cod_depto Depto FROM munici
					where cod_ciudad = '$id' order by cod_ciudad"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_num_muni()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM munici";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_muni($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into munici (cod_ciudad,nomb_ciudad,cod_depto) 
VALUES ('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Depto']."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_muni($datos,$id2)
{
global $parametros , $conexion ;
    $sentencia = "delete from munici where cod_depto='".$datos['Depto']."' and cod_ciudad='".$id2."';";
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_muni($datos,$id2)
{
global $parametros , $conexion ;


    $sentencia = "update munici set nomb_ciudad='".$datos['Nombre']."' 
					where cod_depto='".$datos['Depto']."' and cod_ciudad='".$id2."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_muni_cmb($depto)
{
	global $parametros , $conexion ;

    $sentencia = "select cod_ciudad 'Codigo', nomb_ciudad 'Nombre' FROM munici where cod_depto='".$depto."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_muni_cmb2($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_ciudad 'Codigo', nom_ciudad 'Nombre' FROM munici";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_muni_cmb3($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select coddepto 'Codigo', nombredepto 'Nombre' FROM deptos where coddepto='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_validar_existencia_muni($depto,$muni)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_ciudad 'Codigo' FROM munici where cod_depto='".$depto."' and cod_ciudad='".$muni."';";  
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