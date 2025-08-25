<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>customerscabletv - Cambio de Claves de Acceso </title>
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
		<div id="header">
			<div id="logo" align="center">
				<img src="imagenes/linea1opti.png" alt="logo"  border="0" align="texttop" />
			</div>
		</div>
	</div>
	<!-- Fin de encabezado -->
	
	
   	<!-- Inicio del contenido -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="page-content">
					<div id="content">
						<div class="post">
							<h3 class="title">Cambio de contraseña obligatorio</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_usuarios.php");
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=utils/cerrar_sesion.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Clave'])==false or $_POST['Clave']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar su clave actual para poder realizar el  cambio.
											</div>';
											$insertar=false;
										}
										else
										{
											$resultado = log_validar_clave(trim($_SESSION["idusuarios"]),sha1(trim($_POST["Clave"])));
											if ($resultado=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La clave actual ingresada no es correcta.
												</div>';
												$insertar=false;
											}
										}
										if (isset($_POST['ClaveNueva'])==false or $_POST['ClaveNueva']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar su nueva clave de usuario.
											</div>';
											$insertar=false;
										}
										
										if (isset($_POST['ClaveNuevaConf'])==false or $_POST['ClaveNuevaConf']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe confirmar la nueva clave de usuario.
											</div>';
											$insertar=false;
										}
										else
										{
											if ($_POST['ClaveNueva']!=$_POST['ClaveNuevaConf'])
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Las Claves ingresadas no son iguales.
												</div>';
												$insertar=false;
											}
										}
										
										if ($insertar==true)
										{
											$resultado=log_usuarios_cambiar_clave($_SESSION['idusuarios'],$_POST['ClaveNueva']);
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Se ha cambiado la contraseña, seleccione SALIR e intente de nuevo iniciar sesión
											</div>';
											unset($_POST); 
	
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									<tr>
									<td>Clave Actual:</td>
									<td><input type="password" class="frm_txt" name="Clave"  /></td>
									</tr>
									<tr>

									<tr>
									<td>Nueva Clave:</td>
									<td><input type="password" class="frm_txt" name="ClaveNueva" /></td>
									</tr>
									<tr>
									
									<tr>
									<td>Confirmar Clave:</td>
									<td><input type="password" class="frm_txt" name="ClaveNuevaConf" /></td>
									</tr>
									<tr>

									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="submit" value="Salir" class="frm_btn" name="cancelar"/>
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
