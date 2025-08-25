<?php
require "dat_base.php";  

function dat_validar_cambiopldeta($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from entradas where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_cambiopldeta($datos,$bodega)
{
global $parametros , $conexion ;

$cliente=$datos['Cod_cliente'];
$usuario=$_SESSION["idusuarios"];
$fecha1=$datos['Fechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

//Buscando costo de planes
$costoplan="";
$nplan="";
$Mttplan=$datos['Mttplan'];
$sentencia = "select nombre_plan,costo from planes where cod_plan='".$Mttplan."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $costoplan=$filaz['costo'];
    $nplan=$filaz['nombre_plan'];
  }
   $sentencia = "insert into cambiopl (cod_cliente,fecha,valorplan,nombre,idusuarios,sucursal,fechareg,ttplan,motivo) 
 					VALUES ('".$datos['Cod_cliente']."','".$fechai."','".$costoplan."','".$nplan."','".$usuario."',".$bodega.",now(),'".$datos['Mttplan']."','".$datos['Motivo']."')";
   $resultado = mysql_query($sentencia);

// Actualizando el registro del cliente con el nuevo plan 
    $sentencia = "update clientes set valorplan='".$costoplan."',ttplan='".$datos['Mttplan']."' where cod_cliente='".$cliente."' and sucursal=".$bodega.";";  
    $resultado2 = mysql_query($sentencia);


   return $resultado;
   exit;
}



function dat_obtener_cambiopldeta($bodega,$comienzo,$cant,$clie)
{
//se queda
	global $parametros , $conexion ;
	$sentencia="select DATE_FORMAT(fecha,'%d/%m/%Y') 'Fecha cambio', motivo 'Motivo del cambio', nombre 'Nombre del nuevo plan', valorplan 'Valor'
					from cambiopl where sucursal='".$bodega."' and cod_cliente='".$clie."'
					order by fecha LIMIT $comienzo, $cant";
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_cambiopldetauno($id)
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