<?php
//importando clase superiores
include 'datos/dat_entradas.php';

function log_validar_entrada($id)
{
	return dat_validar_entrada($id);
	exit;
}

function log_insertar_entrada($Encabezado)
{
	return dat_insertar_entrada($Encabezado);
	exit;
}

function log_eliminar_entrada($id)
{
	return dat_eliminar_entrada($id);
	exit;
}

function log_obtener_entradas_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_entradas_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_entrada($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_entrada($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_entradas_detalle($codigo)
{
	return dat_obtener_num_entradas_detalle($codigo);
	exit;
}

function log_insertar_entrada_detalle($datos,$bodega,$Encabezado)
{
	return dat_insertar_entrada_detalle($datos,$bodega,$Encabezado);
	exit;
}

function log_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
	return dat_insertar_existencia($bodega,$producto,$cant,$codentrada,precio,$estado);
	exit;
}

function log_actualizar_entrada_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_actualizar_entrada_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_eliminar_entrada_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
	return dat_eliminar_entrada_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado);
	exit;
}

function log_obtener_cod_entrada()
{
	return dat_obtener_cod_entrada();
	exit;
}

function log_obtener_entradas($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_entradas($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_entradas_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_entradas_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_entradas_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_entradas_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_entradas($bodega,$filtro)
{
	return dat_obtener_num_entradas($bodega,$filtro);
	exit;
}

function log_obtener_entrada($id)
{
	return dat_obtener_entrada($id);
	exit;
}

function log_actualizar_entrada($datos,$tipo)
{
	return dat_actualizar_entrada($datos,$tipo);
	exit;
}





?>
