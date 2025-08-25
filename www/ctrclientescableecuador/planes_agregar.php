<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Agregar Planes </title>
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
		$('#Fechai').datepicker({
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
		$('#Fechaf').datepicker({
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
							<h3 class="title">Agregar Planes</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_planes.php");
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=planes.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Pbase'])==false or $_POST['Pbase']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar plan base
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Tarifa'])==false or $_POST['Tarifa']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar tarifa
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Equi'])==false or $_POST['Equi']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar si hay equipo
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Promo'])==false or $_POST['Promo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar especificacion de promocion
											</div>';
											$insertar=false;
										}




										if ($insertar==true)
										{
											$resultado=log_insertar_planes($_POST);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ya existe en el catalogo, imposible adicionar.	
											</div>';
											}
											unset($_POST); 
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=planes.php">';    
										exit;    

										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Plan base:</td>
									<td>
									<select name="Pbase" class="frm_cmb" />
									<option value="">Seleccione un plan base...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_planbase1_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Pbase"]))
									   {
									    if ($_POST["Pbase"]==$fila['Codigo'])
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
									<td>Velocidad:</td>
									<td>
									<select name="Velo" class="frm_cmb" />
									<option value="">Seleccione una velocidad...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_velocidad_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Velo"]))
									   {
									    if ($_POST["Velo"]==$fila['Codigo'])
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
									<td>Tarifa:</td>
									<td>
									<select name="Tarifa" class="frm_cmb" />
									<option value="">Seleccione una Tarifa...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_tarifa1_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Tarifa"]))
									   {
									    if ($_POST["Tarifa"]==$fila['Codigo'])
									     {
									      echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Costo'].'</option>';
									     }
									     else
									     {
									      echo "<option value='".$fila['Codigo']."'> ".$fila['Costo']."</option>";
									     }
									   }
									   else
									   {
									    echo "<option value='".$fila['Codigo']."'> ".$fila['Costo']."</option>";
									   }
									 }
									 echo'
									 </td>	
									 </tr>



									<tr>
									<td>Equipo de Regalo:</td>
									<td>
									<select name="Equi" class="frm_cmb" />
									<option value="">Seleccione un Equipo...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_equi1_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Equi"]))
									   {
									    if ($_POST["Equi"]==$fila['Codigo'])
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
									<td>Promociones:</td>
									<td>
									<select name="Promo" class="frm_cmb" />
									<option value="">Seleccione una promocion...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_promo1_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Promo"]))
									   {
									    if ($_POST["Promo"]==$fila['Codigo'])
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

												<td>FECHAS DE VIGENCIA</td>
												<tr>
												<td>Fecha de inicio:</td>
												<td><input type="text" class="frm_txt" id="Fechai" name="Fechai" value="'.(isset($_POST['Fechai'])?$_POST['Fechai']:'').'"/></td>
												</tr>

												<tr>
												<td>Fecha de finalizacion:</td>
												<td><input type="text" class="frm_txt" id="Fechaf" name="Fechaf" value="'.(isset($_POST['Fechaf'])?$_POST['Fechaf']:'').'"/></td>
												</tr>

									<tr>
									<td>Activado para la Sucursal:</td>
									<td>
									<select name="Bodega" class="frm_cmb" />
									<option value="">Seleccione una sucursal...</option>';
									require_once("./logica/log_bodegas.php");
									$resultado=log_obtener_bodegas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
										{
										if ($fila['Codigo']==$_SESSION["idBodega"])
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
