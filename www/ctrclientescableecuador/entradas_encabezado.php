<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Entrada de Articulos </title>
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
							<h3 class="title">Ingreso de articulos en bodega central</a></h3>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];

										require_once("logica/log_entradas.php");
										$id_nueva_entrada=log_obtener_cod_entrada();
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
											case '1':/*CON CREDITO FISCAL*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['RegFiscal'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número de Registro  Fiscal obligatoriamente
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar proveedor obligatoriamente
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de entrada
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_entrada*/
														$params[1]=$tipo;/*tipo entrada*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=null;/*Codigo_bodega_sal*/
														$params[5]=$_POST['Proveedor'];
														$params[6]=null;/*$_POST['Nenvior'];*/
														$params[7]=$_POST['RegFiscal'];/*RegFiscal*/
														$params[8]=null;/*$_POST['Factura'];*/
														$params[9]=null;/*$_POST['Poliza'];*/
														$params[10]=null;/*$_POST['Ajuste'];*/
														$params[11]=$_POST['Observaciones'];
														$params[12]=null;/*$_POST['Ntransr'];*/
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Ivap'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];



														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Compra local con Credito Fiscal</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
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
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;
											case '2':/*COMPRAS CON FACTURA DE CONSUMIDOR FINAL*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Factura'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número de Factura de compra
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de entrada
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_entrada*/
														$params[1]=$tipo;/*tipo entrada*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=null;/*Codigo_bodega_sal*/
														$params[5]=$_POST['Proveedor'];
														$params[6]=null;/*$_POST['Nenvior'];*/
														$params[7]=null;/*$_POST['RegFiscal'];*/
														$params[8]=$_POST['Factura'];
														$params[9]=null;/*$_POST['Poliza'];*/
														$params[10]=null;/*$_POST['Ajuste'];*/
														$params[11]=$_POST['Observaciones'];
														$params[12]=null;/*$_POST['Ntransr'];*/
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Ivap'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];



														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Compra local con Factura de Consumidor Final</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
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
												  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";												 }
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
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;

											case '3':/*COMPRAS DE IMPORTACION*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Poliza'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar Número de la poliza
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de entrada
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_entrada*/
														$params[1]=$tipo;/*tipo entrada*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=null;/*Codigo_bodega_sal*/
														$params[5]=$_POST['Proveedor'];
														$params[6]=null;/*$_POST['Nenvior'];*/
														$params[7]=null;/*$_POST['RegFiscal'];*/
														$params[8]=null;/*$_POST['Factura'];*/
														$params[9]=$_POST['Poliza'];
														$params[10]=null;/*$_POST['Ajuste'];*/
														$params[11]=$_POST['Observaciones'];
														$params[12]=null;/*$_POST['Ntransr'];*/
                                                                                                                $params[13]=$_POST['Fecha'];
	                                                                                                        $params[14]=$_POST['Ivap'];
	                                                                                                        $params[15]=$_POST['Codigoempl'];
	                                                                                                        $params[16]=$_POST['Descuento'];



														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Compra de importacion</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
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
												  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";												 }
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
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;



											case '4':/*Devolucion de cliente*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													$documento=false;
													if (trim($_POST['Factura'])!="")
													{
														$documento=true;
													}
													if ($documento==false)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar numero de factura con la que vendio al cliente
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de entrada
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_entrada*/
														$params[1]=$tipo;/*tipo entrada*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=null;/*Codigo_bodega_sal*/
														$params[5]=$_POST['Proveedor'];/*Codigo_Proveedor*/
														$params[6]=$_POST['Cliente'];/*NOrden*/
														$params[7]=null;/*RegFiscal*/
														$params[8]=$_POST['Factura'];/*Factura*/
														$params[9]=$_POST['Poliza'];/*Poliza*/
														$params[10]=$_POST['Remision'];/*Remision*/
														$params[11]=null;/*transf_origen*/
														$params[12]=$_POST['Observaciones'];/*Observaciones*/
                                                                                                                $params[13]=$_POST['Fecha'];

														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


												<tr>
												<h1>Por devolucion de un cliente</h1>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
												</tr>
												
												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
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
									<td>
										<select name="Cliente" class="frm_cmb" />
										<option value="">Seleccione un cliente de la lista...</option>';
										require_once("./logica/log_idenpaci.php");
										$resultado=log_obtener_idenpaci_cmb($bodx);
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Cliente"]))
											{
												if ($_POST["Cliente"]==$fila['Codigo'])
												{
												echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombres'].'</option>';
												}
												else
												{
													echo "<option value='".$fila['Codigo']."'> ".$fila['Nombres']."</option>";
												}
											}
											else
											{
												echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."&nbsp".$fila['Apellidos']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>


												<td><input type="text" class="frm_txt" hidden="true" readonly="readonly" name="NOrden" value="'.(isset($_POST['NOrden'])?$_POST['NOrden']:'').'" /></td>

												<tr>
												<td>Factura de compra:</td>
												<td><input type="text" class="frm_txt" name="Factura" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'" /></td>
												</tr>
												
												<td><input type="text" class="frm_txt" hidden="true" readonly="readonly" name="Poliza" value="'.(isset($_POST['Poliza'])?$_POST['Poliza']:'').'" /></td>

												<td><input type="text" class="frm_txt" hidden="true" readonly="readonly" name="Remision" value="'.(isset($_POST['Remision'])?$_POST['Remision']:'').'" /></td>
												
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
											case '5':/*transferencia o devoluciones de sucursales*/ 
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de entrada
														</div>';
														$insertar=false;
													}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_entrada*/
														$params[1]=$tipo;/*tipo entrada*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_ent*/
														$params[4]=$_POST['BodegaSal'];/*Codigo_bodega_sal*/
														$params[5]=null;/*Codigo_Proveedor*/
														$params[6]=null;/*NOrden*/
														$params[7]=null;/*RegFiscal*/
														$params[8]=null;/*Factura*/
														$params[9]=null;/*Poliza*/
														$params[10]=$_POST['Remision'];/*Remision*/
														$params[11]=null;/*transf_origen*/
														$params[12]=$_POST['Observaciones'];/*Observaciones*/
                                                                                                                $params[13]=$_POST['Fecha'];

														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


												<tr>
												<h1>Por transferencia de sucursal o inventario inicial</h1>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
												</tr>
												
												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Sucursal que recibio mercaderia:</td>
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
												<td>Sucursal que envio mercadería:</td>
												<td>
												<select name="BodegaSal" class="frm_cmb" />
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb2($_SESSION["idBodega"]);
												while ( $fila = mysql_fetch_array($resultado))
												{
												 if (isset($_POST["BodegaSal"]))
												 {
												  if ($_POST["BodegaSal"]==$fila['Codigo'])
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
												<td>Numero de envio (si existe):</td>
												<td><input type="text" class="frm_txt" name="Remision" value="'.(isset($_POST['Remision'])?$_POST['Remision']:'').'" /></td>
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradas.php">';
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