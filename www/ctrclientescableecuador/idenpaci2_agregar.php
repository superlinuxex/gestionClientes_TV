<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - clientes </title>
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
		var cmbSubPartida_b=document.getElementById('SubPartidas_b');
		var cmbSubPartida_c=document.getElementById('SubPartidas_c');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados (lista de cantones)
		cmbSubPartida_a.length=0;
		var nuevaOpcionCmbSubPartida_a=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_a.value=0; 
		nuevaOpcionCmbSubPartida_a.innerHTML="Seleccione una region...";
		cmbSubPartida_a.appendChild(nuevaOpcionCmbSubPartida_a);	
		cmbSubPartida_a.disabled=true;
		
		//establecer los combobos dependiente como desabilitados (lista de barrios)
		cmbSubPartida_b.length=0;
		var nuevaOpcionCmbSubPartida_b=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_b.value=0; 
		nuevaOpcionCmbSubPartida_b.innerHTML="Seleccione una localidad...";
		cmbSubPartida_b.appendChild(nuevaOpcionCmbSubPartida_b);	
		cmbSubPartida_b.disabled=true;
		

		//establecer los combobos dependiente como desabilitados (lista de caserios)
		cmbSubPartida_c.length=0;
		var nuevaOpcionCmbSubPartida_c=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_c.value=0; 
		nuevaOpcionCmbSubPartida_c.innerHTML="Seleccione una urbanizacion...";
		cmbSubPartida_c.appendChild(nuevaOpcionCmbSubPartida_c);	
		cmbSubPartida_c.disabled=true;


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
		var cmbSubPartida_b=document.getElementById('SubPartidas_b');
		var cmbSubPartida_c=document.getElementById('SubPartidas_c');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados
		cmbSubPartida_b.length=0;
		var nuevaOpcionCmbSubPartida_b=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_b.value=0; 
		nuevaOpcionCmbSubPartida_b.innerHTML="Seleccione un Barrio...";
		cmbSubPartida_b.appendChild(nuevaOpcionCmbSubPartida_b);	
		cmbSubPartida_b.disabled=true;
		
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
	
	if (cmbSeleccionado=='SubPartidas_a')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Partida');
		var cmbSubPartida=document.getElementById('SubPartidas');
		var cmbSubPartida_a=document.getElementById('SubPartidas_a');
		var cmbSubPartida_b=document.getElementById('SubPartidas_b');
		var cmbSubPartida_c=document.getElementById('SubPartidas_c');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		var codSubPartida_a=cmbSubPartida_a.options[cmbSubPartida_a.selectedIndex].value;
		
		// Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=3&part="+codPartida+"&spart="+codSubPartida+"&spart_a="+codSubPartida_a, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "eleccione un Caserio..." y pongo una que dice "Cargando..."
				cmbSubPartida_b.length=0;
				var nuevaOpcion=document.createElement("option"); 
				nuevaOpcion.value=0; 
				nuevaOpcion.innerHTML="Cargando...";
				cmbSubPartida_b.appendChild(nuevaOpcion); 
				cmbSubPartida_b.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				cmbSubPartida_b.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}

	if (cmbSeleccionado=='SubPartidas_b')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Partida');
		var cmbSubPartida=document.getElementById('SubPartidas');
		var cmbSubPartida_a=document.getElementById('SubPartidas_a');
		var cmbSubPartida_b=document.getElementById('SubPartidas_b');
		var cmbSubPartida_c=document.getElementById('SubPartidas_c');
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		var codSubPartida_a=cmbSubPartida_a.options[cmbSubPartida_a.selectedIndex].value;
		var codSubPartida_b=cmbSubPartida_b.options[cmbSubPartida_b.selectedIndex].value;
		
		// Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=4&part="+codPartida+"&spart="+codSubPartida+"&spart_a="+codSubPartida_a+"&spart_b="+codSubPartida_b, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "eleccione un ..." y pongo una que dice "Cargando..."
				cmbSubPartida_c.length=0;
				var nuevaOpcion=document.createElement("option"); 
				nuevaOpcion.value=0; 
				nuevaOpcion.innerHTML="Cargando...";
				cmbSubPartida_c.appendChild(nuevaOpcion); 
				cmbSubPartida_c.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				cmbSubPartida_c.parentNode.innerHTML=ajax.responseText;
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
							<h3 class="title">Agregar Registro de Cliente</a></h3>
							<div class="entry">
								<?php
 							   if (isset ($_POST['id']))
							     {
							      $clie=$_POST['id'];
							     }
							     else
							     {
							      $clie=$_GET['id'];
							     }

				//Buscando el nombre del cliente
                                require_once("logica/log_idenpaci.php");
                                $resultado=log_obtener_idenpaci2($clie,$_SESSION["idBodega"]);
				$registro=mysql_fetch_array($resultado);
                                $nombreclie=$registro['Mnombre']." ".$registro['Mapellido'];	




									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci2.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Mcontrato'])==false or $_POST['Mcontrato']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe digitar el numero de contrato
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mfechai'])==false or $_POST['Mfechai']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe digitar la fecha de renovacion de contrato
											</div>';
											$insertar=false;
										}

									        
										if ($insertar==true)
										{
											require_once("logica/log_idenpaci.php");
											$resultado=log_insertar2_idenpaci2($_POST,$bodx,$usux);
                 									IF($resultado==1){
											 echo '<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											 Registro ingresado correctamente.
											 </div>';
											}
											else
											{
											 echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											 La fecha del contrato no ha sido indicada
											</div>';
											}
											unset($_POST);
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci2.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td><h3 class="title">APERTURA</a></h3></td>
									</tr>

									<td><input type="text" class="frm_txt"  hidden="true" name="Mabc" value="'.$clie.'"/></td>

									<tr>
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="id" value="'.$registro['Codigo'].'" /></td>
									<td bgcolor="#00FF00">ESTADO:</td>
									<td bgcolor="#00FF00"><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
									</tr>



									<tr>
									<td>Fecha renovación contrato:</td>
									<td><input type="text" class="frm_txt" id="Mfechai" name="Mfechai" value="'.$registro['Mfechai'].'"/></td>
									</tr>

									<tr>
									<td>No.de contrato:</td>
									<td><input type="text" class="frm_txt" name="Mcontrato" value="'.$registro['Mcontrato'].'"/></td>
									</tr>





									<tr>
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

									<tr>
									<td>Vendedor:</td>
										<td>
										 <select name="Mvendedor"  class="frm_cmb" />
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
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long"  name="Mobservacion" value="'.$registro['Mobservacion'].'" /></td>
									</tr>






								
									<tr>
									<td><h3 class="title">IDENTIFICACION</a></h3></td>
									</tr>


									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>

									
									<tr>
									<td>Genero:</td>
										<td>
										<select name="Msexo" disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Msexo']==1?' selected="selected" ':'').'>Masculino</option>											
										<option value="2" '.($registro['Msexo']==2?' selected="selected" ':'').'>Femenino</option>											
										</select>
										</td>

									<td>No.Identificacion personal:</td>
									<td><input type="text" class="frm_txt" name="Mdui" value="'.$registro['Mdui'].'" /></td>
									</tr>

									<tr>
									<td>No.Identificacion tributaria:</td>
									<td><input type="text" class="frm_txt"  name="Mnit" value="'.$registro['Mnit'].'" /></td>
									<td>No.Registro fiscal:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mregistro" value="'.$registro['Mregistro'].'" /></td>
									</tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt_long"  name="Mtelefono" value="'.$registro['Mtelefono'].'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" class="frm_txt_long"  name="Mcelu" value="'.$registro['Mcelu'].'" /></td>
									</tr>


									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" readonly="readonly" value="'.$registro['Email'].'" /></td>
									<td>Tipo de persona:</td>
										<td>
										<select name="Mttpersona" disabled="true" class="frm_cmb">
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
									 <select name="Partida" disabled="true" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
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
									 <select name="SubPartidas" disabled="true" id="SubPartidas" class="frm_cmb_long" />
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
									<td>Zona:</td>
									<td>
									 <select name="SubPartidas_a"  disabled="true" id="SubPartidas_a" class="frm_cmb_long" />
									 <option value="">Seleccione una zona...</option>';
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
									 <select name="SubPartidas_b"  disabled="true" id="SubPartidas_b" class="frm_cmb_long" />
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
									 <select name="SubPartidas_c" disabled="true" id="SubPartidas_c" class="frm_cmb_long" />
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
									<td>Plan contratado:</td>
										<td>
										 <select name="Mttplan"  disabled="true" class="frm_cmb" />
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
											echo "<option value='".$fila2['Codigo']."'> ".$fila2['Nombre']."- Costo $".$fila2['Costo']." </option>";
										      }
  										   }
										   echo'
										  </td>									
										<td>Tipo de factura:</td>
										<td>
										<select name="Mttfactura" disabled="true"  class="frm_cmb">
										<option value="1" '.($registro['Mttfactura']==1?' selected="selected" ':'').'>Consumidor final</option>											
										<option value="2" '.($registro['Mttfactura']==2?' selected="selected" ':'').'>Credito fiscal</option>											
										</select>
										</td>
	    							        </tr>






									<tr>
									<td>Cobrador:</td>
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
