<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Entrada de Articulos a bodega </title>
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
							<h3 class="title">Ingreso de articulos en sucursales</a></h3>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];

									$tipo='2';


										require_once("logica/log_entradasasuc.php");
										$id_nueva_entrada=log_obtener_cod_entradaasuc();
										switch ($tipo)
										{
											case '1':/*transferencias recibidas*/
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
														$params[4]=$_POST['BodegaDes'];
														$params[5]=$_POST['Nenvio'];
														$params[6]=null;
														$params[7]=$_POST['Observaciones'];
                                                                                                                $params[8]=$_POST['Fecha'];
	                                                                                                        $params[9]=$_POST['Codigoempl'];
	                                                                                                        $params[10]=null;



														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradasasuc_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Entradas por transferencias de bodega central o sucursales</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
												</tr>



												<tr>
												<td>Numero de transferencia recibida:</td>
												<td><input type="text" class="frm_txt" name="Nenvio" value="'.(isset($_POST['Nenvio'])?$_POST['Nenvio']:'').'" /></td>
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
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
												<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
												<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
												</td>
												</tr>
												</table>
												</form>';
											break;
											case '2':/*devoluciones de tecnicos*/
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
														$params[4]=null;
														$params[5]=null;
														$params[6]=$_POST['Tecnico'];
														$params[7]=$_POST['Observaciones'];
                                                                                                                $params[8]=$_POST['Fecha'];
	                                                                                                        $params[9]=$_POST['Codigoempl'];
	                                                                                                        $params[10]=$_POST['Vale'];

														$_SESSION['parametros']=$params;

														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradasasuc_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<h3>Devoluciones de materiales entregados a técnicos</h3>
 												</tr>

												<tr>
												<td><input type="text" class="frm_txt" name="Codigo" hidden="true" readonly="readonly" value="'.$id_nueva_entrada.'" /></td>
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
												 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=entradasasuc.php">';
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