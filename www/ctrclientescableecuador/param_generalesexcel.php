<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Reporte del registro del cliente</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>


<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#FechaD').datepicker({
			inline: true
		});
		$('#FechaH').datepicker({
			inline: true
		});
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
</script>


<script type="text/javascript">
function FiltrarProductos(str)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {// codigo para IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// codigo para  IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("prod").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cmbFiltroProd.php?prod="+str,true);
xmlhttp.send();
}
</script>
 <?php
error_reporting (5);

 include "./utils/validar_sesion.php";
 ?>
</head>
<body>
<!-- Inicio de marco principal -->
<div id="wrapper">

	<!-- Inicio de encabezado -->
	<div id="header-wrapper">
		<div id="header">
			<div id="logo" align="center">
				<img src="imagenes/linea1opti.png" alt="logo" border="0" align="texttop" />
			</div>
		</div>
	</div>
	<!-- Fin de encabezado -->
	
  	<!-- Inicio de menu -->
	<div id="menu">
		<div id="menu-wrapper">
			<ul class="hmenu">
				<?php
					include("./utils/crear_menu.php");
				?>				
			</ul>
		</div>
	</div>
	<!-- Fin del menu -->
	
   	<!-- Inicio del contenido -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="page-content">
					<div id="content">
						<div class="post">
							<h3 class="title">Parametros para la Generacion de reportes de clientes</h3>
							<div class="entry">
								<?php
									if (isset ($_POST['aceptar']))
									{
										$insertar=true;

										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_genercliexcel.php?

											fd='.(isset($_POST['Mcanton'])?$_POST['Mcanton']:'').'
											&fh='.(isset($_POST['Mzona'])?$_POST['Mzona']:'').'
											&ti='.(isset($_POST['Tipoinfo'])?$_POST['Tipoinfo']:'').'
											&ti2='.(isset($_POST['Tipoinfobase'])?$_POST['Tipoinfobase']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 

										}										
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="padding:0px 0px 0px 0px;  cellpadding="0"; cellspacing="0"; border=2;" >

									<input type="text"  name="FechaD" id="FechaD"  hidden="true" class="frm_txt" value="'.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'">
									<input type="text"  name="FechaH" id="FechaH"  hidden="true" class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">

									<tr>
									<td>Amplitud del reporte:</td>
									<td>
										<select name="Tipoinfobase" class="frm_cmb_long">
											<option value="1" '.(isset($_POST['Tipoinfobase'])?($_POST['Tipoinfobase']==1?' selected="selected" ':''):'').'>Todos los clientes</option>
											<option value="2" '.(isset($_POST['Tipoinfobase'])?($_POST['Tipoinfobase']==2?' selected="selected" ':''):'').'>Filtrado por los parametros de abajo</option>
											<option value="3" '.(isset($_POST['Tipoinfobase'])?($_POST['Tipoinfobase']==3?' selected="selected" ':''):'').'>Todos los clientes con telefono</option>
										</select>
									</td>
									</tr>


									<tr>
									<td>Poblacion:</td>
										<td>
										 <select name="Mcanton" class="frm_cmb" />
										  <option value="">Seleccione una Poblacion...</option>';
										  require_once("./logica/log_canton.php");
										  $resultado=log_obtener_canton_cmb();
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Mcanton'])
										      {
										        echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										      }
											else
										      {
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										      }
  										   }
										   echo'
										  </td>									
									</tr>


									<tr>
									<td>Sector:</td>
										<td>
										 <select name="Mzona" class="frm_cmb" />
										  <option value="">Seleccione un Sector...</option>';
										  require_once("./logica/log_zonas.php");
										  $resultado=log_obtener_zona_cmb();
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Mzona'])
										      {
										        echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										      }
											else
										      {
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										      }
  										   }
										   echo'
										  </td>									
									</tr>



									<tr>
									<td>Estado:</td>
									<td>
										<select name="Tipoinfo" class="frm_cmb_long">
											<option value="1" '.(isset($_POST['Tipoinfo'])?($_POST['Tipoinfo']==1?' selected="selected" ':''):'').'>Conectados</option>
											<option value="2" '.(isset($_POST['Tipoinfo'])?($_POST['Tipoinfo']==2?' selected="selected" ':''):'').'>Desconectados</option>
										</select>
									</td>
									</tr>

									
									
									<tr>
									<td>Sucursal:</td>
									<td>
										<select name="Bodega" class="frm_cmb" />
										<option value="">Seleccione una sucursal...</option>';
										require_once("./logica/log_bodegas.php");
										$resultado=log_obtener_bodegas_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Bodega"]))
											{
												if ($_POST["Bodega"]==$fila['Codigo'])
												{
												echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
												}
												else
												{
													echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
												}
											}
											else
											{
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
											}
										}
										 echo'
									</td>									
									</tr>
									
					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Generar"  class="frm_btn" name="aceptar"/>
									</td>
									</tr>
									</table>
									</form>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin del contenido -->
	
	<!-- Inicio del Pie de Pagina -->
	<div id="footer">
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
