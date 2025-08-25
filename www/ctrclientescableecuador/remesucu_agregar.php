<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Agregar remesas del dia</title>
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

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fechadia').datepicker({
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
				<img src="imagenes/linea1opti.png" alt="logo"  border="0" align="texttop" />
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
							<h3 class="title">Agregar remesa del dia</a></h3>
							<div class="entry">
								<?php
									$xbodega=$_SESSION["idBodega"];
									require_once("logica/log_remesucu.php");
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=remesucu.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Fechadia'])==false or $_POST['Fechadia']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la fecha del dia de ventas que esta remesando
											</div>';
											$insertar=false;
																													}

										if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la fecha de la remesa
											</div>';
											$insertar=false;
																													}
										if (isset($_POST['Monto'])==false or $_POST['Monto']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el monto de la remesa
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Remesa'])==false or $_POST['Remesa']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el numero de la remesa 
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Responsable'])==false or $_POST['Responsable']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el nombre del responsable de la remesa
											</div>';
											$insertar=false;
										}


										if ($insertar==true)
										{
											$resultado=log_insertar_remesucu($_POST,$xbodega);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											 Registro ya existe en el catalogo, imposible adicionar.	
											</div>';
											}
											unset($_POST); 
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=remesucu.php">';    
										exit;    

										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Fecha de remesa:</td>
									<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Venta de la fecha:</td>
									<td><input type="text" class="frm_txt" id="Fechadia" name="Fechadia" value="'.(isset($_POST['Fechadia'])?$_POST['Fechadia']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Numero de remesa o folio:</td>
									<td><input type="text" class="frm_txt" name="Remesa" value="'.(isset($_POST['Remesa'])?$_POST['Remesa']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Monto de la remesa:</td>
									<td><input type="text" class="frm_txt" name="Monto" value="'.(isset($_POST['Monto'])?$_POST['Monto']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Numero de cuenta bancaria:</td>
									<td><input type="text" class="frm_txt" name="Cuenta" value="'.(isset($_POST['Cuenta'])?$_POST['Cuenta']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Responsable de la remesa:</td>
									<td>
									<select name="Responsable" class="frm_cmb" />
									<option value="">Seleccione un empleado...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb($xbodega);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Responsable"]))
									 {
									  if ($_POST["Responsable"]==$fila['Codigo'])
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
									 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									 }
									}
									echo'
									</td>
									</tr>

									<tr>
									<td>Banco:</td>
									<td>
									<select name="Banco" class="frm_cmb_long" />
									<option value="">Seleccione un banco...</option>';
									require_once("./logica/log_bancos.php");
									$resultado=log_obtener_marcas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Banco"]))
									 {
									  if ($_POST["Banco"]==$fila['Codigo'])
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
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
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
		<p>Todos los derechos reservado</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
