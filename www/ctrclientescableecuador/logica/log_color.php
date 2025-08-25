<?php
//importando clase superiores
include 'datos/dat_color.php';

function log_obtener_color_cmb()
{
	return dat_obtener_color_cmb();

	exit;
}
function log_obtener_color($comienzo, $cant)
{
	return dat_obtener_color($comienzo, $cant);
	exit;
}

function log_obtener_color2($id)
{
	return dat_obtener_color2($id);
	exit;
}

function log_obtener_num_color()
{
	return dat_obtener_num_color();
	exit;
}


function log_insertar_color($datos)
{
	return dat_insertar_color($datos);
	exit;
}

function log_eliminar_color($id)
{
	return dat_eliminar_color($id);
	exit;
}

function log_actualizar_color($datos, $id)
{
	return dat_actualizar_color($datos, $id);
	exit;
}


?>