<?php
require "dat_base.php";  

function dat_validar_entrada($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from entradas where codigo_entrada='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_entrada($Encabezado)
{
global $parametros , $conexion ;
	$codigo=$Encabezado['0'];
	$tipo=$Encabezado['1'];
	$usuario=$Encabezado['2'];
	$bodega_ent=$Encabezado['3']==""?"null":"'".$Encabezado['3']."'";
	$bodega_sal=$Encabezado['4']==""?"null":"'".$Encabezado['4']."'";
	$proveedor=$Encabezado['5']==""?"null":"'".$Encabezado['5']."'";
	$nenvior=$Encabezado['6']==""?"null":"'".$Encabezado['6']."'";
	$reg_fiscal=$Encabezado['7']==""?"null":"'".$Encabezado['7']."'";
	$factura=$Encabezado['8']==""?"null":"'".$Encabezado['8']."'";
	$poliza=$Encabezado['9']==""?"null":"'".$Encabezado['9']."'";
	$ajuste=$Encabezado['10']==""?"null":"'".$Encabezado['10']."'";
	$obser=$Encabezado['11'];
	$ntransr=$Encabezado['12']==""?"null":"'".$Encabezado['12']."'";
	$fecha1=$Encabezado['13'];
	$ivaperci=$Encabezado['14']==""?"0":"'".$Encabezado['14']."'";
	$codigoempl=$Encabezado['15'];
	$descuento=$Encabezado['16']==""?"0":"'".$Encabezado['16']."'";



    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

    $sentencia = "insert into entradas (codigo_entrada,tipo,fecha,idusuarios,sucursal,codigo_bodega_sale,codigo_prv,
					n_envio_recibido,n_reg_fiscal,n_factura,n_poliza,n_ajuste,observacion,n_tranf_recibida,ivaperci,cod_emple,fechareg,descuento) 
 					VALUES ('".$codigo."','".$tipo."','".$fecha."','".$usuario."',
					".$bodega_ent.",".$bodega_sal.",".$proveedor.",".$nenvior.",
					".$reg_fiscal.",".$factura.",".$poliza.",".$ajuste.",'".$obser."',".$ntransr.",".$ivaperci.",'".$codigoempl."',now(),".$descuento.")";


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

function dat_obtener_entradas_detalle($comienzo, $cant,$codigo)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "Select a.codigo_detalle Item, b.descripcion Articulo,case a.estado_art when 1 then 'Nuevo' 
		          when 2 then 'Usado' end Estado, b.unidadmedc Medida, a.cantidad Cantidad, a.precio_unit 'Precio U.US$', a.unidades 'Unidades', a.costo_unidad 'CostoU'
					from entradas_deta a, articulos b
					where a.idarticulos = b.idarticulos 
					 and a.codigo_entrada='".$codigo."';"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_detalle_entrada($cod_encabezado, $cod_detalle)
{
global $parametros , $conexion ;
    $sentencia = "Select idarticulos Producto, estado_art Estado, case estado_art when 1 then 'Nuevo' 
          when 2 then 'Usado' end Estado1, unidadmedc Medida, cantidad Cantidad, precio_unit 'Precio'
					from entradas_deta
					where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_entradas_detalle($codigo)
{

	global $parametros , $conexion ;
	//obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from entradas_deta where codigo_entrada='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}


function dat_insertar_entrada_detalle($datos,$bodega,$Encabezado)
{
global $parametros , $conexion ;

//inserta un registro en la tabla de entradas_detalle
        $tipo=$Encabezado['1'];
        $ivaperci=$Encabezado['14'];
        $descuento=$Encabezado['16'];
        $fecha1=$Encabezado['13'];
        $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
        $producto=$datos['Producto'];
        $xembasino=null;
        $xembalaje=1;
	$cantreal=0;
	$costo=0;
        $precio=$datos['Precio'];
        $cant=$datos['Cantidad'];

//calculando paquetes de articulos
        $sentencia="select embalaje,embasino from  articulos where idarticulos='".$producto."'";
        $resultado2 = mysql_query($sentencia);
 	 if(isset($resultado2))
            {
             if(mysql_num_rows($resultado2)!=0)
              {
 	       $fila1=mysql_fetch_array($resultado2);
	       $xembasino=$fila1['embasino'];
	       $xembalaje=$fila1['embalaje'];
              }
            }
	if($xembasino=="2")
	{
          $cantreal=$cant*$xembalaje;
	  $costo=($precio*$cant)/$cantreal;

        }
	else
	{
          $cantreal=$cant;
	  $costo=$precio;
        }

//buscando el correlativo del detalle
	$sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_entrada 
				FROM entradas_deta where codigo_entrada='".$datos['CodEntrada']."'";
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

//ingresando el detalle a la tabla
         $sentencia = "insert into entradas_deta (codigo_entrada,codigo_detalle,idarticulos,cantidad,precio_unit,existencia,existencia_anterior,sucursal,fecha,estado_art,unidadmedc,unidadmed,idusuarios,fechareg,costo_unidad,unidades) 
					VALUES ('".$datos['CodEntrada']."'
					  ,'".$cod_entrada_deta['cod_entrada']."'
					  ,'".$datos['Producto']."'
					  ,'".$datos['Cantidad']."'
					  ,'".$datos['Precio']."'
					  ,'".$datos['Cantidad']."'
					  ,'0'
					  ,'".$bodega."'
					  ,'".$fecha."'
					  ,'".$datos['Estado']."'
					  ,'".$xunidadmedc."'
					  ,'".$xunidadmed."'
					  ,'".$usuario."'
					  ,now()
					  ,'".$costo."'
					  ,'".$cantreal."')";
        $resultado = mysql_query($sentencia);


	$sentencia="select cantidad from  existenciasprod where idbodegas='".$bodega."' and idarticulos='".$datos['Producto']."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$sentencia="update entradas_deta set existencia_anterior='".$fila['cantidad']."' where codigo_entrada='".$datos['CodEntrada']."' 
			and codigo_detalle='".$cod_entrada_deta['cod_entrada']."';";
			$retorno=mysql_query($sentencia);		
		}
	}



     //Actualizando el encabezado de la factura
     $stotal=0;
     $res=mysql_query("select precio_unit,cantidad from entradas_deta where sucursal='".$bodega."' and codigo_entrada='".$datos['CodEntrada']."'");
     while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['precio_unit']*$row['cantidad'];
      }

      $sstotal=$stotal;
      
      if($descuento>0)
      {
        $stotal=$stotal-$descuento;
      }

     $iva=$stotal*0.13;
     if($tipo=="1")  //solo si es credito fiscal
      {
       $smtotal=$stotal+$iva+$ivaperci;
       $sentencia="update entradas set total=$sstotal,monto=$smtotal,iva=$iva where sucursal='".$bodega."' and codigo_entrada='".$datos['CodEntrada']."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $sentencia="update entradas set total=$sstotal,monto=$stotal where sucursal='".$bodega."' and codigo_entrada='".$datos['CodEntrada']."'";
       $resultado=mysql_query($sentencia);
      }


	return $resultado;
	exit;
}

