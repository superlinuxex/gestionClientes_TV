<?php
require "dat_base.php";  

function dat_obtener_marcas_cmb()
{
    global $parametros , $conexion ;
    //obtiene la lista de bancos para  poblar combobox
    $sentencia = "select codigo Codigo, nombre Nombre from bancos
                    order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}
function dat_obtener_marcas($comienzo, $cant)
{
    global $parametros , $conexion ;
    //obtiene la lista de bancos del sistema
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM bancos
                  order by codigo LIMIT $comienzo, $cant";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_marca($id)
{
    global $parametros , $conexion ;
    //obtiene la lista de bancos del sistema
    $sentencia = "select codigo 'Codigo', nombre 'Nombre' FROM bancos
                  where codigo='$id'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_num_marcas()
{
    global $parametros , $conexion ;
    //obtiene total de registros de la tabla bancos
    $sentencia = "SELECT COUNT(*) FROM bancos";
    $resultado = mysql_query($sentencia);
    $total_registros = mysql_result($resultado,0,0);
    return $total_registros;
    exit;
}

function dat_insertar_marca($datos)
{
global $parametros , $conexion ;
    //obtiene total de registros de la tabla bancos
    $sentencia = "insert into bancos (codigo,nombre)
                    values('".$datos['Codigo']."','".$datos['Nombre']."');";  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_eliminar_marca($id)
{
global $parametros , $conexion ;
    //obtiene total de registros de la tabla bancos
    $sentencia = "delete from  bancos where codigo='$id';";
    $resultado = mysql_query($sentencia);
    $error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
    return $error;
    exit;
}

function dat_actualizar_marca($datos, $id)
{
global $parametros , $conexion ;
    //obtiene total de registros de la tabla bancos
    $sentencia = "update bancos set nombre='".$datos['Nombre']."',codigo='".$datos['Codigo']."' where codigo='".$id."';";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


?>