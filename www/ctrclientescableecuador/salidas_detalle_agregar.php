<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Agregar Detalle de Salida de Articulos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


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
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados
		cmbSubPartida_a.length=0;
		var nuevaOpcionCmbSubPartida_a=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_a.value=0; 
		nuevaOpcionCmbSubPartida_a.innerHTML="Seleccione una Sub-Partida A...";
		cmbSubPartida_a.appendChild(nuevaOpcionCmbSubPartida_a);	
		cmbSubPartida_a.disabled=true;
		
		cmbSubPartida_b.length=0;
		var nuevaOpcionCmbSubPartida_b=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_b.value=0; 
		nuevaOpcionCmbSubPartida_b.innerHTML="Seleccione una Sub-Partida B...";
		cmbSubPartida_b.appendChild(nuevaOpcionCmbSubPartida_b);	
		cmbSubPartida_b.disabled=true;
		
		// Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=1&part="+codPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "eleccione una Sub-Partida B..." y pongo una que dice "Cargando..."
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
		
		//obtener item seleccionado en el combobox Partidas
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		var codSubPartida=cmbSubPartida.options[cmbSubPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados
		cmbSubPartida_b.length=0;
		var nuevaOpcionCmbSubPartida_b=document.createElement("option"); 
		nuevaOpcionCmbSubPartida_b.value=0; 
		nuevaOpcionCmbSubPartida_b.innerHTML="Seleccione una Sub-Partida B...";
		cmbSubPartida_b.appendChild(nuevaOpcionCmbSubPartida_b);	
		cmbSubPartida_b.disabled=true;
		
		//Creo el nuevo objeto AJAX y envio los paramatros para llenar el combox subpartidas
		var ajax=nuevoAjax();		
		ajax.open("GET", "salidas_cmb_part.php?sel=2&part="+codPartida+"&spart="+codSubPartida, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				//Mientras carga elimino la opcion "eleccione una Sub-Partida B..." y pongo una que dice "Cargando..."
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
				// Mientras carga elimino la opcion "eleccione una Sub-Partida B..." y pongo una que dice "Cargando..."
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
							<h3 class="title">Agregar Detalle de Salida </a></h3>
							<div class="entry">
								<?php
									require_once("./utils/validar_datos.php");
									$Encabezado=$_SESSION['parametros'];
									$codigo_salida=$Encabezado['0'];
									$tipo=$Encabezado['1'];
									$bodega=$Encabezado['3'];
    									$hpartida="";
    									$hsubpartida="";
    									$hsubpartida_a="";
									$xtipomaterial="";
									$preciou=0;
									$parametros=$_SESSION['parametros'];
									$codigo_entrada=$parametros['0'];
									if ($parametros['1']==1)
									{
										echo 'PARA EL DOCUMENTO:&nbsp;';
										if ($parametros['8']!="")
										{
											echo '&nbsp;&nbsp;Transferencia o envio No.:&nbsp;'.$parametros['8'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}
									if ($parametros['1']==2)
									{
										echo 'PARA LA DEVOLUCION A PROVEEDOR:&nbsp;';
										if ($parametros['6']!="")
										{
											echo '&nbsp;&nbsp;Nota de devolucion No.:&nbsp;'.$parametros['6'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}
									if ($parametros['1']==3)
									{
										echo 'PARA LA ENTREGA:&nbsp;';
										if ($parametros['5']!="")
										{
											echo '&nbsp;&nbsp;Vale de salida No.:&nbsp;'.$parametros['5'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}

									if ($parametros['1']==4)
									{
										echo 'PARA LA ENTREGA:&nbsp;';
										if ($parametros['5']!="")
										{
											echo '&nbsp;&nbsp;Vale de salida No.:&nbsp;'.$parametros['5'];
											echo '&nbsp; de Fecha:&nbsp;'.$parametros['14'];

										}
									}


									
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
										exit;    
									}
									
									switch ($tipo)
									{
									case '1': /*transferencia*/
										if (isset ($_POST['aceptar']))
										{

											if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar un Producto 
												</div>';
												$insertar=false;
											}

											if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la cantidad 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(Validar_Decimales_Positivos($_POST['Cantidad'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Cantidad solo admite montos numéricos mayores que cero
												</div>';
												$insertar=false;
												}
											}
											
											if ($insertar==true)
											{
												require_once("logica/log_salidas.php");
												$existencia=log_validar_existencia($bodega,$_POST['Producto'],$_POST['Cantidad']);
												if ($existencia==-1)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													No hay existencias suficientes para realizar la salida.
													</div>';
												}
												else
												{
													if (log_validar_salida($codigo_salida)==0)
													{
														log_insertar_salida($Encabezado);

													}
												
													$resulatado=log_insertar_salida_detalle($_POST,$Encabezado);
													
													if ($resulatado==1)
													{
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro ingresado correctamente.
														</div>';
														unset($_POST);
												                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
												                exit;    
 													}
													else
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
															Ha ocurrido un error al insertar la salida. '.$resultado.'													
															</div>';
													}
												}
												
											}										
										}


									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodarti=$_POST["Codarti"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									 <tr>
									 <td>Buscar articulo por codigo o descripcion </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista general)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codarti" value="'.(isset($_POST['Codarti'])?$_POST['Codarti']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Lista de artículos según busqueda realizada:</td>
									<td>
									<select name="Producto" class="frm_cmb_long" />
									<option value="">Seleccione un Articulo...</option>';
									require_once("./logica/log_articulos.php");
									$resultado=log_obtener_articulos_cmb($hcodarti);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Producto"]))
									  {
									  if ($_POST["Producto"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']." -- Despachar por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	




										<tr>
										<td>Cantidad:</td>
										<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
										</tr>

									<tr>
									<td>Estado en que se encuentra el articulo:</td>
									<td>
										<select name="Estado" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estado'])?($_POST['Estado']==1?' selected="selected" ':''):'').'>NUEVO</option>
											<option value="2" '.(isset($_POST['Estado'])?($_POST['Usado']==2?' selected="selected" ':''):'').'>USADO</option>
										</select>
									</td>
									</tr>



										
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
										
									break;

									case '2': /*Devolucion a proveedor*/
										if (isset ($_POST['aceptar']))
										{
											if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar un Producto 
												</div>';
												$insertar=false;
											}

											if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la cantidad 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(Validar_Decimales_Positivos($_POST['Cantidad'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Cantidad solo adminte montos numéricos mayores que cero
												</div>';
												$insertar=false;
												}
											}
											
											if ($insertar==true)
											{
												require_once("logica/log_salidas.php");
												$existencia=log_validar_existencia($bodega,$_POST['Producto'],$_POST['Cantidad']);
												if ($existencia==-1)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													No hay existencias suficientes para realizar la salida.
													</div>';
												}
												else
												{
													if (log_validar_salida($codigo_salida)==0)
													{
														log_insertar_salida($Encabezado);
													}
													$resulatado=log_insertar_salida_detalle($_POST,$Encabezado);
													
													if ($resulatado==1)
													{
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro ingresado correctamente.
														</div>';
														unset($_POST);
														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
														exit;    
 
													}
													else
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
															Ha ocurrido un error al insertar la salida. '.$resultado.'													
															</div>';
													}
												}
												
											}										
										}
									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodarti=$_POST["Codarti"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									 <tr>
									 <td>Buscar articulo por codigo o descripcion </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista general)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codarti" value="'.(isset($_POST['Codarti'])?$_POST['Codarti']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Lista de artículos según busqueda realizada:</td>
									<td>
									<select name="Producto" class="frm_cmb_long" />
									<option value="">Seleccione un Articulo...</option>';
									require_once("./logica/log_articulos.php");
									$resultado=log_obtener_articulos_cmb($hcodarti);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Producto"]))
									  {
									  if ($_POST["Producto"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']." -- Despachar por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	

										<tr>
										<td>Cantidad:</td>
										<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
										</tr>

									<tr>
									<td>Estado en que se encuentra el articulo:</td>
									<td>
										<select name="Estado" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estado'])?($_POST['Estado']==1?' selected="selected" ':''):'').'>NUEVO</option>
											<option value="2" '.(isset($_POST['Estado'])?($_POST['Usado']==2?' selected="selected" ':''):'').'>USADO</option>
										</select>
									</td>
									</tr>


										
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
										
									break;

									case '3':/*entrega a tecnicos*/
										if (isset ($_POST['aceptar']))
										{
											if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar un Producto 
												</div>';
												$insertar=false;
											}

											if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la cantidad 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(Validar_Decimales_Positivos($_POST['Cantidad'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Cantidad solo admite montos numéricos mayores que cero
												</div>';
												$insertar=false;
												}
											}										
											
											if ($insertar==true)
											{
												require_once("logica/log_salidas.php");
												$existencia=log_validar_existencia($bodega,$_POST['Producto'],$_POST['Cantidad']);
												if ($existencia==-1)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													No hay existencias suficientes para realizar la salida.
													</div>';
												}
												else
												{
													if (log_validar_salida($codigo_salida)==0)
													{
														log_insertar_salida($Encabezado);
													}
													$resulatado=log_insertar_salida_detalle($_POST,$Encabezado);
													
													if ($resulatado==1)
													{
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro ingresado correctamente.
														</div>';
														unset($_POST); 

														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
														exit;    
													}
													else
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
															Error: '.$resulatado.'													
															</div>';
													}
												}
												
											}										
										}



									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodarti=$_POST["Codarti"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									 <tr>
									 <td>Buscar articulo por codigo o descripcion </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista general)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codarti" value="'.(isset($_POST['Codarti'])?$_POST['Codarti']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Lista de artículos según busqueda realizada:</td>
									<td>
									<select name="Producto" class="frm_cmb_long" />
									<option value="">Seleccione un Articulo...</option>';
									require_once("./logica/log_articulos.php");
									$resultado=log_obtener_articulos_cmb($hcodarti);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Producto"]))
									  {
									  if ($_POST["Producto"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']." -- Despachar por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	


										<tr>
										<td>Cantidad:</td>
										<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
										</tr>

									<tr>
									<td>Estado en que se encuentra el articulo:</td>
									<td>
										<select name="Estado" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estado'])?($_POST['Estado']==1?' selected="selected" ':''):'').'>NUEVO</option>
											<option value="2" '.(isset($_POST['Estado'])?($_POST['Usado']==2?' selected="selected" ':''):'').'>USADO</option>
										</select>
									</td>
									</tr>


									<tr>
									<td>Cliente al que se instaló el material:</td>
									<td>
										<select name="Cliente" class="frm_cmb" />
										<option value="">Seleccione un cliente de la tabla...</option>';
										require_once("./logica/log_salidas.php");
										$resultado=log_obtener_idenpaci_cmb($bodega);
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
												echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
											}
										}
									echo'
									</td>
									</tr>

										<tr>
										<td>Ticket de referencia:</td>
										<td><input type="text" class="frm_txt" name="Ticket" value="'.(isset($_POST['Ticket'])?$_POST['Ticket']:'').'" /></td>
										</tr>



										
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
									break;

									case '4':/*entrega a tecnicos para manteniento de red*/
										if (isset ($_POST['aceptar']))
										{
											if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe seleccionar un Producto 
												</div>';
												$insertar=false;
											}

											if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												Debe ingresar la cantidad 
												</div>';
												$insertar=false;										
											}
											else
											{
												if(Validar_Decimales_Positivos($_POST['Cantidad'])==0)
												{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
												La casilla Cantidad solo admite montos numéricos mayores que cero
												</div>';
												$insertar=false;
												}
											}										
											
											if ($insertar==true)
											{
												require_once("logica/log_salidas.php");
												$existencia=log_validar_existencia($bodega,$_POST['Producto'],$_POST['Cantidad']);
												if ($existencia==-1)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													No hay existencias suficientes para realizar la salida.
													</div>';
												}
												else
												{
													if (log_validar_salida($codigo_salida)==0)
													{
														log_insertar_salida($Encabezado);
													}
													$resulatado=log_insertar_salida_detalle($_POST,$Encabezado);
													
													if ($resulatado==1)
													{
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro ingresado correctamente.
														</div>';
														unset($_POST); 

														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
														exit;    
													}
													else
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
															Error: '.$resulatado.'													
															</div>';
													}
												}
												
											}										
										}



									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodarti=$_POST["Codarti"];

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									 <tr>
									 <td>Buscar articulo por codigo o descripcion </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista general)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codarti" value="'.(isset($_POST['Codarti'])?$_POST['Codarti']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';
									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
									

									<tr>
									<td>Lista de artículos según busqueda realizada:</td>
									<td>
									<select name="Producto" class="frm_cmb_long" />
									<option value="">Seleccione un Articulo...</option>';
									require_once("./logica/log_articulos.php");
									$resultado=log_obtener_articulos_cmb($hcodarti);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Producto"]))
									  {
									  if ($_POST["Producto"]==$fila['Codigo'])
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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']." -- Despachar por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	


										<tr>
										<td>Cantidad:</td>
										<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
										</tr>

									<tr>
									<td>Estado en que se encuentra el articulo:</td>
									<td>
										<select name="Estado" class="frm_cmb">
											<option value="1" '.(isset($_POST['Estado'])?($_POST['Estado']==1?' selected="selected" ':''):'').'>NUEVO</option>
											<option value="2" '.(isset($_POST['Estado'])?($_POST['Usado']==2?' selected="selected" ':''):'').'>USADO</option>
										</select>
									</td>
									</tr>



										<tr>
										<td>Ticket de referencia:</td>
										<td><input type="text" class="frm_txt" name="Ticket" value="'.(isset($_POST['Ticket'])?$_POST['Ticket']:'').'" /></td>
										</tr>

										
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
									break;


									default :
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
