<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Facturacion de servicios </title>
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
function CargarPartidas(cmbSeleccionado)
{
	if (cmbSeleccionado=='Cliente')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Cliente');
		var cmbSubPartida=document.getElementById('Direccion');
		var cmbSubPartida_a=document.getElementById('SubPartidas_a');
		var cmbSubPartida_b=document.getElementById('SubPartidas_b');
		var cmbSubPartida_c=document.getElementById('SubPartidas_c');
		
		//obtener item seleccionado en el combobox Clientes
		var codPartida=cmbPartida.options[cmbPartida.selectedIndex].value;
		
		//establecer los combobos dependiente como desabilitados
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
		ajax.open("GET", "salidas_cmb_direccion.php?sel=1&part="+Cliente, true);
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
	
	if (cmbSeleccionado=='Direccion')
	{
		//obtener objetos combobox
		var cmbPartida=document.getElementById('Cliente');
		var cmbSubPartida=document.getElementById('Direccion');
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
							<h3 class="title">Ingreso de Factura por servicios</a></h3>
							<div class="entry">
							<div id="itsthetable">
             	                                	<?php
										$bodx=$_SESSION["idBodega"];
										$fechahoy=date('d/m/Y');
										$nmuni="";
										$ncan="";
										$nbar="";
										$ncase="";
                                                                                $calle="";
										$ave="";
										$pasaje="";
                                                                                $poligono="";
										$blocke="";
										$casa="";
										$otraref="";

										require_once("logica/log_facturas.php");

										if (isset ($_POST['tipo']))
										{
											$tipo=$_POST['tipo'];
											$_SESSION["tipo"]=$tipo;
										}
										else
										{
											$tipo=$_GET['tipo'];
                                                                                        $_SESSION["tipo"]=$tipo;
										}
										switch ($tipo)
										{
								case '1':/*Consumidor caso Ecuador -factura de consumidor final*/
											if (isset ($_POST['cancelar']))
											{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											exit;    
											}


												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Factura'])==false or $_POST['Factura']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar en numero de la factura
														</div>';
														$insertar=false;
													}
													if (isset($_POST['Cliente'])==false or $_POST['Cliente']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe debe completar los datos del cliente con el boton COMPLETAR DATOS
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar la fecha de la factura
														</div>';
														$insertar=false;
													}

													if ($_POST['Lugarpago']==2 and $_POST['Autoriza']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar el codigo del cobrador de esta factura
														</div>';
														$insertar=false;
													}


													//Validando si existe la factura
													 $existe=log_validar_factura($_POST['Factura'],$tipo,$_POST['Fecha'],$bodx);
													if ($existe==1)
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														La factura que intenta ingresar ya existe, no puede continuar														</div>';
														$insertar=false;
													}



													if ($insertar==true)
													{

														$params[0]=$_POST['Factura'];
														$params[1]=$tipo;
														$params[2]=$_SESSION["idusuarios"];
														$params[3]=$_SESSION["idBodega"];
														$params[4]=null;/*Codigo_bodega_ent*/
														$params[5]=null;/*Codigo_vale*/
														$params[6]=null;/*Codigo_devo*/
														$params[7]=null;/*Codigo_PROVEEDOR*/
														$params[8]=null;/*Codigo_CREDITOFISCAL*/
														$params[9]=$_POST['Cliente'];
														$params[10]=null;
														$params[11]=null;/*Codigo_MOTIVO*/
														$params[12]=$_POST['Autoriza'];
														$params[13]=$_POST['Lugarpago'];
														$params[14]=$_POST['Fecha'];
														$params[15]=$_POST['Descuento'];

														$_SESSION['factura']=$params[0];
														$_SESSION['tipo']=$params[1];
														$_SESSION['idusuarios']=$params[2];
														$_SESSION['idbodega']=$params[3];
														$_SESSION['cliente']=$params[9];
														$_SESSION['autoriza']=$params[12];
														$_SESSION['lugarpago']=$params[13];
														$fecha50=$params[14];
														$_SESSION['descuento']=$params[15];
													
														$_SESSION['parametros']=$params;
														
														echo '  <META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalle.php?lafecha='.$fecha50.'">';
													}										
												}

									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];
									}
									if (isset ($_POST['confirmar2']))
									{
                                                                         $xxcliente=$_POST["Cliente"];
									 $losdatos=log_obtener_datos_cliente($xxcliente,$bodx);
									 $registrocli=mysql_fetch_array($losdatos);
									 $nmuni=$registrocli["nmuni"];
									 $ncan=$registrocli["ncan"];
									 $nbar=$registrocli["nbar"];
									 $ncase=$registrocli["ncase"];
									 $calle=$registrocli["calle"];
									 $ave=$registrocli["ave"];
									 $pasaje=$registrocli["pasaje"];
									 $poligono=$registrocli["poligono"];
									 $blocke=$registrocli["blocke"];
									 $casa=$registrocli["casa"];
                                                                         $direccion=$nmuni.",".$ncan.",".$nbar.",".$ncase.",C.:".$calle.",Ave.:".$ave.",Pje.:".$pasaje.",Pol.:".$poligono.",Block:".$blocke.",#:".$casa;
									$fe1=$registrocli['Fechai'];                                                                        
									$fe2=date('Y/m/d');
									$fechainicial = new DateTime($fe1);
									$fechafinal = new DateTime($fe2);
									$diferencia = $fechainicial->diff($fechafinal);
									$meseshastahoy = ( $diferencia->y * 12 ) + $diferencia->m;
                                                                         $diferencia=$registrocli['numeperi']-$meseshastahoy;
									 if ($diferencia<=2)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene menos de dos meses para caducar su contrato 														</div>';
										$insertar=false;
									  }

									 if ($diferencia<=0)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene un contrato vencido, dar atencion al cliente 														</div>';
										$insertar=false;
									  }

									}

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<h3>Consumidor</h3>
									</tr>


									 <tr>
									 <td>Buscar cliente por codigo o apellidos </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista de todos los clientes)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codcliente" value="'.(isset($_POST['Codcliente'])?$_POST['Codcliente']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';

								
									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Lista de clientes según busqueda realizada:</td>
									<td>
									<select name="Cliente" class="frm_cmb_long" />
									<option value="">Seleccione un Cliente...</option>';
									require_once("./logica/log_idenpaci.php");
									$resultado=log_obtener_idenpaci_cmb_actitec($bodx,$hcodclie);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Cliente"]))
									  {
									  if ($_POST["Cliente"]==$fila['Codigo'])
									   {
                                                                            $xxcliente=$fila['Codigo'];
									    echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
									   }
									   else
									   {
									    echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
									   }
									  }
									  else
									  {
									  echo "<option value='".$fila['Codigo']."'>".$fila['Codigo']."&nbsp".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									  }
									 }
									 echo'
									 </td>	
 									<td colspan="2" align="center">
									<input  type="submit" value="Completar Datos" class="frm_btn" name="confirmar2"/>
									</td>
									</tr>
									</table>
									</form>';




									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Codigo de cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente"  value="'.$xxcliente.'"  /></td>
									</tr>

							                <tr>
							                <td width="45%">
							                <p style="line-height: 100%">Direccion:</td>
							                <td width="45%">
							                <p style="line-height: 150%">
							                <textarea rows="4" name="Direccion" cols="80">'.$direccion.'</textarea></td>

									<tr>
									<td>Numero de factura:</td>
									<td><input type="text" class="frm_txt" name="Factura"  value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'"  /></td>
									</tr>
												
									<tr>
									<td>Fecha:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fecha" value="'.$fechahoy.'"/></td>
									</tr>

									<tr>
									<td>Lugar de pago:</td>
									<td>
										<select name="Lugarpago" class="frm_cmb">
											<option value="1" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==1?' selected="selected" ':''):'').'>Oficina</option>
											<option value="2" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==2?' selected="selected" ':''):'').'>Cobrador</option>
										</select>
									</td>
									</tr>

												

									<tr>
									<td>Persona que recibio el pago:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un vendedor de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Autoriza"]))
											{
												if ($_POST["Autoriza"]==$fila['Codigo'])
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
									echo'</td>
									</tr>
									<tr>


									<tr>
									<td>Descuento aplicado a toda la factura:</td>
									<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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
									break;

						case '2':/*FACTURA caso ecuador -credito fiscal*/
											if (isset ($_POST['cancelar']))
											{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											exit;    
											}

												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Cliente'])==false or $_POST['Cliente']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar cliente a quien le factura
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
														Debe ingresar la fecha de la factura
														</div>';
														$insertar=false;
													}

													if ($_POST['Lugarpago']==2 and $_POST['Autoriza']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar el codigo del cobrador de esta factura
														</div>';
														$insertar=false;
													}




													if ($insertar==true)
													{

														$params[0]=$_POST['Factura'];
														$params[1]=$tipo;/*tipo Salida*/
														$params[2]=$_SESSION["idusuarios"];
														$params[3]=$_SESSION["idBodega"];
														$params[4]=null;/*Codigo_bodega_ent*/
														$params[5]=null;/*Codigo_vale*/
														$params[6]=null;/*Codigo_devo*/
														$params[7]=null;/*Codigo_PROVEEDOR*/
														$params[8]=null;/*Codigo_CREDITOFISCAL*/
														$params[9]=$_POST['Cliente'];
														$params[10]=null;
														$params[11]=null;/*Codigo_MOTIVO*/
														$params[12]=$_POST['Autoriza'];
														$params[13]=$_POST['Lugarpago'];
														$params[14]=$_POST['Fecha'];
														$params[15]=$_POST['Descuento'];

														$_SESSION['factura']=$params[0];
														$_SESSION['idusuarios']=$params[2];
														$_SESSION['idbodega']=$params[3];
														$_SESSION['cliente']=$params[9];
														$_SESSION['autoriza']=$params[12];
														$_SESSION['lugarpago']=$params[13];
														$_SESSION['descuento']=$params[15];
														$fecha50=$params[14];

												
														$_SESSION['parametros']=$params;

                                                                                                                $bodega=$_SESSION['idbodega'];
                                                                                                                $fecha1=$_POST['Fecha'];
														$autoriza=$_POST['Autoriza'];
														$lugarpago=$_POST['Lugarpago'];
														$descuento=$_POST['Descuento'];
														$idusuarios=$_SESSION['idusuarios'];
                                                                                                                $tipo='2';
														$xcliente=$_POST['Cliente'];
														$a="FACTURAS";
														$sentencia3="select numero from correla2 where agencia='".$bodega."' and codigo='".$a."'";
														$resultado3 = mysql_query($sentencia3);
														$registroc=mysql_fetch_array($resultado3);
														$factura=$registroc["numero"]+1;
														$a="FACTURAS";
														$sentencia3="update correla2 set numero=$factura where agencia='".$bodega."' and codigo='".$a."'";
														$resultado3=mysql_query($sentencia3);
														//Validando si existe la factura
														 $existe=log_validar_factura($factura,$tipo,$fecha1,$bodega);
														if ($existe==1)
														{
															echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
															El numero de recibo que intenta ingresar ya existe, no puede continuar														
															</div>';
															echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
															exit;    

														}
														else
														{
														$resultado=log_insertar_factura($factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
														echo '  <META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalle.php?lafecha='.$fecha1.'&codc='.$xcliente.'&factu='.$factura.'">';
														}
														
													}										
												}
									$tipo1=2;
									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];
									}
									if (isset ($_POST['confirmar2']))
									{
                                                                         $xxcliente=$_POST["Cliente"];
									 $losdatos=log_obtener_datos_cliente($xxcliente,$bodx);
									 $registrocli=mysql_fetch_array($losdatos);
									 $nmuni=$registrocli["nmuni"];
									 $ncan=$registrocli["ncan"];
									 $nbar=$registrocli["nbar"];
									 $ncase=$registrocli["ncase"];
									 $calle=$registrocli["calle"];
									 $ave=$registrocli["ave"];
									 $pasaje=$registrocli["pasaje"];
									 $poligono=$registrocli["poligono"];
									 $blocke=$registrocli["blocke"];
									 $casa=$registrocli["casa"];
                                                                         $direccion=$nmuni.",".$ncan.",".$nbar.",".$ncase.",C.:".$calle.",Ave.:".$ave.",Pje.:".$pasaje.",Pol.:".$poligono.",Block:".$blocke.",#:".$casa;
									}

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<h3>Factura</h3>
									</tr>


									 <tr>
									 <td>Buscar cliente por codigo o apellidos </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista de todos los clientes)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codcliente" value="'.(isset($_POST['Codcliente'])?$_POST['Codcliente']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';

								
									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Lista de clientes según busqueda realizada:</td>
									<td>
									<select name="Cliente" class="frm_cmb_long" />
									<option value="">Seleccione un Cliente...</option>';
									require_once("./logica/log_idenpaci.php");
									$resultado=log_obtener_idenpaci_cmb_actitec($bodx,$hcodclie);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Cliente"]))
									  {
									  if ($_POST["Cliente"]==$fila['Codigo'])
									   {
                                                                            $xxcliente=$fila['Codigo'];
									    echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
									   }
									   else
									   {
									    echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
									   }
									  }
									  else
									  {
									  echo "<option value='".$fila['Codigo']."'>".$fila['Codigo']."&nbsp".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									  }
									 }
									 echo'
									 </td>	
 									<td colspan="2" align="center">
									<input  type="submit" value="Completar Datos" class="frm_btn" name="confirmar2"/>
									</td>
									</tr>
									</table>
									</form>';



									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Codigo de cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente"  value="'.$xxcliente.'"  /></td>
									</tr>

							                <tr>
							                <td width="45%">
							                <p style="line-height: 100%">Direccion:</td>
							                <td width="45%">
							                <p style="line-height: 150%">
							                <textarea rows="4" name="Direccion" cols="80">'.$direccion.'</textarea></td>


									<input type="text" class="frm_txt" name="Factura"  hidden="hidden" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'"  />
									<input type="text" class="frm_txt" name="Autoriza"  hidden="hidden" value="'.(isset($_POST['Autoriza'])?$_POST['Autoriza']:'').'"  />
												
									<tr>
									<td>Fecha:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fecha" value="'.$fechahoy.'"/></td>
									</tr>

									<tr>
									<td>Lugar de pago:</td>
									<td>
										<select name="Lugarpago" class="frm_cmb">
											<option value="1" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==1?' selected="selected" ':''):'').'>Oficina</option>
											<option value="2" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==2?' selected="selected" ':''):'').'>Cobrador</option>
										</select>
									</td>
									</tr>

												



									<tr>
									<td>Descuento:</td>
									<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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
											break;

						case '3':/*Recibo*/
											if (isset ($_POST['cancelar']))
											{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											exit;    
											}


												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Cliente'])==false or $_POST['Cliente']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe debe completar los datos del cliente con el boton COMPLETAR DATOS
														</div>';
														$insertar=false;
													}

													if (isset($_POST['Fecha'])==false or $_POST['Fecha']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar la fecha del recibo
														</div>';
														$insertar=false;
													}

													if ($_POST['Lugarpago']==2 and $_POST['Autoriza']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar el codigo del cobrador de esta factura
														</div>';
														$insertar=false;
													}



													if ($insertar==true)
													{

														$params[0]=$_POST['Factura'];
														$params[1]=$tipo;
														$params[2]=$_SESSION["idusuarios"];
														$params[3]=$_SESSION["idBodega"];
														$params[4]=null;/*Codigo_bodega_ent*/
														$params[5]=null;/*Codigo_vale*/
														$params[6]=null;/*Codigo_devo*/
														$params[7]=null;/*Codigo_PROVEEDOR*/
														$params[8]=null;/*Codigo_CREDITOFISCAL*/
														$params[9]=$_POST['Cliente'];
														$params[10]=null;
														$params[11]=null;/*Codigo_MOTIVO*/
														$params[12]=$_POST['Autoriza'];
														$params[13]=$_POST['Lugarpago'];
														$params[14]=$_POST['Fecha'];
														$params[15]=$_POST['Descuento'];

														$_SESSION['factura']=$params[0];
														$_SESSION['tipo']=$params[1];
														$_SESSION['idusuarios']=$params[2];
														$_SESSION['idbodega']=$params[3];
														$_SESSION['cliente']=$params[9];
														$_SESSION['autoriza']=$params[12];
														$_SESSION['lugarpago']=$params[13];
														$fecha50=$params[14];
														$_SESSION['descuento']=$params[15];
						
														$_SESSION['parametros']=$params;

                                                                                                                $bodega=$_SESSION['idbodega'];
                                                                                                                $fecha1=$_POST['Fecha'];
														$autoriza=$_POST['Autoriza'];
														$lugarpago=$_POST['Lugarpago'];
														$descuento=$_POST['Descuento'];
														$idusuarios=$_SESSION['idusuarios'];
                                                                                                                $tipo='3';
														$xcliente=$_POST['Cliente'];
														$a="RECIBOS";
														$sentencia3="select numero from correla2 where agencia='".$bodega."' and codigo='".$a."'";
														$resultado3 = mysql_query($sentencia3);
														$registroc=mysql_fetch_array($resultado3);
														$factura=$registroc["numero"]+1;
														$a="RECIBOS";
														$sentencia3="update correla2 set numero=$factura where agencia='".$bodega."' and codigo='".$a."'";
														$resultado3=mysql_query($sentencia3);
														//Validando si existe la factura
														 $existe=log_validar_factura($factura,$tipo,$fecha1,$bodega);
														if ($existe==1)
														{
															echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
															El numero de recibo que intenta ingresar ya existe, no puede continuar														
															</div>';
															echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
															exit;    

														}
														else
														{
														$resultado=log_insertar_factura($factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
														echo '  <META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalle.php?lafecha='.$fecha1.'&codc='.$xcliente.'&factu='.$factura.'">';
														}


													}										
												}

									if (isset ($_POST['confirmar1']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];
									}
									if (isset ($_POST['confirmar2']))
									{
                                                                         $xxcliente=$_POST["Cliente"];
                                                                         $tipo='3';
									 $losdatos=log_obtener_datos_cliente($xxcliente,$bodx);
									 $registrocli=mysql_fetch_array($losdatos);
									 $nmuni=$registrocli["nmuni"];
									 $ncan=$registrocli["ncan"];
									 $nbar=$registrocli["nbar"];
									 $ncase=$registrocli["ncase"];
									 $calle=$registrocli["calle"];
									 $ave=$registrocli["ave"];
									 $pasaje=$registrocli["pasaje"];
									 $poligono=$registrocli["poligono"];
									 $blocke=$registrocli["blocke"];
									 $casa=$registrocli["casa"];
                                                                         $direccion=$nmuni.",".$ncan.",".$nbar.",".$ncase.",C.:".$calle.",Ave.:".$ave.",Pje.:".$pasaje.",Pol.:".$poligono.",Block:".$blocke.",#:".$casa;
									$fe1=$registrocli['Fechai'];                                                                        
									$fe2=date('Y/m/d');
									$fechainicial = new DateTime($fe1);
									$fechafinal = new DateTime($fe2);
									$diferencia = $fechainicial->diff($fechafinal);
									$meseshastahoy = ( $diferencia->y * 12 ) + $diferencia->m;
                                                                         $diferencia=$registrocli['numeperi']-$meseshastahoy;
									 if ($diferencia<=2)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene menos de dos meses para caducar su contrato 														</div>';
										$insertar=false;
									  }

									 if ($diferencia<=0)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene un contrato vencido, dar atencion al cliente 														</div>';
										$insertar=false;
									  }

									}

									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<h3>Recibo</h3>
									</tr>


									 <tr>
									 <td>Buscar cliente por codigo o apellidos </td>
									 </tr>
									 <tr>
									 <td>(Si no especifica criterio de busqueda obtendrá la lista de todos los clientes)</td>
									 </tr>

									<tr>
									 <td><input type="text" class="frm_txt_long" name="Codcliente" value="'.(isset($_POST['Codcliente'])?$_POST['Codcliente']:'').'" /></td>

 									<td colspan="2" align="center">
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';

								
									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

									<tr>
									<td>Lista de clientes según busqueda realizada:</td>
									<td>
									<select name="Cliente" class="frm_cmb_long" />
									<option value="">Seleccione un Cliente...</option>';
									require_once("./logica/log_idenpaci.php");
									$resultado=log_obtener_idenpaci_cmb_actitec($bodx,$hcodclie);
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Cliente"]))
									  {
									  if ($_POST["Cliente"]==$fila['Codigo'])
									   {
                                                                            $xxcliente=$fila['Codigo'];
									    echo '<option value="'.$fila['Codigo'].'" selected="selected">'.$fila['Nombre'].'</option>';
									   }
									   else
									   {
									    echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
									   }
									  }
									  else
									  {
									  echo "<option value='".$fila['Codigo']."'>".$fila['Codigo']."&nbsp".$fila['Nombre']."&nbsp".$fila['Apellido']."</option>";
									  }
									 }
									 echo'
									 </td>	
 									<td colspan="2" align="center">
									<input  type="submit" value="Completar Datos" class="frm_btn" name="confirmar2"/>
									</td>
									</tr>
									</table>
									</form>';




									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >


									<tr>
									<td>Codigo de cliente:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Cliente"  value="'.$xxcliente.'"  /></td>
									</tr>

							                <tr>
							                <td width="45%">
							                <p style="line-height: 100%">Direccion:</td>
							                <td width="45%">
							                <p style="line-height: 150%">
							                <textarea rows="4" name="Direccion" cols="80">'.$direccion.'</textarea></td>

									<input type="text" class="frm_txt" name="Factura"  hidden="hidden" value="'.(isset($_POST['Factura'])?$_POST['Factura']:'').'"  />
									<tr>


									<tr>
									<td>Fecha:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fecha" value="'.$fechahoy.'"/></td>
									</tr>

									<tr>
									<td>Lugar de pago:</td>
									<td>
										<select name="Lugarpago" class="frm_cmb">
											<option value="1" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==1?' selected="selected" ':''):'').'>Oficina</option>
											<option value="2" '.(isset($_POST['Lugarpago'])?($_POST['Lugarpago']==2?' selected="selected" ':''):'').'>Cobrador</option>
										</select>
									</td>
									</tr>

												

									<tr>
									<td>Persona que recibio el pago:</td>
									<td>
										<select name="Autoriza" class="frm_cmb" />
										<option value="">Seleccione un vendedor de la tabla...</option>';
										require_once("./logica/log_vendedores.php");
										$resultado=log_obtener_vendedores_cmb($bodx);
										while ( $fila = mysql_fetch_array($resultado))
										{
											if (isset($_POST["Autoriza"]))
											{
												if ($_POST["Autoriza"]==$fila['Codigo'])
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
									echo'</td>
									</tr>
									<tr>


									<tr>
									<td>Descuento aplicado a toda la factura:</td>
									<td><input type="text" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
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
									break;




											default:
												echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';
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