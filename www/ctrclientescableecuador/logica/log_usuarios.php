<?php
//importando clase superiores
include 'datos/dat_usuarios.php';
function log_obtener_menu_ppl($perfil)
{
	return dat_obtener_menu_ppl($perfil);
	exit;
}
function log_obtener_menu_sub($perfil,$columna)
{
	return dat_obtener_menu_sub($perfil, $columna);
	exit;
}

function log_obtener_usuarios($comienzo, $cant)
{
	return dat_obtener_usuarios($comienzo, $cant);

	exit;
}

function log_obtener_usuarios_cmb()
{
	return dat_obtener_usuarios_cmb();

	exit;
}

function log_obtener_usuario($id)
{
	return dat_obtener_usuario($id);

	exit;
}

function log_obtener_num_usuarios()
{
	return dat_obtener_num_usuarios();
	exit;
}

function log_insertar_usuario($datos)
{
	return dat_insertar_usuario($datos);
	exit;
}

function log_eliminar_usuario($id)
{
	return dat_eliminar_usuario($id);
	exit;
}

function log_actualizar_usuario($datos, $id)
{
	return dat_actualizar_usuario($datos, $id);
	exit;
}

function log_reiniciar_usuario($nclave, $id)
{
	return dat_reiniciar_usuario($nclave, $id);
	exit;
}

function log_desactivar_usuario($nclave, $id)
{
	return dat_desactivar_usuario($nclave, $id);
	exit;
}


function  log_validar_clave($user, $pass)  
{  
	return dat_validar_clave($user, $pass);
	exit;
}

function log_usuarios_cambiar_clave($id, $clave)
{
	return dat_usuarios_cambiar_clave($id, $clave);
	exit;
}

?>