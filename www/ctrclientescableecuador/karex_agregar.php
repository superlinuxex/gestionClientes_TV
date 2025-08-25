<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>ERVING-INVENTARIO - Mantenimiento de clientes </title>
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
	if (cmbSeleccionado=='Pais')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Pais');
		var cmbSubPartida=document.getElementById('Deptos');
		var cmbSubPartida_a=document.getElementById('Ciudades');
		
		//obtener item seleccionado en el combobox Paises
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados
		cmbSubPartida_a.length=0;
		var nuevaOpcionCmbSubPartida_a=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_a.value=0; 
		nuevaOpcionCmbSubPartida_a.innerHTML="Seleccione una Ciudad...";
		cmbSubPartida_a.appendChild(nuevaOpcionCmbSubPartida_a);	
		cmbSubPartida_a.disabled=true;
		
	
		// Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox deptos
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=1&part="+codPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Seleccione un Departamento..." y pongo una que dice "Cargando..."
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
	
	if (cmbSeleccionado=='Deptos')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Pais');
		var cmbSubPartida=document.getElementById('Deptos');
		var cmbSubPartida_a=document.getElementById('Ciudades');
		
		//obtener item seleccionado en el combobox Paises
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		
		
		//Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox deptos
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=2&part="+codPartida+"&spart="+codSubPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				//Mientras carga elimino la opcion "Seleccione una Cuidad..." y pongo una que dice "Cargando..."
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
							<h2 class="title">Agregar Registro de Cliente</a></h2>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									$usux=$_SESSION['nombre_usuario'];
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Codigo'])==false or $_POST['Codigo']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el codigo para el cliente que desea ingresar
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Nombres'])==false or $_POST['Nombres']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el Nombre para el cliente que desea ingresar
											</div>';
											$insertar=false;
										}

										require_once("logica/log_idenpaci.php");
										$resultado=log_veexisreg_idenpaci($_POST,$bodx);
                 								IF($resultado==1){
										 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
										 Registro Ya existe, imposible guardar.
										 </div>';
 										 $insertar=false;
										}

									        
										if ($insertar==true)
										{
											require_once("logica/log_idenpaci.php");
											$resultado=log_insertar_idenpaci($_POST,$bodx,$usux);
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
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
										exit;    
 
										}										
									}
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Codigo:</td>
									<td><input type="text" class="frm_txt" name="Codigo" value="'.(isset($_POST['Codigo'])?$_POST['Codigo']:'').'" /></td>
									</tr>

									<tr>
									<td>Nombres:</td>
									<td><input type="text" class="frm_txt_long" name="Nombres" value="'.(isset($_POST['Nombres'])?$_POST['Nombres']:'').'" /></td>
									</tr>

									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" name="Apellidos" value="'.(isset($_POST['Apellidos'])?$_POST['Apellidos']:'').'" /></td>
									</tr>

									
									<tr>
									<td>Sexo:</td>
									<td>
										<select name="Sexo" class="frm_cmb">
											<option value="1" '.(isset($_POST['Sexo'])?($_POST['Sexo']==1?' selected="selected" ':''):'').'>Masculino</option>
											<option value="2" '.(isset($_POST['Sexo'])?($_POST['Sexo']==2?' selected="selected" ':''):'').'>Femenino</option>
										</select>
									</td>
									</tr>


									<td>NIT:</td>
									<td><input type="text" class="frm_txt" name="Ruc" value="'.(isset($_POST['Ruc'])?$_POST['Ruc']:'').'" /></td>
									</tr>


									<td>Registro fiscal:</td>
									<td><input type="text" class="frm_txt" name="Dni" value="'.(isset($_POST['Dni'])?$_POST['Dni']:'').'" /></td>
									</tr>

									<tr>
									<td>Actividad:</td>
									<td><input type="text" class="frm_txt_long" name="Actividad" value="'.(isset($_POST['Actividad'])?$_POST['Actividad']:'').'" /></td>
									</tr>


									<tr>
									<td>Domicilio:</td>
									<td><input type="text" class="frm_txt_long" name="Direccion" value="'.(isset($_POST['Direccion'])?$_POST['Direccion']:'').'" /></td>
									</tr>
									

									<tr>
									<td>Ciudad:</td>
									<td><input type="text" class="frm_txt_long" name="Distrito" value="'.(isset($_POST['Distrito'])?$_POST['Distrito']:'').'" /></td>
									</tr>

									<tr>
									<td>Teléfono:</td>
									<td><input type="text" class="frm_txt" name="Telefono" value="'.(isset($_POST['Telefono'])?$_POST['Telefono']:'').'" /></td>
									</tr>


									<tr>
									<td>Celular:</td>
									<td><input type="text" class="frm_txt" name="Celular" value="'.(isset($_POST['Celular'])?$_POST['Celular']:'').'" /></td>
									</tr>

									<tr>
									<td>Correo electrónico:</td>
									<td><input type="text" class="frm_txt_long" name="Email" value="'.(isset($_POST['Email'])?$_POST['Email']:'').'" /></td>
									</tr>

									<tr>
									<td>Fecha de Registro:</td>
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
		<p>Todos los derechos reservados - Erving Chamagua Romero, El Salvador, 2013</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
