<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Agregar registros de cambios de planes de pago </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />

<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>

<script type="text/javascript">
function FiltrarProductos(str)
{
var xmlhttp;    
if (window.XMLHttpRequest)
  {// codigo para IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// codigo para  IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("prod").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cmbFiltroProd.php?prod="+str,true);
xmlhttp.send();
}
</script>

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

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fechaf').datepicker({
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
							<h3 class="title">Agregar cambios de plan de pago por un cliente</a></h3>
							<div class="entry">
								<?php
 							   if (isset ($_POST['idcliente']))
							     {
							      $codclie=$_POST['idcliente'];
							     }
							     else
							     {
							      $codclie=$_GET['idcliente'];
							     }

									require_once("logica/log_cambiopldeta.php");

                                                                        $bodega=$_SESSION["idBodega"];
 
									echo '&nbsp;&nbsp;Codigo del cliente:&nbsp;'.$codclie;
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cambiopldeta.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{

										//Validando vigencia de plan asignado
										require_once("logica/log_idenpaci.php");
										$resultado=log_veplanvige_idenpaci($_POST["Mttplan"]);
                 								IF($resultado==0){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										 No puede asignar ese plan de pago mensual, el plan indicado no está vigente.
										 </div>';
 										 $insertar=false;
										}

										//Validando que el cliente esté conectado
										require_once("logica/log_idenpaci.php");
										$resultado=log_vestadocliente($_POST["Cod_cliente"]);
                 								IF($resultado==0){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										 No puede cambiar plan al cliente porque esta desconectado
										 </div>';
 										 $insertar=false;
										}


										if (isset($_POST['Fechai'])==false or $_POST['Fechai']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar la del cambio de plan
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Mttplan'])==false or $_POST['Mttplan']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar el nuevo ppla que tendra el cliente
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Motivo'])==false or $_POST['Motivo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe especificar el motivo por el que esta cambiando de plan el cliente
											</div>';
											$insertar=false;
										}

										
										if ($insertar==true)
										{
											$resulatado=log_insertar_cambiopldeta($_POST,$bodega);
                                                                                        if($resulatado==0)
											{
											echo'<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Hay problemas con los datos ingresados, reviselos
											</div>';
											}
											else
											{
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Registro ingresado correctamente.
											</div>';
											}
											unset($_POST); 
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cambiopldeta.php">';    
										exit;    
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<td><input type="text" class="frm_txt" hidden="true" name="Cod_cliente" value="'.$codclie.'"/></td>

									<tr>
									<td>Fecha del cambio de plan:</td>
									<td><input type="text" class="frm_txt" id="Fechai" name="Fechai" value="'.(isset($_POST['Fechai'])?$_POST['Fechai']:'').'"/></td>
									</tr>

									<tr>
									<td>Nuevo plan contratado:</td>
									<td>
									<select name="Mttplan" class="frm_cmb" />
									<option value="">Seleccione un plan...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_planes_cmb3($bodega);
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Mttplan"]))
									   {
									    if ($_POST["Mttplan"]==$fila['Codigo'])
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
									    echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."- Costo $".$fila['Costo']." </option>";
									   }
									 }
									 echo'
									 </td>	
									 </tr>


									<tr>
									<td>Motivo por el que se cambia de plan:</td>
									<td><input type="text" class="frm_txt_long" id="Motivo" name="Motivo" value="'.(isset($_POST['Motivo'])?$_POST['Motivo']:'').'"/></td>
									</tr>

					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									<input  type="hidden" value="'.$codigo_entrada.'" class="frm_btn" name="CodEntrada"/>
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
