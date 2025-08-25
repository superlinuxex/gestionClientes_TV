<?php
//importando clase superiores
include 'datos/dat_talonariocf.php';


function log_obtener_num_talonariocf($bodega)
{
	return dat_obtener_num_talonariocf($bodega);

	exit;
}

function log_obtener_talonariocf($bodega,$comienzo, $cant)
{
	return dat_obtener_talonariocf($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_num_talonariocf_filtro($bodega,$filtro)
{
	return dat_obtener_num_talonariocf_filtro($bodega,$filtro);

	exit;
}

function log_obtener_talonariocf_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_talonariocf_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_talonariocf2($id,$id1,$id2)
{
	return dat_obtener_talonariocf2($id,$id1,$id2);

	exit;
}

function log_insertar_talonariocf($datos,$bode,$usuario)
{
	return dat_insertar_talonariocf($datos,$bode,$usuario);
	exit;
}


function log_eliminar_talonariocf($datos)
{
	return dat_eliminar_talonariocf($datos);
	exit;
}

function log_actualizar_talonariocf($datos)
{
	return dat_actualizar_talonariocf($datos);
	exit;
}

function log_obtener_talonariocf_cmb($bodega)
{
	return dat_obtener_talonariocf_cmb($bodega);
	exit;
}

?>