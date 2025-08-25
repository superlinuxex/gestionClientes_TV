<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>SICCAE - Modificacion Municipios </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

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
							<h3 class="title">Editar Municipios</a></h3>
							<div class="entry">
								<?php
								     if (isset($_GET["id2"])!=false and $_GET["id2"]!="")
								      {

									require_once("logica/log_muni.php");
									$tabla=log_obtener_munis($_GET["id"],$_GET["id2"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=muni.php">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
								      }

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id2='.$_GET["id2"].'&id='.$_GET["id"].'">';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

											<td>Código de Departamento:</td>
											<td><input type="text" class="frm_txt" name="Depto" readonly="readonly" value="'.$registro['Depto'].'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Código de Municipio:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Nombre de Municipio:</td>
											<td><input type="text" class="frm_txt_long" name="Nombre" value="'.$registro['Nombre'].'" /></td>
											</tr>
											<tr>
											
										
						
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
												Debe ingresar el nombre para el municipio que desea ingresar
												</div>';
												$insertar=false;
											}
											if ($insertar==true)
											{
												$resultado=log_actualizar_muni($_POST,$_GET['id2'],$registro);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
												</div>';
												//unset($_POST); 
											//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=muni.php">';    
											//exit;  

											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

											<tr>
											<td>Codigo de Departamento:</td>
											<td><input type="text" class="frm_txt" name="Depto" readonly="readonly" value="'.(isset($_POST['Depto'])?$_POST['Depto']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Codigo de Municipio:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Nombre de Municipio:</td>
											<td><input type="text" class="frm_txt_long" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
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
		<p>Todos los derechos reservados ENLACEVISION S.A. de C.V. - Desarrollo Erving Chamagua, 2013</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
