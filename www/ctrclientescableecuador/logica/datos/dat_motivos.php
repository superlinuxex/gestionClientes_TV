<?php
require "dat_base.php";  

function dat_obtener_motivos_cmb()
{
	global $parametros , $conexion ;
	//obtine la lista de motivos para  poblar combobox
    $sentencia = "select idmotivo Codigo, nombremoti Nombre from motidevo
					order by nombremoti";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}
?>