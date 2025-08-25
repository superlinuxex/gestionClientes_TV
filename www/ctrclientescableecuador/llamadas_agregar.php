<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de llamadas a clientes </title>
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
<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fecha2').datepicker({
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
							<h3 class="title">Ingresar registro de llamadas a clientes</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=llamadas.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
								
										if (isset($_POST['Cliente'])==false or $_POST['Cliente']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el cliente al que atender
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Hora'])==false or $_POST['Hora']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la hora del evento
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar la fecha del evento
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Empleado'])==false or $_POST['Empleado']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el empleado responsable
											</div>';
											$insertar=false;
										}
									        
										if ($insertar==true)
										{
											require_once("logica/log_llamadas.php");
											$resultado=log_insertar_llamadas($_POST,$bodx,$usux);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=llamadas.php">';    
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
 									<td colspan="2" align="left">
									<input  type="submit" value="Localizar" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';


									if (isset ($_POST['confirmar2']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];
									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
 									<td colspan="2" align="right">
									<input  type="submit" value="Llenar lista con clientes que tienen cuota vencida" class="frm_btn_long" name="confirmar2"/>
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
									  echo "<option value='".$fila['Codigo']."'>Codigo:".$fila['Codigo']."&nbsp".'Nombre:'.$fila['Nombre']."&nbsp".$fila['Apellido']."&nbsp".'Telefono:'.$fila['Telefono']."&nbsp".'Celular:'.$fila['Celular']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	


									<tr>
									<td>Fecha de llamada:</td>
									<td><input type="text" class="frm_txt" id="Fecha" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'"/></td>
									</tr>

									<tr>
									<td>Hora de llamada:</td>
									<td>
										<select name="Hora" class="frm_cmb">
											<option value="1" '.(isset($_POST['Hora'])?($_POST['Hora']==1?' selected="selected" ':''):'').'>1 am</option>
											<option value="2" '.(isset($_POST['Hora'])?($_POST['Hora']==2?' selected="selected" ':''):'').'>2 am</option>
											<option value="3" '.(isset($_POST['Hora'])?($_POST['Hora']==3?' selected="selected" ':''):'').'>3 am</option>
											<option value="4" '.(isset($_POST['Hora'])?($_POST['Hora']==4?' selected="selected" ':''):'').'>4 am</option>
											<option value="5" '.(isset($_POST['Hora'])?($_POST['Hora']==5?' selected="selected" ':''):'').'>5 am</option>
											<option value="6" '.(isset($_POST['Hora'])?($_POST['Hora']==6?' selected="selected" ':''):'').'>6 am</option>
											<option value="7" '.(isset($_POST['Hora'])?($_POST['Hora']==7?' selected="selected" ':''):'').'>7 am</option>
											<option value="8" '.(isset($_POST['Hora'])?($_POST['Hora']==8?' selected="selected" ':''):'').'>8 am</option>
											<option value="9" '.(isset($_POST['Hora'])?($_POST['Hora']==9?' selected="selected" ':''):'').'>9 am</option>
											<option value="10" '.(isset($_POST['Hora'])?($_POST['Hora']==10?' selected="selected" ':''):'').'>10 am</option>
											<option value="11" '.(isset($_POST['Hora'])?($_POST['Hora']==11?' selected="selected" ':''):'').'>11 am</option>
											<option value="12" '.(isset($_POST['Hora'])?($_POST['Hora']==12?' selected="selected" ':''):'').'>12 am</option>
											<option value="13" '.(isset($_POST['Hora'])?($_POST['Hora']==13?' selected="selected" ':''):'').'>1 pm</option>
											<option value="14" '.(isset($_POST['Hora'])?($_POST['Hora']==14?' selected="selected" ':''):'').'>2 pm</option>
											<option value="15" '.(isset($_POST['Hora'])?($_POST['Hora']==15?' selected="selected" ':''):'').'>3 pm</option>
											<option value="16" '.(isset($_POST['Hora'])?($_POST['Hora']==16?' selected="selected" ':''):'').'>4 pm</option>
											<option value="17" '.(isset($_POST['Hora'])?($_POST['Hora']==17?' selected="selected" ':''):'').'>5 pm</option>
											<option value="18" '.(isset($_POST['Hora'])?($_POST['Hora']==18?' selected="selected" ':''):'').'>6 pm</option>
											<option value="19" '.(isset($_POST['Hora'])?($_POST['Hora']==19?' selected="selected" ':''):'').'>7 pm</option>
											<option value="20" '.(isset($_POST['Hora'])?($_POST['Hora']==20?' selected="selected" ':''):'').'>8 pm</option>
											<option value="21" '.(isset($_POST['Hora'])?($_POST['Hora']==21?' selected="selected" ':''):'').'>9 pm</option>
											<option value="22" '.(isset($_POST['Hora'])?($_POST['Hora']==22?' selected="selected" ':''):'').'>10 pm</option>
											<option value="23" '.(isset($_POST['Hora'])?($_POST['Hora']==23?' selected="selected" ':''):'').'>11 pm</option>
											<option value="24" '.(isset($_POST['Hora'])?($_POST['Hora']==24?' selected="selected" ':''):'').'>12 pm</option>
										</select>
									</td>
									</tr>

									<tr>
									<td>Minutos:</td>
									<td>
										<select name="Hora2" class="frm_cmb">
											<option value="1" '.(isset($_POST['Hora2'])?($_POST['Hora2']==1?' selected="selected" ':''):'').'>1</option>
											<option value="2" '.(isset($_POST['Hora2'])?($_POST['Hora2']==2?' selected="selected" ':''):'').'>2</option>
											<option value="3" '.(isset($_POST['Hora2'])?($_POST['Hora2']==3?' selected="selected" ':''):'').'>3</option>
											<option value="4" '.(isset($_POST['Hora2'])?($_POST['Hora2']==4?' selected="selected" ':''):'').'>4</option>
											<option value="5" '.(isset($_POST['Hora2'])?($_POST['Hora2']==5?' selected="selected" ':''):'').'>5</option>
											<option value="6" '.(isset($_POST['Hora2'])?($_POST['Hora2']==6?' selected="selected" ':''):'').'>6</option>
											<option value="7" '.(isset($_POST['Hora2'])?($_POST['Hora2']==7?' selected="selected" ':''):'').'>7</option>
											<option value="8" '.(isset($_POST['Hora2'])?($_POST['Hora2']==8?' selected="selected" ':''):'').'>8</option>
											<option value="9" '.(isset($_POST['Hora2'])?($_POST['Hora2']==9?' selected="selected" ':''):'').'>9</option>
											<option value="10" '.(isset($_POST['Hora2'])?($_POST['Hora2']==10?' selected="selected" ':''):'').'>10</option>
											<option value="11" '.(isset($_POST['Hora2'])?($_POST['Hora2']==11?' selected="selected" ':''):'').'>11</option>
											<option value="12" '.(isset($_POST['Hora2'])?($_POST['Hora2']==12?' selected="selected" ':''):'').'>12</option>
											<option value="13" '.(isset($_POST['Hora2'])?($_POST['Hora2']==13?' selected="selected" ':''):'').'>13</option>
											<option value="14" '.(isset($_POST['Hora2'])?($_POST['Hora2']==14?' selected="selected" ':''):'').'>14</option>
											<option value="15" '.(isset($_POST['Hora2'])?($_POST['Hora2']==15?' selected="selected" ':''):'').'>15</option>
											<option value="16" '.(isset($_POST['Hora2'])?($_POST['Hora2']==16?' selected="selected" ':''):'').'>16</option>
											<option value="17" '.(isset($_POST['Hora2'])?($_POST['Hora2']==17?' selected="selected" ':''):'').'>17</option>
											<option value="18" '.(isset($_POST['Hora2'])?($_POST['Hora2']==18?' selected="selected" ':''):'').'>18</option>
											<option value="19" '.(isset($_POST['Hora2'])?($_POST['Hora2']==19?' selected="selected" ':''):'').'>19</option>
											<option value="20" '.(isset($_POST['Hora2'])?($_POST['Hora2']==20?' selected="selected" ':''):'').'>20</option>
											<option value="21" '.(isset($_POST['Hora2'])?($_POST['Hora2']==21?' selected="selected" ':''):'').'>21</option>
											<option value="22" '.(isset($_POST['Hora2'])?($_POST['Hora2']==22?' selected="selected" ':''):'').'>22</option>
											<option value="23" '.(isset($_POST['Hora2'])?($_POST['Hora2']==23?' selected="selected" ':''):'').'>23</option>
											<option value="24" '.(isset($_POST['Hora2'])?($_POST['Hora2']==24?' selected="selected" ':''):'').'>24</option>
											<option value="25" '.(isset($_POST['Hora2'])?($_POST['Hora2']==25?' selected="selected" ':''):'').'>25</option>
											<option value="26" '.(isset($_POST['Hora2'])?($_POST['Hora2']==26?' selected="selected" ':''):'').'>26</option>
											<option value="27" '.(isset($_POST['Hora2'])?($_POST['Hora2']==27?' selected="selected" ':''):'').'>27</option>
											<option value="28" '.(isset($_POST['Hora2'])?($_POST['Hora2']==28?' selected="selected" ':''):'').'>28</option>
											<option value="29" '.(isset($_POST['Hora2'])?($_POST['Hora2']==29?' selected="selected" ':''):'').'>29</option>
											<option value="30" '.(isset($_POST['Hora2'])?($_POST['Hora2']==30?' selected="selected" ':''):'').'>30</option>
											<option value="31" '.(isset($_POST['Hora2'])?($_POST['Hora2']==31?' selected="selected" ':''):'').'>31</option>
											<option value="32" '.(isset($_POST['Hora2'])?($_POST['Hora2']==32?' selected="selected" ':''):'').'>32</option>
											<option value="33" '.(isset($_POST['Hora2'])?($_POST['Hora2']==33?' selected="selected" ':''):'').'>33</option>
											<option value="34" '.(isset($_POST['Hora2'])?($_POST['Hora2']==34?' selected="selected" ':''):'').'>34</option>
											<option value="35" '.(isset($_POST['Hora2'])?($_POST['Hora2']==35?' selected="selected" ':''):'').'>35</option>
											<option value="36" '.(isset($_POST['Hora2'])?($_POST['Hora2']==36?' selected="selected" ':''):'').'>36</option>
											<option value="37" '.(isset($_POST['Hora2'])?($_POST['Hora2']==37?' selected="selected" ':''):'').'>37</option>
											<option value="38" '.(isset($_POST['Hora2'])?($_POST['Hora2']==38?' selected="selected" ':''):'').'>38</option>
											<option value="39" '.(isset($_POST['Hora2'])?($_POST['Hora2']==39?' selected="selected" ':''):'').'>39</option>
											<option value="40" '.(isset($_POST['Hora2'])?($_POST['Hora2']==40?' selected="selected" ':''):'').'>40</option>
											<option value="41" '.(isset($_POST['Hora2'])?($_POST['Hora2']==41?' selected="selected" ':''):'').'>41</option>
											<option value="42" '.(isset($_POST['Hora2'])?($_POST['Hora2']==42?' selected="selected" ':''):'').'>42</option>
											<option value="43" '.(isset($_POST['Hora2'])?($_POST['Hora2']==43?' selected="selected" ':''):'').'>43</option>
											<option value="44" '.(isset($_POST['Hora2'])?($_POST['Hora2']==44?' selected="selected" ':''):'').'>44</option>
											<option value="45" '.(isset($_POST['Hora2'])?($_POST['Hora2']==45?' selected="selected" ':''):'').'>45</option>
											<option value="46" '.(isset($_POST['Hora2'])?($_POST['Hora2']==46?' selected="selected" ':''):'').'>46</option>
											<option value="47" '.(isset($_POST['Hora2'])?($_POST['Hora2']==47?' selected="selected" ':''):'').'>47</option>
											<option value="48" '.(isset($_POST['Hora2'])?($_POST['Hora2']==48?' selected="selected" ':''):'').'>48</option>
											<option value="49" '.(isset($_POST['Hora2'])?($_POST['Hora2']==49?' selected="selected" ':''):'').'>49</option>
											<option value="50" '.(isset($_POST['Hora2'])?($_POST['Hora2']==50?' selected="selected" ':''):'').'>50</option>
											<option value="51" '.(isset($_POST['Hora2'])?($_POST['Hora2']==51?' selected="selected" ':''):'').'>51</option>
											<option value="52" '.(isset($_POST['Hora2'])?($_POST['Hora2']==52?' selected="selected" ':''):'').'>52</option>
											<option value="53" '.(isset($_POST['Hora2'])?($_POST['Hora2']==53?' selected="selected" ':''):'').'>53</option>
											<option value="54" '.(isset($_POST['Hora2'])?($_POST['Hora2']==54?' selected="selected" ':''):'').'>54</option>
											<option value="55" '.(isset($_POST['Hora2'])?($_POST['Hora2']==55?' selected="selected" ':''):'').'>55</option>
											<option value="56" '.(isset($_POST['Hora2'])?($_POST['Hora2']==56?' selected="selected" ':''):'').'>56</option>
											<option value="57" '.(isset($_POST['Hora2'])?($_POST['Hora2']==57?' selected="selected" ':''):'').'>57</option>
											<option value="58" '.(isset($_POST['Hora2'])?($_POST['Hora2']==58?' selected="selected" ':''):'').'>58</option>
											<option value="59" '.(isset($_POST['Hora2'])?($_POST['Hora2']==59?' selected="selected" ':''):'').'>59</option>
										</select>
									</td>
									</tr>

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Motivo de la llamada:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Motivo" cols="85"></textarea></td>
                </tr>

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Respuesta del cliente:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Respuesta" cols="85"></textarea></td>
                </tr>

                <tr>
                <td width="50%">
                <p style="line-height: 150%">Comentarios adicionales:</td>
                <td width="50%">
                <p style="line-height: 150%">
                <textarea rows="3" name="Comentario" cols="85"></textarea></td>
                </tr>




									<tr>
									<td>Empleado que atendio la llamada:</td>
									<td>
									<select name="Empleado" class="frm_cmb" />
									<option value="">Seleccione un empleado...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb($bodx);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Empleado"]))
									 {
									  if ($_POST["Empleado"]==$fila['Codigo'])
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
									<td>Volver a llamar en fecha:</td>
									<td><input type="text" class="frm_txt" id="Fecha2" name="Fecha2" value="'.(isset($_POST['Fecha2'])?$_POST['Fecha2']:'').'"/></td>
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
