<?php
//importando clase superiores
include 'datos/dat_cambiarcos.php';

function log_obtener_kardex($bodega,$comienzo, $cant)
{
	return dat_obtener_kardex($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_kardex_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_kardex_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_kardex2($id,$bodega)
{
	return dat_obtener_kardex2($id,$bodega);

	exit;
}

function log_obtener_num_kardex($bodega)
{
	return dat_obtener_num_kardex($bodega);
	exit;
}

function log_obtener_num_kardex_filtro($bodega,$filtro)
{
	return dat_obtener_num_kardex_filtro($bodega,$filtro);
	exit;
}

function log_insertar_kardex($datos,$bode,$usuario)
{
	return dat_insertar_kardex($datos,$bode,$usuario);
	exit;
}

function log_eliminar_kardex($id,$bodega)
{
	return dat_eliminar_kardex($id,$bodega);
	exit;
}

function log_actualizar_kardex($datos,$id,$bodega)
{
	return dat_actualizar_kardex($datos,$id,$bodega);
	exit;
}

function log_obtener_kardex_cmb($bodega)
{
	return dat_obtener_kardex_cmb($bodega);
	exit;
}

function log_obtener_kardex_cmbZZZ()
{
	return dat_obtener_kardex_cmbZZZ();
	exit;
}

function log_veexisreg_kardex($datos,$bodega)
{
	return dat_veexisreg_kardex($datos,$bodega);
	exit;
}


function log_obtener_articulos_cmb_filtro($prod)
{
	return dat_obtener_articulos_cmb_filtro($prod);
	exit;
}

function log_obtener_articulos_x_bodega_cmb($bodega)
{
	return dat_obtener_articulos_x_bodega_cmb($bodega);
	exit;
}

?>