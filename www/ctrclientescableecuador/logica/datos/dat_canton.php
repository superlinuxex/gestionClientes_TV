<?php
require "dat_base.php";  

function dat_obtener_canton_cmb()
{
   global $parametros , $conexion ;
    $sentencia = "select cod_canton Codigo, nombrecant Nombre from canton
					order by Nombre";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
?>