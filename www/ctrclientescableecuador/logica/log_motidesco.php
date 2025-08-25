<?php
//importando clase superiores
include 'datos/dat_motidesco.php';

function log_obtener_motidesco_cmb()
{
	return dat_obtener_motidesco_cmb();

	exit;
}
function log_obtener_motidesco($comienzo, $cant)
{
	return dat_obtener_motidesco($comienzo, $cant);
	exit;
}

function log_obtener_motidescouno($id)
{
	return dat_obtener_motidescouno($id);
	exit;
}

function log_obtener_num_motidesco()
{
	return dat_obtener_num_motidesco();
	exit;
}


function log_insertar_motidesco($datos)
{
	return dat_insertar_motidesco($datos);
	exit;
}

function log_eliminar_motidesco($id)
{
	return dat_eliminar_motidesco($id);
	exit;
}

function log_actualizar_motidesco($datos, $id)
{
	return dat_actualizar_motidesco($datos, $id);
	exit;
}


?>