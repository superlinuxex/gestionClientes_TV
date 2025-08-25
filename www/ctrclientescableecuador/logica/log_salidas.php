<?php
//importando clase superiores
include 'datos/dat_salidas.php';

function log_validar_salida($id)
{
	return dat_validar_salida($id);
	exit;
}

function log_insertar_salida($datos)
{
	return dat_insertar_salida($datos);
	exit;
}

function log_eliminar_salida($id)
{
	return dat_eliminar_salida($id);
	exit;
}

function log_obtener_salidas_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_salidas_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_salida($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_salida($cod_encabezado, $cod_detalle);
	exit;
}


function log_obtener_detalle_salida_nuevo($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_salida_nuevo($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_detalle_salida_nuevo2($cod_encabezado, $cod_detalle, $bodega)
{
	return dat_obtener_detalle_salida_nuevo2($cod_encabezado, $cod_detalle, $bodega);
	exit;
}


function log_obtener_num_salidas_detalle($codigo)
{
	return dat_obtener_num_salidas_detalle($codigo);
	exit;
}

function log_insertar_salida_detalle($datos,$Encabezado)
{
	return dat_insertar_salida_detalle($datos,$Encabezado);
	exit;
}

function log_actualizar_salida_detalle($datos,$Encabezado,$registro)
{
	return dat_actualizar_salida_detalle($datos,$Encabezado,$registro);
	exit;
}

function log_eliminar_salida_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$registro,$param)
{
	return dat_eliminar_salida_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$registro,$param);
	exit;
}


function log_ve_estatus_salida($cod_encabezado)
{
	return dat_ve_estatus_salida($cod_encabezado);
	exit;
}



function log_obtener_precio_prod($prod,$bodega)
{
	return dat_obtener_precio_prod($prod,$bodega);
	exit;
}

function log_validar_existencia($bodega,$producto,$cant)
{
	return dat_validar_existencia($bodega,$producto,$cant);
	exit;
}


function log_validar_precio($producto)
{
	return dat_validar_precio($producto);
	exit;
}

function log_obtener_cod_salida3()
{
	return dat_obtener_cod_salida3();
	exit;
}

function log_obtener_cod_salida()
{
	return dat_obtener_cod_salida();
	exit;
}


function log_obtener_cod_vale($bodega)
{
	return dat_obtener_cod_vale($bodega);
	exit;
}

function log_obtener_cod_vale3($bodega)
{
	return dat_obtener_cod_vale3($bodega);
	exit;
}


function log_obtener_salidas($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_salidas($comienzo, $cant,$bodega,$filtro);
	exit;
}

function log_obtener_num_salidas($bodega,$filtro)
{
	return dat_obtener_num_salidas($bodega,$filtro);
	exit;
}

function log_obtener_salida($id)
{
	return dat_obtener_salida($id);
	exit;
}

function log_actualizar_salida($datos,$tipo)
{
	return dat_actualizar_salida($datos,$tipo);
	exit;
}
function log_obtener_salidas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	return dat_obtener_salidas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_salidas_fvale($bodega,$comienzo,$cant,$filtro1)
{
	return dat_obtener_salidas_fvale($bodega,$comienzo,$cant,$filtro1);
	exit;
}


function log_obtener_num_salidas_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_salidas_filtro($bodega,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_salidas_fvale($bodega,$filtro1)
{
	return dat_obtener_num_salidas_fvale($bodega,$filtro1);
	exit;
}


function log_obtener_destiace_cmb()
{
	return dat_obtener_destiace_cmb();

	exit;
}

function log_validar_docu_provee($Proveedor,$crf,$bodega)
{
	return dat_validar_docu_provee($Proveedor,$crf,$bodega);

	exit;
}

function log_obtener_ordenes_cmb($bodega)
{
	return dat_obtener_ordenes_cmb($bodega);
	exit;
}

function log_obtener_idenpaci_cmb($bodega)
{
	return dat_obtener_idenpaci_cmb($bodega);
	exit;
}

?>