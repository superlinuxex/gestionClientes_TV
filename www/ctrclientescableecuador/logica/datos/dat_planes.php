<?php
require "dat_base.php";  


function dat_obtener_planes_filtro($bodega,$comienzo, $cant, $filtro)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_plan 'Codigo', a.nombre_plan 'Nombre', a.costo 'Costo', a.fechainicial Inicia, a.fechafinal Finaliza, b.nombre Sucursal 
            FROM planes a, bodegas b 
            where a.sucursal=b.idbodegas and a.nombre_plan like '%".$filtro."%' order by a.nombre_plan LIMIT $comienzo, $cant";

    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_planes_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM planes ";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_planes_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select cod_plan Codigo, nombre_plan Nombre, costo Costo from planes
					order by nombre_plan";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_velocidad_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, nombre Nombre from velocidades
					order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_planes_cmb3($bodega)
{
	global $parametros , $conexion ;
//linea original cambada para Joel Mexico    $sentencia = "select cod_plan Codigo, nombre_plan Nombre, costo Costo from planes where sucursal='".$bodega."' and fechafinal>='".$xfecha1."'

        $xfecha1=date('Y-m-d');
    $sentencia = "select cod_plan Codigo, nombre_plan Nombre, costo Costo from planes where fechafinal>='".$xfecha1."'
					order by nombre_plan";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_planes($comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_plan 'Codigo', a.nombre_plan 'Nombre', a.costo 'Costo', a.fechainicial Inicia, a.fechafinal Finaliza, b.nombre Sucursal FROM planes a, bodegas b where a.sucursal=b.idbodegas
				  order by nombre_plan LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_plan($id)
{
	global $parametros , $conexion ;
    $sentencia = "select cod_plan 'Codigo', nombre_plan 'Nombre', costo 'Costo', fechainicial 'Fechai', fechafinal 'Fechaf', sucursal 'Bodega' FROM planes
				  where cod_plan='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_planes()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM planes";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_planes($datos)
{
global $parametros , $conexion ;
//armando el codigo y el concepto del nuevo plan

$plan="";
$dplan=$datos['Pbase'];
$sentencia = "select nombre from planbase where codigo='".$dplan."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaa=mysql_fetch_array($resultado);
    $plan=$filaa['nombre'];
  }

$velo="";
$xvelo=$datos['Velo'];
$sentencia = "select nombre from velocidades where codigo='".$xvelo."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaa=mysql_fetch_array($resultado);
    $velo=$filaa['nombre'];
  }


$equi="";
$dequi=$datos['Equi'];
$sentencia = "select descripcion from equiadi where codigo='".$dequi."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filad=mysql_fetch_array($resultado);
    $equi=$filad['descripcion'];
  }


$promo="";
$dpromo=$datos['Promo'];
$sentencia = "select descripcion from promociones where codigo='".$dpromo."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filac=mysql_fetch_array($resultado);
    $promo=$filac['descripcion'];
  }

$costo=0;
$dcosto=$datos['Tarifa'];
$sentencia = "select costo from tarifas where codigo='".$dcosto."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filad=mysql_fetch_array($resultado);
    $costo=$filad['costo'];
  }

    $fecha1=$datos['Fechai'];
    $fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fecha2=$datos['Fechaf'];
    $fechaf=substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);


$codigoplan=$datos['Pbase'].$datos['Velo'].$datos['Tarifa'].$datos['Equi'].$datos['Promo'].$datos['Bodega'];
$concepto=$plan;

    $sentencia = "insert into planes (cod_plan,nombre_plan,costo,fechainicial,fechafinal,sucursal)
					values('".$codigoplan."','".$concepto."','".$costo."','".$fechai."','".$fechaf."','".$datos['Bodega']."');";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_planes($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  planes where cod_plan='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_planes($datos, $id)
{
global $parametros , $conexion ;

    $fecha1=$datos['Fechai'];
    $fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fecha2=$datos['Fechaf'];
    $fechaf=substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

    $sentencia = "update planes set sucursal='".$datos['Bodega']."' where cod_plan='".$id."';";  
    $resultado = mysql_query($sentencia);



if(intval(substr($fecha1,6,4))>2012)
{
    $sentencia = "update planes set fechainicial='".$fechai."' where cod_plan='".$id."';";  
    $resultado = mysql_query($sentencia);
}
if(intval(substr($fecha2,6,4))>2012)
{
    $sentencia = "update planes set fechafinal='".$fechaf."' where cod_plan='".$id."';";  
    $resultado = mysql_query($sentencia);
}


	return $resultado;
	exit;
}

function dat_obtener_planbase1_cmb()
{
global $parametros , $conexion;
    $sentencia = "select codigo Codigo, nombre Nombre from planbase order by nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_promo1_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, descripcion Nombre from promociones
					order by descripcion";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_equi1_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, descripcion Nombre from equiadi
					order by descripcion";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_internet1_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, descripcion Nombre from serviinter
					order by descripcion";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_tarifa1_cmb()
{
	global $parametros , $conexion ;
    $sentencia = "select codigo Codigo, costo Costo from tarifas
					order by costo";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}




?>