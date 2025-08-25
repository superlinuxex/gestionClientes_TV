<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de Usuarios </title>
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
							<h3 class="title">Agregar Usuarios del Sistema</a></h3>
							<div class="entry">
								<?php
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=usuarios.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['nombre'])==false or $_POST['nombre']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el nombre para el usuario que desea ingresar
											</div>';
											$insertar=false;
																					}
										if (isset($_POST['apellido'])==false or $_POST['apellido']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el apellido para el usuario que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['usuario'])==false or $_POST['usuario']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el nombre de usuario para el usuario que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['clave'])==false or $_POST['clave']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la contraseña para el usuario que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['clave2'])==false or $_POST['clave2']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe confirmar la clave para el usuario que desea ingresar
											</div>';
											$insertar=false;
										}
										else
										{
											if ($_POST['clave']!=$_POST['clave2'])
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
												Las contraseñas ingresadas no coinciden.
												</div>';	
												$insertar=false;
											}
										}
										if (isset($_POST['perfiles'])==false or $_POST['perfiles']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe seleccionar un perfil para el usuario que desea ingresar.
											</div>';
											$insertar=false;
										}
										if (isset($_POST['bodega'])==false or $_POST['bodega']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe seleccionar la bodega para el usuario que desea ingresar.
											</div>';
											$insertar=false;										
										}
										if ($insertar==true)
										{
											require_once("logica/log_usuarios.php");
											$resulatado=log_insertar_usuario($_POST);
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Registro ingresado correctamente.
											</div>';
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=usuarios.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									<tr>
									<td>Nombre:</td>
									<td><input type="text" class="frm_txt" name="nombre" value="'.(isset($_POST['nombre'])?$_POST['nombre']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Apellido:</td>
									<td><input type="text" class="frm_txt" name="apellido" value="'.(isset($_POST['apellido'])?$_POST['apellido']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Usuario:</td>
									<td><input type="text" class="frm_txt" name="usuario" value="'.(isset($_POST['usuario'])?$_POST['usuario']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Clave:</td>
									<td><input type="password" class="frm_txt" name="clave" /></td>
									</tr>
									<tr>

									<tr>
									<td>Confirmar Clave:</td>
									<td><input type="password" class="frm_txt"name="clave2" /></td>
									</tr>
									<tr>

									<tr>
									<td>Perfil:</td>
									<td>
										<select name="perfiles" class="frm_cmb"/>
										<option value="">Seleccione un perfil...</option>';
										require_once("./logica/log_perfiles.php");
										$resultado=log_obtener_perfiles_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["perfiles"]))
											{
												if ($_POST["perfiles"]==$fila['Codigo'])
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
									echo'</td>
									</tr>
									<tr>

									<tr>
									<td>Sucursal:</td>
									<td>
										<select name="bodega" class="frm_cmb" />
										<option value="">Seleccione una bodega...</option>';
										require_once("./logica/log_bodegas.php");
										$resultado=log_obtener_bodegas_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["bodega"]))
											{
												if ($_POST["bodega"]==$fila['Codigo'])
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
