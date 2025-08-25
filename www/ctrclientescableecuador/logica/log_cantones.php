<?php
//importando clase superiores
include 'datos/dat_cantones.php';

function log_obtener_canton($part,$subpart)
{
	return dat_obtener_canton($part,$subpart);

	exit;
}

function log_obtener_cantones($part,$subpart,$subpart_a)
{
	return dat_obtener_cantones($part,$subpart,$subpart_a);

	exit;
}

function log_obtener_canton_sub($part,$subpart,$subpart_a)
{
	return dat_obtener_canton_sub($part,$subpart,$subpart_a);

	exit;
}

function log_obtener_num_cantones()
{
	return dat_obtener_num_cantones();
	exit;
}

function log_insertar_canton($datos)
{
	return dat_insertar_canton($datos);
	exit;
}

function log_eliminar_canton($part,$subpart,$subpart_a)
{
	return dat_eliminar_canton($part,$subpart,$subpart_a);
	exit;
}

function log_actualizar_canton($datos,$part,$subpart,$subpart_a)
{
	return dat_actualizar_canton($datos,$part,$subpart,$subpart_a);
	exit;
}

function log_obtener_cantones_cmb($part,$spart)
{
	return dat_obtener_cantones_cmb($part,$spart);
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

function log_validar_existencia_canton($part,$subpart,$subpart_a)
{
	return dat_validar_existencia_canton($part,$subpart,$subpart_a);
	exit;
}
function log_validar_existencia_canton_b1($part,$subpart,$subpart_a)
{
	return dat_validar_existencia_canton_b1($part,$subpart,$subpart_a);
	exit;
}


?>