<?php
//importando clase superiores
include 'datos/dat_ajustesi.php';

function log_obtener_ajustesi($bodega,$comienzo, $cant)
{
	return dat_obtener_ajustesi($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_ajustesi_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	return dat_obtener_ajustesi_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2);

	exit;
}

function log_obtener_ajustesi2($id,$bodega)
{
	return dat_obtener_ajustesi2($id,$bodega);

	exit;
}

function log_obtener_num_ajustesi($bodega)
{
	return dat_obtener_num_ajustesi($bodega);
	exit;
}

function log_obtener_num_ajustesi_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_ajustesi_filtro($bodega,$filtro1,$filtro2);
	exit;
}

function log_insertar_ajustesi($datos,$bode,$usuario)
{
	return dat_insertar_ajustesi($datos,$bode,$usuario);
	exit;
}

function log_eliminar_ajustesi($id,$bodega,$registro)
{
	return dat_eliminar_ajustesi($id,$bodega,$registro);
	exit;
}

function log_actualizar_ajustesi($datos, $id,$bodega,$registro)
{
	return dat_actualizar_ajustesi($datos, $id,$bodega,$registro);
	exit;
}

function log_obtener_ajustesi_cmb($bodega)
{
	return dat_obtener_ajustesi_cmb($bodega);
	exit;
}
function log_veexisreg_ajustesi($datos,$bodega)
{
	return dat_veexisreg_ajustesi($datos,$bodega);
	exit;
}


function log_obtener_ajustesi_cmb_filtro($prod)
{
	return dat_obtener_ajustesi_cmb_filtro($prod);
	exit;
}

function log_obtener_ajustesi_x_bodega_cmb($bodega)
{
	return dat_obtener_ajustesi_x_bodega_cmb($bodega);
	exit;
}

?>