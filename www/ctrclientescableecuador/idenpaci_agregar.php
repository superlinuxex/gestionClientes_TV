<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Clientes </title>
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
		$('#Ifecha').datepicker({
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
		$('#Mfechai').datepicker({
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
function nuevoAjax()
{ 
	//Crea el objeto AJAX
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}
</script>

<script type="text/javascript">
function CargarPartidas(cmbSeleccionado)
{
	if (cmbSeleccionado=='Partida')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Partida');
		var cmbSubPartida=document.getElementById('SubPartidas');
		var cmbSubPartida_a=document.getElementById('SubPartidas_a');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados (lista de cantones)
		cmbSubPartida_a.length=0;
		var nuevaOpcionCmbSubPartida_a=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_a.value=0; 
		nuevaOpcionCmbSubPartida_a.innerHTML="Seleccione una region...";
		cmbSubPartida_a.appendChild(nuevaOpcionCmbSubPartida_a);	
		cmbSubPartida_a.disabled=true;
		

		// Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=1&part="+codPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "seleccione un Canton..." y pongo una que dice "Cargando..."
				cmbSubPartida.length=0;
				var nuevaOpcion=document.createElement("option"); 
				nuevaOpcion.value=0; 
				nuevaOpcion.innerHTML="Cargando...";
				cmbSubPartida.appendChild(nuevaOpcion); 
				cmbSubPartida.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				cmbSubPartida.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	if (cmbSeleccionado=='SubPartidas')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Partida');
		var cmbSubPartida=document.getElementById('SubPartidas');
		var cmbSubPartida_a=document.getElementById('SubPartidas_a');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		
		
		//Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=2&part="+codPartida+"&spart="+codSubPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				//Mientras carga elimino la opcion "seleccione un Barrio..." y pongo una que dice "Cargando..."
				cmbSubPartida_a.length=0;
				var nuevaOpcion=document.createElement("option"); 
				nuevaOpcion.value=0; 
				nuevaOpcion.innerHTML="Cargando...";
				cmbSubPartida_a.appendChild(nuevaOpcion); 
				cmbSubPartida_a.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				cmbSubPartida_a.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	


}
</script>



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
							<h3 class="title">Adicion de Clientes</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
                                                                        $diapago=1;
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										//if (isset($_POST['Mcodigo'])==false or $_POST['Mcodigo']=="")
										//{
										//	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
										//	Debe ingresar el codigo para el cliente
										//	</div>';
										//	$insertar=false;
										//}



										if (isset($_POST['Mnombre'])==false or $_POST['Mnombre']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el Nombre para el cliente que desea ingresar
											</div>';
											$insertar=false;
										}


										if (isset($_POST['Mttplan'])==false or $_POST['Mttplan']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar el plan de pago que tendrá el cliente
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mcodperi'])==false or $_POST['Mcodperi']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar tiempo que durará en contrato
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Mttfactura'])==false or $_POST['Mttfactura']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar el tipo de factura que se dará al cliente
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mfechap'])==false or $_POST['Mfechap']=="" or $_POST['Mfechap']==0)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe indicar el dia del mes que paga el cliente
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mcontrato'])==false or $_POST['Mcontrato']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe digitar el numero de contrato
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Ifecha'])==false or $_POST['Ifecha']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Ingrese fecha de instalacion, el sistema registrara primer periodo de servicio a partir del mes siguiente a la fecha de instalacion
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mcod_vende'])==false or $_POST['Mcod_vende']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
											Debe ingresar el tecnico que realizo la instalacion del servicio
											</div>';
											$insertar=false;
										}





										//Validando vigencia de plan asignado
										//require_once("logica/log_idenpaci.php");
										//$resultado=log_veplanvige_idenpaci($_POST["Mttplan"]);
                 								//IF($resultado==0){
 										// echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										// No puede asignar ese plan de pago mensual, el plan indicado no está vigente.
										// </div>';
 										// $insertar=false;
										//}

										//Validando que el ciente no tenga direccion a menos que el que ya existe este desconectado
										//require_once("logica/log_idenpaci.php");
										//$resultado=log_direcciondupli_idenpaci($_POST["Partida"],$_POST["SubPartidas"],$_POST["SubPartidas_a"],$_POST["SubPartidas_b"],$_POST["SubPartidas_c"],$_POST["Mcalle"],$_POST["Mave"],$_POST["Mpasaje"],$_POST["Mpoligono"],$_POST["Mcasa"],$_POST["Mblocke"]);
                 								//IF($resultado!=0){
 										// echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
										// No puede ingresar este cliente, ya existe un registro con esa direccion del cliente: '.$resultado.'
										// </div>';
 										// $insertar=false;
										//}

										//Validando que el ciente no tenga el mismo dui
										require_once("logica/log_idenpaci.php");
										$resultado=log_vedui($_POST["Mdui"]);
                 								IF($resultado!=0){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
										 No puede ingresar este cliente, hay otra persona con ese RFC: '.$resultado.'
										 </div>';
 										 $insertar=false;
										}


										//Validando si el cliente ya existe
										require_once("logica/log_idenpaci.php");
										$resultado=log_obtener_idenpaci_nombre($_POST["Mnombre"],$_POST["Mapellido"],$bodx);
										$registro=mysql_fetch_array($resultado);
                 								IF($registro['Xcodigo']!=""){
 										 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
										 No puede ingresar este cliente, ya existe otro con ese nombre es, '.$registro['Xnombre'].' '.$registro['Xapellido'].'
										 </div>';
 										 $insertar=false;
										}



									        
										if ($insertar==true)
										{
											require_once("logica/log_idenpaci.php");
											$resultado=log_insertar_idenpaci($_POST,$bodx,$usux);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<td><input type="text" class="frm_txt" hidden="true" name="Mfechai" value="'.date('d/m/Y').'"/></td>

								
									<tr>
									<td><h3 class="title">IDENTIFICACION</a></h3></td>
									</tr>

									<td><input type="text" class="frm_txt" name="Mcodigo" hidden="hidden" value="'.(isset($_POST['Mcodigo'])?$_POST['Mcodigo']:'').'" /></td>

									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" name="Mnombre" value="'.(isset($_POST['Mnombre'])?$_POST['Mnombre']:'').'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" name="Mapellido" value="'.(isset($_POST['Mapellido'])?$_POST['Mapellido']:'').'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
									<td>
										<select name="Msexo" class="frm_cmb">
											<option value="1" '.(isset($_POST['Msexo'])?($_POST['Msexo']==1?' selected="selected" ':''):'').'>Masculino</option>
											<option value="2" '.(isset($_POST['Msexo'])?($_POST['Msexo']==2?' selected="selected" ':''):'').'>Femenino</option>
											<option value="3" '.(isset($_POST['Msexo'])?($_POST['Msexo']==3?' selected="selected" ':''):'').'>Persona Moral</option>
										</select>
									</td>
									<td>No.Identificacion RFC:</td>
									<td><input type="text" class="frm_txt" name="Mdui" value="'.(isset($_POST['Mdui'])?$_POST['Mdui']:'').'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt" name="Mnit" value="'.(isset($_POST['Mnit'])?$_POST['Mnit']:'').'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mregistro" value="'.(isset($_POST['Mregistro'])?$_POST['Mregistro']:'').'" /></td>

									<tr>
									<td>Telefono fijo:</td>
									<td><input type="text" class="frm_txt" name="Mtelefono" value="'.(isset($_POST['Mtelefono'])?$_POST['Mtelefono']:'').'" /></td>
									<td>Celular:</td>
									<td><input type="text" class="frm_txt" name="Mcelu" value="'.(isset($_POST['Mcelu'])?$_POST['Mcelu']:'').'" /></td>
									</tr>

									<td><input type="hidden" class="frm_txt_long" name="Mttpersona" value="'.(isset($_POST['Mttpersona'])?$_POST['Mttpersona']:'').'" /></td>


									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									<td>Tipo de Servicio:</td>
									<td><input type="text" class="frm_txt" name="Actividad" value="'.(isset($_POST['Actividad'])?$_POST['Actividad']:'').'" /></td>
									</tr>

									<tr>
									<td><h3 class="title">LOCALIZACION</a></h3></td>
									</tr>

										<tr>
										<td>Estado:</td>
										<td>
											<select name="Partida" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)" />
											<option value="">Seleccione un Estado...</option>';
											require_once("./logica/log_deptos.php");
											$resultado=log_obtener_deptos_cmb();
											while ( $fila1 = mysql_fetch_array($resultado))
											{
												if (isset($_POST["Partida"]))
												{

													if ($_POST["Partida"]==$fila1['Codigo'])
													{
													 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Codigo'].'- '.$fila1['Nombre'].'</option>';
													}
													else
													{
													 echo "<option value='".$fila1['Codigo']."'> ".$fila1['Codigo']."-".$fila1['Nombre']."</option>";
													}
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
											<select disabled="disabled" name="SubPartidas"  id="SubPartidas"  class="frm_cmb">
											<option value="0">Seleccione un Municipio.....</option>
											</select>
										</td>									
										</tr>

										
										<tr>
										<td>Poblacion:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_a"  id="SubPartidas_a"  class="frm_cmb">
											<option value="0">Seleccione una poblacion.....</option>
											</select>
										</td>									
										</tr>
										




									<td><input type="hidden" class="frm_txt" name="Mcalle" value="'.(isset($_POST['Mcalle'])?$_POST['Mcalle']:'').'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mave" value="'.(isset($_POST['Mave'])?$_POST['Mave']:'').'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mpasaje" value="'.(isset($_POST['Mpasaje'])?$_POST['Mpasaje']:'').'" /></td>
									<td><input type="hidden" class="frm_txt" name="Mcasa" value="'.(isset($_POST['Mcasa'])?$_POST['Mcasa']:'').'" /></td>

									



									<tr>
									<td>Direccion:</td>
									<td>
									<textarea name="Motraref" rows="5" cols="50"></textarea>
									</td>

									<td>Numero IP:</td>
									<td><input type="text" class="frm_txt" name="Mblocke" value="'.(isset($_POST['Mblocke'])?$_POST['Mblocke']:'').'" /></td>
									</tr>

									<tr>
									<td>Referencias:</td>
									<td>
									<textarea name="Mcalle" rows="5" cols="50"></textarea>
									</td>
									</tr>



									<tr>
									<td><h3 class="title">CONTRATACION</a></h3></td>
									</tr>
									<td><input type="hidden" class="frm_txt" name="Mvendedor" value="'.(isset($_POST['Mvendedor'])?$_POST['Mvendedor']:'').'" /></td>


									<tr>
									<td>No.de contrato:</td>
									<td><input type="text" class="frm_txt" name="Mcontrato" value="'.(isset($_POST['Mcontrato'])?$_POST['Mcontrato']:'').'" /></td>
									<td>Dia de pago:</td>
									<td><input type="text" class="frm_txt" name="Mfechap" value="'.$diapago.'" /></td>
									</tr>

									<tr>
									<td>Plan contratado:</td>
									<td>
									<select name="Mttplan" class="frm_cmb" />
									<option value="">Seleccione un plan...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_planes_cmb3($bodx);
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
									<td>Tipo factura:</td>
									<td>
										<select name="Mttfactura" class="frm_cmb">
											<option value="3" '.(isset($_POST['Mttfactura'])?($_POST['Mttfactura']==3?' selected="selected" ':''):'').'>Recibo</option>
										</select>
									</td>
								
									 </tr>


									<tr>
									<td>Fecha del contrato:</td>
									<td><input type="text" class="frm_txt" id="Mfechai" name="Mfechai" value="'.(isset($_POST['Mfechai'])?$_POST['Mfechai']:'').'"/></td>
									<td>Periodo contrato:</td>
									<td>
									<select name="Mcodperi" class="frm_cmb" />
									<option value="">Seleccione un periodo...</option>';
									require_once("./logica/log_pericon.php");
									$resultado=log_obtener_pericon_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Mcodperi"]))
									   {
									    if ($_POST["Mcodperi"]==$fila['Codigo'])
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
									<td>Cargo adicional en su recibo:</td>
									<td><input type="text" class="frm_txt" name="Mcadic" value="'.(isset($_POST['Mcadic'])?$_POST['Mcadic']:'').'" /></td>
									<td>Pidio Desconexion:</td>
									<td>
										<select name="Mpidiod" class="frm_cmb">
											<option value="1" '.(isset($_POST['Mpidiode'])?($_POST['Mpidiod']==1?' selected="selected" ':''):'').'>No</option>
											<option value="2" '.(isset($_POST['Mpidiode'])?($_POST['Mpidiod']==2?' selected="selected" ':''):'').'>Si</option>
										</select>
									</td>
									</tr>



									<tr>
									<td><h3 class="title">DATOS TOMADOS EN LA INSTALACION</a></h3></td>
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
									<td>Latitud/Longitud:</td>
									<td><input type="text"  class="frm_txt" name="Mlongilati" value="'.(isset($_POST['Mlongilati'])?$_POST['Mlongilati']:'').'" /></td>
									</tr>


									<tr>
									<td>Caja Distribucion:</td>
									<td><input type="text" class="frm_txt" name="Mpoligono" value="'.(isset($_POST['Mpoligono'])?$_POST['Mpoligono']:'').'" /></td>
									<td>Conexiones Extra:</td>
									<td><input type="text"  class="frm_txt" name="Mcone" value="'.(isset($_POST['Mcone'])?$_POST['Mcone']:'').'" /></td>
									</tr>



									<tr>
									<td>Fecha de instalacion:</td>
									<td><input type="text" class="frm_txt" id="Ifecha" name="Ifecha" value="'.(isset($_POST['Ifecha'])?$_POST['Ifecha']:'').'"/></td>

									<td>Tecnico Instalador:</td>
									<td>
									<select name="Mcod_vende" class="frm_cmb" />
									<option value="">Seleccione un tecnico...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb33();
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Mcod_vende"]))
									 {
									  if ($_POST["Mcod_vende"]==$fila['Codigo'])
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
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Mobservacion" value="'.(isset($_POST['Mobservacion'])?$_POST['Mobservacion']:'').'" /></td>
									<td>Fecha Registro:</td>
									<td><input type="text" class="frm_txt" name="Fecha" readonly="readonly" value="'.date('d/m/Y').'" /></td>
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
