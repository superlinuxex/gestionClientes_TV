<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv  - Eliminar Salida de Articulos</title>
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
							<h3 class="title">Eliminar Detalle de Salida</a></h3>
							<div class="entry">
								<?php								
									require_once("logica/log_salidas.php");
									$parametros=$_SESSION['parametros'];
									$codigo_salida=$parametros['0'];
									$bodega=$parametros['3'];
									$tipo=$parametros['1'];
									$tabla=log_obtener_detalle_salida_nuevo2($codigo_salida,$_GET["id"],$bodega);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;
									$mostrar_datos=true;

                                                                                $resul=log_ve_estatus_salida($codigo_salida);
										if ($resul==2)
										{
                                                                                        $pasa=0;
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Imposible eliminar, ya fue recibido por la sucursal a la que se le envio
											</div>';
										}
									if(isset($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas.php">';    
										exit;  
									}
									if (isset ($_POST['aceptar']))
									{
                                                                          $pasa=1;
                                                                                $resul=log_ve_estatus_salida($codigo_salida);
										if ($resul==2)
										{
                                                                                        $pasa=0;
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Imposible eliminar, ya fue recibido por la sucursal a la que se le envio
											</div>';
											$mostrar_datos=false;
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas.php">';    
										exit;  
										}
                                                                                if($pasa==1)
										{
											$resultado=log_eliminar_salida_detalle($codigo_salida,$_GET['id'],$registro["Cantidad"],$bodega,$registro["Producto"],$registro,$parametros);
											if ($resultado==1)
											{
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro eliminado correctamente.
												</div>';
												$mostrar_datos=false;
												echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas.php">';    
												exit;  
											}
											else
											{
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Ha ocurrido un error al tratar de actualizar el registro, favor revisar que los datos ingresados sean correctos.
												</div>';
												$mostrar_datos=true;
											}
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

											<tr>
											<td>Codigo del articulo:</td>
											<td><input type="text" class="frm_txt" name="Idarticulo" value="'.$registro["Idarticulo"].'" readonly="readonly" /></td>
											</tr>
											

											<tr>
											<td>Nombre del articulo:</td>
											<td><input type="text" class="frm_txt" name="Producto" value="'.$registro["Producto"].'" readonly="readonly" /></td>
											</tr>


											<tr>
											<td>Cantidad:</td>
											<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'" readonly="readonly" /></td>
											</tr>

										<tr>
										<td>Estado del articulo:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Estado1" value="'.$registro["Estado1"].'" /></td>
										</tr>

											
											
											
											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
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
