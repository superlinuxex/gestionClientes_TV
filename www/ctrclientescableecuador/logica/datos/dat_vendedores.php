<?php
require "dat_base.php";  

function dat_obtener_vendedores($comienzo, $cant,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_emple Codigo, nombre Nombre, a.apellido Apellido, case a.tipoe when 1 then 'Administrativo' 
          when 2 then 'Tecnico' when 3 then 'Comercializacion' end Clase, a.telefono Telefono, a.email Email,case a.estado when 1 then 'Activo' when 2 then 'Inactivo' end Estado
          FROM empleados a order by a.nombre LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_emple Codigo, a.nombre Nombre, a.apellido Apellido, case a.tipoe when 1 then 'Administrativo' 
          when 2 then 'Tecnico' when 3 then 'Comercializacion' end Clase, a.telefono Telefono, a.email Email, case a.estado when 1 then 'Activo' when 2 then 'Inactivo' end Estado 
         FROM empleados a where  a.cod_emple like '%".$filtro."%' or a.apellido like '%".$filtro."%'
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores2($id,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_emple Codigo, a.nombre Nombres,a.apellido Apellidos, a.direccion Direccion,a.telefono Telefono, a.cargo Cargo, tipoe Tipoe, email Email, estado Estado, sucursal Bodega
          FROM empleados a where a.cod_emple='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_vendedores($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM empleados ";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_vendedores_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM empleados where cod_emple like '%".$filtro."%' or apellido like '%".$filtro."%'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_vendedores($datos,$bode,$usuario)
{
global $parametros , $conexion ;
$estado="1";
$xcodigocli=(int)$datos['Codigo'];
    $sentencia = "insert into empleados (cod_emple,nombre,apellido,direccion,telefono,cargo,tipoe,email,sucursal,estado) VALUES ('".$xcodigocli."','".$datos['Nombres']."','".$datos['Apellidos']."','".$datos['Direccion']."','".$datos['Telefono']."','".$datos['Cargo']."','".$datos['Tipoe']."','".$datos['Email']."','".$datos['Bodega']."','".$estado."')";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_vendedores($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "delete from  empleados where cod_emple='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_vendedores($datos, $id,$bodega)
{
global $parametros , $conexion ;

$sentencia = "update empleados SET nombre='".$datos['Nombres']."',apellido='".$datos['Apellidos']."',direccion='".$datos['Direccion']."',telefono='".$datos['Telefono']."',cargo='".$datos['Cargo']."',tipoe='".$datos['Tipoe']."',email='".$datos['Email']."',estado='".$datos['Estado']."',sucursal='".$datos['Bodega']."'	
	          WHERE cod_emple= '$id';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_vendedores_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select cod_emple 'Codigo',nombre 'Nombre',apellido 'Apellido' FROM empleados where estado=1 and sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores_cmb1()
{
	global $parametros , $conexion ;
	$sentencia = "select cod_emple 'Codigo',nombre 'Nombre',apellido 'Apellido' FROM empleados where estado=1";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores_cmb2()
{
	global $parametros , $conexion ;
	$sentencia = "select cod_emple 'Codigo',nombre 'Nombre',apellido 'Apellido' FROM empleados";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores_cmb33()
{
//filtra solo tecnicos de todas las sucursales
$bandera1="2";
	global $parametros , $conexion ;
	$sentencia = "select cod_emple 'Codigo',nombre 'Nombre',apellido 'Apellido' FROM empleados where estado=1 and tipoe='".$bandera1."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_veexisreg_vendedores($datos,$bodega)
{
	global $parametros , $conexion ;
	$codbuscar=$datos['Codigo'];
	$sentencia = "select codigo FROM empleados where codigo='".$codbuscar."' and sucursal='".$bodega."'";  
    	$resultado = mysql_query($sentencia);
    	return $resultado;
	exit;
}


function dat_obtener_vendedores_cmb_filtro($prod)
{
	global $parametros , $conexion ;
    $sentencia = "select idarticulos 'Codigo', descripcion 'Nombre' FROM articulos
					where idarticulos like '%".$prod."%' or descripcion like '%".$prod."%'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_vendedores_x_bodega_cmb($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de articulos del sistema para poblar combobox
    $sentencia = "select a.idarticulo Codigo, b.descripcion Nombre FROM existencias a, articulos b
					where a.idarticulo = b.idarticulos and a.idbodega='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
?>