<?php
require "dat_base.php";  

function dat_validar_devo($id)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select * from devolucion where codigo_salida='$id'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_devo($datos)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de devoluciones
	$codigo=$datos['0'];
	$tipo=$datos['1'];
	$usuario=$datos['2'];
	$bodega_sal=$datos['3']==""?"null":"'".$datos['3']."'";
	$bodega_des=$datos['4']==""?"null":"'".$datos['4']."'";
	$cod_vale=$datos['5']==""?"null":"'".$datos['5']."'";
	$obser=$datos['6'];
		
    $sentencia = "insert into devolucion (codigo_salida,tipo,fecha,idusuario,codigo_bodega_salida,
					codigo_bodega_destino,codigo_vale,observaciones) 
					VALUES ('".$codigo."','".$tipo."',now(),'".$usuario."',".$bodega_sal.",
					".$bodega_des.",".$cod_vale.",'".$obser."')";	
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_devo($id)
{
global $parametros , $conexion ;
	//Elimina un registro de la tabla de devolucion
    $sentencia = "delete from devolucion where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_devo_detalle($comienzo, $cant,$codigo)
{
	global $parametros , $conexion ;
	//obtine un bodega
    $sentencia = "select sal.codigo_detalle Codigo, par.Nombre Partida, spar.Nombre 'Sub-Partida', 
					spar_a.Nombre 'Sub-Partida A', spar_b.Nombre 'Sub-Partida B',art.descripcion Producto, 
					cantidad Cantidad, precio_unit Precio /*,utilizar_en 'Usado En', eq.nombre Equipo, 
					hora Hora, Kilometraje Kilometraje, horometro  Horometro, destino_aceite 'Destino Aceite'*/
					FROM  articulos art, salidas_deta Sal left join equipos eq on Sal.codigo_equipo=eq.codigo_equipo
					left join partidas par on sal.idpartida=par.idpartida
					left join subpartidas spar on sal.idpartida=spar.idpartida and sal.idsubpartida=spar.idsubpartida
					left join subpartidas_a spar_a on  sal.idpartida=spar_a.idpartida and sal.idsubpartida=spar_a.idsubpartida 
					  and sal.idsubpartida_a=spar_a.idsubpartida_A
					left join subpartidas_b spar_b on sal.idpartida=spar_b.idpartida and sal.idsubpartida=spar_b.idsubpartida 
					  and sal.idsubpartida_a=spar_b.idsubpartida_A and sal.idsubpartida_b=spar_b.idsubpartida_b
					where sal.idarticulo=art.idarticulos and Sal.codigo_salida='$codigo';"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_detalle_devo($cod_encabezado, $cod_detalle)
{
	global $parametros , $conexion ;
	//obtine un item del detalle de una salida
    $sentencia = "select codigo_salida, codigo_detalle, idpartida Partida, idsubpartida 'Sub-Partida', 
					idsubpartida_a 'Sub-Partida A', idsubpartida_b'Sub-Partida B', idarticulo Producto, 
					cantidad Cantidad, precio_unit Precio, utilizar_en, codigo_equipo Equipo, hora, Kilometraje, 
					horometro, destino_aceite from salidas_deta a  where a.codigo_salida='".$cod_encabezado."' 
					and a.codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_devo_detalle($codigo)
{
	global $parametros , $conexion ;
	//obtine cuantos items tiene el detalle de una salida especifica.
    $sentencia = "select codigo_detalle from devo_deta where codigo_salida='$codigo'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
	exit;
}

function dat_insertar_devo_detalle($datos,$Encabezado)
{
global $parametros , $conexion ;
	//inserta un registro en la tabla de salidas_detalle
	$cant=$datos['Cantidad'];
	$codigo_salida=$Encabezado['0'];
	$tipo=$Encabezado['1'];
	$bodega=$Encabezado['3'];
	$sentencia="select cantidad from  existencias where idbodega='".$bodega."' and idarticulo='".$datos['Producto']."'";
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
	switch ($tipo)
	{
		case '1':
			$partida=$datos['Partida']==""?"null":"'".$datos['Partida']."'";
			if(isset($datos['SubPartidas']))
			{
			$spartida=$datos['SubPartidas']==""?"null":"'".$datos['SubPartidas']."'";
			}
			else
			{
			$spartida="null";
			}
			if(isset($datos['SubPartidas_a']))
			{
			$spartida_a=$datos['SubPartidas_a']==""?"null":"'".$datos['SubPartidas_a']."'";
			}
			else
			{
			$spartida_a="null";
			}
			if(isset($datos['SubPartidas_b']))
			{
			$spartida_b=$datos['SubPartidas_b']==""?"null":"'".$datos['SubPartidas_b']."'";
			}
			else
			{
			$spartida_b="null";
			}
			$producto=$datos['Producto'];
			$utilizar_en=$datos['Utilizar_en'];	
			if ($datos['Equipo']==-1)
			{
			$datos['Equipo']=null;
			}
			$equipo=$datos['Equipo']==""?"null":"'".$datos['Equipo']."'";
			$hora=$datos['Hora'];
			if ($datos['Kilometraje']=="")
			{
				$kilometraje=0;
			}
			else
			{
				$kilometraje=$datos['Kilometraje'];
			}
			if ($datos['Horometro']=="")
			{
				$horometro=0;
			}
			else
			{
				$horometro=$datos['Horometro'];
			}
			$dest_aceite=$datos['Dest_Aceite'];
		break;
		case '2':
			$partida="null";
			$spartida="null";
			$spartida_a="null";
			$spartida_b="null";
			$producto=$datos['Producto'];
			$utilizar_en=null;
			$equipo='null';
			$hora=null;
			$kilometraje='null';
			$horometro='null';
			$dest_aceite=null;
		break;
	}
	
	
	while ($cant>0)
	{
		$sentencia="select a.codigo_entrada,a.codigo_detalle,a.precio_unit,a.existencia
					from entradas_deta a, entradas b
					where a.codigo_entrada = b.codigo_entrada and a.existencia>0 
					and a.idarticulo='".$datos['Producto']."' and b.codigo_bodega_ingresa='".$bodega."'
					order by a.codigo_entrada, a.codigo_detalle
					limit 1;";
		$resultado=mysql_query($sentencia);

		$existencia=null;
		$precio=null;
		$cod_entrada=null;
		$cod_detalle=null;
		if(mysql_num_rows ( $resultado )!=0)
		{
		$fila=mysql_fetch_array($resultado);
		$existencia=$fila['existencia'];
		$precio=$fila['precio_unit'];
		$cod_entrada=$fila['codigo_entrada'];
		$cod_detalle=$fila['codigo_detalle'];
		}

		if ($cant>$existencia)
		{
			$cant_sal=$existencia;
			$nuevaExistencia=0;
		}
		else 
		{
			$cant_sal=$cant;
			$nuevaExistencia=$existencia-$cant;
		}
		$sentencia="select case IFNULL(max(cast(codigo_detalle as decimal)),0) when '0' then 1 else max(cast(codigo_detalle as decimal))+1 end cod_salida 
					FROM salidas_deta where codigo_salida='".$codigo_salida."'";
		$cod_tab=mysql_query($sentencia);
		$cod_salida_deta=mysql_fetch_array($cod_tab);
	
		$sentencia="insert into devo_deta (codigo_salida,codigo_detalle,idpartida,idsubpartida,idsubpartida_a,
					idsubpartida_b,idarticulo,cantidad,precio_unit,utilizar_en,codigo_equipo,hora,Kilometraje,
					horometro,destino_aceite,existencia_anterior) VALUES ('".$codigo_salida."','".$cod_salida_deta['cod_salida']."',".$partida.",
					".$spartida.",".$spartida_a.",".$spartida_b.",'".$producto."',".$cant_sal.",".$precio.",
					'".$utilizar_en."',".$equipo.",'".$hora."',".$kilometraje.",".$horometro.",'".$dest_aceite."','".$existencia_anterior."')";
		mysql_query($sentencia);
		$sentencia="update entradas_deta set existencia='".$nuevaExistencia."' where codigo_entrada='".$cod_entrada."' and codigo_detalle='".$cod_detalle."'";
		mysql_query($sentencia);
		
		$cant=$cant-$existencia;
	}
	
	$sentencia="update existencias set cantidad=cantidad-".$datos['Cantidad']." where idbodega='".$bodega."' and idarticulo='".$producto."';";
	$resultado=mysql_query($sentencia);
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_actualizar_devo_detalle($datos,$Encabezado,$registro)
{
global $parametros , $conexion ;
	//actualiza un registro en la tabla de salidas_detalle 
	$bodega=$Encabezado['3'];
	$tipo=$Encabezado['1'];	
	$codigo_salida=$Encabezado['0'];
	$codigo_detalle=$registro['codigo_detalle'];
	switch ($tipo)
	{
		case '1':		
			$idpartida=$datos['Partida']==""?"null":"'".$datos['Partida']."'";
			
			if(isset($datos['SubPartidas'])){$idsubpartida=$datos['SubPartidas']==""?"null":"'".$datos['SubPartidas']."'";}
			else{$idsubpartida="null";}
			
			if(isset($datos['SubPartidas'])){$idsubpartida_a=$datos['SubPartidas']==""?"null":"'".$datos['SubPartidas']."'";}
			else{$idsubpartida_a="null";}
			
			if(isset($datos['SubPartidas'])){$idsubpartida_b=$datos['SubPartidas']==""?"null":"'".$datos['SubPartidas']."'";}
			else{$idsubpartida_b="null";}

			$idarticulo=$datos['Producto'];
			
			$precio_unit=$registro['Precio'];
			
			$utilizar_en=$datos['Utilizar_en'];	
			
			if ($datos['Equipo']==-1){$datos['Equipo']=null;}
			
			$codigo_equipo=$datos['Equipo']==""?"null":"'".$datos['Equipo']."'";
			
			$hora="'".$datos['Hora']."'"; 
			
			if ($datos['Kilometraje']==""){$kilometraje=0;}
			else{$kilometraje=$datos['Kilometraje'];}
			
			if ($datos['Horometro']==""){$horometro=0;}
			else{$horometro=$datos['Horometro'];}
		
			$destino_aceite=$datos['Dest_Aceite'];
		break;
		case '2':
			$idpartida="null";
			$idsubpartida="null";
			$idsubpartida_a="null";
			$idsubpartida_b="null";
			$idarticulo=$datos['Producto'];
			$precio_unit=$registro['Precio'];
			$utilizar_en=null;
			$codigo_equipo='null';
			$hora=null;
			$kilometraje='null';
			$horometro='null';
			$destino_aceite=null;
		break;
	}
	if ($registro['Cantidad']>$datos['Cantidad'])
		{$cantidad='+'.($registro['Cantidad']-$datos['Cantidad']); $abc=1;}
	else
		{$cantidad='-'.($datos['Cantidad']-$registro['Cantidad']);$abc=2;}

    $sentencia = "update devo_deta set idpartida=".$idpartida.", idsubpartida=".$idsubpartida.", 
					idsubpartida_a=".$idsubpartida_a.", idsubpartida_b=".$idsubpartida_b.", 
					idarticulo='".$idarticulo."', cantidad=".$datos['Cantidad'].", 
					precio_unit=".$precio_unit.", utilizar_en='".$utilizar_en."', 
					codigo_equipo=".$codigo_equipo.", hora='".$hora."', Kilometraje=".$kilometraje.", 
					horometro=".$horometro.", destino_aceite='".$destino_aceite."'
					where codigo_salida='".$codigo_salida."' and codigo_detalle='".$codigo_detalle."';";
    $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
		$sentencia="update existencias  set cantidad=cantidad".$cantidad." where 
		idbodega='".$bodega."' and idarticulo='".$datos['Producto']."'";
		$resultado = mysql_query($sentencia);
	}
	$error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
	return $error;
	exit;
}

function dat_eliminar_devo_detalle($cod_encabezado, $cod_detalle,$cant_ant,$bodega,$producto)
{
global $parametros , $conexion ;
	//actualiza un registro en la tabla de salidas_detalle y su respectiva existencia

    $sentencia = "delete from devo_deta where codigo_salida='".$cod_encabezado."' and codigo_detalle='".$cod_detalle."' ";
					
    $resultado = mysql_query($sentencia);
	if ($resultado==1)
	{
		$sentencia="update existencias  set cantidad=cantidad+".$cant_ant." where 
		idbodega='".$bodega."' and idarticulo='".$producto."'";
		$resultado = mysql_query($sentencia);
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
	$sentencia="select sum(cantidad) cantidad from existencias where idbodega='".$bodega."' and idarticulo='".$producto."'";
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

function dat_obtener_cod_devo()
{
global $parametros , $conexion ;
	
	$sentencia="select case IFNULL(max(cast(codigo_salida as decimal)),0) when '0' then 1 else max(cast(codigo_salida as decimal))+1 end id FROM devolucion";
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

function dat_obtener_devo($comienzo, $cant,$bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select a.codigo_salida Codigo,case a.tipo when 1 then 'Proveedor local' 
					when 2 then 'Proveedor Externo' end Tipo,DATE_FORMAT(a.fecha,'%d/%m/%Y') Fecha,
					b.nombre 'Bodega de Destino',a.codigo_vale 'Codigo Vale', a.observaciones Observaciones
					from devolucion a left join bodegas b ON a.codigo_bodega_destino = b.idbodegas
					where a.codigo_bodega_salida='".$bodega."'
					order by a.codigo_salida,a.fecha LIMIT $comienzo, $cant";
					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_num_devo($bodega,$filtro)
{
	global $parametros , $conexion ;
	
	$sentencia="select count(*) from devolucion where codigo_bodega_salida='".$bodega."'";					
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_obtener_devo($id)
{
	global $parametros , $conexion ;
	
	$sentencia="select codigo_salida Codigo, tipo Tipo, DATE_FORMAT(fecha,'%d/%m/%Y') Fecha,
				codigo_bodega_destino Bodega_Destino, codigo_vale Vale, observaciones Observaciones
				from devolucion where codigo_salida='".$id."' order by cast(codigo_salida as decimal);";
		
	$resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_devo($datos,$tipo)
{
	global $parametros , $conexion ;

	switch ($tipo)
	{
		case '1':
			$sentencia = "update devolucion set 
							codigo_vale='".$datos['Vale']."',
							observaciones='".$datos['Observaciones']."'
							where codigo_salida='".$datos['Codigo']."';";
		break;
		case '2':
			$sentencia = "update devolucion set 
							codigo_bodega_destino='".$datos['BodegaDestino']."',
							observaciones='".$datos['Observaciones']."'
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

?>