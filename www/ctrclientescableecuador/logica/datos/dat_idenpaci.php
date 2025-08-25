<?php
require "dat_base.php";  

function dat_obtener_idenpaci($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, a.celu Celular, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Poblacion', a.blocke 'IP'
          FROM clientes a where a.sucursal='".$bodega."' order by a.cod_cliente LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpacidesco($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
  $estadocli="0";
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, a.celu Celular, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Poblacion', a.blocke 'IP'
          FROM clientes a where a.sucursal='".$bodega."' and a.estatus='".$estadocli."' order by a.cod_cliente LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpacidescosinn($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
  $estadocli="0";
  $sinn=1;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, a.celu Celular, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Poblacion', a.blocke 'IP'
          FROM clientes a where a.sucursal='".$bodega."' and a.estatus='".$estadocli."' and a.bande1='".$sinn."' order by a.cod_cliente LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpacidescoconn($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
  $estadocli="0";
  $sinn=0;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, a.celu Celular, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Poblacion', a.blocke 'IP'
          FROM clientes a where a.sucursal='".$bodega."' and a.estatus='".$estadocli."' and a.bande1='".$sinn."' order by a.cod_cliente LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_idenpacicartera($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Region', a.ncase 'Urbanizacion', a.cod_vende 'Cobrador'
          FROM clientes a where a.sucursal='".$bodega."' order by a.fechareg DESC LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpacigen($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.sucursal Sucursal, a.nombre Nombres,a.apellido Apellidos, a.telefono Telefono, case a.estatus when '1' then 'Conectado'  
		          when '0' then 'Desconectado' end Estado, a.ncan 'Region', a.ncase 'Urbanizacion'
          FROM clientes a order by a.fechareg DESC LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_moracero($bodega,$comienzo, $cant)
{
global $parametros , $conexion ;
$estatus="0";
$estatus2="";
$morahoy=0;
$sentencia = "select a.cod_cliente Codigo, a.nombre Nombres, a.apellido Apellidos, a.morahoy 'Mora al corte', case a.estatus when '1' then 'Conectado' 
		          when '0' then 'Desconectado' end Estado
          FROM clientes a where a.sucursal='".$bodega."' and a.morahoy>'".$morahoy."' and (a.estatus='".$estatus."' or a.estatus='".$estatus2."') order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_listafac($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.numero Factura, a.fechafac Fecha,a.concepto Concepto, a.cantidad Cantidad, precio Precio, total Total, case a.anulada when '1' then 'Anulada' when '0' then 'Pagada' when ' ' then 'Pagada' end Estado
 
          FROM detafac a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' order by fechafac DESC LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
function dat_obtener_listaacti($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.fecha Asignado, a.nomservi 'Servicio dado',a.tarea 'Detalle de tarea', a.nomemple Tecnico, fechareali Realizado, observa Observaciones, fecharepro Reprogramado 
          FROM activi a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_listaplanes($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.fecha Fecha, a.ttplan 'Plan',a.nombre 'Nombre del plan', a.valorplan 'Cuota mensual', motivo 'Motivo del cambio de plan'
          FROM cambiopl a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_listallama($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.fecha Fecha,a.hora Hora, a.minuto Minu, a.motivo Motivo, respuesta Respuesta, comentario Comentario, nomemple Empleado 
          FROM llamadas a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, telefono Telefono, celu Celular, case a.estatus when '1' then 'Conectado' 
		          when '0' then 'Desconectado' end Estado,  a.ncan 'Poblacion', a.blocke 'IP'
		FROM clientes a where a.sucursal='".$bodega."' and
		  (a.celu like '%".$filtro."%' or a.cod_cliente like '%".$filtro."%' or a.apellido like '%".$filtro."%' or a.nombre like '%".$filtro."%' or a.telefono like '%".$filtro."%' or a.ncan like '%".$filtro."%' or a.blocke like '%".$filtro."%' or a.contaelec like '%".$filtro."%' or a.dui like '%".$filtro."%')
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_idenpaci_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla identificacion de clientes
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."' and (cod_cliente like '%".$filtro."%' or apellido like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}



function dat_obtener_idenpaci_filtrocartera($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, telefono Telefono, case a.estatus when '1' then 'Conectado' 
		          when '0' then 'Desconectado' end Estado,  a.ncan 'Region', a.ncase 'Urbanizacion', a.cod_vende 'Cobrador' 
		FROM clientes a where a.sucursal='".$bodega."' and a.cod_vende='".$filtro."'
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_filtrogen($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.sucursal Sucursal, a.nombre Nombres,a.apellido Apellidos, telefono Telefono, case a.estatus when '1' then 'Conectado' 
		          when '0' then 'Desconectado' end Estado,  a.ncan 'Region', a.ncase 'Urbanizacion' 
		FROM clientes a where (a.cod_cliente like '%".$filtro."%' or a.apellido like '%".$filtro."%' or a.nombre like '%".$filtro."%' or a.telefono like '%".$filtro."%' or a.ncan like '%".$filtro."%' or a.ncase like '%".$filtro."%' or a.contaelec like '%".$filtro."%')
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_filtro2($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, telefono Telefono, case a.estatus when '1' then 'Conectado' 
		          when '0' then 'Desconectado' end Estado 
		FROM clientes a where a.sucursal='".$bodega."' and
		  (a.telefono like '%".$filtro."%' or a.ncan like '%".$filtro."%' or a.ncase like '%".$filtro."%')
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_filtro_moracero($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
$estatus="0";
$morahoy=0;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Nombres,a.apellido Apellidos, telefono Telefono FROM clientes a where a.sucursal='".$bodega."' and morahoy>'".$morahoy."' and estatus='".$estatus."' and
		  (a.cod_cliente like '%".$filtro."%' or a.apellido like '%".$filtro."%')
          order by a.apellido LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_idenpaci2($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Mnombre, a.apellido Mapellido, case a.estatus when 1 then 'Conectado' when 0 then 'Desconectado' end Estadocli, a.estatus 'Estadohoy'
                         ,a.sexo Msexo,a.cargoadic Cargoadic, a.dui Mdui,a.nit Mnit,a.registro Mregistro,a.telefono Mtelefono,a.celu Mcelu,a.email Email,a.ttpersona Mttpersona,a.actividad Actividad
                         ,a.cod_depto Partida, a.cod_ciudad SubPartidas,a.cod_canton SubPartidas_a,a.cod_barrio SubPartidas_b,a.cod_caserio SubPartidas_c,a.calle Mcalle,a.ave Mave,a.pasaje Mpasaje,a.poligono Mpoligono,a.blocke Mblocke,a.casa Mcasa
                         ,a.vendedor Mvendedor,a.contaelec Mcontaelec,a.otraref Motraref,a.contrato Mcontrato,a.ttplan Mttplan,a.ttfactura Mttfactura,a.fechai Mfechai,a.codperi Mcodperi,a.cod_vende Mcod_vende,a.fechap Mfechap,a.longilati Mlongilati,a.cone Mcone
                         ,a.fechai Mfechai,a.marcha Mmarcha,a.poste Mposte,a.observacion Mobservacion,a.fechareg Mfechaentra,a.georeferencia Mgeo,valorplan Mmonto,limite Limite
                         ,DATE_FORMAT(a.ulfepago1,'%d/%m/%Y') Ulfepago1,DATE_FORMAT(a.ulfepago2,'%d/%m/%Y') Ulfepago2,a.ulmespago Ulmespago,DATE_FORMAT(a.fechaul,'%d/%m/%Y') Fechaul,a.ulpago Ulpago,a.fechaulme Fechaulme,a.morahoy Morahoy,a.fedesco Fedesco,a.fechaip Fechaip,a.fechai Fechai,a.abonomora Abonosmora, a.numeperi Numeperi, a.motidesco Motidesco, a.zona Mzona, a.bande1 Bande1, a.pidedesco Mpidiod
          FROM clientes a where a.sucursal='".$bodega."' and a.cod_cliente='$id'"; 
    $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
    return $resultado;
	exit;
}

function dat_obtener_idenpaci2nodo($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "select a.fquitanodo Fquitanodo, a.observa Mobserva, a.bande1 Mestadon,a.cod_cliente Codigo, a.nombre Mnombre, a.apellido Mapellido, case a.estatus when 1 then 'Conectado' when 0 then 'Desconectado' end Estadocli, a.estatus 'Estadohoy'
                         ,a.sexo Msexo, a.dui Mdui,a.nit Mnit,a.registro Mregistro,a.telefono Mtelefono,a.celu Mcelu,a.email Email,a.ttpersona Mttpersona,a.actividad Actividad
                         ,a.cod_depto Partida, a.cod_ciudad SubPartidas,a.cod_canton SubPartidas_a,a.cod_barrio SubPartidas_b,a.cod_caserio SubPartidas_c,a.calle Mcalle,a.ave Mave,a.pasaje Mpasaje,a.poligono Mpoligono,a.blocke Mblocke,a.casa Mcasa
                         ,a.vendedor Mvendedor,a.contaelec Mcontaelec,a.otraref Motraref,a.contrato Mcontrato,a.ttplan Mttplan,a.ttfactura Mttfactura,a.fechai Mfechai,a.codperi Mcodperi,a.cod_vende Mcod_vende,a.fechap Mfechap,a.longilati Mlongilati,a.cone Mcone
                         ,a.fechai Mfechai,a.marcha Mmarcha,a.poste Mposte,a.observacion Mobservacion,a.fechareg Mfechaentra,a.georeferencia Mgeo,valorplan Mmonto
                         ,DATE_FORMAT(a.ulfepago1,'%d/%m/%Y') Ulfepago1,DATE_FORMAT(a.ulfepago2,'%d/%m/%Y') Ulfepago2,a.ulmespago Ulmespago,DATE_FORMAT(a.fechaul,'%d/%m/%Y') Fechaul,a.ulpago Ulpago,a.fechaulme Fechaulme,a.morahoy Morahoy,a.fedesco Fedesco,a.fechaip Fechaip,a.fechai Fechai,a.abonomora Abonosmora, a.numeperi Numeperi, a.motidesco Motidesco, a.zona Mzona
          FROM clientes a where a.sucursal='".$bodega."' and a.cod_cliente='$id'"; 
    $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
    return $resultado;
	exit;
}


function dat_obtener_idenpaci_cod($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Xcodigo, a.nombre Xnombre, a.apellido Xapellido FROM clientes a where a.sucursal='".$bodega."' and a.cod_cliente='$id'"; 
    $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
    return $resultado;
	exit;
}


function dat_obtener_idenpaci_nombre($nombre,$ape,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Xcodigo, a.nombre Xnombre, a.apellido Xapellido FROM clientes a where a.sucursal='".$bodega."' and a.nombre='".$nombre."' and a.apellido='".$ape."'"; 
    $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
    return $resultado;
	exit;
}





function dat_obtener_idenpacigen2($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "select a.cod_cliente Codigo, a.nombre Mnombre, a.apellido Mapellido,case a.estatus when 1 then 'Conectado' when 0 then 'Desconectado' end Estadocli,estatus 'Estadohoy'
                         ,a.sexo Msexo, a.dui Mdui,a.nit Mnit,a.registro Mregistro,a.telefono Mtelefono,a.celu Mcelu,a.email Email,a.ttpersona Mttpersona,a.actividad Actividad
                         ,a.cod_depto Partida, a.cod_ciudad SubPartidas,a.cod_canton SubPartidas_a,a.cod_barrio SubPartidas_b,a.cod_caserio SubPartidas_c,a.calle Mcalle,a.ave Mave,a.pasaje Mpasaje,a.poligono Mpoligono,a.blocke Mblocke,a.casa Mcasa
                         ,a.vendedor Mvendedor,a.contaelec Mcontaelec,a.otraref Motraref,a.contrato Mcontrato,a.ttplan Mttplan,a.ttfactura Mttfactura,a.fechai Mfechai,a.codperi Mcodperi,a.cod_vende Mcod_vende,a.fechap Mfechap,a.longilati Mlongilati,a.cone Mcone
                         ,a.marcha Mmarcha,a.poste Mposte,a.observacion Mobservacion,a.fechareg Mfechaentra,a.georeferencia Mgeo,valorplan Mmonto
                         ,a.ulfepago1 Ulfepago1,a.ulfepago2 Ulfepago2,a.ulmespago Ulmespago,a.fechaul Fechaul,a.ulpago Ulpago,a.fechaulme Fechaulme,a.morahoy Morahoy,a.fedesco Fedesco,a.fechaip Fechaip,a.abonomora Abonosmora, a.numeperi Numeperi
          FROM clientes a where a.sucursal='$bodega' and a.cod_cliente='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_idenpaci($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_idenpacigen($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM clientes";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_idenpaci_moracero($bodega)
{
	global $parametros , $conexion ;
$estatus="0";
$morahoy=0;
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."' and estatus='".$estatus."' and morahoy>'".$morahoy."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_listafac($clie,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM detafac where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}
function dat_obtener_num_listaplanes($clie,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM cambiopl where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_num_listaacti($clie,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM activi where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_listallama($clie,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM llamadas where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_num_idenpaci_filtrocartera($bodega,$filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla identificacion de clientes
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."' and cod_vende='".$filtro."')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_idenpaci_filtrogen($bodega,$filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla identificacion de clientes
    $sentencia = "SELECT COUNT(*) FROM clientes where (cod_cliente like '%".$filtro."%' or apellido like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_idenpaci_filtro2($bodega,$filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla identificacion de clientes
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."' and (telefono like '%".$filtro."%' or ncan like '%".$filtro."%' or ncase like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_num_idenpaci_filtro_moracero($bodega,$filtro)
{
	global $parametros , $conexion ;
$estatus="0";
$morahoy=0;
    $sentencia = "SELECT COUNT(*) FROM clientes where sucursal='".$bodega."' and estatus='".$estatus."' and morahoy>'".$morahoy."' and (cod_cliente like '%".$filtro."%' or apellido like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_idenpaci($datos,$bode,$usuario)
{
global $parametros , $conexion ;

//codigo para generar un codigo de barras
$text=1;
$format="JPEG";
$quality=100;

$width=$_GET['width'];
$height=$_GET['height'];
$barcode=$_GET['barcode'];

if (!isset ($type)) $type = 1;
if (empty ($width)) $width = 145;
if (empty ($height)) $height = 48;

switch($type){
default:
$type = 1;
case 1:
//Barcode39($barcode, $width, $height, $quality, $format, $text);
break;
}
//



//obteniendo un correlativo para el codigo del cliente
$nummovi=0;
$codigomov="CLIENTES";
$sentencia="select numero id FROM correla2 where agencia='".$bode."' and codigo='".$codigomov."'";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id']+1;
    }
	else
    {
	$nummovi=1;
    }

$a="CLIENTES";
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

//Buscando costo de planes
$costoplan="";
$Mttplan=$datos['Mttplan'];
$fecha1=$datos['Mfechai'];
//$diadelmes=substr($fecha1,0,2);
//if($diadelmes=="01" or $diadelmes=="02")
//    {
//	$costoplan=150;
//    }
//    else
//    {
//	$costoplan=200;
//    }

$sentencia = "select cod_plan,costo from planes where cod_plan='".$Mttplan."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $mttplan=$filaz['cod_plan'];
    $costoplan=$filaz['costo'];
  }

//Buscando meses en periodos de contrato
$nmeses=0;
$periodo=$datos['Mcodperi'];
$sentencia = "select meses from pericon where codigoper='".$periodo."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filax=mysql_fetch_array($resultado);
    $nmeses=$filax['meses'];
  }


$vivienda=trim($datos['Mpasaje'])." ".trim($datos['Mpoligono'])." ".trim($datos['Mcasa']);
$fecha1=$datos['Mfechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fechaw=$datos['Ifecha'];
$fechains=substr($fechaw,6,4)."-".substr($fechaw,3,2)."-".substr($fechaw,0,2);
$estatus="1";

    $sentencia = "insert into clientes (cod_cliente,nombre,apellido,sexo,registro,dui,email,telefono,celu,nit,ttpersona,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,
                                        calle,ave,pasaje,poligono,casa,vivienda,otraref,blocke,fechai,ttfactura,ttplan,contrato,fechap,cod_vende,codperi,observacion,vendedor,fechay,idusuarios,sucursal,fechareg,actividad,valorplan,numeperi,contaelec,estatus,zona,fechaip,cone,longilati,cargoadic)  
					VALUES ('".$nummovi."','".$datos['Mnombre']."','".$datos['Mapellido']."','".$datos['Msexo']."','".$datos['Mregistro']."','".$datos['Mdui']."','".$datos['Email']."','".$datos['Mtelefono']."','".$datos['Mcelu']."','".$datos['Mnit']."','".$datos['Mttpersona']."','".$datos['Partida']."','".$datos['SubPartidas']."','".$datos['SubPartidas_a']."','".$datos['SubPartidas_b']."','".$datos['SubPartidas_c']."',
                                        '".$datos['Mcalle']."','".$datos['Mave']."','".$datos['Mpasaje']."','".$datos['Mpoligono']."','".$datos['Mcasa']."','".$vivienda."','".$datos['Motraref']."','".$datos['Mblocke']."','".$fechai."','".$datos['Mttfactura']."','".$Mttplan."','".$datos['Mcontrato']."','".$datos['Mfechap']."',
                                        '".$datos['Mcod_vende']."','".$datos['Mcodperi']."','".$datos['Mobservacion']."','".$datos['Mvendedor']."',now(),'".$usuario."','".$bode."',now(),'".$datos['Actividad']."','".$costoplan."','".$nmeses."','".$datos['Mcontaelec']."','".$estatus."','".$datos['Mzona']."','".$fechains."','".$datos['Mcone']."','".$datos['Mlongilati']."','".$datos['Mcadic']."')";
    $resultado = mysql_query($sentencia);


//Actualizando los nombres de las zonas geograficas
		$sentencia2 = "select cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio FROM clientes where cod_cliente='".$nummovi."' and sucursal='".$bode."'"; 
		$resultado2 = mysql_query($sentencia2);
                if(isset($resultado2))
                 {
   	          if(mysql_num_rows ( $resultado2 )!=0)
	           {
  	            $rowq=mysql_fetch_array($resultado2);
	            $xdepto=$rowq['cod_depto'];
		    $xmuni=$rowq['cod_ciudad'];
		    $xcanton=$rowq['cod_canton'];
		    $xbarrio=$rowq['cod_barrio'];
		    $xcaserio=$rowq['cod_caserio'];


			//buscando nombre de departamento
			  $xndepto="";
			  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xndepto=$rown['nom_depto'];
			    }
			   }

			//buscando nombre de municipio
			  $xnmuni="";
			  $sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xnmuni=$rown['nomb_ciudad'];
			    }
			   }

			//buscando nombre de canton
			  $xncanton="";
			  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xncanton=$rown['nombrecant'];
			    }
			   }


			//buscando nombre de barrio
			  $xnbarrio="";
			  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xnbarrio=$rown['nombrebarrio'];
			    }
			   }
		
			//buscando nombre de colonia
			  $xncaserio="";
			  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xncaserio=$rown['nombrecaserio'];
			    }
			   }
	
			//armando la direccion
			$tbarrio="";
			if($xnbarrio!="")
			{
			 $tbarrio="Barrio";
			}
			
			$tcaserio="";
			if($xncaserio!="")
			{
			 $tcaserio="Col.";
			}
			
			$tcalle="";
			if($xcalle!="")
			{
			 $tcalle="Calle";
			}

			$tave="";
			if($xave!="")
			{
			 $tave="Ave.";
			}

			$tpasaje="";
			if($xpasaje!="")
			{
			 $tpasaje="Pje.";
			}

			$tpoligono="";
			if($xpoligono!="")
			{
			 $tpoligono="Pol.";
			}

			$tbloque="";
			if($xblocke!="")
			{
			 $tbloque="Block.";
			}
			$xdireccion=$xnmuni;
		        $sentencia="update clientes set vivienda='".$xdireccion."',ndep='".$xndepto."',nmuni='".$xnmuni."',ncan='".$xncanton."',nbar='".$xnbarrio."',ncase='".$xncaserio."'  where cod_cliente='".$nummovi."' and sucursal='".$bode."'";
                        $resultado3 = mysql_query($sentencia);
                   }
                  }

//creando el registro de actividades tecnicas
//obteniendo un correlativo para codigo de ticket
$nummovi2=0;
$codigomov="TICKET";
$sentencia="select numero id FROM correla2 where agencia='".$bode."' and codigo='".$codigomov."'";
$resultadok = mysql_query($sentencia);
  if(mysql_num_rows ( $resultadok )!=0)
    {
	$fila=mysql_fetch_array($resultadok);
	$nummovi2=$fila['id']+1;
    }
	else
    {
	$nummovi2=1;
    }

$a="TICKET";
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

//Buscando el nombre de la actividad
$ntarea="";
$norden=0;
$tconexion="999";
$sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
$resultadol = mysql_query($sentencia);
if(mysql_num_rows ( $resultadol )!=0)
  {
    $filaz=mysql_fetch_array($resultadol);
    $ntarea=$filaz['nom_servi'];
    $norden=$filaz['orden'];
  }

//Buscando empleado
$nempleado="";
$templeado=$datos['Mcod_vende'];
$sentencia = "select nombre,apellido from empleados where cod_emple='".$templeado."'";  
$resultadol2 = mysql_query($sentencia);
if(mysql_num_rows ( $resultadol2 )!=0)
  {
    $filaz=mysql_fetch_array($resultadol2);
    $nempleado=$filaz['nombre']." ".$filaz['apellido'];
  }

//Buscando cliente
$ncliente="";
$xdepto="";
$xmuni="";
$xcanton="";
$xbarrio="";
$xcaserio="";
$xcalle="";
$xave="";
$xpasaje="";
$xpoligono="";
$xcasa="";
$xblocke="";
$tcliente=$nummovi;
$sentencia = "select * from clientes where cod_cliente='".$tcliente."' and sucursal='".$bode."'";  
$resultadol3 = mysql_query($sentencia);
if(mysql_num_rows ( $resultadol3 )!=0)
  {
    $filaz=mysql_fetch_array($resultadol3);
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $xdepto=$filaz['cod_depto'];
    $xmuni=$filaz['cod_ciudad'];
    $xcanton=$filaz['cod_canton'];
    $xbarrio=$filaz['cod_barrio'];
    $xcaserio=$filaz['cod_caserio'];
    $xpasaje=$filaz['pasaje'];
    $xpoligono=$filaz['poligono'];
    $xcasa=$filaz['casa'];
    $xblocke=$filaz['blocke'];
  }

$fecha1=$datos['Ifecha'];
$xcfecha="01";
$fechar=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecharxx=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".$xcfecha;
$xtarea="Instalacion del servicio"; 
    $codigomov=$nummovi2;
    $sentencia="select movimiento nmov FROM activi where sucursal='".$bode."' and movimiento='".$codigomov."'";
    $resultadoj = mysql_query($sentencia);
    if(mysql_num_rows ( $resultadoj )!=0)
     {
      $elresultado=1;
     }
	else
     {
      $elresultado=0;
     }
     if($elresultado==0)
     {
    $sentencia = "insert into activi (movimiento,ordentr,fechasoli,fecha,fechareali,tarea,cod_emple,nomemple,cod_cliente,nomclie,idusuarios,sucursal,fechareg,codservi,nomservi,direclie,orden)  
    					VALUES ('".$nummovi2."','".$datos['Nummovi2']."','".$fechar."','".$fechar."','".$fechar."','".$xtarea."','".$datos['Mcod_vende']."','".$nempleado."','".$nummovi."','".$ncliente."','".$usuario."','".$bode."',now(),'".$tconexion."','".$xtarea."','".$direccion."','".$norden."')";
    $resultadoy = mysql_query($sentencia);



//Actualizando el registro de programacion de pagos
   //iniciando el registro de periodos
   $fecha1=$datos['Ifecha'];
   //$fecha=$fechar;
   $b1=intval(substr($fecha1,0,2));
   $b2=intval(substr($fecha1,3,2));
   $b3=intval(substr($fecha1,6,4));
   $c1=$b1;
   $c2=$b2;
   $c3=$b3;
   if($b2==12)
    {
     $c2=1;
     $c3=$b3+1;
    }
    else
    {
     $c2=$b2+1;
    }
    $xmespagar=$b2;
    if($c1==31)
     {
      $c1=$c1-1;
     }
    if($c2==2 and $c1>28)
     {
      $c1=28;
     }

    $xfechafincli=strval($c3)."-".strval($c2)."-".strval($c1);


    //*****cambio solo para Joel de Mexico
    $c2mas=$c2;
    $c3mas=$c3;
    if($c2>=12)
       {
        $c2mas="1";
        $c3mas=$c3+1;
       }
       else
       {
        $c2mas=$c2+1;
        $c3mas=$c3;
       }


    $xfechaini=strval($c3)."-".strval($c2)."-"."01";
    $xfechafin=strval($c3mas)."-".strval($c2mas)."-"."01";
    $xmespagar=$c2;

  

    if($xmespagar==1)
     {
      $xmesnpagar="ENERO";
     }
    if($xmespagar==2)
     {
      $xmesnpagar="FEBRERO";
     }
    if($xmespagar==3)
     {
      $xmesnpagar="MARZO";
     }
    if($xmespagar==4)
     {
      $xmesnpagar="ABRIL";
     }
    if($xmespagar==5)
     {
      $xmesnpagar="MAYO";
     }
    if($xmespagar==6)
     {
      $xmesnpagar="JUNIO";
     }
    if($xmespagar==7)
     {
      $xmesnpagar="JULIO";
     }
    if($xmespagar==8)
     {
      $xmesnpagar="AGOSTO";
     }
    if($xmespagar==9)
     {
      $xmesnpagar="SEPTIEMBRE";
     }
    if($xmespagar==10)
     {
      $xmesnpagar="OCTUBRE";
     }
    if($xmespagar==11)
     {
      $xmesnpagar="NOVIEMBRE";
     }
    if($xmespagar==12)
     {
      $xmesnpagar="DICIEMBRE";
     }


    $xpagado="0";
    //Creamos el nuevo periodo de arranque de los periodos del cliente
    $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,idusuarios,sucursal,fechareg,pagado)  
					VALUES ('".$nummovi."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$usuario."','".$bode."',now(),'".$xpagado."')";
    $resultadoQ = mysql_query($sentencia);


    //Actualizamos el registro del cliente 
   $sentencia2 = "update clientes SET ulfepago1='".$fecharxx."',ulfepago2='".$xfechaini."' WHERE sucursal='".$bode."' and cod_cliente= '".$nummovi."';";  
   $resultadot = mysql_query($sentencia2);

    

     //fin de crear la actividad tecnica
     }

	return $resultado;
	exit;
}


function dat_insertar2_idenpaci2($datos,$bode,$usuario)
{
global $parametros , $conexion ;

$xclie=$datos['Mabc'];

//obteniendo un correlativo para el codigo del cliente
//$nummovi=0;
//$codigomov="CLIENTES";
//$sentencia="select numero id FROM correla2 where agencia='".$bode."' and codigo='".$codigomov."'";
//$resultado = mysql_query($sentencia);
//  if(mysql_num_rows ( $resultado )!=0)
//    {
//	$fila=mysql_fetch_array($resultado);
//	$nummovi=$fila['id']+1;
//    }
//	else
//    {
//	$nummovi=1;
//    }

//$a="CLIENTES";
//$sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
//$resultado2 = mysql_query($sentencia2);

//Buscando costo de planes
//$costoplan="";
//$Mttplan=$datos['Mttplan'];
//$sentencia = "select costo from planes where cod_plan='".$Mttplan."'";  
//$resultado = mysql_query($sentencia);
//if(mysql_num_rows ( $resultado )!=0)
//  {
//    $filaz=mysql_fetch_array($resultado);
//    $costoplan=$filaz['costo'];
//  }

//Buscando meses en periodos de contrato
$nmeses=0;
$periodo=$datos['Mcodperi'];
$sentencia = "select meses from pericon where codigoper='".$periodo."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filax=mysql_fetch_array($resultado);
    $nmeses=$filax['meses'];
  }


//$vivienda=trim($datos['Mpasaje'])." ".trim($datos['Mpoligono'])." ".trim($datos['Mcasa']);

//$fecha1=$datos['Mfechai'];
//$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
//$estatus="0";


//actualizando la tabla del cliente 
//$concodunico="";
//$sentencia = "select cod_clienteunico from clientes where cod_cliente='".$xclie."' and sucursal='".$bode."';";  
//$resultado2 = mysql_query($sentencia);
//if(mysql_num_rows ( $resultado2 )!=0)
//  {
//    $filax=mysql_fetch_array($resultado2);
//    $concodunico=$filax['cod_clienteunico'];
//  }
//  if($concodunico=="")
//  {




  //si es blanco, ponga en codigounico el codigo que se esta desactivando, ponga en el nuevo codigo 
  //en CODIGOUNICO, el que se esta desactivado tambien y desconecte el servicio
//   $esta="0";
//   $xmoti=19;

//   $sentencia="update clientes set motidesco='".$xmoti."',cod_clienteunico='".$xclie."', estatus='".$esta."' where cod_cliente='".$xclie."' and sucursal='".$bode."'";
//   $resultado2 = mysql_query($sentencia);

//    $sentencia = "insert into clientes (cod_cliente,nombre,apellido,sexo,registro,dui,email,telefono,celu,nit,ttpersona,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,
//                                        calle,ave,pasaje,poligono,casa,vivienda,otraref,blocke,fechai,ttfactura,contrato,fechap,cod_vende,codperi,observacion,vendedor,fechay,idusuarios,sucursal,fechareg,actividad,valorplan,numeperi,contaelec,cod_clienteunico,estatus,ttplan)  
//					VALUES ('".$nummovi."','".$datos['Mnombre']."','".$datos['Mapellido']."','".$datos['Msexo']."','".$datos['Mregistro']."','".$datos['Mdui']."','".$datos['Email']."','".$datos['Mtelefono']."','".$datos['Mcelu']."','".$datos['Mnit']."','".$datos['Mttpersona']."','".$datos['Partida']."','".$datos['SubPartidas']."','".$datos['SubPartidas_a']."','".$datos['SubPartidas_b']."','".$datos['SubPartidas_c']."',
//                                        '".$datos['Mcalle']."','".$datos['Mave']."','".$datos['Mpasaje']."','".$datos['Mpoligono']."','".$datos['Mcasa']."','".$vivienda."','".$datos['Motraref']."','".$datos['Mblocke']."','".$fechai."','".$datos['Mttfactura']."','".$datos['Mcontrato']."','".$datos['Mfechap']."',
//                                        '".$datos['Mcod_vende']."','".$datos['Mcodperi']."','".$datos['Mobservacion']."','".$datos['Mvendedor']."',now(),'".$usuario."','".$bode."',now(),'".$datos['Actividad']."','".$costoplan."','".$nmeses."','".$datos['Mcontaelec']."',".$xclie.",'".$estatus."','".$datos['Mttplan']."')";
//		   $resultado = mysql_query($sentencia);


//  }
//  else
//  {
  //si ya tiene codigo unico, tome el codigo unico y pongalo en la nueva cuenta del cliente en campo CODIGOUNICO, desactive la cuenta
  //del cliente que cambia de contrato.


//   $esta="0";
//   $xmoti=19;
//   $sentencia="update clientes set estatus='".$esta."',motidesco='".$xmoti."' where cod_cliente='".$xclie."' and sucursal='".$bode."'";
//   $resultado2 = mysql_query($sentencia);

//    $sentencia = "insert into clientes (cod_cliente,nombre,apellido,sexo,registro,dui,email,telefono,celu,nit,ttpersona,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,
//                                        calle,ave,pasaje,poligono,casa,vivienda,otraref,blocke,fechai,ttfactura,contrato,fechap,cod_vende,codperi,observacion,vendedor,fechay,idusuarios,sucursal,fechareg,actividad,valorplan,numeperi,contaelec,cod_clienteunico,estatus,ttplan)  
//					VALUES ('".$nummovi."','".$datos['Mnombre']."','".$datos['Mapellido']."','".$datos['Msexo']."','".$datos['Mregistro']."','".$datos['Mdui']."','".$datos['Email']."','".$datos['Mtelefono']."','".$datos['Mcelu']."','".$datos['Mnit']."','".$datos['Mttpersona']."','".$datos['Partida']."','".$datos['SubPartidas']."','".$datos['SubPartidas_a']."','".$datos['SubPartidas_b']."','".$datos['SubPartidas_c']."',
//                                        '".$datos['Mcalle']."','".$datos['Mave']."','".$datos['Mpasaje']."','".$datos['Mpoligono']."','".$datos['Mcasa']."','".$vivienda."','".$datos['Motraref']."','".$datos['Mblocke']."','".$fechai."','".$datos['Mttfactura']."','".$datos['Mcontrato']."','".$datos['Mfechap']."',
//                                        '".$datos['Mcod_vende']."','".$datos['Mcodperi']."','".$datos['Mobservacion']."','".$datos['Mvendedor']."',now(),'".$usuario."','".$bode."',now(),'".$datos['Actividad']."','".$costoplan."','".$nmeses."','".$datos['Mcontaelec']."','".$concodunico."','".$estatus."','".$datos['Mttplan']."')";
//		   $resultado = mysql_query($sentencia);

//  }


$fecha1=$datos['Mfechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$usuario=$_SESSION["idusuarios"];


    if(intval(substr($fecha1,6,4))>1900)
    {

    $sentencia="update clientes set dui='".$datos['Mdui']."',celu='".$datos['Mcelu']."',nit='".$datos['Mnit']."',telefono='".$datos['Mtelefono']."',fechai='".$fechai."',numeperi='".$nmeses."',vendedor='".$datos['Mvendedor']."',contrato='".$datos['Mcontrato']."',codperi='".$datos['Mcodperi']."', observacion='".$datos['Mobservacion']."' 
    where cod_cliente='".$xclie."' and sucursal='".$bode."'";
    $resultado2 = mysql_query($sentencia);

    //creando un registro historico de renovaciones de contratos
    $sentencia = "insert into clientes_renova (cod_cliente,nombre,apellido,fechai,contrato,codperi,vendedor,idusuarios,sucursal,fechareg,numeperi,observacion)  
    VALUES ('".$xclie."','".$datos['Mnombre']."','".$datos['Mapellido']."','".$fechai."','".$datos['Mcontrato']."','".$datos['Mcodperi']."','".$datos['Mvendedor']."','".$usuario."','".$bode."',now(),'".$nmeses."','".$datos['Mobservacion']."')";
    $resultado = mysql_query($sentencia);
   }

	return $resultado2;
	exit;
}


function dat_eliminar_idenpaci($id,$bodega)
{
global $parametros , $conexion ;
    $sentencia = "delete from  periodos where sucursal='".$bodega."' and cod_cliente='$id'";  
    $resultado = mysql_query($sentencia);

    $sentencia = "delete from  facturas where sucursal='".$bodega."' and cod_cliente='$id'";  
    $resultado = mysql_query($sentencia);

    $sentencia = "delete from  detafac where sucursal='".$bodega."' and cod_cliente='$id'";  
    $resultado = mysql_query($sentencia);

    $sentencia = "delete from  activi where sucursal='".$bodega."' and cod_cliente='$id'";  
    $resultado = mysql_query($sentencia);

    $sentencia = "delete from  clientes where sucursal='".$bodega."' and cod_cliente='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_conectar_idenpaci($datos, $id,$bodega)
{
 global $parametros, $conexion;

//obteniendo un correlativo para codigo de ticket
$nummovi=0;
$codigomov="TICKET";
$sentencia="select numero id FROM correla2 where agencia='".$bodega."' and codigo='".$codigomov."'";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id']+1;
    }
	else
    {
	$nummovi=1;
    }

$a="TICKET";
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bodega."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

$usuario=$_SESSION["idusuarios"];

$fecha1=$datos['Fechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$nombreclie=$datos['Mnombre']." ".$datos['Mapellido'];

//Buscando el nombre de la actividad
$ntarea="";
$norden=0;
$tconexion=$datos['Tconexion'];
$sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ntarea=$filaz['nom_servi'];
    $norden=$filaz['orden'];
  }

//Buscando cliente
$ncliente="";
$xdepto="";
$xmuni="";
$xcanton="";
$xbarrio="";
$xcaserio="";
$xcalle="";
$xave="";
$xpasaje="";
$xpoligono="";
$xcasa="";
$xblocke="";
$tcliente=$datos['Codigo'];
$sentencia = "select * from clientes where cod_cliente='".$tcliente."' and sucursal='".$bodega."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $xdepto=$filaz['cod_depto'];
    $xmuni=$filaz['cod_ciudad'];
    $xcanton=$filaz['cod_canton'];
    $xbarrio=$filaz['cod_barrio'];
    $xcaserio=$filaz['cod_caserio'];
    $xpasaje=$filaz['pasaje'];
    $xpoligono=$filaz['poligono'];
    $xcasa=$filaz['casa'];
    $xblocke=$filaz['blocke'];
  }


//buscando nombre de departamento
  $xndepto="";
  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xndepto=$rown['nom_depto'];
    }
   }

//buscando nombre de municipio
  $xnmuni="";
  $sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnmuni=$rown['nomb_ciudad'];
    }
   }

//buscando nombre de canton
  $xncanton="";
  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xncanton=$rown['nombrecant'];
    }
   }


//buscando nombre de barrio
  $xnbarrio="";
  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnbarrio=$rown['nombrebarrio'];
    }
   }

