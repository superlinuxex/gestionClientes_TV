<?php
//importando clase superiores
include 'datos/dat_proyectos.php';

function log_obtener_proyectos($comienzo, $cant)
{
	return dat_obtener_proyectos($comienzo, $cant);

	exit;
}

function log_obtener_proyecto($id)
{
	return dat_obtener_proyecto($id);

	exit;
}

function log_obtener_proyectos_cmb()
{
	return dat_obtener_proyectos_cmb();

	exit;
}
function log_obtener_proyectos_cmb2($divixx)
{
	return dat_obtener_proyectos_cmb2($divixx);

	exit;
}

function log_obtener_num_proyectos()
{
	return dat_obtener_num_proyectos();
	exit;
}

function log_insertar_proyecto($datos)
{
	return dat_insertar_proyecto($datos);
	exit;
}

function log_eliminar_proyecto($id)
{
	return dat_eliminar_proyecto($id);
	exit;
}

function log_actualizar_proyecto($datos, $id)
{
	return dat_actualizar_proyecto($datos, $id);
	exit;
}

?>