<?php
require "dat_base.php";  

function dat_obtener_barrios($part,$subpart,$subpart_a)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_barrio Codigo, b.nombrecant 'Zona',a.nombrebarrio 'Localidad'
					from barrios a, canton b
					where a.cod_depto=b.cod_depto and  a.cod_ciudad=b.cod_ciudad and a.cod_canton=b.cod_canton
					and a.cod_depto='$part' and a.cod_ciudad='$subpart' and a.cod_canton='$subpart_a'
					order by a.cod_barrio"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_barrio($part,$subpart,$subpart_a,$subpart_b)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_barrio Codigo, a.nombrebarrio Nombre
					from barrios a where a.cod_depto='$part' and a.cod_ciudad='$subpart' 
					and a.cod_canton='$subpart_a' and a.cod_barrio='$subpart_b'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_insertar_barrio($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into barrios (cod_depto,cod_ciudad,cod_canton,cod_barrio,nombrebarrio) 
					VALUES ('".$datos['Depto']."','".$datos['Municipio']."','".$datos['Canton']."','".$datos['Codigo']."','".$datos['Nombre']."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_barrios($part,$subpart,$subpart_a,$subpart_b)
{
global $parametros , $conexion ;
    $sentencia = "delete from  barrios where cod_depto='$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a' and cod_barrio='$subpart_b'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_barrio($datos,$part,$subpart,$subpart_a,$subpart_b)
{
global $parametros , $conexion ;
    $sentencia = "update barrios SET nombrebarrio = '".$datos['Nombre']."'
					WHERE cod_depto = '$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a' and cod_barrio='$subpart_b'"; 
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_barrios_cmb($part,$spart,$spart_a)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto 'Codd', cod_ciudad 'Codmuni', cod_canton 'Codcan',cod_barrio 'Codigo', nombrebarrio 'Nombre' FROM barrios where cod_depto='$part' and cod_ciudad='$spart' and cod_canton='$spart_a'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_b del sistema para poblar combobox
    $sentencia = "select idsubpartida_b 'Codigo', substr(nombre,1,90) 'Nombre' FROM subpartidas_b where idproyecto='$bodega' and idpartida='$part' and idsubpartida='$spart' and idsubpartida_a='$spart_a'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartidas_b_cmbdos()
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_b del sistema para poblar combobox
    $sentencia = "select idsubpartida_b 'Codigo', nombre 'Nombre' FROM subpartidas_b";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartidas_b_cmbtres($bodega,$partida,$subpartida,$subpartida_a)
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

    $sentencia = "select idsubpartida_b 'Codigo', Nombre 'Nombre' FROM subpartidas_b where idsubpartida_a='".$subpartida_a."' and idsubpartida='".$subpartida."' and idpartida='".$partida."' and idproyecto='".$xproye."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_validar_existencia_barrio($part,$subpart,$subpart_a,$subpart_b)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_barrio 'Codigo' FROM barrios where cod_depto='".$part."' and cod_ciudad='".$subpart."' and  cod_canton='".$subpart_a."' and cod_barrio='".$subpart_b."'";  
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

function dat_validar_existencia_barrio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_caserio 'Codigo' FROM caserio where cod_depto='".$part."' and cod_ciudad='".$subpart."' and  cod_canton='".$subpart_a."' and cod_barrio='".$subpart_b."' and cod_caserio='".$subpart_c."'";  
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

function dat_obtener_barrios_sub($part,$subpart,$subpart_a,$subpart_b)
{
	global $parametros , $conexion ;
    $sentencia = $sentencia = "select a.cod_barrio Codigo, b.nombrecant 'Zona', a.nombrebarrio Localidad
					from barrios a, canton b
					where a.cod_depto=b.cod_depto and a.cod_ciudad=b.cod_ciudad and a.cod_canton=b.cod_canton
					and b.cod_depto='$part' and a.cod_ciudad='$subpart' and a.cod_canton='$subpart_a' and a.cod_barrio='$subpart_b'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}




?>