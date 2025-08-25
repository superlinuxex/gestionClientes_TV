<?php
require "dat_base.php";  

function dat_obtener_articulos($comienzo, $cant)
{
    global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Codigo, a.nomtipoart Tipo, a.descripcion Descripcion, a.serie Serie, a.nommarca Marca, a.nommodelo Modelo, a.nomcolor Color
          FROM articulos a order by a.idarticulos LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_articulos_filtro($comienzo, $cant, $filtro)
{
   global $parametros , $conexion ;
   $sentencia = "select a.idarticulos Codigo, a.nomtipoart Tipo, a.descripcion Descripcion, a.serie Serie, a.nommarca Marca, a.nommodelo Modelo, a.nomcolor Color 
   FROM articulos a 
   where a.idarticulos like '%".$filtro."%' or a.descripcion like '%".$filtro."%' or a.mac like '%".$filtro."%' or a.serie like '%".$filtro."%' order by a.idarticulos LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_articulo($id)
{
    global $parametros , $conexion ;
    $sentencia = "select a.idarticulos Codigo, a.tipo_art Tipo, a.descripcion Descripcion,a.unidadmed Unidad,a.precio Precio,a.codigo_mar Marca,
                               a.codigo_model Modelo,a.codigo_color Color, a.serie Serie, a.espetec Espetec, a.volumen Volumen, a.peso Peso, 
                               a.embalaje Embalaje, a.unidadmedc Unidadc, a.embasino Embasino, a.mac Mac, a.precio Costo
				FROM  articulos a  where a.idarticulos='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_articulos()
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla articulos
    $sentencia = "SELECT COUNT(*) FROM articulos";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_articulos_filtro($filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla articulos
    $sentencia = "SELECT COUNT(*) FROM articulos where idarticulos like '%".$filtro."%' or descripcion like '%".$filtro."%'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_insertar_articulo($datos)
{
global $parametros , $conexion ;

//Buscar el nombre del tipo de articulo
 $cod_tipoart=$datos['Tipo'];
 $xntipoart="";
 $sentencia = "select nombre FROM divisiones where iddivisiones=".$cod_tipoart.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xntipoart=$row['nombre'];
  }
 }

//Buscar marca de articulo
 $cod_marca=$datos['Marca'];
 $xnmarca="";
 $sentencia = "select nombre FROM marcas where codigo_mar=".$cod_marca.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnmarca=$row['nombre'];
  }
 }

//Buscar modelo de articulo
 $cod_modelo=$datos['Modelo'];
 $xnmodelo="";
 $sentencia = "select nombre FROM modelos where codigo_model=".$cod_modelo.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnmodelo=$row['nombre'];
  }
 }

//Buscar color de articulo
 $cod_color=$datos['Color'];
 $xncolor="";
 $sentencia = "select nombre FROM colores where codigo_color=".$cod_color.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xncolor=$row['nombre'];
  }
 }

  //Inserta el articulo
    $tipomov="articulo";
    $retorna="1";
    $ceros="00000";
    $sentencia="select numerovale FROM correla where codigovale='".$tipomov."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $b=$fila['numerovale'];
        $c=$b+1;
        if($c>9)
         {
          $ceros="0000";
         }
        if($c>99)
         {
          $ceros="000";
         }
        if($c>999)
         {
          $ceros="00";
         }
        if($c>9999)
         {
          $ceros="0";
         }
        if($c>99999)
         {
          $ceros="";
         }
    }
    $retorna=$ceros.$c;

    $a="articulo";
    $sentencia2="update correla set numerovale=numerovale+1 where codigovale='".$a."'";
    $resultado2 = mysql_query($sentencia2);
    
    $cod_compuesto=$datos['Codigo'].$retorna;
    $sentencia = "insert into articulos (idarticulos,tipo_art,nomtipoart,descripcion,unidadmed,codigo_color,codigo_mar,codigo_model,serie,nommarca,nommodelo,nomcolor,espetec,volumen,peso,unidadmedc,embalaje,embasino,mac) 
					VALUES ('".$cod_compuesto."','".$datos['Tipo']."','".$xntipoart."','".$datos['Descripcion']."','".$datos['Unidad']."','".$datos['Color']."','".$datos['Marca']."','".$datos['Modelo']."','".$datos['Serie']."','".$xnmarca."','".$xnmodelo."','".$xncolor."','".$datos['Espetec']."','".$datos['Volumen']."','".$datos['Peso']."','".$datos['Unidadc']."','".$datos['Embalaje']."','".$datos['Embasino']."','".$datos['Mac']."');";
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_eliminar_articulo($id)
{
global $parametros , $conexion ;
    $sentencia = "delete from  articulos where idarticulos='$id'";  
    $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}

