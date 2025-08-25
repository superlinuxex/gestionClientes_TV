<?php
//importando clase superiores
include 'datos/dat_subpartidas_a.php';

function log_obtener_subpartidas_a($part,$div,$pro,$subpart)
{
	return dat_obtener_subpartidas_a($part,$div,$pro,$subpart);

	exit;
}

function log_obtener_subpartida_a($part,$div,$pro,$subpart,$subpart_a)
{
	return dat_obtener_subpartida_a($part,$div,$pro,$subpart,$subpart_a);

	exit;
}

function log_obtener_subpartida_a_sub($part,$div,$pro,$subpart,$subpart_a)
{
	return dat_obtener_subpartida_a_sub($part,$div,$pro,$subpart,$subpart_a);

	exit;
}

function log_obtener_num_subpartidas_a()
{
	return dat_obtener_num_subpartidas_a();
	exit;
}

function log_insertar_subpartida_a($datos)
{
	return dat_insertar_subpartida_a($datos);
	exit;
}

function log_eliminar_subpartida_a($part,$div,$pro,$subpart,$subpart_a)
{
	return dat_eliminar_subpartida_a($part,$div,$pro,$subpart,$subpart_a);
	exit;
}

function log_actualizar_subpartida_a($datos,$part,$div,$pro,$subpart,$subpart_a)
{
	return dat_actualizar_subpartida_a($datos,$part,$div,$pro,$subpart,$subpart_a);
	exit;
}

function log_obtener_subpartidas_a_cmb($part,$spart)
{
	return dat_obtener_subpartidas_a_cmb($part,$spart);
	exit;
}

function log_obtener_subpartidas_a_cmb2($bodega,$part,$spart)
{
	return dat_obtener_subpartidas_a_cmb2($bodega,$part,$spart);
	exit;
}

function log_obtener_subpartidas_a_cmbdos()
{
	return dat_obtener_subpartidas_a_cmbdos();
	exit;
}


function log_obtener_subpartidas_a_cmbtres($bodega,$partida,$subpartida)
{
	return dat_obtener_subpartidas_a_cmbtres($bodega,$partida,$subpartida);
	exit;
}

function log_validar_existencia_subpartida_a($part,$subpart,$subpart_a,$division,$proyecto)
{
	return dat_validar_existencia_subpartida_a($part,$subpart,$subpart_a,$division,$proyecto);
	exit;
}
function log_validar_existencia_subpartida_b1($part,$division,$proyecto,$subpart,$subpart_a)
{
	return dat_validar_existencia_subpartida_b1($part,$division,$proyecto,$subpart,$subpart_a);
	exit;
}


?>