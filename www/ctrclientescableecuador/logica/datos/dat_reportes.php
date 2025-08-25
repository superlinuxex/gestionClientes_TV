<?php
require "dat_base.php";  

function dat_obtener_datosmapa()
{
  global $parametros , $conexion ;
  $sentencia = "SELECT * FROM markers";
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}

function dat_obtener_hojaiden($id)
{
  global $parametros , $conexion ;
  //obtine datos de encabezado de la transferencia
  $sentencia = "select * from salidas	where codigo_salida='".$id."'";  
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}

function dat_obtener_datosfac($id,$id0)
{
  global $parametros , $conexion ;
  //obtine datos de encabezado de la factura
  $sentencia = "select * from facturas	where numero='".$id."' and sucursal='".$id0."'";  
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}


function dat_obtener_datosfacww($id1,$id2,$id3,$id4)
{
  global $parametros , $conexion ;
  //obtine datos de encabezado de la factura
  $sentencia = "select * from facturas	where numero='".$id1."' and tipofac='".$id2."' and fechafac=str_to_date('$id3','%d-%m-%Y') and sucursal='".$id4."'";  
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}

function dat_obtener_datosclie($id,$bodega)
{
  global $parametros , $conexion ;
  $sentencia = "select * from clientes	where cod_cliente='".$id."' and sucursal='".$bodega."'";  
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}


function dat_obtener_kardex($fecha_fin, $producto, $bode)
{
	global $parametros , $conexion ;
	//obtine reporte de kardex

$fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);


    $sentencia = "select * from vw_rpt_kardex
					where idarticulo='".$producto."'  
					and bodega=$bode and fecha<='".$fecha_fin."' 
					order by fecha,tipomov,cod_movi";
    $resultado = mysql_query($sentencia);

    return $resultado;
	exit;
}

