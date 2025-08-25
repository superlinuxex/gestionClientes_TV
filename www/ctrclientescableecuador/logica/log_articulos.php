<?php
//importando clase superiores
include 'datos/dat_articulos.php';

function log_obtener_articulos($comienzo, $cant)
{
	return dat_obtener_articulos($comienzo, $cant);

	exit;
}

function log_obtener_articulos_filtro($comienzo, $cant, $filtro)
{
	return dat_obtener_articulos_filtro($comienzo, $cant, $filtro);

	exit;
}

function log_obtener_articulo($id)
{
	return dat_obtener_articulo($id);

	exit;
}

function log_obtener_num_articulos()
{
	return dat_obtener_num_articulos();
	exit;
}

function log_obtener_num_articulos_filtro($filtro)
{
	return dat_obtener_num_articulos_filtro($filtro);
	exit;
}

function log_insertar_articulo($datos)
{
	return dat_insertar_articulo($datos);
	exit;
}

function log_eliminar_articulo($id)
{
	return dat_eliminar_articulo($id);
	exit;
}

function log_actualizar_articulo($datos, $id)
{
	return dat_actualizar_articulo($datos, $id);
	exit;
}

function log_obtener_articulos_cmb($hcodarti)
{
	return dat_obtener_articulos_cmb($hcodarti);
	exit;
}


function log_obtener_articulos_cmbxy($tipo)
{
	return dat_obtener_articulos_cmbxy($tipo);
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

function log_ve_existenciaantes_de_borrar($cod)
{

   return dat_ve_existenciaantes_de_borrar($cod);
   exit;
}

function log_vemovi_articulos($cod)
{
   return dat_vemovi_articulos($cod);
   exit;
}

function log_obtener_cod_expe($tipomov)
{
	return dat_obtener_cod_expe($tipomov);
	exit;
}

?>