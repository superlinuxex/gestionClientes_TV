<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Detalle de factura por servicios </title>
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
							<h3 class="title">Lista del detalle del recibo o factura por servicios</a></h3>
							<div class="entry">
								<div id="itsthetable">
								<?php
								$factura=$_SESSION['factura'];
								$tipo=$_SESSION['tipo'];
								$bodega=$_SESSION["idBodega"];
								$fecha1=$_SESSION['fecha'];
								$cliente=$_SESSION['cliente'];
								$autoriza=$_SESSION['autoriza'];
								$lugarpago=$_SESSION['lugarpago'];
								$descuento=$_SESSION['descuento'];
								$idusuarios=$_SESSION['idusuarios'];
                       echo 'NUMERO DE DOCUMENTO: '.$_GET['factu'];
                       echo '            ';
                       echo 'FECHA: '.$_GET['lafecha'];
                       echo '            ';
                       echo 'CODIGO DEL CLIENTE: '.$_GET['codc'];
			$factura=$_GET['factu'];
                        $fecha1=$_GET['lafecha'];
                        $cliente=$_GET['codc'];
			$_SESSION['facturamem']=$factura;



echo ' <br></br>';


 			echo '<h3 class="title"><a href="imprimir_recibo_direc.php?id1='.$factura.'&id2='.$tipo.'&id3='.$fecha1.'&id4='.$bodega.'"><img src="imagenes/impresor.png"/>IMPRIMIR</a></h3>';


				                               if (isset ($_GET['lafecha']))
                                				    {
				                                     $fecha1=$_GET['lafecha'];
                                				     $fecha50=$_GET['lafecha'];
				                                    }


									//$parametros=$_SESSION['parametros'];
									//$factura=$parametros['0'];
									//$tipo=$parametros['1'];
									//$bodega=$parametros['3'];
									//$fecha1=$parametros['14'];



									$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
									if ($tipo==1)
									{
											echo '&nbsp;&nbsp;Factura No.:&nbsp;'.$factura;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									if ($tipo==2)
									{
											echo '&nbsp;&nbsp;Credito Fiscal No.:&nbsp;'.$factura;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;
									}







									require_once("./logica/log_facturas.php");
									include ("./utils/crear_tabla.php");
									$total_registros=log_obtener_num_facturas_detalle($factura,$tipo,$fecha,$bodega);
									if(!isset($_GET["pagina"])){
										$comienzo = 0;
										$num_pag = 1;
									}
									else
									{
										$num_pag=$_GET["pagina"];
										$comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
									}
									$articulos=log_obtener_facturas_detalle($comienzo,$_SESSION["cant_reg_pag"],$factura,$tipo,$fecha,$bodega);
									$campos = array("Factura","Tipo","Fecha","Item","Concepto","Cantidad","Precio Unitario $","Estado");
									crear_tabla($articulos, $campos,'facturas_detalle','facturas_detalle.php',false,"facturas_detalle_editar.php",
									"facturas_detalle_eliminar.php","facturas_detalle.php","facturas_detalle_agregar.php?lafecha=$fecha1&factu=$factura&codc=$cliente&bod=$bodega");
									echo "<div style=\"padding:15px;\" align=\"center\">";
									paginacion ($num_pag,$total_registros,"facturas_detalle.php?pagina=");
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
