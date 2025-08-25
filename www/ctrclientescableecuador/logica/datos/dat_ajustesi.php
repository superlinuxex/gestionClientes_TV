<?php
require "dat_base.php";  

function dat_obtener_ajustesi($comienzo, $cant,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.movimiento 'Mov.', DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, b.descripcion Articulo,b.unidadmed Medida, a.cantidad Cantidad, case a.tipomov when 1 then 'Entrada' when 2 then 'Salida' end Tipo,concepto Concepto
          FROM ajustes a,articulos b where a.sucursal='".$bodega."' and a.idarticulos = b.idarticulos order by a.fecha LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_ajustesi_filtro($bodega,$filtro1,$filtro2)
{
 global $parametros , $conexion ;
    $filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
    $filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);
    $sentencia = "SELECT COUNT(*) FROM ajustes where sucursal='".$bodega."' and (a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y'))";  
    $resultado = mysql_query($sentencia);
    $total_registros = mysql_result($resultado,0,0);
    return $total_registros;
    exit;
}

function dat_obtener_ajustesi_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
  global $parametros , $conexion ;
  $filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
  $filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

  $sentencia = "select a.movimiento 'Mov.', DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, b.descripcion Articulo,b.unidadmed Medida, a.cantidad Cantidad, case a.tipomov when 1 then 'Entrada' when 2 then 'Salida' end Tipo, a.concepto Concepto
  FROM ajustes a,articulos b where a.sucursal='".$bodega."' and (a.idarticulos = b.idarticulos) and (a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y'))
  order by a.fecha LIMIT $comienzo, $cant"; 
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
}

