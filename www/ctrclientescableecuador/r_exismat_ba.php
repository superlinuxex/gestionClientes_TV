<?php
 include "./utils/validar_sesion.php";
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_existenciasm2($_GET['bod']);
	$resultado2=log_obtener_existenciasm2($_GET['bod']);

	if( mysql_num_rows($resultado)==0)
         {
//exit;
         }
	 $filax1=mysql_fetch_array($resultado2);

		 $filax3=null;
		 //Buscar el nombre de la sucursal
                 $xxsucu="select nombre from bodegas where idbodegas='".$_GET['bod']."';";
		 $resultadoxx=mysql_query($xxsucu);

		 if(mysql_num_rows ($resultadoxx)!=0)
	         {
	  	   $filaabc=mysql_fetch_array($resultadoxx);
		   $filax3=$filaabc['nombre'];
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
<title>SICCAE - Reporte de Existencias de Materiales</title>
</head>
<body>
	<div style="position:absolute;">
		
		<div style="position:absolute;left:10px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
			<span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de Existencia de Materiales</strong></span>
		</div>
		<div style="position:absolute;left:890px;top:10px;width:150px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.date('d/m/Y').'</span>
		</div>

		<div style="position:absolute;left:50px;top:100px;width:350px;height:22px;z-index:1;">
			<span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Sucursal: </strong>'.$filax3.'</span>
		</div>

				
		<hr style="margin:0;padding:0;position:absolute;left:10px;top:120px;width:1000px;height:2px;z-index:0;
		color: #000;background-color: #000;border-width: 0px;"/>

		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:130px;width:1000px;">
			<tr>
				<td class="FilaNI" style="height: 22px"><strong>Codigo</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Descripcion</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Nuevos</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Usados</strong></td>
				<td class="FilaN" style="height: 22px"><strong>U.Medida</strong></td>
				<td class="FilaN" style="height: 22px"><strong>Cost.U.Usado</strong></td>
				<td class="FilaNF" style="height: 22px;text-align: center;padding-right:0px;"><strong>Cost.U.Nuevo </strong></td>
			</tr>';	
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo '
					<tr>
						<td class="FilaNI" style="height: 22px; text-align: left">'.$fila['idarticulos'].'</td>
						<td class="FilaN" style="height: 22px; text-align: left">'.$fila['descripcion'].'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$fila['cantidad'].'</td>
						<td class="FilaN" style="height: 22px; text-align: right">'.$fila['cantidadusa'].'</td>
						<td class="FilaN" style="height: 22px; text-align: left">'.$fila['unidadmed'].'</td>
						<td class="FilaNF" style="height: 22px;text-align: right">'.$fila['costousa'].'</td>
						<td class="FilaNF" style="height: 22px;text-align: right">'.$fila['costo'].'</td>
					</tr>';			
			}
			echo'
		</table>
	</div>
</body>
</html>';
?>