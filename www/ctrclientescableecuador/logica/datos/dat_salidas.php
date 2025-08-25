<?php
require "dat_base.php";  

function dat_validar_salida($id)
{
    global $parametros , $conexion ;
    //obtine un bodega
    $sentencia = "select * from salidas where codigo_salida='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
    exit;
}

function dat_validar_docu_provee($proveedor,$crf,$bodega)
{
    //validar que existe la compra si se ha ingresado una devolucion a proveedor
        $hay="";
        $hay2="";
        $rr=0;
	$sentencia="select codigo_prv,n_reg_fiscal from entradas where codigo_prv=".$proveedor." and n_reg_fiscal=".$crf." and sucursal=".$bodega.";";
	$resultado=mysql_query($sentencia);
	 if(isset($resultado))
	  {
	  if(mysql_num_rows ( $resultado )!=0)
	   {
	    $row=mysql_fetch_array($resultado);
	    $hay=$row['n_reg_fiscal'];
	    $hay2=$row['codigo_prv'];
	   }
	  }
        if($hay!="" and $hay2!="")
	   {
	    $rr=1;
	   }

        return $rr;
        exit;
}

function dat_insertar_salida($datos)
{
global $parametros , $conexion ;
    //inserta un registro en la tabla de articulos
    $codigo=$datos['0'];
    $tipo=$datos['1'];
    $usuario=$datos['2'];
    $bodega=$datos['3']==""?"null":"'".$datos['3']."'";
    $bodega_des=$datos['4']==""?"null":"'".$datos['4']."'";
    $cod_vale=$datos['5']==""?"null":"'".$datos['5']."'";
    $cod_devo=$datos['6']==""?"null":"'".$datos['6']."'";
    $cod_prove=$datos['7']==""?"null":"'".$datos['7']."'";
    $cod_crf=$datos['8']==""?"null":"'".$datos['8']."'";
    $cod_tecnico=$datos['9']==""?"null":"'".$datos['9']."'";
    $cod_remi=$datos['10']==""?"null":"'".$datos['10']."'";
    $cod_moti=$datos['11']==""?"null":"'".$datos['11']."'";
    $autoriza=$datos['12']==""?"null":"'".$datos['12']."'";
    $obser=$datos['13'];
    $fecha1=$datos['14'];
    $fecompra=$datos['15'];


    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $fechacom=substr($fecompra,6,4)."-".substr($fecompra,3,2)."-".substr($fecompra,0,2);

 $estado="1";
 $xnvende="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple=".$autoriza.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnvende=$row['nombre'];
  }
 }

 $xntecni="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple=".$cod_tecnico.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntecni=$row['nombre'];
  }
 }


 $xnprovee="";
 $sentencia = "select nombre FROM proveedores where codigo_prv=".$cod_prove.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnprovee=$row['nombre'];
  }
 }


if($tipo=="1")       
 {
    $sentencia = "insert into salidas (codigo_salida,tipo,fecha,idusuarios,sucursal,codigo_bodega_destino,observaciones,cod_crf,cod_respon,nombrerespon,fechareg,cod_tecnico,estado) 
                    VALUES ('".$codigo."','".$tipo."','".$fecha."','".$usuario."',".$bodega.",".$bodega_des.",'".$obser."',".$cod_crf.",".$autoriza.",'".$xnvende."',now(),".$cod_tecnico.",".$estado.")"; 
    $resultado = mysql_query($sentencia);

    //Actualizando el correlativo de transferencias
    $sentenciaac="update correla set numerovale=".$cod_crf." where codigovale=".$bodega.";";
    $resultadoac = mysql_query($sentenciaac);

    return $resultado;
    exit;
 }
if($tipo=="2")       
 {
    $sentencia = "insert into salidas (codigo_salida,tipo,notade,fecha,idusuarios,sucursal,codigo_prv,observaciones,cod_crf,cod_respon,nombrerespon,fechareg,nombreprovee,idmotivo,fecompra) 
                    VALUES ('".$codigo."','".$tipo."',".$cod_devo.",'".$fecha."','".$usuario."',".$bodega.",".$cod_prove.",'".$obser."',".$cod_crf.",".$autoriza.",'".$xnvende."',now(),'".$xnprovee."',".$cod_moti.",'".$fechacom."')"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
 }