function dat_insertar_existencia($datos,$bodega,$producto,$cant,$codentrada,$precio,$estado,$Encabezado)
{
global $parametros , $conexion;
        $tipo=$Encabezado['1'];

//convirtiendo unidades en entrada a unidades de salida
        $precio=$datos['Precio'];
        $xembasino=null;
        $xembalaje=1;
	$cantreal=0;
	$costoprom_ante=0;
        $sentencia="select embalaje,embasino,precio from  articulos where idarticulos='".$producto."'";
        $resultado2 = mysql_query($sentencia);
 	 if(isset($resultado2))
            {
             if(mysql_num_rows($resultado2)!=0)
              {
 	       $fila1=mysql_fetch_array($resultado2);
	       $xembasino=$fila1['embasino'];
	       $xembalaje=$fila1['embalaje'];
              }
            }
	if($xembasino=="2")
	{
          //$cantreal=$cant*$xembalaje;
	  //$costo=$precio/$cantreal;
          $cantreal=$cant*$xembalaje;
	  $costo=($precio*$cant)/$cantreal;
        }
	else
	{
          $cantreal=$cant;
	  $costo=$precio;
        }

$costoprom=$costo;

if($tipo=="3")
 {
 //si es compra por importacion solo se actualiza las existencias pero no el costo promedio
 if($estado=="1")  //si es producto nuevo
  {
	$sentencia="select cantidad,costo from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidad,tipo_art,unidadmed) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
		  $retorno=mysql_query($sentencia);
	}
}
	
if($estado=="2")  //si es producto usado
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."');";
		  $retorno=mysql_query($sentencia);
	}
 }

 }

