<?php
//importando clase superiores
include 'datos/dat_reportes.php';

function log_obtener_kardex($fecha_ini, $fecha_fin, $producto)
{
	return dat_obtener_kardex($fecha_ini, $fecha_fin, $producto);

	exit;
}

function log_obtener_existencias($proy,$bod,$prod)
{
	return dat_obtener_existencias($proy,$bod,$prod);

	exit;
}
?>