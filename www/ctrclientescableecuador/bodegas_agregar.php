<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de Sucursales</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />

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
			<div id="logo" align="center">
				<img src="imagenes/linea1opti.png" alt="logo"  border="0" align="texttop" />
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
							<h3 class="title">Agregar Sucursales</a></h3>
							<div class="entry">
								<?php
									$insertar=true;
									$comodin="1";
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=bodegas.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Codigo para la Sucursal que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Nombre para la sucursal que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Ubicacion'])==false or $_POST['Ubicacion']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Ubicacion para la sucursal que desea ingresar
											</div>';
											$insertar=false;
										}

										if ($insertar==true)
										{
											require_once("logica/log_bodegas.php");
											$resultado=log_insertar_bodega($_POST);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=bodegas.php">';    
										exit;    

										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Código de Sucursal:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Nombre de la sucursal:</td>
									<td><input type="text" class="frm_txt_long" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Ubicacion" value="'.(isset($_POST['Ubicacion'])?$_POST['Ubicacion']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Nombre del Responsable:</td>
									<td><input type="text" class="frm_txt_long" name="Usuario" value="'.(isset($_POST['Nombre'])?$_POST['Usuario']:'').'" /></td>
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
