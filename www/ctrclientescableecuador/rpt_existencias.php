<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_existencias($_GET['proy'],$_GET['bod'],$_GET['prod']);
	if( mysql_num_rows($resultado)==0)
         {
//exit;
print "no hay filas";
         }
echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style type="text/css">
.Tabla1 {
	font-weight: normal;
	color: black;
	border-top: 1pt solid black;
	background-color: white;
}
.FilaNI {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-bottom: 1pt solid black;
}
.FilaN {
	font-weight: normal;
	color: black;
	text-align: center;
	border-bottom: 1pt solid black;
	border-left: 1pt solid black;
}
.FilaNF {
	font-weight: normal;
	color: black;
	text-align: right;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	padding-right:10px;
}
</style>
<title>S I C I O - Reporte de Existencias </title>
</head>
<body>
	<div style="position:absolute;left:15%;top:15px;border:1px solid black;width:820px;height:95%;">
		<div style="position:absolute;left:10px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></div>
		
		<div style="position:absolute;left:40px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de Existencias</strong></span>
		</div>
		<div style="position:absolute;left:690px;top:10px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>
				
		<hr style="margin:0;padding:0;position:absolute;left:10px;top:100px;width:800px;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:110px;width:800px;">
			<tr>
				<td class="FilaNI" style="height: 22px"><strong>Codigo Articulo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Articulo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Proyecto</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Bodega</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Existencia</strong></td>
			</tr>';	
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo '
					<tr>
						<td class="FilaNI" style="height: 22px">'.$fila['cod_articulo'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['nom_articulo'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['cod_proyecto'].'-'.$fila['nom_proyecto'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['cod_bodega'].'-'.$fila['nom_bodega'].'</td>
						<td class="FilaNF" style="height: 22px">'.$fila['cantidad'].'</td>
					</tr>';			
			}
			echo'
		</table>
	</div>
</body>
</html>';
?>