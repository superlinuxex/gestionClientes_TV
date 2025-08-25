<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de empleados </title>
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
							<h3 class="title">Agregar Registro de empleados</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=vendedores.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el codigo para el vendedor que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Nombres'])==false or $_POST['Nombres']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Nombre para el vendedor que desea ingresar
											</div>';
											$insertar=false;
										}

										require_once("logica/log_vendedores.php");
										$resultado=log_veexisreg_vendedores($_POST,$bodx);
                 								IF($resultado==1){
										 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										 Registro Ya existe, imposible guardar.
										 </div>';
 										 $insertar=false;
										}

									        
										if ($insertar==true)
										{
											require_once("logica/log_vendedores.php");
											$resultado=log_insertar_vendedores($_POST,$bodx,$usux);
                 									IF($resultado==1){
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											 Registro ya existe en la tabla, imposible adicionar.	
											</div>';
											}
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=vendedores.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Codigo (numero sin letras):</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>

									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt_long" name="Nombres" value="'.(isset($_POST['Nombres'])?$_POST['Nombres']:'').'" /></td>
									</tr>

									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" name="Apellidos" value="'.(isset($_POST['Apellidos'])?$_POST['Apellidos']:'').'" /></td>
									</tr>

									<tr>
									<td>Dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Direccion" value="'.(isset($_POST['Direccion'])?$_POST['Direccion']:'').'" /></td>
									</tr>

									<tr>
									<td>Telefono:</td>
									<td><input type="text" class="frm_txt" name="Telefono" value="'.(isset($_POST['Telefono'])?$_POST['Telefono']:'').'" /></td>
									</tr>

									<tr>
									<td>Cargo:</td>
									<td><input type="text" class="frm_txt_long" name="Cargo" value="'.(isset($_POST['Cargo'])?$_POST['Cargo']:'').'" /></td>
									</tr>

									<tr>
									<td>Clasificación del cargo:</td>
									<td>
										<select name="Tipoe" class="frm_cmb">
											<option value="1" '.(isset($_POST['Tipoe'])?($_POST['Tipoe']==1?' selected="selected" ':''):'').'>Administrativo</option>
											<option value="2" '.(isset($_POST['Tipoe'])?($_POST['Tipoe']==2?' selected="selected" ':''):'').'>Tecnico</option>
											<option value="3" '.(isset($_POST['Tipoe'])?($_POST['Tipoe']==3?' selected="selected" ':''):'').'>Comercializacion</option>
										</select>
									</td>
									</tr>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt_long" name="Email" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									</tr>

									<tr>
									<td>Sucursal donde labora:</td>
									<td>
									<select name="Bodega" class="frm_cmb" />
									<option value="">Seleccione una sucursal...</option>';
									require_once("./logica/log_bodegas.php");
									$resultado=log_obtener_bodegas_cmb();
									while ( $fila = mysql_fetch_array($resultado))
										{
										if ($fila['Codigo']==$_SESSION["idBodega"])
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
