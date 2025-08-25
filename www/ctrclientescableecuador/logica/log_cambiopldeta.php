<?php
//importando clase superiores
include 'datos/dat_cambiopldeta.php';

function log_validar_cambiopldeta($id)
{
	return dat_validar_cambiopldeta($id);
	exit;
}

function log_insertar_cambiopldeta($datos,$bodega)
{
	return dat_insertar_cambiopldeta($datos,$bodega);
	exit;
}

function log_obtener_cod_cambiopldeta()
{
	return dat_obtener_cod_cambiopldeta();
	exit;
}

function log_obtener_cambiopldeta($bodega,$comienzo,$cant,$clie)
{
	return dat_obtener_cambiopldeta($bodega,$comienzo, $cant,$clie);
	exit;
}


function log_obtener_cambiopldeta_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_cambiopldeta_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_cambiopldetauno($id)
{
	return dat_obtener_cambiopldetauno($id);
	exit;
}

function log_actualizar_cambiopldeta($datos,$tipo)
{
	return dat_actualizar_cambiopldeta($datos,$tipo);
	exit;
}





?>