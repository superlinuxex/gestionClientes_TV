<?php
//importando clase superiores
include 'datos/dat_municipios.php';

function log_obtener_municipios($id)
{
	return dat_obtener_municipios($id);

	exit;
}

function log_obtener_municipio($part,$subpart)
{
	return dat_obtener_municipio($part,$subpart);

	exit;
}

function log_obtener_municipio_sub($part,$subpart)
{
	return dat_obtener_municipio_sub($part,$subpart);

	exit;
}

function log_obtener_num_subpartidas()
{
	return dat_obtener_num_subpartidas();
	exit;
}

function log_insertar_municipio($datos)
{
	return dat_insertar_municipio($datos);
	exit;
}

function log_eliminar_municipio($part,$subpart)
{
	return dat_eliminar_municipio($part,$subpart);
	exit;
}

function log_actualizar_municipio($datos,$part,$subpart)
{
	return dat_actualizar_municipio($datos,$part,$subpart);
	exit;
}

function log_obtener_municipios_cmb($part)
{
	return dat_obtener_municipios_cmb($part);
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


function log_validar_existencia_municipio($part,$subpart)
{
	return dat_validar_existencia_municipio($part,$subpart);
	exit;
}
function log_validar_existencia_municipio_a1($part,$subpart)
{
	return dat_validar_existencia_municipio_a1($part,$subpart);
	exit;
}


?>