function dat_obtener_movimientos($fecha_ini, $fecha_fin, $producto, $bode)
{
	global $parametros , $conexion ;
	//obtine reporte de movimientos
    $sentencia = "select * from vw_rpt_movimientos
					where idarticulo='".$producto."'  
					and bodega=$bode and fecha between '".$fecha_ini."' and '".$fecha_fin."' 
					order by fecha,tipomov,cod_movi";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existencias($proy,$bod,$prod)
{
	global $parametros , $conexion ;
	//obtine reporte de  existencias
    $sentencia = "select * from vw_rpt_existencias 
					where cod_proyecto=if('".$proy."'='',cod_proyecto,'".$proy."') 
					and cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
					and cod_articulo=if('".$prod."'='',cod_articulo,'".$prod."') 
					order by cod_proyecto, cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasm($proy,$bod)
{
	global $parametros , $conexion ;

//actualizando las existencias
 //Actualiza temporalmente existencias a partir de los movimientos de entrada y salida
 $primero="delete from existencias where idbodega='".$bod."'";
 $primero1 = mysql_query($primero);

 //ENTRADAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from entradas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into existencias (idarticulo,idbodega,cantidad,tipo_art)
	  values('".$xarti."','".$xbode."','".$xcanti."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }

 //SALIDAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from salidas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad-'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
      }
    }
  }
//fin de actualizar las existencias

	//obtine reporte de  existencias de materiales
    $sentencia = "select * from vw_rpt_existenciasm 
					where cod_proyecto=if('".$proy."'='',cod_proyecto,'".$proy."') 
					and cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
                                        and tipo_art='1'
					order by cod_proyecto, cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasm2($bod)
{
	global $parametros , $conexion ;
	//obtine reporte de  existencias de materiales enlacevision
    $sentencia = "select * from existenciaprod where idbodegas='".$bod."' order by idbodegas, descripcion";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasr($proy,$bod)
{
	global $parametros , $conexion ;
//actualizando las existencias
 //Actualiza temporalmente existencias a partir de los movimientos de entrada y salida
 $primero="delete from existencias where idbodega='".$bod."'";
 $primero1 = mysql_query($primero);

 //ENTRADAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from entradas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into existencias (idarticulo,idbodega,cantidad,tipo_art)
	  values('".$xarti."','".$xbode."','".$xcanti."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }

 //SALIDAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from salidas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad-'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
      }
    }
  }
//fin de actualizar las existencias


	//obtine reporte de  existencias de repuestos
    $sentencia = "select * from vw_rpt_existenciasm 
					where cod_proyecto=if('".$proy."'='',cod_proyecto,'".$proy."') 
					and cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
                                        and tipo_art='3'
					order by cod_proyecto, cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasr2($bod)
{
	global $parametros , $conexion ;
	//obtine reporte de  existencias de repuestos
    $sentencia = "select * from vw_rpt_existenciasm2 
					where cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
                                        and tipo_art='3'
					order by cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasc($proy,$bod)
{
	global $parametros , $conexion ;

//actualizando las existencias
 //Actualiza temporalmente existencias a partir de los movimientos de entrada y salida
 $primero="delete from existencias where idbodega='".$bod."'";
 $primero1 = mysql_query($primero);

 //ENTRADAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from entradas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into existencias (idarticulo,idbodega,cantidad,tipo_art)
	  values('".$xarti."','".$xbode."','".$xcanti."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }

 //SALIDAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from salidas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from existencias where idarticulo='".$carticulo."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de existencias solo suma a las salidas
         $sentencia4 = "update existencias set cantidad=cantidad-'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
      }
    }
  }
//fin de actualizar las existencias


	//obtine reporte de  existencias de combustibles
    $sentencia = "select * from vw_rpt_existenciasm 
					where cod_proyecto=if('".$proy."'='',cod_proyecto,'".$proy."') 
					and cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
                                        and tipo_art='2'
					order by cod_proyecto, cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_existenciasc2($bod)
{
	global $parametros , $conexion ;
	//obtine reporte de  existencias de combustibles
    $sentencia = "select * from vw_rpt_existenciasm2 
					where cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
                                        and tipo_art='2'
					order by cod_bodega, nom_articulo";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_obtener_mov_dia2_ORIGINAL($fecha,$proy,$bod)
{
	global $parametros , $conexion ;
	//obtine reporte de  movimientos diarios
	$sentenciaIni ="";
	$sentenciaWhere="";
	$sentenciaFecha="";
	$sentenciaProy="";
	$sentenciaBode="";
	$sentenciaArt="";
	$agegarAnd =false;
    $sentenciaIni = "select fecha, cod_obra, nom_obra, cod_bodega, nom_bodega, articulo, 
					descripcion, unidad_medida, existencia_origen, entrada, salida, saldo
					from vw_rpt_movimientos_diarios ";
	if ($fecha!='' or $proy!='' or $bod!='' or $prod!='')
	{
		$sentenciaWhere=" where ";
	}
	if ($fecha!='')
	{
		$sentenciaFecha=" fecha='".$fecha."' ";
		$agegarAnd =true;
	}
	if ($proy!='')
	{
		if ($agegarAnd =true)
		{
			$sentenciaProy=" and cod_obra='".$proy."' ";
		}
		else
		{
			$sentenciaProy=" cod_obra='".$proy."' ";
		}
		$agegarAnd =true;
	}
	if ($bod!='')
	{
		if ($agegarAnd =true)
		{
			$sentenciaBode=" and cod_bodega='".$bod."' ";
		}
		else
		{
			$sentenciaBode=" cod_bodega='".$bod."' ";
		}
		$agegarAnd =true;
	}
	$sentencia=$sentenciaIni.$sentenciaWhere.$sentenciaFecha.$sentenciaProy.$sentenciaBode;
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_mov_diaORIGINAL($fecha,$proy,$bod)
{
	global $parametros , $conexion ;
	//obtine reporte de  movimientos diarios
	$sentenciaIni ="";
	$sentenciaWhere="";
	$sentenciaFecha="";
	$sentenciaProy="";
	$sentenciaBode="";
	$sentenciaArt="";
	$agegarAnd =false;
        $sentenciaIni = "select fecha, cod_obra, nom_obra, cod_bodega, nom_bodega, articulo, 
					descripcion, unidad_medida, existencia_origen, entrada, salida, saldo
					from vw_rpt_movimientos_diarios";
	if ($fecha!='' or $proy!='' or $bod!='')
	{
		$sentenciaWhere=" where ";
	}
	if ($fecha!='')
	{
		$sentenciaFecha=" fecha='".$fecha."' ";
		$agegarAnd =true;
	}
	if ($proy!='')
	{
		if ($agegarAnd =true)
		{
			$sentenciaProy=" and cod_obra='".$proy."' ";
		}
		else
		{
			$sentenciaProy=" cod_obra='".$proy."' ";
		}
		$agegarAnd =true;
	}
	if ($bod!='')
	{
		if ($agegarAnd =true)
		{
			$sentenciaBode=" and cod_bodega='".$bod."' ";
		}
		else
		{
			$sentenciaBode=" cod_bodega='".$bod."' ";
		}
		$agegarAnd =true;
	}
	$sentencia=$sentenciaIni.$sentenciaWhere.$sentenciaFecha.$sentenciaProy.$sentenciaBode;
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_mov_dia($fecha,$proy,$bod)
{
	global $parametros , $conexion ;

$fecha=substr($fecha,0,2)."-".substr($fecha,3,2)."-".substr($fecha,6,4);


 //Actualiza temporalmente existencias a partir de los movimientos de entrada y salida
 $primero="delete from movimientos where idbodega='".$bod."'";
 $primero1 = mysql_query($primero);

 //ENTRADAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from entradas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $fechamov=$filaabc['fecha'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from movimientos where idarticulo='".$carticulo."' and fecha='".$fechamov."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de movimientos solo suma a las salidas
         $sentencia4 = "update movimientos set entradas=entradas+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and fecha='".$filaabc['fecha']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into movimientos (idarticulo,nombrear,entradas,salidas,fecha,idbodega,tipo_art)
	  values('".$xarti."','".$xdescri."','".$xcanti."',0,'".$fechamov."','".$xbode."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }
 //SALIDAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from salidas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $fechamov=$filaabc['fecha'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from movimientos where idarticulo='".$carticulo."' and fecha='".$fechamov."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de movimientos solo suma a las salidas
         $sentencia4 = "update movimientos set salidas=salidas+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and fecha='".$filaabc['fecha']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into movimientos (idarticulo,nombrear,entradas,salidas,fecha,idbodega,tipo_art)
	  values('".$xarti."','".$xdescri."',0,'".$xcanti."','".$fechamov."','".$xbode."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }
 //fin actualizacion temporal

	//obtine reporte de  movimientos diarios
	$sentenciaIni ="";
	$sentenciaWhere="";
	$sentenciaFecha="";
	$sentenciaProy="";
	$sentenciaBode="";
	$sentenciaArt="";
	$agegarAnd =false;
        $sentenciaIni = "select fecha, idarticulo, nombrear, entradas, salidas, idbodega, tipo_art
					from movimientos where fecha>=str_to_date('$fecha','%d-%m-%Y') and fecha<=str_to_date('$fecha','%d-%m-%Y') and idbodega=$bod";
    $resultado = mysql_query($sentenciaIni);
    return $resultado;
	exit;
}

function dat_obtener_mov_salidas($fecha,$proy,$bod)
{
	global $parametros , $conexion ;

$fecha=substr($fecha,0,2)."-".substr($fecha,3,2)."-".substr($fecha,6,4);

	//obtine reporte de  vales
        $sentenciaIni = "select codigo_salida, tipo, fecha, codigo_bodega_salida, codigo_vale, autoriza, observaciones
					from salidas where fecha=str_to_date('$fecha','%d-%m-%Y') and codigo_bodega_salida=$bod and tipo='1'";
    $resultado = mysql_query($sentenciaIni);
    return $resultado;
	exit;
}


function dat_obtener_mov_salidasco($fecha,$proy,$bod)
{
	global $parametros , $conexion ;

$fecha=substr($fecha,0,2)."-".substr($fecha,3,2)."-".substr($fecha,6,4);

	//obtine reporte de  vales
        $sentenciaIni = "select codigo_salida, tipo, fecha, codigo_bodega_salida, codigo_vale, autoriza, observaciones
					from salidas where fecha=str_to_date('$fecha','%d-%m-%Y') and codigo_bodega_salida=$bod and tipo='1'";
    $resultado = mysql_query($sentenciaIni);
    return $resultado;
	exit;
}


function dat_obtener_mov_sema($fecha_ini, $fecha_fin,$proy,$bod)
{
 global $parametros , $conexion ;
 //obtine reporte de  movimientos semanales

$fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
$fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);



 //Actualiza temporalmente existencias a partir de los movimientos de entrada y salida
 $primero="delete from movimientos where idbodega='".$bod."'";
 $primero1 = mysql_query($primero);

 //ENTRADAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from entradas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $fechamov=$filaabc['fecha'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from movimientos where idarticulo='".$carticulo."' and fecha='".$fechamov."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de movimientos solo suma a las salidas
         $sentencia4 = "update movimientos set entradas=entradas+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and fecha='".$filaabc['fecha']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into movimientos (idarticulo,nombrear,entradas,salidas,fecha,idbodega,tipo_art)
	  values('".$xarti."','".$xdescri."','".$xcanti."',0,'".$fechamov."','".$xbode."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }
 //SALIDAS
 $sentencia = "select idarticulo,cantidad,fecha,idbodega from salidas_deta where idbodega='".$bod."'";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $fechamov=$filaabc['fecha'];
     $xcanti=$filaabc['cantidad'];
     $xbode=$filaabc['idbodega'];
     $sentencia2="select idarticulo from movimientos where idarticulo='".$carticulo."' and fecha='".$fechamov."' and idbodega='".$bod."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla de movimientos solo suma a las salidas
         $sentencia4 = "update movimientos set salidas=salidas+'".$filaabc['cantidad']."' where idarticulo='".$filaabc['idarticulo']."' and fecha='".$filaabc['fecha']."' and idbodega='".$bod."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la tabla de sumas de entradas
         $xarti=$filaabc['idarticulo'];
         $xdescri="";
         $xtipoarti="";
         $sentencia="select tipo_art,descripcion from articulos where idarticulos='".$xarti."'"; 
         $resultadob = mysql_query($sentencia);
         if(isset($resultadob))
          {
           if(mysql_num_rows ( $resultadob )!=0)
           {
            $filaxyz=mysql_fetch_array($resultadob);
            $xdescri=$filaxyz['descripcion'];
            $xtipoarti=$filaxyz['tipo_art'];

           }
          }
          $sentencia3="insert into movimientos (idarticulo,nombrear,entradas,salidas,fecha,idbodega,tipo_art)
	  values('".$xarti."','".$xdescri."',0,'".$xcanti."','".$fechamov."','".$xbode."','".$xtipoarti."')";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }
 //fin actualizacion temporal




 $sentenciaIni ="";
 $sentenciaWhere="";
 $sentenciaFecha="";
 $sentenciaProy="";
 $sentenciaBode="";
 $sentenciaArt="";
 $agegarAnd =false;
 $lafecha=$fecha_ini;

 $sentenciaq = "delete from movimientos2";
 $resultadoq = mysql_query($sentenciaq);
  
 $sentencia = "select fecha, idarticulo, nombrear, entradas, salidas, idbodega, tipo_art
		from movimientos where fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y') and idbodega=$bod";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $carticulo=$filaabc['idarticulo'];
     $sentencia2="select idarticulo from movimientos2 where idarticulo='".$carticulo."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         //si encontro registro de ese articulo en la tabla temporal solo actualiza entradas y salidas
         $sentencia4 = "update movimientos2 set entradas=entradas+'".$filaabc['entradas']."', salidas=salidas+'".$filaabc['salidas']."' where idarticulo='".$filaabc['idarticulo']."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
	else
        {
         //si no encontro registro del articulo, agrega uno nuevo a la temporal
         $sentencia3="insert into movimientos2 (idarticulo,nombrear,entradas, salidas, fecha, idbodega, tipo_art, fechapigo)
	  values('".$filaabc['idarticulo']."','".$filaabc['nombrear']."','".$filaabc['entradas']."','".$filaabc['salidas']."','".$filaabc['fecha']."','".$filaabc['idbodega']."','".$filaabc['tipo_art']."',str_to_date('$fecha_ini','%d-%m-%Y'))";  
	 $resultado3 = mysql_query($sentencia3);
	}
      }
    }
  }
  $sentencia = "select fecha, idarticulo, nombrear, entradas, salidas, idbodega, tipo_art, fechapigo from movimientos2";
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}


function dat_obtener_datosvale($proy,$bod,$vale)
{
	global $parametros , $conexion ;
	//obtine reporte de  existencias
    $sentencia = "select * from vw_rpt_vales 
					where cod_proyecto=if('".$proy."'='',cod_proyecto,'".$proy."') 
					and cod_bodega=if('".$bod."'='',cod_bodega,'".$bod."') 
					and numero_vale=if('".$vale."'='',numero_vale,'".$vale."') 
					order by cod_proyecto, cod_bodega, numero_vale";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_partidas_repo1($fecha_ini, $fecha_fin,$proy,$bod)

{
	global $parametros , $conexion ;
$fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
$fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);


    $sentencia = "select * FROM vw_rpt_costos_par where fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y') and cod_proyecto=$proy and cod_bodega=$bod order by cod_bodega, cod_proyecto, num_partida"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_gastos_rgastos1($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);

 $sentencia="select * from facturap where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod order by fechafac";
$resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas_deta_cf($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="1";
 $sentencia="select * from facturas where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and tipofac='".$tipofac."' order by cast(numero as decimal),fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas_d_cf($fecha_ini,$fecha_fin,$bod,$ser)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="2";
 if($ser!="")
 {
 $sentencia="select a.numero,a.fechafac,a.cod_cliente,b.nom_clie,a.concepto,a.precio,a.descuento,a.total,a.tipofac,a.sucursal 
 from detafac a,facturas b 
 where a.numero=b.numero and a.fechafac=b.fechafac and a.cod_cliente=b.cod_cliente and a.sucursal=b.sucursal and a.fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and a.fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and a.sucursal=$bod and a.codservi=$ser and a.tipofac='".$tipofac."' order by cast(a.numero as decimal),a.fechafac";
 $resultado = mysql_query($sentencia);
 }
 if($ser=="")
 {
 $sentencia="select a.numero,a.fechafac,a.cod_cliente,b.nom_clie,a.concepto,a.precio,a.descuento,a.total,a.tipofac,a.sucursal 
 from detafac a,facturas b 
 where a.numero=b.numero and a.fechafac=b.fechafac and a.cod_cliente=b.cod_cliente and a.sucursal=b.sucursal and a.fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and a.fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and a.sucursal=$bod and a.tipofac='".$tipofac."' order by cast(a.numero as decimal),a.fechafac";
 $resultado = mysql_query($sentencia);
 }

 return $resultado;
 exit;
}

function dat_obtener_ventas_usuario($fecha_ini,$fecha_fin,$elusuario,$bod)
{
 global $parametros , $conexion ;
 $xfecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $xfecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="3";
 if($elusuario!=""){
  $sentencia="select * from detafac where fechafac>=str_to_date('$xfecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$xfecha_fin','%d-%m-%Y') and idusuarios='".$elusuario."' order by cast(numero as decimal),fechafac";
 }
 else{
  $sentencia="select * from detafac where fechafac>=str_to_date('$xfecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$xfecha_fin','%d-%m-%Y') order by cast(numero as decimal),fechafac";
 }
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}


function dat_obtener_ventas_deta_cr($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="2";
 $sentencia="select * from facturas where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and tipofac='".$tipofac."' order by fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="2";
 $sentencia="select * from facturas where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and sucursal=$bod";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}


function dat_obtener_rangosdefacturas($fecha_ini,$fecha_fin,$bod,$tipo)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 if($tipo==1)
 {
	 $sentencia="select * from taloncf where fechaini>=str_to_date('$fecha_ini','%d-%m-%Y') and fechaini<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod";
	 $resultado = mysql_query($sentencia);
 }
 else
 {
	 $sentencia="select * from taloncr where fechaini>=str_to_date('$fecha_ini','%d-%m-%Y') and fechaini<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod";
	 $resultado = mysql_query($sentencia);
 }
 return $resultado;
 exit;
}

function dat_obtener_gastosreme($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="2";
 $sentencia="select * from facturap where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and sucursal=$bod";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_remesas($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $sentencia="select * from remesucu where fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod order by fecha";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas_d_cr($fecha_ini,$fecha_fin,$bod)

{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipofac="2";
 $sentencia="select * from detafac where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and tipofac='".$tipofac."' order by fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas_cuotas($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $tipocon="1";
 $sentencia="select * from detafac where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and codservi='".$tipocon."' order by fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}
function dat_obtener_fac_anuladas($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $xanulada="1";
 $sentencia="select * from facturas where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and anulada='".$xanulada."' order by fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_clientes_conec($fecha_ini,$fecha_fin,$moti,$servi,$bod)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $xconec="1";

 if($servi==0)
{
 $sentencia="select * from clientes where fechaip>=str_to_date('$fecha_ini','%d-%m-%Y') and fechaip<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and estatus=1 order by ttplan DESC";
 $resultado = mysql_query($sentencia);
 return $resultado;
}
else
{
 $sentencia="select * from clientes where fechaip>=str_to_date('$fecha_ini','%d-%m-%Y') and fechaip<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and estatus=1 and ttplan=$servi order by ttplan DESC";
 $resultado = mysql_query($sentencia);
 return $resultado;
}
 exit;
}

function dat_obtener_clientes_coneccontrat($bod)
{
 global $parametros , $conexion ;

 $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by fechai DESC";
 $resultado = mysql_query($sentencia);

 return $resultado;
 exit;
}

function dat_obtener_clientes_desco($fecha_ini,$fecha_fin,$moti,$servi,$bod)
{
 global $parametros , $conexion ;
 $fecha_in1=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fi1=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);

 $xmoti=$moti;
 $xservi=$servi;
 if($moti==0 and $servi==0)
{
 $sentencia="select * from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus!=1 order by fedesco DESC";
 $resultado = mysql_query($sentencia);
}

if($moti!=0 and $servi!=0)
{
 $sentencia="select * from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus!=1 and motidesco='".$xmoti."' and ttplan='".$xservi."' order by fedesco DESC";
 $resultado = mysql_query($sentencia);
}

if($moti==0 and $servi!=0)
{
 $sentencia="select * from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus!=1 and ttplan='".$xservi."' order by fedesco DESC";
 $resultado = mysql_query($sentencia);
}

if($moti!=0 and $servi==0)
{
 $sentencia="select * from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus!=1 and motidesco='".$xmoti."' order by fedesco DESC";
 $resultado = mysql_query($sentencia);
}

 return $resultado;
 exit;
}

function dat_obtener_clientes_mora($numemeses,$tipoinfo,$bod)
{
 global $parametros , $conexion ;
 $sentencia66 = "select * FROM clientes where estatus=1 and sucursal=$bod"; 
 $resultado = mysql_query($sentencia66);
 return $resultado;
 exit;
}



function dat_obtener_clientes_descom($fecha_ini,$fecha_fin,$tipoinfo,$bod)
{
 global $parametros , $conexion ;

 $fecha_in1=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fi1=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);


 if($tipoinfo==1)
  {
   $sentencia="select * from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus!=1 and morahoy>0 order by fedesco";
   $resultado = mysql_query($sentencia);
  }

 return $resultado;
 exit;
}

function dat_obtener_clientes_descomnodo($sector,$mes,$bod)
{
 global $parametros , $conexion ;
 $sentencia4 = "update clientes set tipoproducto=substr(fedesco,6,2) where sucursal=$bod";  
 $resultado4 = mysql_query($sentencia4);

if(intval($mes)<1 or intval($mes)>12)
{
 $mes="";
}
if($sector!="" and $mes!="")
 {
 $sentencia="select * from clientes where zona=$sector and tipoproducto=$mes and sucursal=$bod and estatus!=1 and bande1=0 order by fedesco";
 $resultado = mysql_query($sentencia);
 }

if($sector!="" and $mes=="")
 {
 $sentencia="select * from clientes where zona=$sector and sucursal=$bod and estatus!=1 and bande1=0 order by fedesco";
 $resultado = mysql_query($sentencia);
 }

if($sector=="" and $mes!="")
 {
 $sentencia="select * from clientes where tipoproducto=$mes and sucursal=$bod and estatus!=1 and bande1=0 order by fedesco";
 $resultado = mysql_query($sentencia);
 }

if($sector=="" and $mes=="")
 {
 $sentencia="select * from clientes where sucursal=$bod and estatus!=1 and bande1=0 order by fedesco";
 $resultado = mysql_query($sentencia);
 }


 return $resultado;
 exit;
}


function dat_obtener_clientes_avisoscf_poma($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 if($cod=="")
{
 $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,
 parametrompendi,parametroprint,otraref,fechap,otraref,valorplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=1 order by apellido";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 }
  else
{
 $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,
 parametrompendi,parametroprint,otraref,fechap,otraref,valorplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where cod_vende=$cod and fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=1 order by apellido";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 }

 return $resultado;
 exit;
}


function dat_obtener_clientes_avisoscf($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,valorplan,ttplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura='3'";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 return $resultado;
 exit;
}


function dat_obtener_clientes_avisosre_sec($fecha_ini,$fecha_fin,$zo,$zo2,$bod)
{
 global $parametros , $conexion ;

 $a1=$zo;
 $b1=$zo2;


 $uno=0;
 $sentencia="update clientes set parametroprint='".$uno."',dias_reconexion='".$uno."',pago_por_dias='".$uno."' where sucursal=$bod";
 $resultado2 = mysql_query($sentencia);

 //$fechat1=date('d-m-Y');
 $fechat1=$fecha_ini;

 $fecha_ff1="01"."-".substr($fechat1,3,2)."-".substr($fechat1,6,4);
 $fecha_fi1="01-05-2018";

 $xmex2=intval(substr($fechat1,3,2));

if($a1!="" and $b1=="")
{
 $sentencia66 = "select nmuni,ncan,valorplan,ttplan,sucursal,cod_cliente,nit,ulfepago1,ulfepago2,fechaip,nombre,apellido,fechaul,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,pasaje,poligono,casa,blocke,calle,ave,otraref,telefono,zona 
 FROM clientes where estatus=1 and sucursal=$bod and cod_ciudad=$a1 order by clientes.zona+0,poligono ASC"; 
 $resultado = mysql_query($sentencia66);
 return $resultado;
}

if($a1!="" and $b1!="")
{
 $sentencia66 = "select nmuni,ncan,valorplan,ttplan,sucursal,cod_cliente,nit,ulfepago1,ulfepago2,fechaip,nombre,apellido,fechaul,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,pasaje,poligono,casa,blocke,calle,ave,otraref,telefono,zona 
 FROM clientes where estatus=1 and sucursal=$bod and cod_ciudad=$a1 and cod_canton=$b1  order by clientes.zona+0,poligono ASC"; 
 $resultado = mysql_query($sentencia66);
 return $resultado;
}
if($a1=="" and $b1=="")
 {
  $sentencia66 = "select nmuni,ncan,valorplan,ttplan,sucursal,cod_cliente,nit,ulfepago1,ulfepago2,fechaip,nombre,apellido,fechaul,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,pasaje,poligono,casa,blocke,calle,ave,otraref,telefono,zona 
  FROM clientes where estatus=1 and sucursal=$bod and ulfepago2>=str_to_date('$fecha_fi1','%d-%m-%Y') and ulfepago1<str_to_date('$fecha_ff1','%d-%m-%Y') order by clientes.zona+0,poligono ASC"; 
  $resultado = mysql_query($sentencia66);
  return $resultado;
 }
 exit;
}




function dat_obtener_clientes_avisosre($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
  //Eliminando los periodos pagados de los clientes y que ya no se usaran
  //$sentencia1 = "delete from  periodos where pagado=1";  
  //$resultadoabc = mysql_query($sentencia1);
  //$sentencia="select cod_cliente,nombre,apellido,dui,nit,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
  //otraref,valorplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where estatus=1 and sucursal=$bod and ttfactura=3 order by clientes.zona+0,poligono ASC";
  //$resultado = mysql_query($sentencia);
  //return $resultado;
  //exit;

 $uno=0;
 $sentencia="update clientes set parametroprint='".$uno."' where sucursal=$bod";
 $resultado2 = mysql_query($sentencia);

 $fechat1=date('d-m-Y');
 $fecha_ff1="01"."-".substr($fechat1,3,2)."-".substr($fechat1,6,4);
 $fecha_fi1="01-05-2018";

 $xmex2=intval(substr($fechat1,3,2));
 $numemeses="";
 if($numemeses<>"")
 {
 if($numemeses==1)
 {
  $mesescuenta=$xmex2;  
 }
 if($numemeses==2)
 {
  $mesescuenta=$xmex2-1;  
 }
 if($numemeses==3)
 {
  $mesescuenta=$xmex2-2;
 }
 if($numemeses==4)
 {
  $mesescuenta=$xmex2-3;
 }
 if($numemeses==5)
 {
  $mesescuenta=$xmex2-4;
 }

  if($mesescuenta>0 and $mesescuenta<10)
   {
    $filtromes="0".$mesescuenta; 
   }
   else
   {
    if($mesescuenta==0)
     {
       $filtromes="12";
     }
    if($mesescuenta==-1)
     {
       $filtromes="11";
     }
    if($mesescuenta==-2)
     {
       $filtromes="10";
     }
    if($mesescuenta==-3)
     {
       $filtromes="09";
     }
    if($mesescuenta==-4)
     {
       $filtromes="08";
     }

   }

 $sentencia66 = "select * FROM clientes where estatus=1 and sucursal=$bod and substr(ulfepago2,6,2)=$filtromes"; 
 $resultado = mysql_query($sentencia66);
 return $resultado;
}
else
{
 $sentencia66 = "select valorplan,ttplan,sucursal,cod_cliente,nit,ulfepago1,ulfepago2,fechaip,nombre,apellido,fechaul,cod_depto,cod_ciudad,cod_canton,cod_barrio,cod_caserio,pasaje,poligono,casa,blocke,calle,ave,otraref,telefono FROM clientes where estatus=1 and sucursal=$bod and ulfepago2>=str_to_date('$fecha_fi1','%d-%m-%Y') and ulfepago1<str_to_date('$fecha_ff1','%d-%m-%Y') order by clientes.zona+0,poligono ASC"; 
 $resultado = mysql_query($sentencia66);
 return $resultado;
}
 exit;
}



function dat_obtener_clientes_avisoscfsegundo($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,zona,
 otraref,valorplan,ttplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal 
 from clientes 
 where fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=3 and parametroprint=1 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 return $resultado;
 exit;
}

function dat_obtener_clientes_avisoscfsegundo_excel($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,fechaul as ultimopago,parametroabo as abonos,parametromon as pagomensual,parametroapa as totaldeuda,parametrompendi as meses,
 telefono,celu,ulfepago1 as ya_pago_desde,ulfepago2 as hasta,zona as sector,poligono as caja,parametrodire as direccion,calle as referencia 
 from clientes 
 where fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=3 and parametroprint=1 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 return $resultado;
 exit;
}


function dat_obtener_clientes_avisosresegundo($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,dui,nit,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,ttplan,dias_reconexion,telefono,celu,valorplan,fechap1,fechap2,fechaip,telefono,ulfepago1,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,zona,sucursal 
 from clientes 
 where estatus=1 and sucursal=$bod and ttfactura=3 and parametroprint=1 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
 return $resultado;
 exit;
}

function dat_obtener_clientes_avisosresegundoexcel($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente as Codigo,nombre,apellido,zona as Sector,poligono as CajaDistribucion,parametroabo as Abonos,dias_reconexion as dias_de_reconexion,pago_por_dias as pago_dias_reconexion,parametromon as PagoMensual,parametrompendi as MesesSinPago,fechap1 as ServicioDesde,pagoservicio as Pago_por_Servicio,recargo as Recargo,parametroapa as TotalPago, parametromes1 as Descuento, parametromes2 as PagoEsteDia,
 telefono as Telefono,celu as Celular,parametrodire as Direccion,calle as Referencia 
 from clientes 
 where estatus=1 and sucursal=$bod and ttfactura=3 and parametroprint=1 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_clientes_connodoexcel($sector,$mes,$bod)
{
 global $parametros , $conexion ;
 $sentencia4 = "update clientes set tipoproducto=substr(fedesco,6,2) where sucursal=$bod";  
 $resultado4 = mysql_query($sentencia4);

if(intval($mes)<1 or intval($mes)>12)
{
 $mes="";
}
if($sector!="" and $mes!="")
 {
 $sentencia="select cod_cliente as codigo,nombre,apellido,fechaul as ultimopago,fedesco as fechadesconexion, zona as sector, poligono as caja, observa as observaciones, celu as telefono, otraref as Direccion from clientes where zona=$sector and tipoproducto=$mes and sucursal=$bod and estatus!=1 and bande1=0 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }

if($sector!="" and $mes=="")
 {
 $sentencia="select cod_cliente as codigo,nombre,apellido,fechaul as ultimopago,fedesco as fechadesconexion, zona as sector, poligono as caja, observa as observaciones, celu as telefono, otraref as Direccion from clientes where zona=$sector and sucursal=$bod and estatus!=1 and bande1=0 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }

if($sector=="" and $mes!="")
 {
 $sentencia="select cod_cliente as codigo,nombre,apellido,fechaul as ultimopago,fedesco as fechadesconexion, zona as sector, poligono as caja, observa as observaciones, celu as telefono, otraref as Direccion from clientes where tipoproducto=$mes and sucursal=$bod and estatus!=1 and bande1=0 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }

if($sector=="" and $mes=="")
 {
 $sentencia="select cod_cliente as codigo,nombre,apellido,fechaul as ultimopago,fedesco as fechadesconexion, zona as sector, poligono as caja, observa as observaciones, celu as telefono, otraref as Direccion from clientes where sucursal=$bod and estatus!=1 and bande1=0 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }

 return $resultado;
 exit;
}


function dat_obtener_clientes_avisoscr_poma($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 if($cod!=""){
 $sentencia="select cod_cliente,nombre,apellido,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,valorplan,fechap1,fechap2,fechaip,ulfepago1,telefono,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal,vivienda from clientes where cod_vende=$cod and fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=2 order by apellido";
 $resultado = mysql_query($sentencia);
 }
  else
 {
 $sentencia="select cod_cliente,nombre,apellido,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,valorplan,fechap1,fechap2,fechaip,ulfepago1,telefono,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal,vivienda from clientes where fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=2 order by apellido";
 $resultado = mysql_query($sentencia);
 }
 return $resultado;
 exit;
}

function dat_obtener_clientes_avisoscr($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,valorplan,fechap1,fechap2,fechaip,ulfepago1,telefono,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal from clientes where cod_vende=$cod and fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=2 order by apellido";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_clientes_avisoscrsegundo($fecha_ini,$fecha_fin,$cod,$bod)
{
 global $parametros , $conexion ;
 $sentencia="select cod_cliente,nombre,apellido,dui,fechaul,parametrodire,ordenvisi,parametroabo,parametromon,parametroapa,parametrompendi,parametroprint,otraref,fechap,
 otraref,valorplan,fechap1,fechap2,fechaip,ulfepago1,telefono,ulfepago2,cod_depto,cod_ciudad,cod_canton,cod_caserio,cod_barrio,poligono,pasaje,calle,casa,blocke,ave,sucursal 
 from clientes where cod_vende=$cod and fechap>=$fecha_ini and fechap<=$fecha_fin and estatus=1 and sucursal=$bod and ttfactura=2 and parametroprint=1 order by apellido";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_activ_ordent($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;

$fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
$fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
$fecha_cero="01-01-1900";

//(fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y'))  or (fecharepro>=str_to_date('$fecha_ini','%d-%m-%Y') and fecharepro<=str_to_date('$fecha_fin','%d-%m-%Y')) and
 $sentencia="select cod_cliente,sucursal,nomclie,nomservi,tarea,fecha,fecharepro,fechareali from activi where (((fecha>=str_to_date('$fecha_ini','%d-%m-%Y')) and (fecha<=str_to_date('$fecha_fin','%d-%m-%Y')) and (fecharepro<str_to_date('$fecha_cero','%d-%m-%Y'))) or ((fecharepro>=str_to_date('$fecha_ini','%d-%m-%Y')) and (fecharepro<=str_to_date('$fecha_fin','%d-%m-%Y'))))  and sucursal=$bod";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_obtener_ventas_iva($fecha_ini,$fecha_fin,$bod)
{
 global $parametros , $conexion ;
 $fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
 $fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $sentencia="select * from facturas where fechafac>=str_to_date('$fecha_ini','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod  order by fechafac";
 $resultado = mysql_query($sentencia);
 return $resultado;
 exit;
}

function dat_actualizagastos()
{
 global $parametros , $conexion ;
 //rastrear todo los gastos
 $sentencia = "select fechaip,sucursal,cod_cliente from clientes where sucursal=2";
 $resultado1 = mysql_query($sentencia);
 if( mysql_num_rows($resultado1)!=0)
  {
   while ( $filaabc = mysql_fetch_array($resultado1))
   {
     $xcodigo=$filaabc['cod_cliente'];
     $xsucu=$filaabc['sucursal'];
     

     $sentencia2="select fechaip from uso where codigo='".$xcodigo."'"; 
     $resultado2 = mysql_query($sentencia2);
     if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
	 $xfecha=$filaabc2['fechaip'];
         $sentencia4 = "update clientes set fechaip='".$xfecha."' where sucursal='".$xsucu."' and cod_cliente='".$xcodigo."'";  
	 $resultado4 = mysql_query($sentencia4);
	}
      }
    }
  }
 return $resultado1;
 exit;
}


function dat_obtener_activ($fecha_ini,$fecha_fin,$tip,$acti,$bod)
{
 global $parametros , $conexion ;

$fecha_fin=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
$fecha_ini=substr($fecha_ini,0,2)."-".substr($fecha_ini,3,2)."-".substr($fecha_ini,6,4);
$fechac="01/01/2000";
$fechacompa=substr($fechac,0,2)."-".substr($fechac,3,2)."-".substr($fechac,6,4);

if($acti!=0)
{
if($tip==1)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fechasoli>=str_to_date('$fecha_ini','%d-%m-%Y') and fechasoli<=str_to_date('$fecha_fin','%d-%m-%Y') and fecha<=str_to_date('$fechacompa','%d-%m-%Y') and sucursal=$bod and codservi=$acti";
  $resultado = mysql_query($sentencia);
 }
if($tip==2)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y') and fechareali<=str_to_date('$fechacompa','%d-%m-%Y') and sucursal=$bod and codservi=$acti";
  $resultado = mysql_query($sentencia);
 }
if($tip==3)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fechareali>=str_to_date('$fecha_ini','%d-%m-%Y') and fechareali<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and codservi=$acti";
  $resultado = mysql_query($sentencia);
 }
if($tip==4)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fecharepro>=str_to_date('$fecha_ini','%d-%m-%Y') and fecharepro<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod and codservi=$acti";
  $resultado = mysql_query($sentencia);
 }
}

if($acti==0)
{
if($tip==1)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fechasoli>=str_to_date('$fecha_ini','%d-%m-%Y') and fechasoli<=str_to_date('$fecha_fin','%d-%m-%Y') and fecha<=str_to_date('$fechacompa','%d-%m-%Y') and sucursal=$bod";
  $resultado = mysql_query($sentencia);
 }
if($tip==2)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fecha>=str_to_date('$fecha_ini','%d-%m-%Y') and fecha<=str_to_date('$fecha_fin','%d-%m-%Y') and fechareali<=str_to_date('$fechacompa','%d-%m-%Y') and sucursal=$bod ";
  $resultado = mysql_query($sentencia);
 }
if($tip==3)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fechareali>=str_to_date('$fecha_ini','%d-%m-%Y') and fechareali<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod";
  $resultado = mysql_query($sentencia);
 }
if($tip==4)
 {
  $sentencia="select cod_cliente,sucursal,nomemple,nomclie,nomservi,tarea,fecha,fechasoli,fechareali,fecharepro,comentario from activi where fecharepro>=str_to_date('$fecha_ini','%d-%m-%Y') and fecharepro<=str_to_date('$fecha_fin','%d-%m-%Y') and sucursal=$bod";
  $resultado = mysql_query($sentencia);
 }
}

 return $resultado;
 exit;
}


function dat_obtener_clientes_general1($fecha_ini,$fecha_fin,$tipoinfo,$bod)
{
 global $parametros , $conexion ;
 if($tipoinfo==1)
  {
   $xconec="1";
   $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by fechap,fechaip DESC";
   $resultado = mysql_query($sentencia);
  }
 if($tipoinfo==2)
  {
   $xconec="1";
   $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by nombre,telefono DESC";
   $resultado = mysql_query($sentencia);
  }
 if($tipoinfo==3)
  {
   $xconec="1";
   $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by ncan ASC, nbar ASC,ncase ASC,calle ASC";
   $resultado = mysql_query($sentencia);
  }
 if($tipoinfo==4)
  {
   $xconec="1";
   $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by fechaip ASC, nombre ASC";
   $resultado = mysql_query($sentencia);
  }
 if($tipoinfo==5)
  {
   $sentencia="select * from clientes where sucursal=$bod and estatus=0 order by parametromeses ASC, fedesco ASC";
   $resultado = mysql_query($sentencia);
  }
 if($tipoinfo==6)
  {
   $xconec="1";
   $sentencia="select * from clientes where sucursal=$bod and estatus=1 order by ncan ASC, nbar ASC,ncase ASC,calle ASC";
   $resultado = mysql_query($sentencia);
  }
  return $resultado;
  exit;
}


function dat_obtener_listaclientes($sec1,$sec2,$estado,$muni,$pobla,$caja,$barrio)
{
 global $parametros , $conexion ;
 if($sec1!="" and $sec2!="")
  {
   $a1=intval($sec1);
   $a2=intval($sec2);
   if($a1<=$a2)
   {
   $sentencia="select * from clientes where zona>=$a1 and zona<=$a2 and estatus=1 order by clientes.zona+0,poligono ASC";
   $resultado = mysql_query($sentencia);
   }
   else
   {
    $resultado =0;
   }

  }
else
  {
   $sentencia="select * from clientes where cod_depto=$estado and cod_ciudad=$muni and cod_canton=$pobla and estatus=1 order by clientes.zona+0,poligono ASC";
   $resultado = mysql_query($sentencia);
  }
  return $resultado;
  exit;
}

function dat_obtener_listaclientesp($sec1,$sec2)
{
 global $parametros , $conexion ;
 $sentencia="select * from clientes where ttplan='".$sec1."' and sucursal=$sec2 and estatus=1 order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}


function dat_obtener_clientes_general1excel($mcanton,$mzona,$tipoinfo,$tipoinfobase,$bod)
{
 global $parametros , $conexion ;
 $zu="1";
 $zd="2";
 $zt="3";
 $zq="4";
 $zc="5";
 $zs="6";
 $zsi="7";
 $zo="8";
 $zn="9";
 $zdi="10";
 $z1="01";
 $z2="02";
 $z3="03";
 $z4="04";
 $z5="05";
 $z6="06";
 $z7="07";
 $z8="08";
 $z9="09";
 $z10="10";
 
 $sentencia2="update clientes set zona=$z1 where zona='1'";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z2 where zona='".$zd."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z3 where zona='".$zt."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z4 where zona='".$zq."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z5 where zona='".$zc."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z6 where zona='".$zs."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z7 where zona='".$zsi."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z8 where zona='".$zo."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z9 where zona='".$zn."' ";
 $resultado2 = mysql_query($sentencia2);
 $sentencia2="update clientes set zona=$z10 where zona='".$zdi."' ";
 $resultado2 = mysql_query($sentencia2);
 $estatus=1;
 if($tipoinfobase==1)
 {
 $sentencia="select cod_cliente as Codigo, nombre as Nombre, apellido as Apellido, case clientes.estatus when '1' then 'Conectado' when '0' then 'Desconectado' end Estado,zona as Sector, poligono as CajaDistribucion, celu as TelMovil, ncan as Poblacion, nbar as Barrio, otraref as Direccion, calle as Referencia,valorplan as PagoMensual, ulmespago as MesPagado, ulfepago1 as Desde, ulfepago2 as Hasta,fechaul as UltimaFactura from clientes where estatus=$estatus order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }
 if($tipoinfobase==2)
 {
 $sentencia="select cod_cliente as Codigo, nombre as Nombre, apellido as Apellido, case clientes.estatus when '1' then 'Conectado' when '0' then 'Desconectado' end Estado,zona as Sector, poligono as CajaDistribucion, celu as TelMovil, ncan as Poblacion, nbar as Barrio, otraref as Direccion, calle as Referencia,valorplan as PagoMensual, ulmespago as MesPagado, ulfepago1 as Desde, ulfepago2 as Hasta,fechaul as UltimaFactura from clientes where sucursal=$bod and estatus=$tipoinfo and zona=$mzona and cod_canton=$mcanton order by clientes.zona+0,poligono ASC";
 $resultado = mysql_query($sentencia);
 }
 if($tipoinfobase==3)
 {
 $sentencia="select cod_cliente as Codigo, nombre as Nombre, apellido as Apellido, celu as TelMovil, telefono from clientes where estatus=$estatus";
 $resultado = mysql_query($sentencia);
 }

 return $resultado;
 exit;
}



function dat_obtener_cierre($fecha_fin,$lista,$bod)
{
 global $parametros , $conexion ;

 $fecha_in1="01"."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);
 $fecha_fi1=substr($fecha_fin,0,2)."-".substr($fecha_fin,3,2)."-".substr($fecha_fin,6,4);

 if($lista==1)
  {
    $sentencia2="SELECT COUNT(*) as stotal from clientes where fechaip>=str_to_date('$fecha_in1','%d-%m-%Y') and fechaip<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus=1"; 
    $resultado2 = mysql_query($sentencia2);
    if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
         $resultado =$filaabc2['stotal'];
	}
       }
  }
 if($lista==2)
  {
    $sentencia2="SELECT COUNT(*) as stotal from clientes where fedesco>=str_to_date('$fecha_in1','%d-%m-%Y') and fedesco<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and estatus=0"; 
    $resultado2 = mysql_query($sentencia2);
    if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
         $resultado =$filaabc2['stotal'];
	}
       }
  }
 if($lista==3)
  {
    $sentencia2="SELECT sum(total) as stotal from facturas where fechafac=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=3 and anulada=0"; 
    $resultado2 = mysql_query($sentencia2);
    if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
         $resultado =$filaabc2['stotal'];
	}
       }
  }

 if($lista==4)
  {
    $sentencia2="SELECT sum(total) as stotal from facturas where fechafac=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=2 and anulada=0"; 
    $resultado2 = mysql_query($sentencia2);
    if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
         $resultado =$filaabc2['stotal'];
	}
       }
  }

 if($lista==5)
  {
    $cadena="";
    $sentencia2="SELECT numero from facturas where fechafac=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=3"; 
    $resultado2 = mysql_query($sentencia2);
	 if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena=$cadena.$filaabc['numero'].",";
	    }
	  }
    $resultado=$cadena;
  }
 if($lista==6)
  {
    $cadena="";
    $sentencia2="SELECT numero from facturas where fechafac>=str_to_date('$fecha_in1','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=1"; 
    $resultado2 = mysql_query($sentencia2);
	 if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena=$cadena.$filaabc['numero'].",";
	    }
	  }
    $resultado=$cadena;
  }
 if($lista==7)
  {
    $cadena="";
    $sentencia2="SELECT numero from facturas where fechafac=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=2"; 
    $resultado2 = mysql_query($sentencia2);
	 if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena=$cadena.$filaabc['numero'].",";
	    }
	  }
    $resultado=$cadena;
  }

 if($lista==8)
  {
    $cadena="";
    $sentencia2="SELECT numero from facturas where fechafac>=str_to_date('$fecha_in1','%d-%m-%Y') and fechafac<=str_to_date('$fecha_fi1','%d-%m-%Y') and sucursal=$bod and tipofac=2"; 
    $resultado2 = mysql_query($sentencia2);
	 if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena=$cadena.$filaabc['numero'].",";
	    }
	  }
    $resultado=$cadena;
  }

 if($lista==9)
  {
    $cadena="";
    $sentencia2="SELECT monto from devoclie where fecha=str_to_date('$fecha_in1','%d-%m-%Y') and sucursal=$bod"; 
    $resultado2 = mysql_query($sentencia2);
    if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena+=$filaabc['monto'];
	    }
	  }
    $resultado=$cadena;
  }

 if($lista==10)
  {
    $cadena="";
    $sentencia2="SELECT monto from reintegro where fecha=str_to_date('$fecha_in1','%d-%m-%Y') and sucursal=$bod"; 
    $resultado2 = mysql_query($sentencia2);
    if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena+=$filaabc['monto'];
	    }
	  }
    $resultado=$cadena;
  }

 if($lista==11)
  {
    $cadena="";
    $sentencia2="SELECT monto from remesabanco where fecha=str_to_date('$fecha_in1','%d-%m-%Y') and sucursal=$bod"; 
    $resultado2 = mysql_query($sentencia2);
    if( mysql_num_rows($resultado2)!=0)
	  {
	   while ( $filaabc = mysql_fetch_array($resultado2))
   	    {
	     $cadena+=$filaabc['monto'];
	    }
	  }
    $resultado=$cadena;
  }


 return $resultado;
 exit;
}

