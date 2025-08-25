<?php
//importando clase superiores
include 'datos/dat_internet.php';

function log_obtener_internet_cmb()
{
	return dat_obtener_internet_cmb();

	exit;
}
function log_obtener_internet($comienzo, $cant)
{
	return dat_obtener_internet($comienzo, $cant);
	exit;
}

function log_obtener_internet($id)
{
	return dat_obtener_internet($id);
	exit;
}

function log_obtener_num_internet()
{
	return dat_obtener_num_internet();
	exit;
}


function log_insertar_internet($datos)
{
	return dat_insertar_internet($datos);
	exit;
}

function log_eliminar_internet($id)
{
	return dat_eliminar_internet($id);
	exit;
}

function log_actualizar_internet($datos, $id)
{
	return dat_actualizar_internet($datos, $id);
	exit;
}


?>