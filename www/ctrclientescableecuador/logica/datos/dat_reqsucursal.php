<?php
require "dat_base.php";  

function dat_obtener_requibc($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;
	$sentencia="select a.codigo_entrada Requisicion, DATE_FORMAT(fechar,'%d/%m/%Y') Fecha, b.nombre 'Sucursal solicita' , a.nomsucu2 'Sucursal despacha', case a.estado when 1 then 'Solicitado' when 2 then 'Despachado' end Estado, DATE_FORMAT(fechad,'%d/%m/%Y') 'Fecha despacho'
					from reqsuc a left join bodegas b ON a.sucursal = b.idbodegas
					where a.sucursal='".$bodega."'
					order by a.fechar LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_requibc($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*)  from reqsuc where sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_validar_requibc($id)
{
	global $parametros , $conexion ;
    $sentencia = "select * from reqsuc_deta where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_requibc($Encabezado)
{
global $parametros , $conexion ;
	$codigo=$Encabezado['0'];
	$usuario=$Encabezado['1'];
	$bodega_ent=$Encabezado['2'];
	$bodega_sal=$Encabezado['3'];
	$obser=$Encabezado['4'];
	$fecha1=$Encabezado['5'];
	$codigoempl=$Encabezado['6'];
        $estado="1";  //estado es:SOLICITADO

    	$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

	$xnombrebod="";
        $sentencia="select nombre from bodegas where idbodegas='".$bodega_sal."'";
        $resultado2 = mysql_query($sentencia);
 	 if(isset($resultado2))
            {
             if(mysql_num_rows($resultado2)!=0)
              {
 	       $fila1=mysql_fetch_array($resultado2);
	       $xnombrebod=$fila1['nombre'];
              }
            }

    $sentencia = "insert into reqsuc (codigo_entrada,fechar,idusuarios,sucursal,nomsucu2,codigo_bodega_sale,observacion,cod_empler,fechareg,estado) 
 					VALUES ('".$codigo."','".$fecha."','".$usuario."','".$bodega_ent."','".$xnombrebod."','".$bodega_sal."','".$obser."','".$codigoempl."',now(),'".$estado."')";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_entradaff($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  entradas_deta where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_requibc_detalle($comienzo, $cant,$codigo)
{
global $parametros , $conexion ;
    $sentencia = "Select a.codigo_detalle Item, b.descripcion Articulo, b.unidadmed Medida, a.cantidad Cantidad
					from reqsuc_deta a, articulos b
					where a.idarticulos = b.idarticulos 
					 and a.codigo_entrada='".$codigo."';"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_detalle_requibc($cod_encabezado, $cod_detalle)
{
global $parametros , $conexion ;
    $sentencia = "Select idarticulos Producto, unidadmed Medida, cantidad Cantidad
					from reqsuc_deta
					where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_requibc_detalle($codigo)
{

	global $parametros , $conexion ;
    $sentencia = "select codigo_detalle from reqsuc_deta where codigo_entrada='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}


function dat_insertar_requibc_detalle($datos,$bodega,$Encabezado)
{
global $parametros , $conexion ;

        $fecha1=$Encabezado['5'];
        $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
        $producto=$datos['Producto'];
        $cant=$datos['Cantidad'];

	$sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_entrada 
				FROM reqsuc_deta where codigo_entrada='".$datos['CodEntrada']."'";
	$cod_tab=mysql_query($sentencia);
	$cod_entrada_deta=mysql_fetch_array($cod_tab);

	$sentencia="select unidadmed from  articulos where idarticulos='".$producto."'";
        $resultado2 = mysql_query($sentencia);
        $xunidadmed="";
      	if(isset($resultado2))
         {
          if(mysql_num_rows($resultado2)!=0)
	   {
 	    $fila1=mysql_fetch_array($resultado2);
	    $xunidadmed=$fila1['unidadmed'];
           }
          }
	 $usuario=$Encabezado['1'];


         $sentencia = "insert into reqsuc_deta (codigo_entrada,codigo_detalle,idarticulos,cantidad,sucursal,fecha,unidadmed,idusuarios,fechareg) 
					VALUES ('".$datos['CodEntrada']."'
					  ,'".$cod_entrada_deta['cod_entrada']."'
					  ,'".$datos['Producto']."'
					  ,'".$datos['Cantidad']."'
					  ,'".$bodega."'
					  ,'".$fecha."'
					  ,'".$xunidadmed."'
					  ,'".$usuario."'
					  ,now())";
        $resultado = mysql_query($sentencia);

	return $resultado;
	exit;
}



function dat_eliminar_requibc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
global $parametros , $conexion ;

        //Elimino la linea del detalle 
        $sentencia = "delete from reqsuc_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
        $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_cod_requibc()
{
global $parametros , $conexion ;
	
	$sentencia="select case IFNULL(max(cast(codigo_entrada as decimal)),0) when '0' then 1 else max(cast(codigo_entrada as decimal))+1 end id FROM reqsuc";
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



function dat_obtener_requibc_id($id)
{
	global $parametros , $conexion ;
	$sentencia="select codigo_entrada Codigo,DATE_FORMAT(fechar,'%d/%m/%Y') Fecha, codigo_bodega_sale 'Bodega_Origen', 
					cod_empler Codigoempl,observacion Observaciones,estado Estado
					from reqsuc where codigo_entrada='".$id."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_requibc($datos,$tipo)
{
	global $parametros , $conexion ;
	$usuariocambia=$_SESSION["idusuarios"];
	$sentencia = "update reqsuc set cod_empler='".$datos['Codigoempl']."',observacion='".$datos['Observaciones']."',fechamod=now(),idusuariomod='".$usuariocambia."'
		      where codigo_entrada='".$datos['Codigo']."';";
	$resultadoprinci = mysql_query($sentencia);
					
	return $resultadoprinci;
	exit;
}



function dat_obtener_requibc_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{

	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select a.codigo_entrada Requisicion, DATE_FORMAT(fechar,'%d/%m/%Y') Fecha, b.nombre 'Sucursal solicita' , a.nomsucu2 'Sucursal despacha', case a.estado when 1 then 'Solicitado' when 2 then 'Despachado' end Estado, DATE_FORMAT(fechad,'%d/%m/%Y') 'Fecha despacho'
					from reqsuc a left join bodegas b ON a.sucursal = b.idbodegas
					where a.sucursal='".$bodega."' and a.fechar>=str_to_date('$filtro1','%d-%m-%Y') and a.fechar<=str_to_date('$filtro2','%d-%m-%Y')
					order by a.fechar LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_obtener_num_requibc_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from requibc where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_actualizar_requibc_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{	global $parametros , $conexion ;
	$sentencia = "update reqsuc_deta set cantidad='".$datos['Cantidad']."'
		      where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'";
	$resultadoprinci = mysql_query($sentencia);
					
	return $resultadoprinci;
	exit;
}




?>