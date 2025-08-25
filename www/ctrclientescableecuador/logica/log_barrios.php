<?php
//importando clase superiores
include 'datos/dat_barrios.php';

function log_obtener_barrios($part,$subpart,$subpart_a)
{
	return dat_obtener_barrios($part,$subpart,$subpart_a);
	exit;
}

function log_obtener_barrio($part,$subpart,$subpart_a,$subpart_b)
{
	return dat_obtener_barrio($part,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_insertar_barrio($datos)
{
	return dat_insertar_barrio($datos);
	exit;
}

function log_eliminar_barrios($part,$subpart,$subpart_a,$subpart_b)
{
	return dat_eliminar_barrios($part,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_actualizar_barrio($datos,$part,$subpart,$subpart_a,$subpart_b)
{
	return dat_actualizar_barrio($datos,$part,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_obtener_barrios_cmb($part,$spart,$spart_a)
{
	return dat_obtener_barrios_cmb($part,$spart,$spart_a);
	exit;
}


function log_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a)
{
	return dat_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a);
	exit;
}


function log_validar_existencia_barrio($part,$subpart,$subpart_a,$subpart_b)
{
	return dat_validar_existencia_barrio($part,$subpart,$subpart_a,$subpart_b);
	exit;
}
function log_validar_existencia_barrio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_validar_existencia_barrio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c);
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


function log_obtener_barrios_sub($part,$subpart,$subpart_a,$subpart_b)
{
	return dat_obtener_barrios_sub($part,$subpart,$subpart_a,$subpart_b);
	exit;
}



?>