function dat_actualizar_articulo($datos, $id)
{
global $parametros , $conexion ;
//Buscar marca de articulo
 $cod_marca=$datos['Marca'];
 $xnmarca="";
 $sentencia = "select nombre FROM marcas where codigo_mar=".$cod_marca.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnmarca=$row['nombre'];
  }
 }

//Buscar modelo de articulo
 $cod_modelo=$datos['Modelo'];
 $xnmodelo="";
 $sentencia = "select nombre FROM modelos where codigo_model=".$cod_modelo.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnmodelo=$row['nombre'];
  }
 }

//Buscar color de articulo
 $cod_color=$datos['Color'];
 $xncolor="";
 $sentencia = "select nombre FROM colores where codigo_color=".$cod_color.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xncolor=$row['nombre'];
  }
 }

    $sentencia = "update articulos SET mac='".$datos['Mac']."' ,embasino='".$datos['Embasino']."', embalaje='".$datos['Embalaje']."',unidadmedc='".$datos['Unidadc']."',descripcion = '".$datos['Descripcion']."',unidadmed = '".$datos['Unidad']."',serie = '".$datos['Serie']."',espetec = '".$datos['Espetec']."',peso = '".$datos['Peso']."',volumen = '".$datos['Volumen']."',codigo_mar = '".$datos['Marca']."',codigo_model = '".$datos['Modelo']."',codigo_color = '".$datos['Color']."',nommarca='".$xnmarca."',nommodelo='".$xnmodelo."',nomcolor='".$xncolor."'
					WHERE idarticulos = '$id';";  
    $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_obtener_articulos_cmb($hcodarti)
{
    global $parametros , $conexion ;
    $sentencia = "select idarticulos 'Codigo',descripcion 'Nombre', unidadmedc 'Medida',precio 'Precio',unidadmed 'Medidades' FROM articulos where idarticulos like '%".$hcodarti."%' or descripcion like '%".$hcodarti."%'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_articulos_cmbxy($tipo)
{
	global $parametros , $conexion ;
$eltipo1="1";
$eltipo2="2";
$eltipo3="3";


 if($tipo=="1")
 {
    //obtine la lista de articulos del sistema para poblar combobox
    //$sentencia = "select idarticulos 'Codigo', concat(idarticulos,' - ',descripcion) 'Nombre' FROM articulos";  
	$sentencia = "select idarticulos 'Codigo',descripcion 'Nombre' FROM articulos where tipo_art='".$eltipo1."' or tipo_art='".$eltipo3."';";  
    $resultado = mysql_query($sentencia);
 }
 if($tipo=="4")
 {
    //obtine la lista de articulos del sistema para poblar combobox
    //$sentencia = "select idarticulos 'Codigo', concat(idarticulos,' - ',descripcion) 'Nombre' FROM articulos";  
	$sentencia = "select idarticulos 'Codigo',descripcion 'Nombre' FROM articulos where tipo_art='".$eltipo2."';";  
    $resultado = mysql_query($sentencia);
 }
    return $resultado;
	exit;

}

function dat_obtener_articulos_cmb_filtro($prod)
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

function dat_vemovi_articulos($prod)
{
global $parametros , $conexion ;
 $resultado1=0;
	$sentencia="select idarticulos from  entradas_deta where idarticulos='".$prod."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$resultado1=1;
		}
	}
	$sentencia="select idarticulos from  salidas_deta where idarticulos='".$prod."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$resultado1=1;
		}
	}
	$sentencia="select idarticulos from  ajustes where idarticulos='".$prod."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$resultado1=1;
		}
	}
    	return $resultado1;
	exit;
}

function dat_obtener_articulos_x_bodega_cmb($bodega)
{
	global $parametros , $conexion ;
	//obtine la lista de articulos del sistema para poblar combobox
    $sentencia = "select a.idarticulo Codigo, b.descripcion Nombre FROM existencias a, articulos b
					where a.idarticulo = b.idarticulos and a.idbodega='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



function dat_ve_existenciaantes_de_borrar($cod)
{
  $resultado1=0;
	$sentencia="select idarticulos from  entradas_deta where idarticulos='".$cod."'";
	$resultado = mysql_query($sentencia);
	if(isset($resultado))
	{
		if(mysql_num_rows ( $resultado )!=0)
		{
			$resultado1=1;
		}
	}
    	return $resultado1;
	exit;

}

function dat_obtener_cod_expe($tipomov)
{
global $parametros , $conexion ;
    $retorno="1";
    $ceros="00000";
    $sentencia="select numerovale FROM correla where codigovale='".$tipomov."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $b=$fila['numerovale'];
        $c=$b+1;
        if($c>9)
         {
          $ceros="0000";
         }
        if($c>99)
         {
          $ceros="000";
         }
        if($c>999)
         {
          $ceros="00";
         }
        if($c>9999)
         {
          $ceros="0";
         }
        if($c>99999)
         {
          $ceros="";
         }
    }
    $retorno=$ceros.$c;
    return $retorno;
    exit;
}

?>