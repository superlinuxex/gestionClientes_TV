<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>CRTCLIENTESCABLE- Programa conexion a cliente </title>
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
							<h3 class="title">REGISTRO DE RECONEXION DE SERVICIO A UN CLIENTE</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
                                                                        $serviciocon="4";
									require_once("logica/log_idenpaci.php");
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;
								if ($registro['Estadohoy']=="1")
								{
											echo '<div style="padding:10px 10px 10px 10px; Color:#e81a1a;">
											El cliente tiene ESTADO CONECTADO,imposible programar otra conexion
											</div>';
								}

									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
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


									<tr>
									<td>Codigo del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro['Codigo'].'" /></td>
									<td>Estatus del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
									</tr>


									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt" readonly="readonly" name="Tconexion" value="'.$serviciocon.'" /></td>




									<tr>
									<td>Fecha de reconexion:</td>
									<td><input type="text" class="frm_txt" id="Fechai" name="Fechai" value="'.date('d/m/Y').'"/></td>
									</tr>

									<tr>
									<td>Informacion adicional:</td>
									<td><input type="text" class="frm_txt_long"  name="Infoad" value="'.$registro['Infoad'].'" /></td>
									</tr>

									<tr>
									<td>Tecnico que realizó la tarea:</td>
									<td>
									<select name="Tecnico" class="frm_cmb" />
									<option value="">Seleccione un tecnico...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb33();
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Tecnico'])
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
									<td colspan="2" align="center">
									<input  type="submit" value="Hacer Reconexion"  class="frm_btn" name="aceptar"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									</td>
									</tr>
								</table>
								</form>';
								break;
							case 'post':
								if ($registro['Estadohoy']=="1")
								{
									$insertar=false;
									echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
									exit;  

								}
								if ($registro['Morahoy']>0)
								{
									echo '<div style="padding:10px 10px 10px 10px; Color:#e81a1a;">
									No puede reconectar a este cliente, tiene una mora pendiente
									</div>';

									$insertar=false;

								}

								if (isset($_POST['Tconexion'])==false or $_POST['Tconexion']=="")
								{
									echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
									Debe de ingresar el tipo de conexion que se hará al cliente
									</div>';
									$insertar=false;
									echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
									exit;  

								}
								if (isset($_POST['Fechai'])==false or $_POST['Fechai']=="")
								{
									echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
									Debe ingresar la fecha que solicita la conexion
									</div>';
									$insertar=false;
									echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
									exit;  

								}

								if ($insertar==true)
								{
									$resultado=log_conectar_idenpaci($_POST,$_GET['id'],$bodx);
									echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
									Programacion de conexion creada correctamente.
									</div>';
									unset($_POST); 
								}
								if ($insertar==false)
								 {
		 						 echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
								 echo '
								 <table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									<tr>
									<td>Codigo del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>

									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" name="Mnombre" value="'.(isset($_POST['Mnombre'])?$_POST['Mnombre']:'').'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" name="Mapellido" value="'.(isset($_POST['Mapellido'])?$_POST['Mapellido']:'').'" /></td>
									</tr>



						

									<tr>
									<td>Fecha solicitada para conectar:</td>
									<td><input type="text" class="frm_txt" id="Fechai" name="Fechai" value="'.(isset($_POST['Fechai'])?$_POST['Fechai']:'').'"/></td>
									</tr>

									<tr>
									<td>Informacion adicional:</td>
									<td><input type="text" class="frm_txt_long" name="Infoad" value="'.(isset($_POST['Infoad'])?$_POST['Infoad']:'').'" /></td>
									</tr>

									<tr>
									<td>Tecnico que realizó la tarea:</td>
									<td>
									<select name="Tecnico" class="frm_cmb" />
									<option value="">Seleccione un tecnico...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb33();
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Tecnico"]))
									 {
									  if ($_POST["Tecnico"]==$fila['Codigo'])
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
									 echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									 }
									}
									echo'
									</td>
									</tr>






											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Hacer Reconexion"  class="frm_btn" name="aceptar"/>
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
		<p>Todos los derechos reservados - Erving Chamagua, 2018</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
