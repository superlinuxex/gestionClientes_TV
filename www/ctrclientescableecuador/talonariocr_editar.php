<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Editar rango de numeros de comprobantes fiscales a utilizar</title>
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
		$('#Mfechaini').datepicker({
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
							<h3 class="title">Editar rango de numeros de comprobantes fiscales a utilizar</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_talonariocr.php");
									$tabla=log_obtener_talonariocr2($_GET["id"],$_GET["id1"],$_GET["id2"]);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=talonariocr.php">';    
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

									<input type="text" class="frm_txt"  hidden="true" name="M1" value="'.$registro['Mfacini'].'" />
									<input type="text" class="frm_txt"  hidden="true" name="M2" value="'.$registro['Mfechaini'].'" />
									<input type="text" class="frm_txt"  hidden="true" name="M3" value="'.$registro['Mfacfin'].'" />


									<tr>
									<td>Fecha inicio de uso de talonario:</td>
									<td><input type="text" class="frm_txt" id="Mfechaini" name="Mfechaini" value="'.$registro['Mfechaini'].'" /></td>
									</tr>


									<tr>
									<td>Numero de factura al inicio del talonario:</td>
									<td><input type="text" class="frm_txt" name="Mfacini" value="'.$registro['Mfacini'].'" /></td>
									</tr>


									<tr>
									<td>Numero de factura al final del talonario:</td>
									<td><input type="text" class="frm_txt" name="Mfacfin" value="'.$registro['Mfacfin'].'" /></td>
									</tr>

									<tr>
									<td>Sucursal Destino:</td>
									<td>
									<select name="Sucursal" class="frm_cmb" />
									<option value="">Seleccione una sucursal...</option>';
									require_once("./logica/log_bodegas.php");
									$resultado=log_obtener_bodegas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										if ($fila['Codigo']==$registro['Sucursal'])
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
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
							case 'post':
										if (isset($_POST['Mfechaini'])==false or $_POST['Mfechaini']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe ingresar la fecha en que inicial el uso del talonario
											</div>';
											$insertar=false;
										}


										if (isset($_POST['Mfacini'])==false or $_POST['Mfacini']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar el numero con el que inicial el talonario
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Mfacfin'])==false or $_POST['Mfacfin']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar el numero de la factura final del talonario
											</div>';
											$insertar=false;
										}

										if (($_POST['Mfacini'])>($_POST['Mfacfin']))
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											El numero de factura inicial debe ser menor o igual a la factura final
											</div>';
											$insertar=false;
										}



											if ($insertar==true)
											{
												$resultado=log_actualizar_talonariocr($_POST);
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


									<input type="text" class="frm_txt"  hidden="true" name="M1" value="'.$registro['Mfacini'].'" />
									<input type="text" class="frm_txt"  hidden="true" name="M2" value="'.$registro['Mfechaini'].'" />
									<input type="text" class="frm_txt"  hidden="true" name="M3" value="'.$registro['Mfacfin'].'" />

									<tr>
									<td>Fecha inicio de uso de talonario:</td>
									<td><input type="text" class="frm_txt" id="Mfechaini" name="Mfechaini" value="'.(isset($_POST['Mfechaini'])?$_POST['Mfechaini']:'').'" /></td>
									</tr>


									<tr>
									<td>Numero de factura al inicio del talonario:</td>
									<td><input type="text" class="frm_txt" name="Mfacini" value="'.(isset($_POST['Mfacini'])?$_POST['Mfacini']:'').'" /></td>
									</tr>


									<tr>
									<td>Numero de factura al final del talonario:</td>
									<td><input type="text" class="frm_txt" name="Mfacfin" value="'.(isset($_POST['Mfacfin'])?$_POST['Mfacfin']:'').'" /></td>
									</tr>

												<tr>
												<td>Sucursal Destino:</td>
												<td>
												<select name="Sucursal" class="frm_cmb" />
												<option value="">Seleccione una sucursal...</option>';
												require_once("./logica/log_bodegas.php");
												$resultado=log_obtener_bodegas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["Sucursal"]))
												{
												if ($_POST["Sucursal"]==$fila['Codigo'])
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
