<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Editar Detalle de Salida </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
<script type="text/javascript" src="utils/select_partidas.js"></script>

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
							<h2 class="title">Editar Detalle de Salida</a></h2>
							<div class="entry">
								<?php
									require_once("./utils/validar_datos.php");
									require_once("logica/log_salidas.php");
									$Encabezado=$_SESSION['parametros'];
									$codigo_salida=$Encabezado['0'];
									$bodega=$Encabezado['3'];
									$tipo=$Encabezado['1'];
									$tabla=log_obtener_detalle_salida_nuevo2($codigo_salida,$_GET["id"],$bodega);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;
									$mostrar_datos=true;


									$get_o_post='get';
									if(isset($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
										exit;  
									}
									if (isset ($_POST['aceptar']))
									{
										$get_o_post='post';
										switch ($tipo)
										{
											case '1':/*a obra*/
        										  
												if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar la cantidad para el Detalle de Salida
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
													
													if ($registro['Cantidad']<$_POST['Cantidad'])//5<3
													{
														$cantidad=$registro['Cantidad']-$_POST['Cantidad'];
														$producto=$registro['Producto'];
														$existencia=log_validar_existencia($bodega,$producto,$cantidad);
													}
													else
													{
														$existencia=1;
													}
														
													
													if ($existencia==-1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No hay existencias suficientes para realizar la salida.
														</div>';
													}
													else
													{
														$resulatado=log_actualizar_salida_detalle($_POST,$Encabezado,$registro);
														
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
																Error:'.$resulatado.'													
																</div>';
															unset($_POST); 
															echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
															exit;  

														}
													}
													
												}
											break;
											case '2': /*transferencia*/
												if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar la cantidad para el Detalle de Salida de Matariales que desea ingresar.
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
													
													if ($registro['Cantidad']<$_POST['Cantidad'])//5<3
													{
														$cantidad=$registro['Cantidad']-$_POST['Cantidad'];
														$producto=$registro['Producto'];
														$existencia=log_validar_existencia($bodega,$producto,$cantidad);
													}
													else
													{
														$existencia=1;
													}
														
													
													if ($existencia==-1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No hay existencias suficientes para realizar la salida.
														</div>';
													}
													else
													{
														$resultado=log_actualizar_salida_detalle($_POST,$Encabezado,$registro);
														
														if ($resultado==1)
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
																Ha ocurrido un error al actualiza la salida. '.$resultado.'													
																</div>';
														}
													}
													
												}
											break;

											case '3': /*devolucion al proveedor*/
												if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="")
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar la cantidad para el Detalle de Salida de Matariales que desea ingresar.
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
													
													if ($registro['Cantidad']<$_POST['Cantidad'])//5<3
													{
														$cantidad=$registro['Cantidad']-$_POST['Cantidad'];
														$producto=$registro['Producto'];
														$existencia=log_validar_existencia($bodega,$producto,$cantidad);
													}
													else
													{
														$existencia=1;
													}
														
													
													if ($existencia==-1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No hay existencias suficientes para realizar la salida.
														</div>';
													}
													else
													{
														$resultado=log_actualizar_salida_detalle($_POST,$Encabezado,$registro);
														
														if ($resultado==1)
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
																Ha ocurrido un error al actualiza la salida. '.$resultado.'													
																</div>';
														}
													}
													
												}
											break;

											case '4':/*combustibles*/
        										  
												if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar la cantidad para el Detalle de Salida de Matariales que desea ingresar.
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
													
													if ($registro['Cantidad']<$_POST['Cantidad'])//5<3
													{
														$cantidad=$registro['Cantidad']-$_POST['Cantidad'];
														$producto=$registro['Producto'];
														$existencia=log_validar_existencia($bodega,$producto,$cantidad);
													}
													else
													{
														$existencia=1;
													}
														
													
													if ($existencia==-1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No hay existencias suficientes para realizar la salida.
														</div>';
													}
													else
													{
														$resultado=log_actualizar_salida_detalle($_POST,$Encabezado,$registro);
														
														if ($resultado==1)
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
																Ha ocurrido un error al actualiza la salida. '.$resultado.'													
																</div>';
														}
													}
													
												}
											break;

											case '5':/*a obra*/
        										  
												if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" or $_POST['Cantidad']==0)
												{
													echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
													Debe ingresar la cantidad para el Detalle de Salida
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
													
													if ($registro['Cantidad']<$_POST['Cantidad'])//5<3
													{
														$cantidad=$registro['Cantidad']-$_POST['Cantidad'];
														$producto=$registro['Producto'];
														$existencia=log_validar_existencia($bodega,$producto,$cantidad);
													}
													else
													{
														$existencia=1;
													}
														
													
													if ($existencia==-1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														No hay existencias suficientes para realizar la salida.
														</div>';
													}
													else
													{
														$resulatado=log_actualizar_salida_detalle($_POST,$Encabezado,$registro);
														
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
																Error:'.$resulatado.'													
																</div>';
															unset($_POST); 
															echo '<META HTTP-EQUIV="Refresh" Content="0; URL=salidas_detalle.php">';    
															exit;  

														}
													}
													
												}
											break;


										}
									}
									if ($mostrar_datos==true)
									{
										switch ($tipo)
										{
										case '1': //Salida de  materiales a obra
											if ($get_o_post=='get')
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
											
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Producto"]==$fila['Codigo'])
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
												<td>Cantidad:</td>
												<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'"  /></td>
												</tr>
												
												<tr>
												<td>Utilizar En:</td>
												<td><input type="text" class="frm_txt_long" name="Utilizar_en"  value="'.$registro["utilizar_en"].'"  /></td>
												</tr>
												
												<tr>
												<td>Equipo:</td>
												<td>
													<select name="Equipo" id="Equipo" class="frm_cmb" />
													<option value="-1">Seleccione un Equipo...</option>';
													require_once("./logica/log_equipos.php");
													$resultado=log_obtener_equipos_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Equipo"]==$fila['Codigo'])
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
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';

											}
											else
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
										break;
										case '2': //Salida de materiales por transferencia
											if ($get_o_post=='get')
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Producto"]==$fila['Codigo'])
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
												<td>Cantidad:</td>
												<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'"  /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
											else
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
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
															echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
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
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
										break;

										case '3': //Salida de materiales por devolucion a proveedor
											if ($get_o_post=='get')
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Producto"]==$fila['Codigo'])
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
												<td>Cantidad:</td>
												<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'"  /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
											else
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
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
															echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
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
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
										break;

										case '4': //combustibles
											if ($get_o_post=='get')
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Producto"]==$fila['Codigo'])
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
												<td>Cantidad:</td>
												<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'"  /></td>
												</tr>
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
											else
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
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
															echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
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
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
										break;

										case '5': //factura fiscal
											if ($get_o_post=='get')
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
											
												<tr>
												<td>Producto:</td>
												<td>
													<select name="Producto" disabled="true" id="Producto" class="frm_cmb" />
													<option value="-1">Seleccione un Producto...</option>';
													require_once("./logica/log_articulos.php");
													$resultado=dat_obtener_articulos_x_bodega_cmb($bodega);
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Producto"]==$fila['Codigo'])
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
												<td>Cantidad:</td>
												<td><input type="text" class="frm_txt" name="Cantidad" value="'.$registro["Cantidad"].'"  /></td>
												</tr>
												
												<tr>
												<td>Utilizar En:</td>
												<td><input type="text" class="frm_txt_long" name="Utilizar_en"  value="'.$registro["utilizar_en"].'"  /></td>
												</tr>
												
												<tr>
												<td>Equipo:</td>
												<td>
													<select name="Equipo" id="Equipo" class="frm_cmb" />
													<option value="-1">Seleccione un Equipo...</option>';
													require_once("./logica/log_equipos.php");
													$resultado=log_obtener_equipos_cmb();
													while ( $fila = mysql_fetch_array($resultado))
													{
														if ($registro["Equipo"]==$fila['Codigo'])
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
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';

											}
											else
											{
												echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >';
												echo '
												<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
												
												
												<tr>
												<td colspan="2" align="center">
												<input  type="submit" value="Actualizar"  class="frm_btn" name="aceptar"/>
												<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
												<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
												</td>
												</tr>
												</table>
												</form>';
											}
										break;


										default:
										break;
										}
									}
									else
									{
										echo'
										<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"]."?id=".$_GET['id'].'" >
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Regresar" class="frm_btn" name="cancelar"/>
										</td>
										</tr>
										</table>
										</form>';
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
		<p>Todos los derechos reservados </p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
