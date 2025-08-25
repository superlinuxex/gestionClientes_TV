<?php
//importando clase superiores
include 'datos/dat_entradasasuc.php';

function log_validar_entradaasuc($id)
{
	return dat_validar_entradaasuc($id);
	exit;
}

function log_insertar_entradaasuc($Encabezado)
{
	return dat_insertar_entradaasuc($Encabezado);
	exit;
}

function log_eliminar_entradaasuc($id)
{
	return dat_eliminar_entradaasuc($id);
	exit;
}

function log_obtener_entradasasuc_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_entradasasuc_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_entradaasuc($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_entradaasuc($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_entradasasuc_detalle($codigo)
{
	return dat_obtener_num_entradasasuc_detalle($codigo);
	exit;
}

function log_insertar_entradaasuc_detalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_entradaasuc_detalle($datos,$bodega,$Encabezado);
	exit;
}

function log_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
	return dat_insertar_existencia($bodega,$producto,$cant,$codentrada,precio,$estado);
	exit;
}

function log_actualizar_entradaasuc_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_entradaasuc_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_entradaasuc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
	return dat_eliminar_entradaasuc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado);
	exit;
}

function log_obtener_cod_entradaasuc()
{
	return dat_obtener_cod_entradaasuc();
	exit;
}

function log_obtener_entradasasuc($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_entradasasuc($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_entradasasuc_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_entradasasuc_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_entradasasuc_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_entradasasuc_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_entradasasuc($bodega,$filtro)
{
	return dat_obtener_num_entradasasuc($bodega,$filtro);
	exit;
}

function log_obtener_entradaasuc($id)
{
	return dat_obtener_entradaasuc($id);
	exit;
}

function log_actualizar_entradaasuc($datos,$tipo)
{
	return dat_actualizar_entradaasuc($datos,$tipo);
	exit;
}





?>