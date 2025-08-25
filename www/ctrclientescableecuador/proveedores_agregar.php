<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Agregar Proveedores </title>
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
							<h3 class="title">Agregar Proveedores</a></h3>
							<div class="entry">
								<?php
									require_once("logica/log_proveedores.php");
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proveedor.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Codigo para el proveedor que desea ingresar
											</div>';
											$insertar=false;
																													}
										if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Nombre para el proveedor que desea ingresar
											</div>';
											$insertar=false;
										}
										if ($insertar==true)
										{
											$resultado=log_insertar_proveedor($_POST);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proveedor.php">';    
										exit;    

										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									<tr>
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Nombre de la empresa:</td>
									<td><input type="text" class="frm_txt_long" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Giro de la empresa:</td>
									<td><input type="text" class="frm_txt_long" name="Giro" value="'.(isset($_POST['Giro'])?$_POST['Giro']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Nombre de primer persona contacto:</td>
									<td><input type="text" class="frm_txt_long" name="Contacto" value="'.(isset($_POST['Contacto'])?$_POST['Contacto']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Nombre de segunda persona contacto:</td>
									<td><input type="text" class="frm_txt_long" name="Contac2" value="'.(isset($_POST['Contac2'])?$_POST['Contac2']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Area de la empresa para localizar al contacto:</td>
									<td><input type="text" class="frm_txt_long" name="Area" value="'.(isset($_POST['Area'])?$_POST['Area']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Direccion" value="'.(isset($_POST['Direccion'])?$_POST['Direccion']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt" name="Telefonos" value="'.(isset($_POST['Telefonos'])?$_POST['Telefonos']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Telefonos moviles:</td>
									<td><input type="text" class="frm_txt" name="Telefonosm" value="'.(isset($_POST['Telefonosm'])?$_POST['Telefonosm']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Ciudad:</td>
									<td><input type="text" class="frm_txt_long" name="Ciudad" value="'.(isset($_POST['Ciudad'])?$_POST['Ciudad']:'').'" /></td>									</tr>
									<tr>


									<tr>
									<td>Pais:</td>
									<td><input type="text" class="frm_txt_long" name="Pais" value="'.(isset($_POST['Pais'])?$_POST['Pais']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Registro fiscal:</td>
									<td><input type="text" class="frm_txt" name="Rfiscal" value="'.(isset($_POST['Rfiscal'])?$_POST['Rfiscal']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>NIT:</td>
									<td><input type="text" class="frm_txt" name="Nit" value="'.(isset($_POST['Nit'])?$_POST['Nit']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>ABA:</td>
									<td><input type="text" class="frm_txt" name="Aba" value="'.(isset($_POST['Aba'])?$_POST['Aba']:'').'" /></td>
									</tr>
									<tr>




									<tr>
									<td>SWIFT:</td>
									<td><input type="text" class="frm_txt" name="Sw" value="'.(isset($_POST['Sw'])?$_POST['Sw']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Primer correo electronico:</td>
									<td><input type="text" class="frm_txt_long" name="Email" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Segundo correo electronico:</td>
									<td><input type="text" class="frm_txt_long" name="Email2" value="'.(isset($_POST['Email2'])?$_POST['Email2']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Tercer correo electronico:</td>
									<td><input type="text" class="frm_txt_long" name="Email3" value="'.(isset($_POST['Email3'])?$_POST['Email3']:'').'" /></td>
									</tr>
									<tr>


									<tr>
									<td>Sitio Web:</td>
									<td><input type="text" class="frm_txt_long" name="Url" value="'.(isset($_POST['Url'])?$_POST['Url']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Estatus:</td>
									<td>
										<select name="Estatus" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estatus'])?($_POST['Estatus']==1?' selected="selected" ':''):'').'>ACTIVO</option>
											<option value="2" '.(isset($_POST['Estatus'])?($_POST['Estatus']==2?' selected="selected" ':''):'').'>INACTIVO</option>
										</select>
									</td>
									</tr>

									<tr>
									<td>Codigo postal:</td>
									<td><input type="text" class="frm_txt" name="Cpostal" value="'.(isset($_POST['Cpostal'])?$_POST['Cpostal']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Dias de credito que concede:</td>
									<td><input type="text" class="frm_txt" name="Creditod" value="'.(isset($_POST['Creditod'])?$_POST['Creditod']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Limite de crédito:</td>
									<td><input type="text" class="frm_txt" name="Creditol" value="'.(isset($_POST['Creditol'])?$_POST['Creditol']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Porcentaje de descuento:</td>
									<td><input type="text" class="frm_txt" name="Descu" value="'.(isset($_POST['Descu'])?$_POST['Descu']:'').'" /></td>
									</tr>
									<tr>

									<tr>
									<td>Procedencia:</td>
									<td>
										<select name="Procedencia" class="frm_cmb">
											<option value="1" '.(isset($_POST['Procedencia'])?($_POST['Procedencia']==1?' selected="selected" ':''):'').'>NACIONAL</option>
											<option value="2" '.(isset($_POST['Procedencia'])?($_POST['Procedencia']==2?' selected="selected" ':''):'').'>EXTRANJERO</option>
										</select>
									</td>
									</tr>

									<tr>
									<td>Observaciones adicionales:</td>
									<td><input type="text" class="frm_txt_long" name="Obs" value="'.(isset($_POST['Obs'])?$_POST['Obs']:'').'" /></td>
									</tr>
									<tr>



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
