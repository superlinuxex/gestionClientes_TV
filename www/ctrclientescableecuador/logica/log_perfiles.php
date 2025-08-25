<?php
//importando clase superiores
include 'datos/dat_perfiles.php';

function log_obtener_perfiles($comienzo, $cant)
{
	return dat_obtener_perfiles($comienzo, $cant);
	exit;
}

function log_obtener_perfil($id)
{
	return dat_obtener_perfil($id);
	exit;
}

function log_obtener_num_perfiles()
{
	return dat_obtener_num_perfiles();
	exit;
}

function log_obtener_perfiles_cmb()
{
	return dat_obtener_perfiles_cmb();
	exit;
}

function log_insertar_perfil($datos)
{
	return dat_insertar_perfil($datos);
	exit;
}

function log_eliminar_perfil($id)
{
	return dat_eliminar_perfil($id);
	exit;
}

function log_actualizar_perfil($datos, $id)
{
	return dat_actualizar_perfil($datos, $id);
	exit;
}
?>