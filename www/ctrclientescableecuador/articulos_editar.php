<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar Articulo </title>
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
							<h3 class="title">Editar Articulo</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_articulos.php");
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

									$insertar=true;
									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=articulos.php">';    
											exit;  
										}
										else
										{
											$mostrar_datos='get';
										}
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									switch ($mostrar_datos)
									{
										case 'get':
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Codigo:</td>
											<td><input type="text" readonly="readonly" class="frm_txt" name="Codigo" value="'.$registro['Codigo'].'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Descripcion:</td>
											<td><input type="text" class="frm_txt_long" name="Descripcion" value="'.$registro['Descripcion'].'" /></td>
											</tr>

											


									<tr>
									<td>Marca o fabricante:</td>
									<td>
									<select name="Marca" class="frm_cmb" />
									<option value="">Seleccione una marca...</option>';
									require_once("./logica/log_marcas.php");
									$resultado=log_obtener_marcas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										 if ($fila['Codigo']==$registro['Marca'])
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
									<td>Modelo:</td>
									<td>
									<select name="Modelo" class="frm_cmb" />
									<option value="">Seleccione un modelo...</option>';
									require_once("./logica/log_modelo.php");
									$resultado=log_obtener_modelo_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										 if ($fila['Codigo']==$registro['Modelo'])
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
									<td>Color:</td>
									<td>
									<select name="Color" class="frm_cmb" />
									<option value="">Seleccione un color...</option>';
									require_once("./logica/log_color.php");
									$resultado=log_obtener_color_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										 if ($fila['Codigo']==$registro['Color'])
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
											<td>Numero de Serie:</td>
											<td><input type="text" class="frm_txt_long" name="Serie" value="'.$registro['Serie'].'" /></td>
											</tr>

											<tr>
											<td>MAC:</td>
											<td><input type="text" class="frm_txt_long" name="Mac" value="'.$registro['Mac'].'" /></td>
											</tr>



											<tr>
											<td>Unidad de medida al Comprar:</td>
											<td><input type="text" class="frm_txt" name="Unidadc" value="'.$registro['Unidadc'].'"/></td>
											</tr>

									
											<tr>
											<td>Unidad de medida al Despacho:</td>
											<td><input type="text" class="frm_txt"  name="Unidad" value="'.$registro['Unidad'].'"/></td>
											</tr>


											<tr>
											<td>Cantidad de unidades de despacho por embalaje:</td>
											<td><input type="text" class="frm_txt"  name="Embalaje" value="'.$registro['Embalaje'].'" /></td>
											</tr>


											<tr>
											<td>Despachar segun embalaje?:</td>
											<td>
											<select name="Embasino" class="frm_cmb">
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
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
										case 'post':
											if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el Codigo para el artículo que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Descripcion'])==false or $_POST['Descripcion']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la Descripcion para el artículo que desea ingresar
												</div>';
												$insertar=false;
											}
											if (isset($_POST['Unidad'])==false or $_POST['Unidad']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar la Unidad para el artículo que desea ingresar.
												</div>';
												$insertar=false;										
											}

										//Validando que no exista movimiento de este producto
										require_once("logica/log_articulos.php");
										$resultado=log_vemovi_articulos($_POST["Codigo"]);
                 								IF($resultado==1){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										 No puede modificar este articulo, ya tuvo movimientos de entradas o salidas
										 </div>';
 										 $insertar=false;
										}

											if ($insertar==true)
											{
												$resultado=log_actualizar_articulo($_POST,$_GET['id']);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
												</div>';
												unset($_POST); 
											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
											<tr>
											<td>Codigo:</td>
											<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
											</tr>
											<tr>

								
											
											<tr>
											<td>Descripcion:</td>
											<td><input type="text" class="frm_txt" name="Descripcion" value="'.(isset($_POST['Descripcion'])?$_POST['Descripcion']:'').'" /></td>
											</tr>
											<tr>

									<tr>
									<td>Marca o fabricante:</td>
									<td>
									<select name="Marca" class="frm_cmb" />
									<option value="">Seleccione una marca...</option>';
									require_once("./logica/log_marcas.php");
									$resultado=log_obtener_marcas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										if (isset($_POST["Marca"]))
										{
										 if ($_POST["Marca"]==$fila['Codigo'])
										 {
											echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										 }
										 else
										 {
										 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										 }
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
									<td>Modelo:</td>
									<td>
									<select name="Modelo" class="frm_cmb" />
									<option value="">Seleccione un modelo...</option>';
									require_once("./logica/log_modelo.php");
									$resultado=log_obtener_modelo_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										if (isset($_POST["Modelo"]))
										{
										 if ($_POST["Modelo"]==$fila['Codigo'])
										 {
											echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										 }
										 else
										 {
										 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										 }
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
									<td>Color:</td>
									<td>
									<select name="Color" class="frm_cmb" />
									<option value="">Seleccione un color...</option>';
									require_once("./logica/log_color.php");
									$resultado=log_obtener_color_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										if (isset($_POST["Color"]))
										{
										 if ($_POST["Color"]==$fila['Codigo'])
										 {
											echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
										 }
										 else
										 {
										 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										 }
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
											<td>Numero de Serie:</td>
											<td><input type="text" class="frm_txt" name="Serie" value="'.(isset($_POST['Serie'])?$_POST['Serie']:'').'" /></td>
											</tr>
											<tr>



											<tr>
											<td>Mac:</td>
											<td><input type="text" class="frm_txt" name="Mac" value="'.(isset($_POST['Mac'])?$_POST['Mac']:'').'" /></td>
											</tr>
											<tr>
											
											<tr>
											<td>Unidad de medida al Comprar:</td>
											<td><input type="text" class="frm_txt"  name="Unidadc" value="'.(isset($_POST['Unidadc'])?$_POST['Unidadc']:'').'" /></td>
											</tr>

									
											<tr>
											<td>Unidad de medida al Despacho:</td>
											<td><input type="text" class="frm_txt"  name="Unidad" value="'.(isset($_POST['Unidad'])?$_POST['Unidad']:'').'" /></td>
											</tr>


											<tr>
											<td>Cantidad de unidades de despacho por embalaje:</td>
											<td><input type="text" class="frm_txt"  name="Embalaje" value="'.(isset($_POST['Embalaje'])?$_POST['Embalaje']:'').'" /></td>
											</tr>

									<tr>
									<td>Despachar segun embalaje?:</td>
									<td>
										<select name="Embasino" class="frm_cmb">
											<option value="1" '.(isset($_POST['Embasino'])?($_POST['Embasino']==1?' selected="selected" ':''):'').'>SI</option>
											<option value="2" '.(isset($_POST['Embasino'])?($_POST['Embasino']==2?' selected="selected" ':''):'').'>NO</option>
										</select>
									</td>
									</tr>




									<tr>
									<td>Volumen:</td>
									<td><input type="text" class="frm_txt" name="Volumen" value="'.(isset($_POST['Volumen'])?$_POST['Volumen']:'').'" /></td>
									</tr>

									<tr>
									<td>Peso (Libras):</td>
									<td><input type="text" class="frm_txt" name="Peso" value="'.(isset($_POST['Peso'])?$_POST['Peso']:'').'" /></td>
									</tr>

									<tr>
									<td>Especificaciones tecnicas:</td>
									<td><input type="text" class="frm_txt_long" name="Espetec" value="'.(isset($_POST['Espetec'])?$_POST['Espetec']:'').'" /></td>
									</tr>




											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
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
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
