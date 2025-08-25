<?php
//importando clase superiores
include 'datos/dat_devoclie.php';

function log_obtener_devoclie($bodega,$comienzo, $cant)
{
	return dat_obtener_devoclie($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_listamateriales($clie,$bodega,$comienzo, $cant)
{
	return dat_obtener_listamateriales($clie,$bodega,$comienzo, $cant);

	exit;
}

function log_obtener_devoclie_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_devoclie_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_devoclie_filtro2($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_devoclie_filtro2($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_devoclie2($id,$bodega)
{
	return dat_obtener_devoclie2($id,$bodega);

	exit;
}

function log_obtener_num_devoclie($bodega)
{
	return dat_obtener_num_devoclie($bodega);
	exit;
}

function log_obtener_num_devoclie_filtro($bodega,$filtro)
{
	return dat_obtener_num_devoclie_filtro($bodega,$filtro);
	exit;
}

function log_obtener_num_devoclie_filtro2($bodega,$filtro)
{
	return dat_obtener_num_devoclie_filtro2($bodega,$filtro);
	exit;
}

function log_obtener_num_listamateriales($clie,$bodega)
{
	return dat_obtener_num_listamateriales($clie,$bodega);
	exit;
}
function log_insertar_devoclie($datos,$bode,$usuario)
{
	return dat_insertar_devoclie($datos,$bode,$usuario);
	exit;
}

function log_eliminar_devoclie($id,$bodega)
{
	return dat_eliminar_devoclie($id,$bodega);
	exit;
}

function log_actualizar_devoclie($datos, $id,$bodega)
{
	return dat_actualizar_devoclie($datos, $id,$bodega);
	exit;
}
function log_reprogramar_devoclie($datos, $id,$bodega)
{
	return dat_reprogramar_devoclie($datos, $id,$bodega);
	exit;
}
function log_ejecutar_devoclie($datos, $id,$bodega)
{
	return dat_ejecutar_devoclie($datos, $id,$bodega);
	exit;
}
function log_conectar_devoclie($datos, $id,$bodega)
{
	return dat_conectar_devoclie($datos, $id,$bodega);
	exit;
}

function log_obtener_devoclie_cmb($bodega)
{
	return dat_obtener_devoclie_cmb($bodega);
	exit;
}

function log_obtener_devoclie_cmbZZZ()
{
	return dat_obtener_devoclie_cmbZZZ();
	exit;
}
function log_vecontador_devoclie($datos,$bodega)
{
	return dat_vecontador_devoclie($datos,$bodega);
	exit;
}

function log_vecodservi_devoclie($codigoservi)
{
	return dat_vecodservi_devoclie($codigoservi);
	exit;
}

function log_validaconexion_devoclie($tconexion,$cliente,$bodx)
{
	return dat_validaconexion_devoclie($tconexion,$cliente,$bodx);
	exit;
}
function log_obtener_tipodev_cmb()
{
	return dat_obtener_tipodev_cmb();
	exit;
}



?>