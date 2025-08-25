<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de ajustes de inventarios </title>
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
							<h3 class="title">Agregar Registro de ajustes de inventario</a></h3>
							<div class="entry">
								<?php

									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ajustesi.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la fecha del movimiento
											</div>';
											$insertar=false;
										}
								        
										if ($insertar==true)
										{
											require_once("logica/log_ajustesi.php");
											$resultado=log_insertar_ajustesi($_POST,$bodx,$usux);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
                                                                                         if($_POST["Tipomov"]=="2")
											  {
 											   echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											   No hay existencias para disminuir, imposible adicionar.	
											   </div>';
											  }
											  else
											  {
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ya existe en la tabla, imposible adicionar.	
											</div>';
											  }
											}
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ajustesi.php">';    
										exit;    
 
										}										
									}

									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodarti=$_POST["Codarti"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									 <tr>
									 <td>Buscar articulo por codigo o descripcion </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista general)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codarti" value="'.(isset($_POST['Codarti'])?$_POST['Codarti']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';

									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Lista de artículos según busqueda realizada:</td>
									<td>
									<select name="Producto" class="frm_cmb_long" />
									<option value="">Seleccione un Articulo...</option>';
									require_once("./logica/log_articulos.php");
									$resultado=log_obtener_articulos_cmb($hcodarti);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Producto"]))
									  {
									  if ($_POST["Producto"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."--Ingresar por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	

									<tr>
									<td>Tipo de movimiento:</td>
									<td>
										<select name="Tipomov" class="frm_cmb">
											<option value="1" '.(isset($_POST['Adicionar'])?($_POST['Adicionar']==1?' selected="selected" ':''):'').'>ADICIONAR</option>
											<option value="2" '.(isset($_POST['Disminuir'])?($_POST['Disminuir']==2?' selected="selected" ':''):'').'>DISMINUIR</option>
										</select>
									</td>
									</tr>


									<tr>
									<td>Cantidad que debe ajustarse:</td>
									<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
									</tr>

									<tr>
									<td>Estado en que se encuentra el articulo:</td>
									<td>
										<select name="Estado" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estado'])?($_POST['Estado']==1?' selected="selected" ':''):'').'>NUEVO</option>
											<option value="2" '.(isset($_POST['Estado'])?($_POST['Estado']==2?' selected="selected" ':''):'').'>USADO</option>
										</select>
									</td>
									</tr>
									

									<tr>
									<td>Fecha del movimiento de ajuste:</td>
									<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
									</tr>

									<tr>
									<td>Empleado responsable:</td>
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
									<td>Concepto:</td>
									<td><input type="text" class="frm_txt_long" name="Concepto" value="'.(isset($_POST['Concepto'])?$_POST['Concepto']:'').'" /></td>
									</tr>



									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									</td>
									</tr>
									</table>
									</form>';
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
