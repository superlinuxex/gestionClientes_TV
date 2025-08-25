<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>MITIENDITA - Mantenimiento de Productos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuhosp.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formhospi.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=TeqPy5N6mgiHiAgmyft_W19gaVRcMChVskxWk0b-cKPe-ECJ8DHSY-3ut_2mZWpMKE8BDCzgHbjo37fveAr-_dx__3XB3GSlSTkzye4wvfWI08_YT8oEnJb-a9QBV2VSZFVPQV2suI1zITgkfn65r5pXCZcZ6O3Y_zIka9XI7pnjdk-IeTpZrBVPdf351K_HmQVBIWCaK8lvREtiZrdtmNzD7oL_IMd4O-iFT3dXAuo" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="http://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cDovL21pcGFuZWwuZXJ2aW5nc29mdC5pbmZvL2hvc3RpbmcvZmlsZW1hbmFnZXIvaXRlbS9kb3dubG9hZD9tb2RlPWRvd25sb2FkJnByZXZpZXc9JnBhdGg9JTJmcHVibGljX2h0bWwlMmZ0aWVuZGF2aXJ0dWFsJTJmaWRlbnBhY2lfYWdyZWdhci5waHA"/><script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
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
	
   	<!-- Inicio del contenido -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="page-content">
					<div id="content">
						<div class="post">
							<h2 class="title">Subir tabla Georeferencial</a></h2>
							<div class="entry">

								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
										exit;    
									}
									if (isset ($_POST['enviar']))
									{
									
										if ($insertar==true)
										{
											require_once("logica/log_idenpaci.php");
											$resultado=log_insertar_tablageo($_POST,$bodx,$usux);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ya existe en el registro, imposible adicionar.	
											</div>';
											}
										unset($_POST);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
										exit;    
 
										}										
									}



								echo '<FORM ENCTYPE="multipart/form-data" ACTION="'.$_SERVER["PHP_SELF"].'" METHOD="post">';
									echo '
									<INPUT type="hidden" name="lim_tamano" value="325000">

<br><br><br>

									<p><b>Selecciona el archivo a subir<b><br>
									<INPUT type="file" name="foto" id="imagen"></br></br></br>
									
<INPUT  type="hidden" name="titulo"><br></p>
<td><input type="hidden" class="frm_txt_long" name="Nombres" value="'.(isset($_POST['Nombres'])?$_POST['Nombres']:'').'" /></td>
<td><input type="hidden" class="frm_txt_long" name="Precio" value="'.(isset($_POST['Precio'])?$_POST['Precio']:'').'" /></td>
<td><input type="hidden" class="frm_txt_long" name="Tipop" value="'.(isset($_POST['Tipop'])?$_POST['Tipop']:'').'" /></td>
<p><INPUT type="submit" name="enviar" value="Aceptar"></p>

								</FORM>';

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
		<p>Copyright(c) 2017 - Todos los derechos reservados. Desarrollo Erving Chamagua</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>