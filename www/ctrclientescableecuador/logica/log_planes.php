<?php
//importando clase superiores
include 'datos/dat_planes.php';



function log_obtener_num_planes_filtro($bodega,$filtro)
{
	return dat_obtener_num_planes_filtro($bodega,$filtro);
	exit;
}

function log_obtener_planes_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_planes_filtro($bodega,$comienzo, $cant, $filtro);
	exit;
}


function log_obtener_planes_cmb()
{
	return dat_obtener_planes_cmb();

	exit;
}

function log_obtener_velocidad_cmb()
{
	return dat_obtener_velocidad_cmb();

	exit;
}

function log_obtener_planes_cmb3($bodega)
{
	return dat_obtener_planes_cmb3($bodega);

	exit;
}
function log_obtener_planes($comienzo, $cant)
{
	return dat_obtener_planes($comienzo, $cant);
	exit;
}

function log_obtener_plan($id)
{
	return dat_obtener_plan($id);
	exit;
}

function log_obtener_num_planes()
{
	return dat_obtener_num_planes();
	exit;
}


function log_insertar_planes($datos)
{
	return dat_insertar_planes($datos);
	exit;
}

function log_eliminar_planes($id)
{
	return dat_eliminar_planes($id);
	exit;
}

function log_actualizar_planes($datos, $id)
{
	return dat_actualizar_planes($datos, $id);
	exit;
}
function log_obtener_planbase1_cmb()
{
	return dat_obtener_planbase1_cmb();
	exit;
}

function log_obtener_promo1_cmb()
{
	return dat_obtener_promo1_cmb();

	exit;
}
function log_obtener_equi1_cmb()
{
	return dat_obtener_equi1_cmb();

	exit;
}
function log_obtener_tarifa1_cmb()
{
	return dat_obtener_tarifa1_cmb();

	exit;
}
function log_obtener_internet1_cmb()
{
	return dat_obtener_internet1_cmb();

	exit;
}




?>