<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Eliminar Proyecto</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
 <?php
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
				<img src="imagenes/arco_log_main.png" alt="logo" border="0" align="texttop" />
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
							<h2 class="title">Eliminar Proyecto</a></h2>
							<div class="entry">
								<?php
									require_once("./logica/log_proyectos.php");
									$tabla=log_obtener_proyecto($_GET["id"]);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proyectos.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										
										$resulatado=log_eliminar_proyecto($_GET["id"]);
										if ($resulatado==1)
										{
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Registro eliminado correctamente.
										</div>';
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proyectos.php">';    
										exit;    

										}
										else
										{	
											if ($resulatado=='1451')
											{
												echo'<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												No se puede eliminar este Proyecto pues ya se han realizado movimientos con el mismo.
												</div>';
											}
											else
											{
												echo'<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Ha ocurrido un error al  intentar eliminar el registro. MySQL Error: '.$resulatado.'
												</div>';
											}
											
										}
										$mostrar_datos=false;
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>
										<td>Código:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" /></td>
										</tr>
										
										<tr>
										<td>Nombre:</td>
										<td><input type="text" readonly="readonly" class="frm_txt_long" name="nombre" value="'.$registro['Nombre'].'" /></td>
										</tr>

										<tr>
										<td>División:</td>
										<td>
											<select name="Division" readonly="readonly" class="frm_cmb"/>
											<option value="">Seleccione una division...</option>';
											require_once("./logica/log_divisiones.php");
											$resultado=log_obtener_divisiones_cmb();
											while ( $fila = mysql_fetch_array($resultado))
											{
												if ($registro["Division"]==$fila['Codigo'])
												{
												echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
												}
											}
										echo'</td>
										</tr>

										<tr>
										<td>Responsable de Proyecto:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Usuario" value="'.$registro['Usuario'].'" /></td>
										</tr>
										
										<tr>
										<td>Presupuesto:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Presupuesto" value="'.$registro['Presupuesto'].'" /></td>
										</tr>

										<tr>
										<td>Ubicación:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Ubicacion" value="'.$registro['Ubicacion'].'" /></td>
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
