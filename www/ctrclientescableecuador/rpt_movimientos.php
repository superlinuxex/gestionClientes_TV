<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_movimientos($_GET['fd'],$_GET['fh'],$_GET['pr'],$_GET['bo']);
	if( mysql_num_rows($resultado)==0){exit;}
	$row=mysql_fetch_array($resultado);
	$cod_prod=$row['idarticulo'];
	$nom_prod=$row['descripcion'];
	$uni_med=$row['unidadmed'];
	$inicial_stock=$row['stock'];
	$inicial_monto=$row['monto_ent']*$row['stock'];
	mysql_data_seek($resultado, 0); 
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style type="text/css">
.Fila1I {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
	background-color: white;
}
.Fila1 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-right: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
	background-color: white;
}
.Fila1F {
	font-weight: normal;
	color: black;
	text-align: center;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	border-top: 1pt solid black;
	background-color: white;
}
.Fila2 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	background-color: white;
}
.FilaNI {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
}
.FilaN {
	font-weight: normal;
	color: black;
}
.FilaNF {
	font-weight: normal;
	color: black;
	border-right: 1pt solid black;
}
.Fila4Ini {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;	
}
.Fila4Cant {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
}
.Fila4Mid {
	font-weight: normal;
	color: black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
}
.Fila4Fin {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
}
.Fila5S {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
	text-align: center;
}
.Fila5M {
	font-weight: normal;
	color: black;
	border-top: 1pt solid black;
	border-bottom: 1pt solid black;
	text-align: center;
}
.Fila6S {
	font-weight: normal;
	color: black;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
}
.Fila6M {
	font-weight: normal;
	color: black;
	border-bottom: 1pt solid black;
}

</style>
<title>S I C I O - Reporte de Movimientos</title>
<?php
 //include "./utils/validar_sesion.php";
 ?>
</head>
<body>
	<div style="position:absolute;left:15%;top:15px;border:1px solid black;width:820px;height:95%;">
		<div style="position:absolute;left:0px;top:20px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Kardex de Articulo</strong></span>
		</div>
		<div style="position:absolute;left:25px;top:80px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Articulo: </strong>'.$nom_prod.'</span>
		</div>
		<div style="position:absolute;left:25px;top:110px;width:350px;height:22px;z-index:2;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>U. Medida: </strong>'.$uni_med.'</span>
		</div>
		<div style="position:absolute;left:550px;top:80px;width:350px;height:22px;z-index:3;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Codigo Articulo: </strong>'.$cod_prod.'</span>
		</div>
		
		<hr style="margin:0;padding:0;position:absolute;left:10px;top:140px;width:800px;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:150px;width:800px;">
			<tr>
				<td class="Fila1I" rowspan="2">Emision</td>
				<td class="Fila1" rowspan="2">N&deg; Documento</td>
				<td class="Fila1" rowspan="2">Exis.Inicial</td>
				<td class="Fila1" colspan="3">ENTRADAS</td>
				<td class="Fila1" colspan="3">SALIDAS</td>
				<td class="Fila1F" rowspan="2">DESTINO</td>
			</tr>
			<tr>
				<td class="Fila2" style="height: 22px">Cantidad</td>
				<td class="Fila2" style="height: 22px">Precio</td>
				<td class="Fila2" style="height: 22px">Monto</td>
				<td class="Fila2" style="height: 22px">Cantidad</td>
				<td class="Fila2" style="height: 22px">Precio</td>
				<td class="Fila2" style="height: 22px">Monto</td>
			</tr>';
			$Entradas_sum_cant=0;
			$Entradas_sum_mont=0;
			$Salidas_sum_cant=0;
			$Salidas_sum_mont=0;
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo '
					<tr>
						<td class="FilaNI" style="height: 22px">'.$fila['fecha'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['NumDocumento'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['stock'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['cant_ent'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['precio_ent'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['monto_ent'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['cant_sal'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['precio_sal'].'</td>
						<td class="FilaN" style="height: 22px">'.$fila['monto_sal'].'</td>
						<td class="FilaNF" style="height: 32px">'.$fila['destino'].'</td>
					</tr>';
				$Entradas_sum_cant=$Entradas_sum_cant+$fila['cant_ent'];
				$Entradas_sum_mont=$Entradas_sum_mont+$fila['monto_ent'];
				$Salidas_sum_cant=$Salidas_sum_cant+$fila['cant_sal'];
				$Salidas_sum_mont=$Salidas_sum_mont+$fila['monto_sal'];
			}
			echo'
			<tr>
				<td class="Fila4Ini " colspan="3">TOTALES</td>
				<td class="Fila4Cant " >'.$Entradas_sum_cant.'</td>
				<td class="Fila4Mid " ></td>
				<td class="Fila4Mid" >'.$Entradas_sum_mont.'</td>
				<td class="Fila4Cant " >'.$Salidas_sum_cant.'</td>
				<td class="Fila4Mid " ></td>
				<td class="Fila4Mid" >'.$Salidas_sum_mont.'</td>
				<td class="Fila4Fin " colspan="2"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td class="Fila5S " colspan="2"><strong>RESUMEN</strong></td>
				<td class="Fila5M " colspan="2"><strong>STOCK</strong></td>
				<td class="Fila5S " colspan="2"><strong>SALDO $</strong></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td class="Fila6S " colspan="2">INICIAL</td>
				<td class="Fila6M " colspan="2">'.$inicial_stock.'</td>
				<td class="Fila6S " colspan="2">'.$inicial_monto.'</td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td class="Fila6S " colspan="2">ENTRADAS</td>
				<td class="Fila6M " colspan="2">'.$Entradas_sum_cant.'</td>
				<td class="Fila6S " colspan="2">'.$Entradas_sum_mont.'</td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td class="Fila6S " colspan="2">SALIDAS</td>
				<td class="Fila6M " colspan="2">'.$Salidas_sum_cant.'</td>
				<td class="Fila6S " colspan="2">'.$Salidas_sum_mont.'</td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td class="Fila6S " colspan="2"><strong>TOTAL:</strong></td>
				<td class="Fila6M " colspan="2">'.($inicial_stock+$Entradas_sum_cant-$Salidas_sum_cant).'</td>
				<td class="Fila6S " colspan="2">'.($inicial_monto+$Entradas_sum_mont-$Salidas_sum_mont).'</td>
				<td colspan="2"></td>
			</tr>

		</table>
	</div>
</body>
</html>';
?>