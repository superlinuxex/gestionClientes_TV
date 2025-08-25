<?php
require "dat_base.php";  

function dat_validar_moracerodeta($id)
{
global $parametros , $conexion ;
    $sentencia = "select * from entradas where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_moracerodeta($datos,$bodega,$mora)
{
global $parametros , $conexion ;

$cliente=$_SESSION["ccliente"];
$usuario=$_SESSION["idusuarios"];

$moraperdon=$mora-$datos['Mvalor'];

$fecha1=$datos['Fechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

   $sentencia = "insert into moracero (cod_cliente,fecha,valmora,motivo,idusuarios,sucursal,fechareg,valperdon) 
 					VALUES ('".$cliente."','".$fechai."','".$datos['Mvalor']."','".$datos['Mmotivo']."','".$usuario."',".$bodega.",now(),'".$moraperdon."')";
   $resultado = mysql_query($sentencia);

// Actualizando el registro del cliente el valor de la mora
    $sentencia = "update clientes set morahoy='".$datos['Mvalor']."' where cod_cliente='".$datos['Cliente']."' and sucursal=".$bodega.";";  
    $resultado2 = mysql_query($sentencia);


   return $resultado;
   exit;
}



function dat_obtener_moracerodeta($bodega,$comienzo,$cant,$clie)
{
	global $parametros , $conexion ;
	$sentencia="select DATE_FORMAT(fecha,'%d/%m/%Y') 'Fecha', motivo 'Motivo', valperdon 'Mora perdonada', valmora 'Saldo pendiente'
					from moracero where sucursal='".$bodega."' and cod_cliente='".$clie."'
					order by fecha LIMIT $comienzo, $cant";
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_moracerodetauno($id)
{
global $parametros , $conexion ;
$cliente=$_SESSION["ccliente"];
$bodega=$_SESSION["idBodega"];
	$sentencia="select cod_cliente Codigo,DATE_FORMAT(fechaini,'%d/%m/%Y') Fechai,DATE_FORMAT(fechafin,'%d/%m/%Y') Fechaf, mesnpagar Mes,case pagado when 0 then 'NO pagado' when 1 then 'Ya pagado' end Pagado,abonos Abonos
					from periodos where DATE_FORMAT(fechaini,'%d/%m/%Y')='".$id."' and cod_cliente='".$cliente."' and sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


?>