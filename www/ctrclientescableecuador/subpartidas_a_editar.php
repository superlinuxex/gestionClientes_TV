<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Editar Sub-Partida "A"</title>
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
							<h2 class="title">Editar Sub-Partida 'A'</a></h2>
							<div class="entry">
								<?php
									require_once("./utils/validar_datos.php");
									require_once("logica/log_subpartidas_a.php");
									$tabla=log_obtener_subpartida_a($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"],$_GET["s_part_a"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=subpartidas_a.php?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'" >';

									echo '<input type = "hidden" name = "Division" value = "'.$_GET["div"].'" />';
									echo '<input type = "hidden" name = "Proyecto" value = "'.$_GET["pro"].'" />';
									echo '<input type = "hidden" name = "Partida" value = "'.$_GET["part"].'" />';
									echo '<input type = "hidden" name = "SubPartida" value = "'.$_GET["s_part"].'" />';
									echo '<input type = "hidden" name = "SubPartida_a" value = "'.$_GET["s_part_a"].'" />';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
   											División:'.$_GET["div"].'
											Proyecto:'.$_GET["pro"].'
											Partida:'.$_GET["part"].'
											SubPartida:'.$_GET["s_part"].'

											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>No.Subpartida"A":</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>

																						<tr>
											<td>Nombre de Subpartida"A":</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.$registro['Nombre'].'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Presupuesto Asignado:</td>
											<td><input type="text" class="frm_txt" name="Abonos" value="'.$registro['Abonos'].'" /></td>
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
												Debe ingresar el Codigo para la sub-partida a que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Nombre para la sub-partida que a desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Abonos'])==false or $_POST['Abonos']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar los Abonos para la sub-partida a que desea ingresar, puede digitar 0 (cero)
												</div>';
												$insertar=false;										
											}
											else{
												if(validar_decimales($_POST['Abonos'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Abonos solo admite montos numéricos, puede digitar 0 (cero)
												</div>';
												$insertar=false;
												}											
											}
											if ($insertar==true)
											{
												$resultado=log_actualizar_subpartida_a($_POST,$_GET['part'],$_GET["div"],$_GET["pro"],$_GET['s_part'],$_GET['s_part_a']);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
												</div>';
												unset($_POST); 
											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'" >';
											echo '<input type = "hidden" name = "Division" value = "'.$_GET["div"].'" />';
											echo '<input type = "hidden" name = "Proyecto" value = "'.$_GET["pro"].'" />';
											echo '<input type = "hidden" name = "Partida" value = "'.$_GET["part"].'" />';
											echo '<input type = "hidden" name = "SubPartida" value = "'.$_GET["s_part"].'" />';
											echo '<input type = "hidden" name = "SubPartida_a" value = "'.$_GET["s_part_a"].'" />';
											echo '
   											División:'.$_GET["div"].'
											Proyecto:'.$_GET["pro"].'
											Partida:'.$_GET["part"].'
											SubPartida:'.$_GET["s_part"].'

											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>No.Subpartida "A":</td>
											<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
											</tr>
											</tr>
											
											<tr>
											<td>Nombre Subpartida"A":</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
											</tr>
											
											<tr>
											<td>Presupuesto Asignado:</td>
											<td><input type="text" class="frm_txt" name="Abonos"  value="'.(isset($_POST['Abonos'])?$_POST['Abonos']:'').'" /></td>
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
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'" >
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