//buscando nombre de colonia
  $xncaserio="";
  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xncaserio=$rown['nombrecaserio'];
    }
   }

//armando la direccion

$tbarrio="";
if($xnbarrio!="")
{
 $tbarrio="Barrio";
}

$tcaserio="";
if($xncaserio!="")
{
 $tcaserio="Col.";
}

$tcalle="";
if($xcalle!="")
{
 $tcalle="Calle";
}

$tave="";
if($xave!="")
{
 $tave="Ave.";
}

$tpasaje="";
if($xpasaje!="")
{
 $tpasaje="Pje.";
}

$tpoligono="";
if($xpoligono!="")
{
 $tpoligono="Pol.";
}

$tbloque="";
if($xblocke!="")
{
 $tbloque="Block.";
}


$direccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa;

$sentencia = "insert into activi (movimiento,fechasoli,fechareali,fecha,cod_cliente,nomclie,idusuarios,sucursal,fechareg,codservi,nomservi,direclie,orden,comentario,tecnireali)  
		VALUES ('".$nummovi."','".$fechai."','".$fechai."','".$fechai."','".$datos['Codigo']."','".$ncliente."','".$usuario."','".$bodega."',now(),'".$datos['Tconexion']."','".$ntarea."','".$direccion."','".$norden."','".$datos['Infoad']."','".$datos['Tecnico']."')";
    $resultado = mysql_query($sentencia);

