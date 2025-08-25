<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar Detalle de gastos </title>
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
							<h3 class="title">Editar Detalle de factura de gastos</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_gastos.php");
									$parametros=$_SESSION['parametros'];
									//$codigo_gasto=$parametros['0'];
                                                                        //$tipo=$parametros['1'];


									$xcodigogasto=$_GET["id2"];
									$bodega=$_SESSION["idBodega"];
									$tabla=log_obtener_detalle_gasto($_GET["id2"],$_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$tipo=$registro["Tipofac"];
									$insertar=true;


								       if($xcodigogasto!="")
	                                				    {
									     $_SESSION['$xcodigogasto1']=$xcodigogasto;
				                                            }  
									     ELSE
	                                				    {
					                                      $xcodigogasto=$_SESSION['$xcodigogasto1'];
					                                    }  




									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php">';    
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
											<td>Tipo de gasto:</td>
											<td>
												<select name="Tipogas" disabled="true" class="frm_cmb" />
												<option value="">Seleccione un tipo de gasto...</option>';
												require_once("./logica/log_gastos.php");
												$resultado=log_obtener_tipogas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
													if ($registro["Tipogas"]==$fila['Codigo'])
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
											<td>Mas detalles del gasto:</td>
											<td><input type="text" class="frm_txt_long" name="Detalles" value="'.$registro["Detalles"].'" /></td>
											</tr>

											<tr>
											<td>Lugar de consumo del gasto:</td>
											<td><input type="text" class="frm_txt" name="Consumo" value="'.$registro["Consumo"].'" /></td>
											</tr>

											<tr>
											<td>Placa del vehiculo (si es combustible):</td>
											<td><input type="text" class="frm_txt" name="Placa" value="'.$registro["Placa"].'" /></td>
											</tr>

											<tr>
											<td>Kilometraje Inicial (si es combustible):</td>
											<td><input type="text" class="frm_txt" name="K1" value="'.$registro["K1"].'" /></td>
											</tr>

											<tr>
											<td>Kilometraje final (si es combustible):</td>
											<td><input type="text" class="frm_txt" name="K2" value="'.$registro["K2"].'" /></td>
											</tr>

											<tr>
											<td>Zona a trabajar (si es pago de pasajes):</td>
											<td><input type="text" class="frm_txt_long" name="Zona" value="'.$registro["Zona"].'" /></td>
											</tr>

											<tr>
											<td>Periodo de corte (si es pago de energia electrica):</td>
											<td><input type="text" class="frm_txt_long" name="Corte" value="'.$registro["Corte"].'" /></td>
											</tr>

											<tr>
											<td>NIC (si es pago de energia electrica):</td>
											<td><input type="text" class="frm_txt" name="Nic" value="'.$registro["Nic"].'" /></td>
											</tr>

											<tr>
											<td>Costo Unitario:</td>
											<td><input type="text" class="frm_txt" name="Costou" value="'.$registro["Costou"].'" /></td>
											</tr>

											<tr>
											<td>Cantidad:</td>
											<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'" /></td>
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
											require_once("./utils/validar_datos.php");
											if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la cantidad para el Detalle de gasto 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(Validar_Decimales_Positivos($_POST['Cantidad'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Cantidad solo adminte montos numéricos mayores que cero
												</div>';
												$insertar=false;
												}
											}
											if (isset($_POST['Costou'])==false or $_POST['Costou']=="" OR $_POST['Costou']==0)
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el precio Unitario 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(validar_decimales($_POST['Costou'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Precio solo adminte montos numéricos
												</div>';
												$insertar=false;
												}											
											}
											if ($insertar==true)
											{
												$resultado=log_actualizar_gasto_detalle($_POST,$xcodigogasto,$_GET["id"],$registro["Cantidad"],$bodega,$tipo);
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
												<td>Tipo de gasto:</td>
												<td>
												<select name="Tipogas" disabled="true" class="frm_cmb" />
												<option value="">Seleccione un tipo de gasto...</option>';
												require_once("./logica/log_gastos.php");
												$resultado=log_obtener_tipogas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["Tipogas"]))
												{
												if ($_POST["Tipogas"]==$fila['Codigo'])
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
									<td>Mas detalles del gasto:</td>
									<td><input type="text" class="frm_txt_long" name="Detalle" value="'.(isset($_POST['Detalle'])?$_POST['Detalle']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Lugar de consumo del gasto:</td>
									<td><input type="text" class="frm_txt_long" name="Consumo" value="'.(isset($_POST['Consumo'])?$_POST['Consumo']:'').'" /></td>
									</tr>


									<tr>
									<td>Placa del vehiculo (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="Placa" value="'.(isset($_POST['Placa'])?$_POST['Placa']:'').'" /></td>
									</tr>

									<tr>
									<td>Kilometraje Inicial (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="K1" value="'.(isset($_POST['K1'])?$_POST['K1']:'').'" /></td>
									</tr>


									<tr>
									<td>Kilometraje Final (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="K2" value="'.(isset($_POST['K2'])?$_POST['K2']:'').'" /></td>
									</tr>

									<tr>
									<td>Zona a trabajar (si es pago de pasajes):</td>
									<td><input type="text" class="frm_txt_long" name="Zona" value="'.(isset($_POST['Zona'])?$_POST['Zona']:'').'" /></td>
									</tr>



									<tr>
									<td>Periodo de corte (si es pago de energia electrica):</td>
									<td><input type="text" class="frm_txt_long" name="Corte" value="'.(isset($_POST['Corte'])?$_POST['Corte']:'').'" /></td>
									</tr>


									<tr>
									<td>NIC (si es pago de energia electrica):</td>
									<td><input type="text" class="frm_txt" name="Nic" value="'.(isset($_POST['Nic'])?$_POST['Nic']:'').'" /></td>
									</tr>


									<tr>
									<td>Costo Unitario:</td>
									<td><input type="text" class="frm_txt" name="Costou" value="'.(isset($_POST['Costou'])?$_POST['Costou']:'').'" /></td>
									</tr>


									<tr>
									<td>Cantidad:</td>
									<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
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
