<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customers - Editar servicios a clientes</title>
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
							<h3 class="title">Editar servicios que se dan a los clientes</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_servicios.php");
									$tabla=log_obtener_servicio($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=servicios.php">';    
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
											<td>Codigo del servicio:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Nombre del servicio:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.$registro['Nombre'].'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Costo del servicio:</td>
											<td><input type="text" class="frm_txt" name="Costo" value="'.$registro['Costo'].'" /></td>
											</tr>

											<tr>
											<td>Accion sobre el registro del cliente:</td>
											<td>
											<select name="Conectacl"  class="frm_cmb">
											<option value="0" '.($registro['Conectacl']==0?' selected="selected" ':'').'>Desconecta el servicio</option>											
											<option value="1" '.($registro['Conectacl']==1?' selected="selected" ':'').'>Conecta el servicio</option>											
											<option value="2" '.($registro['Conectacl']==2?' selected="selected" ':'').'>Otros servicios</option>											
											</select>
											</td>
											</tr>

											<tr>
											<td>Orden de priodidad en lista de actividades tecnicas:</td>
											<td><input type="text" class="frm_txt" name="Orden" value="'.$registro['Orden'].'" /></td>
											</tr>


											<tr>
											<td>Tipo de servicio:</td>
											<td>
											<select name="Tiposer"  class="frm_cmb">
											<option value="A" '.($registro['Tiposer']==A?' selected="selected" ':'').'>Administrativo</option>											
											<option value="O" '.($registro['Tiposer']==O?' selected="selected" ':'').'>Operacional</option>											
											<option value="M" '.($registro['Tiposer']==M?' selected="selected" ':'').'>Mantenimiento</option>											
											</select>
											</td>
											</tr>


											<tr>
											<td>Alcance de la actividad:</td>
											<td>
											<select name="Alcance"  class="frm_cmb">
											<option value="C" '.($registro['Alcance']==C?' selected="selected" ':'').'>Servicio al cliente</option>											
											<option value="R" '.($registro['Alcance']==R?' selected="selected" ':'').'>Mantenimiento o ampliacion de la Red</option>											
											</select>
											</td>
											</tr>



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
												Debe ingresar el Codigo 
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Nombre del servicio
												</div>';
												$insertar=false;
											}
											
											if ($insertar==true)
											{
												$resultado=log_actualizar_servicios($_POST,$_GET['id']);
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
									<td>Codigo del servicio:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Nombre del servicio:</td>
									<td><input type="text" class="frm_txt_long" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Costo del servicio:</td>
									<td><input type="text" class="frm_txt" name="Costo" value="'.(isset($_POST['Costo'])?$_POST['Costo']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Accion sobre el registro del cliente:</td>
									<td>
										<select name="Conectacl" class="frm_cmb">
											<option value="0" '.(isset($_POST['Conectacl'])?($_POST['Conectacl']==0?' selected="selected" ':''):'').'>Desconecta el servicio</option>
											<option value="1" '.(isset($_POST['Conectacl'])?($_POST['Conectacl']==1?' selected="selected" ':''):'').'>Conecta el servicio</option>
											<option value="2" '.(isset($_POST['Conectacl'])?($_POST['Conectacl']==2?' selected="selected" ':''):'').'>Otros servicios</option>
										</select>
									</td>
									</tr>


									<tr>
									<td>Orden de priodidad en lista de actividades tecnicas:</td>
									<td><input type="text" class="frm_txt" name="Orden" value="'.(isset($_POST['Orden'])?$_POST['Orden']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Tipo de servicio:</td>
									<td>
										<select name="Tiposer" class="frm_cmb">
											<option value="A" '.(isset($_POST['Tiposer'])?($_POST['Tiposer']==1?' selected="selected" ':''):'').'>Administrativo</option>
											<option value="O" '.(isset($_POST['Tiposer'])?($_POST['Tiposer']==2?' selected="selected" ':''):'').'>Operacional</option>
											<option value="M" '.(isset($_POST['Tiposer'])?($_POST['Tiposer']==2?' selected="selected" ':''):'').'>Mantenimiento</option>
										</select>
									</td>
									</tr>


									<tr>
									<td>Alcance de la actividad:</td>
									<td>
										<select name="Alcance" class="frm_cmb">
											<option value="C" '.(isset($_POST['Alcance'])?($_POST['Alcance']==1?' selected="selected" ':''):'').'>Servicio al cliente</option>
											<option value="R" '.(isset($_POST['Alcance'])?($_POST['Alcance']==2?' selected="selected" ':''):'').'>Mantenimiento o ampliacion de la Red</option>
										</select>
									</td>
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
