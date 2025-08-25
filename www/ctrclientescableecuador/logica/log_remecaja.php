<?php
//importando clase superiores
include 'datos/dat_remecaja.php';

function log_obtener_remecaja_cmb()
{
	return dat_obtener_remecaja_cmb();

	exit;
}

function log_obtener_remesas_cmb($bodega)
{
	return dat_obtener_remesas_cmb($bodega);

	exit;
}


function log_obtener_remecajas($comienzo, $cant)
{
	return dat_obtener_remecajas($comienzo, $cant);
	exit;
}

function log_obtener_remecaja($id)
{
	return dat_obtener_remecaja($id);
	exit;
}
function log_obtener_num_remecaja()
{
	return dat_obtener_num_remecaja();
	exit;
}


function log_insertar_remecaja($datos)
{
	return dat_insertar_remecaja($datos);
	exit;
}

function log_eliminar_remecaja($id)
{
	return dat_eliminar_remecaja($id);
	exit;
}

function log_actualizar_remecaja($datos, $id)
{
	return dat_actualizar_remecaja($datos, $id);
	exit;
}
?>