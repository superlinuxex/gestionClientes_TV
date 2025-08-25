<?php
require "dat_base.php";  

function dat_obtener_caserios($part,$subpart,$subpart_a,$subpart_b)
{
global $parametros , $conexion ;

    $sentencia = "select a.cod_caserio Codigo, b.nombrebarrio 'Localidad',a.nombrecaserio 'Urbanizacion'
					from caserio a, barrios b
					where a.cod_depto=b.cod_depto and  a.cod_ciudad=b.cod_ciudad and a.cod_canton=b.cod_canton and a.cod_barrio=b.cod_barrio
					and a.cod_depto='$part' and a.cod_ciudad='$subpart' and a.cod_canton='$subpart_a' and a.cod_barrio='$subpart_b'
					order by a.cod_caserio"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_caserio Codigo, a.nombrecaserio Nombre
					from caserio a where a.cod_depto='$part' and a.cod_ciudad='$subpart' 
					and a.cod_canton='$subpart_a' and a.cod_barrio='$subpart_b' and a.cod_caserio='$subpart_c'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_insertar_caserios($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into caserio (cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,nombrecaserio) 
					VALUES ('".$datos['Depto']."','".$datos['Municipio']."','".$datos['Canton']."','".$datos['Barrio']."','".$datos['Codigo']."','".$datos['Nombre']."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
global $parametros , $conexion ;
    $sentencia = "delete from  caserio where cod_depto='$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a' and cod_barrio='$subpart_b' and cod_caserio='$subpart_c'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_caserio($datos,$part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
global $parametros , $conexion ;
    $sentencia = "update caserio SET nombrecaserio = '".$datos['Nombre']."'
					WHERE cod_depto = '$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a' and cod_barrio='$subpart_b' and cod_caserio='$subpart_c'"; 
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_caserio_cmb($part,$spart,$spart_a,$spart_b)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto 'Codd', cod_ciudad 'Codmuni',cod_canton 'Codcan',cod_barrio 'Codbar',cod_caserio 'Codigo', nombrecaserio 'Nombre' FROM caserio where cod_depto='$part' and cod_ciudad='$spart' and cod_canton='$spart_a' and cod_barrio='$spart_b'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_caserios_cmb2($part,$spart,$spart_a,$spart_b)
{
global $parametros , $conexion ;
    $sentencia = "select cod_caserio 'Codigo', nombrecaserio 'Nombre' FROM caserio where cod_depto='$part' and cod_ciudad='$spart' and cod_canton='$spart_a' and cod_barrio='$spart_b'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_caserio_cmb2()
{
	global $parametros , $conexion ;
    $sentencia = "select cod_caserio 'Codigo', nombrecaserio 'Nombre' FROM caserio";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_caserio_cmbtres($bodega,$partida,$subpartida,$subpartida_a)
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


function dat_validar_existencia_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
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

function dat_validar_existencia_caserio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_caserio 'Codigo' FROM clientes where cod_depto='".$part."' and cod_ciudad='".$subpart."' and  cod_canton='".$subpart_a."' and cod_barrio='".$subpart_b."' and cod_caserio='".$subpart_c."'";  
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