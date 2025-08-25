<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Eliminar Sub-Partida "A"</title>
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
							<h2 class="title">Eliminar Sub-Partida 'A'</a></h2>
							<div class="entry">
								<?php
									require_once("./logica/log_subpartidas_a.php");
									$tabla=log_obtener_subpartida_a($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"],$_GET["s_part_a"]);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=subpartidas_a.php?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'">';   
										exit;    
									}
									if (isset ($_POST['aceptar']))

									   {
									      $resultado=dat_validar_existencia_subpartida_b1($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"],$_GET["s_part_a"]);
									      if ($resultado)
										{
										  echo'<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
										  No se puede eliminar esta subpartida "A" pues ya tiene subpartidas "B"
										  </div>';
										}
										else
										{
										$resulatado=log_eliminar_subpartida_a($_GET["part"],$_GET["div"],$_GET["pro"],$_GET["s_part"],$_GET["s_part_a"]);
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Registro eliminado correctamente.
										</div>';
										$mostrar_datos=false;
										}

									   }

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?part='.$_GET["part"]."&div=".$_GET["div"]."&pro=".$_GET["pro"].'&s_part='.$_GET["s_part"].'&s_part_a='.$_GET["s_part_a"].'">';   
									if ($mostrar_datos==true)
									{
										echo '
   											División:'.$_GET["div"].'
											Proyecto:'.$_GET["pro"].'
											Partida:'.$_GET["part"].'
											SubPartida:'.$_GET["s_part"].'

										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>
										<td>No.Subpartida"A":</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" /></td>
										</tr>
										<tr>
										
										<tr>
										<td>Nombre Subpartida"A":</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Nombre" value="'.$registro['Nombre'].'" /></td>
										</tr>
										<tr>
										
										<tr>
										<td>Cargos:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Cargos" value="'.$registro['Cargos'].'" /></td>
										</tr>
										<tr>
										
										<tr>
										<td>Presupuesto Asignado:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Abonos" value="'.$registro['Abonos'].'" /></td>
										</tr>
										<tr>

										<tr>
										<td>Saldo:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Saldo" value="'.$registro['Saldo'].'" /></td>
										</tr>
										<tr>

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
