<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Eliminar factura de cliente </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>


<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fechai').datepicker({
			inline: true
		});
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
</script>




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
							<h3 class="title">Eliminacion de facturas</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_facturas.php");
									$tabla=log_obtener_facturamodi($_GET["id"],$_GET["id2"],$_GET["id3"]);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;



									if(isset($_POST['aceptar']))
									{

										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											exit;  
										}
										else
										{
										   //if ($registro['Anulada']!=1)
											//{
											//echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											//ADVERTENCIA: Esta factura NO esta anulada, imposible ELIMINAR.
											//</div>';
											//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturaselim.php">';    
											//exit;  


											//}
											$mostrar_datos='get';
										}
									}


									if ($registro['Tipofac']==1)
									{
											echo '&nbsp;&nbsp;Tipo de factura: Consumidor Final';
									}
									if ($registro['Tipofac']==2)
									{
											echo '&nbsp;&nbsp;Tipo de factura: Credito fiscal';
									}
									if ($registro['Tipofac']==3)
									{
											echo '&nbsp;&nbsp;Tipo de factura: Recibo';
									}


									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>

													<td><input type="text" class="frm_txt" name="Tipofac" hidden="true" value="'.$registro['Tipofac'].'" readonly="readonly"/></td>

													<tr>
													<td>Cliente:</td>
													<td><input type="text" class="frm_txt" name="Cod_cliente" value="'.$registro['Cod_cliente'].'" readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Numero de Factura:</td>
													<td><input type="text" class="frm_txt" name="Factura" value="'.$registro['Factura'].'"  readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Monto:</td>
													<td><input type="text" class="frm_txt" name="Total" value="'.$registro['Total'].'"  readonly="readonly"/></td>
													</tr>

													<tr>
													<td>Usuario:</td>
													<td><input type="text" class="frm_txt" name="Usuario" value="'.$registro['Usuario'].'"  readonly="readonly"/></td>
													</tr>




													<tr>
													<td>Fecha de factura:</td>
													<td><input type="text" class="frm_txt" name="Fechafac" value="'.$registro['Fechafac'].'" readonly="readonly" /></td>
													</tr>










									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Eliminar factura"  class="frm_btn" name="aceptar"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									</td>
									</tr>
								</table>
								</form>';
								break;
							case 'post':
								$insertar=true;

											
											if ($insertar==true)
											{
									$bodega=$bodx;
									$elusuario=$_POST['Usuario'];
									$fecha1=$_POST['Fechafac'];
//pendiente la eliminacion del registro de venta del cajero
 	  							     require_once("logica/log_facturas.php");
								     $tabla3=log_obtener3_ventausuario($elusuario,$bodega,$fecha1);
								     $regis3=mysql_fetch_array($tabla3);
                                                                     $montousuario=$regis3['ventas']-$_POST["Total"];
								     $tabla4=log_restar_ventausuario($elusuario,$montousuario,$bodega,$fecha1);
								     $regis4=mysql_fetch_array($tabla4);

									//$resultado=log_eliminarglob_factura($_POST);
									$resultado=log_eliminarglob_factura($_POST,$bodega);

												
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Factura eliminada correctamente.
												</div>';
												unset($_POST); 
											//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											//exit;  

											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<td><input type="text" class="frm_txt" hidden="true" name="Tipofac" value="'.(isset($_POST['Tipofac'])?$_POST['Tipofac']:'').'" /></td>
									<td><input type="text" class="frm_txt" hidden="true" name="Fechafac" value="'.(isset($_POST['Fechafac'])?$_POST['Fechafac']:'').'" /></td>
									<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'" /></td>
									<td><input type="text" class="frm_txt" hidden="true" name="Usuario" value="'.(isset($_POST['Usuario'])?$_POST['Usuario']:'').'" /></td>
									<td><input type="text" class="frm_txt" hidden="true" name="Total" value="'.(isset($_POST['Total'])?$_POST['Total']:'').'" /></td>









											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Anular factura"  class="frm_btn" name="aceptar"/>
											<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										}
										else
										{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										}
										break;
										default:
										break;
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
		<p>Todos los derechos reservados - Desarrollo Erving Chamagua, 2018</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
