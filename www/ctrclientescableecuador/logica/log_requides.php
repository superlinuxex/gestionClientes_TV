<?php
//importando clase superiores
include 'datos/dat_requides.php';

function log_validar_entrada($id)
{
	return dat_validar_entrada($id);
	exit;
}

function log_insertar_requibc($Encabezado)
{
	return dat_insertar_requibc($Encabezado);
	exit;
}

function log_eliminar_entrada($id)
{
	return dat_eliminar_entrada($id);
	exit;
}

function log_obtener_requides_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_requides_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_requides($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_requides($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_requides_detalle($codigo)
{
	return dat_obtener_num_requides_detalle($codigo);
	exit;
}

function log_insertar_requides_detalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_requides_detalle($datos,$bodega,$Encabezado);
	exit;
}

function log_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
	return dat_insertar_existencia($bodega,$producto,$cant,$codentrada,precio,$estado);
	exit;
}

function log_actualizar_requides_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_requides_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_requides_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
	return dat_eliminar_requides_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado);
	exit;
}

function log_obtener_cod_requides()
{
	return dat_obtener_cod_requides();
	exit;
}

function log_obtener_requides($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_requides($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_requides_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_requides_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_requides_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_requides_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_requides($bodega,$filtro)
{
	return dat_obtener_num_requides($bodega,$filtro);
	exit;
}

function log_obtener_requides_id($id)
{
	return dat_obtener_requides_id($id);
	exit;
}

function log_actualizar_requides($datos,$tipo,$registro)
{
	return dat_actualizar_requides($datos,$tipo,$registro);
	exit;
}

function log_generar_transfer($bodega,$datos,$tipo)
{
        return dat_generar_transfer($bodega,$datos,$tipo);
	exit;
}

function log_ve_estatus_requi($cod_encabezado)
{
        return dat_ve_estatus_requi($cod_encabezado);
	exit;
}


?>