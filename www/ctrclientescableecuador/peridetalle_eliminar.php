<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv-Eliminar periodo mensual de pago</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
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
							<h3 class="title">Eliminar periodo mensual de pago programado</a></h3>
							<div class="entry">
								<?php
 							     if (isset ($_POST['id']))
							     {
							      $fechaperi=$_POST['id'];
							     }
							     else
							     {
							      $fechaperi=$_GET['id'];
							     }
								
									require_once("logica/log_peridetalle.php");
									$bodega=$_SESSION["idBodega"];
									$tabla=log_obtener_peridetalleuno($_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;
									$mostrar_datos=true;
									if(isset($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=peridetalle.php">';    
										exit;  
									}
									if (isset ($_POST['aceptar']))
									{										
										$resultado=log_eliminar_peridetalle($_GET['id']);
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Registro eliminado correctamente.
										</div>';
										$mostrar_datos=false;
									}
									if (isset ($_POST['eliminartodo']))
									{
										$bodega=$_SESSION["idBodega"];
									        $sentencia = "delete from  periodos where cod_cliente='".$registro["Codigo"]."' and sucursal='".$bodega."'";  
									        $resultado = mysql_query($sentencia);										
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Se elimino todo el registro de programacion de pagos mensuales de este cliente
										</div>';
										$mostrar_datos=false;
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										

										<tr>
										<td>Cliente:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro["Codigo"].'" /></td>
										</tr>

										<tr>
										<td>Fecha inicial del periodo:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Fechai" value="'.$registro["Fechai"].'" /></td>
										</tr>

										<tr>
										<td>Fecha final del periodo:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaf" value="'.$registro["Fechaf"].'" /></td>
										</tr>


										<tr>
										<td>Mes a pagar:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Mes" value="'.$registro["Mes"].'" /></td>
										</tr>
										
									
										<tr>
										<td>Estado de pago:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Pagado" value="'.$registro["Pagado"].'" /></td>
										</tr>
										
										<tr>
										<td>Abonos al periodo:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Abonos" value="'.$registro["Abonos"].'" /></td>
										</tr>

										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Eliminar Registro"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Eliminar Todos"  class="frm_btn" name="eliminartodo"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										</td>
										</tr>
										</table>
										</form>';
									}
									else
									{
										echo'<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
										</td>
										</tr>
										</table>
										</form>';
									}
								?>
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
