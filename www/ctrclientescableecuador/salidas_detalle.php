<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Detalle de Salida de Articulos </title>
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
							<h3 class="title">Detalle Salida de Articulos</a></h3>
							<div class="entry">

								<div id="itsthetable">
								<?php
									$parametros=$_SESSION['parametros'];
									$codigo_Salida=$parametros['0'];

									if ($parametros['1']==1)
									{
										echo 'PARA EL DOCUMENTO:&nbsp;';
										if ($parametros['8']!="")
										{
											echo '&nbsp;&nbsp;Transferencia o envio No.:&nbsp;'.$parametros['8'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}
									if ($parametros['1']==2)
									{
										echo 'PARA LA DEVOLUCION A PROVEEDOR:&nbsp;';
										if ($parametros['6']!="")
										{
											echo '&nbsp;&nbsp;Nota de devolucion No.:&nbsp;'.$parametros['6'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}
									if ($parametros['1']==3)
									{
										echo 'PARA LA ENTREGA:&nbsp;';
										if ($parametros['5']!="")
										{
											echo '&nbsp;&nbsp;Vale de salida No.:&nbsp;'.$parametros['5'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}
									if ($parametros['1']==4)
									{
										echo 'PARA LA ENTREGA:&nbsp;';
										if ($parametros['5']!="")
										{
											echo '&nbsp;&nbsp;Vale de salida No.:&nbsp;'.$parametros['5'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}



									require_once("./logica/log_salidas.php");
									include ("./utils/crear_tabla.php");
									$total_registros=log_obtener_num_salidas_detalle($codigo_Salida);
									if(!isset($_GET["pagina"])){
										$comienzo = 0;
										$num_pag = 1;
									}
									else
									{
										$num_pag=$_GET["pagina"];
										$comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
									}
									$articulos=log_obtener_salidas_detalle($comienzo,$_SESSION["cant_reg_pag"],$codigo_Salida);
									$campos = array("Item","Articulo","Estado","Cantidad","Unidad de Medida","Cliente","Ticket");
									crear_tabla($articulos, $campos,'salidas_detalle','salidas_detalle.php',false,"salidas_detalle_editar.php",
									"salidas_detalle_eliminar.php","salidas_detalle.php","salidas_detalle_agregar.php");
									echo "<div style=\"padding:15px;\" align=\"center\">";
									paginacion ($num_pag,$total_registros,"salidas_detalle.php?pagina=");
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
