<?php
//importando clase superiores
include 'datos/dat_promocion.php';

function log_obtener_promocion_cmb()
{
	return dat_obtener_promocion_cmb();
	exit;
}
function log_obtener_promocion2($comienzo, $cant)
{
	return dat_obtener_promocion2($comienzo, $cant);
	exit;
}

function log_obtener_promocion($id)
{
	return dat_obtener_promocion($id);
	exit;
}

function log_obtener_num_promocion()
{
	return dat_obtener_num_promocion();
	exit;
}


function log_insertar_promocion($datos)
{
	return dat_insertar_promocion($datos);
	exit;
}

function log_eliminar_promocion($id)
{
	return dat_eliminar_promocion($id);
	exit;
}

function log_actualizar_promocion($datos, $id)
{
	return dat_actualizar_promocion($datos, $id);
	exit;
}


?>