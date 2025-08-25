<?php
require "dat_base.php";  

function dat_validar_entradaasuc($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from entratransf where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_entradaasuc($Encabezado)
{
global $parametros , $conexion ;
	$codigo=$Encabezado['0'];
	$tipo=$Encabezado['1'];
	$usuario=$Encabezado['2'];
	$bodega_ent=$Encabezado['3']==""?"null":"'".$Encabezado['3']."'";
	$bodega_sal=$Encabezado['4']==""?"null":"'".$Encabezado['4']."'";
	$nenvior=$Encabezado['5']==""?"null":"'".$Encabezado['5']."'";
	$cod_tecnico=$Encabezado['6']==""?"null":"'".$Encabezado['6']."'";
	$obser=$Encabezado['7'];
	$fecha1=$Encabezado['8'];
	$codigoempl=$Encabezado['9'];
	$vale=$Encabezado['10']==""?"null":"'".$Encabezado['10']."'";

 $xnvende="";
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega_ent." and cod_emple=".$codigoempl.";"; 
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
 $sentencia = "select nombre FROM empleados where sucursal=".$bodega_ent." and cod_emple=".$cod_tecnico.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntecni=$row['nombre'];
  }
 }



    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
if($tipo=="1")
 {
    $sentencia = "insert into entratransf (codigo_entrada,tipo,fecha,idusuarios,sucursal,codigo_bodega_sale,n_envio_recibido,observacion,cod_emple,fechareg,nombrerespon) 
 					VALUES ('".$codigo."','".$tipo."','".$fecha."','".$usuario."',".$bodega_ent.",".$bodega_sal.",".$nenvior.",'".$obser."','".$codigoempl."',now(),'".$xnvende."')";
    $resultado = mysql_query($sentencia);
 }
 else   
 {
    $sentencia = "insert into entratransf (codigo_entrada,tipo,fecha,idusuarios,sucursal,codigo_bodega_sale,n_envio_recibido,cod_tecnico,observacion,cod_emple,fechareg,nombrerespon,nombretecnico,vale) 
 					VALUES ('".$codigo."','".$tipo."','".$fecha."','".$usuario."',".$bodega_ent.",".$bodega_sal.",".$nenvior.",".$cod_tecnico.",'".$obser."','".$codigoempl."',now(),'".$xnvende."','".$xntecni."',".$vale.")";
    $resultado = mysql_query($sentencia);
 }
return $resultado;
	exit;
}

