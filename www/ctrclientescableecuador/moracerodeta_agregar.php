<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Registro de moras perdonadas</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fechai').datepicker({
			inline: true
		});
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
</script>



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
							<h3 class="title">Agregar registro de perdon de mora</a></h3>
							<div class="entry">
								<?php
 							   if (isset ($_POST['id']))
							     {
							      $clie1=$_POST['id'];
							     }
							     else
							     {
							      $clie1=$_GET['id'];
							     }
                                if($clie1!="")
				{
					$_SESSION["ccliente"]=$clie1;
                                        $clie=$_SESSION["ccliente"];
                                }
				else
				{
                                        $clie=$_SESSION["ccliente"];
                                }

				//Buscando el nombre del cliente y la mora pendiente
                                require_once("logica/log_idenpaci.php");
                                $resultado=log_obtener_idenpaci2($clie,$_SESSION["idBodega"]);
				$registro=mysql_fetch_array($resultado);
                                $nombreclie=$registro['Mnombre']." ".$registro['Mapellido'];	
                                $mora=$registro['Morahoy'];	






									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=moracerodeta.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Mmotivo'])==false or $_POST['Mmotivo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe ingresar el motivo por el que se esta perdonando la mora
											</div>';
											$insertar=false;
										}


										if (isset($_POST['Mvalor'])==false or $_POST['Mvalor']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar el valor de la mora perdonada
											</div>';
											$insertar=false;
										}

										if ($_POST['Mvalor']>$mora)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											El valor a perdonar no puede ser mayor a la mora											</div>';
											$insertar=false;
										}


										if (isset($_POST['Fechai'])==false or $_POST['Fechai']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe digitar la fecha del movimiento
											</div>';
											$insertar=false;
										}
								        
										if ($insertar==true)
										{
											require_once("logica/log_moracerodeta.php");
											$resultado=log_insertar_moracerodeta($_POST,$bodx,$mora);
                 									IF($resultado==1){
											 echo '<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											 Registro ya existe en la tabla, imposible adicionar.	
											</div>';
											}
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=moracerodeta.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Codigo del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente" value="'.$clie.'" /></td>
									</tr>

									<tr>
									<td>Nombre:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mnombreclie" value="'.$nombreclie.'" /></td>
									</tr>


									<tr>
									<td>Mora pendiente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mora" value="'.$mora.'" /></td>
									</tr>


									<tr>
									<td>Fecha del movimiento:</td>
									<td><input type="text" class="frm_txt" id="Fechai" name="Fechai" value="'.(isset($_POST['Fechai'])?$_POST['Fechai']:'').'"/></td>
									</tr>


									<tr>
									<td>Motivo del perdon de la mora:</td>
									<td><input type="text" class="frm_txt_long" name="Mmotivo" value="'.(isset($_POST['Mmotivo'])?$_POST['Mmotivo']:'').'" /></td>
									</tr>

									<tr>
									<td>Monto que desea dejar como mora pendiente:</td>
									<td><input type="text" class="frm_txt" name="Mvalor" value="'.(isset($_POST['Mvalor'])?$_POST['Mvalor']:'').'" /></td>
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
