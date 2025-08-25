<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Editar Equipo </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
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
							<h2 class="title">Editar Equipo</a></h2>
							<div class="entry">
								<?php
									require_once("logica/log_equipos.php");
									$tabla=log_obtener_equipo($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=equipos.php">';    
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
											<td>Codigo:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Nombre:</td>
											<td><input type="text" class="frm_txt_long" name="Nombre" value="'.$registro['Nombre'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Marca:</td>
											<td><input type="text" class="frm_txt_long" name="Marca" value="'.$registro['Marca'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Modelo:</td>
											<td><input type="text" class="frm_txt_long" name="Modelo" value="'.$registro['Modelo'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Serie:</td>
											<td><input type="text" class="frm_txt_long" name="Serie" value="'.$registro['Serie'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Placa:</td>
											<td><input type="text" class="frm_txt" name="Placa" value="'.$registro['Placa'].'" /></td>
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
											if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Codigo para la division que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Nombre para la division que desea ingresar
												</div>';
												$insertar=false;
											}
											
											if ($insertar==true)
											{
												$resultado=log_actualizar_equipos($_POST,$_GET['id']);
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
											<td>Codigo:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Nombre:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Marca:</td>
											<td><input type="text" class="frm_txt" name="Marca" value="'.(isset($_POST['Marca'])?$_POST['Marca']:'').'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Modelo:</td>
											<td><input type="text" class="frm_txt" name="Modelo" value="'.(isset($_POST['Modelo'])?$_POST['Modelo']:'').'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Serie:</td>
											<td><input type="text" class="frm_txt" name="Serie" value="'.(isset($_POST['Serie'])?$_POST['Serie']:'').'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Placa:</td>
											<td><input type="text" class="frm_txt" name="Placa" value="'.(isset($_POST['Placa'])?$_POST['Placa']:'').'" /></td>
											</tr>
											<tr>

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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
