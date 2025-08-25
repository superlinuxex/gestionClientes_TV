<?php
//importando clase superiores
include 'datos/dat_promo.php';

function log_obtener_promo_cmb()
{
	return dat_obtener_promo_cmb();

	exit;
}
function log_obtener_promo($comienzo, $cant)
{
	return dat_obtener_promo($comienzo, $cant);
	exit;
}

function log_obtener_promo($id)
{
	return dat_obtener_promo($id);
	exit;
}

function log_obtener_num_promo()
{
	return dat_obtener_num_promo();
	exit;
}


function log_insertar_promo($datos)
{
	return dat_insertar_promo($datos);
	exit;
}

function log_eliminar_promo($id)
{
	return dat_eliminar_promo($id);
	exit;
}

function log_actualizar_promo($datos, $id)
{
	return dat_actualizar_promo($datos, $id);
	exit;
}


?>