if($tipo=="3" or $tipo=="4")       
 {
    $sentencia = "insert into salidas (codigo_salida,tipo,vale,fecha,idusuarios,sucursal,cod_tecnico,observaciones,cod_respon,nombrerespon,fechareg,nombretecnico) 
                    VALUES ('".$codigo."','".$tipo."',".$cod_vale.",'".$fecha."','".$usuario."',".$bodega.",".$cod_tecnico.",'".$obser."',".$autoriza.",'".$xnvende."',now(),'".$xntecni."')"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
 }

//Actualizando el correlativo de salidas
    $sentencia="select cast(codigo_salida as decimal)+1 id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];

        $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
        $resultado2 = mysql_query($sentencia2);
    }



}


function dat_eliminar_salida($id)
{
global $parametros , $conexion ;
    //Elimina un registro de la tabla de articulos
    $sentencia = "delete from  salidas where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}



function dat_obtener_salidas_detalle($comienzo, $cant,$codigo)
{
    global $parametros , $conexion ;
    $sentencia = "select a.codigo_detalle Item, b.descripcion Articulo, case a.estado_art when 1 then 'Nuevo' 
		          when 2 then 'Usado' end Estado, a.cantidad Cantidad, a.unidadmed 'Unidad de Medida',cod_cliente 'Cliente',ticket 'Ticket'
                    FROM  salidas_deta a left join articulos b ON a.idarticulos = b.idarticulos
                    where a.codigo_salida='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;

}


function dat_obtener_detalle_salida_nuevo2($cod_encabezado,$cod_detalle,$bodega)
{
    global $parametros , $conexion ;
    $sentencia = "select a.codigo_salida, a.codigo_detalle, a.idarticulos Idarticulo, b.descripcion Producto, case a.estado_art when 1 then 'Nuevo' 
		          when 2 then 'Usado' end Estado1, a.cantidad Cantidad, a.estado_art Estadoa from salidas_deta a left join articulos b ON a.idarticulos = b.idarticulos  
                    where a.codigo_salida='".$cod_encabezado."'and a.codigo_detalle='".$cod_detalle."' and a.idbodegas='".$bodega."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_num_salidas_detalle($codigo)
{
    global $parametros , $conexion ;
    //obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from salidas_deta where codigo_salida='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
    exit;
}

function dat_insertar_salida_detalle($datos,$Encabezado)
{
    global $parametros , $conexion ;
    //inserta un registro en la tabla de salidas_detalle

    $codigo_salida=$Encabezado['0'];
    $tipo=$Encabezado['1'];
    $bodega=$Encabezado['3'];
    $xcliente=$datos['Cliente'];
    $fecha1=$Encabezado['14'];
    $porcen=$Encabezado['15'];
    $xticket=$datos['Ticket'];
    $producto=$datos['Producto'];
    $cant=$datos['Cantidad'];
    $estadoarti=$datos['Estado'];
   
    $cant2=$datos['Cantidad'];
    $vcant=$cant;
    $existencia=null;
    $cantvar=$cant;

    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
    $cod_entrada="";
    $cod_detalle="";

       $sentencia="select unidadmed from  articulos where idarticulos='".$producto."'";
       $resultado2 = mysql_query($sentencia);
       $xunimed=null;
       if(isset($resultado2))
        {
         if(mysql_num_rows($resultado2)!=0)
         {
          $fila1=mysql_fetch_array($resultado2);
          $xunimed=$fila1['unidadmed'];
         }
        }


    //busca la cantidad de articulos que hay en existencias
    $sentencia="select cantidad from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$datos['Producto']."'";
    $resultado = mysql_query($sentencia);
    if(isset($resultado))
    {
        $fila=mysql_fetch_array($resultado);
        $existencia_anterior=$fila['cantidad'];
    }
    else
    {
        $existencia_anterior=0;
    }


    //Buscando el correlativo ultimo del detalle    
    $sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_salida
                FROM salidas_deta where codigo_salida='".$codigo_salida."'";
    $cod_tab=mysql_query($sentencia);
    $cod_salida_deta=mysql_fetch_array($cod_tab);

    if($tipo=="1" or $tipo=="2")
    {
     //Guardando el registro de detalle
     $sentencia="insert into salidas_deta (codigo_salida,codigo_detalle,idarticulos,cantidad,idbodegas,fecha,unidadmed,estado_art) VALUES ('".$codigo_salida."','".$cod_salida_deta['cod_salida']."','".$producto."','".$cant."','".$bodega."','".$fecha."','".$xunimed."','".$estadoarti."')";
     mysql_query($sentencia);
    }
    if($tipo=="3")
    {
     //Guardando el registro de detalle
     $sentencia="insert into salidas_deta (codigo_salida,codigo_detalle,idarticulos,cantidad,idbodegas,fecha,unidadmed,cod_cliente,ticket,estado_art) VALUES ('".$codigo_salida."','".$cod_salida_deta['cod_salida']."','".$producto."','".$cant."','".$bodega."','".$fecha."','".$xunimed."','".$xcliente."','".$xticket."','".$estadoarti."')";
     mysql_query($sentencia);
    }
    if($tipo=="4")
    {
     //Guardando el registro de detalle
     $sentencia="insert into salidas_deta (codigo_salida,codigo_detalle,idarticulos,cantidad,idbodegas,fecha,unidadmed,ticket,estado_art) VALUES ('".$codigo_salida."','".$cod_salida_deta['cod_salida']."','".$producto."','".$cant."','".$bodega."','".$fecha."','".$xunimed."','".$xticket."','".$estadoarti."')";
     mysql_query($sentencia);
    }
     
    //Actualizando los movimientos de salidas
    $fecha=date('Y/m/d');
    $sentencia="select fecha from salidas where sucursal='".$bodega."' and codigo_salida='".$codigo_salida."';";
    $resultado = mysql_query($sentencia);
    if(isset($resultado))
     {
      if(mysql_num_rows ( $resultado )!=0)
       {
         $filam=mysql_fetch_array($resultado);
         $fecha=$filam['fecha'];
       }        
     } 
     $sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
     $resultado = mysql_query($sentencia);
     if(isset($resultado))
      {
       if(mysql_num_rows ( $resultado )!=0)
      {
       $fila=mysql_fetch_array($resultado);
       $nueva_cant=$fila['salidas']+$cant2;
       $sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
       $retorno=mysql_query($sentencia);       
      }
      else
      {
       $sentencia="select tipo_art,descripcion from  articulos where idarticulos='".$producto."'";
       $resultado2 = mysql_query($sentencia);
       $xxtipo=null;
       $xxnom=null;
       if(isset($resultado2))
        {
         if(mysql_num_rows($resultado2)!=0)
         {
          $fila1=mysql_fetch_array($resultado2);
          $xxtipo=$fila1['tipo_art'];
          $xxnom=$fila1['descripcion'];
         }
        }
        $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bodega."',0,'".$cant2."',$xxtipo,'".$fecha."')";
        $retorno6=mysql_query($sentencia);
       }
      }
      else
      {
       $sentencia="select tipo_art,descripcion from  articulos where idarticulos='".$producto."'";
       $resultado3 = mysql_query($sentencia);
       $xxtipo=null;
       $xxnom=null;
       if(isset($resultado3))
        {
        if(mysql_num_rows($resultado3)!=0)
         {
          $fila1=mysql_fetch_array($resultado3);
          $xxtipo=$fila1['tipo_art'];
          $xxnom=$fila1['descripcion'];
         }
        }
        $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bodega."',0,'".$cant2."',$xxtipo,'".$fecha."');";
        $retorno6=mysql_query($sentencia);
       }

if($estadoarti=="1")
{
     //Actualizando el inventario general   
     $sentencia="update existenciaprod set cantidad=cantidad-".$datos['Cantidad']." where idbodegas='".$bodega."' and idarticulos='".$producto."';";
     $resultado=mysql_query($sentencia);
}
if($estadoarti=="2")
{
     //Actualizando el inventario general   
     $sentencia="update existenciaprod set cantidadusa=cantidadusa-".$datos['Cantidad']." where idbodegas='".$bodega."' and idarticulos='".$producto."';";
     $resultado=mysql_query($sentencia);
}
     $error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
     return $error;
     exit;
}

function dat_ve_estatus_salida($cod_encabezado)
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

function dat_eliminar_salida_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$registro,$param)
{
 global $parametros , $conexion ;
 $tipo=$param['1']; 
 $zzcantidad=$registro['Cantidad'];
 $idarticulo=$registro['Idarticulo'];
 $estadoarti=$registro['Estadoa'];

 //actualiza un registro en la tabla de salidas_detalle y su respectiva existencia
 $sentencia = "delete from salidas_deta where codigo_salida='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' and idbodegas='".$bodega."';";
 $resultado = mysql_query($sentencia);
 if ($resultado==1)
  {
   //primero actualizo la tabla de movimientos
   $fecha=date('Y/m/d');
   $sentencia="select fecha from salidas where sucursal='".$bodega."' and codigo_salida='".$cod_encabezado."';";
   $resultado1 = mysql_query($sentencia);
   if(isset($resultado1))
     {
      if(mysql_num_rows ( $resultado1 )!=0)
      {
       $filam=mysql_fetch_array($resultado1);
       $fecha=$filam['fecha'];
      } 

      //Restando la cantidad original
      $sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$idarticulo."'  and fecha='".$fecha."';";
      $resultado2 = mysql_query($sentencia);
      if(isset($resultado2))
       {
        if(mysql_num_rows ( $resultado2 )!=0)
         {
          $fila=mysql_fetch_array($resultado2);
          $nueva_cant=$fila['salidas']-$zzcantidad;
          $sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$idarticulo."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
          $retorno=mysql_query($sentencia);      
         }
       }
     } 


if($estadoarti=="1")
   {
     //Actualizo existencias
     $nuevaexistencia=0;
     $sentenciaq="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$idarticulo."'";
     $resultadoq=mysql_query($sentenciaq);
     if(isset($resultadoq))
      {
	if(mysql_num_rows ( $resultadoq )!=0)
         {
	   $fila=mysql_fetch_array($resultadoq);
	   $nuevaexistencia=$fila['cantidad']+$zzcantidad;
         }
       }

     $sentencia3="update existenciaprod  set cantidad='".$nuevaexistencia."' where idbodegas='".$bodega."' and idarticulos='".$idarticulo."'";
     $resultado3 = mysql_query($sentencia3);
  }

if($estadoarti=="2")
   {
     //Actualizo existencias
     $nuevaexistencia=0;
     $sentenciaq="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$idarticulo."'";
     $resultadoq=mysql_query($sentenciaq);
     if(isset($resultadoq))
      {
	if(mysql_num_rows ( $resultadoq )!=0)
         {
	   $fila=mysql_fetch_array($resultadoq);
	   $nuevaexistencia=$fila['cantidadusa']+$zzcantidad;
         }
       }

     $sentencia3="update existenciaprod  set cantidadusa='".$nuevaexistencia."' where idbodegas='".$bodega."' and idarticulos='".$idarticulo."'";
     $resultado3 = mysql_query($sentencia3);
  }

  //Verificando si ya no queda detalle en este movimiento de salida
 // $haycabeza=1;
 // $sentenciaa = "select codigo_salida from salidas_deta where codigo_salida='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' and idbodegas='".$bodega."';";
 // $resultadoo = mysql_query($sentenciaa);
 // if(mysql_num_rows($resultadoo)==0)    
  // {
  //  $haycabeza=0;
  //  $sentenciab = "delete from salidas where codigo_salida='".$cod_encabezado."' and sucursal='".$bodega."';";
  //  $resultadob = mysql_query($sentenciab);
 //  }
 }
 return $resultado;
 exit;
}

function dat_obtener_precio_prod($prod,$bodega)
{
global $parametros , $conexion ;
    
    $sentencia="select a.precio_unit,min(fecha) from entradas_deta a, entradas b
                where a.codigo_entrada = b.codigo_entrada and a.existencia>0 
                and a.idarticulo='".$prod."' and b.codigo_bodega_ingresa='".$bodega."'";
    $resultado = mysql_query($sentencia);
    $precio=null;
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $precio=$fila['precio_unit'];
    }
    return $precio;
    exit;
}

