<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Registro de cambio de planes de pago por un cliente </title>
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
							<h3 class="title">Cambio de planes de pago por clientes</a></h3>
							<div class="entry">
							<div id="itsthetable">
							<?php
 							   if (isset ($_POST['id']))
							     {
							      $clie1=$_POST['id'];
							     }
							     else
							     {
							      $clie1=$_GET['id'];
							     }
                                if($clie1!="")
				{
					$_SESSION["ccliente"]=$clie1;
                                        $clie=$_SESSION["ccliente"];
                                }
				else
				{
                                        $clie=$_SESSION["ccliente"];
                                }

				//Buscando el nombre del cliente
                                require_once("logica/log_idenpaci.php");
                                $resultado=log_obtener_idenpaci2($clie,$_SESSION["idBodega"]);
				$registro=mysql_fetch_array($resultado);
                                $nombreclie=$registro['Mnombre']." ".$registro['Mapellido'];	




  							        echo 'Cambio de planes realizados por el cliente:&nbsp;'.$clie." ".$nombreclie;
							        $comienzo = 0;
							        $num_pag = 1;
								
							        require_once("./logica/log_cambiopldeta.php");
								include ("./utils/crear_tabla.php");

								$articulos=log_obtener_cambiopldeta($_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],$clie);
								$campos = array("Fecha cambio","Motivo del cambio","Nombre del nuevo plan","Valor");
								crear_tabla($articulos, $campos,'cambiopldeta','cambiopldeta.php',false,"cambiopldeta_editar.php",
								"cambiopldeta_eliminar.php","cambiopldeta.php","cambiopldeta_agregar.php?idcliente=$clie");
								echo "<div style=\"padding:15px;\" align=\"center\">";
								paginacion ($num_pag,$total_registros,"cambiopldeta.php?pagina=");
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
