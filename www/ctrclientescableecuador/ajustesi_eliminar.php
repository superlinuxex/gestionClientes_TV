<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Eliminar ajustes de inventarios</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

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
							<h3 class="title">Eliminar un ajuste del inventario</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("./logica/log_ajustesi.php");
									$tabla=log_obtener_ajustesi2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ajustesi.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										
										$resulatado=log_eliminar_ajustesi($_GET["id"],$bodx,$registro);
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Registro eliminado correctamente.
										</div>';
										$mostrar_datos=false;
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>
										<td>Descripcion del artículo:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Descripcion" value="'.$registro['Descripcion'].'" /></td>
										</tr>

										<tr>
										<td>Tipo de movimiento:</td>
										<td>
										<select name="Tipomov" disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Tipomov']==1?' selected="selected" ':'').'>ADICIONAR</option>											
										<option value="2" '.($registro['Tipomov']==2?' selected="selected" ':'').'>DISMINUIR</option>											
										</select>
										</td>
										</tr>

										<tr>
										<td>Estado en el que se encuentra el equipo:</td>
										<td>
										<select name="Estado" disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Estado']==1?' selected="selected" ':'').'>NUEVO</option>											
										<option value="2" '.($registro['Estado']==2?' selected="selected" ':'').'>USADO</option>											
										</select>
										</td>
										</tr>

									
										<tr>
										<td>Cantidad que debe ajustarse:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Cantidad" value="'.$registro['Cantidad'].'" /></td>
										</tr>

										<tr>
										<td>Medida al despachar:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Medida" readonly="readonly" value="'.$registro['Medida'].'" /></td>
										</tr>

		
										<tr>
										<td>Fecha del movimiento de ajuste:</td>
										<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Fecha'].'" /></td>
										</tr>

										<tr>
										<td>Concepto:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$registro['Concepto'].'" /></td>
										</tr>

										<tr>
										<td>Empleado responsable:</td>
										<td>
										 <select name="Codigoempl" class="frm_cmb" disabled="true" />
										  <option value="">Seleccione un empleado...</option>';
										  require_once("./logica/log_vendedores.php");
										  $resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Codigoempl'])
										      {
										        echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										      }
											else
										      {
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										      }
  										   }
										   echo'
										  </td>									
										  </tr>	


										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Eliminar"  class="frm_btn" name="aceptar"/>
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