function dat_obtener_ajustesi2($id,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Producto, b.descripcion Descripcion, b.unidadmed Medida, a.tipomov Tipomov, a.cantidad Cantidad, a.fecha Fecha, a.concepto Concepto, a.cod_emple Codigoempl, a.estado_art Estado
          FROM ajustes a, articulos b where a.idarticulos = b.idarticulos and a.sucursal='".$bodega."' and a.movimiento='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_ajustesi($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM ajustes where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_insertar_ajustesi($datos,$bode,$usuario)
{
global $parametros , $conexion ;

//obteniendo un correlativo para el codigo de movimiento
$nummovi=0;
$tipo="4";  //codigo 4 para identificar: "movimiento tipo ajuste"
$tipomov=$datos['Tipomov'];
$producto=$datos['Producto'];
$cantreal=$datos['Cantidad'];
$estado=$datos['Estado'];
$fecha1=$datos['Fecha'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$sentencia="select case IFNULL(max(cast(movimiento as decimal)),0) when '0' then 1 else max(cast(movimiento as decimal))+1 end id FROM ajustes";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id'];
    }
	else
    {
	$nummovi=1;
    }

//buscando la unidad de medida de ingreso de cantidades
        $sentencia="select unidadmedc,unidadmed from  articulos where idarticulos='".$producto."'";
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

//inserta un registro en la tabla de Existencia o lo actualiza en el caso que ya tenga valor
    if($tipomov=="1")  //si esta agregando al inventario, no hay restricciones 
      {
       if($estado=="1") //si es equipo nuevo
        {
        $hayexistencias=1;
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bode."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']+$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bode."';";
			$retorno=mysql_query($sentencia);		
		}
		else
		{
                 $sentencia="select tipo_art,descripcion,unidadmed from  articulos where idarticulos='".$producto."'";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed) VALUES ('".$producto."','".$bode."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
		  $retorno=mysql_query($sentencia);
		}
	  }
	  else
 	  {
                 $sentencia="select tipo_art,descripcion,unidadmed from  articulos where idarticulos='".$producto."'";
	         $resultado3 = mysql_query($sentencia);
                 $xxtipo=null;
                 $xxdesc=null;
		 $xxunidad="";

            	 if(isset($resultado3))
                  {
                   if(mysql_num_rows($resultado3)!=0)
	           {
 	            $fila1=mysql_fetch_array($resultado3);
	            $xxtipo=$fila1['tipo_art'];
		    $xxdesc=$fila1['descripcion'];
		    $xxunidad=$fila1['unidadmed'];
                   }
                  }

		$sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bode."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$xxunidad."');";
		$retorno=mysql_query($sentencia);
	  }
	}
        if($estado=="2") //si es equipo usado
        {
        $hayexistencias=1;
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bode."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']+$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bode."';";
			$retorno=mysql_query($sentencia);		
		}
		else
		{
                 $sentencia="select tipo_art,descripcion,unidadmed from  articulos where idarticulos='".$producto."'";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed) VALUES ('".$producto."','".$bode."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
		  $retorno=mysql_query($sentencia);
		}
	  }
	  else
	  {
                 $sentencia="select tipo_art,descripcion,unidadmed from  articulos where idarticulos='".$producto."'";
	         $resultado3 = mysql_query($sentencia);
                 $xxtipo=null;
                 $xxdesc=null;
		 $xxunidad="";

            	 if(isset($resultado3))
                  {
                   if(mysql_num_rows($resultado3)!=0)
	           {
 	            $fila1=mysql_fetch_array($resultado3);
	            $xxtipo=$fila1['tipo_art'];
		    $xxdesc=$fila1['descripcion'];
		    $xxunidad=$fila1['unidadmed'];
                   }
                  }

		$sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bode."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$xxunidad."');";
		$retorno=mysql_query($sentencia);
	  }
	}

	//Incrementando las entradas de articulos en tabla de movimientos
	$sentencia="select entradas from  movimientos where idbodegas='".$bode."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']+$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bode."';";
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."','".$cantreal."',0,$xxtipo,'".$fecha."')";
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

		$sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."','".$cantreal."',0,$xxtipo,'".$fecha."');";
		$retorno6=mysql_query($sentencia);
	}
     }

    if($tipomov=="2")  //si esta disminuyendo al inventario
      {
        if($estado=="1")  //SI ES ARTICULO NUEVO
        {
        $hayexistencias=0;
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bode."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
                        $hayexistencias=1;
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']-$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bode."';";
			$retorno=mysql_query($sentencia);		
		}
	}

        if($hayexistencias==1)  //si disminuyo el inventario registro las salidas
        {
	 $sentencia="select salidas from  movimientos where idbodegas='".$bode."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	 $resultado = mysql_query($sentencia);
	 if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']+$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bode."';";
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."',0,'".$cantreal."',$xxtipo,'".$fecha."')";
		  $retorno6=mysql_query($sentencia);
		}
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."',0,'".$cantreal."',$xxtipo,'".$fecha."')";
		  $retorno6=mysql_query($sentencia);
		}

            }
          }
        if($estado=="2")  //SI ES ARTICULO usado
        {
        $hayexistencias=0;
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bode."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
                        $hayexistencias=1;
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']-$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bode."';";
			$retorno=mysql_query($sentencia);		
		}
	}

        if($hayexistencias==1)  //si disminuyo el inventario registro las salidas
        {
	 $sentencia="select salidas from  movimientos where idbodegas='".$bode."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	 $resultado = mysql_query($sentencia);
	 if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']+$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bode."';";
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."',0,'".$cantreal."',$xxtipo,'".$fecha."')";
		  $retorno6=mysql_query($sentencia);
		}
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bode."',0,'".$cantreal."',$xxtipo,'".$fecha."')";
		  $retorno6=mysql_query($sentencia);
		}

            }
          }



          }



//Actualizando la tabla de movimientos de ajuste	
$cod_usuario=$_SESSION["idusuarios"];
if($hayexistencias==1)   //solo si hay existencias que disminuir en caso de ser salidas
 {
  $sentencia = "insert into ajustes (movimiento,fecha,idarticulos,cantidad,cod_emple,concepto,tipomov,sucursal,tipo,unidadmed,fechareg,idusuarios,estado_art) VALUES ('".$nummovi."','".$fecha."','".$datos['Producto']."','".$datos['Cantidad']."','".$datos['Codigoempl']."','".$datos['Concepto']."','".$datos['Tipomov']."','".$bode."','".$tipo."','".$xunidadmed."',now(),'".$cod_usuario."','".$datos['Estado']."')";
  $resultado = mysql_query($sentencia);
  return $resultado;
  exit;
 }
}

