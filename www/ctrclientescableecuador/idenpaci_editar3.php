$registro['Numeperi']-$meseshastahoy<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>- customerscabletv - Editar registro de clientes </title>
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
		$('#Ulfepago1').datepicker({
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
		$('#Ulfepago2').datepicker({
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
		$('#Fechaul').datepicker({
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
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$anio1=intval(substr($registro['Fechaip'],0,4));
                                                                        $anio2=intval(substr(date('d/m/Y'),6,4));
									$fe1=$registro['Fechai'];                                                                        
									$fe2=date('Y/m/d');
									$fechainicial = new DateTime($fe1);
									$fechafinal = new DateTime($fe2);
									$diferencia = $fechainicial->diff($fechafinal);
									$meseshastahoy = ( $diferencia->y * 12 ) + $diferencia->m;
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
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci3.php">';    
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
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
										<td>
										<select name="Msexo" disabled="true" class="frm_cmb">
										<option value="1" '.($registro['Msexo']==1?' selected="selected" ':'').'>Masculino</option>											
										<option value="2" '.($registro['Msexo']==2?' selected="selected" ':'').'>Femenino</option>											
										</select>
										</td>

									<td>DUI:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mdui" value="'.$registro['Mdui'].'" /></td>
									</tr>

									<tr>
									<td>NIT:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mnit" value="'.$registro['Mnit'].'" /></td>
									<td>NRC:</td>
									<td><input type="text" readonly="readonly" class="frm_txt" name="Mregistro" value="'.$registro['Mregistro'].'" /></td>
									</tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" readonly="readonly" class="frm_txt_long" name="Mtelefono" value="'.$registro['Mtelefono'].'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" readonly="readonly" class="frm_txt_long" name="Mcelu" value="'.$registro['Mcelu'].'" /></td>
									</tr>


									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Email" value="'.$registro['Email'].'" /></td>
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



									<td bgcolor="#00FF00">Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicio  del periodo:</td>
									<td><input type="text" class="frm_txt" id=Ulfepago1 name="Ulfepago1" value="'.$registro['Ulfepago1'].'" /></td>
									</tr>

									<tr>
									<td>Fecha final del periodo:</td>
									<td><input type="text" class="frm_txt" id=Ulfepago2 name="Ulfepago2" value="'.$registro['Ulfepago2'].'" /></td>
									</tr>


									<tr>
									<td>Mes pagado:</td>
									<td><input type="text" class="frm_txt" name="Ulmespago" value="'.$registro['Ulmespago'].'" /></td>
									</tr>

									<tr>
									<td>Fecha del ultimo pago:</td>
									<td><input type="text" class="frm_txt" id=Fechaul name="Fechaul" value="'.$registro['Fechaul'].'" /></td>
									</tr>

									<tr>
									<td>Monto del ultimo pago:</td>
									<td><input type="text" class="frm_txt" name="Ulpago" value="'.$registro['Ulpago'].'" /></td>
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
												$resultado=log_actualizar_idenpaci3($_POST,$_GET['id'],$bodx);
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
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnombre" value="'.(isset($_POST['Mnombre'])?$_POST['Mnombre']:'').'" /></td>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mapellido" value="'.(isset($_POST['Mapellido'])?$_POST['Mapellido']:'').'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
									<td>
										<select name="Msexo" disabled="true" class="frm_cmb">
											<option value="1" '.(isset($_POST['Msexo'])?($_POST['Msexo']==1?' selected="selected" ':''):'').'>Masculino</option>
											<option value="2" '.(isset($_POST['Msexo'])?($_POST['Msexo']==2?' selected="selected" ':''):'').'>Femenino</option>
										</select>
									</td>
									<td>DUI:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mdui" value="'.(isset($_POST['Mdui'])?$_POST['Mdui']:'').'" /></td>
									</tr>

									<tr>
									<td>NIT:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mnit" value="'.(isset($_POST['Mnit'])?$_POST['Mnit']:'').'" /></td>
									<td>NRC:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Mregistro" value="'.(isset($_POST['Mregistro'])?$_POST['Mregistro']:'').'" /></td>
									</tr>

									<tr>
									<td>Telefonos fijos:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mtelefono" value="'.(isset($_POST['Mtelefono'])?$_POST['Mtelefono']:'').'" /></td>
									</tr>

									<tr>
									<td>Celulares:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly"name="Mcelu" value="'.(isset($_POST['Mcelu'])?$_POST['Mcelu']:'').'" /></td>
									</tr>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt" name="Email" readonly="readonly" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									<td>Tipo de persona:</td>
									<td>
										<select name="Mttpersona" disabled="true" class="frm_cmb">
											<option value="1" '.(isset($_POST['Mttpersona'])?($_POST['Mttpersona']==1?' selected="selected" ':''):'').'>Natural</option>
											<option value="2" '.(isset($_POST['Mttpersona'])?($_POST['Mttpersona']==2?' selected="selected" ':''):'').'>Juridica</option>
										</select>
									</td>
									</tr>



									<tr>
									<td>Actividad Económica:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Actividad" value="'.(isset($_POST['Actividad'])?$_POST['Actividad']:'').'" /></td>
									</tr>

									<td bgcolor="#00FF00">Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicio  del periodo:</td>
									<td><input type="text" class="frm_txt" id=Ulfepago1 name="Ulfepago1" value="'.(isset($_POST['Ulfepago1'])?$_POST['Ulfepago1']:'').'"/></td>
									</tr>

									<tr>
									<td>Fecha final del periodo:</td>
									<td><input type="text" class="frm_txt" id=Ulfepago2 name="Ulfepago2" value="'.(isset($_POST['Ulfepago2'])?$_POST['Ulfepago2']:'').'"/></td>
									</tr>


									<tr>
									<td>Mes pagado:</td>
									<td><input type="text" class="frm_txt" name="Ulmespago" value="'.(isset($_POST['Ulmespago'])?$_POST['Ulmespago']:'').'"/></td>
									</tr>

									<tr>
									<td>Fecha del ultimo pago:</td>
									<td><input type="text" class="frm_txt" id=Fechaul name="Fechaul" value="'.(isset($_POST['Fechaul'])?$_POST['Fechaul']:'').'"/></td>
									</tr>

									<tr>
									<td>Monto del ultimo pago:</td>
									<td><input type="text" class="frm_txt" name="Ulpago" value="'.(isset($_POST['Ulpago'])?$_POST['Ulpago']:'').'"/></td>
									</tr>


									

									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Mobservacion" value="'.(isset($_POST['Mobservacion'])?$_POST['Mobservacion']:'').'" /></td>
									</tr>




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
