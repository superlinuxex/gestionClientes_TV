<?php
//importando clase superiores
include 'datos/dat_divisiones.php';

function log_obtener_divisiones($comienzo, $cant)
{
	return dat_obtener_divisiones($comienzo, $cant);
	exit;
}

function log_obtener_division($id)
{
	return dat_obtener_division($id);
	exit;
}

function log_obtener_divisiones_cmb()
{
	return dat_obtener_divisiones_cmb();
	exit;
}

function log_obtener_num_divisiones()
{
	return dat_obtener_num_divisiones();
	exit;
}


function log_insertar_division($datos)
{
	return dat_insertar_division($datos);
	exit;
}

function log_eliminar_division($id)
{
	return dat_eliminar_division($id);
	exit;
}

function log_actualizar_division($datos, $id)
{
	return dat_actualizar_division($datos, $id);
	exit;
}
?>