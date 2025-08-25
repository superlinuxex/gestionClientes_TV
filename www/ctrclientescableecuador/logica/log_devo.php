<?php
//importando clase superiores
include 'datos/dat_devo.php';

function log_validar_devo($id)
{
	return dat_validar_devo($id);
	exit;
}

function log_insertar_devo($datos)
{
	return dat_insertar_devo($datos);
	exit;
}

function log_eliminar_devo($id)
{
	return dat_eliminar_devo($id);
	exit;
}

function log_obtener_devo_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_devo_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_devo($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_devo($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_devo_detalle($codigo)
{
	return dat_obtener_num_devo_detalle($codigo);
	exit;
}

function log_insertar_devo_detalle($datos,$Encabezado)
{
	return dat_insertar_devo_detalle($datos,$Encabezado);
	exit;
}

function log_actualizar_devo_detalle($_POST,$Encabezado,$registro)
{
	return dat_actualizar_devo_detalle($_POST,$Encabezado,$registro);
	exit;
}

function log_eliminar_devo_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
	return dat_eliminar_devo_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto);
	exit;
}

function log_obtener_precio_prod($prod,$bodega)
{
	return dat_obtener_precio_prod($prod,$bodega);
	exit;
}

function log_validar_existencia($bodega,$producto,$cant)
{
	return dat_validar_existencia($bodega,$producto,$cant);
	exit;
}

function log_obtener_cod_devo()
{
	return dat_obtener_cod_devo();
	exit;
}

function log_obtener_devo($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_devo($comienzo, $cant,$bodega,$filtro);
	exit;
}

function log_obtener_num_devo($bodega,$filtro)
{
	return dat_obtener_num_devo($bodega,$filtro);
	exit;
}

function log_obtener_devo($id)
{
	return dat_obtener_devo($id);
	exit;
}

function log_actualizar_devo($datos,$tipo)
{
	return dat_actualizar_devo($datos,$tipo);
	exit;
}



?>