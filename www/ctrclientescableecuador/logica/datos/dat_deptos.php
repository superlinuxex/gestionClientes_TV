<?php
require "dat_base.php";  

function dat_obtener_deptos_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto Codigo, nom_depto Nombre from deptos
					order by nom_depto";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_deptos($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_depto 'Codigo', nom_depto 'Nombre' FROM deptos
				  order by cod_depto LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_depto($id)
{
	global $parametros , $conexion ;
 $sentencia = "select cod_depto 'Codigo', nom_depto 'Nombre' FROM deptos
				  where cod_depto='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_deptos()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM deptos";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_deptos($datos)
{
global $parametros , $conexion ;
    $sentencia = "insert into deptos (cod_depto,nom_depto)
					values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_deptos($id)
{
global $parametros , $conexion ;
    $hay="";
    $rr=0;
    $sentencia = "select cod_depto from munici where cod_depto='$id'"; 
    $resultado = mysql_query($sentencia);
    if(isset($resultado))
     {
      if(mysql_num_rows ( $resultado )!=0)
	{
            $row=mysql_fetch_array($resultado);
	    $hay=$row['cod_depto'];
        }
     }
     if($hay!="")
      {
       $rr=1;
       $error=0;
      }
if($rr==0)
{
    $sentencia = "delete from  deptos where cod_depto='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
}
	return $error;
	exit;
}

function dat_actualizar_deptos($datos, $id)
{
global $parametros , $conexion ;
    $sentencia = "update deptos set nom_depto='".$datos['Nombre']."',cod_depto='".$datos['Codigo']."' where cod_depto='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>