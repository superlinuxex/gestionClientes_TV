<?php
//importando clase superiores
include 'datos/dat_kardextot.php';

function log_obtener_kardextot($bodega,$comienzo, $cant)
{
	return dat_obtener_kardextot($bodega,$comienzo, $cant);

	exit;
}

function log_obtener_kardextot_filtro($bodega,$comienzo, $cant, $filtro)
{
	return dat_obtener_kardextot_filtro($bodega,$comienzo, $cant, $filtro);

	exit;
}

function log_obtener_kardex2tot($id,$bodega)
{
	return dat_obtener_kardex2tot($id,$bodega);

	exit;
}

function log_obtener_num_kardextot($bodega)
{
	return dat_obtener_num_kardextot($bodega);
	exit;
}

function log_obtener_num_kardextot_filtro($bodega,$filtro)
{
	return dat_obtener_num_kardextot_filtro($bodega,$filtro);
	exit;
}

function log_insertar_kardextot($datos,$bode,$usuario)
{
	return dat_insertar_kardextot($datos,$bode,$usuario);
	exit;
}

function log_eliminar_kardextot($id,$bodega)
{
	return dat_eliminar_kardextot($id,$bodega);
	exit;
}

function log_actualizar_kardextot($datos, $id,$bodega)
{
	return dat_actualizar_kardextot($datos, $id,$bodega);
	exit;
}

function log_obtener_kardextot_cmb($bodega)
{
	return dat_obtener_kardextot_cmb($bodega);
	exit;
}

function log_obtener_kardextot_cmbZZZ()
{
	return dat_obtener_kardextot_cmbZZZ();
	exit;
}

function log_veexisreg_kardextot($datos,$bodega)
{
	return dat_veexisreg_kardextot($datos,$bodega);
	exit;
}


function log_obtener_articulostot_cmb_filtro($prod)
{
	return dat_obtener_articulostot_cmb_filtro($prod);
	exit;
}

function log_obtener_articulostot_x_bodega_cmb($bodega)
{
	return dat_obtener_articulostot_x_bodega_cmb($bodega);
	exit;
}

?>