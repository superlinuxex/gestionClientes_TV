<?php
//importando clase superiores
include 'datos/dat_equi.php';

function log_obtener_equi_cmb()
{
	return dat_obtener_equi_cmb();

	exit;
}
function log_obtener_equi($comienzo, $cant)
{
	return dat_obtener_equi($comienzo, $cant);
	exit;
}

function log_obtener_equi($id)
{
	return dat_obtener_equi($id);
	exit;
}

function log_obtener_num_equi()
{
	return dat_obtener_num_equi();
	exit;
}


function log_insertar_equi($datos)
{
	return dat_insertar_equi($datos);
	exit;
}

function log_eliminar_equi($id)
{
	return dat_eliminar_equi($id);
	exit;
}

function log_actualizar_equi($datos, $id)
{
	return dat_actualizar_equi($datos, $id);
	exit;
}


?>