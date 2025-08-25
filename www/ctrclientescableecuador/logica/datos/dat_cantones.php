<?php
require "dat_base.php";  

function dat_obtener_canton($part,$subpart)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_canton Codigo, b.nomb_ciudad 'Municipio',a.nombrecant Poblacion
					from canton a, munici b 
					where a.cod_depto=b.cod_depto and a.cod_ciudad=b.cod_ciudad 
					and b.cod_depto='$part' 
					and a.cod_ciudad='$subpart' order by a.cod_canton"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_cantones($part,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_canton Codigo, a.nombrecant Nombre
					from canton a where a.cod_depto='$part' and a.cod_ciudad='$subpart' 
					and  a.cod_canton='$subpart_a'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_canton_sub($part,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
    $sentencia = $sentencia = "select a.cod_canton Codigo, b.nomb_ciudad 'Ciudad', a.nombrecant Zona
					from canton a, munici b
					where a.cod_depto=b.cod_depto and a.cod_ciudad=b.cod_ciudad
					and b.cod_depto='$part' and a.cod_ciudad='$subpart' and a.cod_canton='$subpart_a'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_cantones()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM canton";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_canton($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into canton (cod_depto,cod_ciudad,cod_canton,nombrecant) 
					VALUES ('".$datos['Depto']."','".$datos['Municipio']."','".$datos['Codigo']."','".$datos['Nombre']."')";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_canton($part,$subpart,$subpart_a)
{
global $parametros , $conexion ;
    $sentencia = "delete from  canton where cod_depto='$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_canton($datos,$part,$subpart,$subpart_a) 
{
global $parametros , $conexion ;
    $sentencia = "update canton SET nombrecant = '".$datos['Nombre']."'  
					WHERE cod_depto = '$part' and cod_ciudad='$subpart' and cod_canton='$subpart_a'"; 
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_cantones_cmb($part,$spart)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto 'Codd', cod_ciudad 'Codmuni', cod_canton 'Codigo', nombrecant 'Nombre' FROM canton where cod_depto='$part' and cod_ciudad='$spart'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_subpartidas_a_cmb2($bodega,$part,$spart)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_a del sistema para poblar combobox
    $sentencia = "select idsubpartida_a 'Codigo', substr(nombre,1,90) 'Nombre' FROM subpartidas_a where idproyecto='$bodega' and idpartida='$part' and idsubpartida='$spart'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_subpartidas_a_cmbdos()
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_a del sistema para poblar combobox
    $sentencia = "select idsubpartida_a 'Codigo', nombre 'Nombre' FROM subpartidas_a";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartidas_a_cmbtres($bodega,$partida,$subpartida)
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

    $sentencia = "select idsubpartida_A 'Codigo', Nombre 'Nombre' FROM subpartidas_a where idsubpartida='".$subpartida."' and idpartida='".$partida."' and idproyecto='".$xproye."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



function dat_validar_existencia_canton($part,$subpart,$subpart_a)
{
    global $parametros , $conexion ;
    $sentencia = "select cod_canton 'Codigo' FROM canton where cod_depto='".$part."' and cod_ciudad='".$subpart."' and  cod_canton='".$subpart_a."'";  
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
function dat_validar_existencia_canton_b1($cod,$subpart,$subpart_a)
{
    global $parametros , $conexion ;
    $sentencia = "select cod_canton 'Codigo' FROM barrios where cod_depto='".$cod."' and cod_ciudad='".$subpart."' and cod_canton='".$subpart_a."'";  
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