//Actualizando el registro del cliente
  $estatus="1";
  $abomora=0;
  $sentencia2 = "update clientes SET estatus='".$estatus."', abonomora='".$abomora."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
  $resultado2 = mysql_query($sentencia2);

//Calculando el nuevo periodo de pago
    $b2x1=intval(substr($fechai,5,2));
    $b3x1=intval(substr($fechai,0,4));
    $xdia="28";
    //calculando el mes siguiente
    if($b2x1==12) 
       {
        $b2x=1;
        $b3x=$b3x1+1;
       }
       else
       {
        $b2x=$b2x1+1;
        $b3x=$b3x1;
       }
      //calculando el mes anterior
    if($b2x1==1) 
       {
        $b2xx=12;
        $b3xx=$b3x1-1;
       }
       else
       {
        $b2xx=$b2x1-1;
        $b3xx=$b3x1;
       }


      //$b2x=$b2x1;
      //$b3x=$b3x1;
      //if($b2x==1)
      // {
      //  $xdia="31";
      // }
      //if($b2x==2)
      // {
      //  $xdia="28";
      // }
      //if($b2x==3)
      // {
      //  $xdia="31";
      // }
      //if($b2x==4)
      // {
      //  $xdia="30";
      // }
      //if($b2x==5)
      // {
      //  $xdia="31";
      //}
      //if($b2x==6)
      // {
      //  $xdia="30";
      // }
      //if($b2x==7)
      // {
      // $xdia="31";
      // }
      //if($b2x==8)
      // {
      //  $xdia="31";
      // }
      //if($b2x==9)
      // {
      //  $xdia="30";
      // }
      //if($b2x==10)
      // {
      //  $xdia="31";
      // }
      //if($b2x==11)
      // {
      //  $xdia="30";
      // }
      //if($b2x==12)
      // {
      //  $xdia="31";
      // }
     
      $xdia="01";
      $xfechaini=$fechai;
      $xfechafin=strval($b3x)."-".strval($b2x)."-".$xdia;
      $xmespagar=$b2x1;
      $xfechainicliente=strval($b3xx)."-".strval($b2xx)."-".$xdia;

      

    if($xmespagar==1)
     {
      $xmesnpagar="ENERO";
     }
    if($xmespagar==2)
     {
      $xmesnpagar="FEBRERO";
     }
    if($xmespagar==3)
     {
      $xmesnpagar="MARZO";
     }
    if($xmespagar==4)
     {
      $xmesnpagar="ABRIL";
     }
    if($xmespagar==5)
     {
      $xmesnpagar="MAYO";
     }
    if($xmespagar==6)
     {
      $xmesnpagar="JUNIO";
     }
    if($xmespagar==7)
     {
      $xmesnpagar="JULIO";
     }
    if($xmespagar==8)
     {
      $xmesnpagar="AGOSTO";
     }
    if($xmespagar==9)
     {
      $xmesnpagar="SEPTIEMBRE";
     }
    if($xmespagar==10)
     {
      $xmesnpagar="OCTUBRE";
     }
    if($xmespagar==11)
     {
      $xmesnpagar="NOVIEMBRE";
     }
    if($xmespagar==12)
     {
      $xmesnpagar="DICIEMBRE";
     }

    //Borramos todo historial del cliente por ser nueva conexion, nueva fecha inicial de servicio
    $sentencia = "delete from periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'; ";
    $resultadop = mysql_query($sentencia);

    $xpagado="0";
    //Creamos el nuevo periodo de arranque de los periodos del cliente
    $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,idusuarios,sucursal,fechareg,pagado)  
					VALUES ('".$datos['Codigo']."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$usuario."','".$bodega."',now(),'".$xpagado."')";
    $resultadoQ = mysql_query($sentencia);
    
    //Actualizamos el registro del cliente 
   $ulmes="";
   $sentencia2 = "update clientes SET ulfepago1='".$xfechainicliente."',ulfepago2='".$xfechainicliente."',ulmespago='".$ulmes."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
   $resultadot = mysql_query($sentencia2);


	return $resultado;
	exit;
}


