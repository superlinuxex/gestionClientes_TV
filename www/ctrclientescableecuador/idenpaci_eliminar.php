<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customesrcabletv- Eliminar registro de clientes </title>
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
							<h3 class="title">Eliminar Registro de Clientes</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("./logica/log_idenpaci.php");
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$mostrar_datos=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										
										$resulatado=log_eliminar_idenpaci($_GET["id"],$bodx);
										echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										Registro eliminado correctamente.
										</div>';
										$mostrar_datos=false;
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'" >';
									if ($mostrar_datos==true)
									{
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									<tr>
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro['Codigo'].'" /></td>
									<td>Estatus del cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
									</tr>


									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
										<td>
										<select name="Msexo"  class="frm_cmb">
										<option value="1" '.($registro['Msexo']==1?' selected="selected" ':'').'>Masculino</option>											
										<option value="2" '.($registro['Msexo']==2?' selected="selected" ':'').'>Femenino</option>											
										<option value="3" '.($registro['Msexo']==2?' selected="selected" ':'').'>Persona Moral</option>											
										</select>
										</td>

									<td>No.Identificacion RFC:</td>
									<td><input type="text" class="frm_txt" name="Mdui" value="'.$registro['Mdui'].'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt" name="Mnit" value="'.$registro['Mnit'].'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mregistro" value="'.$registro['Mregistro'].'" /></td>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt_long" name="Mtelefono" value="'.$registro['Mtelefono'].'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" class="frm_txt_long" name="Mcelu" value="'.$registro['Mcelu'].'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt" name="Mttpersona" value="'.$registro['Mttpersona'].'" /></td>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" value="'.$registro['Email'].'" /></td>
									</tr>


									<tr>
									<td>Tipo de Servicio:</td>
									<td><input type="text" class="frm_txt_long" name="Actividad" value="'.$registro['Actividad'].'" /></td>
									</tr>


									<tr>
									<td><h3 class="title">LOCALIZACION</a></h3></td>
									</tr>

									<tr>
									<td>Estado:</td>
									<td>
									 <select name="Partida" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
									 <option value="">Seleccione un Estado...</option>';
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
									<td>Municipio:</td>
									<td>
									 <select name="SubPartidas" id="SubPartidas" class="frm_cmb_long" />
									 <option value="">Seleccione un Municipio...</option>';
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
									<td>Poblacion:</td>
									<td>
									 <select name="SubPartidas_a"  id="SubPartidas_a" class="frm_cmb_long" />
									 <option value="">Seleccione una Poblacion...</option>';
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
									<td>Barrio:</td>
									<td>
									 <select name="SubPartidas_b"  id="SubPartidas_b" class="frm_cmb_long" />
									 <option value="">Seleccione un Barrio...</option>';
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
									<td>Sector:</td>
									<td>
									<select name="Mzona" class="frm_cmb" />
									<option value="">Seleccione un Sector...</option>';
									require_once("./logica/log_zonas.php");
									$resultado=log_obtener_zona_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
									      if ($fila['Codigo']==$registro['Mzona'])
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
									<td>Referencias:</td>
									<td><input type="text" class="frm_txt" name="Mcalle" value="'.$registro['Mcalle'].'" /></td>
									<td>Caja Distribucion:</td>
									<td><input type="text" class="frm_txt" name="Mpoligono" value="'.$registro['Mpoligono'].'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt" name="Mave" value="'.$registro['Mave'].'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mpasaje" value="'.$registro['Mpasaje'].'" /></td>

									<td><input type="hidden" class="frm_txt" name="Mcasa" value="'.$registro['Mcasa'].'"/></td>
									<td><input type="hidden" class="frm_txt" name="Mcontaelec" value="'.$registro['Mcontaelec'].'"/></td>

									<tr>
									<td>Dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Motraref" value="'.$registro['Motraref'].'"/></td>
									<td>Numero de IP:</td>
									<td><input type="text" class="frm_txt" name="Mblocke" value="'.$registro['Mblocke'].'"/></td>
									</tr>

									<td><input type="HIDDEN" class="frm_txt" readonly="readonly" name="Mgeo" value="'.$registro['Mgeo'].'"/></td>




									<tr>
									<td><h3 class="title">CONTRATACION</a></h3></td>
									</tr>

									<tr>
									<td>No.de contrato:</td>
									<td><input type="text" class="frm_txt" name="Mcontrato" value="'.$registro['Mcontrato'].'"/></td>
									<td>Dia de pago:</td>
									<td><input type="text" class="frm_txt" name="Mfechap" value="'.$registro['Mfechap'].'"/></td>
									</tr>

									<td><input type="hidden" class="frm_txt" name="Mvendedor" value="'.$registro['Mvendedor'].'" /></td>



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
									<td>Tipo de factura:</td>
										<td>
										<select name="Mttfactura" class="frm_cmb">
										<option value="1" '.($registro['Mttfactura']==1?' selected="selected" ':'').'>Consumidor</option>											
										<option value="2" '.($registro['Mttfactura']==2?' selected="selected" ':'').'>Factura</option>											
										<option value="3" '.($registro['Mttfactura']==3?' selected="selected" ':'').'>Recibo</option>											
										</select>
										</td>
	    							        </tr>


									<tr>
									<td>Renovación de contrato:</td>
									<td><input type="text" class="frm_txt" id="Mfechai" name="Mfechai" value="'.$registro['Mfechai'].'"/></td>
									<td>Periodo contrato:</td>
										<td>
										 <select name="Mcodperi" class="frm_cmb" />
										  <option value="">Seleccione un periodo...</option>';
										  require_once("./logica/log_pericon.php");
										  $resultado=log_obtener_pericon_cmb();
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Mcodperi'])
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


					

									<td><input type="hidden" class="frm_txt" name="Mcod_vende" value="'.$registro['Mcod_vende'].'" /></td>


									<tr>

									<td>Monto del pago mensual:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mmonto" value="'.$registro['Mmonto'].'"/></td>
									<td>Conexiones Extra:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcone" value="'.$registro['Mcone'].'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" readonly="readonly" name="Caduca" value="'.$diferencia.'"/></td>


									<tr>
									<td>Latitud/Longitud:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mlongilati" value="'.$registro['Mlongilati'].'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" readonly="readonly" name="Mmarcha" value="'.$registro['Mmarcha'].'"/></td>
									<td><input type="hidden" class="frm_txt" readonly="readonly" name="Mposte" value="'.$registro['Mposte'].'"/></td>



									<tr>
									<td><h3 class="title">MOVIMIENTOS</a></h3></td>
									</tr>


									<tr>
									<td>FECHA DE CONEXION:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaip" value="'.$registro['Fechaip'].'" /></td>
									</tr>


									<td bgcolor="#00FF00">Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicial :</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago1" value="'.$registro['Ulfepago1'].'" /></td>
									</tr>

									<tr>

									<td>Fecha final:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago2" value="'.$registro['Ulfepago2'].'" /></td>
									</tr>


									<tr>
									<td>Mes pagado:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulmespago" value="'.$registro['Ulmespago'].'" /></td>
									</tr>

									<tr>
									<td>Fecha ultimo pago:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaul" value="'.$registro['Fechaul'].'" /></td>
									</tr>

									<tr>
									<td>Monto ultimo pago:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulpago" value="'.$registro['Ulpago'].'" /></td>
									</tr>


									<td bgcolor="#00FF00">Gestion de cobros</td>
									<tr>
									<td>Fecha ultima llamada de cobro:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaulme" value="'.$registro['Fechaulme'].'" /></td>
									</tr>

									<td bgcolor="#00FF00">Datos de desconexion</td>
									<tr>
									<td>Mora al desconectar:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Morahoy" value="'.$registro['Morahoy'].'" /></td>
									</tr>

									<tr>
									<td>Abonos a la mora:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Abonosmora" value="'.$registro['Abonosmora'].'" /></td>
									</tr>

									<tr>
									<td>Fecha desconexion:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fedesco" value="'.$registro['Fedesco'].'" /></td>
									</tr>

									<tr>
									<td>Motivo desconexion:</td>
										<td>
										 <select name="Motidesco" disabled="true" class="frm_cmb_long" />
										  <option value="">Seleccione un motivo de desconexion...</option>';
										  require_once("./logica/log_motidesco.php");
										  $resultado=log_obtener_motidesco_cmb();
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Motidesco'])
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
									<td>Fecha Registro:</td>
									<td><input type="text"  class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Mfechaentra'].'"/></td>
									</tr>



									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Mobservacion" value="'.$registro['Mobservacion'].'"/></td>
									</tr>



										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Eliminar"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										</td>
										</tr>
										</table>
										</form>';
									}
									else
									{
										echo'<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
										</td>
										</tr>
										</table>
										</form>';
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