function dat_validar_existencia($bodega,$producto,$cant)
{
global $parametros , $conexion ;
    $sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
    $resultado = mysql_query($sentencia);
    $existencia=null;
    if(mysql_num_rows ( $resultado )!=0)
     {
        $fila=mysql_fetch_array($resultado);
        $existencia=$fila['cantidad'];

     }

    if ($existencia>=$cant)
    {
        return 1;
    }
    else
    {
        return -1;
    }
    exit;
}


function dat_validar_precio($producto)
{
global $parametros , $conexion ;
    $precio=0;
    $sentencia="select precio from  articulos where idarticulos='".$producto."'";
    $resultado2 = mysql_query($sentencia);
    $xxtipo=null;
    $xxnom=null;
    if(isset($resultado2))
     {
      if(mysql_num_rows($resultado2)!=0)
      {
       $fila1=mysql_fetch_array($resultado2);
       $precio=$fila1['precio'];
      }
     }

    if ($precio>0)
    {
        return 1;
    }
    else
    {
        return -1;
    }
    exit;
}


function dat_obtener_cod_salida3()
{
global $parametros , $conexion ;

    $sentencia="select cast(codigo_salida as decimal)+1 id FROM correla_salidas";
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

function dat_obtener_cod_salida()
{
global $parametros , $conexion ;

    $sentencia="select cast(codigo_salida as decimal)+1 id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];

            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    else
    {
        $retorno=1;
            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    
    return $retorno;
    exit;
}



function dat_obtener_cod_salida2()
{
global $parametros , $conexion ;
    
    $sentencia="select case IFNULL(max(cast(codigo_salida as decimal)),0) when '0' then 1 else max(cast(codigo_salida as decimal))+1 end id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];

            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    else
    {
        $retorno=1;
            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    
    return $retorno;
    exit;
}


function dat_obtener_cod_vale3($bodega)
{
global $parametros , $conexion ;

    $sentencia1="select idbodegas FROM bodegas where idbodegas='".$bodega."'";
    $resultado1 = mysql_query($sentencia1);
    if(mysql_num_rows ( $resultado1 )!=0)
    {
        $filaxy=mysql_fetch_array($resultado1);
        $a=$filaxy['idbodegas'];

    }
    else
    {
        $a="";
                $retorno="";
    }

  if($a!="")
   {
    $sentencia="select numerovale FROM correla where codigovale='".$a."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $b=$fila['numerovale'];
        $c=$b+1;
        $retorno="$c";
    }
    else
    {
        $s="insert into correla (codigovale, numerovale) values('".$a."',0)";
                $r=mysql_query($s);
                $retorno="1";
    }
    
   }
    return $retorno;
    exit;
}


function dat_obtener_cod_vale($bodega)
{
global $parametros , $conexion ;

    $sentencia1="select idbodegas FROM bodegas where idbodegas='".$bodega."'";
    $resultado1 = mysql_query($sentencia1);
    if(mysql_num_rows ( $resultado1 )!=0)
    {
        $filaxy=mysql_fetch_array($resultado1);
        $a=$filaxy['idbodegas'];

    }
    else
    {
        $a="";
                $retorno="";
    }

if($a!="")
{
    $sentencia="select numerovale FROM correla where codigovale='".$a."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $b=$fila['numerovale'];
        $c=$b+1;
        $retorno="$c";

        $sentenciaac="update correla set numerovale='".$c."' where codigovale='".$a."'";
        $resultadoac = mysql_query($sentenciaac);

    }
    else
    {
        $s="insert into correla (codigovale, numerovale) values('".$a."',0)";
                $r=mysql_query($s);
                $retorno="1";
    }
    
}
    return $retorno;
    exit;
}


function dat_obtener_salidas($comienzo, $cant,$bodega,$filtro)
{
    global $parametros , $conexion ;

    $sentencia="select a.codigo_salida Movim,case a.tipo when 1 then 'TR' 
                    when 2 then 'DP' when 3 then 'ET' when 4 then 'MR' end Tipo,DATE_FORMAT(a.fecha,'%d/%m/%Y') Fecha,
                    b.nombre 'SucDestino', a.cod_crf 'Transferencia', a.nombretecnico 'Tecnico', a.nombreprovee 'Proveedor',case a.estado when 1 then 'Transito' when 2 then 'Recibido' end Estado
                   from salidas a left join bodegas b ON a.codigo_bodega_destino = b.idbodegas
                   where a.sucursal='".$bodega."'
                   order by a.fecha LIMIT $comienzo, $cant";



    $resultado = mysql_query($sentencia) or die($sentencia.mysql_error());
    return $resultado;
    exit;
}

function dat_obtener_num_salidas($bodega,$filtro)
{
    global $parametros , $conexion ;
    
    $sentencia="select count(*) from salidas where codigo_bodega_salida='".$bodega."'";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_salida($id)
{
    global $parametros , $conexion ;
    
    $sentencia="select codigo_salida Codigo, tipo Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha,
                codigo_bodega_destino Bodega_Destino, vale Vale, cod_crf 'RegFis', cod_respon 'Autoriza',observaciones 'Observaciones',notade 'NOTADE',nombreprovee 'Nproveedor',idmotivo 'MOTIVO',DATE_FORMAT(fecompra,'%d/%m/%Y') 'Fecha2',cod_tecnico 'Tecnico'
                from salidas where codigo_salida='".$id."' order by cast(codigo_salida as decimal);";
        
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_actualizar_salida($datos,$tipo)
{
    global $parametros , $conexion ;

    switch ($tipo)
    {
        case '1':

 $autoriza=$datos['Autoriza'];
 $cod_tecnico=$datos['Tecnico'];
 $bodega=$_SESSION["idBodega"];
 $xusuamov=$_SESSION["idusuarios"];

 $xnemple="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple='".$autoriza."'"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnvende=$row['nombre'];
  }
 }


 $xntecni="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple=".$cod_tecnico.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntecni=$row['nombre'];
  }
 }

            $sentencia = "update salidas set 
                            fechamod=now(),
                            where codigo_salida='".$datos['Codigo']."';";
        break;
        case '2':

 $autoriza=$datos['Autoriza'];
 $cod_tecnico=$datos['Tecnico'];
 $bodega=$_SESSION["idBodega"];
 $xusuamov=$_SESSION["idusuarios"];

 $xnemple="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple='".$autoriza."'"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnvende=$row['nombre'];
  }
 }

            $sentencia = "update salidas set 
                            observaciones='".$datos['Observaciones']."',
                            cod_respon='".$datos['Autoriza']."',
			    nombrerespon='".$xnvende."',
                            fechamod=now(),
                            usuariomod='".$xusuamov."',
                            idmotivo='".$datos['MOTIVO']."'
                            where codigo_salida='".$datos['Codigo']."';";
        break;

        case '3':

 $autoriza=$datos['Autoriza'];
 $cod_tecnico=$datos['Tecnico'];
 $bodega=$_SESSION["idBodega"];
 $xusuamov=$_SESSION["idusuarios"];

 $xnemple="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple='".$autoriza."'"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnvende=$row['nombre'];
  }
 }


 $xntecni="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple=".$cod_tecnico.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntecni=$row['nombre'];
  }
 }


            $sentencia = "update salidas set 
                            observaciones='".$datos['Observaciones']."',
                            cod_respon='".$datos['Autoriza']."',
			    nombrerespon='".$xnvende."',
                            cod_tecnico='".$datos['Tecnico']."',
			    nombretecnico='".$xntecni."',
                            fechamod=now(),
                            usuariomod='".$xusuamov."'
                            where codigo_salida='".$datos['Codigo']."';";
        break;

        case '4':

 $autoriza=$datos['Autoriza'];
 $cod_tecnico=$datos['Tecnico'];
 $bodega=$_SESSION["idBodega"];
 $xusuamov=$_SESSION["idusuarios"];

 $xnemple="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple='".$autoriza."'"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnvende=$row['nombre'];
  }
 }


 $xntecni="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega." and cod_emple=".$cod_tecnico.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntecni=$row['nombre'];
  }
 }


            $sentencia = "update salidas set 
                            observaciones='".$datos['Observaciones']."',
                            cod_respon='".$datos['Autoriza']."',
			    nombrerespon='".$xnvende."',
                            cod_tecnico='".$datos['Tecnico']."',
			    nombretecnico='".$xntecni."',
                            fechamod=now(),
                            usuariomod='".$xusuamov."'
                            where codigo_salida='".$datos['Codigo']."';";
        break;

        default:
            $sentencia = "";
        break;
    }
                    
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}



