<?php
//importando clase superiores
include 'datos/dat_modelo.php';

function log_obtener_modelo_cmb()
{
	return dat_obtener_modelo_cmb();

	exit;
}
function log_obtener_modelo($comienzo, $cant)
{
	return dat_obtener_modelo($comienzo, $cant);
	exit;
}

function log_obtener_modelo2($id)
{
	return dat_obtener_modelo2($id);
	exit;
}

function log_obtener_num_modelo()
{
	return dat_obtener_num_modelo();
	exit;
}


function log_insertar_modelo($datos)
{
	return dat_insertar_modelo($datos);
	exit;
}

function log_eliminar_modelo($id)
{
	return dat_eliminar_modelo($id);
	exit;
}

function log_actualizar_modelo($datos, $id)
{
	return dat_actualizar_modelo($datos, $id);
	exit;
}


?>