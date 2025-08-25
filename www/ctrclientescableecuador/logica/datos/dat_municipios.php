<?php
require "dat_base.php";  

function dat_obtener_municipios($id)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_ciudad Codigo, b.nom_depto Estado, a.nomb_ciudad Municipio
					from munici a, deptos b
					where a.cod_depto=b.cod_depto and a.cod_depto='$id' order by a.cod_ciudad"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_municipio($part,$subpart)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_ciudad Codigo, a.nomb_ciudad Nombre
					from munici a where a.cod_depto='$part' and a.cod_ciudad='$subpart'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_municipio_sub($part,$subpart)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_ciudad Codigo, b.nom_depto Departamento, a.nomb_ciudad Ciudad
					from munici a, deptos b
					where a.cod_depto=b.cod_depto and a.cod_depto='$part' and a.cod_ciudad='$subpart'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_subpartidas()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "SELECT COUNT(*) FROM partidas";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_municipio($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into munici (cod_ciudad,cod_depto,Nomb_ciudad) 
					VALUES ('".$datos['Codigo']."','".$datos['Depto']."','".$datos['Nombre']."')";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_municipio($part,$subpart)
{
global $parametros , $conexion ;
    $sentencia = "delete from  munici where cod_depto='$part' and cod_ciudad='$subpart'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_municipio($datos,$part,$subpart)
{
global $parametros , $conexion ;
    $sentencia = "update munici SET nomb_ciudad = '".$datos['Nombre']."' WHERE cod_depto = '$part' and cod_ciudad='$subpart'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_municipios_cmb($part)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto 'Codd', cod_ciudad 'Codigo', Nomb_ciudad 'Nombre' FROM munici where cod_depto='$part'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartidas_cmb2($bodega,$part)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas del sistema para poblar combobox
    $sentencia = "select idsubpartida 'Codigo', substr(nombre,1,90) 'Nombre' FROM subpartidas where idpartida='$part' and idproyecto='$bodega'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_subpartidas_cmbdos()
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas del sistema para poblar combobox
    $sentencia = "select idsubpartida 'Codigo', Nombre 'Nombre' FROM subpartidas";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_subpartidas_cmbtres($bodega,$partida)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas del sistema para poblar combobox
	//buscando el proyecto

        $xproye="";
        $sentencia="select idproyecto from bodegas where idbodegas='".$bodega."'"; 
        $resultado2 = mysql_query($sentencia);
        if(isset($resultado2))
         {
          if(mysql_num_rows ( $resultado2 )!=0)
           {
            $filax=mysql_fetch_array($resultado2);
	    $xproye=$filax['idproyecto'];
           }
         }

    $sentencia = "select idsubpartida 'Codigo', Nombre 'Nombre' FROM subpartidas where idpartida='".$partida."' and idproyecto='".$xproye."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



function dat_validar_existencia_municipio($part,$subpart)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_ciudad 'Codigo' FROM munici where cod_depto='".$part."' and cod_ciudad='".$subpart."'";  
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
function dat_validar_existencia_municipio_a1($cod,$subpart)
{
global $parametros , $conexion ;
    $sentencia = "select cod_ciudad 'Codigo' FROM canton where cod_depto='".$cod."' and  cod_ciudad='".$subpart."'";  
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