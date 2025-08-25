<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Editar Urbanizacion o Caserios</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
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
							<h3 class="title">Editar registro de Urbanizacion</a></h3>
							<div class="entry">
								<?php
									require_once("./utils/validar_datos.php");
									require_once("logica/log_caserios.php");
									$tabla=log_obtener_caserio($_GET["part"],$_GET["s_part"],$_GET["s_part_a"],$_GET["s_part_b"],$_GET["s_part_c"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=caserios.php?part='.$_GET["part"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'&s_part_b='.$_GET["s_part_b"].'&s_part_b='.$_GET["s_part_c"].'">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'&s_part_b='.$_GET["s_part_b"].'&s_part_c='.$_GET["s_part_c"].'" >';
									echo '<input type = "hidden" name = "Depto" value = "'.$_GET["part"].'" />';
									echo '<input type = "hidden" name = "Municipio" value = "'.$_GET["s_part"].'" />';
									echo '<input type = "hidden" name = "Canton" value = "'.$_GET["s_part_a"].'" />';
									echo '<input type = "hidden" name = "Barrio" value = "'.$_GET["s_part_b"].'" />';
									echo '<input type = "hidden" name = "Caserio" value = "'.$_GET["s_part_c"].'" />';

									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											Departamento:'.$_GET["part"].'
											Ciudad:'.$_GET["s_part"].'
											Zona:'.$_GET["s_part_a"].'
											Localidad:'.$_GET["s_part_b"].'


											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Codigo de Urbanizacion o Caserio:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Nombre de Urbanizacion o Caserio:</td>
											<td><input type="text_long" class="frm_txt" name="Nombre" value="'.$registro['Nombre'].'" /></td>
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
												Debe ingresar el Codigo para la urbanizacion que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Nombre para la urbanizacion que desea ingresar
												</div>';
												$insertar=false;
											}
											if ($insertar==true)
											{
												$resultado=log_actualizar_caserio($_POST,$_GET['part'],$_GET['s_part'],$_GET['s_part_a'],$_GET['s_part_b'],$_GET['s_part_c']);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
												</div>';
												unset($_POST); 
											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'&s_part_b='.$_GET["s_part_b"].'" >';
											echo '<input type = "hidden" name = "Depto" value = "'.$_GET["part"].'" />';
											echo '<input type = "hidden" name = "Municipio" value = "'.$_GET["s_part"].'" />';
											echo '<input type = "hidden" name = "Canton" value = "'.$_GET["s_part_a"].'" />';
											echo '<input type = "hidden" name = "Barrio" value = "'.$_GET["s_part_b"].'" />';
											echo '<input type = "hidden" name = "Caserio" value = "'.$_GET["s_part_c"].'" />';
											echo '
											Departamento:'.$_GET["part"].'
											Ciudad:'.$_GET["s_part"].'
											Zona:'.$_GET["s_part_a"].'
											Localidad:'.$_GET["s_part_b"].'

											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Codigo urbanizacion o caserio:</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
											</tr>
											</tr>
											
											
											<tr>
											<td>Nombre urbanizacion o caserio:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
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
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'&s_part_b='.$_GET["s_part_b"].'" >
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
