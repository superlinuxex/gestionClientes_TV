<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Gastos por insumos y servicios </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />

<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fecha').datepicker({
			inline: true
		});
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
</script>


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
							<h3 class="title">Ingreso de gastos por insumos y servicios</a></h3>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];

										require_once("logica/log_gastos.php");
										$id_nueva_gasto="Inicio";
										if (isset ($_POST['tipo']))
										{
											$tipo=$_POST['tipo'];
										}
										else
										{
											$tipo=$_GET['tipo'];
										}
										switch ($tipo)
										{
											case '1':/*con factura*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Documento'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar Número del documento que respalda el gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														No puede dejar en blanco el dato de proveedor
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														No puede dejar en blanco el dato de partida
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Codigoempl'])==false or $_POST['Codigoempl']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe indicar el empleado responsable
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar la fecha del movimiento de gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Descuento'])!="")
													{
													 if (isset($_POST['Descuento'])<0)
													  {
													   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													   Kilometraje inicial debe ser numerico
													   </div>';
													   $insertar=false;										
													  }
													}


													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_gasto*/
														$params[1]=$tipo;/*tipo gasto*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['Lugarcon'];
														$params[5]=$_POST['Proveedor'];
														$params[6]=$_POST['Partida'];
														$params[7]=$_POST['Documento'];
														$params[8]=$_POST['Fovial'];
														$params[9]=null;
														$params[10]=null;
														$params[11]=$_POST['Observaciones'];
														$params[12]=$_POST['Justifica'];
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Renta'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];
	                                                                                                        $params[17]=$_POST['Remesa'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$_POST['Partida'];
												$_SESSION['documento']=$_POST['Documento'];
												$_SESSION['fovial']=$_POST['Fovial'];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];
												$_SESSION['remesa']=$params[17];


														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha50.'">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Gasto con factura de consumidor final</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_gasto.'" /></td>
												</tr>

												<tr>
												<td>Numero de Factura:</td>
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
												$resultado=log_obtener_vendedores_cmb1();
												while ( $fila = mysql_fetch_array($resultado))
												{
												 if (isset($_POST["Codigoempl"]))
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
												 echo "<option value='".$fila['Codigo']."'>".$fila['Codigo']." - ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												<tr>
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb" />
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
												<td>Justificacion del gasto:</td>
												<td><input type="text" class="frm_txt_long" name="Justifica" value="'.(isset($_POST['Justifica'])?$_POST['Justifica']:'').'" /></td>
												</tr>


												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>

												<td><input type="text" class="frm_txt" hidden="true" name="Renta" value="'.(isset($_POST['Renta'])?$_POST['Renta']:'').'" /></td>
												<td><input type="text" class="frm_txt" hidden="true" name="Remesa" value="'.(isset($_POST['Remesa'])?$_POST['Remesa']:'').'" /></td>
												
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;

											case '2':/*credito fiscal*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Documento'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número del documento que respalda el gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el datos de proveedor
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el dato de partida
														</div>';
														$insertar=false;
													}


													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de gasto
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{



														$params[0]=$_POST['Codigo'];/*Codigo_gasto*/
														$params[1]=$tipo;/*tipo gasto*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['Lugarcon'];
														$params[5]=$_POST['Proveedor'];
														$params[6]=$_POST['Partida'];
														$params[7]=$_POST['Documento'];
														$params[8]=$_POST['Fovial'];
														$params[9]=null;
														$params[10]=null;
														$params[11]=$_POST['Observaciones'];
														$params[12]=$_POST['Justifica'];
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Renta'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$_POST['Partida'];
												$_SESSION['documento']=$params[7];
												$_SESSION['fovial']=$_POST['Fovial'];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];

														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha50.'">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Gasto con Credito Fiscal</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_gasto.'" /></td>
												</tr>

												<tr>
												<td>Numero Credito Fiscal:</td>
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
												$resultado=log_obtener_vendedores_cmb1();
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']." - ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												<tr>
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb" />
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

												
												<tr>
												<td>Justificacion del gasto:</td>
												<td><input type="text" class="frm_txt_long" name="Justifica" value="'.(isset($_POST['Justifica'])?$_POST['Justifica']:'').'" /></td>
												</tr>


												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;
											case '3':/*Recibo*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Documento'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número del documento que respalda el gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el datos de proveedor
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el dato de partida
														</div>';
														$insertar=false;
													}


													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de gasto
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_gasto*/
														$params[1]=$tipo;/*tipo gasto*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['Lugarcon'];
														$params[5]=$_POST['Proveedor'];
														$params[6]=$_POST['Partida'];
														$params[7]=$_POST['Documento'];
														$params[8]=$_POST['Fovial'];
														$params[9]=null;
														$params[10]=null;
														$params[11]=$_POST['Observaciones'];
														$params[12]=$_POST['Justifica'];
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Renta'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$_POST['Partida'];
												$_SESSION['documento']=$params[7];
												$_SESSION['fovial']=$_POST['Fovial'];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];

														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha50.'">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Gasto con Recibo</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_gasto.'" /></td>
												</tr>

												<tr>
												<td>Numero de Recibo:</td>
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
												$resultado=log_obtener_vendedores_cmb1();
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']." - ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												<tr>
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb" />
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
												<td>(-)Renta (10% del valor total):</td>
												<td><input type="text" class="frm_txt" name="Renta" value="'.(isset($_POST['Renta'])?$_POST['Renta']:'').'" /></td>
												</tr>


												<tr>
												<td>Justificacion del gasto:</td>
												<td><input type="text" class="frm_txt_long" name="Justifica" value="'.(isset($_POST['Justifica'])?$_POST['Justifica']:'').'" /></td>
												</tr>


												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>



												<td><input type="text" class="frm_txt" hidden="true" name="Fovial" value="'.(isset($_POST['Fovial'])?$_POST['Fovial']:'').'" /></td>




												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;

											case '4':/*Tiket*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Documento'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número del documento que respalda el gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el datos de proveedor
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el dato de partida
														</div>';
														$insertar=false;
													}


													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de gasto
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_gasto*/
														$params[1]=$tipo;/*tipo gasto*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['Lugarcon'];
														$params[5]=$_POST['Proveedor'];
														$params[6]=$_POST['Partida'];
														$params[7]=$_POST['Documento'];
														$params[8]=$_POST['Fovial'];
														$params[9]=null;
														$params[10]=null;
														$params[11]=$_POST['Observaciones'];
														$params[12]=$_POST['Justifica'];
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Renta'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$_POST['Partida'];
												$_SESSION['documento']=$params[7];
												$_SESSION['fovial']=$_POST['Fovial'];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];
														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha50.'">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Gasto con ticket</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_gasto.'" /></td>
												</tr>

												<tr>
												<td>Numero de Ticket:</td>
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
												$resultado=log_obtener_vendedores_cmb1();
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
												 echo "<option value='".$fila['Codigo']."'>".$fila['Codigo']." -  ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												<tr>
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb" />
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



												<td><input type="text" class="frm_txt" hidden="true" name="Fovial" value="'.(isset($_POST['Fovial'])?$_POST['Fovial']:'').'" /></td>
												<td><input type="text" class="frm_txt" hidden="true" name="Renta" value="'.(isset($_POST['Renta'])?$_POST['Renta']:'').'" /></td>


												<tr>
												<td>Justificacion del gasto:</td>
												<td><input type="text" class="frm_txt_long" name="Justifica" value="'.(isset($_POST['Justifica'])?$_POST['Justifica']:'').'" /></td>
												</tr>


												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;
											case '5':/*Vale*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Documento'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número del documento que respalda el gasto
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el datos de proveedor
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No puede dejar en blanco el dato de partida
														</div>';
														$insertar=false;
													}


													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de gasto
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_gasto*/
														$params[1]=$tipo;/*tipo gasto*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['Lugarcon'];
														$params[5]=$_POST['Proveedor'];
														$params[6]=$_POST['Partida'];
														$params[7]=$_POST['Documento'];
														$params[8]=$_POST['Fovial'];
														$params[9]=null;
														$params[10]=null;
														$params[11]=$_POST['Observaciones'];
														$params[12]=$_POST['Justifica'];
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Renta'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$_POST['Partida'];
												$_SESSION['documento']=$params[7];
												$_SESSION['fovial']=$_POST['Fovial'];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];

														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha50.'">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Gasto con Vale</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_gasto.'" /></td>
												</tr>

												<tr>
												<td>Numero de Vale:</td>
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
												$resultado=log_obtener_vendedores_cmb1();
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']." - ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
												 }
												}
												echo'
												</td>									
												</tr>


												<tr>
												<td>Afectar a partida contable No.:</td>
												<td>
												<select name="Partida" class="frm_cmb" />
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



												<td><input type="text" class="frm_txt" hidden="true" name="Fovial" value="'.(isset($_POST['Fovial'])?$_POST['Fovial']:'').'" /></td>
												<td><input type="text" class="frm_txt" hidden="true" name="Renta" value="'.(isset($_POST['Renta'])?$_POST['Renta']:'').'" /></td>


												<tr>
												<td>Justificacion del gasto:</td>
												<td><input type="text" class="frm_txt_long" name="Justifica" value="'.(isset($_POST['Justifica'])?$_POST['Justifica']:'').'" /></td>
												</tr>


												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt_long" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;
											default:
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos.php">';
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