<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- REQUISICION ENTRE BODEGAS</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />

<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#FechaD').datepicker({
			inline: true
		});
		$('#FechaH').datepicker({
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
							<h3 class="title">Requisicion entre bodegas</a></h3>
							<div class="entry">
								<div id="itsthetable">
									<form method="POST" id="id-form" action="requibc_encabezado.php" >
									<table style="border: 0px solid #00F">
									<td style="border: 0px solid; width:360px;">
										<input  type="submit" value="Nuevo Movimiento"  class="frm_btn" name="Continuar"/>
									</td>
									</tr>
									</table>
									</form>
								</div>
								<div id="itsthetable">
								</div>

								<div id="itsthetable" >
									<?php
									 echo '
									 CONSULTE REQUISICIONES DE SUCURSAL EN UN RANGO DE FECHAS
									 <form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
									 <tr>
									   <td>Fecha Desde :
									   <input type="text"  name="FechaD" id="FechaD"  class="frm_txt" value="'.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'">
									   </td>
									 </tr>
									 <tr>
									  <td>Fecha Hasta :
									  <input type="text"  name="FechaH" id="FechaH"  class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">
									  </td>
									 </tr>
									 <td style="border:0px solid; width:360px;">
									 <input  type="submit" value="Buscar"  class="frm_btn" name="Buscar"/>
									 </td>
									</tr>
									</form>
								</div></br>';

										
										if (isset ($_POST['Buscar']))
										 {
											 require_once("./logica/log_reqsucursal.php");
											 include ("./utils/crear_tabla.php");
											 $total_registros=log_obtener_num_requibc_filtro($_SESSION["idBodega"],(isset($_POST['FechaD'])?$_POST['FechaD']:''),(isset($_POST['FechaH'])?$_POST['FechaH']:''));
											 if(!isset($_GET["pagina"])){
												 $comienzo = 0;
												 $num_pag = 1;
											 }
											 else
											 {
												 $num_pag=$_GET["pagina"];
												 $comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
											 }
											 $entradas=log_obtener_requibc_filtro($_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],(isset($_POST['FechaD'])?$_POST['FechaD']:''),(isset($_POST['FechaH'])?$_POST['FechaH']:''));
											 $campos = array("Requisicion","Fecha","Sucursal solicita","Sucursal despacha","Estado","Fecha despacho");										
											 crear_tabla($entradas, $campos,'Entradas','requibc.php',false,"requibc_encabezado_editar.php",
											 "requibc_encabezado_eliminar.php","requibc_ver_detalle.php","requibc_agregar.php");
											 echo "<div style=\"padding:15px;\" align=\"center\">";
											 paginacion ($num_pag,$total_registros,"requibc.php?pagina=");
											 echo"</div>";   
										 }
										 else
										 {
											require_once("./logica/log_reqsucursal.php");
											include ("./utils/crear_tabla.php");
											$total_registros=log_obtener_num_requibc($_SESSION["idBodega"],'');
											if(!isset($_GET["pagina"])){
												$comienzo = 0;
												$num_pag = 1;
											}
											else
											{
												$num_pag=$_GET["pagina"]+1;
												$comienzo=($num_pag-1)*($_SESSION['cant_reg_pag']+75);
											}
											$entradas=log_obtener_requibc($comienzo,$_SESSION['cant_reg_pag']+75,$_SESSION["idBodega"],'');
											$campos = array("Requisicion","Fecha","Sucursal solicita","Sucursal despacha","Estado","Fecha despacho");										
											crear_tabla($entradas, $campos,'Entradas','requibc.php',false,"requibc_encabezado_editar.php",
											"requibc_encabezado_eliminar.php","requibc_ver_detalle.php","requibc_agregar.php");
											echo "<div style=\"padding:15px;\" align=\"center\">";
											paginacion ($num_pag,$total_registros,"requibc.php?pagina=");
											echo"</div>";
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