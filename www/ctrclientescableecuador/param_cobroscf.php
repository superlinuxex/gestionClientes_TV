<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Reporte de avisos de cobros</title>
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

<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#FechaD').datepicker({
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
							<h3 class="title"><a href="#">Parametros para la Generacion del Reporte de Clientes con pagos pendientes</a></h3>
							<div class="entry">
								<?php


$bodx=$_SESSION["idBodega"];
$hoy=date('d/m/Y');

if(isset($_POST["export_data"])) {
		$insertar=true;
										if($_POST['Bodega']=="")
										{
										  $insertar=false;
										}

		if ($insertar==true)
		{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_repocobroexcel.php?
		fd='.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'
		&fh='.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'
		&ti='.(isset($_POST['Tipoinfo'])?$_POST['Tipoinfo']:'').'
		&zo='.(isset($_POST['SubPartidas'])?$_POST['SubPartidas']:'').'
		&zo2='.(isset($_POST['SubPartidas_a'])?$_POST['SubPartidas_a']:'').'
		&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
		exit;
		unset($_POST); 
		}										
}




								        $bodx=$_SESSION["idBodega"];
									if (isset ($_POST['aceptar']))
									{
										$insertar=true;

										if($_POST['Bodega']=="")
										{
										  $insertar=false;
										}
										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_avisoscfsector.php?

											fd='.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'
											&fh='.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'
											&ti='.(isset($_POST['Tipoinfo'])?$_POST['Tipoinfo']:'').'
											&zo='.(isset($_POST['SubPartidas'])?$_POST['SubPartidas']:'').'
											&zo2='.(isset($_POST['SubPartidas_a'])?$_POST['SubPartidas_a']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 

										}										
									}

									if (isset ($_POST['aceptar2']))
									{
										$insertar=true;
										if($_POST['Bodega']=="")
										{
										  $insertar=false;
										}


										if ($insertar==true)
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=rpt_avisoscf_pdf.php?

											fd='.(isset($_POST['FechaD'])?$_POST['FechaD']:'').'
											&fh='.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'
											&ti='.(isset($_POST['Tipoinfo'])?$_POST['Tipoinfo']:'').'
											&zo='.(isset($_POST['SubPartidas'])?$_POST['SubPartidas']:'').'
											&zo2='.(isset($_POST['SubPartidas_a'])?$_POST['SubPartidas_a']:'').'
											&bod= '.(isset($_POST['Bodega'])?$_POST['Bodega']:'').'">';
											exit;
											unset($_POST); 

										}										
									}



									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="padding:0px 0px 0px 0px;  cellpadding="0"; cellspacing="0"; border=2;" >


									<input type="text"  name="Bodega" hidden="true" class="frm_txt" value="'.$bodx.'">

									<tr>
									<td>Informe a generar:</td>
									<td>
										<select name="Tipoinfo" class="frm_cmb_long">
											<option value="2" '.(isset($_POST['Tipoinfo'])?($_POST['Tipoinfo']==2?' selected="selected" ':''):'').'>Factura</option>
										</select>
									</td>
									</tr>


										<tr>
										<td>Estado:</td>
										<td>
											<select name="Partida" id="Partida" class="frm_cmb_long" onChange="CargarPartidas(this.id)" />
											<option value="">Todas las poblaciones...</option>';
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
										


									<tr>
									<td>Fecha del reporte:</td>
									<td><input type="text" class="frm_txt" name="FechaD" id="FechaD" value="'.$hoy.'"/></td>
									</td>
									</tr>


									<tr>
									<td>Sucursal:</td>
									<td>
										<select name="Bodega" class="frm_cmb" />
										<option value="">Seleccione una sucursal...</option>';
										require_once("./logica/log_bodegas.php");
										$resultado=log_obtener_bodegas_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Bodega"]))
											{
												if ($_POST["Bodega"]==$fila['Codigo'])
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



									
									<input type="hidden"  name="FechaH"  class="frm_txt" value="'.(isset($_POST['FechaH'])?$_POST['FechaH']:'').'">

									<td><input type="hidden" class="frm_txt" name="Mvendedor" value="'.(isset($_POST['Mvendedor'])?$_POST['Mvendedor']:'').'" /></td>
								
									
					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Generar"  class="frm_btn" name="aceptar"/>
									<input  type="submit" value="Enviar a PDF"  class="frm_btn" name="aceptar2"/>
									<input  type="submit" value="Enviar a Excel"  class="frm_btn" name="export_data"/>
									</td>
									</tr>
									</table>
									</form>';
									// quitado temporalmente <input  type="submit" id="export_data" value="Exportar a excel"  class="frm_btn" name="export_data"/>

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
