<?php
require "dat_base.php";  

function dat_obtener_servicios_cmbtecnicoadi2()
{
global $parametros , $conexion ;
//solo actividades que pueden solicitar los tecnicos
$bandera1="O";
$bandera2="998";
$bandera3="999";
$bandera4="M";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where codservi='".$bandera3."' or codservi='".$bandera2."' or tipoacti='".$bandera1."' or tipoacti='".$bandera4."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios_cmbnoadmi2()
{
global $parametros , $conexion ;
//todas las actividades menos las administrativas
$bandera="O";
$bandera2="999";
$bandera3="998";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where tipoacti='".$bandera."' or codservi='".$bandera2."' or codservi='".$bandera3."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios_cmb()
{
global $parametros , $conexion ;
//Todos los servicios
    $sentencia = "select codservi Codigo, nom_servi Nombre, costoservi Costo from servicios
					order by codservi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_servicios_cmbconec()
{
global $parametros , $conexion ;
//solo actividades de conexion
$bandera="1";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where conectacl='".$bandera."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_servicios_cmbdconec()
{
global $parametros , $conexion ;
//solo actividades de desconexion
$bandera="0";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where conectacl='".$bandera."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios_cmbtecnico()
{
global $parametros , $conexion ;
$bandera3="R";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where amplitud!='".$bandera3."' and orden!='".$bandera."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios_cmbtecnicoadi()
{
global $parametros , $conexion ;
//solo actividades que pueden solicitar los tecnicos
$bandera=0;
$bandera2="12";
$bandera4="4";
$bandera5="999";
$bandera3="R";
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where conectacl!=0 and codservi!='".$bandera5."' and codservi!='".$bandera2."' and codservi!='".$bandera4."' and amplitud!='".$bandera3."' and orden!='".$bandera."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios_cmbnoadmi()
{
global $parametros , $conexion ;
//todas las actividades menos las administrativas
$bandera=0;
    $sentencia = "select codservi Codigo, nom_servi Nombre from servicios where orden!='".$bandera."'
					order by nom_servi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicios($comienzo, $cant)
{
global $parametros , $conexion ;
    $sentencia = "select codservi 'Codigo', nom_servi 'Nombre',costoservi 'Costo',
          case conectacl when 1 then 'Conecta el servicio' when 0 then 'Desconecta el servicio' when 2 then 'Otros servicios' end 'Accion sobre cliente'
	  ,case tipoacti when 'A' then 'Administrativo' when 'O' then 'Operaciones' when 'M' then 'Mantenimiento' end 'Tipo de servicio'
	  ,case amplitud when 'C' then 'Aplicado a cliente' when 'R' then 'Aplicado a red' end 'Alcance' 
	 FROM servicios order by codservi LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_servicio($id)
{
	global $parametros , $conexion ;
    $sentencia = "select codservi 'Codigo', nom_servi 'Nombre',conectacl 'Conectacl',costoservi 'Costo', orden 'Orden',tipoacti 'Tiposer',amplitud 'Alcance'  FROM servicios
				  where codservi='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_servicios()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM servicios";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_servicios($datos)
{
global $parametros , $conexion ;
$usux=$_SESSION['idusuarios'];
    $sentencia = "insert into servicios (codservi,nom_servi,costoservi,idusuarios,fechareg,conectacl,orden,tipoacti,amplitud)
					values('".$datos['Codigo']."','".$datos['Nombre']."','".$datos['Costo']."','".$usux."',now(),'".$datos['Conectacl']."','".$datos['Orden']."','".$datos['Tiposer']."','".$datos['Alcance']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_servicios($id)
{
global $parametros , $conexion ;
if($id!=intval('1') and $id!=intval('999') and $id!=intval('998') and $id!=intval('11') and $id!=intval('12') and $id!=intval('20') and $id!=intval('4') and $id!=intval('7') and $id!=intval('8') and $id!=intval('16'))
{
    $sentencia = "delete from servicios where codservi='$id';";  
    $resultado = mysql_query($sentencia);
}
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_servicios($datos, $id)
{
global $parametros , $conexion ;
$usux=$_SESSION['idusuarios'];
if($id!=intval('1') and $id!=intval('999') and $id!=intval('998') and $id!=intval('11') and $id!=intval('12') and $id!=intval('20') and $id!=intval('4') and $id!=intval('7') and $id!=intval('8') and $id!=intval('16'))
{
    $sentencia = "update servicios set usuariom='".$usux."',fechamod=now(),nom_servi='".$datos['Nombre']."',costoservi='".$datos['Costo']."',conectacl='".$datos['Conectacl']."',orden='".$datos['Orden']."',tipoacti='".$datos['Tiposer']."',amplitud='".$datos['Alcance']."' where codservi='".$id."';";  
    $resultado = mysql_query($sentencia);
}

	return $resultado;
	exit;
}


?>