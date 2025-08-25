<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv Eliminar una llamada a cliente</title>
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
							<h3 class="title">Eliminar Registro de llamadas a clientes</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("./logica/log_llamadas.php");
									$tabla=log_obtener_llamadas2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;

									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=llamadas.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
                                                                                $eliminar="true";

										if($eliminar=="true")
										{
										 $resulatado=log_eliminar_llamadas($_GET["id"],$bodx);
										 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										 Registro eliminado correctamente.
										 </div>';
										 $mostrar_datos=false;
										}
										
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Codigo del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro['Codigo'].'" /></td>
									</tr>

									<tr>
									<td>Nombre del cliente:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Nombre" value="'.$registro['Nombre'].'" /></td>
									</tr>

									<tr>
									<td>Fecha de llamada:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fecha" value="'.$registro['Fecha'].'" /></td>
									</tr>



									<tr>
									<td>Hora de llamada:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Hora" value="'.$registro['Hora'].'" /></td>
									</tr>


									<tr>
									<td>Minutos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Hora2" value="'.$registro['Hora2'].'" /></td>
									</tr>
								

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Motivo de la llamada:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Motivo" cols="85">'.$registro['Motivo'].'</textarea></td>
                </tr>

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Respuesta del cliente:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Respuesta" cols="85">'.$registro['Respuesta'].'</textarea></td>
                </tr>

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Comentarios adicionales:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Comentario" cols="85">'.$registro['Comentario'].'</textarea></td>
                </tr>



									<tr>
									<td>Empleado que atendio la llamada:</td>
									<td>
									<select name="Empleado" class="frm_cmb" />
									<option value="">Seleccione un empleado...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb($bodx);
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Empleado'])
										      {
										        echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										      }
											else
										      {
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
										      }
  										   }
										   echo'
										  </td>									
									</tr>

									<tr>
									<td>Llamada programada:</td>
									<td><input type="text" class="frm_txt" id="Fecha2" name="Fecha2" value="'.$registro['Fecha2'].'" /></td>
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
