<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Reporte de Kardex </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

<script type="text/javascript">
function FiltrarProductos(str)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {// codigo para IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// codigo para  IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("prod").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cmbFiltroProd.php?prod="+str,true);
xmlhttp.send();
}
</script>

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
							<h2 class="title"><a href="#">Parametros para la generacion del reporte de Kardex</a></h2>
							<div class="entry">
								<?php

									if (isset ($_POST['aceptar']))
									{
										$insertar=true;
										if (isset($_POST['FechaH'])==false or $_POST['FechaH']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la Fecha hasta la cual se mostraran los movimeintos.
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe seleccionar el Producto del cual desea que se muestren los movimientos.
											</div>';
											$insertar=false;
										}
										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_kardex.php?
											fd='.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'
											&fh='.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'
											&pr='.(isset($_POST['Producto'])?$_POST['Producto']:'').'
											&bo= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 
										}										
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="padding:0px 0px 0px 0px;  cellpadding="0"; cellspacing="0"; border=2;" >
									
								
									<tr>
									<td>Fecha Hasta (dd-mm-aaaa):</td>
									<td>
									<input type="text"  name="FechaH" id="FechaH"  class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">
									</td>
									</tr>
									
									<tr>
									<td>Producto:</td>
									<td>
										<table >
											<tr>
												<td style="padding:0px 0px 0px 0px;">
													<input type="text" class="frm_txt" name="txtproducto" value="" value="'.(isset($_POST['txtproducto'])?$_POST['txtproducto']:'').'" onkeyup="FiltrarProductos(this.value)"/> 
												</td>
												<td>
													<div id="prod" style="float: left;">
														<select name="Producto" class="frm_cmb" />
														<option value="">Seleccione un Producto...</option>';
														require_once("./logica/log_articulos.php");
														$resultado=log_obtener_articulos_cmb();
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
																echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
															}
														}
														echo'
													</div>
												</td>
											</tr>
										</table>
									</td>									
									</tr>
									
												<tr>
												<td>Bodega:</td>
												<td><input type="text" readonly="readonly" class="frm_txt" name="Bodega" value="'.(isset($_SESSION["idBodega"])?$_SESSION["idBodega"]:'').'" /></td>
												</tr>
					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Generar"  class="frm_btn" name="aceptar"/>
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