if($tipo!="3")
 {
 //si la compra no es de importacion, calcula el costo promedio con los valores facturados
 //inserta un registro en la tabla de Existencia o lo actualiza en el caso que ya tenga valor
 if($estado=="1")  //si es producto nuevo
  {
	$sentencia="select cantidad,costo from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidad']+$cantreal;  
                        $canti_anterior=$fila['cantidad'];
                        $costo_anterior=$fila['costo'];
			if($costo_anterior<=0 or $canti_anterior<=0){$canti_anterior=0;$costo_anterior=0;}
                        $costoinve_ante=$canti_anterior*$costo_anterior;
                        $canti_hoy=$cantreal;
                        $costoinve_hoy=$cantreal*$costo;
                        $costoprom=($costoinve_ante+$costoinve_hoy)/($canti_anterior+$canti_hoy);
	 	        $sentencia="update existenciaprod set cantidad='".$nueva_cant."',costo='".$costoprom."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
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
	
if($estado=="2")  //si es producto usado
 {
	$sentencia="select cantidadusa,costousa from  existenciaprod where idbodegas='".$bodega."' and idarticulos='".$producto."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$fila=mysql_fetch_array($resultado);
			$nueva_cant=$fila['cantidadusa']+$cantreal;  
                        $canti_anterior=$fila['cantidadusa'];
                        $costo_anterior=$fila['costousa'];
			if($costo_anterior<=0 or $canti_anterior<=0){$canti_anterior=0;$costo_anterior=0;}
                        $costoinve_ante=$canti_anterior*$costo_anterior;
                        $canti_hoy=$cantreal;
                        $costoinve_hoy=$cantreal*$costo;
                        $costoprom=($costoinve_ante+$costoinve_hoy)/($canti_anterior+$canti_hoy);
	 	        $sentencia="update existenciaprod set cantidadusa='".$nueva_cant."',costousa='".$costoprom."' where idarticulos='".$producto."' and idbodegas='".$bodega."';";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed,costousa) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
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
   		  $sentencia="insert into existenciaprod (idarticulos,idbodegas,descripcion,cantidadusa,tipo_art,unidadmed,costousa) VALUES ('".$producto."','".$bodega."','".$xxdesc."','".$cantreal."','".$xxtipo."','".$xxunidad."','".$costoprom."');";
		  $retorno=mysql_query($sentencia);
	}
 }
}


//Actualizando los movimientos de entradas y salidas
        $fecha=date('Y/m/d');

	$sentencia="select fecha from entradas where sucursal='".$bodega."' and codigo_entrada='".$codentrada."';";
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

function dat_actualizar_entrada_detalle($datos,$cod_encabezado,$cod_detalle,$cant_ant,$bodega,$producto)
{
global $parametros , $conexion ;
	//actualiza un registro en la tabla de entradas_detalle y su respectiva existencia

    $nuevacan=$datos['Cantidad'];

    $sentencia = "update entradas_deta set codigo_mar='".$datos['Marca']."',cantidad='".$datos['Cantidad']."', 
					precio_unit='".$datos['Precio']."', existencia='".$datos['Cantidad']."'
					where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
					
    $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
         //primero actualizo la tabla de movimientos
         $fecha=date('Y/m/d');
	 $sentencia="select fecha from entradas where codigo_bodega_ingresa='".$bodega."' and codigo_entrada='".$cod_encabezado."';";
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

function dat_eliminar_entrada_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto,$estado)
{
global $parametros , $conexion ;
//convirtiendo unidades en entrada a unidades de salida
        $sentencia="select embalaje,embasino from  articulos where idarticulos='".$producto."'";
        $resultado2 = mysql_query($sentencia);
        $xembasino=null;
        $xembalaje=1;
	$cantreal=0;
 	 if(isset($resultado2))
            {
             if(mysql_num_rows($resultado2)!=0)
              {
 	       $fila1=mysql_fetch_array($resultado2);
	       $xembasino=$fila1['embasino'];
	       $xembalaje=$fila1['embalaje'];
              }
            }
	if($xembasino=="2")
	{
          $cantreal=$cant_ant*$xembalaje;
        }
	else
	{
          $cantreal=$cant_ant;
        }


//Actualizo la tabla de movimientos
         $fecha=date('Y/m/d');
	 $sentencia="select fecha from entradas where sucursal='".$bodega."' and codigo_entrada='".$cod_encabezado."';";
	 $resultado1 = mysql_query($sentencia);
	 if(isset($resultado1))
	 {
		if(mysql_num_rows ( $resultado1 )!=0)
		{
  		 $filam=mysql_fetch_array($resultado1);
		 $fecha=$filam['fecha'];
		} 
                //Restando cantidades ingresadas
		$sentencia="select entradas from  movimientos where idbodegas='".$bodega."' and idarticulos='".$producto."'  and fecha='".$fecha."';";
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
		$nuevaexistencia=$fila['cantidad']-$cantreal;
             }
	 }

        //Elimino la linea del detalle 
        $sentencia = "delete from entradas_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
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
		$nuevaexistencia=$fila['cantidadusa']-$cantreal;
             }
	 }
        //Elimino la linea del detalle 
        $sentencia = "delete from entradas_deta where codigo_entrada='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
        $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
		$sentencia="update existenciaprod  set cantidadusa='".$nuevaexistencia."' where idbodegas='".$bodega."' and idarticulos='".$producto."'";
		$resultado = mysql_query($sentencia);
	}
 }


