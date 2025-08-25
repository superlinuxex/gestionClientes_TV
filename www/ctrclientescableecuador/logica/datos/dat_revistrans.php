<?php
require "dat_base.php";  

function dat_obtener_revistrans($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;
        $tipo="1";	
	$sentencia="select a.codigo_salida 'Movim', a.cod_crf 'Envio No.',DATE_FORMAT(a.fecha,'%d/%m/%Y') 'Fecha envio',
                           DATE_FORMAT(a.fecha_recibotran,'%d/%m/%Y') 'Fecha recibido', b.nombre 'Sucursal de despacho',
                           case a.estado when 1 then 'Despachado' when 2 then 'Recibido' end 'Estado'
					from salidas a left join bodegas b ON a.sucursal = b.idbodegas
					where a.codigo_bodega_destino='".$bodega."' and a.tipo='".$tipo."'
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_revistrans($bodega,$filtro)
{
	global $parametros , $conexion ;
        $tipo="1";	
	$sentencia="select count(*)  from salidas where codigo_bodega_destino='".$bodega."' and tipo='".$tipo."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_validar_revistrans($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from entradas where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_revistrans($Encabezado)
{
global $parametros , $conexion ;
	$codigo=$Encabezado['0'];
	$usuario=$Encabezado['1'];
	$bodega_ent=$Encabezado['2'];
	$bodega_sal=$Encabezado['3'];
	$obser=$Encabezado['4'];
	$fecha1=$Encabezado['5'];
	$codigoempl=$Encabezado['6'];
        $estado="1";

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

function dat_eliminar_revistransff($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  entradas_deta where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_revistrans_detalle($comienzo, $cant,$codigo)
{
global $parametros , $conexion ;
    $sentencia = "Select a.codigo_detalle Item, b.descripcion Articulo, b.unidadmed Medida, a.cantidad 'Despachado', a.cant_recibesucu 'Recibido'
					from salidas_deta a, articulos b
					where a.idarticulos = b.idarticulos 
					 and a.codigo_salida='".$codigo."';"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_detalle_revistrans($cod_encabezado, $cod_detalle)
{
global $parametros , $conexion ;
    $sentencia = "Select idarticulos Producto, unidadmed Medida, cantidad Cantidad
					from salidas_deta
					where codigo_salida='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_revistrans_detalle($codigo)
{

	global $parametros , $conexion ;
    $sentencia = "select codigo_detalle from salidas_deta where codigo_salida='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}


function dat_insertar_revistrans_detalle($datos,$bodega,$Encabezado)
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



function dat_eliminar_revistrans_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
global $parametros , $conexion ;

        //Elimino la linea del detalle 
        $sentencia = "delete from reqsuc_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
        $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_cod_revistrans()
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



function dat_obtener_revistrans_id($id)
{
	global $parametros , $conexion ;

	$sentencia="select codigo_salida Codigo,DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, sucursal 'Bodega_Origen', 
					cod_respon Codigoempl,observaciones Observaciones,cod_crf Envio, emple_recibotran Codigoempl2,obser_recibetrans Observacionest, fecha_recibotran Fechat  
					from salidas  where codigo_salida='".$id."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_revistrans($datos,$tipo,$registro)
{
 global $parametros , $conexion ;

 //Buscando el correlativo de la nueva transferencia.
 $bodx=$_SESSION["idBodega"];
 $tipo="1";
 $usuario=$_SESSION["idusuarios"];
 $bodegapide=$registro['Bodegapide'];
 $fecha1=$datos['Fechat'];
 $fechat=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
 $autoriza=$datos['Codigoempl2'];
 $observa=$datos['Observacionest'];

 $vestado=1;
 $sentencia3="select estado from salidas where codigo_salida='".$datos['Codigo']."'";
 $resultado3=mysql_query($sentencia3);
 if(isset($resultado3))
 {
  if(mysql_num_rows ( $resultado3)!=0)
  {
   $row=mysql_fetch_array($resultado3);
   $vestado=$row['estado'];
  }
 }

if($vestado==1)
{

 //Actualizando el encabezado de la transferencia
 $estado="2";
 $sentencia3="update salidas set fecha_recibotran='".$fechat."',estado='".$estado."',emple_recibotran='".$datos['Codigoempl2']."',obser_recibetrans='".$observa."' where codigo_salida='".$datos['Codigo']."'";
 $resultado3=mysql_query($sentencia3);
 
 //Actualizando el detalle de la transferencia
 $sentencia = "select codigo_detalle,idarticulos,cant_recibesucu,unidadmed,estado_art FROM salidas_deta where codigo_salida='".$datos['Codigo']."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ( $fila = mysql_fetch_array($resultadow))
       {
        $xidarticulo=$fila['idarticulos'];
        $xcantidadreci=$fila['cant_recibesucu'];
        $xunidadmed=$fila['unidadmed'];
        $xestadoart=$fila['estado_art'];

	        //Buscar el articulo en EXISTENCIAPROD y si no lo encuentra para esta sucursal, debe crealo
		$sentencia="select idarticulos from  existenciaprod where idbodegas='".$bodx."' and idarticulos='".$xidarticulo."'";
		$resultado = mysql_query($sentencia);
		if(isset($resultado))
		{
		 if(mysql_num_rows ( $resultado )!=0)
		 {
   		  $filaabc=mysql_fetch_array($resultado);
		 }
		 else
		 {
                  $sentencia="select tipo_art,descripcion,unidadmed from  articulos where idarticulos='".$xidarticulo."'";
	          $resultado2 = mysql_query($sentencia);
                  $xxtipo=null;
                  $xxdesc=null;
		  $xxunidad="";
            	  if(isset($resultado2))
                   {
                    if(mysql_num_rows($resultado2)!=0)
	            {
 	             $fila1=mysql_fetch_array($resultado2);
	             $xxtipo=$fila1['tipo_art'];
		     $xxdesc=$fila1['descripcion'];
		     $xxunidad=$fila1['unidadmed'];
                    }
                   }
   		   $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,tipo_art,unidadmed) VALUES ('".$xidarticulo."','".$bodx."','".$xxdesc."','".$xxtipo."','".$xxunidad."');";
		   $abcd=mysql_query($sentencia);
		  }
	         }


       if($xestadoart=="1")
       {
        //Actualizando los inventarios de la bodega de entrada (actual)
        $sentencia="update existenciaprod set cantidad=cantidad+'".$xcantidadreci."' where idbodegas='".$bodx."' and idarticulos='".$xidarticulo."';";
        $resultado=mysql_query($sentencia);
       }
       if($xestadoart=="2")
       {
        //Actualizando los inventarios de la bodega de entrada (actual)
        $sentencia="update existenciaprod set cantidadusa=cantidadusa+'".$xcantidadreci."' where idbodegas='".$bodx."' and idarticulos='".$xidarticulo."';";
        $resultado=mysql_query($sentencia);
       }


       }
     }
  }

}

if($vestado==2)
 {
  $resultado3=999;
 }

 return $resultado3;
 exit;

}



function dat_obtener_revistrans_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{

	global $parametros , $conexion ;
        $tipo="1";	

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select a.codigo_salida 'Movim', a.cod_crf 'Envio No.',DATE_FORMAT(a.fecha,'%d/%m/%Y') 'Fecha envio',
                           DATE_FORMAT(a.fecha_recibotran,'%d/%m/%Y') 'Fecha recibido', b.nombre 'Sucursal de despacho',
                           case a.estado when 1 then 'Despachado' when 2 then 'Recibido' end 'Estado'
					from salidas a left join bodegas b ON a.sucursal = b.idbodegas
					where a.codigo_bodega_destino='".$bodega."' and a.tipo='".$tipo."' and a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y')
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_obtener_num_revistrans_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

        $tipo="1";	

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from salidas where a.codigo_bodega_destino='".$bodega."' and a.tipo='".$tipo."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_actualizar_revistrans_detalle($datos,$cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{	global $parametros , $conexion ;

	$cantientra=$datos['Cantidadr'];
	$sentencia = "update salidas_deta set cant_recibesucu='".$datos['Cantidadr']."'
		      where codigo_salida='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'";
	$resultadoprinci = mysql_query($sentencia);
				
	return $resultadoprinci;
	exit;
}

function dat_ve_estatus_trans($cod_encabezado)
{
  $estadoenvi=0;
  $sentencia="select estado from salidas where codigo_salida='".$cod_encabezado."';";
  $resultado1 = mysql_query($sentencia);
  if(isset($resultado1))
   {
    if(mysql_num_rows ( $resultado1 )!=0)
     {
      $filam=mysql_fetch_array($resultado1);
      $estadoenvi=$filam['estado'];
     } 
   } 
 return $estadoenvi;
 exit;
}





?>