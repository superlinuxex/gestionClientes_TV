<?php
require "dat_base.php";  

function dat_obtener_subpartidas_b($part,$div,$pro,$subpart,$subpart_a)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas b
    $sentencia = "select a.idsubpartida_b Codigo, b.Nombre 'Sub-Partida A',
					c.nombre Division, d.nombre Proyecto, a.Nombre Nombre, 
					a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas_b a, subpartidas_a b, divisiones c,  proyectos d
					where a.idpartida=b.idpartida and  a.idsubpartida=b.idsubpartida and a.idsubpartida_a=b.idsubpartida_A
					and a.iddivision=b.iddivision and a.idproyecto=b.idproyecto
					and a.iddivision=c.iddivisiones and a.idproyecto=d.idproyectos
					and a.idpartida='$part' and a.idsubpartida='$subpart' and a.idsubpartida_a='$subpart_a'
					and a.iddivision='$div' and a.idproyecto='$pro'
					order by a.idsubpartida_b"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
	global $parametros , $conexion ;
	//obtine un subpartida b
    $sentencia = "select a.idsubpartida_b Codigo, a.iddivision Division, a.idproyecto Proyecto,
					a.Nombre Nombre, a.cargos Cargos, a.abonos Abonos, a.saldo Saldo
					from subpartidas_b a where a.iddivision='$div' and a.idproyecto='$pro' and a.idpartida='$part' and a.idsubpartida='$subpart' 
					and a.idsubpartida_a='$subpart_a' and a.idsubpartida_b='$subpart_b'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_insertar_subpartida_b($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de subpartidas_b
	
    $sentencia = "insert into subpartidas_b (idpartida,idsubpartida,idsubpartida_a,idsubpartida_b,iddivision,idproyecto,Nombre,cargos,abonos,saldo) 
					VALUES ('".$datos['Partida']."','".$datos['SubPartida']."','".$datos['SubPartida_a']."','".$datos['Codigo']."',
					'".$datos['Division']."','".$datos['Proyecto']."','".$datos['Nombre']."',0,
					".$datos['Abonos'].",0);					";
					
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de subpartidas
    $sentencia = "delete from  subpartidas_b where iddivision='$div' and idproyecto='$pro' and idpartida='$part' and idsubpartida='$subpart' and idsubpartida_a='$subpart_a' and idsubpartida_b='$subpart_b'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_subpartida_b($datos,$part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla partidas
    $sentencia = "update subpartidas_b SET Nombre = '".$datos['Nombre']."', abonos = ".$datos['Abonos']." 
					WHERE iddivision='$div' and idproyecto='$pro' and idpartida = '$part' and idsubpartida='$subpart' and idsubpartida_a='$subpart_a' and idsubpartida_b='$subpart_b'"; 
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_subpartidas_b_cmb($part,$spart,$spart_a)
{
	global $parametros , $conexion ;
	//obtine la lista de subpartidas_b del sistema para poblar combobox
    $sentencia = "select idsubpartida_b 'Codigo', nombre 'Nombre' FROM subpartidas_b where idpartida='$part' and idsubpartida='$spart' and idsubpartida_a='$spart_a'";  
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


function dat_validar_existencia_subpartida_b($part,$subpart,$subpart_a,$subpart_b,$division,$proyecto)
{
	global $parametros , $conexion ;
	//obtine la lista de partidas del sistema para poblar combobox
    $sentencia = "select idpartida 'Codigo' FROM subpartidas_b where iddivision='".$division."' and idproyecto='".$proyecto."' and idpartida='".$part."' and iddivision='".$division."' and idproyecto='".$proyecto."' and idsubpartida='".$subpart."' and  idsubpartida_a='".$subpart_a."' and idsubpartida_b='".$subpart_b."'";  
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