<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Mantenimiento de Sub-Partidas "A" </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
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
							<h2 class="title">Catálogo de Sub-Partidas "A"</a></h2>
							<h3 class="title">Datos de la Partida </a></h3>
							<div class="entry">
								<div id="itsthetable">
								<?php
										require_once("./logica/log_partidas.php");
										require_once("./logica/log_subpartidas.php");
										require_once("./logica/log_subpartidas_a.php");
										require_once("./utils/crear_tabla.php");
										$partidas=log_obtener_partida_sub($_GET["part"],$_GET["div"],$_GET["pro"]);
										$campos = array("Codigo","Division","Proyecto","Nombre","Cargos","Abonos","Saldo");
										crear_tabla($partidas, $campos,'detalle_partida','',false,"","","","");

										echo "<h3 class=\"title\">Datos de la Sub-Partidas</a></h3>";
										$subpartidas=log_obtener_subpartida_sub($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"]);
										$campos = array("Codigo","Partida","Division","Proyecto","Nombre","Cargos","Abonos","Saldo");
										crear_tabla($subpartidas, $campos,'detalle_partida','',false,"","","","");
																				
										echo "<br/><h3 class=\"title\">Sub-Partidas 'A'</a></h3>";
										$parm='?part='.$_GET["part"].'&div='.$_GET["div"].'&pro='.$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a=';
										$subpartidas_a=log_obtener_subpartidas_a($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"]);
										$campos = array("Codigo","Sub-Partida","Division","Proyecto","Nombre","Cargos","Abonos","Saldo");
										crear_tabla($subpartidas_a, $campos,'subpartidas_a','subpartidas_a.php',false,"subpartidas_a_editar.php".$parm,
										"subpartidas_a_eliminar.php".$parm,$parm,"subpartidas_a_agregar.php?part=".$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"]."&s_part=".$_GET["s_part"]);
                                    ?>
									<br/>
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
