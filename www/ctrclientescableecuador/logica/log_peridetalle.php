<?php
//importando clase superiores
include 'datos/dat_peridetalle.php';

function log_validar_peridetalle($id)
{
	return dat_validar_peridetalle($id);
	exit;
}

function log_insertar_peridetalle($datos,$bodega)
{
	return dat_insertar_peridetalle($datos,$bodega);
	exit;
}

function log_eliminar_peridetalleuno($id)
{
	return dat_eliminar_peridetalleuno($id);
	exit;
}

function log_obtener_entradas_peridetalle($comienzo, $cant,$codigo)
{
	return dat_obtener_entradas_peridetalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_peridetalle($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_peridetalle($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_entradas_peridetalle($codigo)
{
	return dat_obtener_num_entradas_peridetalle($codigo);
	exit;
}

function log_insertar_entrada_peridetalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_entrada_peridetalle($datos,$bodega,$Encabezado);
	exit;
}

function log_actualizar_peridetalle_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_peridetalle_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_peridetalle($id)
{
	return dat_eliminar_peridetalle($id);
	exit;
}

function log_obtener_cod_peridetalle()
{
	return dat_obtener_cod_peridetalle();
	exit;
}

function log_obtener_peridetalle($bodega,$comienzo,$cant,$clie)
{
	return dat_obtener_peridetalle($bodega,$comienzo, $cant,$clie);
	exit;
}


function log_obtener_peridetalle_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_peridetalle_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_peridetalle_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_peridetalle_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_peridetalle($bodega,$filtro)
{
	return dat_obtener_num_peridetalle($bodega,$filtro);
	exit;
}

function log_obtener_peridetalleuno($id)
{
	return dat_obtener_peridetalleuno($id);
	exit;
}

function log_actualizar_peridetalle($datos,$tipo)
{
	return dat_actualizar_peridetalle($datos,$tipo);
	exit;
}





?>