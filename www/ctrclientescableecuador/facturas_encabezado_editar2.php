<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Editar Encabezado de Factura </title>
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
							<h3 class="title">Editar factura</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_facturas.php");
									$tabla=log_obtener_facturamodi($_GET["id"],$_GET["id2"],$_GET["id3"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
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
											switch ($registro['Tipofac'])
											{
												case '1':
													echo '

													<tr>
													<td>Cliente:</td>
													<td><input type="text" class="frm_txt" name="Cod_cliente" value="'.$registro['Cod_cliente'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Factura:</td>
													<td><input type="text" class="frm_txt" name="Factura" value="'.$registro['Factura'].'"  readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fechafac" readonly="readonly" value="'.$registro['Fechafac'].'" /></td>
													</tr>

													<tr>
													<td>Tipo de persona:</td>
													<td>
													<select name="Lugarpago" class="frm_cmb">
													<option value="1" '.($registro['Lugarpago']==1?' selected="selected" ':'').'>Oficina</option>											
													<option value="2" '.($registro['Lugarpago']==2?' selected="selected" ':'').'>Cobrador</option>											
													</select>
													</td>
													</tr>

													<tr>
													<td>Persona que recibio el pago:</td>
													<td>
													<select name="Autoriza" class="frm_cmb" />
													<option value="">Seleccione un empleado...</option>';
													require_once("./logica/log_vendedores.php");
													$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Autoriza'])
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
													<td>Descuento aplicado a toda la factura:</td>
													<td><input type="text" class="frm_txt" name="Vale" value="'.$registro['Descuento'].'" /></td>
													</tr>';
													
												break;
												case '2':
													echo '
													<tr>
													<td>Cliente:</td>
													<td><input type="text" class="frm_txt" name="Cod_cliente" value="'.$registro['Cod_cliente'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Comprobante de credito fiscal:</td>
													<td><input type="text" class="frm_txt" name="Factura" value="'.$registro['Factura'].'"  readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fechafac" readonly="readonly" value="'.$registro['Fechafac'].'" /></td>
													</tr>

													<tr>
													<td>Tipo de persona:</td>
													<td>
													<select name="Lugarpago" class="frm_cmb">
													<option value="1" '.($registro['Lugarpago']==1?' selected="selected" ':'').'>Oficina</option>											
													<option value="2" '.($registro['Lugarpago']==2?' selected="selected" ':'').'>Cobrador</option>											
													</select>
													</td>
													</tr>

													<tr>
													<td>Persona que recibio el pago:</td>
													<td>
													<select name="Autoriza" class="frm_cmb" />
													<option value="">Seleccione un empleado...</option>';
													require_once("./logica/log_vendedores.php");
													$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Autoriza'])
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
													<td>Descuento aplicado a toda la factura:</td>
													<td><input type="text" class="frm_txt" name="Vale" value="'.$registro['Descuento'].'" /></td>
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
											switch ($registro['Tipofac'])
											{
												case '1':
													$Actualizar=true;
													if ($Actualizar==true)
													{
														print "toyyyyyy";
														$resultado=log_actualizar_factura($_POST,$registro['Factura'],$registro['Fechafac'],$registro['Tipofac']);
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro actualizado correctamente.
														</div>';
														unset($_POST); 
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
														exit;  

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
									<td>Lugar de pago:</td>
									<td>
										<select name="Lugarpago" class="frm_cmb">
											<option value="1" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==1?' selected="selected" ':''):'').'>Oficina</option>
											<option value="2" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==2?' selected="selected" ':''):'').'>Cobrador</option>
										</select>
									</td>
									</tr>

												

									<tr>
									<td>Persona que recibio el pago:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un vendedor de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Autoriza"]))
											{
												if ($_POST["Autoriza"]==$fila['Codigo'])
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
												echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>


									<tr>
									<td>Descuento:</td>
									<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_factura($_POST,$registro['Factura'],$registro['Fechafac'],$registro['Tipofac']);
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
									<td>Lugar de pago:</td>
									<td>
										<select name="Lugarpago" class="frm_cmb">
											<option value="1" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==1?' selected="selected" ':''):'').'>Oficina</option>
											<option value="2" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==2?' selected="selected" ':''):'').'>Cobrador</option>
										</select>
									</td>
									</tr>

												

									<tr>
									<td>Persona que recibio el pago:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un vendedor de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Autoriza"]))
											{
												if ($_POST["Autoriza"]==$fila['Codigo'])
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
												echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>


									<tr>
									<td>Descuento:</td>
									<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
