<?php
require "dat_base.php";  

function dat_obtener_proveedores_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de proveedores para  poblar combobox
    $sentencia = "select codigo_prv Codigo, nombre Nombre from proveedores
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_proveedores($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select codigo_prv 'Codigo', nombre 'Nombre',contacto 'Contacto', telefonos 'Telefonos', email 'Email' FROM proveedores
				  order by codigo_prv LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_proveedor($id)
{
	global $parametros , $conexion ;
	//obtine la lista de proveedores del sistema
    $sentencia = "select codigo_prv 'Codigo', nombre 'Nombre',contacto 'Contacto',giro 'Giro',direccion 'Direccion',telefonos 'Telefonos',tmoviles 'Telefonosm',
                  ciudad 'Ciudad',pais 'Pais',rfiscal 'Rfiscal',nit 'Nit',email 'Email',sitioweb 'Url',estatus 'Estatus',cpostal 'Cpostal',
                  area_loc_contac Area,diasc Creditod,limi_cred Creditol,porce_descu Descu,tipo_prove Procedencia, obs Obs, aba Aba,sw Sw,email2 Email2, email3 Email3,contac2 Contac2 FROM proveedores
				  where codigo_prv='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_proveedores()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla proveedores    
    $sentencia = "SELECT COUNT(*) FROM proveedores";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_proveedor($datos)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla proveedores
    $sentencia = "insert into proveedores (codigo_prv,nombre,contacto,giro,direccion,telefonos,tmoviles,ciudad,pais,rfiscal,nit,email,sitioweb,estatus,cpostal,area_loc_contac,diasc,limi_cred,porce_descu,tipo_prove,obs,aba,sw,email2,email3,contac2)
					values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Contacto']."','".$datos['Giro']."','".$datos['Direccion']."','".$datos['Telefonos']."','".$datos['Telefonosm']."','".$datos['Ciudad']."','".$datos['Pais']."','".$datos['Rfiscal']."','".$datos['Nit']."','".$datos['Email']."','".$datos['Url']."','".$datos['Estatus']."','".$datos['Cpostal']."','".$datos['Area']."','".$datos['Creditod']."','".$datos['Creditol']."','".$datos['Descu']."','".$datos['Procedencia']."','".$datos['Obs']."','".$datos['Aba']."','".$datos['Sw']."','".$datos['Email2']."','".$datos['Email3']."','".$datos['Contac2']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_proveedor($id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla proveedores
    $sentencia = "delete from  proveedores where codigo_prv='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_proveedor($datos, $id)
{
global $parametros , $conexion ;
	//obtine total de registros de la tabla proveedores
    $sentencia = "update proveedores set nombre='".$datos['Nombre']."',contacto='".$datos['Contacto']."',giro='".$datos['Giro']."',
                                         direccion='".$datos['Direccion']."',telefonos='".$datos['Telefonos']."',tmoviles='".$datos['Telefonosm']."',ciudad='".$datos['Ciudad']."',pais='".$datos['Pais']."',
                                         rfiscal='".$datos['Rfiscal']."',nit='".$datos['Nit']."',email='".$datos['Email']."',sitioweb='".$datos['Url']."',estatus='".$datos['Estatus']."',cpostal='".$datos['Cpostal']."',area_loc_contac='".$datos['Area']."',diasc='".$datos['Creditod']."',limi_cred='".$datos['Creditol']."',porce_descu='".$datos['Descu']."',tipo_prove='".$datos['Procedencia']."',obs='".$datos['Obs']."',aba='".$datos['Aba']."',sw='".$datos['Sw']."',email2='".$datos['Email2']."',email3='".$datos['Email3']."',contac2='".$datos['Contac2']."' where codigo_prv='".$id."';";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>