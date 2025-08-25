<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Agregar Detalle de Factura de Servicios</title>
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
		$('#Fechat').datepicker({
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
							<h3 class="title">Agregar Detalle de factura </a></h3>
							<div class="entry">
								<?php
									require_once("./utils/validar_datos.php");
									require_once("logica/log_facturas.php");
									//$Encabezado=$_SESSION['parametros'];

			$factura=$_GET['factu'];
                        $fecha1=$_GET['lafecha'];
                        $cliente=$_GET['codc'];
			$tipo=$_SESSION['tipo'];
			$bodega=$_GET['bod'];



                                   if (isset ($_GET['lafecha']))
                                    {
                                     $fecha1=$_GET['lafecha'];
                                     $fecha50=$_GET['lafecha'];
                                    }




                                   //if (isset ($_GET['lafecha']))
                                   // {
                                   //  $fecha11=$_GET['lafecha'];
                                   //  $_session['estafecha']=$fecha11;
				   //  $fecha50=$_session['estafecha'];
                                   //  $ffecha=$fecha50;
                                   // }
                                   // else
                                   // {
				   //  $fecha50=$fecha11;
                                   // }

                                    
                                                                         

									//$fecha12=$_SESSION['fecha'];
									$xcliente=$_SESSION['cliente'];
									$autoriza=$_SESSION['autoriza'];
									$lugarpago=$_SESSION['lugarpago'];
									$descuento=$_SESSION['descuento'];
									$idusuarios=$_SESSION['idusuarios'];

									//$factura=$Encabezado['0'];
									//$tipo=$Encabezado['1'];
									//$bodega=$Encabezado['3'];
									//$xcliente=$Encabezado['9'];
									//$fecha12=$Encabezado['14'];


								        $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
								        //$fecha2=substr($fecha1,8,2)."-".substr($fecha1,5,2)."-".substr($fecha1,0,4);
    									$hpartida="";
    									$hsubpartida="";
    									$hsubpartida_a="";
									$xtipomaterial="";
									$preciou=0;
									$valoruno=1;
                                                                        $valormaximo=0;

	

									
									$insertar=true;

									if (isset ($_POST['cancelar']))
									{
										$lafactura=$_SESSION['facturamem'];
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalle.php?lafecha='.$fecha1.'&codc='.$xcliente.'&factu='.$lafactura.'">';    
										exit;    
									}
									
										if (isset ($_POST['aceptar']))
										{
											if(($_POST['Servicio']!=1 and $_POST['Servicio']!=16 and $_POST['Servicio']!=8 and $_POST['Servicio']!=7 and $_POST['Servicio']!=20 and $_POST['Servicio']!=11)  and $_POST['Fechat']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												No puede dejar en blanco la fecha de visita al cliente.
												</div>';
												$insertar=false;
											}




											if (isset($_POST['Servicio'])==false or $_POST['Servicio']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												Debe seleccionar el servicio que el cliente esta pagando y dar click en el boton CREAR CONCEPTO.
												</div>';
												$insertar=false;
											}

											if (isset($_POST['Concepto'])==false or $_POST['Concepto']=="")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												El dato de CONCEPTO no puede estar en blanco
												</div>';
												$insertar=false;
											}

											if ($_POST['Concepto']=="Error en periodo de pago mensual, revise programacion de pagos")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												Este concepto de pago no puede ser ingresado
												</div>';
												$insertar=false;
											}



											if($_POST['Servicio']==20)
											{
                                                                            			 $valormaximo=0;
  		  							     			 require_once("logica/log_facturas.php");
 									     			 $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     			 $regis1=mysql_fetch_array($tabla1);
                                                                                                 $valormaximo=$regis1['morahoy'];
												 if($_POST['Preciou']>=$valormaximo)
												  {
 												   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												   La mora de ese cliente es menor o igual al valor que desea abonar
												   </div>';
												   $insertar=false;
												  }
											}

											if($_POST['Servicio']==12)
											{
                                                                            			 $valormaximo=0;
  		  							     			 require_once("logica/log_facturas.php");
 									     			 $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     			 $regis1=mysql_fetch_array($tabla1);
                                                                                                 $valormaximo=$regis1['morahoy'];
												 if($_POST['Preciou']>$valormaximo)
												  {
 												   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												   El cliente tiene una mora menor a la que esta ingresando a esta factura
												   </div>';
												   $insertar=false;
												  }
											}

											
											if ($insertar==true)
											{
													//if (log_validar_factura($factura,$tipo,$fecha1,$bodega)==0)
													//{
													//	log_insertar_factura($factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													//}
													$lafactura=$_SESSION['facturamem'];
													$resulatado=log_insertar_facturas_detalle($_POST,$lafactura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													
													if ($resulatado==1)
													{
														echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
														Registro ingresado correctamente.
														</div>';
														unset($_POST); 

														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas_detalle.php?lafecha='.$fecha1.'&codc='.$xcliente.'&factu='.$lafactura.'">';    
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

									if (isset ($_POST['confirmar1']))
									{
                                                                          $servicio=$_POST['Servicio'];
									  $valormaximo=0;
	                                                                  if($_POST['Servicio']==1)   //pago de cuota
									   {
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
                                                                            $abonos=0;
								            $cuota=0;
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
									    $cuota=$regis1['valorplan'];
									    $estatus=$regis1['estatus'];
									    $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									    $regis2=mysql_fetch_array($tabla2);
 									    $f1=$regis2['fechaini'];
 									    $f2=$regis2['fechafin'];

									    $mespaga=intval(substr($f1,5,2));
if($mespaga==1)
{$nmespaga='Enero'.' '.substr($f1,0,4);}
if($mespaga==2)
{$nmespaga='Febrero'.' '.substr($f1,0,4);}
if($mespaga==3)
{$nmespaga='Marzo'.' '.substr($f1,0,4);}
if($mespaga==4)
{$nmespaga='Abril'.' '.substr($f1,0,4);}
if($mespaga==5)
{$nmespaga='Mayo'.' '.substr($f1,0,4);}
if($mespaga==6)
{$nmespaga='Junio'.' '.substr($f1,0,4);}
if($mespaga==7)
{$nmespaga='Julio'.' '.substr($f1,0,4);}
if($mespaga==8)
{$nmespaga='Agosto'.' '.substr($f1,0,4);}
if($mespaga==9)
{$nmespaga='Septiembre'.' '.substr($f1,0,4);}
if($mespaga==10)
{$nmespaga='Octubre'.' '.substr($f1,0,4);}
if($mespaga==11)
{$nmespaga='Noviembre'.' '.substr($f1,0,4);}
if($mespaga==12)
{$nmespaga='Diciembre'.' '.substr($f1,0,4);}
									    $f1x=substr($f1,8,2)."-".substr($f1,5,2)."-".substr($f1,0,4);
									    $f2x=substr($f2,8,2)."-".substr($f2,5,2)."-".substr($f2,0,4);
									    $abonos=$regis2['abonos'];
									    $apagar=$cuota-$abonos;
									    if($abonos>0)
									     {
									      $concepto="Cuota Mes:".$nmespaga." (-)abono de:".$abonos;
									     }
									     else
									     {
									      $concepto="Cuota Mes:".$nmespaga;
									     }
									    if(empty($f1))
									     {
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, revise en programacion de pagos";
									     }
									    if($estatus==0)
									     {
									    	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
									    	El cliente esta desconectado, no puede entrar este pago
									    	</div>';
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, consulte con el administrador del sistema";
									     }

									   }

	                                                                  if($_POST['Servicio']==16)   //pago de cuota gratis
									   {
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
                                                                            $abonos=0;
								            $cuota=0;
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
									    $estatus=$regis1['estatus'];
									    $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									    $regis2=mysql_fetch_array($tabla2);
 									    $f1=$regis2['fechaini'];
 									    $f2=$regis2['fechafin'];

									    $mespaga=intval(substr($f1,5,2));
if($mespaga==1)
{$nmespaga='Enero'.' '.substr($f1,0,4);}
if($mespaga==2)
{$nmespaga='Febrero'.' '.substr($f1,0,4);}
if($mespaga==3)
{$nmespaga='Marzo'.' '.substr($f1,0,4);}
if($mespaga==4)
{$nmespaga='Abril'.' '.substr($f1,0,4);}
if($mespaga==5)
{$nmespaga='Mayo'.' '.substr($f1,0,4);}
if($mespaga==6)
{$nmespaga='Junio'.' '.substr($f1,0,4);}
if($mespaga==7)
{$nmespaga='Julio'.' '.substr($f1,0,4);}
if($mespaga==8)
{$nmespaga='Agosto'.' '.substr($f1,0,4);}
if($mespaga==9)
{$nmespaga='Septiembre'.' '.substr($f1,0,4);}
if($mespaga==10)
{$nmespaga='Octubre'.' '.substr($f1,0,4);}
if($mespaga==11)
{$nmespaga='Noviembre'.' '.substr($f1,0,4);}
if($mespaga==12)
{$nmespaga='Diciembre'.' '.substr($f1,0,4);}
									    $f1x=substr($f1,8,2)."-".substr($f1,5,2)."-".substr($f1,0,4);
									    $f2x=substr($f2,8,2)."-".substr($f2,5,2)."-".substr($f2,0,4);
									    $abonos=$regis2['abonos'];
									    $apagar=$cuota-$abonos;

									    if($abonos>0)
									     {
									      $conceptog="Mes Gratis:".$nmespaga." (-)abono de:".$abonos;
									     }
									     else
									     {
									      $conceptog="Mes Gratis:".$nmespaga;
									     }
									    if(empty($f1))
									     {
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, revise en programacion de pagos";
									     }
									    if($estatus==0)
									     {
									    	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
									    	El cliente esta desconectado, no puede entrar este pago
									    	</div>';
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, consulte con el administrador del sistema";
									     }

									   }

	                                                                  if($_POST['Servicio']==12)  //pago de mora completa con reconexion
									   {
                                                                            $mora=0;
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
                                                                            $mora=$regis1['morahoy'];
									    $apagar=$mora;
									    $valormaximo=$mora;
									    $concepto="Pago de mora con reconexion";

									   }
	                                                                  if($_POST['Servicio']==8)  //pago por dias de servicio
									   {
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
									    $cuota=$regis1['valorplan'];
									    $estatus=$regis1['estatus'];
									    $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									    $regis2=mysql_fetch_array($tabla2);
 									    $f1=$regis2['fechaini'];
 									    $f2=$regis2['fechafin'];
                                                                            $xanio1=substr($f1,0,4);
									    $xmes1=substr($f1,5,2);
									    $xdia1=substr($f1,8,2);
                                                                            $xanio2=substr($f2,0,4);
									    $xmes2=substr($f2,5,2);
									    $xdia2=substr($f2,8,2);
   									    $timestamp1 = mktime(0,0,0,$xmes1,$xdia1,$xanio1); 
   									    $timestamp2 = mktime(0,0,0,$xmes2,$xdia2,$xanio2); 
									    $segundos_diferencia = $timestamp1 - $timestamp2;
									    $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
									    $dias_diferencia = abs($dias_diferencia);
									    $dias_diferencia = floor($dias_diferencia);
									    $apagar=(($cuota/30)*$dias_diferencia);
									    $concepto="Pago por:".$dias_diferencia." dias de servicio";
									    if($estatus==0)
									     {
										echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
										El cliente esta desconectado, no puede entrar este pago
										</div>';
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, revise en programacion de pagos";
									     }

									   }
	                                                                   if($_POST['Servicio']==7)  //pago por abono a cuota
									    {
  		  							     require_once("logica/log_facturas.php");
 									     $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     $regis1=mysql_fetch_array($tabla1);
                                                                             $cuota=$regis1['valorplan'];
									     $estatus=$regis1['estatus'];
									     $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									     $regis2=mysql_fetch_array($tabla2);
                                                                             $abonos=$regis2['abonos'];
                                                                             $valormaximo=$cuota-$abonos;
									    if($estatus==0)
									     {
										echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
										El cliente esta desconectado, no puede entrar este pago
										</div>';
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, revise en programacion de pagos";
									     }

									    }

	                                                                   if($_POST['Servicio']==20)  //pago por abono a mora
									    {
                                                                             $valormaximo=0;
  		  							     require_once("logica/log_facturas.php");
 									     $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     $regis1=mysql_fetch_array($tabla1);
                                                                             $valormaximo=$regis1['morahoy'];
									    }
  									  if($_POST['Servicio']!=1 and $_POST['Servicio']!=8 and $_POST['Servicio']!=12)
								           {
  		  							     require_once("logica/log_servicios.php");
 									     $tabla1=log_obtener_servicio($_POST['Servicio']);
									     $regis1=mysql_fetch_array($tabla1);
                                                                             $valormaximo=$regis1['Costo'];
									     $concepto=$regis1['Nombre'];;
									   }

									}
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>



									<td>Servicio a pagar:</td>
									<td>
									<select name="Servicio" class="frm_cmb_long" />
									<option value="">Seleccione un servicio...</option>';
									require_once("./logica/log_servicios.php");
									$resultado=log_obtener_servicios_cmb();
									while ( $fila = mysql_fetch_array($resultado))
									{
									 if (isset($_POST["Servicio"]))
									  {
									  if ($_POST["Servicio"]==$fila['Codigo'])
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
									<input  type="submit" value="Crear concepto" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';

if($_POST['Servicio']==1)   //pago de cuota mensual
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'">';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>


										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>
										


										<td><input type="text" class="frm_txt" hidden="hidden" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
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
 }

if($_POST['Servicio']==16)   //pago de cuota mensual gratis
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'">';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>


										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$conceptog.'" /></td>
										</tr>
										


										<td><input type="text" class="frm_txt" hidden="hidden" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
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
 }

if($_POST['Servicio']==12)    //pago de mora con reconexion
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>



										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>

										

										<tr>
										<td>Programar reconexion en fecha:</td>
										<td><input type="text" class="frm_txt" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
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
 }
if($_POST['Servicio']==8)     //pago por dias de servicio
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>

										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" readonly="readonly" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>


										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
							
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
 }

if($_POST['Servicio']==7)     //abono a cuota
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>

										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>


										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
							
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
 }
if($_POST['Servicio']==20)     //abono a mora
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>

										<tr>
										<td>Valor maximo:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>


										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
							
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
 }

if($_POST['Servicio']==11)     //complementos
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>



										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$valormaximo.'" /></td>
										</tr>

										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'"  /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										

										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										
							
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
 }

if($_POST['Servicio']!=1 and $_POST['Servicio']!=8 and $_POST['Servicio']!=12 and $_POST['Servicio']!=7 and $_POST['Servicio']!=20 and $_POST['Servicio']!=11 and $_POST['Servicio']!=16)
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Factura" value="'.$factura.'" /></td>


										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$valormaximo.'" /></td>
										</tr>

										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'"  /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										
										<tr>
										<td>Programar visita en fecha:</td>
										<td><input type="text" class="frm_txt" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
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
