<?php
//importando clase superiores
include 'datos/dat_revistrans.php';

function log_validar_revistrans($id)
{
	return dat_validar_revistrans($id);
	exit;
}

function log_insertar_revistrans($Encabezado)
{
	return dat_insertar_revistrans($Encabezado);
	exit;
}

function log_eliminar_revistrans($id)
{
	return dat_eliminar_revistrans($id);
	exit;
}

function log_obtener_revistrans_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_revistrans_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_revistrans($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_revistrans($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_revistrans_detalle($codigo)
{
	return dat_obtener_num_revistrans_detalle($codigo);
	exit;
}

function log_insertar_revistrans_detalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_revistrans_detalle($datos,$bodega,$Encabezado);
	exit;
}

function log_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
	return dat_insertar_existencia($bodega,$producto,$cant,$codentrada,precio,$estado);
	exit;
}

function log_actualizar_revistrans_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_revistrans_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_revistrans_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
	return dat_eliminar_revistrans_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado);
	exit;
}

function log_obtener_cod_revistrans()
{
	return dat_obtener_cod_revistrans();
	exit;
}

function log_obtener_revistrans($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_revistrans($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_revistrans_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_revistrans_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_revistrans_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_revistrans_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_revistrans($bodega,$filtro)
{
	return dat_obtener_num_revistrans($bodega,$filtro);
	exit;
}

function log_obtener_revistrans_id($id)
{
	return dat_obtener_revistrans_id($id);
	exit;
}

function log_actualizar_revistrans($datos,$tipo,$registro)
{
	return dat_actualizar_revistrans($datos,$tipo,$registro);
	exit;
}

function log_generar_revistrans($bodega,$datos,$tipo)
{
        return dat_generar_revistrans($bodega,$datos,$tipo);
	exit;
}

function log_ve_estatus_trans($cod_encabezado)
{
        return dat_ve_estatus_trans($cod_encabezado);
	exit;
}


?>