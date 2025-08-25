<?php
//importando clase superiores
include 'datos/dat_menus.php';
function log_obtener_menus($comienzo, $cant)
{
	return dat_obtener_menus($comienzo, $cant);
	exit;
}

function log_obtener_menu($id)
{
	return dat_obtener_menu($id);
	exit;
}

function log_obtener_num_menus()
{
	return dat_obtener_num_menus();
	exit;
}

function log_insertar_menu($datos)
{
	return dat_insertar_menu($datos);
	exit;
}

function log_eliminar_menu($id)
{
	return dat_eliminar_menu($id);
	exit;
}

function log_actualizar_menu($datos, $id)
{
	return dat_actualizar_menu($datos, $id);
	exit;
}

function log_obtener_opciones_menu($id)
{
	return dat_obtener_opciones_menu($id);
	exit;
}

function log_eliminar_opciones_menu($perfil)
{
	return dat_eliminar_opciones_menu($perfil);
	exit;
}

function log_insertar_opciones_menu($perfil,$idmenu)
{
	return dat_insertar_opciones_menu($perfil,$idmenu);
	exit;
}
?>