<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Editar Encabezado de Salida </title>
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
							<h2 class="title">Editar Salida de Materiales</a></h2>
							<div class="entry">
								<?php
									require_once("logica/log_salidas.php");
									$tabla=log_obtener_salida($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas.php">';    
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
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >';
											switch ($registro['Tipo'])
											{
												case '1':
													echo '
													<tr>
													<td>Codigo:</td>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega de Salida:</td>
													<td>
													<input type="text" class="frm_txt" name="Bodega" value="'.$_SESSION['nombre_bodega'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Codigo de vale de salida:</td>
													<td><input type="text" class="frm_txt" name="Vale" value="'.$registro['Vale'].'" /></td>
													</tr>
													
													<tr>
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;
												case '2':
													echo '
													<tr>
													<td>Codigo:</td>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega de Salida:</td>
													<td>
													<input type="text" class="frm_txt" name="Bodega" value="'.$_SESSION['nombre_bodega'].'" readonly="readonly"/></td>
													</tr>									
													</tr>
													
													<tr>
													<td>Bodega de Destino:</td>
													<td>
													<select name="BodegaDestino" class="frm_cmb" />
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Bodega_Destino'])
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
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;
												default:
												break;
											}											
											echo'
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
											switch ($registro['Tipo'])
											{
												case '1':
													$Actualizar=true;
													if (isset($_POST['Vale'])==false or $_POST['Vale']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el Codigo del vale para la Salida que desea Actualizar
														</div>';
														$insertar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_salida($_POST,$registro['Tipo']);
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro actualizado correctamente.
														</div>';
														unset($_POST); 
														echo '
															<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
																<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
																<tr>
																<td colspan="2" align="center">
																<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
																</td>
																</tr>
																</table>
															</form>';
													}
													else
													{
														echo '
														<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >
															<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
																<tr>
																<td>Codigo:</td>
																<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" readonly="readonly"/></td>
																</tr>

																<tr>
																<td>Fecha:</td>
																<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
																</tr>
																
																<tr>
																<td>Bodega de Salida:</td>
																<td>
																<input type="text" class="frm_txt" name="Bodega" value="'.$_SESSION['nombre_bodega'].'" readonly="readonly"/></td>
																</tr>
																
																<tr>
																<td>Codigo de vale de salida:</td>
																<td><input type="text" class="frm_txt" name="Vale" value="'.(isset($_POST['Vale'])?$_POST['Vale']:'').'" /></td>
																</tr>
																
																<tr>
																<td>Observaciones:</td>
																<td><input type="text" class="frm_txt" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
																</tr>
																
																<tr>
																<td colspan="2" align="center">
																<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
																<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
																</td>
																</tr>
															</table>
														</form>';
													}
												break;
												case '2':
													$Actualizar=true;
													if (isset($_POST['BodegaDestino'])==false or $_POST['BodegaDestino']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe seleccionar la Bodega de destino para la Transferencia que desea Actualizar.
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_salida($_POST,$registro['Tipo']);
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro actualizado correctamente.
														</div>';
														unset($_POST); 
														echo '
															<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
																<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
																<tr>
																<td colspan="2" align="center">
																<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
																</td>
																</tr>
																</table>
															</form>';
													}
													else
													{
														echo '
														<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >
															<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
																<tr>
																<td>Codigo:</td>
																<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" readonly="readonly"/></td>
																</tr>

																<tr>
																<td>Fecha:</td>
																<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
																</tr>
																
																<tr>
																<td>Bodega de ingreso:</td>
																<td>
																<input type="text" class="frm_txt" name="Bodega" value="'.$_SESSION['nombre_bodega'].'" readonly="readonly"/></td>
																</tr>
																
																<tr>
																<td>Bodega de Destino:</td>
																<td>
																<select name="BodegaDestino" class="frm_cmb" />
																<option value="">Seleccione una Bodega...</option>';
																require_once("./logica/log_bodegas.php");
																$resultado=log_obtener_bodegas_cmb();
																while ( $fila = mysql_fetch_array($resultado))
																{
																	if ($fila['Codigo']==(isset($_POST['BodegaDestino'])?$_POST['BodegaDestino']:''))
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
																<td>Observaciones:</td>
																<td><input type="text" class="frm_txt" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
																</tr>
																
																<tr>
																<td colspan="2" align="center">
																<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
																<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
																</td>
																</tr>
															</table>
														</form>';
													}
												break;
												default:
												break;
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
