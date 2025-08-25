,<?php
//importando clase superiores
include 'datos/dat_partidas.php';

function log_obtener_partidas($comienzo, $cant)
{
	return dat_obtener_partidas($comienzo, $cant);

	exit;
}

function log_obtener_partida($id,$div,$pro)
{
	return dat_obtener_partida($id,$div,$pro);

	exit;
}

function log_obtener_partida_sub($id,$div,$pro)
{
	return dat_obtener_partida_sub($id,$div,$pro);

	exit;
}

function log_obtener_num_partidas()
{
	return dat_obtener_num_partidas();
	exit;
}

function log_insertar_partida($datos)
{
	return dat_insertar_partida($datos);
	exit;
}

function log_eliminar_partida($id,$div,$pro)
{
	return dat_eliminar_partida($id,$div,$pro);
	exit;
}

function log_actualizar_partida($datos,$id,$div,$pro)
{
	return dat_actualizar_partida($datos,$id,$div,$pro);
	exit;
}

function log_obtener_partidas_cmb()
{
	return dat_obtener_partidas_cmb();
	exit;
}


function log_obtener_partidas_cmbtres($bodega)
{
	return dat_obtener_partidas_cmbtres($bodega);
	exit;
}

function log_obtener_partidas_cmbdos()
{
	return dat_obtener_partidas_cmbdos();
	exit;
}


function log_validar_existencia_partida($cod, $division,$proyecto)
{
	return dat_validar_existencia_partida($cod, $division,$proyecto);
	exit;
}
function log_validar_existencia_subpartida1($cod, $division,$proyecto)
{
	return dat_validar_existencia_subpartida1($cod, $division,$proyecto);
	exit;
}


function log_obtener_x_partidas_cmb($bod)
{
	return dat_obtener_x_partidas_cmb($bod);
	exit;
}






?>