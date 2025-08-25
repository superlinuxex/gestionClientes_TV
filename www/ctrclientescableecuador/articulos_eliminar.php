<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Eliminar Artículo</title>
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
							<h3 class="title">Eliminar Artículo</a></h3>
							<div class="entry">
								<?php
									require_once("./logica/log_articulos.php");
									$tabla=log_obtener_articulo($_GET["id"]);
									$registro=mysql_fetch_array($tabla);

									require_once("logica/log_divisiones.php");
									$tabla1=log_obtener_division($registro["Tipo"]);
									$registro1=mysql_fetch_array($tabla1);
									$dtipo=$registro1['Nombre'];

									require_once("logica/log_marcas.php");
									$tabla2=log_obtener_marca($registro["Marca"]);
									$registro2=mysql_fetch_array($tabla2);
									$dmarca=$registro2['Nombre'];

									require_once("logica/log_modelo.php");
									$tabla3=log_obtener_modelo2($registro["Modelo"]);
									$registro3=mysql_fetch_array($tabla3);
									$dmodelo=$registro3['Nombre'];

									require_once("logica/log_color.php");
									$tabla4=log_obtener_color2($registro["Color"]);
									$registro4=mysql_fetch_array($tabla4);
									$dcolor=$registro4['Nombre'];

									$mostrar_datos=true;
									$elimina=true;

									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=articulos.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										$codaeliminar=$registro['Codigo'];
										$resultado1=log_ve_existenciaantes_de_borrar($codaeliminar);
										if($resultado1==1)
										{
										 $elimina=false;
										 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										 El articulo tiene movimientos de entradas y salidas, imposible eliminar
										 </div>';
										}
									        $codaeliminar=$registro['Codigo'];
										require_once("logica/log_articulos.php");
										$resultado=log_vemovi_articulos($codaeliminar);
                 								IF($resultado==1){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										 No puede eliminar este articulo, ya tuvo movimientos de entradas o salidas
										 </div>';
 										 $elimina=false;
										}

           									
										if ($elimina==true)
										{

										$resulatado=log_eliminar_articulo($_GET["id"]);
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
										<td>Codigo:</td>
										<td><input type="text" readonly="readonly" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" /></td>
										</tr>
										<tr>
										
											<tr>
											<td>Tipo de articulo:</td>
											<td><input type="text" class="frm_txt" readonly="readonly" name="Tipo" value="'.$registro1['Nombre'].'" /></td>
											</tr>
										
										<tr>
										<td>Descripcion:</td>
										<td><input type="text" readonly="readonly" class="frm_txt_long" name="Descripcion" value="'.$registro['Descripcion'].'" /></td>
										</tr>

											<tr>
											<td>Marca o fabricante:</td>
											<td><input type="text" class="frm_txt_long" readonly="readonly" name="Nombre2" value="'.$registro2['Nombre'].'" /></td>
											</tr>

											<tr>
											<td>Modelo o estilo:</td>
											<td><input type="text" class="frm_txt_long" readonly="readonly" name="Nombre3" value="'.$registro3['Nombre'].'" /></td>
											</tr>

											<tr>
											<td>Color o material de fabricacion:</td>
											<td><input type="text" class="frm_txt_long" readonly="readonly" name="Nombre4" value="'.$registro4['Nombre'].'" /></td>
											</tr>


											<tr>
											<td>Numero de Serie:</td>
											<td><input type="text" class="frm_txt_long" name="Serie" readonly="readonly" value="'.$registro['Serie'].'" /></td>
											</tr>


											<tr>
											<td>MAC:</td>
											<td><input type="text" class="frm_txt_long" name="Mac" readonly="readonly" value="'.$registro['Mac'].'" /></td>
											</tr>
										
											<tr>
											<td>Unidad de medida al Comprar:</td>
											<td><input type="text" class="frm_txt" readonly="readonly" name="Unidadc" value="'.$registro['Unidadc'].'"/></td>
											</tr>

									
											<tr>
											<td>Unidad de medida al Despacho:</td>
											<td><input type="text" class="frm_txt" readonly="readonly" name="Unidad" value="'.$registro['Unidad'].'"/></td>
											</tr>


											<tr>
											<td>Cantidad de unidades de despacho por embalaje:</td>
											<td><input type="text" class="frm_txt" readonly="readonly" name="Embalaje" value="'.$registro['Embalaje'].'" /></td>
											</tr>

											<tr>
											<td>Despachar segun embalaje?:</td>
											<td>
											<select name="Embasino" disabled="true" class="frm_cmb">
											<option value="1" '.($registro['Embasino']==1?' selected="selected" ':'').'>Si</option>											
											<option value="2" '.($registro['Embasino']==2?' selected="selected" ':'').'>No</option>											
											</select>
											</td>
											</tr>

											<tr>
											<td>Volumen:</td>
											<td><input type="text" class="frm_txt" name="Volumen" value="'.$registro['Volumen'].'" /></td>
											</tr>

											<tr>
											<td>Peso:</td>
											<td><input type="text" class="frm_txt" name="Peso" value="'.$registro['Peso'].'" /></td>
											</tr>


											<tr>
											<td>Especificaciones tecnicas:</td>
											<td><input type="text" class="frm_txt_long" name="Espetec" value="'.$registro['Espetec'].'" /></td>
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
