<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Salida de Articulos </title>
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

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fecha2').datepicker({
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
							<h3 class="title">Movimientos de Salida del inventario</a></h3>
							<div class="entry">
								<div id="itsthetable">
             	                                	<?php
										$bodx=$_SESSION["idBodega"];
										require_once("logica/log_salidas.php");
										$id_nueva_salida=log_obtener_cod_salida3();
   										$id_vale=log_obtener_cod_vale3($bodx);

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
											case '1':/*transferencia*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de salida
														</div>';
														$insertar=false;
													}

													if (isset($_POST['BodegaDes'])==false or $_POST['BodegaDes']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe seleccionar la sucursal de destino para la Transferencia que desea ingresar.
														</div>';
														$insertar=false;
													}

												if (isset($_POST['Autoriza'])==false or $_POST['Autoriza']=="")
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar el nombre de la persona que autoriza la salida del material
													</div>';
													$insertar=false;
												}

													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
														$params[0]=log_obtener_cod_salida();/*toma el verdadero correlativo del movimiento*/
														$params[1]=$tipo;/*tipo Salida*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
														$params[4]=$_POST['BodegaDes'];/*Codigo_bodega_ent*/
														$params[5]=null;/*Codigo_vale*/
														$params[6]=null;/*Codigo_devo*/
														$params[7]=null;/*Codigo_PROVEEDOR*/
														$params[8]=$_POST['Crf'];/*numero de envio*/
														$params[9]=$_POST['Cod_tecnico'];
														$params[10]=null;/*Codigo_REMISION*/
														$params[11]=null;/*Codigo_MOTIVO*/
														$params[12]=$_POST['Autoriza'];/*au*/
														$params[13]=$_POST['Observaciones'];/*Observaciones*/
														$params[14]=$_POST['Fecha'];
														$params[15]=null;


													
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
													}									
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Por envio o transferencia a otra sucursal</h3>
 												</tr>
												
												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>

												<tr>
												<td>Numero de transferencia o envío:</td>
												<td><input type="text" class="frm_txt" name="Crf" value="'.$id_vale.'"/></td>
												</tr>

												
												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Sucursal Origen (la que esta despachando):</td>
												<td>
												<select name="Bodega" class="frm_cmb" disabled=disabled/>
												<option value="">Seleccione una sucursal...</option>';
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
												<td>Sucursal Destino (a quien le enviamos):</td>
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
									<td>Empleado que entrega:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
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
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>


									<tr>
									<td>Empleado que recibe:</td>
									<td>
										<select name="Cod_tecnico" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb2();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Cod_tecnico"]))
											{
												if ($_POST["Cod_tecnico"]==$fila['Codigo'])
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
											case '2':/*Devolucion a proveedor*/
											if (isset ($_POST['aceptar']))
												{
												 $insertar=true;
  												 require_once("./logica/log_salidas.php");
												 $resultado=log_validar_docu_provee($_POST['Proveedor'],$_POST['CRF'],$_SESSION["idBodega"]);
	  											 if ($resultado==0)
												  {
												   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												   Error: No existe documento de entradas a bodega con los datos que ha digitado	
												   </div>';
												   $insertar=false;
                                                                                                  }

												
												 if (isset($_POST['Proveedor'])==false or $_POST['Proveedor']=="")
												 {
												 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												 Debe seleccionar un Proveedor para el Detalle de Salida que desea ingresar.
												 </div>';
												 $insertar=false;
												 }

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de salida
														</div>';
														$insertar=false;
													}

												if (isset($_POST['Autoriza'])==false or $_POST['Autoriza']=="")
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar  persona que autoriza la salida del material
													</div>';
													$insertar=false;
												}



												 if (isset($_POST['MOTIVO'])==false or $_POST['MOTIVO']=="")
												 {
												 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												 Debe seleccionar un motivo que justifique la devolución a ingresar.
												 </div>';
												 $insertar=false;
												 }


												 if ($insertar==true)
												  {
													$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
													$params[0]=log_obtener_cod_salida();/*toma el verdadero correlativo del movimiento*/
													$params[1]=$tipo;/*tipo Salida*/
													$params[2]=$_SESSION["idusuarios"];/*idusuario*/
													$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
													$params[4]=null;/*Codigo_bodega_ent*/
													$params[5]=null;/*vale*/ 
													$params[6]=$_POST['NOTADE'];
													$params[7]=$_POST['Proveedor'];/*proveedor*/
													$params[8]=$_POST['CRF'];/*CFR CREDITO FISCAL*/
													$params[9]=null;
													$params[10]=null;
													$params[11]=$_POST['MOTIVO'];
													$params[12]=$_POST['Autoriza'];/*au*/
													$params[13]=$_POST['Observaciones'];/*Observaciones*/
													$params[14]=$_POST['Fecha'];
													$params[15]=$_POST['Fecha2'];
														
													$_SESSION['parametros']=$params;
													
													echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
                                                                                                   }
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Por Devolución a proveedor</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>
												

												<tr>
												<td>Nota de Devolución No.:</td>
												<td><input type="text" class="frm_txt" name="NOTADE" value="'.(isset($_POST['NOTADE'])?$_POST['NOTADE']:'').'" /></td>
												</tr>

												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												
												<tr>
												<td>Fecha de la compra:</td>
												<td><input type="text" class="frm_txt" id="Fecha2" name="Fecha2" value="'.(isset($_POST['Fecha2'])?$_POST['Fecha2']:'').'"/></td>
												</tr>

												<tr>
												<td>Sucursal que devuelve:</td>
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
												$resultado=dat_obtener_proveedores_cmb();
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
												<td>Cr.Fiscal de Ingreso:</td>
												<td><input type="text" class="frm_txt" name="CRF" value="'.(isset($_POST['CRF'])?$_POST['CRF']:'').'" /></td>
												</tr>

												
												<tr>
												<td>Motivo de la Devolución:</td>
												<td>
												<select name="MOTIVO" class="frm_cmb" />
												<option value="">Seleccione un Motivo...</option>';
												require_once("./logica/log_motivos.php");
												$resultado=dat_obtener_motivos_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["MOTIVO"]))
												{
													if ($_POST["MOTIVO"]==$fila['Codigo'])
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
									<td>Autoriza devolucion:</td>
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
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>




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

											case '3':/*Entrega a tecnicos*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Autoriza'])==false or $_POST['Autoriza']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar persona que autoriza
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de salida
														</div>';
														$insertar=false;
													}


													if ($insertar==true)
													{

													$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
													$params[0]=log_obtener_cod_salida();/*toma el verdadero correlativo del movimiento*/
													$params[1]=$tipo;/*tipo Salida*/
													$params[2]=$_SESSION["idusuarios"];/*idusuario*/
													$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
													$params[4]=null;/*Codigo_bodega_ent*/
													$params[5]=$_POST['Vale'];
													$params[6]=null;
													$params[7]=null;
													$params[8]=null;
													$params[9]=$_POST['Tecnico'];
													$params[10]=null;
													$params[11]=null;
													$params[12]=$_POST['Autoriza'];/*au*/
													$params[13]=$_POST['Observaciones'];/*Observaciones*/
													$params[14]=$_POST['Fecha'];
													$params[15]=$_POST['Fecha2'];
														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Por entrega de materiales a técnicos para atencion a clientes</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>
												

												<tr>
												<td>Vale de salida No.:</td>
												<td><input type="text" class="frm_txt" name="Vale" value="'.(isset($_POST['Vale'])?$_POST['Vale']:'').'" /></td>
												</tr>

												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												

												<tr>
												<td>Sucursal que entrega los materiales:</td>
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
									<td>Técnico que recibe:</td>
									<td>
										<select name="Tecnico" class="frm_cmb" />
										<option value="">Seleccione un tecnico de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
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
									<td>Autoriza la entrega:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
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
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>




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
											case '4':/*Entrega para mantenimiento de red*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Autoriza'])==false or $_POST['Autoriza']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar persona que autoriza
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha del movimiento de salida
														</div>';
														$insertar=false;
													}


													if ($insertar==true)
													{

													$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
													$params[0]=log_obtener_cod_salida();/*toma el verdadero correlativo del movimiento*/
													$params[1]=$tipo;/*tipo Salida*/
													$params[2]=$_SESSION["idusuarios"];/*idusuario*/
													$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
													$params[4]=null;/*Codigo_bodega_ent*/
													$params[5]=$_POST['Vale'];
													$params[6]=null;
													$params[7]=null;
													$params[8]=null;
													$params[9]=$_POST['Tecnico'];
													$params[10]=null;
													$params[11]=null;
													$params[12]=$_POST['Autoriza'];/*au*/
													$params[13]=$_POST['Observaciones'];/*Observaciones*/
													$params[14]=$_POST['Fecha'];
													$params[15]=$_POST['Fecha2'];
														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Por entrega de materiales para mantenimiento de la red</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>
												

												<tr>
												<td>Vale de salida No.:</td>
												<td><input type="text" class="frm_txt" name="Vale" value="'.(isset($_POST['Vale'])?$_POST['Vale']:'').'" /></td>
												</tr>

												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
												</tr>
												

												<tr>
												<td>Sucursal que entrega los materiales:</td>
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
									<td>Técnico que recibe:</td>
									<td>
										<select name="Tecnico" class="frm_cmb" />
										<option value="">Seleccione un tecnico de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
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
									<td>Autoriza la entrega:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un empleado de la tabla...</option>';
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
												echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
											}
										}
									echo'</td>
									</tr>
									<tr>




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
												echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas.php">';
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