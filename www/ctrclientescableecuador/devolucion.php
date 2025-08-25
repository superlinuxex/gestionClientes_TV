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
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />
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
							<h2 class="title">Salida por Devolución al Proveedor</a></h2>
							<div class="entry">
								<div id="itsthetable">
                                	<form method="POST" id="id-form" action="Devo_encabezado.php" >
										<table style="border: 0px solid #00F" >
											<tr style="border: 0px solid #00F">
												<td style="border: 0px solid #00F">
													Seleccione el tipo de proveedor al que devolver: 
													<select name="tipo" class="frm_cmb"/>
													<option>Seleccione un tipo de Proveedor...</option>
													<option value="1">Proveedor local</option>
													<option value="2">Proveedor externo</option>
												</td>
												<td style="border:0px solid; width:330px;">
													<input  type="submit" value="Continuar"  class="frm_btn" name="Continuar"/>
												</td>
											</tr>
										</table>
									</form>
								</div></br>
								<div id="itsthetable">
									<?php
										echo '
										<!--form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
											<table style="border: 0px solid #00F">
												<tr style="border: 0px solid">
													<td style="border: 0px solid">
														Buscar Salidas:&nbsp;
														<input type="text" class="frm_txt_long" name="filtro" value="" value="'.(isset($_POST['filtro'])?$_POST['filtro']:'').'"/>
													</td>
													<td style="border:0px solid; width:360px;">
														<input  type="submit" value="Buscar"  class="frm_btn" name="Buscar"/>
													</td>
												</tr>
											</table>
										</form-->
										</br>';
											require_once("./logica/log_devo.php");
											include ("./utils/crear_tabla.php");
											$total_registros=log_obtener_num_devo($_SESSION["idBodega"],'');
											if(!isset($_GET["pagina"])){
												$comienzo = 0;
												$num_pag = 1;
											}
											else
											{
												$num_pag=$_GET["pagina"];
												$comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
											}
											$devos=log_obtener_devo($comienzo,$_SESSION["cant_reg_pag"],$_SESSION["idBodega"],'');
											$campos = array("Codigo","Tipo","Fecha","Bodega de Destino","Orden de Compra","Observaciones");										
											crear_tabla($devos, $campos,'Devolucion','devolucion.php',false,"devo_encabezado_editar.php",
											"devo_encabezado_eliminar.php","devo_ver_detalle.php","devo_agregar.php");
											echo "<div style=\"padding:15px;\" align=\"center\">";
											paginacion ($num_pag,$total_registros,"devolucion.php?pagina=");
											echo"</div>";
										//}
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