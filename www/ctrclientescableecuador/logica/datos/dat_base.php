<?php
date_default_timezone_set("America/Mexico_City");

//maquna con acceso remoto a la base de datos
//$parametros = array();  
//$parametros["host"] = "192.168.1.253";  
//$parametros["user"] = "root3";  
//$parametros["pass"] = "abcdefg";
//$parametros["database"] = "cablefacturas";  


// local en maquina de desarrollo
$parametros = array();  
$parametros["host"] = "localhost";  
$parametros["user"] = "root";  
$parametros["pass"] = "";
$parametros["database"] = "baseecuador";  

$conexion = mysql_connect($parametros['host'], $parametros['user'], $parametros['pass']) or die(mysql_error($parametros));  

mysql_select_db($parametros['database'],$conexion); 
mysql_query("SET NAMES 'utf8'");

?>