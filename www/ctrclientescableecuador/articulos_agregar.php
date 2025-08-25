<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de Articulos </title>
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
							<h3 class="title">Agregar Articulo</a></h3>
							<div class="entry">
								<?php
                                                                                 //       $tipomov="articulo";
									         //       require_once("logica/log_articulos.php");
									         //       $id_correla=log_obtener_cod_expe($tipomov);

									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=articulos.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (strlen($_POST['Codigo'])>8)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											El codigo de familia de articulo no puede exceder de 8 caracteres
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Codigo para el articulo que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Tipo'])==false or $_POST['Tipo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe seleccionar la categoria para el articulo que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Descripcion'])==false or $_POST['Descripcion']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Descripcion para el articulo que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Unidad'])==false or $_POST['Unidad']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Unidad de Medida de salida de bodega de ese articulo
											</div>';
											$insertar=false;										
										}

										if (isset($_POST['Unidadc'])==false or $_POST['Unidadc']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Unidad de Medida con la que se compra el articulo
											</div>';
											$insertar=false;										
										}
										if (isset($_POST['Embalaje'])==false or $_POST['Embalaje']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar las unidades por embalaje, paquete o caja, etc como se compra este articulo
											</div>';
											$insertar=false;										
										}

										
										if ($insertar==true)
										{

											require_once("logica/log_articulos.php");
											$resultado=log_insertar_articulo($_POST);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ya existe en el catalogo, imposible adicionar.	
											</div>';
											}
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=articulos.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									
									<tr>
									<td>Codigo familia de articulo:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>
									


									<tr>
									<td>Tipo de articulo:</td>
									<td>
									<select name="Tipo" class="frm_cmb" />
									<option value="">Seleccione una categoria...</option>';
									require_once("./logica/log_divisiones.php");
									$resultado=log_obtener_divisiones_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
										if (isset($_POST["Tipo"]))
										{
										 if ($_POST["Tipo"]==$fila['Codigo'])
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
									<td>Descripcion:</td>
									<td><input type="text" class="frm_txt_long" name="Descripcion" value="'.(isset($_POST['Descripcion'])?$_POST['Descripcion']:'').'" /></td>
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
									<td>Unidad de medida al Comprar:</td>
									<td><input type="text" class="frm_txt" name="Unidadc" value="'.(isset($_POST['Unidadc'])?$_POST['Unidadc']:'').'" /></td>
									</tr>

									
									<tr>
									<td>Unidad de medida al Despacho:</td>
									<td><input type="text" class="frm_txt" name="Unidad" value="'.(isset($_POST['Unidad'])?$_POST['Unidad']:'').'" /></td>
									</tr>


									<tr>
									<td>Cantidad de unidades de despacho por embalaje:</td>
									<td><input type="text" class="frm_txt" name="Embalaje" value="'.(isset($_POST['Embalaje'])?$_POST['Embalaje']:'').'" /></td>
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
									<td>Numero de serie:</td>
									<td><input type="text" class="frm_txt" name="Serie" value="'.(isset($_POST['Serie'])?$_POST['Serie']:'').'" /></td>
									</tr>

									<tr>
									<td>MAC:</td>
									<td><input type="text" class="frm_txt" name="Mac" value="'.(isset($_POST['Mac'])?$_POST['Mac']:'').'" /></td>
									</tr>


									<tr>
									<td>Especificaciones tecnicas:</td>
									<td><input type="text" class="frm_txt_long" name="Espetec" value="'.(isset($_POST['Espetec'])?$_POST['Espetec']:'').'" /></td>
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
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									</td>
									</tr>
									</table>
									</form>';
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
