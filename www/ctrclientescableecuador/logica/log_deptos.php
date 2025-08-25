<?php
//importando clase superiores
include 'datos/dat_deptos.php';

function log_obtener_deptos_cmb()
{
	return dat_obtener_deptos_cmb();

	exit;
}
function log_obtener_deptos($comienzo, $cant)
{
	return dat_obtener_deptos($comienzo, $cant);
	exit;
}

function log_obtener_depto($id)
{
	return dat_obtener_depto($id);
	exit;
}

function log_obtener_num_deptos()
{
	return dat_obtener_num_deptos();
	exit;
}


function log_insertar_deptos($datos)
{
	return dat_insertar_deptos($datos);
	exit;
}

function log_eliminar_deptos($id)
{
	return dat_eliminar_deptos($id);
	exit;
}

function log_actualizar_deptos($datos, $id)
{
	return dat_actualizar_deptos($datos, $id);
	exit;
}


?>