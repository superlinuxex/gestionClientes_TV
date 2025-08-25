<?php
require "dat_base.php";  

function dat_validar_peridetalle($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from entradas where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_peridetalle($datos,$bodega)
{
global $parametros , $conexion ;

    $resultado=0;
    $usuario=$_SESSION["idusuarios"];
    $fecha1=$datos['Fechai'];
    $fechai=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $nmes="";
    $numemes=0;
    if(intval(substr($fecha1,3,2))==1)
      {
         $nmes="Enero";
      }
    if(intval(substr($fecha1,3,2))==2)
      {
         $nmes="Febrero";
      }
    if(intval(substr($fecha1,3,2))==3)
      {
         $nmes="Marzo";
      }
    if(intval(substr($fecha1,3,2))==4)
      {
         $nmes="Abril";
      }
    if(intval(substr($fecha1,3,2))==5)
      {
         $nmes="Mayo";
      }
    if(intval(substr($fecha1,3,2))==6)
      {
         $nmes="Junio";
      }
    if(intval(substr($fecha1,3,2))==7)
      {
         $nmes="Julio";
      }
    if(intval(substr($fecha1,3,2))==8)
      {
         $nmes="Agosto";
      }
    if(intval(substr($fecha1,3,2))==9)
      {
         $nmes="Septiembre";
      }
    if(intval(substr($fecha1,3,2))==10)
      {
         $nmes="Octubre";
      }
    if(intval(substr($fecha1,3,2))==11)
      {
         $nmes="Noviembre";
      }
    if(intval(substr($fecha1,3,2))==12)
      {
         $nmes="Diciembre";
      }
    $numemes=intval(substr($fecha1,3,2));
    $fecha2=$datos['Fechaf'];
    $fechaf=substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

    $fechabuena=0;
    if(intval(substr($fecha1,3,2))==12) 
     {
      if(intval(substr($fecha2,3,2))==1 and intval(substr($fecha2,6,4))>intval(substr($fecha1,6,4)))
       {
        $fechabuena=1;
       }
	else
       {
        $fechabuena=0;
       }
     }
     else
     {
       if(intval(substr($fecha2,3,2))>intval(substr($fecha1,3,2)))
        {
         $fechabuena=1;
        }
     }


    //solo guarda si es el mismo dia en las dos fechas
    //if(intval(substr($fecha1,0,2))==intval(substr($fecha2,0,2)) and $fechabuena==1)
      //{
        $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,idusuarios,sucursal,fechareg,pagado,mesnpagar,mespagar) 
 					VALUES ('".$datos['Cod_cliente']."','".$fechai."','".$fechaf."','".$usuario."',".$bodega.",now(),'".$datos['Pagado']."','".$nmes."','".$numemes."')";
        $resultado = mysql_query($sentencia);
      //}

    //Actualizamos el registro del cliente
    $b2x1=intval(substr($fechai,5,2));
    $b3x1=intval(substr($fechai,0,4));
    $xdia="28";


    if($b2x1==1) 
       {
        $b2x=12;
        $b3x=$b3x1-1;
       }
       else
       {
        $b2x=$b2x1-1;
        $b3x=$b3x1;
       }
      $axfechaini=strval($b3x)."-".strval($b2x)."-"."01";
      $axfechafin=$fechai;
      $xmespagar=$b2x;



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

    //Actualizamos el registro del cliente 
   $sentencia2 = "update clientes SET ulmespago='".$xmesnpagar."',ulfepago1='".$axfechaini."',ulfepago2='".$axfechafin."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Cod_cliente']."';";  
   $resultadot = mysql_query($sentencia2);

    return $resultado;
    exit;
}

function dat_eliminar_peridetalleff($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  entradas_deta where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_obtener_num_peridetalle_detalle($codigo)
{

	global $parametros , $conexion ;
	//obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from entradas_deta where codigo_entrada='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}



function dat_eliminar_peridetalle($id)
{
global $parametros , $conexion ;
$cliente=$_SESSION["ccliente"];
$bodega=$_SESSION["idBodega"];
        $sentencia = "delete from periodos where DATE_FORMAT(fechaini,'%d/%m/%Y')='".$id."' and cod_cliente='".$cliente."' and sucursal='".$bodega."'";
        $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_cod_peridetalle()
{
global $parametros , $conexion ;
	
	$sentencia="select case IFNULL(max(cast(codigo_entrada as decimal)),0) when '0' then 1 else max(cast(codigo_entrada as decimal))+1 end id FROM entradas";
	$resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
	{
		$fila=mysql_fetch_array($resultado);
		$retorno=$fila['id'];
	}
	else
	{
		$retorno=1;
	}
	
	return $retorno;
	exit;
}

function dat_obtener_peridetalle($bodega,$comienzo,$cant,$clie)
{
//se queda
	global $parametros , $conexion ;
	$sentencia="select DATE_FORMAT(fechaini,'%d/%m/%Y') Inicia, DATE_FORMAT(fechafin,'%d/%m/%Y') Finaliza, mesnpagar Mes, case pagado when 0 then 'NO' when 1 then 'SI' end Pagado, abonos Abonos
					from periodos where sucursal='".$bodega."' and cod_cliente='".$clie."'
					order by fechaini DESC LIMIT $comienzo, $cant";
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_peridetalle($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*)  from entradas where sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_peridetalleuno($id)
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


function dat_obtener_peridetalle_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{

	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select codigo_entrada Movim,case a.tipo when 1 then 'CR' when 2 then 'CF' when 3 then 'IM' end Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, n_reg_fiscal 'Compr.C.Fiscal', 
					n_factura Factura, n_poliza Poliza, total Total, descuento Descuento, iva IVA, ivaperci 'IVAPercep.', monto Monto
					from entradas a 
					left join  proveedores c ON a.codigo_prv = c.codigo_prv
					where a.sucursal='".$bodega."' and a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y')
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_obtener_num_peridetalle_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from entradas where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}





?>