<?php
require "dat_base.php";  

function dat_obtener_subpartidas($id,$div,$pro)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas
    $sentencia = "select a.idsubpartida Codigo, b.Nombre Partida, c.nombre Division, d.nombre Proyecto,
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas a, partidas b, divisiones c, proyectos d
					where a.idpartida=b.idpartida and a.iddivision=b.iddivision and a.idproyecto=b.idproyecto
					and a.iddivision = c.iddivisiones and a.idproyecto = d.idproyectos
					and a.idpartida='$id' and b.iddivision='$div' and b.idproyecto='$pro' order by a.idsubpartida"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartida($part,$div,$pro,$subpart)
{
	global $parametros , $conexion ;
	//obtine un subpartida
    $sentencia = "select a.idsubpartida Codigo, a.iddivision Division, a.idproyecto Proyecto,
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas a where a.idpartida='$part' and a.idsubpartida='$subpart'
					and a.iddivision='$div' and a.idproyecto='$pro' "; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartida_sub($part,$div,$pro,$subpart)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas
    $sentencia = "select a.idsubpartida Codigo, b.Nombre Partida, c.nombre Division, d.nombre Proyecto,
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas a, partidas b, divisiones c, proyectos d
					where a.idpartida=b.idpartida and a.iddivision=b.iddivision and a.idproyecto=b.idproyecto
					and a.iddivision = c.iddivisiones and a.idproyecto = d.idproyectos
					and a.idpartida='$part' and a.iddivision='$div' and a.idproyecto='$pro' and a.idsubpartida='$subpart'"; 
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

function dat_insertar_subpartida($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de partidas
    $sentencia = "insert into subpartidas (idsubpartida,idpartida,iddivision,idproyecto,Nombre,cargos,abonos,saldo) 
					VALUES ('".$datos['Codigo']."','".$datos['Partida']."','".$datos['Division']."','".$datos['Proyecto']."',
					'".$datos['Nombre']."',0,".$datos['Abonos'].",0)";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_subpartida($part,$div,$pro,$subpart)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de subpartidas
    $sentencia = "delete from  subpartidas where idpartida='$part' and iddivision='$div' and idproyecto='$pro' and idsubpartida='$subpart'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_subpartida($datos,$part,$div,$pro,$subpart)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "update subpartidas SET Nombre = '".$datos['Nombre']."', abonos = ".$datos['Abonos']." WHERE idpartida = '$part' 
					and iddivision='$div' and idproyecto='$pro' and idsubpartida='$subpart'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_obtener_subpartidas_cmb($part)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas del sistema para poblar combobox
    $sentencia = "select idsubpartida 'Codigo', Nombre 'Nombre' FROM subpartidas where idpartida='$part'";  
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



function dat_validar_existencia_subpartida($part,$subpart,$division,$proyecto)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo' FROM subpartidas where idpartida='".$part."' and iddivision='".$division."' and idproyecto='".$proyecto."' and idsubpartida='".$subpart."'";  
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
function dat_validar_existencia_subpartida_a1($cod,$division,$proyecto,$subpart)
{
	global $parametros , $conexion ;
	//validar si existe un registro hijo
    $sentencia = "select idsubpartida 'Codigo' FROM subpartidas_a where idpartida='".$cod."' and iddivision='".$division."' and idproyecto='".$proyecto."' and idsubpartida='".$subpart."'";  
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