function dat_desconectar_idenpaci($datos, $id,$bodega)
{
 global $parametros, $conexion;

//obteniendo un correlativo para codigo de ticket
$nummovi=0;
$codigomov="TICKET";
$sentencia="select numero id FROM correla2 where agencia='".$bodega."' and codigo='".$codigomov."'";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id']+1;
    }
	else
    {
	$nummovi=1;
    }

$a="TICKET";
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bodega."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

$usuario=$_SESSION["idusuarios"];
$fecha1=$datos['Fechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$nombreclie=$datos['Mnombre']." ".$datos['Mapellido'];

//Buscando el nombre de la actividad
$ntarea="";
$norden=0;
$tconexion=$datos['Tconexion'];
$sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ntarea=$filaz['nom_servi'];
    $norden=$filaz['orden'];
  }

//Buscando cliente
$ttplan="";
$ncliente="";
$xdepto="";
$xmuni="";
$xcanton="";
$xbarrio="";
$xcaserio="";
$xcalle="";
$xave="";
$xpasaje="";
$xpoligono="";
$xcasa="";
$xblocke="";
$tcliente=$datos['Codigo'];
$sentencia = "select * from clientes where cod_cliente='".$tcliente."' and sucursal='".$bodega."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
    $xdepto=$filaz['cod_depto'];
    $xmuni=$filaz['cod_ciudad'];
    $xcanton=$filaz['cod_canton'];
    $xbarrio=$filaz['cod_barrio'];
    $xcaserio=$filaz['cod_caserio'];
    $xpasaje=$filaz['pasaje'];
    $xpoligono=$filaz['poligono'];
    $xcasa=$filaz['casa'];
    $xblocke=$filaz['blocke'];
    $ttplan=$filaz['ttplan'];
    $vplan=$filaz['valorplan'];
    $xulfepago1=$filaz['ulfepago1'];
    $xulfepago2=$filaz['ulfepago2'];

  }

