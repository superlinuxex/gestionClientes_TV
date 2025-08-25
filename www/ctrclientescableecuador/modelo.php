<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Mantenimiento de Modelos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />
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
							<h3 class="title">Catálogo de Modelos</a></h3>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
										require_once("./logica/log_modelo.php");
										include ("./utils/crear_tabla.php");
										$total_registros=log_obtener_num_modelo();
										if(!isset($_GET["pagina"])){
											$comienzo = 0;
											$num_pag = 1;
										}
										else
										{
											$num_pag=$_GET["pagina"];
											$comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
										}
										$usuarios=log_obtener_modelo($comienzo,$_SESSION["cant_reg_pag"]);
										$campos = array("Codigo","Nombre");
										crear_tabla($usuarios, $campos,'modelo','modelo.php',false,"modelo_editar.php",
													"modelo_eliminar.php","modelo_detalle.php","modelo_agregar.php");
										echo "<div style=\"padding:15px;\" align=\"center\">";
										paginacion ($num_pag,$total_registros,"modelo.php?pagina=");
										echo"</div>";
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
