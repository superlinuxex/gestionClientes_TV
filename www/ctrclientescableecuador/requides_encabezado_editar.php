<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar Encabezado de requisiciones </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />

<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>



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
							<h3 class="title">Crear transferencia a partir de la requisicion</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_requides.php");
									$tabla=log_obtener_requides_id($_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$fechahoy=date("d-m-y");
									$insertar=true;
                                                                        $tipo="1";
									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=requides.php">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
                                                                        $tipo="1";
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >';
											switch ($tipo)
											{
												case '1':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>


													<tr>
													<td>Fecha de requisicion:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													

													<tr>
													<td>Empleado que solicita:</td>
													<td>
													<select name="Codigoempl" readonly="readonly" disabled="true" class="frm_cmb" />
													<option value="">Seleccione un empleado...</option>';
													require_once("./logica/log_vendedores.php");
													$resultado=log_obtener_vendedores_cmb($registro['Bodegapide']);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Codigoempl'])
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
													<td>Observaciones de requisición:</td>
													<td><input type="text" class="frm_txt_long" readonly="readonly" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>
												<tr>
												<td>Empleado que entrega:</td>
												<td>
												<select name="Codigoempl2" class="frm_cmb" />
												<option value="">Seleccione un empleado...</option>';
												require_once("./logica/log_vendedores.php");
												$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
												while ( $fila = mysql_fetch_array($resultado))
												{
												 if (isset($_POST["COdigoempl2"]))
												 {
												  if ($_POST["Codigoempl2"]==$fila['Codigo'])
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>

									<tr>
									<td>Empleado que recibe:</td>
									<td>
										<select name="Tecnico" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb2();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Tecnico"]))
											{
												if ($_POST["Tecnico"]==$fila['Codigo'])
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
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>



												<tr>
												<td>Fecha de transferencia o envio:</td>
												<td><input type="text" class="frm_txt" readonly="readonly" name="Fechat" value="'.$fechahoy.'"/></td>
												</tr>

									
												<tr>
												<td>Observaciones de la transferencia:</td>
												<td><input type="text" class="frm_txt_long" name="Observacionest" value="'.(isset($_POST['Observacionest'])?$_POST['Observacionest']:'').'" /></td>
												</tr>';
												break;
												default:
												break;
											}											
											echo'
											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Generar ENVIO"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
										case 'post':
											switch ($tipo)
											{
												case '1':
													$Actualizar=true;
											if (isset($_POST['Codigoempl2'])==false or $_POST['Codigoempl2']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe indicar quien es el empleado responsable
												</div>';
												$Actualizar=false;
											}

											if (isset($_POST['Tecnico'])==false or $_POST['Tecnico']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe indicar quien es el empleado que recibe los materiales para transportarlos
												</div>';
												$Actualizar=false;
											}

											if (isset($_POST['Fechat'])==false or $_POST['Fechat']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe indicar la fecha de la transferencia
												</div>';
												$Actualizar=false;
											}
													$documento=false;
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_requides($_POST,$tipo,$registro);
														if($resultado==1)
														 {
														  echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														  Transferencia generada correctamente.
														  </div>';
														 }
														  else
														 {
														  echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														  La transferencia ya se habia ejecutado, NO SE HA GENERADO, imposible generar dos veces.
														  </div>';
														 }

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
																<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
																</tr>

												
												<tr>
												<td>Fecha de requisición:</td>
												<td><input type="text" class="frm_txt" readonly="readonly" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>

												
												<tr>
												<td>Empleado solicitante:</td>
												<td>
												<select name="Codigoempl" class="frm_cmb" readonly="readonly"/>
												<option value="">Seleccione un empleado...</option>';
												require_once("./logica/log_vendedores.php");
												$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
												while ( $fila = mysql_fetch_array($resultado))
												{
												 if (isset($_POST["COdigoempl"]))
												 {
												  if ($_POST["Codigoempl"]==$fila['Codigo'])
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>

												<tr>
												<td>Observaciones de requisicion:</td>
												<td><input type="text" class="frm_txt_long" readonly="readonly" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>



												<tr>
												<td>Empleado que entrega:</td>
												<td>
												<select name="Codigoempl2" class="frm_cmb" />
												<option value="">Seleccione un empleado...</option>';
												require_once("./logica/log_vendedores.php");
												$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
												while ( $fila = mysql_fetch_array($resultado))
												{
												 if (isset($_POST["COdigoempl2"]))
												 {
												  if ($_POST["Codigoempl2"]==$fila['Codigo'])
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


									<tr>
									<td>Empleado que recibe:</td>
									<td>
										<select name="Tecnico" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb2();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Tecnico"]))
											{
												if ($_POST["Tecnico"]==$fila['Codigo'])
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
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>


												<tr>
												<td>Fecha de transferencia o envio:</td>
												<td><input type="text" class="frm_txt" readonly="readonly" name="Fechat" value="'.$fechahoy.'"/></td>
												</tr>

									
												<tr>
												<td>Observaciones de la transferencia:</td>
												<td><input type="text" class="frm_txt_long" name="Observacionest" value="'.(isset($_POST['Observacionest'])?$_POST['Observacionest']:'').'" /></td>
												</tr>


																<tr>
																<td colspan="2" align="center">
																<input  type="submit" value="Generar ENVIO"  class="frm_btn" name="aceptar"/>
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
