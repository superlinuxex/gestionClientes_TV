<?php
require "dat_base.php";  

function dat_obtener_subpartidas_a($part,$div,$pro,$subpart)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas
    $sentencia = "select a.idsubpartida_A Codigo, b.nombre 'Sub-Partida', c.nombre Division,
					d.nombre Proyecto, a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas_a a, subpartidas b, divisiones c, proyectos d
					where a.idpartida=b.idpartida and a.idsubpartida=b.idsubpartida 
					and a.iddivision=b.iddivision and a.idproyecto=b.idproyecto
					and a.iddivision=c.iddivisiones and a.idproyecto=d.idproyectos
					and b.idpartida='$part' and a.iddivision='$div' and a.idproyecto='$pro'
					and a.idsubpartida='$subpart' order by a.idsubpartida_A"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartida_a($part,$div,$pro,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
	//obtine un subpartida
    $sentencia = "select a.idsubpartida_A Codigo, a.iddivision Division, a.idproyecto Proyecto,
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas_a a where a.idpartida='$part' and a.idsubpartida='$subpart' 
					and iddivision='$div' and idproyecto='$pro'	and  a.idsubpartida_a='$subpart_a'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartida_a_sub($part,$div,$pro,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas
    $sentencia = $sentencia = "select a.idsubpartida_A Codigo, b.nombre 'Sub-Partida', c.nombre Division,
					d.nombre Proyecto, a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas_a a, subpartidas b, divisiones c, proyectos d
					where a.idpartida=b.idpartida and a.idsubpartida=b.idsubpartida 
					and a.iddivision=b.iddivision and a.idproyecto=b.idproyecto
					and a.iddivision=c.iddivisiones and a.idproyecto=d.idproyectos
					and b.idpartida='$part' and a.idsubpartida='$subpart' and a.idsubpartida_A='$subpart_a'
					and a.iddivision='$div' and a.idproyecto='$pro'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_subpartidas_a()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "SELECT COUNT(*) FROM subpartidas_a";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_subpartida_a($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de subpartidas_a
	
    $sentencia = "insert into subpartidas_a (idpartida,idsubpartida,idsubpartida_A,iddivision,idproyecto,Nombre,cargos,abonos,saldo) 
					VALUES ('".$datos['Partida']."','".$datos['SubPartida']."','".$datos['Codigo']."','".$datos['Division']."','".$datos['Proyecto']."',
					'".$datos['Nombre']."',0,".$datos['Abonos'].",0)";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_subpartida_a($part,$div,$pro,$subpart,$subpart_a)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de subpartidas
    $sentencia = "delete from  subpartidas_a where iddivision='$div' and idproyecto='$pro' and idpartida='$part' and idsubpartida='$subpart' and idsubpartida_a='$subpart_a'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_subpartida_a($datos,$part,$div,$pro,$subpart,$subpart_a) 
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "update subpartidas_a SET Nombre = '".$datos['Nombre']."', abonos = ".$datos['Abonos']."  
					WHERE iddivision='$div' and idproyecto='$pro' and idpartida = '$part' and idsubpartida='$subpart' and idsubpartida_a='$subpart_a'"; 
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_subpartidas_a_cmb($part,$spart)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_a del sistema para poblar combobox
    $sentencia = "select idsubpartida_a 'Codigo', nombre 'Nombre' FROM subpartidas_a where idpartida='$part' and idsubpartida='$spart'";  
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



function dat_validar_existencia_subpartida_a($part,$subpart,$subpart_a,$division,$proyecto)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo' FROM subpartidas_a where idpartida='".$part."' and iddivision='".$division."' and idproyecto='".$proyecto."' and idsubpartida='".$subpart."' and  idsubpartida_a='".$subpart_a."'";  
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
function dat_validar_existencia_subpartida_b1($cod,$division,$proyecto,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
	//validar si existe un registro hijo
    $sentencia = "select idsubpartida_a 'Codigo' FROM subpartidas_b where idpartida='".$cod."' and iddivision='".$division."' and idproyecto='".$proyecto."' and idsubpartida='".$subpart."' and idsubpartida_a='".$subpart_a."'";  
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