<?php
require "dat_base.php";  

function dat_obtener_kardex($fecha_ini, $fecha_fin, $producto)
{
	global $parametros , $conexion ;
	//obtine reporte de kardex
    $sentencia = "select * from vw_rpt_kardex
					where idarticulo='".$producto."' 
					and fecha between '".$fecha_ini."' and '".$fecha_fin."' 
					order by fecha";
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
					//echo $sentencia;
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
?>