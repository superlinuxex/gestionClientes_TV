<?php
//importando clase superiores
include 'datos/dat_bodegas.php';

function log_obtener_bodegas($comienzo, $cant)
{
	return dat_obtener_bodegas($comienzo, $cant);

	exit;
}

function log_obtener_bodega($id)
{
	return dat_obtener_bodega($id);

	exit;
}

function log_obtener_num_bodegas()
{
	return dat_obtener_num_bodegas();
	exit;
}

function log_insertar_bodega($datos)
{
	return dat_insertar_bodega($datos);
	exit;
}

function log_eliminar_bodega($id)
{
	return dat_eliminar_bodega($id);
	exit;
}

function log_actualizar_bodega($datos, $id)
{
	return dat_actualizar_bodega($datos, $id);
	exit;
}

function log_validar_existencia_bodega($proyecto)
{
	return dat_validar_existencia_bodega($proyecto);
	exit;
}


function log_obtener_bodegas_cmb()
{
	return dat_obtener_bodegas_cmb();
	exit;
}

function log_obtener_bodegas_cmb2($bodega)
{
	return dat_obtener_bodegas_cmb2($bodega);
	exit;
}


function log_obtener_bodegas_cmb3($bodega)
{
	return dat_obtener_bodegas_cmb3($bodega);
	exit;
}

?>