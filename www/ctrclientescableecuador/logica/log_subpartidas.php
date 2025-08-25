<?php
//importando clase superiores
include 'datos/dat_subpartidas.php';

function log_obtener_subpartidas($id,$div,$pro)
{
	return dat_obtener_subpartidas($id,$div,$pro);

	exit;
}

function log_obtener_subpartida($part,$div,$pro,$subpart)
{
	return dat_obtener_subpartida($part,$div,$pro,$subpart);

	exit;
}

function log_obtener_subpartida_sub($part,$div,$pro,$subpart)
{
	return dat_obtener_subpartida_sub($part,$div,$pro,$subpart);

	exit;
}

function log_obtener_num_subpartidas()
{
	return dat_obtener_num_subpartidas();
	exit;
}

function log_insertar_subpartida($datos)
{
	return dat_insertar_subpartida($datos);
	exit;
}

function log_eliminar_subpartida($part,$div,$pro,$subpart)
{
	return dat_eliminar_subpartida($part,$div,$pro,$subpart);
	exit;
}

function log_actualizar_subpartida($datos,$part,$div,$pro,$subpart)
{
	return dat_actualizar_subpartida($datos,$part,$div,$pro,$subpart);
	exit;
}

function log_obtener_subpartidas_cmb($part)
{
	return dat_obtener_subpartidas_cmb($part);
	exit;
}

function log_obtener_subpartidas_cmb2($bodega,$part)
{
	return dat_obtener_subpartidas_cmb2($bodega,$part);
	exit;
}

function log_obtener_subpartidas_cmbdos()
{
	return dat_obtener_subpartidas_cmbdos();
	exit;
}


function log_obtener_subpartidas_cmbtres($bodega,$partida)
{
	return dat_obtener_subpartidas_cmbtres($bodega,$partida);
	exit;
}


function log_validar_existencia_subpartida($part,$subpart,$division,$proyecto)
{
	return dat_validar_existencia_subpartida($part,$subpart,$division,$proyecto);
	exit;
}
function log_validar_existencia_subpartida_a1($part,$division,$proyecto,$subpart)
{
	return dat_validar_existencia_subpartida_a1($part,$division,$proyecto,$subpart);
	exit;
}


?>