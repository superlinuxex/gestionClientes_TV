<?php
//importando clase superiores
include 'datos/dat_zonas.php';

function log_obtener_zona_cmb()
{
	return dat_obtener_zona_cmb();

	exit;
}
function log_obtener_zonas($comienzo, $cant)
{
	return dat_obtener_zonas($comienzo, $cant);
	exit;
}

function log_obtener_zona2($id)
{
	return dat_obtener_zona2($id);
	exit;
}

function log_obtener_num_zonas()
{
	return dat_obtener_num_zonas();
	exit;
}


function log_insertar_zona($datos)
{
	return dat_insertar_zona($datos);
	exit;
}

function log_eliminar_zona($id)
{
	return dat_eliminar_zona($id);
	exit;
}

function log_actualizar_zona($datos, $id)
{
	return dat_actualizar_zona($datos, $id);
	exit;
}


?>