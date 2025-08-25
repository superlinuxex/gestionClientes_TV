<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Mantenimiento de Poblaciones</title>
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
							<h3 class="title">Mantenimiento de registros de Poblaciones</a></h3>
							<h3 class="title">Estado seleccionado</a></h3>
							<div class="entry">
								<div id="itsthetable">
								<?php
										require_once("./logica/log_deptos.php");
										require_once("./logica/log_municipios.php");
										require_once("./logica/log_cantones.php");
										require_once("./utils/crear_tabla.php");

										$deptos=log_obtener_depto($_GET["part"]);
										$campos = array("Codigo","Nombre");
										crear_tabla($deptos, $campos,'detalle_depto','',false,"","","","");

										echo "<br/><h3 class=\"title\">Municipios del Estado seleccionado</a></h3>";
										$municipios=log_obtener_municipios($_GET["part"]);
										$campos = array("Codigo","Municipio");
										crear_tabla($municipios, $campos,'detalle_depto','',false,"","","","");

																				
										echo "<br/><h3 class=\"title\">Poblaciones del Municipio</a></h3>";
										$parm='?part='.$_GET["part"].'&s_part='.$_GET["s_part"].'&s_part_a=';
										$cantones=log_obtener_canton($_GET["part"],$_GET["s_part"]);
										$campos = array("Codigo","Municipio","Poblacion");
										crear_tabla($cantones, $campos,'cantones','cantones.php',false,"cantones_editar.php".$parm,
										"cantones_eliminar.php".$parm,$parm,"cantones_agregar.php?part=".$_GET["part"]."&s_part=".$_GET["s_part"]);
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
