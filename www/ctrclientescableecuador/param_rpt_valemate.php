<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Impresion de vales de materiales y repuestos </title>
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
		$('#Fecha').datepicker({
			inline: true
		});
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
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
							<h2 class="title"><a href="#">Parametros para impresion vales de Materiales</a></h2>
							<div class="entry">

								<div id="itsthetable">
                                					<form method="POST" id="id-form" action="param_rpt_valemate_fec.php" >
										<table style="border: 0px solid #00F" >
											<tr style="border: 0px solid #00F">
												<td style="border: 0px solid #00F">
													Seleccione el tipo de Impresion deseada: 
													<select name="tipo" class="frm_cmb"/>
													<option>Seleccione un tipo de Impresion...</option>
													<option value="1">Vales por una fecha dada</option>
													<option value="2">Un vale especifico</option>
												</td>
												<td style="border:0px solid; width:330px;">
													<input  type="submit" value="Continuar"  class="frm_btn" name="Continuar"/>
												</td>
											</tr>
										</table>
									</form>
								</div>

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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo: ErvingSoft</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
