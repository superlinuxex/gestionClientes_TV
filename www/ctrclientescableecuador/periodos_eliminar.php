<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Eliminar registro de clientes </title>
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
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
										<td>
										<select name="Msexo"  disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Msexo']==1?' selected="selected" ':'').'>Masculino</option>											
										<option value="2" '.($registro['Msexo']==2?' selected="selected" ':'').'>Femenino</option>											
										</select>
										</td>

									<td>DUI:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mdui" value="'.$registro['Mdui'].'" /></td>
									</tr>

									<tr>
									<td>NIT:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnit" value="'.$registro['Mnit'].'" /></td>
									<td>NRC:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mregistro" value="'.$registro['Mregistro'].'" /></td>
									</tr>

									<tr>
									<td>Telefono fijo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mtelefono" value="'.$registro['Mtelefono'].'" /></td>
									<td>Celular:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcelu" value="'.$registro['Mcelu'].'" /></td>
									</tr>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" disabled="true" name="Email" value="'.$registro['Email'].'" /></td>
									<td>Tipo de persona:</td>
										<td>
										<select name="Mttpersona" class="frm_cmb">
										<option value="1" '.($registro['Mttpersona']==1?' selected="selected" ':'').'>Natural</option>											
										<option value="2" '.($registro['Mttpersona']==2?' selected="selected" ':'').'>Juridica</option>											
										</select>
										</td>
									</tr>


									<tr>
									<td>Actividad Económica:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Actividad" value="'.$registro['Actividad'].'" /></td>
									</tr>


									<tr>
									<td><h3 class="title">LOCALIZACION</a></h3></td>
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
									<td>Municipio:</td>
									<td>
									 <select name="SubPartidas" id="SubPartidas" disabled="true" class="frm_cmb_long" />
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
									<td>Canton:</td>
									<td>
									 <select name="SubPartidas_a"  id="SubPartidas_a" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione un Canton...</option>';
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
									<td>Barrio o finca:</td>
									<td>
									 <select name="SubPartidas_b"  id="SubPartidas_b" disabled="true" class="frm_cmb_long" />
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
									<td>Colonia o Urb.:</td>
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
									<td>Ubicación georeferencial:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mgeo" value="'.$registro['Mgeo'].'"/></td>
									</tr>


									<tr>
									<td><h3 class="title">CONTRATACION</a></h3></td>
									</tr>

									<tr>
									<td>No.de contrato:</td>
									<td><input type="text" class="frm_txt" name="Mcontrato" value="'.$registro['Mcontrato'].'"/></td>
									<td>Vendedor contrato:</td>
										<td>
										 <select name="Mvendedor" disabled="true" class="frm_cmb" />
										  <option value="">Seleccione un vendedor...</option>';
										  require_once("./logica/log_vendedores.php");
										  $resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
										  while ( $fila = mysql_fetch_array($resultado))
										   {
										      if ($fila['Codigo']==$registro['Mvendedor'])
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
									<td>Plan contratado:</td>
										<td>
										 <select name="Mttplan" disabled="true" disabled="true" class="frm_cmb" />
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
										<select name="Mttfactura" disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Mttfactura']==1?' selected="selected" ':'').'>Consumidor final</option>											
										<option value="2" '.($registro['Mttfactura']==2?' selected="selected" ':'').'>Credito fiscal</option>											
										</select>
										</td>
	    							        </tr>


									<tr>
									<td>Renovación Contrato:</td>
									<td><input type="text" class="frm_txt" id="Mfechai" disabled="true" name="Mfechai" value="'.$registro['Mfechai'].'"/></td>
									<td>Periodo contrato:</td>
										<td>
										 <select name="Mcodperi" disabled="true" class="frm_cmb" />
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
									<td>Dia de pago:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mfechap" value="'.$registro['Mfechap'].'"/></td>
									</tr>

									<tr>
									<td><h3 class="title">DATOS TECNICOS</a></h3></td>
									</tr>

									<tr>
									<td>Latitud/Longitud:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mlongilati" value="'.$registro['Mlongilati'].'" /></td>
									<td>Conexiones Extra:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mcone" value="'.$registro['Mcone'].'" /></td>
									</tr>


									<tr>
									<td>No.Marchamos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mmarcha" value="'.$registro['Mmarcha'].'"/></td>
									<td>No.TAP:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mposte" value="'.$registro['Mposte'].'"/></td>
									</tr>

									<tr>
									<td><h3 class="title">MOVIMIENTOS</a></h3></td>
									</tr>

									<tr>
									<td>FECHA DE CONEXION:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaip" value="'.$registro['Fechaip'].'" /></td>
									</tr>


									<td bgcolor="#00FF00">Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicio  del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago1" value="'.$registro['Ulfepago1'].'" /></td>
									</tr>

									<tr>
									<td>Fecha final del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago2" value="'.$registro['Ulfepago2'].'" /></td>
									</tr>

									<tr>
									<td>Mes pagado:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulmespago" value="'.$registro['Ulmespago'].'" /></td>
									</tr>

									<tr>
									<td>Fecha del ultimo pago:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaul" value="'.$registro['Fechaul'].'" /></td>
									</tr>

									<tr>
									<td>Monto del ultimo pago:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulpago" value="'.$registro['Ulpago'].'" /></td>
									</tr>


									<td bgcolor="#FFFF00">Gestion de cobros</td>
									<tr>
									<td>Fecha de ultima llamada de cobro:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fechaulme" value="'.$registro['Fechaulme'].'" /></td>
									</tr>

									<td bgcolor="#FF0000">Datos de desconexion</td>
									<tr>
									<td>Saldo en mora al desconectar:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Morahoy" value="'.$registro['Morahoy'].'" /></td>
									</tr>

									<tr>
									<td>Fecha de ultima desconexion:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fedesco" value="'.$registro['Fedesco'].'" /></td>
									</tr>

									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mobservacion" value="'.$registro['Mobservacion'].'"/></td>
									<td>Fecha Registro:</td>
									<td><input type="text"  class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Mfechaentra'].'"/></td>
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
