<?php
require "dat_base.php";  

function dat_obtener_kardextot($comienzo, $cant,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Codigo, a.descripcion Descripcion, a.cantidad 'Exist.Nuevo',a.cantidadusa 'Exist.Usado', a.unidadmed UMedida, b.nombre Sucursal
          FROM existenciaprod a left join bodegas b ON a.idbodegas = b.idbodegas  order by a.idarticulos LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_kardextot_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Codigo, a.descripcion Descripcion, a.cantidad 'Exist.Nuevo',a.cantidadusa 'Exist.Usado', a.unidadmed UMedida, b.nombre Sucursal 
          FROM existenciaprod a left join bodegas b ON a.idbodegas = b.idbodegas where a.idarticulos like '%".$filtro."%' or a.descripcion like '%".$filtro."%'
          order by a.descripcion LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_kardex2tot($id,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Codigo, a.descripcion Descripcion, a.cantidad Existencia
          FROM existenciaprod a where a.idbodegas='".$bodega."' and a.idarticulos='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_kardextot($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM existenciaprod";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_kardextot_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM existenciaprod where idarticulos like '%".$filtro."%' or descripcion like '%".$filtro."%'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_kardextot($datos,$bode,$usuario)
{
global $parametros , $conexion ;



	//inserta un registro en la tabla de identificacion de clientes
    $sentencia = "insert into clientesateli (codigo,nombres,apellidos,sexo,ruc,dni,direccion,email,telefono,celular,usuario,sucursal,fechareg,actividad,ciudad) 
					VALUES ('".$datos['Codigo']."','".$datos['Nombres']."','".$datos['Apellidos']."','".$datos['Sexo']."','".$datos['Ruc']."','".$datos['Dni']."','".$datos['Direccion']."','".$datos['Email']."',
                                    '".$datos['Telefono']."','".$datos['Celular']."','".$usuario."','".$bode."',now(),'".$datos['Actividad']."','".$datos['Distrito']."')";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_kardextot($id,$bodega)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de clientes
    $sentencia = "delete from  clientesateli where sucursal='".$bodega."' and codigo='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_kardextot($datos, $id,$bodega)
{
global $parametros , $conexion ;
	//obtine total de registros 

$sentencia = "update clientesateli SET codigo = '".$datos['Codigo']."', nombres='".$datos['Nombres']."',apellidos= '".$datos['Apellidos']."',
                  direccion='".$datos['Direccion']."',telefono='".$datos['Telefono']."',celular='".$datos['Celular']."',
                  ruc='".$datos['Ruc']."',dni='".$datos['Dni']."',actividad='".$datos['Actividad']."',email='".$datos['Email']."'	
	          WHERE sucursal='".$bodega."' and codigo= '$id';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_kardextot_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select codigo 'Codigo',nombres 'Nombre', apellidos 'Apellidos' FROM clientesateli where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_kardextot_cmbZZZ()
{
	global $parametros , $conexion ;
	$sentencia = "select codigo 'Codigo',nombres 'Nombre', apellidos 'Apellidos' FROM clientesateli";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_veexisreg_kardextot($datos,$bodega)
{
	global $parametros , $conexion ;
	$codbuscar=$datos['Codigo'];
	$sentencia = "select codigo FROM clientesateli where codigo='".$codbuscar."' and sucursal='".$bodega."'";  
    	$resultado = mysql_query($sentencia);
    	return $resultado;
	exit;
}


function dat_obtener_articulostot_cmb_filtro($prod)
{
	global $parametros , $conexion ;
	//obtine la lista de articulos del sistema para poblar combobox
	//$sentencia = "select idarticulos 'Codigo', concat(idarticulos,' - ',descripcion) 'Nombre' FROM articulos  
    $sentencia = "select idarticulos 'Codigo', descripcion 'Nombre' FROM articulos
					where idarticulos like '%".$prod."%' or descripcion like '%".$prod."%'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_articulostot_x_bodega_cmb($bodega)
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