<?php
//importando clase superiores
include 'datos/dat_equiad.php';

function log_obtener_equiad_cmb()
{
	return dat_obtener_equiad_cmb();
	exit;
}
function log_obtener_equiad2($comienzo, $cant)
{
	return dat_obtener_equiad2($comienzo, $cant);
	exit;
}

function log_obtener_equiad($id)
{
	return dat_obtener_equiad($id);
	exit;
}

function log_obtener_num_equiad()
{
	return dat_obtener_num_equiad();
	exit;
}


function log_insertar_equiad($datos)
{
	return dat_insertar_equiad($datos);
	exit;
}

function log_eliminar_equiad($id)
{
	return dat_eliminar_equiad($id);
	exit;
}

function log_actualizar_equiad($datos, $id)
{
	return dat_actualizar_equiad($datos, $id);
	exit;
}


?>