<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar encabezado de factura de gastos</title>
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
							<h3 class="title">Editar registro de gastos</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_gastos.php");
									$tabla=log_obtener_gasto($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos.php">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}

									switch ($registro['Tipo'])
									{
	 								 case '1':
										echo '
										<tr>
										<h3>Gasto con factura de consumidor final</h3>
 										</tr>';
										break;
	 								 case '2':
										echo '
										<tr>
										<h3>Gasto con credito fiscal</h3>
 										</tr>';
										break;
	 								 case '3':
										echo '
										<tr>
										<h3>Gasto con recibo</h3>
 										</tr>';
										break;
	 								 case '4':
										echo '
										<tr>
										<h3>Gasto con Ticket</h3>
 										</tr>';
										break;
	 								 case '5':
										echo '
										<tr>
										<h3>Gasto con Vale</h3>
 										</tr>';
										break;
									  default:
									  break;
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Documento" readonly="readonly" value="'.$registro['Documento'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>

													<tr>
													<td>Lugar donde se recibe el servicio o insumo:</td>
													<td>
													<select name="Lugarcon" class="frm_cmb">
													<option value="1" '.($registro['Lugarcon']==1?' selected="selected" ':'').'>Establecimiento del proveedor</option>											
													<option value="2" '.($registro['Lugarcon']==2?' selected="selected" ':'').'>Local de la empresa</option>											
													</select>
													</td>
													</tr>

													

													<tr>
													<td>Proveedor:</td>
													<td>
													<select name="Proveedor" class="frm_cmb" />
													<option value="">Seleccione un Proveedor...</option>';
													require_once("./logica/log_proveedores.php");
													$resultado=log_obtener_proveedores_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Proveedor'])
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
													<td>Empleado que recibe:</td>
													<td>
													<select name="Codigoempl" class="frm_cmb" />
													<option value="">Seleccione un empleado...</option>';
													require_once("./logica/log_vendedores.php");
													$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
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
													<td>Afectar a partida contable No.:</td>
													<td>
													<select name="Partida" class="frm_cmb_long" />
													<option value="">Seleccione una partida...</option>';
													require_once("./logica/log_gastos.php");
													$resultado=log_obtener_partidas_cmb($_SESSION["idBodega"]);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Partida'])
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
													<td>(-)Descuento concedido:</td>
													<td><input type="text" class="frm_txt" name="Descuento" value="'.$registro['Descuento'].'" /></td>
													</tr>


			
													<tr>
													<td>(+)Focial:</td>
													<td><input type="text" class="frm_txt" name="Fovial" value="'.$registro['Fovial'].'" /></td>
													</tr>


													<tr>
													<td>(-)Renta:</td>
													<td><input type="text" class="frm_txt" name="Renta" value="'.$registro['Renta'].'" /></td>
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
											$Actualizar=true;
											$documento=false;
											if (trim($_POST['Documento'])!=""){$documento=true;}
											if ($documento==false)
											{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar el numero de la factura
														</div>';
														$Actualizar=false;
											}
											if ($Actualizar==true)
											{
														$resultado=log_actualizar_gasto($_POST,$registro['Tipo']);
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
												<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
												</tr>


												<tr>
												<td>Numero de documento de compra:</td>
												<td><input type="text" class="frm_txt" name="Documento" value="'.(isset($_POST['Documento'])?$_POST['Documento']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha del documento de compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
			
												<tr>
												<td>Lugar donde se recibe el servicio o insumo:</td>
												<td>
												<select name="Lugarcon" class="frm_cmb">
													<option value="1" '.(isset($_POST['Lugarcon'])?($_POST['Lugarcon']==1?' selected="selected" ':''):'').'>Establecimiento del proveedor</option>
													<option value="2" '.(isset($_POST['Lugarcon'])?($_POST['Lugarcon']==2?' selected="selected" ':''):'').'>Local de la empresa</option>
													</select>
												</td>
												</tr>

												
												<tr>
												<td>Proveedor:</td>
												<td>
												<select name="Proveedor" class="frm_cmb" />
												<option value="">Seleccione un Proveedor...</option>';
												require_once("./logica/log_proveedores.php");
												$resultado=log_obtener_proveedores_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["Proveedor"]))
												{
												if ($_POST["Proveedor"]==$fila['Codigo'])
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
												<td>Empleado que recibe:</td>
												<td>
												<select name="Codigoempl" class="frm_cmb" />
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
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb_long" />
												<option value="">Seleccione una partida...</option>';
												require_once("./logica/log_gastos.php");
												$resultado=log_obtener_partidas_cmb($bodx);
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["Partida"]))
												{
												if ($_POST["Partida"]==$fila['Codigo'])
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
												<td>(-) Descuento concedido:</td>
												<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												</tr>


												<tr>
												<td>(+)Fovial y Cotran:</td>
												<td><input type="text" class="frm_txt" name="Fovial" value="'.(isset($_POST['Fovial'])?$_POST['Fovial']:'').'" /></td>
												</tr>
												
												<tr>
												<td>(-)Renta (10% del valor total):</td>
												<td><input type="text" class="frm_txt" name="Renta" value="'.(isset($_POST['Renta'])?$_POST['Renta']:'').'" /></td>
												</tr>

												
												<td><input type="text" class="frm_txt_long" hidden="true" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
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
