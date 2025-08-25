<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>CUSTOMERSCABLETV - Inicio </title>
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
							<strong>CUSTOMERSCABLETV - Desarrollo:Erving Chamagua - email:ervingchamagua@gmail.com</strong>
							<div class="entry">
								        La empresa cableoperadora que utilice este sistema de informacion esta conciente de que en la actualidad los
                                                                        sistemas de informacion son una herramienta indispensable para el manejo de las finanzas, la optimizacion de los 
                                                                        procesos y atencion eficiente del cliente.</br>
								
							</div>

							<strong>DESCRIPCION DEL SISTEMA</strong>
							<div class="entry">
								 Este software esta diseñado para llevar el control de las cuentas de clientes de empresas cableoperadoras, cubriendo los
                                                                 principales procesos de las empresas de este rubro, a saber, registro del cliente, facturacion, soporte tecnico, atencion
                                                                 telefonica al cliente para cobro y solucion de problemas, listado de cobros diarios, moras por pagos pendientes, gastos y otras utilidades que facilitan el trabajo
                                                                 el trabajo operativo y administrativo.</br>
							</div>

							<strong>A CERCA DE SOFTWARE CUSTOMERSCABLETV</strong>
							<div class="entry">
                                                                Sistema de Control de CableUsuarios -
								Diseño y Desarrollo: Erving Chamagua 
                                                                ervingchamagua@gmail.com

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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>