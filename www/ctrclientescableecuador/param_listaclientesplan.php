<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Reporte del registro del cliente</title>
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
		$('#FechaD').datepicker({
			inline: true
		});
		$('#FechaH').datepicker({
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
				<img src="imagenes/linea1opti.png" alt="logo" border="0" align="texttop" />
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
							<h3 class="title">Generar reporte de clientes por plan adquirido</h3>

							<div class="entry">
								<?php
									$bodx1='1';
									$bodx=$_SESSION["idBodega"];

									if (isset ($_POST['aceptar']))
									{
										$insertar=true;

										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_listaclientesp.php?
											fd='.(isset($_POST['Mttplan'])?$_POST['Mttplan']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 

										}										
									}

									if (isset ($_POST['aceptar2']))
									{
										$insertar=true;

										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_listaclientesp_pdf.php?
											fd='.(isset($_POST['Mttplan'])?$_POST['Mttplan']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';

											exit;
											unset($_POST); 

										}										
									}

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="padding:0px 0px 0px 0px;  cellpadding="0"; cellspacing="0"; border=2;" >

									<input type="text"  name="FechaD" id="FechaD"  hidden="true" class="frm_txt" value="'.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'">
									<input type="text"  name="FechaH" id="FechaH"  hidden="true" class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">
									<td><input type="text" class="frm_txt" name="Mpoligono" hidden="true" value="'.(isset($_POST['Mpoligono'])?$_POST['Mpoligono']:'').'" /></td>
									<input type="text"  hidden="true" name="Bodega" class="frm_txt" value="'.$bodx.'">


									<tr>
									<td>Plan contratado:</td>
									<td>
									<select name="Mttplan" class="frm_cmb" />
									<option value="">Seleccione un plan...</option>';
									require_once("./logica/log_planes.php");
									$resultado=log_obtener_planes_cmb3($bodx1);
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


									
					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Generar"  class="frm_btn" name="aceptar"/>
									<input  type="submit" value="Enviar a PDF"  class="frm_btn" name="aceptar2"/>
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