//buscando el nombre del plan
$comentario="";
$sentencia = "select nombre_plan from planes where cod_plan='".$ttplan."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz2=mysql_fetch_array($resultado);
    $comentario="Servicio instalado: ".$filaz2['nombre_plan'];
  }


//buscando nombre de departamento
  $xndepto="";
  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xndepto=$rown['nom_depto'];
    }
   }

//buscando nombre de municipio
  $xnmuni="";
  $sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnmuni=$rown['nomb_ciudad'];
    }
   }

//buscando nombre de canton
  $xncanton="";
  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xncanton=$rown['nombrecant'];
    }
   }


//buscando nombre de barrio
  $xnbarrio="";
  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xnbarrio=$rown['nombrebarrio'];
    }
   }

//buscando nombre de colonia
  $xncaserio="";
  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
  $resultadon = mysql_query($sentencian);
  if(isset($resultadon))
   {
    if(mysql_num_rows ( $resultadon )!=0)
    {
     $rown=mysql_fetch_array($resultadon);
     $xncaserio=$rown['nombrecaserio'];
    }
   }

//armando la direccion

$tbarrio="";
if($xnbarrio!="")
{
 $tbarrio="Barrio";
}

$tcaserio="";
if($xncaserio!="")
{
 $tcaserio="Col.";
}

