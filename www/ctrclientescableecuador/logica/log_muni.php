<?php
//importando clase superiores
include 'datos/dat_muni.php';

function log_obtener_muni($comienzo, $cant)
{
	return dat_obtener_muni($comienzo, $cant);

	exit;
}

function log_obtener_munis($id,$id2)
{
	return dat_obtener_munis($id,$id2);

	exit;
}
function log_obtener_munisegundo($id)
{
	return dat_obtener_munisegundo($id);

	exit;
}


function log_obtener_num_muni()
{
	return dat_obtener_num_muni();
	exit;
}

function log_insertar_muni($datos)
{
	return dat_insertar_muni($datos);
	exit;
}

function log_eliminar_muni($datos,$id2)
{
	return dat_eliminar_muni($datos,$id2);
	exit;
}

function log_actualizar_muni($datos, $id2)
{
	return dat_actualizar_muni($datos, $id2);
	exit;
}

function log_validar_existencia_muni($depto,$muni)
{
	return dat_validar_existencia_muni($depto,$muni);
	exit;
}


function log_obtener_muni_cmb($depto)
{
	return dat_obtener_muni_cmb($depto);
	exit;
}

function log_obtener_muni_cmb2($bodega)
{
	return dat_obtener_muni_cmb2($bodega);
	exit;
}


function log_obtener_muni_cmb3($bodega)
{
	return dat_obtener_muni_cmb3($bodega);
	exit;
}

?>