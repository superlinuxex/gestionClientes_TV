<?php
//importando clase superiores
include 'datos/dat_tarifas.php';

function log_obtener_tarifas_cmb()
{
	return dat_obtener_tarifas_cmb();
	exit;
}
function log_obtener_tarifas2($comienzo, $cant)
{
	return dat_obtener_tarifas2($comienzo, $cant);
	exit;
}

function log_obtener_tarifas($id)
{
	return dat_obtener_tarifas($id);
	exit;
}

function log_obtener_num_tarifas()
{
	return dat_obtener_num_tarifas();
	exit;
}


function log_insertar_tarifas($datos)
{
	return dat_insertar_tarifas($datos);
	exit;
}

function log_eliminar_tarifas($id)
{
	return dat_eliminar_tarifas($id);
	exit;
}

function log_actualizar_tarifas($datos, $id)
{
	return dat_actualizar_tarifas($datos, $id);
	exit;
}


?>