//Actualizando el encabezado de la factura de compra despues de eliminar una linea de detalle
                        $iva=0;
                        $ivaperci=0;
                        $descuento=0;
                        $tipofac="";
			$sentencia2 = "select tipo,descuento,iva,ivaperci from entradas where codigo_entrada='".$cod_encabezado."';";
			$resultadoq=mysql_query($sentencia2);
			if(isset($resultadoq))
			 {
			  if(mysql_num_rows ( $resultadoq )!=0)
			   {
				$fila=mysql_fetch_array($resultadoq);
				$descuento=$fila['descuento'];
				$ivaperci=$fila['ivaperci'];
				$tipofac=$fila['tipo'];
        	           }
			 }

			     $stotal=0;
			     $res=mysql_query("select precio_unit,cantidad from entradas_deta where codigo_entrada='".$cod_encabezado."';");
			     while($row=mysql_fetch_assoc($res))
			      {
			      $stotal+=$row['precio_unit']*$row['cantidad'];
			      }
			
			      $sstotal=$stotal;
		      
			      if($descuento>0)
			      {
			        $stotal=$stotal-$descuento;
			      }

                	      $iva=$stotal*0.13;
		
			     if($tipofac=="1")  //solo si es credito fiscal
			      {
			       $smtotal=$stotal+$iva+$ivaperci;
			       $sentencia="update entradas set total=$sstotal,monto=$smtotal,iva=$iva where codigo_entrada='".$cod_encabezado."';";
			       $resultado=mysql_query($sentencia);
			      }
			      else
			      {
			       $sentencia="update entradas set total=$sstotal,monto=$stotal where codigo_entrada='".$cod_encabezado."';";
			       $resultado=mysql_query($sentencia);
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

function dat_obtener_cod_entrada()
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

function dat_obtener_entradas($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select a.codigo_entrada Movim, case a.tipo when 1 then 'CR' when 2 then 'CF' when 3 then 'IM' end Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, a.n_reg_fiscal CFiscal, 
					a.n_factura Factura, a.n_poliza Poliza, a.total Total, a.descuento Descuento, a.iva IVA, a.ivaperci IVAPercep, a.monto Monto
					from entradas a left join proveedores c ON a.codigo_prv = c.codigo_prv
					where a.sucursal='".$bodega."'
					order by a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_entradas($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*)  from entradas where sucursal='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_entrada($id)
{
	global $parametros , $conexion ;
	$sentencia="select codigo_entrada Codigo,tipo Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha, 
					codigo_prv Proveedor,cod_emple Codigoempl,ivaperci Ivap, iva Iva, observacion Observaciones,n_reg_fiscal RegFiscal, descuento Descuento,n_factura Factura, n_poliza Poliza
					from entradas where codigo_entrada='".$id."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_entrada($datos,$tipo)
{
	global $parametros , $conexion ;
	$usuariocambia=$_SESSION["idusuarios"];
	switch ($tipo)
	{
		case '1':
                        $iva=0;
                        $ivaperci=0;
                        $descuento=0;
			$sentencia = "update entradas set codigo_prv='".$datos['Proveedor']."',cod_emple='".$datos['Codigoempl']."',ivaperci='".$datos['Ivap']."',descuento='".$datos['Descuento']."',observacion='".$datos['Observaciones']."',fechamod=now(),idusuariomod='".$usuariocambia."'
				      where codigo_entrada='".$datos['Codigo']."';";
			$resultadoprinci = mysql_query($sentencia);



			//actualizando el encabezado a partir de los datos del detalle
			$sentencia2 = "select descuento,ivaperci from entradas where codigo_entrada='".$datos['Codigo']."';";
			$resultadoq=mysql_query($sentencia2);
			if(isset($resultadoq))
			 {
			  if(mysql_num_rows ( $resultadoq )!=0)
			   {
				$fila=mysql_fetch_array($resultadoq);
				$descuento=$fila['descuento'];
				$ivaperci=$fila['ivaperci'];
        	           }
			 }

			     $stotal=0;
			     $res=mysql_query("select precio_unit,cantidad from entradas_deta where codigo_entrada='".$datos['Codigo']."'");
			     while($row=mysql_fetch_assoc($res))
			      {
			       $stotal+=$row['precio_unit']*$row['cantidad'];
			      }


			      $sstotal=$stotal;

		      
			      if($descuento>0)
			      {
			        $stotal=$stotal-$descuento;
			      }

			      $iva=$stotal*0.13;

		
			     if($tipo=="1")  //solo si es credito fiscal
			      {
			       $smtotal=$stotal+$iva+$ivaperci;
			       $sentencia="update entradas set total=$sstotal,monto=$smtotal,iva=$iva where codigo_entrada='".$datos['Codigo']."'";
			       $resultado=mysql_query($sentencia);
			      }
			      else
			      {
			       $sentencia="update entradas set total=$stotal,monto=$stotal where codigo_entrada='".$datos['Codigo']."'";
			       $resultado=mysql_query($sentencia);
			      }

                 //calculando el costo promedio
                 //pendiente

		break;

		case '2':
                        $descuento=0;
			$sentencia = "update entradas set codigo_prv='".$datos['Proveedor']."',cod_emple='".$datos['Codigoempl']."',ivaperci='".$datos['Ivap']."',descuento='".$datos['Descuento']."',observacion='".$datos['Observaciones']."',fechamod=now(),idusuariomod='".$usuariocambia."'
				      where codigo_entrada='".$datos['Codigo']."';";
			$resultadoprinci = mysql_query($sentencia);



			//actualizando el encabezado a partir de los datos del detalle
			$sentencia2 = "select descuento,ivaperci from entradas where codigo_entrada='".$datos['Codigo']."';";
			$resultadoq=mysql_query($sentencia2);
			if(isset($resultadoq))
			 {
			  if(mysql_num_rows ( $resultadoq )!=0)
			   {
				$fila=mysql_fetch_array($resultadoq);
				$descuento=$fila['descuento'];
        	           }
			 }

			     $stotal=0;
			     $res=mysql_query("select precio_unit,cantidad from entradas_deta where codigo_entrada='".$datos['Codigo']."'");
			     while($row=mysql_fetch_assoc($res))
			      {
			       $stotal+=$row['precio_unit']*$row['cantidad'];
			      }


			      $sstotal=$stotal;

		      
			      if($descuento>0)
			      {
			        $stotal=$stotal-$descuento;
			      }
	
			       $sentencia="update entradas set total=$sstotal,monto=$stotal where codigo_entrada='".$datos['Codigo']."'";
			       $resultado=mysql_query($sentencia);

                 //calculando el costo promedio
                 //pendiente

		break;

		case '3':
			$sentencia = "update entradas set n_orden_compra='".$datos['Cliente']."', 
							n_factura='".$datos['Factura']."', observacion='".$datos['Observaciones']."'
							where codigo_entrada='".$datos['Codigo']."';";
			    $resultadoprinci = mysql_query($sentencia);

		break;
		case '4':
			$sentencia = "update entradas set 
							codigo_bodega_sale='".$datos['BodegaOrigen']."',
							n_remision='".$datos['Remision']."', 
							observacion='".$datos['Observaciones']."'
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



function dat_obtener_entradas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
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



function dat_obtener_num_entradas_filtro($bodega,$filtro1,$filtro2)
{	global $parametros , $conexion ;

$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

	$sentencia="select count(*) from entradas where sucursal='".$bodega."' and fecha>=str_to_date('$filtro1','%d-%m-%Y') and fecha<=str_to_date('$filtro2','%d-%m-%Y')";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}





?>