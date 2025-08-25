<?php
//importando clase superiores
include 'datos/dat_veloconec.php';

function log_obtener_veloconec_cmb()
{
	return dat_obtener_veloconec_cmb();
	exit;
}
function log_obtener_veloconec2($comienzo, $cant)
{
	return dat_obtener_veloconec2($comienzo, $cant);
	exit;
}

function log_obtener_veloconec($id)
{
	return dat_obtener_veloconec($id);
	exit;
}

function log_obtener_num_veloconec()
{
	return dat_obtener_num_veloconec();
	exit;
}


function log_insertar_veloconec($datos)
{
	return dat_insertar_veloconec($datos);
	exit;
}

function log_eliminar_veloconec($id)
{
	return dat_eliminar_veloconec($id);
	exit;
}

function log_actualizar_veloconec($datos, $id)
{
	return dat_actualizar_veloconec($datos, $id);
	exit;
}


?>