<?php
//importando clase superiores
include 'datos/dat_proveedores.php';

function log_obtener_proveedores_cmb()
{
	return dat_obtener_proveedores_cmb();

	exit;
}
function log_obtener_proveedores($comienzo, $cant)
{
	return dat_obtener_proveedores($comienzo, $cant);
	exit;
}

function log_obtener_proveedor($id)
{
	return dat_obtener_proveedor($id);
	exit;
}
function log_obtener_num_proveedores()
{
	return dat_obtener_num_proveedores();
	exit;
}


function log_insertar_proveedor($datos)
{
	return dat_insertar_proveedor($datos);
	exit;
}

function log_eliminar_proveedor($id)
{
	return dat_eliminar_proveedor($id);
	exit;
}

function log_actualizar_proveedor($datos, $id)
{
	return dat_actualizar_proveedor($datos, $id);
	exit;
}
?>