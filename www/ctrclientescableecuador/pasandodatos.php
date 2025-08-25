<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
<title>Sans Titre</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="HAPedit 3.1">
</head>
<body bgcolor="#FFFFFF">
<?
DROP view `vw_base_mov_dia`;

CREATE VIEW vw_base_mov_dia AS
select
DATE_FORMAT(b1.fecha, '%d/%m/%Y') as fecha,
d1.idproyecto as cod_obra,
e1.nombre as nom_obra,
d1.idbodegas as cod_bodega,
d1.nombre as nom_bodega,
a1.idarticulo as articulo,
c1.descripcion as descripcion,
c1.unidadmed as unidad_medida,
a1.existencia_anterior as existencia_origen,
a1.cantidad as entrada,
0 as salida
from entradas_deta a1, entradas b1, articulos c1, bodegas d1, proyectos e1
where a1.codigo_entrada = b1.codigo_entrada
and a1.idarticulo = c1.idarticulos
and b1.codigo_bodega_ingresa = d1.idbodegas
and d1.idproyecto=e1.idproyectos
union all
select 
DATE_FORMAT(b2.fecha, '%d/%m/%Y') as fecha,
d2.idproyecto as cod_obra,
e2.nombre as nom_obra,
d2.idbodegas as cod_bodega,
d2.nombre as nom_bodega,
a2.idarticulo as articulo,
c2.descripcion as descripcion,
c2.unidadmed as unidad_medida,
a2.existencia_anterior as existencia_origen,
0 as entrada,
a2.cantidad as salida
from salidas_deta a2, salidas b2, articulos c2, bodegas d2, proyectos e2
where a2.codigo_salida = b2.codigo_salida
and a2.idarticulo = c2.idarticulos
and b2.codigo_bodega_salida = d2.idbodegas
and d2.idproyecto=e2.idproyectos

?>
</body>

</html>