function dat_obtener_cierre_dos($fecha_fin,$lista,$bod,$cod_usuario)
{
 global $parametros , $conexion ;
 if($lista==12)
  {
    $sentencia2="SELECT sum(total) as stotal from facturas where idusuarios='".$cod_usuario."' and fechafac='".$fecha_fin."' and caja='".$bod."' and tipofac=3 and anulada=0"; 
    $resultado2 = mysql_query($sentencia2);
    if(isset($resultado2))
      {
       if(mysql_num_rows ( $resultado2 )!=0)
        {
         $filaabc2 = mysql_fetch_array($resultado2);
         $resultado =$filaabc2['stotal'];
	}
       }
  }
 return $resultado;
 exit;
}


function dat_actualiza_direcciones()
{
 global $parametros , $conexion ;
			 $sentencia = "select * from clientes";  
			 $resultado2 = mysql_query($sentencia);
			 if(mysql_num_rows ( $resultado2 )!=0)
			   {
			    $filaz=mysql_fetch_array($resultado2);
				    //$ncliente=$filaz['nombre']." ".$filaz['apellido'];
                                    $cliente=$filaz['cod_cliente'];
				    $cod_bodega=$filaz['sucursal'];
				    $xdepto=$filaz['cod_depto'];
				    $xmuni=$filaz['cod_ciudad'];
				    $xcanton=$filaz['cod_canton'];
				    $xbarrio=$filaz['cod_barrio'];
			     	    $xcaserio=$filaz['cod_caserio'];
				    $xpasaje=$filaz['pasaje'];
				    $xpoligono=$filaz['poligono'];
		      		    $xcasa=$filaz['casa'];
		                    $xblocke=$filaz['blocke'];
		                    $xcalle=$filaz['calle'];
		                    $xave=$filaz['ave'];
		                    $otraref=$filaz['otraref'];
		                    $xtelefono=$filaz['telefono'];
	
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
			
        	                $cerouno=1;
				$xdireccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa."-".$otraref;
		        $sentencia="update clientes set ndep='".$xndepto."',nmuni='".$xnmuni."',ncan='".$xncanton."',nbar='".$xnbarrio."',ncase='".$xncaserio."' where cod_cliente='".$cliente."' and sucursal='".$cod_bodega."'";
                        $resultado2 = mysql_query($sentencia);

                          

			  }

 return $resultado2;
 exit;
}




?>