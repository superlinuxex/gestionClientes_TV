<?php
//importando clase superiores
include 'datos/dat_subpartidas_b.php';

function log_obtener_subpartidas_b($part,$div,$pro,$subpart,$subpart_a)
{
	return dat_obtener_subpartidas_b($part,$div,$pro,$subpart,$subpart_a);

	exit;
}

function log_obtener_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
	return dat_obtener_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b);

	exit;
}

function log_insertar_subpartida_b($datos)
{
	return dat_insertar_subpartida_b($datos);
	exit;
}

function log_eliminar_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
	return dat_eliminar_subpartida_b($part,$div,$pro,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_actualizar_subpartida_b($datos,$part,$div,$pro,$subpart,$subpart_a,$subpart_b)
{
	return dat_actualizar_subpartida_b($datos,$part,$div,$pro,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_obtener_subpartidas_b_cmb($part,$spart,$spart_a)
{
	return dat_obtener_subpartidas_b_cmb($part,$spart,$spart_a);
	exit;
}


function log_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a)
{
	return dat_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a);
	exit;
}


function log_validar_existencia_subpartida_b($part,$subpart,$subpart_a,$subpart_b,$division,$proyecto)
{
	return dat_validar_existencia_subpartida_b($part,$subpart,$subpart_a,$subpart_b,$division,$proyecto);
	exit;
}

function log_obtener_subpartidas_b_cmbdos()
{
	return dat_obtener_subpartidas_b_cmbdos();
	exit;
}

function log_obtener_subpartidas_b_cmbtres($bodega,$partida,$subpartida,$subpartida_a)
{
	return dat_obtener_subpartidas_b_cmbtres($bodega,$partida,$subpartida,$subpartida_a);
	exit;
}



?>