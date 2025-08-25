<?php
//importando clase superiores
include 'datos/dat_equipos.php';

function log_obtener_equipos_cmb()
{
	return dat_obtener_equipos_cmb();
	exit;
}
function log_obtener_equipos($comienzo, $cant)
{
	return dat_obtener_equipos($comienzo, $cant);
	exit;
}

function log_obtener_equipo($id)
{
	return dat_obtener_equipo($id);
	exit;
}

function log_obtener_num_equipos()
{
	return dat_obtener_num_equipos();
	exit;
}


function log_insertar_equipo($datos)
{
	return dat_insertar_equipo($datos);
	exit;
}

function log_eliminar_equipo($id)
{
	return dat_eliminar_equipo($id);
	exit;
}

function log_actualizar_equipos($datos, $id)
{
	return dat_actualizar_equipos($datos, $id);
	exit;
}
?>