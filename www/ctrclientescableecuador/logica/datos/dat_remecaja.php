<?php
require "dat_base.php";  

function dat_obtener_remecaja_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de proveedores para  poblar combobox
    $sentencia = "select codigo_prv Codigo, nombre Nombre from proveedores
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_remesas_cmb($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select numero Codigo, remesa Documento, fecha Fecha, monto Monto, saldo Saldo from remecaja where sucursal='".$bodega."'
					order by fecha";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_remecajas($comienzo, $cant)
{
	global $parametros , $conexion ;

    $sentencia = "select a.numero 'No.', a.remesa 'Cheque', DATE_FORMAT(a.fecha,'%d/%m/%Y') Fecha, a.monto 'Monto', a.responsable 'Acreedor', a.saldo 'Saldo' 
        FROM remecaja a order by a.numero LIMIT $comienzo, $cant";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_remecaja($id)
{
    global $parametros , $conexion ;
    $sentencia = "select numero 'Codigo', fecha 'Fecha',remesa 'Cheque',monto 'Monto',cuenta 'Cuenta',responsable 'Responsable',banco 'Banco',sucursal 'Acreedor',saldo 'Saldo' 
    FROM remecaja  where numero='$id'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_remecaja()
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM remecaja";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_remecaja($datos)
{
global $parametros , $conexion ;

$fecha1=$datos['Fecha'];

    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


	$sentencia="select case IFNULL(max(cast(numero as decimal)),0) when '0' then 1 else max(cast(numero as decimal))+1 end cod_entrada 
				FROM remecaja";
	$cod_tab=mysql_query($sentencia);
	$xnumereme=mysql_fetch_array($cod_tab);

    $sentencia = "insert into remecaja (numero,remesa,fecha,responsable,monto,sucursal,banco,cuenta,saldo)
					values('".$xnumereme['cod_entrada']."','".$datos['Remesa']."','".$fecha."','".$datos['Responsable']."','".$datos['Monto']."','".$datos['Sucursal']."','".$datos['Banco']."','".$datos['Cuenta']."','".$datos['Monto']."')";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_remecaja($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  remecaja where numero='$id';";  
    $resultado = mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_remecaja($datos, $id)
{
global $parametros , $conexion ;
 $fecha1=$datos['Fecha'];
 $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

    if(intval(substr($fecha1,6,4))>1900)
    {
    $sentencia = "update remecaja set fecha='".$fecha."'
    where numero='$id'";  
    $resultado = mysql_query($sentencia);
    }

    $sentencia = "update remecaja set remesa='".$datos['Remesa']."',responsable='".$datos['Responsable']."',monto='".$datos['Monto']."',sucursal='".$datos['Sucursal']."',banco='".$datos['Banco']."',cuenta='".$datos['Cuenta']."' where numero='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}
?>