function dat_eliminar_entradaffasuc($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  entradas_deta where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_entradasasuc_detalle($comienzo, $cant,$codigo)
{
	global $parametros , $conexion ;
    $sentencia = "Select a.codigo_detalle Item, b.descripcion Articulo,case a.estado_art when 1 then 'Nuevo' 
		          when 2 then 'Usado' end Estado, b.unidadmed Medida, a.cantidad Cantidad
					from entratransf_deta a, articulos b where a.idarticulos = b.idarticulos  and a.codigo_entrada='".$codigo."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_detalle_entradaasuc($cod_encabezado, $cod_detalle)
{
global $parametros , $conexion ;
    $sentencia = "Select idarticulos Producto, case estado_art when 1 then 'Nuevo' 
          when 2 then 'Usado' end Estado, unidadmed Medida, cantidad Cantidad, estado_art Estadocod
					from entratransf_deta
					where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_entradasasuc_detalle($codigo)
{

	global $parametros , $conexion ;
	//obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from entratransf_deta where codigo_entrada='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}


function dat_insertar_entradaasuc_detalle($datos,$bodega,$Encabezado)
{
global $parametros , $conexion ;

//inserta un registro en la tabla de entradas_detalle
        $tipo=$Encabezado['1'];
        $fecha1=$Encabezado['8'];
        $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
        $producto=$datos['Producto'];
        $cant=$datos['Cantidad'];


	$sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_entrada 
				FROM entratransf_deta where codigo_entrada='".$datos['CodEntrada']."'";
	$cod_tab=mysql_query($sentencia);
	$cod_entrada_deta=mysql_fetch_array($cod_tab);

	$producto=$datos['Producto'];
        $sentencia="select unidadmedc,unidadmed from  articulos where idarticulos='".$producto."'";
        $resultado2 = mysql_query($sentencia);
        $xunidadmedc="";
        $xunidadmed="";
      	if(isset($resultado2))
         {
          if(mysql_num_rows($resultado2)!=0)
	   {
 	    $fila1=mysql_fetch_array($resultado2);
	    $xunidadmedc=$fila1['unidadmedc'];
	    $xunidadmed=$fila1['unidadmed'];
           }
          }
	 $usuario=$Encabezado['2'];


         $sentencia = "insert into entratransf_deta (codigo_entrada,codigo_detalle,idarticulos,cantidad,existencia,existencia_anterior,sucursal,fecha,estado_art,unidadmed,idusuarios,fechareg) 
					VALUES ('".$datos['CodEntrada']."'
					  ,'".$cod_entrada_deta['cod_entrada']."'
					  ,'".$datos['Producto']."'
					  ,'".$datos['Cantidad']."'
					  ,'".$datos['Cantidad']."'
					  ,'0'
					  ,'".$bodega."'
					  ,'".$fecha."'
					  ,'".$datos['Estado']."'
					  ,'".$xunidadmed."'
					  ,'".$usuario."'
					  ,now())";


        $resultado = mysql_query($sentencia);
	$sentencia="select cantidad from  existenciasprod where idbodegas='".$bodega."' and idarticulos='".$datos['Producto']."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$sentencia="update entratransf_deta set existencia_anterior='".$fila['cantidad']."' where codigo_entrada='".$datos['CodEntrada']."' 
			and codigo_detalle='".$cod_entrada_deta['cod_entrada']."';";
			$retorno=mysql_query($sentencia);		
		}
	}


	return $resultado;
	exit;
}

function dat_insertar_existencia($bodega,$producto,$cant,$codentrada,$precio,$estado)
{
global $parametros , $conexion ;

$cantreal=$cant;
//inserta un registro en la tabla de Existencia o lo actualiza en el caso que ya tenga valor
if($estado=="1");  //si es producto nuevo
 {
	$sentencia="select cantidad from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
		  $retorno=mysql_query($sentencia);
	}
}
	
if($estado=="2");  //si es producto usado
 {
	$sentencia="select cantidadusa from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed,costo) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
		  $retorno=mysql_query($sentencia);
	}
}

//Actualizando los movimientos de entradas y salidas
        $fecha=date('Y/m/d');

	$sentencia="select fecha from entratransf where sucursal='".$bodega."' and codigo_entrada='".$codentrada."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
  		 $filam=mysql_fetch_array($resultado);
		 $fecha=$filam['fecha'];
		}        
	} 
	$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['entradas']+$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
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
   		  $sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bodega."','".$cantreal."',0,$xxtipo,'".$fecha."')";
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

		$sentencia="insert into movimientos (idarticulos,nombrear,idbodegas,entradas,salidas,tipo_art,fecha) VALUES ('".$producto."','".$xxnom."','".$bodega."','".$cantreal."',0,$xxtipo,'".$fecha."');";
		$retorno6=mysql_query($sentencia);
	}


	return $retorno;
	exit;
}

