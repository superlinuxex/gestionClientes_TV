<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>ERVING-INVENTARIO - Inicio </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />

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
							<h3 class="title"><a href="#"></a></h3>
							<div class="entry">
								<div style="text-align:center;"><img src="imagenes/logoinve.PNG" alt="Logo" /> </div>
							</div>
						</div>
						<div class="post">
							<h2 class="title"><a href="#">La Compañia</a></h2>
							<div class="entry">
								<strong>COMPUTIENDAS</strong>  es una empresa lider en el mercado Salvadoreño en la venta de computadoras y accesorios informaticos. </br></br>
								 Nuestra empresa tiene como meta ofrecer los precios mas bajos del mercado para beneficio del bolsillo de nuestros clientes. </br></br>
								 Nuestras sucursales ofrecen el mejor surtido de accesorios de computacion para todas las necesidades. </br></br>
								
							</div>
						</div>
                        <div class="post">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin del contenido -->
	
	<!-- Inicio del Pie de Pagina -->
	<div id="footer">
		<p>Todos los derechos reservados - Erving Chamagua Romero, El Salvador, 2013</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