$tcalle="";
if($xcalle!="")
{
 $tcalle="Ref.";
}

$tave="";
if($xave!="")
{
 $tave="Ave.";
}

$tpasaje="";
if($xpasaje!="")
{
 $tpasaje="Pje.";
}

$tpoligono="";
if($xpoligono!="")
{
 $tpoligono="Caja.";
}

$tbloque="";
if($xblocke!="")
{
 $tbloque="Block.";
}


$direccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa;

//Actualizando el registro de actividades tecnicas
$sentencia = "insert into activi (movimiento,fechasoli,fecha,fechareali,cod_cliente,nomclie,idusuarios,sucursal,fechareg,codservi,nomservi,direclie,orden,comentario,codigomot,tecnireali)  
		VALUES ('".$nummovi."','".$fechai."','".$fechai."','".$fechai."','".$datos['Codigo']."','".$ncliente."','".$usuario."','".$bodega."',now(),'".$datos['Tconexion']."','".$ntarea."','".$direccion."','".$norden."','".$comentario."','".$datos['Motivo']."','".$datos['Tecnico']."')";
    $resultado = mysql_query($sentencia);

//Actualizando el registro del cliente
  $estatus="0";
  $sentencia2 = "update clientes SET estatus='".$estatus."',motidesco='".$datos['Motivo']."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
  $resultado2 = mysql_query($sentencia2);
    
//Buscando dias y monto pendiente de pago
   $fecha1=$datos['Fechai'];
   $fechat1=date('d/m/Y');
   $xmex2=intval(substr($fechat1,3,2));
   $xanio2=intval(substr($fechat1,6,4));
   $xmex1=$xmex2;
   $cliente=$tcliente;
   $cod_bodega=$bodega;
   $valplan=$vplan;
   if(((intval(substr($filaz['ulfepago2'],5,2)))<=$xmex2 or $xanio2>intval(substr($filaz['ulfepago2'],0,4))) and $filaz['ulfepago1']!='Null' and $filaz['ulfepago2']!='Null');	   
   {
    if($filaz['ulfepago2']!='Null')  //si la fecha final del ultimo pago existe
    {
      $ufp1=$filaz['ulfepago2'];
      $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
      $resultado2=mysql_query($sentencia);
      $numedia=intval(substr($filaz['ulfepago2'],8,2));
      $numemes=intval(substr($filaz['ulfepago2'],5,2));
      $numeanio=intval(substr($filaz['ulfepago2'],0,4));
      if($numemes==12)
       {
        $numemes=1;
        $numeanio=$numeanio+1;
       }
        else
       {
        $numemes=$numemes+1;
       }
       $ufp2=$numeanio."/".$numemes."/".$numedia;
       $sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
       $resultado2 = mysql_query($sentencia);
     }  
     if($filaz['ulfepago2']=='Null')       //si no hay fecha final de un pago anterior toma como inicio la fecha de conexion
      {  
       if($filaz['fechaip']!='Null' and intval(substr($filaz['fechaip'],5,2))<=$xmex2)
       {
         $ufp1=$filaz['fechaip']; 
         $sentencia="update clientes set fechap1='".$ufp1."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
         $resultado2 = mysql_query($sentencia);
         $numedia=intval(substr($filaz['fechaip'],8,2));
         $numemes=intval(substr($filaz['fechaip'],5,2));
         $numeanio=intval(substr($filaz['fechaip'],0,4));
         if($numemes==12)
          {
            $numemes=1;
	    $numeanio=$numeanio+1;
          }
          else
	  {
           $numemes=$numemes+1;
          }
          $ufp2=$numeanio."/".$numemes."/".$numedia;
	  $sentencia="update clientes set fechap2='".$ufp2."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
          $resultado2 = mysql_query($sentencia);
       }  
     }  
     $monto=$valplan;
     $sentencia="update clientes set parametromon='".$valplan."' where cod_cliente='".$cliente."' and fechap2!='Null' and sucursal='".$cod_bodega."'";
     $resultado2 = mysql_query($sentencia);

     //calculando los meses que debe hasta la fecha (independientemente del mes limite del reporte debe contar los meses que debe hasta la fecha actual del sistema)
     $ff1="";
     $ff2="";
     $abonos=0;
     $sentencia2 = "select pidedesco,fechap1,fechap2 FROM clientes where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
        if(mysql_num_rows ( $resultado2 )!=0)
         {
         $rowq=mysql_fetch_array($resultado2);
         $ff1=$rowq['fechap1'];
         $ff2=$rowq['fechap2'];
         }
      }
     $pidedesco=$rowq['pidedesco'];
     $hoymes1=date('d/m/Y');
     $hoymes=intval(substr($hoymes1,3,2))+1;
     $numemedddd=intval(substr($ff2,5,2));
     $mesasumar=1;
     $xxxx=$numemedddd;
     for ($xxxx = $numemedddd; $xxxx < $hoymes; $xxxx++) 
      {
        $mesasumar=$mesasumar+1;
      }
      if($mesasumar>1)
	{
         $recargo=($mesasumar-1)*30;
	}
          else
        {
         $recargo=0;
        }
      if($mesasumar==1)
	{
         $recargo=30;
	}
              if(intval(substr($ff1,5,2))==12 and $xmex2==12)       //si el mes inicial del periodo a pagar es 12 o sea diciembre y el mes de reporte es tambien diciembre
               {
                   $mesasumar=1;
	       }



     $apagar=$monto+($valplan*($mesasumar-2))+$recargo;
     $sentencia="update clientes set parametrompendi='".$mesasumar."',parametroapa='".$apagar."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
     $resultado2 = mysql_query($sentencia);
     $ncliente=$filaz['nombre']." ".$filaz['apellido'];
     $xdui=$filaz['nit'];
     $xfechai=$filaz['fechaip'];
     $xfechaul=$filaz['fechaul'];
     $cerouno=1;
     $xdireccion=" ";
     $sentencia="update clientes set parametrodire='".$xdireccion."',parametroprint='".$cerouno."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
     $resultado2 = mysql_query($sentencia);
   }  //fin de SI esta en el rango de fechas del ultimo mes pagado para calcular monto 

   //actualice en tabla de clientes 
   $mesquedebe=intval(substr($xulfepago2,5,2));
   $nmesquedebe="No definido";
   if($mesquedebe==1)
   {
    $nmesquedebe="Enero";
   }
   if($mesquedebe==2)
   {
    $nmesquedebe="Febrero";
   }
   if($mesquedebe==3)
   {
    $nmesquedebe="Marzo";
   }
   if($mesquedebe==4)
   {
    $nmesquedebe="Abril";
   }
   if($mesquedebe==5)
   {
    $nmesquedebe="Mayo";
   }
   if($mesquedebe==6)
   {
    $nmesquedebe="Junio";
   }
   if($mesquedebe==7)
   {
    $nmesquedebe="Julio";
   }
   if($mesquedebe==8)
   {
    $nmesquedebe="Agosto";
   }
   if($mesquedebe==8)
   {
    $nmesquedebe="Septiembre";
   }
   if($mesquedebe==10)
   {
    $nmesquedebe="Octubre";
   }
   if($mesquedebe==11)
   {
    $nmesquedebe="Noviembre";
   }
   if($mesquedebe==12)
   {
    $nmesquedebe="Diciembre";
   }

   //calculando los dias que debe desde el 1 del mes a la fecha de desconexion
   $diasquedebe=intval(substr($fechai,8,2));
   $mdiasquedebe=($valplan/30)*$diasquedebe;
   
  
   if($pidedesco!=2)
   {
   $morahoy=$apagar;
   $sentencia2="update clientes set cargoadic='".$mdiasquedebe."',limite='".$nmesquedebe."',morahoy='".$morahoy."',fedesco='".$fechai."' WHERE sucursal='".$cod_bodega."' and cod_cliente= '".$cliente."'";
   $resultado2 = mysql_query($sentencia2);
   }
   else
   {
   $sentencia2="update clientes set fedesco='".$fechai."' WHERE sucursal='".$cod_bodega."' and cod_cliente= '".$cliente."'";
   $resultado2 = mysql_query($sentencia2);
   }



   //Fin de actualizar la mora a la fecha de desconexion
    //Borramos el mes programado en periodos de pago que tenia estado de no pagado porque se esta desconectando el servicio
    $sentencia = "delete from periodos WHERE sucursal='".$bodega."' and pagado='0' and cod_cliente= '".$datos['Codigo']."'";
    $resultadop = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_actualizar_idenpaci($datos, $id,$bodega)
{
global $parametros , $conexion ;

//Buscando menses en periodos de contrato
$nmeses=0;
$periodo=$datos['Mcodperi'];
$sentencia = "select meses from pericon where codigoper='".$periodo."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filax=mysql_fetch_array($resultado);
    $nmeses=$filax['meses'];
  }

