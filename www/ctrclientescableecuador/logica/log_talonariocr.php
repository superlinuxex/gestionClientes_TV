<?php
//importando clase superiores
include 'datos/dat_talonariocr.php';


function log_obtener_num_talonariocr($bodega)
{
	return dat_obtener_num_talonariocr($bodega);

	exit;
}

function log_obtener_talonariocr($bodega,$comienzo, $cant)
{
	return dat_obtener_talonariocr($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_num_talonariocr_filtro($bodega,$filtro)
{
	return dat_obtener_num_talonariocr_filtro($bodega,$filtro);

	exit;
}

function log_obtener_talonariocr_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_talonariocr_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_talonariocr2($id,$id1,$id2)
{
	return dat_obtener_talonariocr2($id,$id1,$id2);

	exit;
}

function log_insertar_talonariocr($datos,$bode,$usuario)
{
	return dat_insertar_talonariocr($datos,$bode,$usuario);
	exit;
}


function log_eliminar_talonariocr($datos)
{
	return dat_eliminar_talonariocr($datos);
	exit;
}

function log_actualizar_talonariocr($datos)
{
	return dat_actualizar_talonariocr($datos);
	exit;
}

function log_obtener_talonariocr_cmb($bodega)
{
	return dat_obtener_talonariocr_cmb($bodega);
	exit;
}

?>