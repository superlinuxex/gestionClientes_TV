<?php
//importando clase superiores
include 'datos/dat_vendedores.php';

function log_obtener_vendedores($bodega,$comienzo, $cant)
{
	return dat_obtener_vendedores($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_vendedores_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_vendedores_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_vendedores2($id,$bodega)
{
	return dat_obtener_vendedores2($id,$bodega);

	exit;
}

function log_obtener_num_vendedores($bodega)
{
	return dat_obtener_num_vendedores($bodega);
	exit;
}

function log_obtener_num_vendedores_filtro($bodega,$filtro)
{
	return dat_obtener_num_vendedores_filtro($bodega,$filtro);
	exit;
}

function log_insertar_vendedores($datos,$bode,$usuario)
{
	return dat_insertar_vendedores($datos,$bode,$usuario);
	exit;
}

function log_eliminar_vendedores($id,$bodega)
{
	return dat_eliminar_vendedores($id,$bodega);
	exit;
}

function log_actualizar_vendedores($datos, $id,$bodega)
{
	return dat_actualizar_vendedores($datos, $id,$bodega);
	exit;
}

function log_obtener_vendedores_cmb($bodega)
{
	return dat_obtener_vendedores_cmb($bodega);
	exit;
}

function log_obtener_vendedores_cmb1()
{
	return dat_obtener_vendedores_cmb1();
	exit;
}

function log_obtener_vendedores_cmb2()
{
	return dat_obtener_vendedores_cmb2();
	exit;
}
function log_obtener_vendedores_cmb33()
{
	return dat_obtener_vendedores_cmb33();
	exit;
}


function log_veexisreg_vendedores($datos,$bodega)
{
	return dat_veexisreg_vendedores($datos,$bodega);
	exit;
}


function log_obtener_vendedores_cmb_filtro($prod)
{
	return dat_obtener_vendedores_cmb_filtro($prod);
	exit;
}

function log_obtener_vendedores_x_bodega_cmb($bodega)
{
	return dat_obtener_vendedores_x_bodega_cmb($bodega);
	exit;
}

?>