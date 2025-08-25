<?php
//importando clase superiores
include 'datos/dat_planbase.php';

function log_obtener_planbase_cmb()
{
	return dat_obtener_planbase_cmb();
	exit;
}
function log_obtener_planbase2($comienzo, $cant)
{
	return dat_obtener_planbase2($comienzo, $cant);
	exit;
}

function log_obtener_planbase($id)
{
	return dat_obtener_planbase($id);
	exit;
}

function log_obtener_num_planbase()
{
	return dat_obtener_num_planbase();
	exit;
}


function log_insertar_planbase($datos)
{
	return dat_insertar_planbase($datos);
	exit;
}

function log_eliminar_planbase($id)
{
	return dat_eliminar_planbase($id);
	exit;
}

function log_actualizar_planbase($datos, $id)
{
	return dat_actualizar_planbase($datos, $id);
	exit;
}


?>