$fecha1=$datos['Mfechai'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


$vivienda=trim($datos['Mpasaje'])." ".trim($datos['Mpoligono'])." ".trim($datos['Mcasa']);
$sentencia = "update clientes SET nombre='".$datos['Mnombre']."',apellido='".$datos['Mapellido']."',sexo='".$datos['Msexo']."',registro='".$datos['Mregistro']."',dui='".$datos['Mdui']."',email='".$datos['Email']."',telefono='".$datos['Mtelefono']."',celu='".$datos['Mcelu']."',nit='".$datos['Mnit']."',ttpersona='".$datos['Mttpersona']."',cod_depto='".$datos['Partida']."',cod_ciudad='".$datos['SubPartidas']."',cod_canton='".$datos['SubPartidas_a']."',cod_barrio='".$datos['SubPartidas_b']."',cod_caserio='".$datos['SubPartidas_c']."',
                                        calle='".$datos['Mcalle']."',ave='".$datos['Mave']."',pasaje='".$datos['Mpasaje']."',poligono='".$datos['Mpoligono']."',casa='".$datos['Mcasa']."',vivienda='".$vivienda."',otraref='".$datos['Motraref']."',blocke='".$datos['Mblocke']."',fechai='".$fechai."',ttfactura='".$datos['Mttfactura']."',longilati='".$datos['Mlongilati']."',contrato='".$datos['Mcontrato']."',fechap='".$datos['Mfechap']."',cone='".$datos['Mcone']."',marcha='".$datos['Mmarcha']."',poste='".$datos['Mposte']."',contaelec='".$datos['Mcontaelec']."',
                                        cod_vende='".$datos['Mcod_vende']."',codperi='".$datos['Mcodperi']."',observacion='".$datos['Mobservacion']."',vendedor='".$datos['Mvendedor']."',usuariom='".$usuario."',fechareg=now(),actividad='".$datos['Actividad']."',numeperi='".$nmeses."',zona='".$datos['Mzona']."',cargoadic='".$datos['Mcadic']."',pidedesco='".$datos['Mpidiod']."'
			          WHERE sucursal='".$bodega."' and cod_cliente= '$id';";  
        $resultado = mysql_query($sentencia);

//Actualizando los nombres de las zonas geograficas
		$sentencia2 = "select cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio FROM clientes where cod_cliente='".$id."' and sucursal='".$bodega."'"; 
		$resultado2 = mysql_query($sentencia2);
                if(isset($resultado2))
                 {
   	          if(mysql_num_rows ( $resultado2 )!=0)
	           {
  	            $rowq=mysql_fetch_array($resultado2);
	            $xdepto=$rowq['cod_depto'];
		    $xmuni=$rowq['cod_ciudad'];
		    $xcanton=$rowq['cod_canton'];
		    $xbarrio=$rowq['cod_barrio'];
		    $xcaserio=$rowq['cod_caserio'];


			//buscando nombre de departamento
			  $xndepto="";
			  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xndepto=$rown['nom_depto'];
			    }
			   }

			//buscando nombre de municipio
			  $xnmuni="";
			  $sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xnmuni=$rown['nomb_ciudad'];
			    }
			   }

			//buscando nombre de canton
			  $xncanton="";
			  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xncanton=$rown['nombrecant'];
			    }
			   }


			//buscando nombre de barrio
			  $xnbarrio="";
			  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xnbarrio=$rown['nombrebarrio'];
			    }
			   }
		
			//buscando nombre de colonia
			  $xncaserio="";
			  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
			  $resultadon = mysql_query($sentencian);
			  if(isset($resultadon))
			   {
			    if(mysql_num_rows ( $resultadon )!=0)
			    {
			     $rown=mysql_fetch_array($resultadon);
			     $xncaserio=$rown['nombrecaserio'];
			    }
			   }
	
			//armando la direccion
			$tbarrio="";
			if($xnbarrio!="")
			{
			 $tbarrio="Barrio";
			}
			
			$tcaserio="";
			if($xncaserio!="")
			{
			 $tcaserio="Col.";
			}
			
			$tcalle="";
			if($xcalle!="")
			{
			 $tcalle="Calle";
			}

			$tave="";
			if($xave!="")
			{
			 $tave="Ave.";
			}

			$tpasaje="";
			if($xpasaje!="")
			{
			 $tpasaje="Pje.";
			}

			$tpoligono="";
			if($xpoligono!="")
			{
			 $tpoligono="Pol.";
			}

			$tbloque="";
			if($xblocke!="")
			{
			 $tbloque="Block.";
			}
			$xdireccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa."-".$otraref;
		        $sentencia="update clientes set vivienda='".$xdireccion."',ndep='".$xndepto."',nmuni='".$xnmuni."',ncan='".$xncanton."',nbar='".$xnbarrio."',ncase='".$xncaserio."'  where cod_cliente='".$id."' and sucursal='".$bodega."'";
                        $resultado3 = mysql_query($sentencia);
                   }
                  }


	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_actualizar_idenpacinodo($datos, $id,$bodega)
{
global $parametros , $conexion ;
$fecha1=$datos['Fquitanodo'];
$fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$sentencia = "update clientes SET observa='".$datos['Mobserva']."',fquitanodo='".$fechai."',bande1='".$datos['Mestadon']."'
			          WHERE sucursal='".$bodega."' and cod_cliente= '$id';";  
        $resultado = mysql_query($sentencia);

	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_actualizar_idenpaci3($datos, $id,$bodega)
{
global $parametros , $conexion ;
$resultado=0;
$fecha1=$datos['Ulfepago1'];
$fechax1=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha2=$datos['Ulfepago2'];
$fechax2=substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

$fecha3=$datos['Fechaul'];
$fechax3=substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

    if(intval(substr($fecha1,6,4))>1900 and intval(substr($fecha2,6,4))>1900 and intval(substr($fecha3,6,4))>1900)
    {
	$sentencia = "update clientes SET ulfepago1='".$fechax1."',ulfepago2='".$fechax2."',ulmespago='".$datos['Ulmespago']."',fechaul='".$fechax3."',ulpago='".$datos['Ulpago']."'     
          WHERE sucursal='".$bodega."' and cod_cliente= '$id';";  
        $resultado = mysql_query($sentencia);
   }
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_idenpaci_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select cod_cliente 'Codigo',nombre 'Nombre' FROM clientes where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_cmbZZZ()
{
	global $parametros , $conexion ;
	$sentencia = "select cod_cliente 'Codigo',nombre 'Nombre', apellido 'Apellidos' FROM clientes";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_idenpaci_cmb_actitec($bodega,$hcodclie)
{
	global $parametros , $conexion ;
	$sentencia = "select cod_cliente 'Codigo',nombre 'Nombre', apellido 'Apellido', telefono Telefono, celu Celular FROM clientes where sucursal='".$bodega."' and (cod_cliente like '%".$hcodclie."%' or apellido like '%".$hcodclie."%' or nombre like '%".$hcodclie."%')";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_vecontador_idenpaci($datos,$bodega)
{
	global $parametros , $conexion ;
	$codbuscar=$datos['Mcontaelec'];
	$sentencia = "select contaelec FROM clientes where contaelec='".$codbuscar."' and sucursal='".$bodega."'";  
    	$resultado = mysql_query($sentencia);
        if(mysql_num_rows ( $resultado )!=0)
         {
          $resultadow=1;
         }
		else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}

function dat_veplanvige_idenpaci($cplan)
{
	global $parametros , $conexion ;
        $fecha=date('Y/m/d');
	$sentencia = "select costo FROM planes where '".$fecha."'>=fechainicial and '".$fecha."'<=fechafinal and cod_plan='".$cplan."'";  
    	$resultado = mysql_query($sentencia);
        if(mysql_num_rows ( $resultado )!=0)
         {
          $resultadow=1;
         }
		else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}

function dat_vestadocliente($cliente)
{
	global $parametros , $conexion ;
        $bodega=$_SESSION["idBodega"];

	$sentencia = "select estatus FROM clientes where sucursal='".$bodega."' and cod_cliente='".$cliente."'";  
    	$resultado = mysql_query($sentencia);
        if(mysql_num_rows ( $resultado )!=0)
         {
          $filax=mysql_fetch_array($resultado);
          $nestatus=$filax['estatus'];
          if($nestatus==1)
          {
           $resultadow=1;   
          }
          else
          {
           $resultadow=0;   
          }
         }
    	return $resultadow;
	exit;
}


function dat_vedui($dui)
{
	global $parametros , $conexion ;
        $bodega=$_SESSION["idBodega"];

	$sentencia = "select dui,nombre,apellido FROM clientes where dui='".$dui."'";  
    	$resultado = mysql_query($sentencia);

        if(mysql_num_rows ( $resultado )!=0)
         {
          $filax=mysql_fetch_array($resultado);
          $resultadow=$filax['dui']." ".$filax['nombre']." ".$filax['apellido'];
         }
         else
         {
          $resultadow=0;   
         }
    	return $resultadow;
	exit;
}

function dat_direcciondupli_idenpaci($Partida,$SubPartidas,$SubPartidas_a,$SubPartidas_b,$SubPartidas_c,$Mcalle,$Mave,$Mpasaje,$Mpoligono,$Mcasa,$Mblocke)
{
	global $parametros , $conexion ;
        $bodega=$_SESSION["idBodega"];

	$sentencia = "select cod_cliente,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,calle,ave,pasaje,poligono,casa,blocke FROM clientes where cod_depto='".$Partida."' and cod_ciudad='".$SubPartidas."' and cod_canton='".$SubPartidas_a."' and cod_barrio='".$SubPartidas_b."' and cod_caserio='".$SubPartidas_c."' and calle='".$Mcalle."' and ave='".$Mave."' and pasaje='".$Mpasaje."' and poligono='".$Mpoligono."' and casa='".$Mcasa."' and blocke='".$Mblocke."' and estatus=1";  
    	$resultado = mysql_query($sentencia);

        if(mysql_num_rows ( $resultado )!=0)
         {
          $filax=mysql_fetch_array($resultado);
          $resultadow=$filax['cod_cliente'];
         }
         else
         {
          $resultadow=0;   
         }
    	return $resultadow;
	exit;
}
function dat_direcciondupli_idenpaci2($Codigo,$Partida,$SubPartidas,$SubPartidas_a,$SubPartidas_b,$SubPartidas_c,$Mcalle,$Mave,$Mpasaje,$Mpoligono,$Mcasa,$Mblocke)
{
	global $parametros , $conexion ;
        $bodega=$_SESSION["idBodega"];

	$sentencia = "select cod_cliente,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,calle,ave,pasaje,poligono,casa,blocke FROM clientes where cod_depto='".$Partida."' and cod_ciudad='".$SubPartidas."' and cod_canton='".$SubPartidas_a."' and cod_barrio='".$SubPartidas_b."' and cod_caserio='".$SubPartidas_c."' and calle='".$Mcalle."' and ave='".$Mave."' and pasaje='".$Mpasaje."' and poligono='".$Mpoligono."' and casa='".$Mcasa."' and blocke='".$Mblocke."' and estatus=1 and cod_cliente!='".$Codigo."'";  
    	$resultado = mysql_query($sentencia);

        if(mysql_num_rows ( $resultado )!=0)
         {
          $filax=mysql_fetch_array($resultado);
          $resultadow=$filax['cod_cliente'];
         }
         else
         {
          $resultadow=0;   
         }
    	return $resultadow;
	exit;
}


function Barcode39 ($barcode, $width, $height, $quality, $format, $text){

switch ($format){
default:
$format = "JPEG";
case "JPEG":
header ("Content-type: image/jpeg");
break;
case "PNG":
header ("Content-type: image/png");
break;
case "GIF":
header ("Content-type: image/gif");
break;
}

$height1=35;
$im=ImageCreate($width, $height1) or die ("Cannot Initialize new GD image stream");
$White = ImageColorAllocate ($im, 255, 255, 255);
$Black = ImageColorAllocate ($im, 0, 0, 0);
ImageInterLace ($im, 1);

$NarrowRatio = 20;
$WideRatio = 55;
$QuietRatio = 35;

$nChars = (strlen($barcode)+2) * ((6 * $NarrowRatio) + (3 *
$WideRatio) + ($QuietRatio));

$Pixels = $width / $nChars;
$NarrowBar = (int)(20 * $Pixels);
$WideBar = (int)(55 * $Pixels);
$QuietBar = (int)(35 * $Pixels);

$ActualWidth = (($NarrowBar * 6) + ($WideBar*3) + $QuietBar) *
(strlen ($barcode)+2);

$CurrentBarX = (int)(($width - $ActualWidth) / 2);
$Color = $White;
$BarcodeFull = "*".strtoupper ($barcode)."*";
settype ($BarcodeFull, "string");

$FontNum = 3;
$FontHeight = ImageFontHeight ($FontNum);
$FontWidth = ImageFontWidth ($FontNum);

for ($i=0; $i<strlen($BarcodeFull); $i++){
$StripeCode = Code39 ($BarcodeFull[$i]);
for ($n=0; $n < 9; $n++){
if ($Color == $White) $Color = $Black;
else $Color = $White;
switch ($StripeCode[$n]){
case '0':
ImageFilledRectangle ($im, $CurrentBarX, 0,
$CurrentBarX+$NarrowBar, $height-1-$FontHeight-2, $Color);
$CurrentBarX += $NarrowBar;
break;
case '1':
ImageFilledRectangle ($im, $CurrentBarX, 0,
$CurrentBarX+$WideBar, $height-1-$FontHeight-2, $Color);
$CurrentBarX += $WideBar;
break;
}
}

$Color = $White;
ImageFilledRectangle ($im, $CurrentBarX, 0,
$CurrentBarX+$QuietBar, $height-1-$FontHeight-2, $Color);
$CurrentBarX += $QuietBar;
}
OutputImage ($im, $format, $quality);
}

//-----------------------------------------------------------------------------
// Output an image to the browser
//-----------------------------------------------------------------------------
function OutputImage ($im, $format, $quality){
switch ($format){
case "JPEG":
ImageJPEG ($im, "", $quality);
break;
}
}

//-----------------------------------------------------------------------------
// Returns the Code 3 of 9 value for a given ASCII character
//-----------------------------------------------------------------------------
function Code39 ($Asc){
switch ($Asc){
case ' ':
return "011000100";
case '$':
return "010101000";
case '%':
return "000101010";
case '*':
return "010010100"; // * Start/Stop
case '+':
return "010001010";
case '|':
return "010000101";
case '.':
return "110000100";
case '/':
return "010100010";
case '0':
return "000110100";
case '1':
return "100100001";
case '2':
return "001100001";
case '3':
return "101100000";
case '4':
return "000110001";
case '5':
return "100110000";
case '6':
return "001110000";
case '7':
return "000100101";
case '8':
return "100100100";
case '9':
return "001100100";
case 'A':
return "100001001";
case 'B':
return "001001001";
case 'C':
return "101001000";
case 'D':
return "000011001";
case 'E':
return "100011000";
case 'F':
return "001011000";
case 'G':
return "000001101";
case 'H':
return "100001100";
case 'I':
return "001001100";
case 'J':
return "000011100";
case 'K':
return "100000011";
case 'L':
return "001000011";
case 'M':
return "101000010";
case 'N':
return "000010011";
case 'O':
return "100010010";
case 'P':
return "001010010";
case 'Q':
return "000000111";
case 'R':
return "100000110";
case 'S':
return "001000110";
case 'T':
return "000010110";
case 'U':
return "110000001";
case 'V':
return "011000001";
case 'W':
return "111000000";
case 'X':
return "010010001";
case 'Y':
return "110010000";
case 'Z':
return "011010000";
default:
return "011000100";
}
}

?>