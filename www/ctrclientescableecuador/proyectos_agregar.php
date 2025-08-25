<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>S I C I O - Mantenimiento de Proyectos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menu.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_form.css" type="text/css" media="screen" title="default" />
<SCRIPT LANGUAGE="JavaScript">
	function formatCurrency(num) 
	{
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + num + '.' + cents);
	}
</script>
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
							<h2 class="title">Agregar Proyecto</a></h2>
							<div class="entry">
								<?php
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proyectos.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Código para el proyecto que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Nombre'])==false or $_POST['Nombre']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Nombre para el proyecto que desea ingresar
											</div>';
											$insertar=false;
										}
										
										if (isset($_POST['Division'])==false or $_POST['Division']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe seleccionar una Division para el proyecto que desea ingresar.
											</div>';
											$insertar=false;
										}
										// if (isset($_POST['Usuario'])==false or $_POST['Usuario']=="")
										// {
											// echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											// Debe seleccionar el Usuario Responsable para el proyecto que desea ingresar.
											// </div>';
											// $insertar=false;										
										// }
										if (isset($_POST['Presupuesto'])==false or $_POST['Presupuesto']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Presupuesto para el proyecto que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Ubicacion'])==false or $_POST['Ubicacion']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la Ubicacion para el proyecto que desea ingresar
											</div>';
											$insertar=false;
										}
										if ($insertar==true)
										{
											require_once("logica/log_proyectos.php");
											$resultado=log_insertar_proyecto($_POST);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=proyectos.php">';    
										exit;    

										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									
									<tr>
									<td>Código:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Nombre:</td>
									<td><input type="text" class="frm_txt_long" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
									</tr>

									<tr>
									<td>División:</td>
									<td>
										<select name="Division" class="frm_cmb"/>
										<option value="">Seleccione una Division...</option>';
										require_once("./logica/log_divisiones.php");
										$resultado=log_obtener_divisiones_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Division"]))
											{
												if ($_POST["Division"]==$fila['Codigo'])
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
									echo'</td>
									</tr>
									<tr>

									<tr>
									<td>Responsable de Proyecto:</td>
									<td><input type="text" class="frm_txt" name="Usuario" value="'.(isset($_POST['Usuario'])?$_POST['Usuario']:'').'" /></td>
									</tr>

									<tr>
									<td>Presupuesto:</td>
									<td><input type="text" class="frm_txt" name="Presupuesto" value="'.(isset($_POST['Presupuesto'])?$_POST['Presupuesto']:'').'" onBlur="this.value=formatCurrency(this.value);" /></td>
									</tr>
									
									<tr>
									<td>Ubicación:</td>
									<td><input type="text" class="frm_txt" name="Ubicacion" value="'.(isset($_POST['Ubicacion'])?$_POST['Ubicacion']:'').'" /></td>
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
		<p>Copyright (c) 2012 ARCO INGENIEROS S.A. DE C.V. Todos los derechos reservados. Desarrollo ErvingSoft.</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
