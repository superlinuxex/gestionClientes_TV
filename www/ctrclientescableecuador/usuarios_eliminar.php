<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de Usuarios </title>
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
							<h3 class="title">Eliminar Usuario del Sistema</a></h3>
							<div class="entry">
								<?php
									$tabla=log_obtener_usuario($_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=usuarios.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										
										$resulatado=log_eliminar_usuario($_GET["id"]);
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
										<td>Nombre:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="nombre" value="'.$registro['Nombre'].'" /></td>
										</tr>
										<tr>

										<tr>
										<td>Apellido:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="apellido" value="'.$registro['Apellido'].'" /></td>
										</tr>
										<tr>

										<tr>
										<td>Usuario:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="usuario" value="'.$registro['Usuario'].'" /></td>
										</tr>
										<tr>

										<tr>
										<td>Perfil:</td>
										<td>
											<select name="perfiles" readonly="readonly" class="frm_cmb"/>
											<option>Seleccione un perfil...</option>';
											require_once("./logica/log_perfiles.php");
											$resultado=log_obtener_perfiles_cmb();
											while ( $fila = mysql_fetch_array($resultado))
											{
												if ($registro["Perfil"]==$fila['Codigo'])
												{
												echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
												}
											}
										echo'</td>
										</tr>
										<tr>

										<tr>
										<td>Sucursal:</td>
										<td>
											<select name="bodega" readonly="readonly" class="frm_cmb" />
											<option>Seleccione una bodega...</option>';
											require_once("./logica/log_bodegas.php");
											$resultado=log_obtener_bodegas_cmb();
											while ( $fila = mysql_fetch_array($resultado))
											{
												if ($registro["Bodega"]==$fila['Codigo'])
												{
												echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
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
