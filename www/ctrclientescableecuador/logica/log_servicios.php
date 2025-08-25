<?php
//importando clase superiores
include 'datos/dat_servicios.php';

function log_obtener_servicios_cmb()
{
	return dat_obtener_servicios_cmb();

	exit;
}
function log_obtener_servicios_cmbconec()
{
	return dat_obtener_servicios_cmbconec();
	exit;
}
function log_obtener_servicios_cmbdconec()
{
	return dat_obtener_servicios_cmbdconec();
	exit;
}

function log_obtener_servicios_cmbtecnico()
{
	return dat_obtener_servicios_cmbtecnico();
	exit;
}
function log_obtener_servicios_cmbtecnicoadi()
{
	return dat_obtener_servicios_cmbtecnicoadi();
	exit;
}
function log_obtener_servicios_cmbnoadmi()
{
	return dat_obtener_servicios_cmbnoadmi();
	exit;
}

function log_obtener_servicios_cmbtecnicoadi2()
{
	return dat_obtener_servicios_cmbtecnicoadi2();
	exit;
}
function log_obtener_servicios_cmbnoadmi2()
{
	return dat_obtener_servicios_cmbnoadmi2();
	exit;
}


function log_obtener_servicios($comienzo, $cant)
{
	return dat_obtener_servicios($comienzo, $cant);
	exit;
}

function log_obtener_servicio($id)
{
	return dat_obtener_servicio($id);
	exit;
}

function log_obtener_num_servicios()
{
	return dat_obtener_num_servicios();
	exit;
}


function log_insertar_servicios($datos)
{
	return dat_insertar_servicios($datos);
	exit;
}

function log_eliminar_servicios($id)
{
	return dat_eliminar_servicios($id);
	exit;
}

function log_actualizar_servicios($datos, $id)
{
	return dat_actualizar_servicios($datos, $id);
	exit;
}


?>