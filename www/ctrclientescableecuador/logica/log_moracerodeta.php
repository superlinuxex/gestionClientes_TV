<?php
//importando clase superiores
include 'datos/dat_moracerodeta.php';

function log_validar_moracerodeta($id)
{
	return dat_validar_moracerodeta($id);
	exit;
}

function log_insertar_moracerodeta($datos,$bodega,$mora)
{
	return dat_insertar_moracerodeta($datos,$bodega,$mora);
	exit;
}

function log_obtener_cod_moracerodeta()
{
	return dat_obtener_cod_moracerodeta();
	exit;
}

function log_obtener_moracerodeta($bodega,$comienzo,$cant,$clie)
{
	return dat_obtener_moracerodeta($bodega,$comienzo, $cant,$clie);
	exit;
}


function log_obtener_moracerodeta_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_moracerodeta_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_moracerodetauno($id)
{
	return dat_obtener_moracerodetauno($id);
	exit;
}

function log_actualizar_moracerodeta($datos,$tipo)
{
	return dat_actualizar_moracerodeta($datos,$tipo);
	exit;
}





?>