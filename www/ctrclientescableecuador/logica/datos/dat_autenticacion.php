<?php
require "dat_base.php";  
function  Validar_Usuario($user, $pass)  
{  
   global $parametros , $conexion ;  
   
    $sentencia = "Select a.idusuarios,a.nombre,a.apellido,a.usuario,a.clave,a.idperfiles,a.idbodega,b.nombre 'nombre_bodega'
					FROM usuarios a, bodegas b where a.idbodega = b.idbodegas and a.usuario='".$user."' and a.clave='".$pass."'";  

    $resultado = mysql_query($sentencia);
    $registro = mysql_fetch_array($resultado);  
    mysql_free_result($resultado);  
    return $registro;  
    
    //return $resultado ;  
}

function contador_usuario($user, $pass)  
{  
   global $parametros , $conexion ; 
   $contador=1;
   $cuenta=0;
   $sentencia = "Select a.contador FROM usuarios a, bodegas b where a.idbodega = b.idbodegas and  usuario='".$user."' and clave='".$pass."'";  
   $resultado = mysql_query($sentencia);
   if(mysql_num_rows ( $resultado )!=0)
    {
     $row=mysql_fetch_array($resultado);
     $cuenta=$row['contador'];
    }  
   $sumar=$cuenta+$contador;
   $sentencia = "update usuarios set contador='".$sumar."' where usuario='".$user."' and clave='".$pass."'";  
   $resultado = mysql_query($sentencia);
}

?>