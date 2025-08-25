<?php
require "dat_base.php";  
function dat_obtener_facturas($comienzo, $cant,$bodega,$filtro)
{
    global $parametros , $conexion ;
    $sentencia="select numero Factura,DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha, tipofac Tipo, cod_cliente Cliente, total1 Subtotal, descuento Descuento, monto Total, iva IVA, total Monto, case anulada when 0 then 'Pagada' when 1 then 'Anulada' end 'Estado'
                    from facturas 
                    where sucursal='".$bodega."'
                    order by fechafac DESC  LIMIT $comienzo, $cant";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_num_facturas($bodega,$filtro)
{
    global $parametros , $conexion ;
    
    $sentencia="select count(*) from facturas where sucursal='".$bodega."'";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}
?>