function dat_obtener_num_salidas_fvale($bodega,$filtro1)
{
    global $parametros , $conexion ;
    $sentencia="select count(*) from salidas where sucursal='".$bodega."' and (a.cod_crf like '%".$filtro1."%' or a.cod_crf like '%".$filtro1."%')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_salidas_fvale($bodega,$comienzo,$cant,$filtro1)
{
    global $parametros , $conexion ;
    $sentencia="select codigo_salida Movim,case a.tipo when 1 then 'TR' 
                    when 2 then 'DP' when 3 then 'ET' when 4 then 'MR' end Tipo,DATE_FORMAT(a.fecha,'%d/%m/%Y') Fecha,
                    b.nombre 'SucDestino', a.cod_crf 'Transferencia', a.nombretecnico 'Tecnico', a.nombreprovee 'Proveedor',case a.estado when 1 then 'Transito' when 2 then 'Recibido' end Estado

                    from salidas a left join bodegas b ON a.codigo_bodega_destino = b.idbodegas
                    where a.sucursal='".$bodega."' and (a.cod_crf like '%".$filtro1."%' or a.cod_crf like '%".$filtro1."%')";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_num_salidas_filtro($bodega,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    
    $sentencia="select count(*) from salidas where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_salidas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    $sentencia="select codigo_salida Movim,case a.tipo when 1 then 'TR' 
                    when 2 then 'DP' when 3 then 'ET' when 4 then 'MR' end Tipo,DATE_FORMAT(a.fecha,'%d/%m/%Y') Fecha,
                    b.nombre 'SucDestino', a.cod_crf 'Transferencia', a.nombretecnico 'Tecnico', a.nombreprovee 'Proveedor',case a.estado when 1 then 'Transito' when 2 then 'Recibido' end Estado
                    from salidas a left join bodegas b ON a.codigo_bodega_destino = b.idbodegas
                    where a.sucursal='".$bodega."' and a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y')
                    order by a.fecha LIMIT $comienzo, $cant";

    
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_destiace_cmb()
{
    global $parametros , $conexion ;
    //obtine la lista de destinos de aceite para  poblar combobox
    $sentencia = "select codigod Codigo, nombred Nombre from destiace
                    order by nombred";  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_ordenes_cmb($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de ordenes de bodega actual
    $sentencia = "select n_orden_compra Orden, fecha Fecha FROM entradas where codigo_bodega_ingresa='".$bodega."'
				  order by fecha";  
    $resultado = mysql_query($sentencia);
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


?>