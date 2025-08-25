<?php
//importando clase superiores
include 'datos/dat_actitecni.php';

function log_obtener_actitecni($bodega,$comienzo, $cant)
{
	return dat_obtener_actitecni($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_listamateriales($clie,$bodega,$comienzo, $cant)
{
	return dat_obtener_listamateriales($clie,$bodega,$comienzo, $cant);

	exit;
}

function log_obtener_actitecni_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_actitecni_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_actitecni2($id,$bodega)
{
	return dat_obtener_actitecni2($id,$bodega);

	exit;
}

function log_obtener_num_actitecni($bodega)
{
	return dat_obtener_num_actitecni($bodega);
	exit;
}

function log_obtener_num_actitecni_filtro($bodega,$filtro)
{
	return dat_obtener_num_actitecni_filtro($bodega,$filtro);
	exit;
}

function log_obtener_num_listamateriales($clie,$bodega)
{
	return dat_obtener_num_listamateriales($clie,$bodega);
	exit;
}
function log_insertar_actitecni($datos,$bode,$usuario)
{
	return dat_insertar_actitecni($datos,$bode,$usuario);
	exit;
}

function log_eliminar_actitecni($id,$bodega)
{
	return dat_eliminar_actitecni($id,$bodega);
	exit;
}

function log_actualizar_actitecni($datos, $id,$bodega)
{
	return dat_actualizar_actitecni($datos, $id,$bodega);
	exit;
}
function log_reprogramar_actitecni($datos, $id,$bodega)
{
	return dat_reprogramar_actitecni($datos, $id,$bodega);
	exit;
}
function log_ejecutar_actitecni($datos, $id,$bodega)
{
	return dat_ejecutar_actitecni($datos, $id,$bodega);
	exit;
}
function log_conectar_actitecni($datos, $id,$bodega)
{
	return dat_conectar_actitecni($datos, $id,$bodega);
	exit;
}

function log_obtener_actitecni_cmb($bodega)
{
	return dat_obtener_actitecni_cmb($bodega);
	exit;
}

function log_obtener_actitecni_cmbZZZ()
{
	return dat_obtener_actitecni_cmbZZZ();
	exit;
}
function log_vecontador_actitecni($datos,$bodega)
{
	return dat_vecontador_actitecni($datos,$bodega);
	exit;
}

function log_vecodservi_actitecni($codigoservi)
{
	return dat_vecodservi_actitecni($codigoservi);
	exit;
}

function log_validaconexion_actitecni($tconexion,$cliente,$bodx)
{
	return dat_validaconexion_actitecni($tconexion,$cliente,$bodx);
	exit;
}

function log_obtener_actitecni_filtrofec($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	return dat_obtener_actitecni_filtrofec($bodega,$comienzo,$cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_actitecni_filtrofec($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_actitecni_filtrofec($bodega,$filtro1,$filtro2);
	exit;
}

?>