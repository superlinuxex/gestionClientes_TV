<?php
//importando clase superiores
include 'datos/dat_reqsucursal.php';

function log_validar_requibc($id)
{
	return dat_validar_requibc($id);
	exit;
}

function log_insertar_requibc($Encabezado)
{
	return dat_insertar_requibc($Encabezado);
	exit;
}

function log_eliminar_requibc($id)
{
	return dat_eliminar_requibc($id);
	exit;
}

function log_obtener_requibc_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_requibc_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_requibc($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_requibc($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_requibc_detalle($codigo)
{
	return dat_obtener_num_requibc_detalle($codigo);
	exit;
}

function log_insertar_requibc_detalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_requibc_detalle($datos,$bodega,$Encabezado);
	exit;
}

function log_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
	return dat_insertar_existencia($bodega,$producto,$cant,$codentrada,precio,$estado);
	exit;
}

function log_actualizar_requibc_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_requibc_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_requibc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
	return dat_eliminar_requibc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado);
	exit;
}

function log_obtener_cod_requibc()
{
	return dat_obtener_cod_requibc();
	exit;
}

function log_obtener_requibc($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_requibc($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_requibc_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_requibc_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_requibc_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_requibc_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_requibc($bodega,$filtro)
{
	return dat_obtener_num_requibc($bodega,$filtro);
	exit;
}

function log_obtener_requibc_id($id)
{
	return dat_obtener_requibc_id($id);
	exit;
}

function log_actualizar_requibc($datos,$tipo)
{
	return dat_actualizar_requibc($datos,$tipo);
	exit;
}





?>