function dat_eliminar_ajustesi($id,$bodega,$registro)
{
global $parametros , $conexion ;
$xusuario=$_SESSION["idusuarios"];
$tipomov=$registro['Tipomov'];
$producto=$registro['Producto'];
$cantreal=$registro['Cantidad'];
$fecha=$registro['Fecha'];
$estado=$registro['Estado'];


if($tipomov=="1")  //si el registro modificado fue una entrada al inventario
{
       if($estado=="1") //si es equipo nuevo
      {

	//restamos la cantidad original
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']-$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas
	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']-$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
      }
       if($estado=="2") //si es equipo usado
      {

	//restamos la cantidad original
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']-$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas
	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']-$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
      }

 
}

if($tipomov=="2")  //si el registro modificado fue una salida del inventario
{
       if($estado=="1") //si es equipo nuevo
      {
	//sumamos la cantidad original
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']+$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas
	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']-$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
   }
       if($estado=="2") //si es equipo usado
      {
	//sumamos la cantidad original
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']+$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas
	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']-$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
   }


}
//eliminando el registro de ajuste
    $sentencia = "delete from ajustes where sucursal='".$bodega."' and movimiento='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}


function dat_actualizar_ajustesi($datos, $id,$bodega,$registro)
{
global $parametros , $conexion ;
$xusuario=$_SESSION["idusuarios"];
$tipomov=$registro['Tipomov'];
$producto=$registro['Producto'];
$cantreal=$registro['Cantidad'];
$cantrealn=$datos['Cantidad'];
$fecha=$registro['Fecha'];
$estado=$registro['Estado'];


if($tipomov=="1")  //si el registro modificado fue una entrada al inventario
{
     if($estado=="1") //si es equipo nuevo
      {

	//restamos la cantidad original
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']-$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //sumamos la nueva cantidad
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']+$cantrealn;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas

	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']-$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }

        //Actualizando el registro de movimientos de entradas con el nuevo dato
	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']+$cantrealn;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
      } //de si estado es NUEVO

     if($estado=="2") //si es equipo USADO
      {

	//restamos la cantidad original
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']-$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //sumamos la nueva cantidad
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']+$cantrealn;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas

	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']-$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }

        //Actualizando el registro de movimientos de entradas con el nuevo dato
	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']+$cantrealn;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
      } //de si estado es USADO

}

if($tipomov=="2")  //si el registro modificado fue una salida del inventario
{
      if($estado=="1") //si es equipo nuevo
      {
	//sumamos la cantidad original
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']+$cantreal;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //sumamos la nueva cantidad
	$sentencia="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']-$cantrealn;
			$sentencia="update existenciaprod set cantidad='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas

	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']-$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }

        //Actualizando el registro de movimientos de entradas con el nuevo dato
	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']+$cantrealn;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
   }
      if($estado=="2") //si es equipo usado
      {
	//sumamos la cantidad original
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']+$cantreal;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //sumamos la nueva cantidad
	$sentencia="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
             		$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']-$cantrealn;
			$sentencia="update existenciaprod set cantidadusa='".$nueva_cant."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
	}
        //Actualizando el registro de movimientos de entradas

	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']-$cantreal;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }

        //Actualizando el registro de movimientos de entradas con el nuevo dato
	$sentencia="select salidas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	  {
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['salidas']+$cantrealn;
			$sentencia="update movimientos set salidas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		}
 	   }
   }
 

}
//Actializando el registro de ajuste
$sentencia = "update ajustes SET cantidad='".$datos['Cantidad']."',concepto='".$datos['Concepto']."',cod_emple='".$datos['Codigoempl']."',fechamod=now(),usuariomod='".$xusuario."'	
	          WHERE sucursal='".$bodega."' and movimiento= '$id';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_ajustesi_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select codigo 'Codigo',nombre 'Nombre' FROM ajustes where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}


function dat_veexisreg_ajustesi($datos,$bodega)
{
	global $parametros , $conexion ;
	$codbuscar=$datos['Codigo'];
	$sentencia = "select codigo FROM ajustes where codigo='".$codbuscar."' and sucursal='".$bodega."'";  
    	$resultado = mysql_query($sentencia);
    	return $resultado;
	exit;
}


function dat_obtener_ajustesi_cmb_filtro($prod)
{
	global $parametros , $conexion ;
	//obtine la lista de articulos del sistema para poblar combobox
	//$sentencia = "select idarticulos 'Codigo', concat(idarticulos,' - ',descripcion) 'Nombre' FROM articulos  
    $sentencia = "select idarticulos 'Codigo', descripcion 'Nombre' FROM articulos
					where idarticulos like '%".$prod."%' or descripcion like '%".$prod."%'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_ajustesi_x_bodega_cmb($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de articulos del sistema para poblar combobox
    $sentencia = "select a.idarticulo Codigo, b.descripcion Nombre FROM existencias a, articulos b
					where a.idarticulo = b.idarticulos and a.idbodega='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
?>