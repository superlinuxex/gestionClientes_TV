<?php
//importando clase superiores
include 'datos/dat_gastos.php';

function log_validar_gasto($id)
{
	return dat_validar_gasto($id);
	exit;
}
function log_insertar_gasto($codigo,$factura,$fovial,$partida,$proveedor,$tipo,$fecha1,$bodega_ent,$renta,$codigoempl,$lugarcon,$descuento,$usuarios,$observaciones,$justifica,$remesa)
{
	return dat_insertar_gasto($codigo,$factura,$fovial,$partida,$proveedor,$tipo,$fecha1,$bodega_ent,$renta,$codigoempl,$lugarcon,$descuento,$usuarios,$observaciones,$justifica,$remesa);
	exit;
}

function log_eliminar_gasto($id)
{
	return dat_eliminar_gasto($id);
	exit;
}

function log_obtener_gastos_detalle($comienzo, $cant,$codigo)
{
	return dat_obtener_gastos_detalle($comienzo, $cant,$codigo);
	exit;
}

function log_obtener_detalle_gasto($cod_encabezado, $cod_detalle)
{
	return dat_obtener_detalle_gasto($cod_encabezado, $cod_detalle);
	exit;
}

function log_obtener_num_gastos_detalle($codigo)
{
	return dat_obtener_num_gastos_detalle($codigo);
	exit;
}

function log_insertar_gasto_detalle($datos,$bodega,$codgasto1,$tipo,$docum,$fecha1,$proveedor,$renta,$fovial,$descuento,$numremesa)
{
	return dat_insertar_gasto_detalle($datos,$bodega,$codgasto1,$tipo,$docum,$fecha1,$proveedor,$renta,$fovial,$descuento,$numremesa);
	exit;
}

function log_insertar_existencia($datos,$bodega,$producto,$cant,$codgasto,$precio,$estado,$Encabezado)
{
	return dat_insertar_existencia($datos,$bodega,$producto,$cant,$codgasto,precio,$estado,$Encabezado);
	exit;
}

function log_actualizar_gasto_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$tipo)
{
	return dat_actualizar_gasto_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$tipo);
	exit;
}

function log_eliminar_gasto_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$tipo)
{
	return dat_eliminar_gasto_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$tipo);
	exit;
}

function log_obtener_cod_gasto()
{
	return dat_obtener_cod_gasto();
	exit;
}

function log_obtener_gastos($comienzo, $cant,$bodega,$filtro)
{
	return dat_obtener_gastos($comienzo, $cant,$bodega,$filtro);
	exit;
}


function log_obtener_gastos_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2)
{
	return dat_obtener_gastos_filtro($bodega,$comienzo, $cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_gastos_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_gastos_filtro($bodega,$filtro1,$filtro2);
	exit;
}


function log_obtener_num_gastos($bodega,$filtro)
{
	return dat_obtener_num_gastos($bodega,$filtro);
	exit;
}

function log_obtener_gasto($id)
{
	return dat_obtener_gasto($id);
	exit;
}

function log_actualizar_gasto($datos,$tipo)
{
	return dat_actualizar_gasto($datos,$tipo);
	exit;
}

function log_eliminar_gasto2($datos,$tipo)
{
	return dat_eliminar_gasto2($datos,$tipo);
	exit;
}

function log_ajustar_gasto2($datos,$tipo)
{
	return dat_ajustar_gasto2($datos,$tipo);
	exit;
}

function log_obtener_partidas_cmb($bodega)
{
	return dat_obtener_partidas_cmb($bodega);
	exit;
}
function log_obtener_tipogas_cmb()
{
	return dat_obtener_tipogas_cmb();
	exit;
}





?>