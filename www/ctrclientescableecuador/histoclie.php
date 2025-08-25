<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>customerscabletv- Historico de clientes </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />


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
							<h3 class="title">Registro historico del cliente</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_idenpaci.php");
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;

									if(empty($_POST['facturas']) and empty($_POST['cancelar']) and empty($_POST['llamadas']) and empty($_POST['activi']) and empty($_POST['planes']) and empty($_POST['morasper']) and empty($_POST['cta']) and empty($_POST['histopago']))
									{
											$mostrar_datos='get';
									}
									else
									{
										if (isset($_POST['facturas']))
										{
										 PRINT "EL CLIENTE CON CODIGO: ".$registro['Codigo']." ";
										 PRINT "Y NOMBRE: ".$registro['Mnombre']." ".$registro['Mapellido'];
										 PRINT "TIENE LAS SIGUIENTES FACTURAS PAGADAS";
  										 require_once("./logica/log_idenpaci.php");
										 include ("./utils/crear_tabla.php");
										 $total_registros=log_obtener_num_listafac($_GET["id"],$bodx,'');
										 if(!isset($_GET["pagina"]))
 										  {
											$comienzo = 0;
											$num_pag = 1;
										  }
										  else
										  {
										    $num_pag=$_GET["pagina"];
										    $comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
										  }
										  $regis=$_GET["id"];
										  $listafac=log_obtener_listafac($_GET["id"],$_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],'');
										  $campos = array("Factura","Fecha","Concepto","Estado","Cantidad","Precio","Total");
										  crear_tabla($listafac, $campos,'listafac','histoclie.php',false,"listafac_editar.php",
										  "listafac_eliminar.php","listafac.php","histoclie.php?id=$regis","vacio.php");
										  echo "<div style=\"padding:15px;\" align=\"center\">";
										  //paginacion ($num_pag,$total_registros,"histoclie.php?pagina=");
										  echo"</div>";   
										 }

										if (isset($_POST['llamadas']))
										{
										 PRINT "EL CLIENTE CON CODIGO: ".$registro['Codigo']." ";
										 PRINT "Y NOMBRE: ".$registro['Mnombre']." ".$registro['Mapellido'];
										 PRINT "TIENE EL SIGUIENTE REGISTRO DE LLAMADAS";
  										 require_once("./logica/log_idenpaci.php");
										 include ("./utils/crear_tabla.php");
										 $total_registros=log_obtener_num_listallama($_GET["id"],$bodx,'');
										 if(!isset($_GET["pagina"]))
 										  {
											$comienzo = 0;
											$num_pag = 1;
										  }
										  else
										  {
										    $num_pag=$_GET["pagina"];
										    $comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
										  }
										  $regis=$_GET["id"];
										  $listallama=log_obtener_listallama($_GET["id"],$_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],'');
										  $campos = array("Fecha","Hora","Minu","Motivo","Respuesta","Comentario","Empleado");
										  crear_tabla($listallama, $campos,'listafac','histoclie.php',false,"listafac_editar.php",
										  "listafac_eliminar.php","listafac.php","histoclie.php?id=$regis","vacio.php");
										  echo "<div style=\"padding:15px;\" align=\"center\">";
										  //paginacion ($num_pag,$total_registros,"histoclie.php?pagina=");
										  echo"</div>";   
										 }

										if (isset($_POST['activi']))
										{
										 PRINT "EL CLIENTE CON CODIGO: ".$registro['Codigo']." ";
										 PRINT "Y NOMBRE: ".$registro['Mnombre']." ".$registro['Mapellido'];
										 PRINT "TIENE EL SIGUIENTE REGISTRO DE ATENCION TECNICA";
  										 require_once("./logica/log_idenpaci.php");
										 include ("./utils/crear_tabla.php");
										 $total_registros=log_obtener_num_listaacti($_GET["id"],$bodx,'');
										 if(!isset($_GET["pagina"]))
 										  {
											$comienzo = 0;
											$num_pag = 1;
										  }
										  else
										  {
										    $num_pag=$_GET["pagina"];
										    $comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
										  }
										  $regis=$_GET["id"];
										  $listallama=log_obtener_listaacti($_GET["id"],$_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],'');
										  $campos = array("Asignado","Servicio dado","Detalle de tarea","Tecnico","Realizado","Observaciones","Reprogramado");
										  crear_tabla($listallama, $campos,'listafac','histoclie.php',false,"listafac_editar.php",
										  "listafac_eliminar.php","listafac.php","histoclie.php?id=$regis","vacio.php");
										  echo "<div style=\"padding:15px;\" align=\"center\">";
										  //paginacion ($num_pag,$total_registros,"histoclie.php?pagina=");
										  echo"</div>";   
										 }

										if (isset($_POST['planes']))
										{
										 PRINT "EL CLIENTE CON CODIGO: ".$registro['Codigo']." ";
										 PRINT "Y NOMBRE: ".$registro['Mnombre']." ".$registro['Mapellido'];
										 PRINT "TIENE EL SIGUIENTE REGISTRO DE PLANES";
  										 require_once("./logica/log_idenpaci.php");
										 include ("./utils/crear_tabla.php");
										 $total_registros=log_obtener_num_listaplanes($_GET["id"],$bodx,'');
										 if(!isset($_GET["pagina"]))
 										  {
											$comienzo = 0;
											$num_pag = 1;
										  }
										  else
										  {
										    $num_pag=$_GET["pagina"];
										    $comienzo=($num_pag-1)*$_SESSION['cant_reg_pag'];
										  }
										  $regis=$_GET["id"];
										  $listaplan=log_obtener_listaplanes($_GET["id"],$_SESSION["idBodega"],$comienzo,$_SESSION["cant_reg_pag"],'');
										  $campos = array("Fecha","Plan","Nombre del plan","Cuota mensual","Motivo del cambio de plan");
										  crear_tabla($listaplan, $campos,'listafac','histoclie.php',false,"listafac_editar.php",
										  "listafac_eliminar.php","listafac.php","histoclie.php?id=$regis","vacio.php");
										  echo "<div style=\"padding:15px;\" align=\"center\">";
										  //paginacion ($num_pag,$total_registros,"histoclie.php?pagina=");
										  echo"</div>";   
										 }

										if (isset($_POST['morasper']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=imprimir_morasper.php?
											id='.$registro['Codigo'].'&bod='.$_SESSION["idBodega"].'">';
										 }

										if (isset($_POST['cta']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=imprimir_estado_cta.php?
											id='.$registro['Codigo'].'&bod='.$_SESSION["idBodega"].'">';
										 }

										if (isset($_POST['histopago']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=imprimir_histo_pagos.php?
											id='.$registro['Codigo'].'&bod='.$_SESSION["idBodega"].'">';
										 }

									  	 if(isset($_POST['cancelar']))
										  {
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
											exit;  
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
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro['Codigo'].'" /></td>
									<td bgcolor="#00FF00">ESTADO:</td>
									<td bgcolor="#00FF00"><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
									</tr>


									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>


									<tr>
									<td>Plan contratado:</td>
										<td>
										 <select name="Mttplan" disabled="true" class="frm_cmb" />
										  <option value="">Seleccione un plan...</option>';
										  require_once("./logica/log_planes.php");
										  $resultado=log_obtener_planes_cmb();
										  while ( $fila2 = mysql_fetch_array($resultado))
										   {
										      if ($fila2['Codigo']==$registro['Mttplan'])
										      {
										        echo '<option value="'.$fila2['Codigo'].'" selected="selected">'.$fila2['Nombre'].'</option>';
										      }
											else
										      {
											echo "<option value='".$fila2['Codigo']."'> ".$fila2['Nombre']."</option>";
										      }
  										   }
										   echo'
										  </td>									
	    							        </tr>

									<tr>
									<td>Monto del pago mensual:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mmonto" value="'.$registro['Mmonto'].'"/></td>
									</tr>


									<tr>
									<td>Gestor de cobros:</td>
										<td>
										 <select name="Mcod_vende" disabled="true" class="frm_cmb" />
										  <option value="">Seleccione un gestor de cobro...</option>';
										  require_once("./logica/log_vendedores.php");
										  $resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Mcod_vende'])
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

									<td>Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicio  del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago1" value="'.$registro['Ulfepago1'].'" /></td>
									</tr>

									<tr>
									<td>Fecha final del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago2" value="'.$registro['Ulfepago2'].'" /></td>
									</tr>

									<tr>
									<td>Departamento:</td>
									<td>
									 <select name="Partida" id="Partida" disabled="true" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
									 <option value="">Seleccione un Departamento...</option>';
									 require_once("./logica/log_deptos.php");
									 $resultado=log_obtener_deptos_cmb();
									 while ( $fila1 = mysql_fetch_array($resultado))
									   {
										if ($fila1['Codigo']==$registro['Partida'])
									 	{
										 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Nombre'].' </option>';
										}
										else
										{
										echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
										}
									  }
									echo'
									</td>	
									</tr>



									<tr>
									<td>Ciudad:</td>
									<td>
									 <select name="SubPartidas" id="SubPartidas" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione una ciudad...</option>';
									 require_once("./logica/log_municipios.php");
									 $resultado=log_obtener_municipios_cmb($registro['Partida']);
									 while ( $fila1 = mysql_fetch_array($resultado))
									   {
										if ($fila1['Codd']==$registro['Partida'] and $fila1['Codigo']==$registro['SubPartidas'])
									 	{
										 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Nombre'].' </option>';
										}
										else
										{
										echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
										}
									  }
									echo'
									</td>	
									</tr>


									<tr>
									<td>Region:</td>
									<td>
									 <select name="SubPartidas_a"  id="SubPartidas_a" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione una region...</option>';
									 require_once("./logica/log_cantones.php");
									 $resultado=log_obtener_cantones_cmb($registro['Partida'],$registro['SubPartidas']);
									 while ( $fila1 = mysql_fetch_array($resultado))
									   {
										if ($fila1['Codd']==$registro['Partida'] and $fila1['Codmuni']==$registro['SubPartidas'] and $fila1['Codigo']==$registro['SubPartidas_a'])
									 	{
										 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Nombre'].' </option>';
										}
										else
										{
										echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
										}
									  }
									echo'
									</td>	
									</tr>

							
									<tr>
									<td>Localidad:</td>
									<td>
									 <select name="SubPartidas_b"  id="SubPartidas_b" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione una localidad...</option>';
									 require_once("./logica/log_barrios.php");
									 $resultado=log_obtener_barrios_cmb($registro['Partida'],$registro['SubPartidas'],$registro['SubPartidas_a']);
									 while ( $fila1 = mysql_fetch_array($resultado))
									   {
										if ($fila1['Codd']==$registro['Partida'] and $fila1['Codmuni']==$registro['SubPartidas'] and $fila1['Codcan']==$registro['SubPartidas_a'] and $fila1['Codigo']==$registro['SubPartidas_b'])
									 	{
										 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Nombre'].' </option>';
										}
										else
										{
										echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
										}
									  }
									echo'
									</td>	
									</tr>


									<tr>
									<td>Urbanizacion:</td>
									<td>
									 <select name="SubPartidas_c"  id="SubPartidas_c" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione una Urbanizacion...</option>';
									 require_once("./logica/log_caserios.php");
									 $resultado=log_obtener_caserio_cmb($registro['Partida'],$registro['SubPartidas'],$registro['SubPartidas_a'],$registro['SubPartidas_b']);
									 while ( $fila1 = mysql_fetch_array($resultado))
									   {
										if ($fila1['Codd']==$registro['Partida'] and $fila1['Codmuni']==$registro['SubPartidas'] and $fila1['Codcan']==$registro['SubPartidas_a'] and $fila1['Codbar']==$registro['SubPartidas_b'] and $fila1['Codigo']==$registro['SubPartidas_c'])
									 	{
										 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Nombre'].' </option>';
										}
										else
										{
										echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
										}
									  }
									echo'
									</td>	
									</tr>


									<tr>
									<td>Calle:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcalle" value="'.$registro['Mcalle'].'" /></td>
									</tr>


									<tr>
									<td>Avenida:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mave" value="'.$registro['Mave'].'" /></td>
									<td>Pasaje:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mpasaje" value="'.$registro['Mpasaje'].'" /></td>
									</tr>
									

									<tr>
									<td>Poligono:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mpoligono" value="'.$registro['Mpoligono'].'" /></td>
									<td>Block:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mblocke" value="'.$registro['Mblocke'].'"/></td>
									</tr>

									<tr>
									<td>No.de casa:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcasa" value="'.$registro['Mcasa'].'"/></td>
									<td>No.Contador Eléctrico:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcontaelec" value="'.$registro['Mcontaelec'].'"/></td>
									</tr>

									<tr>
									<td>Otra referencia sobre la dirección:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Motraref" value="'.$registro['Motraref'].'"/></td>
									</tr>







									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mobservacion" value="'.$registro['Mobservacion'].'" /></td>
									</tr>



									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Pagos realizados"  class="frm_btn" name="facturas"/>
									<input  type="submit" value="Llamadas de cobro"  class="frm_btn" name="llamadas"/>
									<input  type="submit" value="Historial de servicio"  class="frm_btn" name="activi"/>
									<input  type="submit" value="Historial de planes"  class="frm_btn" name="planes"/>
									<input  type="submit" value="Volver lista clientes"  class="frm_btn" name="cancelar"/>
									<input  type="submit" value="Rep.Historico pagos"  class="frm_btn" name="histopago"/>
									<input  type="submit" value="Rep.Estado cuenta"  class="frm_btn" name="cta"/>
									<input  type="submit" value="Rep.Mora perdonada" class="frm_btn" name="morasper"/>
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
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>

									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt_long" name="Mnombre" value="'.(isset($_POST['Mnombre'])?$_POST['Mnombre']:'').'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" name="Mapellido" value="'.(isset($_POST['Mapellido'])?$_POST['Mapellido']:'').'" /></td>
									</tr>



						


											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Solicitar Conexion"  class="frm_btn" name="aceptar"/>
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
