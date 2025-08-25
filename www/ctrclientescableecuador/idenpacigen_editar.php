$registro['Numeperi']-$meseshastahoy<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customercabletv - Editar registro de clientes </title>
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
		nuevaOpcionCmbSubPartida_a.innerHTML="Seleccione un Canton...";
		cmbSubPartida_a.appendChild(nuevaOpcionCmbSubPartida_a);	
		cmbSubPartida_a.disabled=true;
		
		//establecer los combobos dependiente como desabilitados (lista de barrios)
		cmbSubPartida_b.length=0;
		var nuevaOpcionCmbSubPartida_b=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_b.value=0; 
		nuevaOpcionCmbSubPartida_b.innerHTML="Seleccione una Barrio...";
		cmbSubPartida_b.appendChild(nuevaOpcionCmbSubPartida_b);	
		cmbSubPartida_b.disabled=true;
		

		//establecer los combobos dependiente como desabilitados (lista de caserios)
		cmbSubPartida_c.length=0;
		var nuevaOpcionCmbSubPartida_c=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_c.value=0; 
		nuevaOpcionCmbSubPartida_c.innerHTML="Seleccione un Caserio...";
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
							<h3 class="title">Editar Registro del Cliente</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_idenpaci.php");
									$tabla=log_obtener_idenpacigen2($_GET["id"],$_GET["id2"]);
									$registro=mysql_fetch_array($tabla);
									$anio1=intval(substr($registro['Fechaip'],0,4));
                                                                        $anio2=intval(substr(date('d/m/Y'),6,4));
                                                                        $meseshastahoy=(intval(substr(date('d/m/Y'),3,2)))-intval(substr($registro['Fechaip'],5,2));
                                                                        $diferencia=$registro['Numeperi']-$meseshastahoy;
                                                                        if($diferencia<=0)
									{
										$diferencia="Vencido";
									}
									$insertar=true;
									if(isset($_POST['aceptar']))
									{
										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpacigen.php">';    
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
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Codigo" value="'.$registro['Codigo'].'" /></td>
									<td bgcolor="#00FF00">ESTADO:</td>
									<td bgcolor="#00FF00"><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
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
										</select>
										</td>

									<td>DUI:</td>
									<td><input type="text" class="frm_txt" name="Mdui" value="'.$registro['Mdui'].'" /></td>
									</tr>

									<tr>
									<td>NIT:</td>
									<td><input type="text" class="frm_txt" name="Mnit" value="'.$registro['Mnit'].'" /></td>
									<td>NRC:</td>
									<td><input type="text" class="frm_txt" name="Mregistro" value="'.$registro['Mregistro'].'" /></td>
									</tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt_long" name="Mtelefono" value="'.$registro['Mtelefono'].'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" class="frm_txt_long" name="Mcelu" value="'.$registro['Mcelu'].'" /></td>
									</tr>


									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" value="'.$registro['Email'].'" /></td>
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
									<td><input type="text" class="frm_txt_long" name="Actividad" value="'.$registro['Actividad'].'" /></td>
									</tr>


									<tr>
									<td><h3 class="title">LOCALIZACION</a></h3></td>
									</tr>

									<tr>
									<td>Departamento:</td>
									<td>
									 <select name="Partida" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
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
									<td>Cuidad:</td>
									<td>
									 <select name="SubPartidas" id="SubPartidas" class="frm_cmb_long" />
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
									 <select name="SubPartidas_a"  id="SubPartidas_a" class="frm_cmb_long" />
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
									 <select name="SubPartidas_b"  id="SubPartidas_b" class="frm_cmb_long" />
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
									 <select name="SubPartidas_c"  id="SubPartidas_c" class="frm_cmb_long" />
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
									<td><input type="text" class="frm_txt" name="Mcalle" value="'.$registro['Mcalle'].'" /></td>
									</tr>


									<tr>
									<td>Avenida:</td>
									<td><input type="text" class="frm_txt" name="Mave" value="'.$registro['Mave'].'" /></td>
									<td>Pasaje:</td>
									<td><input type="text" class="frm_txt" name="Mpasaje" value="'.$registro['Mpasaje'].'" /></td>
									</tr>
									

									<tr>
									<td>Poligono:</td>
									<td><input type="text" class="frm_txt" name="Mpoligono" value="'.$registro['Mpoligono'].'" /></td>
									<td>Block:</td>
									<td><input type="text" class="frm_txt" name="Mblocke" value="'.$registro['Mblocke'].'"/></td>
									</tr>

									<tr>
									<td>No.de casa:</td>
									<td><input type="text" class="frm_txt" name="Mcasa" value="'.$registro['Mcasa'].'"/></td>
									<td>No.Contador Eléctrico:</td>
									<td><input type="text" class="frm_txt" name="Mcontaelec" value="'.$registro['Mcontaelec'].'"/></td>
									</tr>

									<tr>
									<td>Otra referencia sobre la dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Motraref" value="'.$registro['Motraref'].'"/></td>
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
										 <select name="Mvendedor" class="frm_cmb" />
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
										<option value="1" '.($registro['Mttfactura']==1?' selected="selected" ':'').'>Consumidor final</option>											
										<option value="2" '.($registro['Mttfactura']==2?' selected="selected" ':'').'>Credito fiscal</option>											
										</select>
										</td>
	    							        </tr>


									<tr>
									<td>Renovación o apertura de contrato:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mfechai" value="'.$registro['Mfechai'].'"/></td>
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
									<td>Gestor de cobros:</td>
										<td>
										 <select name="Mcod_vende" class="frm_cmb" />
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
									<td><input type="text" class="frm_txt" name="Mfechap" value="'.$registro['Mfechap'].'"/></td>
									</tr>

									<tr>
									<td>Monto del pago mensual:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mmonto" value="'.$registro['Mmonto'].'"/></td>
									<td>Meses para caducar:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Caduca" value="'.$diferencia.'"/></td>
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
									<td>Abonos a la mora:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Abonosmora" value="'.$registro['Abonosmora'].'" /></td>
									</tr>

									<tr>
									<td>Fecha de ultima desconexion:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fedesco" value="'.$registro['Fedesco'].'" /></td>
									</tr>

									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Mobservacion" value="'.$registro['Mobservacion'].'"/></td>
									<td>Fecha Registro:</td>
									<td><input type="text"  class="frm_txt" name="Fecha" readonly="readonly" value="'.$registro['Mfechaentra'].'"/></td>
									</tr>





											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Volver" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
							case 'post':
											if (isset($_POST['Mnombre'])==false or $_POST['Mnombre']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar el nombre del cliente que desea ingresar
												</div>';
												$insertar=false;
											}

										if (isset($_POST['Mcodperi'])==false or $_POST['Mcodperi']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar tiempo que durará en contrato
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Mttfactura'])==false or $_POST['Mttfactura']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar el tipo de factura que se dará al cliente
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mfechap'])==false or $_POST['Mfechap']=="" or $_POST['Mfechap']==0)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar el dia del mes que paga el cliente
											</div>';
											$insertar=false;
										}

										if (isset($_POST['Mcod_vende'])==false or $_POST['Mcod_vende']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe indicar quien es el cobrador que vistara a este cliente
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Mcontrato'])==false or $_POST['Mcontrato']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe digitar el numero de contrato
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Partida'])==false or $_POST['Partida']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe de ingresar el Departamento 
											</div>';
											$insertar=false;
										}

										if (isset($_POST['SubPartidas'])==false or $_POST['SubPartidas']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe de ingresar el municipio
											</div>';
											$insertar=false;
										}
										if (isset($_POST['SubPartidas_a'])==false or $_POST['SubPartidas_a']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe de ingresar el canton
											</div>';
											$insertar=false;
										}
										if (isset($_POST['SubPartidas_b'])==false or $_POST['SubPartidas_b']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe de ingresar el barrio 
											</div>';
											$insertar=false;
										}
										if (isset($_POST['SubPartidas_c'])==false or $_POST['SubPartidas_c']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
											Debe de ingresar la colonia
											</div>';
											$insertar=false;
										}





											if ($insertar==true)
											{
												$resultado=log_actualizar_idenpaci($_POST,$_GET['id'],$bodx);
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Registro actualizado correctamente.
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
										</select>
									</td>
									<td>DUI:</td>
									<td><input type="text" class="frm_txt" name="Mdui" value="'.(isset($_POST['Mdui'])?$_POST['Mdui']:'').'" /></td>
									</tr>

									<tr>
									<td>NIT:</td>
									<td><input type="text" class="frm_txt" name="Mnit" value="'.(isset($_POST['Mnit'])?$_POST['Mnit']:'').'" /></td>
									<td>NRC:</td>
									<td><input type="text" class="frm_txt" name="Mregistro" value="'.(isset($_POST['Mregistro'])?$_POST['Mregistro']:'').'" /></td>
									</tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt_long" name="Mtelefono" value="'.(isset($_POST['Mtelefono'])?$_POST['Mtelefono']:'').'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" class="frm_txt_long" name="Mcelu" value="'.(isset($_POST['Mcelu'])?$_POST['Mcelu']:'').'" /></td>
									</tr>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									<td>Tipo de persona:</td>
									<td>
										<select name="Mttpersona" class="frm_cmb">
											<option value="1" '.(isset($_POST['Mttpersona'])?($_POST['Mttpersona']==1?' selected="selected" ':''):'').'>Natural</option>
											<option value="2" '.(isset($_POST['Mttpersona'])?($_POST['Mttpersona']==2?' selected="selected" ':''):'').'>Juridica</option>
										</select>
									</td>
									</tr>



									<tr>
									<td>Actividad Económica:</td>
									<td><input type="text" class="frm_txt_long" name="Actividad" value="'.(isset($_POST['Actividad'])?$_POST['Actividad']:'').'" /></td>
									</tr>

									<tr>
									<td><h3 class="title">LOCALIZACION</a></h3></td>
									</tr>

										<tr>
										<td>Departamento:</td>
										<td>
											<select name="Partida" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)" />
											<option value="">Seleccione un Departamento...</option>';
											require_once("./logica/log_deptos.php");
											$resultado=log_obtener_deptos_cmb();
											while ( $fila1 = mysql_fetch_array($resultado))
											{
												if (isset($_POST["Partida"]))
												{

													if ($_POST["Partida"]==$fila1['Codigo'])
													{
													 echo '<option value="'.$fila1['Codigo'].'" selected="selected">'.$fila1['Codigo'].' </option>';
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
										<td>Ciudad:</td>
										<td>
											<select disabled="disabled" name="SubPartidas"  id="SubPartidas"  class="frm_cmb">
											<option value="0">Seleccione una ciudad...</option>
											</select>
										</td>									
										</tr>

										
										<tr>
										<td>Zona:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_a"  id="SubPartidas_a"  class="frm_cmb">
											<option value="0">Seleccione una zona...</option>
											</select>
										</td>									
										</tr>
										
										<tr>
										<td>Localidad:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_b"  id="SubPartidas_b"  class="frm_cmb">
											<option value="0">Seleccione una localidad...</option>
											</select>
										</td>									
										</tr>


										<tr>
									        <td>Urbanizacion:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_c"  id="SubPartidas_c"  class="frm_cmb">
											<option value="0">Seleccione una urbanizacion...</option>
											</select>
										</td>									
										</tr>



									<tr>
									<td>Calle:</td>
									<td><input type="text" class="frm_txt" name="Mcalle" value="'.(isset($_POST['Mcalle'])?$_POST['Mcalle']:'').'" /></td>
									</tr>


									<tr>
									<td>Avenida:</td>
									<td><input type="text" class="frm_txt" name="Mave" value="'.(isset($_POST['Mave'])?$_POST['Mave']:'').'" /></td>
									<td>Pasaje:</td>
									<td><input type="text" class="frm_txt" name="Mpasaje" value="'.(isset($_POST['Mpasaje'])?$_POST['Mpasaje']:'').'" /></td>
									</tr>
									

									<tr>
									<td>Poligono:</td>
									<td><input type="text" class="frm_txt" name="Mpoligono" value="'.(isset($_POST['Mpoligono'])?$_POST['Mpoligono']:'').'" /></td>
									<td>Block:</td>
									<td><input type="text" class="frm_txt" name="Mblocke" value="'.(isset($_POST['Mblocke'])?$_POST['Mblocke']:'').'" /></td>
									</tr>

									<tr>
									<td>No.de casa:</td>
									<td><input type="text" class="frm_txt" name="Mcasa" value="'.(isset($_POST['Mcasa'])?$_POST['Mcasa']:'').'" /></td>
									<td>No.Contador Eléctrico:</td>
									<td><input type="text" class="frm_txt" name="Mcontaelec" value="'.(isset($_POST['Mcontaelec'])?$_POST['Mcontaelec']:'').'" /></td>
									</tr>

									<tr>
									<td>Otra referencia sobre la dirección:</td>
									<td><input type="text" class="frm_txt_long" name="Motraref" value="'.(isset($_POST['Motraref'])?$_POST['Motraref']:'').'" /></td>
									</tr>


									<tr>
									<td>Ubicación georeferencial:</td>
									<td><input type="text" readonly="readonly" class="frm_txt_long" name="Mgeo" value="'.(isset($_POST['Mgeo'])?$_POST['Mgeo']:'').'" /></td>
									</tr>

									<tr>
									<td><h3 class="title">CONTRATACION</a></h3></td>
									</tr>

									<tr>
									<td>No.de contrato:</td>
									<td><input type="text" class="frm_txt" name="Mcontrato" value="'.(isset($_POST['Mcontrato'])?$_POST['Mcontrato']:'').'" /></td>
									<td>Vendedor contrato:</td>
									<td>
									<select name="Mvendedor" class="frm_cmb" />
									<option value="">Seleccione un vendedor...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Mvendedor"]))
									 {
									  if ($_POST["Mvendedor"]==$fila['Codigo'])
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
									<td>Plan contratado:</td>
									<td>
									<select name="Mttplan" disabled="true" class="frm_cmb" />
									<option value="">Seleccione un plan...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_planes_cmb();
									while ( $fila2 = mysql_fetch_array($resultado))
									 {
									  if (isset($_POST["Mttplan"]))
									   {
									    if ($_POST["Mttplan"]==$registro['Mttplan'])
									     {
									      echo '<option value="'.$fila2['Codigo'].'" selected="selected">'.$fila2['Nombre'].'</option>';
									     }
									     else
									     {
									      echo "<option value='".$fila2['Codigo']."'> ".$fila2['Nombre']."</option>";
									     }
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
										<select name="Mttfactura" class="frm_cmb">
											<option value="1" '.(isset($_POST['Mttfactura'])?($_POST['Mttfactura']==1?' selected="selected" ':''):'').'>Consumidor final</option>
											<option value="2" '.(isset($_POST['Mttfactura'])?($_POST['Mttfactura']==2?' selected="selected" ':''):'').'>Credito fiscal</option>
										</select>
									</td>
								
									 </tr>


									<tr>
									<td>Renovación o apertura de contrato:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mfechai" value="'.(isset($_POST['Mfechai'])?$_POST['Mfechai']:'').'"/></td>
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
									<td>Gestor de cobros:</td>
									<td>
									<select name="Mcod_vende" class="frm_cmb" />
									<option value="">Seleccione un cobrador...</option>';
									require_once("./logica/log_vendedores.php");
									$resultado=log_obtener_vendedores_cmb($_SESSION["idBodega"]);
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

									<td>Dia de pago:</td>
									<td><input type="text" class="frm_txt" name="Mfechap" value="'.(isset($_POST['Mfechap'])?$_POST['Mfechap']:'').'" /></td>
									</tr>

									<tr>
									<td>Monto del pago mensual:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mmonto" value="'.(isset($_POST['Mmonto'])?$_POST['Mmonto']:'').'" /></td>
									<td>Meses para caducar:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Caduca" value="'.$diferencia.'" /></td>
									</tr>



									<tr>
									<td><h3 class="title">DATOS TECNICOS</a></h3></td>
									</tr>

									<tr>
									<td>Latitud/Longitud:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mlongilati" value="'.(isset($_POST['Mlongilati'])?$_POST['Mlongilati']:'').'" /></td>
									<td>Conexiones Extra:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mcone" value="'.(isset($_POST['Mcone'])?$_POST['Mcone']:'').'" /></td>
									</tr>


									<tr>
									<td>No.Marchamos:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mmarcha" value="'.(isset($_POST['Mmarcha'])?$_POST['Mmarcha']:'').'" /></td>
									<td>No.TAP:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mposte" value="'.(isset($_POST['Mposte'])?$_POST['Mposte']:'').'" /></td>
									</tr>
									

									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Mobservacion" value="'.(isset($_POST['Mobservacion'])?$_POST['Mobservacion']:'').'" /></td>
									</tr>




											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Volver" class="frm_btn" name="cancelar"/>
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
											<input  type="submit" value="Volver" class="frm_btn" name="cancelar"/>
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
