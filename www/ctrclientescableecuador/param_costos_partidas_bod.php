<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Reporte de Costos en un Período</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
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
				<img src="imagenes/arco_log_main.png" alt="logo" border="0" align="texttop" />
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
							<h2 class="title"><a href="#">Parametros para la Generacion del Reporte de Costos en un Periodo</a></h2>
							<div class="entry">
								<?php
									if (isset ($_POST['aceptar']))
									{
										$insertar=true;
										if (isset($_POST['FechaD'])==false or $_POST['FechaD']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Fecha desde la cual se mostraran los movimientos.
											</div>';
											$insertar=false;
										}
										if (isset($_POST['FechaH'])==false or $_POST['FechaH']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Fecha hasta la cual se mostraran los movimientos.
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Proyecto'])==false or $_POST['Proyecto']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe seleccionar un Proyecto.
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Bodega'])==false or $_POST['Bodega']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe seleccionar la bodega que está asignada al Proyecto indicado arriba.
											</div>';
											$insertar=false;
										}

										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_costos_part.php?

											fd='.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'
											&fh='.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'
											&proy='.(isset($_POST['Proyecto'])?$_POST['Proyecto']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 
										}										
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="padding:0px 0px 0px 0px;  cellpadding="0"; cellspacing="0"; border=2;" >
									
									<tr>
									<td>Fecha Desde :</td>
									<td>
									<input type="text"  name="FechaD" id="FechaD"  class="frm_txt" value="'.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'">
									</td>
									</tr>
									
									<tr>
									<td>Fecha Hasta :</td>
									<td>
									<input type="text"  name="FechaH" id="FechaH"  class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">
									</td>
									</tr>
									
									<tr>
									<td>Proyecto:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Proyecto" value="'.(isset($_SESSION["idBodega"])?$_SESSION["idBodega"]:'').'" /></td>
									</tr>

									<tr>
									<td>Bodega:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Bodega" value="'.(isset($_SESSION["idBodega"])?$_SESSION["idBodega"]:'').'" /></td>
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
