<?php
include 'datos/dat_facturas.php';

function log_validar_factura($id,$tipo,$fecha,$bodega)
{
	return dat_validar_factura($id,$tipo,$fecha,$bodega);
	exit;
}
function log_validar_talonario($id,$tipo,$fecha,$bodega)
{
	return dat_validar_talonario($id,$tipo,$fecha,$bodega);
	exit;
}

function log_insertar_factura($factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario)
{
	return dat_insertar_factura($factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario);
	exit;
}

function log_eliminar_factura($id)
{
	return dat_eliminar_factura($id);
	exit;
}

function log_obtener_facturas_detalle($comienzo, $cant,$factura,$tipo,$fecha,$bodega)
{
	return dat_obtener_facturas_detalle($comienzo, $cant,$factura,$tipo,$fecha,$bodega);
	exit;
}

function log_obtener_detalle_facturas($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_facturas($cod_encabezado, $cod_detalle);
	exit;
}


function log_obtener_detalle_facturas_nuevo($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_facturas_nuevo($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_detalle_facturas_nuevo2($factura,$tipo,$fecha,$item)
{
	return dat_obtener_detalle_facturas_nuevo2($factura,$tipo,$fecha,$item);
	exit;
}

function log_obtener_num_facturas_detalle($factura,$tipo,$fecha,$bodega)

{
	return dat_obtener_num_facturas_detalle($factura,$tipo,$fecha,$bodega);
	exit;
}

function log_insertar_facturas_detalle($datos,$factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario)
{
	return dat_insertar_facturas_detalle($datos,$factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario);
	exit;
}

function log_actualizar_facturas_detalle($_POST,$Encabezado,$registro)
{
	return dat_actualizar_facturas_detalle($_POST,$Encabezado,$registro);
	exit;
}

function log_eliminar_facturas_detalle($factura,$tipo,$fecha,$item)
{
	return dat_eliminar_facturas_detalle($factura,$tipo,$fecha,$item);
	exit;
}

function log_obtener_cod_facturas3()
{
	return dat_obtener_cod_facturas3();
	exit;
}

function log_obtener_cod_facturas()
{
	return dat_obtener_cod_facturas();
	exit;
}


function log_obtener_cod_valefac($bodega)
{
	return dat_obtener_cod_valefac($bodega);
	exit;
}

function log_obtener_facturas($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_facturas($comienzo, $cant,$bodega,$filtro);
	exit;
}

function log_obtener_num_facturas($bodega,$filtro)
{
	return dat_obtener_num_facturas($bodega,$filtro);
	exit;
}

function log_obtener_factura($id,$id2,$id3)
{
	return dat_obtener_factura($id,$id2,$id3);
	exit;
}
function log_obtener_facturamodi($id,$id2,$id3)
{
	return dat_obtener_facturamodi($id,$id2,$id3);
	exit;
}

function log_actualizar_factura($datos)
{
	return dat_actualizar_factura($datos);
	exit;
}

function log_anular_factura($datos)
{
	return dat_anular_factura($datos);
	exit;
}
function log_eliminarglob_factura($datos)
{
	return dat_eliminarglob_factura($datos);
	exit;
}

function log_obtener_facturas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	return dat_obtener_facturas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_facturas_fvale($bodega,$comienzo,$cant,$filtro1)
{
	return dat_obtener_facturas_fvale($bodega,$comienzo,$cant,$filtro1);
	exit;
}


function log_obtener_num_facturas_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_facturas_filtro($bodega,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_facturas_fvale($bodega,$filtro1)
{
	return dat_obtener_num_facturas_fvale($bodega,$filtro1);
	exit;
}

function log_obtener_cuotaapagar_cliente($bodega,$cliente)
{
	return dat_obtener_cuotaapagar_cliente($bodega,$cliente);
	exit;
}

function log_obtener_periodoapagar_cliente($bodega,$cliente)
{
	return dat_obtener_periodoapagar_cliente($bodega,$cliente);
	exit;
}
function log_obtener_motianu_cmb()
{
	return dat_obtener_motianu_cmb();
	exit;
}
function log_obtener_direccion($id)
{
	return dat_obtener_direccion($id);
	exit;
}
function log_obtener_datos_cliente($xxcliente,$bodx)
{
	return dat_obtener_datos_cliente($xxcliente,$bodx);
	exit;
}



?>