$registro['Numeperi']-$meseshastahoy<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Editar registro de clientes </title>
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
							<h3 class="title">Cambio de cobrador al cliente seleccionado</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_idenpaci.php");
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cartera.php">';    
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
									<td>ESTADO:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Estadocli" value="'.$registro['Estadocli'].'" /></td>
									</tr>


									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
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
									<td>Canton:</td>
									<td>
									 <select name="SubPartidas_a"  id="SubPartidas_a" class="frm_cmb_long" />
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
									<td>Barrio o finca:</td>
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
									<td>Colonia o Urb.:</td>
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
									<td>Otra referencia:</td>
									<td><input type="text" class="frm_txt_long" name="Motraref" value="'.$registro['Motraref'].'"/></td>
									</tr>


									<tr>
									<td  bgcolor="#00FF00">Gestor de cobros:</td>
										<td bgcolor="#00FF00">
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
									</tr>






											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
											<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
											</td>
											</tr>
											</table>
											</form>';
										break;
							case 'post':

											if ($insertar==true)
											{
											  //$resultado=log_actualizar_idenpaci($_POST,$_GET['id'],$bodx);
  											  $sentencia = "update clientes SET cod_vende='".$_POST['Mcod_vende']."'
										          WHERE sucursal='".$bodx."' and cod_cliente= '".$_POST['Codigo']."'";  
										          $resultado = mysql_query($sentencia);
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
										<td>Municipio:</td>
										<td>
											<select disabled="disabled" name="SubPartidas"  id="SubPartidas"  class="frm_cmb">
											<option value="0">Seleccione un Municipio...</option>
											</select>
										</td>									
										</tr>

										
										<tr>
										<td>Canton:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_a"  id="SubPartidas_a"  class="frm_cmb">
											<option value="0">Seleccione un Canton...</option>
											</select>
										</td>									
										</tr>
										
										<tr>
										<td>Barrio o finca:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_b"  id="SubPartidas_b"  class="frm_cmb">
											<option value="0">Seleccione un Barrio...</option>
											</select>
										</td>									
										</tr>


										<tr>
									        <td>Colonia o Urb.:</td>
										<td>
											<select disabled="disabled" name="SubPartidas_c"  id="SubPartidas_c"  class="frm_cmb">
											<option value="0">Seleccione un Caserio...</option>
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
									<td>Otra referencia:</td>
									<td><input type="text" class="frm_txt_long" name="Motraref" value="'.(isset($_POST['Motraref'])?$_POST['Motraref']:'').'" /></td>
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


											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
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
