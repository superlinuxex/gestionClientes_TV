<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Detalle de gastos</title>
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
							<h3 class="title">Detalle de gastos</a></h3>
							<div class="entry">
								<div id="itsthetable">
								<?php
								$parametros=$_SESSION['parametros'];
								$codigo_gasto=$parametros['0'];

								$codigo_gasto=$_SESSION['Codigo'];
								$tipo=$_SESSION['tipo'];
								$codigo=$_SESSION['Codigo'];
								$factura=$_SESSION['documento'];
								$documento=$_SESSION['documento'];
								$fovial=$_SESSION['fovial'];
								$partida=$_SESSION['partida'];
								$proveedor=$_SESSION['proveedor'];
								$tipo=$_SESSION['tipo'];
								$bodega=$_SESSION['idbodega'];
								//$fecha1=$_SESSION['fecha'];
								$renta=$_SESSION['renta'];
								$codigoempl=$_SESSION['codigoempl'];
								$lugarcon=$_SESSION['lugarcon'];
								$descuento=$_SESSION['descuento'];
								$idusuarios=$_SESSION['idusuarios'];
								$observaciones=$_SESSION['observaciones'];
								$justifica=$_SESSION['justifica'];
								$remesa=$_SESSION['remesa'];




				                               if (isset ($_GET['lafecha']))
                                				    {
								       if($_GET['lafecha']!="")
	                                				    {
					                                     $fecha1=$_GET['lafecha'];
        	                        				     $fecha50=$_GET['lafecha'];
									     $_SESSION['fechaxx']=$_GET['lafecha'];
				                                            }  
									     ELSE
	                                				    {
					                                      $fecha1=$_SESSION['fechaxx'];
					                                    }  
				                                     }

								       if($tipo!="")
	                                				    {
									     $_SESSION['tipox']=$tipo;
				                                            }  
									     ELSE
	                                				    {
					                                      $tipo=$_SESSION['tipox'];
					                                    }  

								       if($documento!="")
	                                				    {
									     $_SESSION['docux']=$documento;
				                                            }  
									     ELSE
	                                				    {
					                                      $documento=$_SESSION['docux'];
					                                    }  



									if ($tipo==1)
									{
											echo '&nbsp;&nbsp;Para la factura:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									if ($tipo==2)
									{
											echo '&nbsp;&nbsp;Para el registro fiscal:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}

									if ($tipo==3)
									{
											echo '&nbsp;&nbsp;Para el recibo:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									
									if ($tipo==4)
									{
											echo '&nbsp;&nbsp;Para el ticket:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									if ($tipo==5)
									{
											echo '&nbsp;&nbsp;Para el vale:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}

									require_once("./logica/log_gastos.php");
									include ("./utils/crear_tabla.php");
									$total_registros=log_obtener_num_gastos_detalle($codigo_gasto);
									if(!isset($_GET["pagina"])){
										$comienzo = 0;
										$num_pag = 1;
									}
									else
									{
										$num_pag=$_GET["pagina"];
										$comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
									}
									$articulos=log_obtener_gastos_detalle($comienzo,$_SESSION["cant_reg_pag"],$codigo_gasto);
									$campos = array("Item","Codigo","Concepto","Detalle","Cantidad","Precio","Total");
									crear_tabla($articulos, $campos,'gastos_detalle','gastos_detalle.php',false,"gastos_detalle_editar.php",
									"gastos_detalle_eliminar.php","gastos_detalle.php","gastos_detalle_agregar.php?lafecha=$fecha1");
									echo "<div style=\"padding:15px;\" align=\"center\">";
									paginacion ($num_pag,$total_registros,"gastos_detalle.php?pagina=");
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
