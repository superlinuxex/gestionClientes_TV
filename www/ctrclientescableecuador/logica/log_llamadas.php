<?php
//importando clase superiores
include 'datos/dat_llamadas.php';

function log_obtener_llamadas($bodega,$comienzo, $cant)
{
	return dat_obtener_llamadas($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_listamateriales($clie,$bodega,$comienzo, $cant)
{
	return dat_obtener_listamateriales($clie,$bodega,$comienzo, $cant);

	exit;
}

function log_obtener_llamadas_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_llamadas_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_llamadas_filtro2($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_llamadas_filtro2($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_llamadas2($id,$bodega)
{
	return dat_obtener_llamadas2($id,$bodega);

	exit;
}

function log_obtener_num_llamadas($bodega)
{
	return dat_obtener_num_llamadas($bodega);
	exit;
}

function log_obtener_num_llamadas_filtro($bodega,$filtro)
{
	return dat_obtener_num_llamadas_filtro($bodega,$filtro);
	exit;
}

function log_obtener_num_llamadas_filtro2($bodega,$filtro)
{
	return dat_obtener_num_llamadas_filtro2($bodega,$filtro);
	exit;
}

function log_obtener_num_listamateriales($clie,$bodega)
{
	return dat_obtener_num_listamateriales($clie,$bodega);
	exit;
}
function log_insertar_llamadas($datos,$bode,$usuario)
{
	return dat_insertar_llamadas($datos,$bode,$usuario);
	exit;
}

function log_eliminar_llamadas($id,$bodega)
{
	return dat_eliminar_llamadas($id,$bodega);
	exit;
}

function log_actualizar_llamadas($datos, $id,$bodega)
{
	return dat_actualizar_llamadas($datos, $id,$bodega);
	exit;
}
function log_reprogramar_llamadas($datos, $id,$bodega)
{
	return dat_reprogramar_llamadas($datos, $id,$bodega);
	exit;
}
function log_ejecutar_llamadas($datos, $id,$bodega)
{
	return dat_ejecutar_llamadas($datos, $id,$bodega);
	exit;
}
function log_conectar_llamadas($datos, $id,$bodega)
{
	return dat_conectar_llamadas($datos, $id,$bodega);
	exit;
}

function log_obtener_llamadas_cmb($bodega)
{
	return dat_obtener_llamadas_cmb($bodega);
	exit;
}

function log_obtener_llamadas_cmbZZZ()
{
	return dat_obtener_llamadas_cmbZZZ();
	exit;
}
function log_vecontador_llamadas($datos,$bodega)
{
	return dat_vecontador_llamadas($datos,$bodega);
	exit;
}

function log_vecodservi_llamadas($codigoservi)
{
	return dat_vecodservi_llamadas($codigoservi);
	exit;
}

function log_validaconexion_llamadas($tconexion,$cliente,$bodx)
{
	return dat_validaconexion_llamadas($tconexion,$cliente,$bodx);
	exit;
}


?>