function dat_actualizar_entradaasuc_detalle($datos,$cod_encabezado,$cod_detalle,$cant_ant,$bodega,$producto)
{
global $parametros , $conexion ;
	//actualiza un registro en la tabla de entradas_detalle y su respectiva existencia

    $nuevacan=$datos['Cantidad'];

    $sentencia = "update entratransf_deta set codigo_mar='".$datos['Marca']."',cantidad='".$datos['Cantidad']."', 
					existencia='".$datos['Cantidad']."'
					where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
					
    $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
         //primero actualizo la tabla de movimientos
         $fecha=date('Y/m/d');
	 $sentencia="select fecha from entratransf where codigo_bodega_ingresa='".$bodega."' and codigo_entrada='".$cod_encabezado."';";
	 $resultado1 = mysql_query($sentencia);
	 if(isset($resultado1))
	 {
		if(mysql_num_rows ( $resultado1 )!=0)
		{
  		 $filam=mysql_fetch_array($resultado1);
		 $fecha=$filam['fecha'];
		} 
                //Restando la cantidad original
		$sentencia="select entradas from  movimientos where idbodega='".$bodega."' and idarticulo='".$producto."'  and fecha='".$fecha."';";
		$resultado2 = mysql_query($sentencia);
		if(isset($resultado2))
		 {
		  if(mysql_num_rows ( $resultado2 )!=0)
		   {
			$fila=mysql_fetch_array($resultado2);
			$nueva_cant=$fila['entradas']-$cant_ant;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulo='".$producto."' and fecha='".$fecha."' and idbodega='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		   }
                 }
                //Actualizando con nueva cantidad
		$sentencia="select entradas from  movimientos where idbodega='".$bodega."' and idarticulo='".$producto."'  and fecha='".$fecha."';";
		$resultado3 = mysql_query($sentencia);
		if(isset($resultado3))
		 {
		  if(mysql_num_rows ( $resultado3 )!=0)
		   {
			$fila=mysql_fetch_array($resultado3);
			$nueva_cant=$fila['entradas']+$nuevacan;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulo='".$producto."' and fecha='".$fecha."' and idbodega='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		   }
                 }

	  } 



		$monto='-'.$cant_ant.'+'.$datos['Cantidad'];
		$sentencia="update existenciaprod  set cantidad=cantidad".$monto." where 
		idbodega='".$bodega."' and idarticulos='".$producto."'";
		$resultado = mysql_query($sentencia);
	}
	return $resultado;
	exit;
}

function dat_eliminar_entradaasuc_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
global $parametros , $conexion ;


//Actualizo la tabla de movimientos
         $fecha=date('Y/m/d');
	 $sentencia="select fecha from entratransf where sucursal='".$bodega."' and codigo_entrada='".$cod_encabezado."';";
	 $resultado1 = mysql_query($sentencia);
	 if(isset($resultado1))
	 {
		if(mysql_num_rows ( $resultado1 )!=0)
		{
  		 $filam=mysql_fetch_array($resultado1);
		 $fecha=$filam['fecha'];
		} 
                //Restando cantidades ingresadas
		$sentencia="select entratransf from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
		$resultado2 = mysql_query($sentencia);
		if(isset($resultado2))
		 {
		  if(mysql_num_rows ( $resultado2 )!=0)
		   {
			$fila=mysql_fetch_array($resultado2);
			$nueva_cant=$fila['entradas']-$cantreal;
			$sentencia="update movimientos set entradas='".$nueva_cant."' where idarticulos='".$producto."' and fecha='".$fecha."' and idbodegas='".$bodega."';";
			$retorno=mysql_query($sentencia);		
		   }
                 }
           }

//Actualizo las existencias
if($estado=='1') //si es articulo nuevo
 {
	$nuevaexistencia=0;
	$sentenciaq="select cantidad from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultadoq=mysql_query($sentenciaq);
	if(isset($resultadoq))
	 {
		if(mysql_num_rows ( $resultadoq )!=0)
	     {
		$fila=mysql_fetch_array($resultadoq);
		$nuevaexistencia=$fila['cantidad']-$cant_ant;
             }
	 }

        //Elimino la linea del detalle 
        $sentencia = "delete from entratransf_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
        $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
		$sentencia="update existenciaprod  set cantidad='".$nuevaexistencia."' where idbodegas='".$bodega."' and idarticulos='".$producto."'";
		$resultado = mysql_query($sentencia);
	}
 }

