<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Salida de Matriales </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
 <?php
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
				<img src="imagenes/arco_log_main.png" alt="logo" border="0" align="texttop" />
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
							<h2 class="title">Salida de materiales por devolución al proveedor</a></h2>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
										require_once("logica/log_devo.php");
										$id_nueva_devo=log_obtener_cod_devo();
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
											case '1':/*a obra*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Vale'])==false or $_POST['Vale']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar el Codigo del vale para la Salida que desea ingresar
														</div>';
														$insertar=false;
													}
													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
														$params[1]=$tipo;/*tipo Salida*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
														$params[4]=null;/*Codigo_bodega_ent*/
														$params[5]=$_POST['Vale'];/*Codigo_vale*/
														$params[6]=$_POST['Observaciones'];/*Observaciones*/
														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
													}										
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<td>Codigo:</td>
												<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>
												
												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.date('d/m/Y').'" /></td>
												</tr>
												
												<tr>
												<td>Bodega de Salida:</td>
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
												<td>Codigo de vale de salida:</td>
												<td><input type="text" class="frm_txt" name="Vale" value="'.(isset($_POST['Vale'])?$_POST['Vale']:'').'" /></td>
												</tr>
												
												<tr>
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
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
											case '2':/*transferencia*/
												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['BodegaDes'])==false or $_POST['BodegaDes']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe seleccionar la Bodega de destino para la Transferencia que desea ingresar.
														</div>';
														$insertar=false;
													}
													if ($insertar==true)
													{
														$params[0]=$_POST['Codigo'];/*Codigo_Salida*/
														$params[1]=$tipo;/*tipo Salida*/
														$params[2]=$_SESSION["idusuarios"];/*idusuario*/
														$params[3]=$_SESSION["idBodega"];/*Codigo_bodega_sal*/
														$params[4]=$_POST['BodegaDes'];/*Codigo_bodega_ent*/
														$params[5]=null;/*Codigo_vale*/
														$params[6]=$_POST['Observaciones'];/*Observaciones*/
														
														$_SESSION['parametros']=$params;
														
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';
													}									
												}
												echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<td>Codigo:</td>
												<td><input type="text" class="frm_txt" name="Codigo" readonly="readonly" value="'.$id_nueva_salida.'" /></td>
												</tr>
												
												<tr>
												<td>Fecha:</td>
												<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.date('d/m/Y').'" /></td>
												</tr>
												
												<tr>
												<td>Bodega de Origen:</td>
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
												<td>Bodega de Destino:</td>
												<td>
												<select name="BodegaDes" class="frm_cmb" />
												<option value="">Seleccione una Bodega...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
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
												<td>Observaciones:</td>
												<td><input type="text" class="frm_txt" name="Observaciones" value="'.(isset($_POST['Observaciones'])?$_POST['Observaciones']:'').'" /></td>
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>