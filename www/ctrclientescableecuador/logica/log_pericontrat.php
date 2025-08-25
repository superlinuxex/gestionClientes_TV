<?php
//importando clase superiores
include 'datos/dat_pericon.php';

function log_obtener_pericon_cmb()
{
	return dat_obtener_pericon_cmb();
	exit;
}
function log_obtener_pericon($comienzo, $cant)
{
	return dat_obtener_pericon($comienzo, $cant);
	exit;
}

function log_obtener_pericontrat($id)
{
	return dat_obtener_pericontrat($id);
	exit;
}

function log_obtener_num_pericontrat()
{
	return dat_obtener_num_pericontrat();
	exit;
}


function log_insertar_pericontrat($datos)
{
	return dat_insertar_pericontrat($datos);
	exit;
}

function log_eliminar_pericontrat($id)
{
	return dat_eliminar_pericontrat($id);
	exit;
}

function log_actualizar_pericontrat($datos, $id)
{
	return dat_actualizar_pericontrat($datos, $id);
	exit;
}


?>