if($estado=='2') //si es articulo usado
 {
	$nuevaexistencia=0;
	$sentenciaq="select cantidadusa from existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultadoq=mysql_query($sentenciaq);
	if(isset($resultadoq))
	 {
		if(mysql_num_rows ( $resultadoq )!=0)
	     {
		$fila=mysql_fetch_array($resultadoq);
		$nuevaexistencia=$fila['cantidadusa']-$cant_ant;
             }
	 }
        //Elimino la linea del detalle 
        $sentencia = "delete from entratransf_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
        $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
		$sentencia="update existenciaprod  set cantidadusa='".$nuevaexistencia."' where idbodegas='".$bodega."' and idarticulos='".$producto."'";
		$resultado = mysql_query($sentencia);
	}
 }



//Evaluando si no queda detalle para este movimiento de entrada, si no queda, borrar el encabezado
//    $sentenciaa = "select iva from entradas_deta where codigo_entrada='".$cod_encabezado."'";
//    $resultadoa = mysql_query($sentenciaa);
//    if(isset($resultadoa))
//     {
//	if(mysql_num_rows ( $resultadoa )==0)
//	{
//	 $sentenciab="delete from entradas where codigo_entrada='".$cod_encabezado."';";
//	 $resultadob = mysql_query($sentenciab);
//	}
//     }


	return $resultado;
	exit;
}

function dat_obtener_cod_entradaasuc()
{
global $parametros , $conexion ;
	
	$sentencia="select case IFNULL(max(cast(codigo_entrada as decimal)),0) when '0' then 1 else max(cast(codigo_entrada as decimal))+1 end id FROM entratransf";
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


function dat_obtener_num_entradasasuc($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*)  from entratransf where sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_entradaasuc($id)
{
	global $parametros , $conexion ;
	$sentencia="select codigo_entrada Codigo,tipo Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha,codigo_bodega_sale 'Bodega_Origen', n_envio_recibido 'Nenvior',	cod_emple Codigoempl, observacion Observaciones, vale Vale, cod_tecnico Tecnico
					from entratransf where codigo_entrada='".$id."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_entradaasuc($datos,$tipo)
{
	global $parametros , $conexion ;
	$usuariocambia=$_SESSION["idusuarios"];
	switch ($tipo)
	{
		case '1':
			$sentencia = "update entratransf set cod_emple='".$datos['Codigoempl']."', observacion='".$datos['Observaciones']."',fechamod=now(),idusuariomod='".$usuariocambia."'
				      where codigo_entrada='".$datos['Codigo']."';";
			$resultadoprinci = mysql_query($sentencia);

		break;

		case '2':
			$sentencia = "update entratransf set cod_emple='".$datos['Codigoempl']."',cod_tecnico='".$datos['Tecnico']."', vale='".$datos['Vale']."', observacion='".$datos['Observaciones']."',fechamod=now(),idusuariomod='".$usuariocambia."'
				      where codigo_entrada='".$datos['Codigo']."';";
			$resultadoprinci = mysql_query($sentencia);

		break;
		default:
  	    $sentencia = "";
	    $resultadoprinci = mysql_query($sentencia);

		break;
	}

					
	return $resultadoprinci;
	exit;
}

function dat_obtener_entradasasuc($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select a.codigo_entrada 'Movim', a.vale 'Vale de salida',DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, a.nombretecnico 'Tecnico que devuelve'
					from entratransf a 
					where a.sucursal='".$bodega."'
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_obtener_entradasasuc_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
	global $parametros , $conexion ;

        $filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
        $filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select a.codigo_entrada 'Movim', a.vale 'Vale de salida',DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, a.nombretecnico 'Tecnico que devuelve'
					from entratransf a 
					where a.sucursal='".$bodega."' and a.fecha>=str_to_date('$filtro1','%d-%m-%Y') and a.fecha<=str_to_date('$filtro2','%d-%m-%Y')
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_obtener_num_entradasasuc_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from entratransf where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}





?>