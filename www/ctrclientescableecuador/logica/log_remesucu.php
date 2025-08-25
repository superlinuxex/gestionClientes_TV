<?php
//importando clase superiores
include 'datos/dat_remesucu.php';

function log_obtener_remesucu_cmb()
{
	return dat_obtener_remesucu_cmb();

	exit;
}

function log_obtener_remesas_cmb($bodega)
{
	return dat_obtener_remesas_cmb($bodega);

	exit;
}


function log_obtener_remesucus($bodega,$comienzo, $cant)
{
	return dat_obtener_remesucus($bodega,$comienzo, $cant);
	exit;
}

function log_obtener_remesucus_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	return dat_obtener_remesucus_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2);
	exit;
}

function log_obtener_num_remesucus_filtro($bodega,$filtro1,$filtro2)
{
	return dat_obtener_num_remesucus_filtro($bodega,$filtro1,$filtro2);
	exit;
}



function log_obtener_remesucu($id,$bodega)
{
	return dat_obtener_remesucu($id,$bodega);
	exit;
}
function log_obtener_num_remesucu($bodega)
{
	return dat_obtener_num_remesucu($bodega);
	exit;
}


function log_insertar_remesucu($datos,$bodega)
{
	return dat_insertar_remesucu($datos,$bodega);
	exit;
}

function log_eliminar_remesucu($id,$bodega)
{
	return dat_eliminar_remesucu($id,$bodega);
	exit;
}

function log_actualizar_remesucu($datos, $id,$bodega)
{
	return dat_actualizar_remesucu($datos, $id,$bodega);
	exit;
}
?>