<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar Encabezado de Entrada </title>
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
							<h3 class="title">Editar REGISTRO DE COMPRAS de Articulos</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_entradas.php");
									$tabla=log_obtener_entrada($_GET["id"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas.php">';    
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
													<td>Numero de Credito Fiscal:</td>
													<td><input type="text" class="frm_txt" name="RegFiscal" readonly="readonly" value="'.$registro['RegFiscal'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega que recibe:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Descuento concedido:</td>
													<td><input type="text" class="frm_txt" name="Descuento" value="'.$registro['Descuento'].'" /></td>
													</tr>


			
													<tr>
													<td>IVA percepción:</td>
													<td><input type="text" class="frm_txt" name="Ivap" value="'.$registro['Ivap'].'" /></td>
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
													<td>Numero de Factura:</td>
													<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$registro['Factura'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega que recibe:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Descuento concedido:</td>
													<td><input type="text" class="frm_txt" name="Descuento" value="'.$registro['Descuento'].'" /></td>
													</tr>


			

													<tr>
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;
												case '3':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de Poliza:</td>
													<td><input type="text" class="frm_txt" name="Poliza" readonly="readonly" value="'.$registro['Poliza'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega que recibe:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Descuento concedido:</td>
													<td><input type="text" class="frm_txt" name="Descuento" value="'.$registro['Descuento'].'" /></td>
													</tr>


			

													<tr>
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;



												case '4':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de Credito Fiscal:</td>
													<td><input type="text" class="frm_txt" name="RegFiscal" readonly="readonly" value="'.$registro['RegFiscal'].'" /></td>
													</tr>

													<tr>
													<td>Fecha de documento de compra:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Bodega que recibe:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Descuento concedido:</td>
													<td><input type="text" class="frm_txt" name="Descuento" value="'.$registro['Descuento'].'" /></td>
													</tr>


			
													<tr>
													<td>IVA percepción:</td>
													<td><input type="text" class="frm_txt" name="Ivap" value="'.$registro['Ivap'].'" /></td>
													</tr>

													<tr>
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;

												case '5':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Sucursal que recibio:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Cliente que devuelve:</td>
													<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente" value="'.$registro['NOrden'].'" /></td>
													<td>

													<tr>
													<td>Factura de venta:</td>
													<td><input type="text" class="frm_txt" name="Factura" value="'.$registro['Factura'].'" /></td>
													</tr>
										
										
													<tr>
													<td>Observaciones:</td>
													<td><input type="text" class="frm_txt" name="Observaciones" value="'.$registro['Observaciones'].'" /></td>
													</tr>';
												break;
												case '6':
													echo '
													<tr>
													<td><input type="text" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" hidden="true" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Fecha:</td>
													<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
													</tr>
													
													<tr>
													<td>Sucursal que recibe:</td>
													<td>
													<select name="Bodega" class="frm_cmb" disabled=disabled/>
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($fila['Codigo']==$_SESSION["idBodega"])
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
													<td>Sucursal que envió:</td>
													<td>
													<select name="BodegaOrigen" class="frm_cmb" />
													<option value="">Seleccione una Bodega...</option>';
													require_once("./logica/log_bodegas.php");
													$resultado=log_obtener_bodegas_cmb2($_SESSION["idBodega"]);
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
													<td>Numero de envio (si existe):</td>
													<td><input type="text" class="frm_txt" name="Remision" value="'.$registro['Remision'].'" /></td>
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
													$documento=false;
													if (trim($_POST['RegFiscal'])!=""){$documento=true;}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el numero del Registro Fiscal
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
												<td>Numero de Credito Fiscal:</td>
												<td><input type="text" class="frm_txt" name="RegFiscal" value="'.(isset($_POST['RegFiscal'])?$_POST['RegFiscal']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha de documento de compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Bodega que recibe:</td>
												<td>
												<select name="Bodega" class="frm_cmb" disabled=disabled/>
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
													if ($fila['Codigo']==$_SESSION["idBodega"])
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
												<td>Descuento concedido:</td>
												<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												</tr>


												<tr>
												<td>IVA percepción:</td>
												<td><input type="text" class="frm_txt" name="Ivap" value="'.(isset($_POST['Ivap'])?$_POST['Ivap']:'').'" /></td>
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
													if (trim($_POST['Factura'])!=""){$documento=true;}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el numero de factura
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
												<td>Numero de Factura:</td>
												<td><input type="text" class="frm_txt" name="Factura" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha de documento de compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Bodega que recibe:</td>
												<td>
												<select name="Bodega" class="frm_cmb" disabled=disabled/>
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
													if ($fila['Codigo']==$_SESSION["idBodega"])
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
												<td>Descuento concedido:</td>
												<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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

												case '3':
													$Actualizar=true;
													$documento=false;
													if (trim($_POST['Poliza'])!=""){$documento=true;}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el numero de poliza
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
												<td>Numero de Poliza:</td>
												<td><input type="text" class="frm_txt" name="Poliza" value="'.(isset($_POST['Poliza'])?$_POST['Poliza']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha de documento de compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Bodega que recibe:</td>
												<td>
												<select name="Bodega" class="frm_cmb" disabled=disabled/>
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
													if ($fila['Codigo']==$_SESSION["idBodega"])
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
												<td>Descuento concedido:</td>
												<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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



												case '4':
													$Actualizar=true;
													$documento=false;
													if (trim($_POST['RegFiscal'])!=""){$documento=true;}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el numero del Registro Fiscal
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
												<td>Numero de Credito Fiscal:</td>
												<td><input type="text" class="frm_txt" name="RegFiscal" value="'.(isset($_POST['RegFiscal'])?$_POST['RegFiscal']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Fecha de documento de compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Bodega que recibe:</td>
												<td>
												<select name="Bodega" class="frm_cmb" disabled=disabled/>
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
													if ($fila['Codigo']==$_SESSION["idBodega"])
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
												<td>Descuento concedido:</td>
												<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												</tr>



												<tr>
												<td>IVA o impuesto obligatorio:</td>
												<td><input type="text" class="frm_txt" name="Iva" value="'.(isset($_POST['Iva'])?$_POST['Iva']:'').'" /></td>
												</tr>


												<tr>
												<td>IVA percepción:</td>
												<td><input type="text" class="frm_txt" name="Ivap" value="'.(isset($_POST['Ivap'])?$_POST['Ivap']:'').'" /></td>
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

												case '5':
													$Actualizar=true;
													$documento=false;
													if (trim($_POST['Poliza'])!=""){$documento=true;}
													if (trim($_POST['Factura'])!=""){$documento=true;}
													if (trim($_POST['Remision'])!=""){$documento=true;}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar al menos uno de los siquiente documnetos: Poliza, Factura, Numero de Remision.
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
																<td>Fecha:</td>
																<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
																</tr>
																
																<tr>
																<td>Sucursal que recibe:</td>
																<td>
																<select name="Bodega" class="frm_cmb" disabled=disabled/>
																<option value="">Seleccione una Bodega...</option>';
																require_once("./logica/log_bodegas.php");
																$resultado=log_obtener_bodegas_cmb();
																while ( $fila = mysql_fetch_array($resultado))
																{
																	if ($fila['Codigo']==$_SESSION["idBodega"])
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
																<td>Cliente que devuelve:</td>
																<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente" value="'.(isset($_POST['Cliente'])?$_POST['Cliente']:'').'" /></td>
																</tr>

																<tr>
																<td>Factura de venta:</td>
																<td><input type="text" class="frm_txt" name="Factura" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'" /></td>
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
												case '6':
													$Actualizar=true;
													if (isset($_POST['BodegaOrigen'])==false or $_POST['BodegaOrigen']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe seleccionar una Bodega de Origen para la Transferencia que desea ingresar.
														</div>';
														$Actualizar=false;
													}
													if ($Actualizar==true)
													{
														$resultado=log_actualizar_entrada($_POST,$registro['Tipo']);
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
																<td>Fecha:</td>
																<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
																</tr>
																
																<tr>
																<td>Sucursal que recibe:</td>
																<td>
																<select name="Bodega" class="frm_cmb" disabled=disabled/>
																<option value="">Seleccione una Bodega...</option>';
																require_once("./logica/log_bodegas.php");
																$resultado=log_obtener_bodegas_cmb();
																while ( $fila = mysql_fetch_array($resultado))
																{
																	if ($fila['Codigo']==$_SESSION["idBodega"])
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
																<td>Sucursal que envió:</td>
																<td>
																<select name="BodegaOrigen" class="frm_cmb" />
																<option value="">Seleccione una Bodega...</option>';
																require_once("./logica/log_bodegas.php");
																$resultado=log_obtener_bodegas_cmb();
																while ( $fila = mysql_fetch_array($resultado))
																{
																	if ($fila['Codigo']==(isset($_POST['BodegaOrigen'])?$_POST['BodegaOrigen']:''))
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
																<td>Numero de envio (si existe):</td>
																<td><input type="text" class="frm_txt" name="Remision" value="'.(isset($_POST['Remision'])?$_POST['Remision']:'').'" /></td>
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
