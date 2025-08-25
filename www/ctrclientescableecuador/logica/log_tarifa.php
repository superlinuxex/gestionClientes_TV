<?php
//importando clase superiores
include 'datos/dat_tarifa.php';

function log_obtener_tarifa_cmb()
{
	return dat_obtener_tarifa_cmb();

	exit;
}
function log_obtener_tarifa($comienzo, $cant)
{
	return dat_obtener_tarifa($comienzo, $cant);
	exit;
}

function log_obtener_tarifa($id)
{
	return dat_obtener_tarifa($id);
	exit;
}

function log_obtener_num_tarifa()
{
	return dat_obtener_num_tarifa();
	exit;
}


function log_insertar_tarifa($datos)
{
	return dat_insertar_tarifa($datos);
	exit;
}

function log_eliminar_tarifa($id)
{
	return dat_eliminar_tarifa($id);
	exit;
}

function log_actualizar_tarifa($datos, $id)
{
	return dat_actualizar_tarifa($datos, $id);
	exit;
}


?>