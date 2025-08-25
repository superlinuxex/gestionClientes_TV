<?php
//importando clase superiores
include 'datos/dat_caserios.php';

function log_obtener_caserios($part,$subpart,$subpart_a,$subpart_b)
{
	return dat_obtener_caserios($part,$subpart,$subpart_a,$subpart_b);
	exit;
}

function log_obtener_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_obtener_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c);
	exit;
}

function log_insertar_caserios($datos)
{
	return dat_insertar_caserios($datos);
	exit;
}

function log_eliminar_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_eliminar_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c);
	exit;
}

function log_actualizar_caserio($datos,$part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_actualizar_caserio($datos,$part,$subpart,$subpart_a,$subpart_b,$subpart_c);
	exit;
}

function log_obtener_caserio_cmb($part,$spart,$spart_a,$spart_b)
{
	return dat_obtener_caserio_cmb($part,$spart,$spart_a,$spart_b);
	exit;
}


function log_obtener_caserio_cmb2($bodega,$part,$spart,$spart_a)
{
	return dat_obtener_caserio_cmb2($bodega,$part,$spart,$spart_a);
	exit;
}


function log_validar_existencia_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_validar_existencia_caserio($part,$subpart,$subpart_a,$subpart_b,$subpart_c);
	exit;
}
function log_validar_existencia_caserio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c)
{
	return dat_validar_existencia_caserio_b1($part,$subpart,$subpart_a,$subpart_b,$subpart_c);
	exit;
}

function log_obtener_caserio_cmbdos()
{
	return dat_obtener_caserio_cmbdos();
	exit;
}

function log_obtener_caserios_cmb2($partida,$subpartida,$subpartida_a,$subpartida_b)
{
	return dat_obtener_caserios_cmb2($partida,$subpartida,$subpartida_a,$subpartida_b);
	exit;
}



?>