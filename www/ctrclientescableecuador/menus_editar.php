<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Mantenimiento de Usuarios </title>
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
							<h3 class="title">Editar Menú del Sistema</a></h3>
							<div class="entry">
								<?php
								require_once("logica/log_menus.php");
									$tabla=log_obtener_menu($_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;
									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=menus.php">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Nombre:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.$registro['Nombre'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Texto:</td>
											<td><input type="text" class="frm_txt" name="Texto" value="'.$registro['Texto'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Url:</td>
											<td><input type="text" class="frm_txt" name="Url" value="'.$registro['Url'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Nivel:</td>
											<td><input type="text" class="frm_txt" name="Nivel" value="'.$registro['Nivel'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Columna:</td>
											<td><input type="text" class="frm_txt" name="Columna" value="'.$registro['Columna'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
										case 'post':
											if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el nombre para el menú que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Texto'])==false or $_POST['Texto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Texto para el menú que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Url'])==false or $_POST['Url']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Url de menú para el usuario que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Nivel'])==false or $_POST['Nivel']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar un Nivel para el menú que desea ingresar.
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Columna'])==false or $_POST['Columna']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar la Columna para el menú que desea ingresar.
												</div>';
												$insertar=false;										
											}
											if ($insertar==true)
											{
												$resultado=log_actualizar_menu($_POST,$_GET['id']);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
												</div>';
												unset($_POST); 
											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Nombre:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Texto:</td>
											<td><input type="text" class="frm_txt" name="Texto" value="'.(isset($_POST['Texto'])?$_POST['Texto']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Url:</td>
											<td><input type="text" class="frm_txt" name="Url" value="'.(isset($_POST['Url'])?$_POST['Url']:'').'" /></td>
											</tr>
											
											<tr>
											<td>Nivel:</td>
											<td><input type="text" class="frm_txt" name="Nivel" value="'.(isset($_POST['Nivel'])?$_POST['Nivel']:'').'" /></td>
											</tr>
											
											<tr>
											<td>Columna:</td>
											<td><input type="text" class="frm_txt" name="Columna" value="'.(isset($_POST['Columna'])?$_POST['Columna']:'').'" /></td>
											</tr>

											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
											<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										}
										else
										{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										}
										break;
										default:
										break;
									}
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
