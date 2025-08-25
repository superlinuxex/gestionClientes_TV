<?php
//importando clase superiores
include 'datos/dat_marcas.php';

function log_obtener_marcas_cmb()
{
	return dat_obtener_marcas_cmb();

	exit;
}
function log_obtener_marcas($comienzo, $cant)
{
	return dat_obtener_marcas($comienzo, $cant);
	exit;
}

function log_obtener_marca($id)
{
	return dat_obtener_marca($id);
	exit;
}

function log_obtener_num_marcas()
{
	return dat_obtener_num_marcas();
	exit;
}


function log_insertar_marca($datos)
{
	return dat_insertar_marca($datos);
	exit;
}

function log_eliminar_marca($id)
{
	return dat_eliminar_marca($id);
	exit;
}

function log_actualizar_marca($datos, $id)
{
	return dat_actualizar_marca($datos, $id);
	exit;
}


?>