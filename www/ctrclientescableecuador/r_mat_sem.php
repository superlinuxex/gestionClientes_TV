<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Reporte de Movimientos Diarios </title>
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
							<h2 class="title"><a href="#">Parametros para la generacion del reporte de Movimientos Diarios</a></h2>
							<div class="entry">
								<?php
									if (isset ($_POST['aceptar']))
									{
										$insertar=true;
										if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Fecha de la cual se mostraran los movimeintos.
											</div>';
											$insertar=false;
										}
										if ($insertar==true)
										{
											$t1='f';
											$t2='f';
											if ($_POST['Proyecto']!='')
											{
												$t1='t';
											}
											if ($_POST['Bodega']!='')
											{
												$t2='t';
											}
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_mov_dia.php?
											fecha='.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'
											&proy='.(isset($_POST['Proyecto'])?$_POST['Proyecto']:'').'
											&bod='.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'
											&t1='.$t1.'&t2='.$t2.'">';
											exit;
											unset($_POST); 
										}
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									
									<tr>
									<td>Fecha:</td>
									<td>
									<input type="text"  name="Fecha" id="Fecha"  class="frm_txt" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'">
									</td>
									</tr>
									
									<tr>
									<td>Proyecto:</td>
									<td>
									<select name="Proyecto" class="frm_cmb" />
									<option value="">Seleccione un Proyecto...</option>';
									require_once("./logica/log_proyectos.php");
									$resultado=log_obtener_proyectos_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
									}
									echo'
									</td>									
									</tr>
									
									<tr>
									<td>Bodega:</td>
									<td>
									<select name="Bodega" class="frm_cmb" />
									<option value="">Seleccione una Bodega...</option>';
									require_once("./logica/log_bodegas.php");
									$resultado=log_obtener_bodegas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo: ErvingSoft</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
