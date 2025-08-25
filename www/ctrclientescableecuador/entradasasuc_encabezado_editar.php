<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Editar Encabezado de Entrada </title>
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
							<h3 class="title">Editar registro de ingreso de Articulos</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_entradasasuc.php");
									$tabla=log_obtener_entradaasuc($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradasasuc.php">';    
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
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de transferencia recibida:</td>
													<td><input type="text" class="frm_txt" name="Nenvior" readonly="readonly" value="'.$registro['Nenvior'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de recibido:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Sucursal que hizo el envio:</td>
													<td>
													<select name="Bodega_Origen" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Bodega_Origen'])
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
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;
												case '2':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de vale con el que salió el material:</td>
													<td><input type="text" class="frm_txt" name="Vale" readonly="readonly" value="'.$registro['Vale'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de devolución:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>

													<tr>
													<td>Tecnico que hace la devolución:</td>
													<td>
													<select name="Tecnico" class="frm_cmb" />
													<option value="">Seleccione un empleado...</option>';
													require_once("./logica/log_vendedores.php");
													$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$registro['Tecnico'])
														{
															echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
														}
														else
														{
															echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";														}

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
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
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
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entradaasuc($_POST,$registro['Tipo']);
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
												<td>Numero de transferencia recibida:</td>
												<td><input type="text" class="frm_txt" name="Nenvior" value="'.(isset($_POST['Nenvior'])?$_POST['Nenvior']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha de recibido:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Sucursal que hizo el envío:</td>
												<td>
												<select name="BodegaDes" class="frm_cmb" />
												<option value="">Seleccione una sucursal...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb2($_SESSION["idBodega"]);
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["BodegaDes"]))
												{
												if ($_POST["BodegaDes"]==$fila['Codigo'])
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												
												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
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
													$documento=false;
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entradaasuc($_POST,$registro['Tipo']);
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
												<td>Numero de vale con el que salió el material:</td>
												<td><input type="text" class="frm_txt" name="Vale" value="'.(isset($_POST['Vale'])?$_POST['Vale']:'').'" /></td>
												</tr>


												<tr>
												<td>Fecha de devolución:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>


												<tr>
												<td>Técnico que hace la devolución:</td>
												<td>
												<select name="Tecnico" class="frm_cmb" />
												<option value="">Seleccione un empleado...</option>';
												require_once("./logica/log_vendedores.php");
												$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>

										
												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
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
