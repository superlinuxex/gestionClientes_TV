<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>CRTCLIENTESCABLE - Mantenimiento de Actividades tecnicas </title>
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
		$('#Fecha').datepicker({
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
							<h3 class="title">Programar y asignar actividades tecnicas para atender a clientes</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=actitecni.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
									
									     //Verifica si es una conexion nueva y si esta desconectado el cliente
									     require_once("logica/log_actitecni.php");
									     $resultado=log_validaconexion_actitecni($_POST['Tconexion'],$_POST['Cliente'],$bodx);
                 							     IF($resultado==1){
									   	echo'<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
									   	Usted quiere conectar a un cliente que ya esta conectado. Imposible programar esta actividad tecnica
									   	</div>';
									   	$insertar=false;
									     }

										if (isset($_POST['Cliente'])==false or $_POST['Cliente']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el cliente al que atender
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Tconexion'])==false or $_POST['Tconexion']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la actividad tecnica que se realizará
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la fecha de la tecnica que se realizará
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Tecnico'])==false or $_POST['Tecnico']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el tecnico que realizará el trabajo
											</div>';
											$insertar=false;
										}
									        
										if ($insertar==true)
										{
											require_once("logica/log_actitecni.php");
											$resultado=log_insertar_actitecni($_POST,$bodx,$usux);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=actitecni.php">';    
										exit;    
 
										}										
									}

									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									 <tr>
									 <td>Buscar cliente por codigo o apellidos </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista de todos los clientes)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codcliente" value="'.(isset($_POST['Codcliente'])?$_POST['Codcliente']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Lista de clientes según busqueda realizada:</td>
									<td>
									<select name="Cliente" class="frm_cmb_long" />
									<option value="">Seleccione un Cliente...</option>';
									require_once("./logica/log_idenpaci.php");
									$resultado=log_obtener_idenpaci_cmb_actitec($bodx,$hcodclie);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Cliente"]))
									  {
									  if ($_POST["Cliente"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'>Codigo:".$fila['Codigo']."&nbsp".'Nombre:'.$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	

									<tr>
									<td>Actividad a realizar:</td>
									<td>
									<select name="Tconexion" class="frm_cmb" />
									<option value="">Seleccione un tipo de servicio tecnico...</option>';
									require_once("./logica/log_servicios.php");
									$resultado=log_obtener_servicios_cmbtecnicoadi2();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Tconexion"]))
									   {
									    if ($_POST["Tconexion"]==$fila['Codigo'])
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
									<td>Detalles adicionales sobre la tarea:</td>
									<td><input type="text" class="frm_txt_long" name="Detalles" value="'.(isset($_POST['Detalles'])?$_POST['Detalles']:'').'" /></td>
									</tr>
								

									<tr>
									<td>Fecha programada para realizar la tarea:</td>
									<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
									</tr>


									<tr>
									<td>Tecnico que realizará la tarea:</td>
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
