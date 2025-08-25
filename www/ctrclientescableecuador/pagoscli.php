<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>CTRLCLIENTESCABLE- Registrar pagos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>


<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#Fechai').datepicker({
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
							<h3 class="title">Ingreso de Pago del Cliente</a></h3>
							<div class="entry">
								<?php
									$bodx=$_SESSION["idBodega"];
									require_once("logica/log_idenpaci.php");
									$tabla=log_obtener_idenpaci2($_GET["id"],$bodx);
									$registro=mysql_fetch_array($tabla);
									$insertar=true;


												if (isset ($_POST['guardar']))
												{
													$insertar=true;
													if (isset($_POST['Factura'])==false or $_POST['Factura']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar en numero de recibo
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
														$_POST['Fecha']=date('d/m/Y');
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
														El recibo que intenta ingresar ya existe, no puede continuar														</div>';
														$insertar=false;
													}



											if($_POST['Servicio']==999)
											{
								                         $xcliente=$_POST["Cliente"];
   		  							     		  require_once("logica/log_facturas.php");
 									     		  $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     	          $regis1=mysql_fetch_array($tabla1);
									                  $estatus=$regis1['estatus'];
											  if($estatus==1)
											  {
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												El cliente ya tiene el servicio conectado, no puede cobrarsele instalacion.
												</div>';
												$insertar=false;
                                                                                             
											  }
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

											if ($_POST['Concepto']=="Error en periodo de pago mensual, consulte con el administrador del sistema")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												Este concepto de pago no puede ser ingresado
												</div>';
												$insertar=false;
											}



											if($_POST['Servicio']==20)
											{
                                                                            			 $valormaximo=0;
									                         $xcliente=$_POST["Cliente"];
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
		     									         $xcliente=$_POST["Cliente"];
  		  							     			 require_once("logica/log_facturas.php");
 									     			 $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     			 $regis1=mysql_fetch_array($tabla1);
                                                                                                 $valormaximo=$regis1['morahoy'];
												 if($_POST['Preciou']<$valormaximo)
												  {
 												   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												   El cliente tiene una mora MAYOR al pago que esta ingresando a esta factura
												   </div>';
												   $insertar=false;
												  }
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
														$factura=$_POST['Factura'];
														$tipo=$_SESSION['tipo'];
														$fecha1=$_POST['Fecha'];
														$bodega=$_SESSION['idbodega'];
														$xcliente=$_SESSION['cliente'];
														$autoriza=$_SESSION['autoriza'];
														$lugarpago=$_SESSION['lugarpago'];
														$descuento=$_SESSION['descuento'];
														$idusuarios=$_SESSION['idusuarios'];

													if (log_validar_factura($factura,$tipo,$fecha1,$bodega)==0)
													{
														log_insertar_factura($factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													}

													$resulatado=log_insertar_facturas_detalle($_POST,$factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													
													if ($resulatado==1)
													{

//Actualizando el monto de lo cobrado por el usuario autenticado en sesion
								     $elusuario=$_SESSION['idusuarios'];
 	  							     require_once("logica/log_facturas.php");
								     $tabla3=log_obtener2_ventausuario($elusuario,$bodega,$fecha1);
								     $regis3=mysql_fetch_array($tabla3);
                                                                     $montousuario=$regis3['ventas']+$_POST["Preciou"];
								     $tabla4=log_aumentar_ventausuario($elusuario,$montousuario,$bodega,$fecha1);
								     $regis4=mysql_fetch_array($tabla4);
								     $ventashoy=$regis4['ventas'];
//fin de control de ventas


														unset($_POST); 

														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    

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


								if (isset ($_POST['cancelar']))
											{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											exit;    
											}
                                                                        $estafecha=date('d/m/Y');



												if (isset ($_POST['aceptar']))
												{
													$insertar=true;
													if (isset($_POST['Factura'])==false or $_POST['Factura']=="")
													{
														echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
														Debe ingresar en numero de recibo
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
														$_POST['Fecha']=date('d/m/Y');
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
														El recibo que intenta ingresar ya existe, no puede continuar														</div>';
														$insertar=false;
													}



											if($_POST['Servicio']==999)
											{
								                         $xcliente=$_POST["Cliente"];
   		  							     		  require_once("logica/log_facturas.php");
 									     		  $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     	          $regis1=mysql_fetch_array($tabla1);
									                  $estatus=$regis1['estatus'];
											  if($estatus==1)
											  {
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												El cliente ya tiene el servicio conectado, no puede cobrarsele instalacion.
												</div>';
												$insertar=false;
                                                                                             
											  }
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

											if ($_POST['Concepto']=="Error en periodo de pago mensual, consulte con el administrador del sistema")
											{
												echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												Este concepto de pago no puede ser ingresado
												</div>';
												$insertar=false;
											}



											if($_POST['Servicio']==20)
											{
                                                                            			 $valormaximo=0;
									                         $xcliente=$_POST["Cliente"];
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
		     									         $xcliente=$_POST["Cliente"];
  		  							     			 require_once("logica/log_facturas.php");
 									     			 $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									     			 $regis1=mysql_fetch_array($tabla1);
                                                                                                 $valormaximo=$regis1['morahoy'];
												 if($_POST['Preciou']<$valormaximo)
												  {
 												   echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
												   El cliente tiene una mora MAYOR al pago que esta ingresando a esta factura
												   </div>';
												   $insertar=false;
												  }
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
														$factura=$_POST['Factura'];
														$tipo=$_SESSION['tipo'];
														$fecha1=$_POST['Fecha'];
														$bodega=$_SESSION['idbodega'];
														$xcliente=$_SESSION['cliente'];
														$autoriza=$_SESSION['autoriza'];
														$lugarpago=$_SESSION['lugarpago'];
														$descuento=$_SESSION['descuento'];
														$idusuarios=$_SESSION['idusuarios'];

													if (log_validar_factura($factura,$tipo,$fecha1,$bodega)==0)
													{
														log_insertar_factura($factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													}

													$resulatado=log_insertar_facturas_detalle($_POST,$factura,$tipo,$fecha1,$bodega,$xcliente,$autoriza,$lugarpago,$descuento,$idusuarios);
													
													if ($resulatado==1)
 													{


if($bodega=="100")
{
$xycliente=$xcliente;  
$losdatos1=log_obtener_datos_cliente($xycliente,$bodega);
$registrocli1=mysql_fetch_array($losdatos1);
$totalrecibo=$_POST["Preciou"];
$fechahora=date("j/n/Y")." ".date("h:i:s");
$xnombrecli=$registrocli1["nombre"];
$xapellidocli=$registrocli1["apellido"];
$xndep=$registrocli1["ndep"];
$nmuni=$registrocli1["nmuni"];

$nombre_impresora = "EPSON TM-T20II Receipt"; 
 
 
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
 
/*
	Imprimimos un mensaje. Podemos usar
	el salto de línea o llamar muchas
	veces a $printer->text()
*/
//$printer->text("Hola mundo\nParzibyte.me");



$printer->text("       TELECABLE Z-PAZ"."\n"); 
$printer->text("GRUPO CORPORATIVO ZUNUN PAZ S.A."."\n"); 
$printer->text("       RFC: GCZ140925GG5"."\n"); 
$printer->text("TELEFONO OFICINA   964 62 42 937"."\n"); 
$printer->text("    AV. MORELOS SIN NUMERO"."\n"); 
$printer->text("         TUZANTAN, CHIAPAS"."\n"); 
$printer->text("Recibo: ".$factura."\n");
$printer->text("Fecha y Hora: ".$fechahora."\n"); 
$printer->text("Usuario:"."\n"); 
$printer->text($xnombrecli." ".$xapellidocli."\n");
$printer->text($nmuni." ".$xndep."\n"); 
$printer->text("Concepto                   Precio"."\n"); 
$printer->text(substr($_POST["Concepto"],0,25)."     ".$_POST["Preciou"]."\n");
$printer->text(substr($_POST["Concepto"],26,25)."\n");
$printer->text(substr($_POST["Concepto"],51,25)."\n"); 
$printer->text(substr($_POST["Concepto"],76,19)."\n"); 
$printer->text($_POST["Fechaiii"]."\n"); 
$printer->text("                   TOTAL: ".$totalrecibo."\n"); 
$printer->text("  TE INVITAMOS A PAGAR A TIEMPO"."\n"); 
$printer->text("      GRACIAS POR SU PAGO"."\n"); 
$printer->text("  ESTE RECIBO SERA INCLUIDO EN"."\n"); 
$printer->text("        LA FACTURA GLOBAL"."\n"); 



/*
	Hacemos que el papel salga. Es como 
	dejar muchos saltos de línea sin escribir nada
*/
$printer->feed();
 
/*

	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();
 
/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();
 
/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();

//Imprimiendo el mismo recibo de nuevo
$printer->text("       TELECABLE Z-PAZ"."\n"); 
$printer->text("GRUPO CORPORATIVO ZUNUN PAZ S.A."."\n"); 
$printer->text("       RFC: GCZ140925GG5"."\n"); 
$printer->text("TELEFONO OFICINA   964 62 42 937"."\n"); 
$printer->text("    AV. MORELOS SIN NUMERO"."\n"); 
$printer->text("         TUZANTAN, CHIAPAS"."\n"); 
$printer->text("Recibo: ".$factura."\n");
$printer->text("Fecha y Hora: ".$fechahora."\n"); 
$printer->text("Usuario:"."\n"); 
$printer->text($xnombrecli." ".$xapellidocli."\n");
$printer->text($nmuni." ".$xndep."\n"); 
$printer->text("Concepto                   Precio"."\n"); 
$printer->text(substr($_POST["Concepto"],0,25)."     ".$_POST["Preciou"]."\n");
$printer->text(substr($_POST["Concepto"],26,25)."\n");
$printer->text(substr($_POST["Concepto"],51,25)."\n"); 
$printer->text(substr($_POST["Concepto"],76,19)."\n"); 
$printer->text($_POST["Fechaiii"]."\n"); 
$printer->text("                   TOTAL: ".$totalrecibo."\n"); 
$printer->text("  TE INVITAMOS A PAGAR A TIEMPO"."\n"); 
$printer->text("      GRACIAS POR SU PAGO"."\n"); 
$printer->text("  ESTE RECIBO SERA INCLUIDO EN"."\n"); 
$printer->text("        LA FACTURA GLOBAL"."\n"); 

/*
	Hacemos que el papel salga. Es como 
	dejar muchos saltos de línea sin escribir nada
*/
$printer->feed();
 
/*

	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();
 
/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();
 
/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();


// fin de impresion de segundo recibo 

//Fin de seccion de si es oficina o $bodega=1
}

if($bodega=="1")
{
$xycliente=$xcliente;  
$losdatos1=log_obtener_datos_cliente($xycliente,$bodega);
$registrocli1=mysql_fetch_array($losdatos1);
$totalrecibo=$_POST["Preciou"];
$fechahora=date("j/n/Y")." ".date("h:i:s");
$xnombrecli=$registrocli1["nombre"];
$xapellidocli=$registrocli1["apellido"];
$xndep=$registrocli1["ndep"];
$nmuni=$registrocli1["nmuni"];
//$nombre_impresora = "\\UNO-PC\EPSON TM-T20II Receipt"; 

$tit1="CABLEOPERADORA X"; 
$tit2="GRUPO CORPORATIVO X";
$tit0="EMPRESA S.A."; 
$tit3="RFC: 999999"; 
$tit4="TEL. OFICINA   999999"; 
$tit5="AV. XXXXX"; 
$tit6="MUNICIPIO X, ESTADO X"; 
$tit7="Recibo: ".$factura;
$tit8="Fecha: ".$fechahora; 
$tit9="Usuario:"; 
$tit10=$xnombrecli." ".$xapellidocli;
$tit11=$nmuni." ".$xndep; 
$tit12="Concepto                   Precio"; 
$tit13=substr($_POST["Concepto"],0,25)."     ".$_POST["Preciou"];
$tit14=substr($_POST["Concepto"],26,25);
$tit15=substr($_POST["Concepto"],51,25); 
$tit16=substr($_POST["Concepto"],76,19); 
$tita=$_POST["Fechaiii"]; 
$tit17="                   TOTAL: ".$totalrecibo; 
$tit18="  TE INVITAMOS A PAGAR A TIEMPO"; 
$tit19="      GRACIAS POR SU PAGO"; 
$tit20="  EL RECIBO SERA INCLUIDO"; 
$tit21="     EN LA FACTURA GLOBAL"; 
$tit22=""; 


echo '
<!DOCTYPE html>
<html>
<head>
<script>
function imprimir() {
  window.print();
};
</script>

<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>
<body onload="imprimir()">
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit1.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit2.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit0.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit3.'</font></dt>
    <dt><FONT SIZE=2>'.$tit4.'</font></dt>
    <dt><FONT SIZE=1>&nbsp;&nbsp;&nbsp;'.$tit5.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit6.'</font></dt>
    <dt><FONT SIZE=2>'.$tit7.'</font></dt>
    <dt><FONT SIZE=2>'.$tit8.'</font></dt>
    <dt><FONT SIZE=2>'.$tit9.'</font></dt>
    <dt><FONT SIZE=2>'.$tit10.'</font></dt>
    <dt><FONT SIZE=2>'.$tit11.'</font></dt>
    <dt><FONT SIZE=2>'.$tit12.'</font></dt>
    <dt><FONT SIZE=1>'.$tit13.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16.'</font></dt>
    <dt><FONT SIZE=2>'.$tita.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit17.'</font></dt>
    <dt><FONT SIZE=1>'.$tit18.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;'.$tit19.'</font></dt>
    <dt><FONT SIZE=2>'.$tit20.'</font></dt>
    <dt><FONT SIZE=2>'.$tit21.'</font></dt>
    <dt><FONT SIZE=2>'.$tit22.'</font></dt>
<div style="page-break-before: always;"> </div>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit1.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit2.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit0.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit3.'</font></dt>
    <dt><FONT SIZE=2>'.$tit4.'</font></dt>
    <dt><FONT SIZE=1>&nbsp;&nbsp;&nbsp;'.$tit5.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit6.'</font></dt>
    <dt><FONT SIZE=2>'.$tit7.'</font></dt>
    <dt><FONT SIZE=2>'.$tit8.'</font></dt>
    <dt><FONT SIZE=2>'.$tit9.'</font></dt>
    <dt><FONT SIZE=2>'.$tit10.'</font></dt>
    <dt><FONT SIZE=2>'.$tit11.'</font></dt>
    <dt><FONT SIZE=2>'.$tit12.'</font></dt>
    <dt><FONT SIZE=1>'.$tit13.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16.'</font></dt>
    <dt><FONT SIZE=2>'.$tita.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit17.'</font></dt>
    <dt><FONT SIZE=1>'.$tit18.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;'.$tit19.'</font></dt>
    <dt><FONT SIZE=2>'.$tit20.'</font></dt>
    <dt><FONT SIZE=2>'.$tit21.'</font></dt>
    <dt><FONT SIZE=2>'.$tit22.'</font></dt>
<div style="page-break-before: always;"> </div>
</body>
</html>';



// <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
// <button class="oculto-impresion" onclick="javascript:history.back(1)">Volver</button>

//Fin de seccion de si es oficina o $bodega=2
}





//Codigo para trabajar con CODIGO DE BARRAS	
//	/* font management */
//	$barcode = printer_create_font("Free 3 of 9 Extended", 400, 200, PRINTER_FW_NORMAL, false, false, false, 0);
//	$arial = printer_create_font("Arial", 148, 76, PRINTER_FW_MEDIUM, false, false, false, 0);
//	
//	/* write the text to the print job */
//	printer_select_font($printer, $barcode);
	//printer_draw_text($printer, "*123456*", 50, 50);
	//printer_select_font($printer, $arial);
	//printer_draw_text($printer, "123456", 250, 500);
	
	/* font management */
//	printer_delete_font($barcode);
//	printer_delete_font($arial);
	
//	/* close the connection */
//	printer_end_page($printer);
//	printer_end_doc($printer);
//	printer_close($printer);


//Actualizando el monto de lo cobrado por el usuario autenticado en sesion
								     $elusuario=$_SESSION['idusuarios'];
 	  							     require_once("logica/log_facturas.php");
								     $tabla3=log_obtener2_ventausuario($elusuario,$bodega,$fecha1);
								     $regis3=mysql_fetch_array($tabla3);
                                                                     $montousuario=$regis3['ventas']+$_POST["Preciou"];
								     $tabla4=log_aumentar_ventausuario($elusuario,$montousuario,$bodega,$fecha1);
								     $regis4=mysql_fetch_array($tabla4);
								     $ventashoy=$regis4['ventas'];
//fin de control de ventas


														unset($_POST); 

														echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    

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




									if (isset ($_POST['confirmar0']))
									{
                                                                          $hcodclie=$_POST["Codcliente"];
									}


									if (isset ($_POST['confirmar1']))
									{
									  $hcodclie=$_POST["Codcliente"];
									  $xcliente=$_POST["Codcliente"];
									  $xcliente2=$_POST["Cliente"];
									  $bodega=$bodx;

//obteniendo un correlativo para codigo de ticket
$nummovi=0;
$codigomov="CLIENTES";
$sentencia="select numero id FROM correla2 where agencia='".$bodx."' and codigo='".$codigomov."'";
$resultado = mysql_query($sentencia);
  if(mysql_num_rows ( $resultado )!=0)
    {
	$fila=mysql_fetch_array($resultado);
	$nummovi=$fila['id']+1;
    }
	else
    {
     $nummovi=1;
    }

									 $emplerecibe=$_SESSION['nombre_usuario'];
                                   				         $xxcliente=$xcliente;  
//$_POST["Cliente"];
									 $losdatos=log_obtener_datos_cliente($xcliente2,$bodx);
								         $registrocli=mysql_fetch_array($losdatos);
$xnombrecli=$registrocli["nombre"];
$xapellidocli=$registrocli["apellido"];
$xndep=$registrocli["ndep"];
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
	 								 $otraref=$registrocli["otraref"];
                                                                         $direccion=$ncan.",".$nbar.",".$otraref;
									 $vcargoadic=$registrocli["cargoadic"];
                                                                         if($vcargoadic>0)
                                                                         {
	 								 $cargoadicional="+Cargo pendiente:".$registrocli["cargoadic"];
                                                                         }
									  else
                                                                         {
	 								 $cargoadicional="";
                                                                         }



									$fe1=$registrocli['fechai'];                                                                        
									$fe2=date('Y-m-d');
                                                                        $estafecha=date('d/m/Y');
                                                                        $estafecha2=date('d-m-Y');
									$fechainicial = new DateTime($fe1);
									$fechafinal = new DateTime($fe2);
$anio1=intval(substr($fe1,0,4));
$anio2=intval(substr($fe2,0,4));
$losanios=($anio2-$anio1)*12;

									$diferenciah = $fechainicial->diff($fechafinal);
                                                                        $meseshastahoy=$losanios+$diferenciah->m;
                                                                         $diferencia=$registrocli['numeperi']-$meseshastahoy;
									 if ($diferencia<=2 and $diferencia>0)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene menos de dos meses para caducar su contrato 
										</div>'. "Van ".$meseshastahoy. " Meses de servicio" ;
                                                                                 
									  }

									 if ($diferencia<=0)
									  {
										echo '<div style="background:url(imagenes/msg_yelow.png) no-repeat; padding:10px 10px 10px 10px; Color:#000000;">
										Alerta: el cliente tiene un contrato vencido, dar atencion al cliente 
 										</div>'."Van ".$meseshastahoy. " Meses de servicio" ;
									  }
//Verificando el monto de lo cobrado por el usuario autenticado en sesion
								     $elusuario=$_SESSION['idusuarios'];
                                                                     $bodega=$bodx;
                                                                     $fecha1=$estafecha2;
 	  							     require_once("logica/log_facturas.php");
								     $tabla3=log_obtener2_ventausuario($elusuario,$bodega,$fecha1);
								     $regis3=mysql_fetch_array($tabla3);
                                                                     $montoabre=$regis3['montoabre'];
                                                                     $montousuario=$regis3['ventas'];
								     if(($montousuario+$montoabre)>=3000)
								     {
									unset($_POST); 
									echo '<META HTTP-EQUIV="Refresh" Content="0; URL=envia_email2.php">';    
								     }
								    if(($montousuario+$montoabre)>=2600)
								     {
									echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#FFFFFF;">
									Es necesario hacer corte de caja, hagalo despues de ingresar este registro
									</div>';
								     }
//fin de control de ventas


                                                                          $servicio=$_POST['Servicio'];
									  $valormaximo=0;
								          $delmesx=" ";
	                                                                  if($_POST['Servicio']==1)   //pago de cuota
									   {
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
									    $xcliente=$_POST["Cliente"];
								            $fechadehoy=$_POST["Fecha"];
                                                                            $abonos=0;
								            $cuota=0;
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodx,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
									    $estatus=$regis1['estatus'];
									    $cuotafija=$regis1['valorplan'];
                                                                            $ultimopago=$regis1['ulfepago2'];
									    $elplan=$regis1['ttplan'];
									    $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									    $regis2=mysql_fetch_array($tabla2);
 									    $f1=$regis2['fechaini'];
 									    $f2=$regis2['fechafin'];
									    $f1x=substr($f1,8,2)."-".substr($f1,5,2)."-".substr($f1,0,4);
									    $f2x=substr($f2,8,2)."-".substr($f2,5,2)."-".substr($f2,0,4);
									    $estafecha=$fechadehoy;
                                                                            $nmespago=intval(substr($f1,5,2));
if($nmespago==1)                                                 
{
 $delmesx="Mes:Enero";
}
if($nmespago==2)                                                 
{
 $delmesx="Mes:Febrero";
}
if($nmespago==3)                                                 
{
 $delmesx="Mes:Marzo";
}
if($nmespago==4)                                                 
{
 $delmesx="Mes:Abril";
}
if($nmespago==5)                                                 
{
 $delmesx="Mes:Mayo";
}
if($nmespago==6)                                                 
{
 $delmesx="Mes:Junio";
}
if($nmespago==7)                                                 
{
 $delmesx="Mes:Julio";
}
if($nmespago==8)                                                 
{
 $delmesx="Mes:Agosto";
}
if($nmespago==9)                                                 
{
 $delmesx="Mes:Septiembre";
}
if($nmespago==10)                                                 
{
 $delmesx="Mes:Octubre";
}
if($nmespago==11)                                                 
{
 $delmesx="Mes:Noviembre";
}
if($nmespago==12)                                                 
{
 $delmesx="Mes:Diciembre";
}


                                                                            //politicas aplicadas a cuotas de cable basico unicamente
                                                                            if($elplan=="0100O1OO121")
                                                                            {
                                                                            if((substr($fechadehoy,0,2)=="01" or substr($fechadehoy,0,2)=="02") and (substr($f1,5,2)==substr($fechadehoy,3,2))) 
									     {
                                                                            //pago de 150 si paga el 1 o 2 del mes, del mismo mes en curso que la fecha limite inferior del periodo
                                                                              $cuota=$cuotafija-50;
								             }	
                                                                            if((substr($fechadehoy,0,2)!="01" and substr($fechadehoy,0,2)!="02") and (substr($f1,5,2)==substr($fechadehoy,3,2))) 
									     {
                                                                            //pago de 200 si paga cualquier dia del mes pero es del mismo mes en curso que la fecha limite inferior del periodo
                                                                               $cuota=$cuotafija;
								             }	
                                                                           if(intval(substr($fechadehoy,3,2))>intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))==intval(substr($f1,0,4))) 
									     {
									    //paga 230 si el mes de pago es mayor al mes de fecha inicial del periodo, 
                                                                               $cuota=$cuotafija+30;
								             }	
                                                                           if(intval(substr($fechadehoy,3,2))<intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))>intval(substr($f1,0,4))) 
									     {
									    //paga 230 si el mes de pago es menor al mes de fecha inicial del periodo pero el anio de pago es mayor 
                                                                               $cuota=$cuotafija+30;
								             }	

                                                                           if(intval(substr($fechadehoy,3,2))<intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))==intval(substr($f1,0,4)) ) 
									     {
									    //paga 150 si el mes de pago es menor al mes de fecha inicial del periodo, 
                                                                               $cuota=$cuotafija-50;
								             }	
                                                                           if(intval(substr($fechadehoy,3,2))>=intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))<intval(substr($f1,0,4)) ) 
									     {
									    //paga 150 si el mes de pago es mayor al mes de fecha inicial del periodo pero el anio es mayor, 
                                                                               $cuota=$cuotafija-50;
								             }
									    }
                                                                            else
                                                                            {
                                                                             $cuota=$cuotafija;
									     }

									    $abonos=$regis2['abonos'];
									    $apagar=$cuota-$abonos+$vcargoadic;


									    if($abonos>0)
									     {
									      $concepto="PAGO MENSUAL :".$f1x." al ".$f2x." Por:".$cuota." (-)abono:".$abonos.$cargoadicional;
									     }
									     else
									     {
									      $concepto="PAGO DE SERVICIO MENSUAL :".$f1x." al ".$f2x.$cargoadicional;
									     }
									    if(empty($f1))
									     {
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, consulte con el administrador del sistema";
									     }
									    if($estatus==0)
									     {
if(intval(substr($ultimopago,5,2))==1)                                                 
{
 $debemes="Debe desde el mes de Enero";
}
if(intval(substr($ultimopago,5,2))==2)                                                 
{
 $debemes="Debe desde el mes de Febrero";
}
if(intval(substr($ultimopago,5,2))==3)                                                 
{
 $debemes="Debe desde el mes de Marzo";
}
if(intval(substr($ultimopago,5,2))==4)                                                 
{
 $debemes="Debe desde el mes de Abril";
}
if(intval(substr($ultimopago,5,2))==5)                                                 
{
 $debemes="Debe desde el mes de Mayo";
}
if(intval(substr($ultimopago,5,2))==6)                                                 
{
 $debemes="Debe desde el mes de Junio";
}
if(intval(substr($ultimopago,5,2))==7)                                                 
{
 $debemes="Debe desde el mes de Julio";
}
if(intval(substr($ultimopago,5,2))==8)                                                 
{
 $debemes="Debe desde el mes de Agosto";
}
if(intval(substr($ultimopago,5,2))==9)                                                 
{
 $debemes="Debe desde el mes de Septiembre";
}
if(intval(substr($ultimopago,5,2))==10)                                                 
{
 $debemes="Debe desde el mes de Octubre";
}
if(intval(substr($ultimopago,5,2))==11)                                                 
{
 $debemes="Debe desde el mes de Noviembre";
}
if(intval(substr($ultimopago,5,2))==12)                                                 
{
 $debemes="Debe desde el mes de Diciembre";
}

									    	echo '<div style="background-color:red; padding:10px 10px 10px 10px;Color:#FFFFFF;">
									    	El cliente esta desconectado, debe usar el concepto: PAGO DE MORA POR CLIENTE DESCONECTADO
									    	</div>'.$debemes;
									      $apagar=0;
                                                                              $concepto="Error en periodo de pago mensual, consulte con el administrador del sistema";
									     }
                                                                            if((substr($f1,8,2)!=substr($f2,8,2) and $estatus!=0) or (substr($f1,5,2)==substr($f2,5,2) and $estatus!=0))
									     {
									      $apagar=0;
                                                                              $concepto="Error en el concepto de pago";
									    	echo '<div style="background-color:red; padding:10px 10px 10px 10px;Color:#FFFFFF;">
									    	Revise periodos (debe ser del 1 al 1 del siguiente mes), si se ha programado dias de servicio use el concepto PAGO POR DIAS DE SERVICIO
									    	</div>';
									     }
                                                                            if(intval(substr($f1,8,2))==intval(substr($f2,8,2)) and intval(substr($f1,8,2))!=1 and intval(substr($f2,8,2))!=1 and $estatus!=0)
									     {
									      $apagar=0;
                                                                              $concepto="Error en el concepto de pago";
									    	echo '<div style="background-color:red; padding:10px 10px 10px 10px;Color:#FFFFFF;">
									    	Hay un error en periodo de servicio, revise los periodos de pago y corrijalo
									    	</div>';
									     }



									   }
	                                                                  if($_POST['Servicio']==12)  //pago de mora completa con reconexion
									   {
									    $xcliente=$_POST["Cliente"];
                                                                            $mora=0;
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
                                                                            $mora=$regis1['morahoy'];
									    $apagar=$mora;
									    $valormaximo=$mora;
									    $concepto="Pago de mora con reconexion"."Monto:".$mora;

									   }
	                                                                  if($_POST['Servicio']==8)  //pago por dias de servicio
									   {
									    $xcliente=$_POST["Cliente"];
								            $fechadehoy=$_POST["Fecha"];
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
									    $cuota=$regis1['valorplan'];
									    $cuotafija=$regis1['valorplan'];
									    $estatus=$regis1['estatus'];
									    $tabla2=log_obtener_periodoapagar_cliente($bodega,$xcliente);
									    $regis2=mysql_fetch_array($tabla2);
 									    $f1=$regis2['fechaini'];
 									    $f2=$regis2['fechafin'];
                                                                            //pago de 200 si paga cualquier dia del mes pero es del mismo mes en curso que la fecha limite inferior del periodo
                                                                            if(substr($f1,5,2)==substr($fechadehoy,3,2)) 
									     {
                                                                               $cuota=$cuotafija;
								             }	


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
                                                                            $i=INTVAL($xmes1);
                                                                            switch ($i) 
									     {
                                                                             CASE 1:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Enero";
										break;
                                                                             CASE 2:
     									       $apagar=(($cuota/28)*$dias_diferencia);
										$delmesx="MES:Febrero";
										break;
                                                                             CASE 3:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Marzo";
										break;
                                                                             CASE 4:
     									       $apagar=(($cuota/30)*$dias_diferencia);
										$delmesx="MES:Abril";
										break;
                                                                             CASE 5:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Mayo";
										break;
                                                                             CASE 6:
     									       $apagar=(($cuota/30)*$dias_diferencia);
										$delmesx="MES:Junio";
										break;
                                                                             CASE 7:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Julio";
										break;
                                                                             CASE 8:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Agosto";
										break;
                                                                             CASE 9:
     									       $apagar=(($cuota/30)*$dias_diferencia);
										$delmesx="MES:Septiembre";
										break;
                                                                             CASE 10:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Octubre";
										break;
                                                                             CASE 11:
     									       $apagar=(($cuota/30)*$dias_diferencia);
										$delmesx="MES:Noviembre";
										break;
                                                                             CASE 12:
     									       $apagar=(($cuota/31)*$dias_diferencia);
										$delmesx="MES:Diciembre";
										break;
									     }

									    //Si es mes atrasado paga 230 si el mes de pago es mayor al mes de fecha inicial del periodo, 
                                                                            //se agrega 30 pesos de recargo
                                                                           if(intval(substr($fechadehoy,3,2))>intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))==intval(substr($f1,0,4))) 
									     {
                                                                               $apagar=$apagar+30;
								             }	

									    //si es mes atrasado y cambio de año paga 230 si el mes de pago es mayor al mes de fecha inicial del periodo, 
                                                                            //se agrega 30 pesos de recargo
                                                                           if(intval(substr($fechadehoy,3,2))<intval(substr($f1,5,2)) and intval(substr($fechadehoy,6,4))>intval(substr($f1,0,4))) 
									     {
                                                                               $apagar=$apagar+30;
								             }	

                                                                           //Buscando si existen abonos al periodo
									    $abonos=$regis2['abonos'];
                                                                            $nuevototal=$apagar-$abonos;
									    $apagar=$nuevototal;

									    if($abonos>0)
									     {
									      $concepto="Pago por:".$dias_diferencia." dias de servicio (-)abono:".$abonos." de ".$delmesx;
									     }
										else
										{
									    $concepto="Pago por:".$dias_diferencia." dias de servicio de ".$delmesx;
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
	                                                                   if($_POST['Servicio']==7)  //pago por abono a cuota
									    {
									     $xcliente=$_POST["Cliente"];
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
                                                                              $concepto="Error en periodo de pago mensual, consulte con el administrador del sistema";
									     }

									    }

	                                                                   if($_POST['Servicio']==20)  //pago por abono a mora
									    {
									    $xcliente=$_POST["Cliente"];
                                                                            $mora=0;
                                                                            //deme el concepto de la cuota a pagar y el valor de la cuota
  		  							    require_once("logica/log_facturas.php");
 									    $tabla1=log_obtener_cuotaapagar_cliente($bodega,$xcliente);
									    $regis1=mysql_fetch_array($tabla1);
                                                                            $mora=$regis1['morahoy'];
									    $apagar=$mora;
									    $valormaximo=$mora;
                                                                             $concepto="Abono a mora";
									    }
  									  if($_POST['Servicio']!=1 and $_POST['Servicio']!=8 and $_POST['Servicio']!=12)
								           {
									     $xcliente=$_POST["Cliente"];
  		  							     require_once("logica/log_servicios.php");
 									     $tabla1=log_obtener_servicio($_POST['Servicio']);
									     $regis1=mysql_fetch_array($tabla1);
                                                                             $valormaximo=$regis1['Costo'];
									     $concepto=$regis1['Nombre'];;
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
									<input  type="submit" value="Generar Lista" class="frm_btn" name="confirmar0"/>
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

									<tr>



									<tr>
									<td>Fecha de pago:</td>
									<td><input type="text" class="frm_txt" id="Fecha" name="Fecha"  value="'.$estafecha.'" /></td>
									</tr>


									<td>Servicio a cancelar:</td>
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

 									<td colspan="2" align="center">
									<input  type="submit" value="Completar Datos" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
									</table>
									</form>';




									echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >



									</table>
									</form>';

			





									if($_POST['Servicio']==1)   //pago de cuota mensual
  									{
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'">';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>



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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												


										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>


										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt"  name="Preciou" value="'.$apagar.'" /></td>
										</tr>


							                <tr>
							                <td width="45%">
							                <p style="line-height: 100%">Concepto a facturar:</td>
							                <td width="45%">
							                <p style="line-height: 150%">
							                <textarea rows="2" name="Concepto" readonly="readonly" cols="80">'.$concepto.'</textarea></td>

										</tr>
										


										<tr>
										<td>Descuento a la cuota:</td>
										<td><input type="text" class="frm_txt" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>

									
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												




										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>
										<tr>
										</tr>
										<tr>
										</tr>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>



										<tr>
										<td colspan="2" align="center">En caso de reconectar el servicio al cliente</td>
										</tr>
										<tr>
										<td colspan="2" align="center">Debe programar su reconexion</td>
										</tr>
										<tr>
										<td>Especifique : <img src="imagenes/mano.png" alt="mano"  border="0" align="texttop" /></td>
										<td><input type="text" class="frm_txt" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										</tr>

										<tr>
										<td colspan="2" align="center">Nota: Cuando se haga la reconexion debe entrar a Ejecucion de Actividades Tecnicas para dar de alta el servicio</td>
										</tr>
										<tr>
										</tr>
										<tr>
										</tr>

										<tr>
										</tr>


										
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												


										<tr>
										<td>Valor:</td>
										<td><input type="number" class="frm_txt" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>

										<td><input type="text" class="frm_txt" hidden="true" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>


										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>


										
							
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
 }

if($_POST['Servicio']==7)     //abono parcial a cuota 
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												


										<tr>
										<td>Valor:</td>
										<td><input type="text" class="frm_txt" name="Preciou" value="'.$apagar.'" /></td>
										</tr>


										<tr>
										<td>Concepto a facturar:</td>
										<td><input type="text" class="frm_txt_long" readonly="readonly" name="Concepto" value="'.$concepto.'" /></td>
										</tr>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>


										<td><input type="text" class="frm_txt" hidden="true" hidden="true" name="Dcuota" value="'.(isset($_POST['Dcuota'])?$_POST['Dcuota']:'').'" /></td>


										<td><input type="text" class="frm_txt" hidden="true" id="Fechat" name="Fechat" value="'.(isset($_POST['Fechat'])?$_POST['Fechat']:'').'"/></td>

										
							
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>

												


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

										
							
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>

												




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

										
							
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
 }

if($_POST['Servicio']!=1 and $_POST['Servicio']!=8 and $_POST['Servicio']!=12 and $_POST['Servicio']!=7 and $_POST['Servicio']!=20 and $_POST['Servicio']!=11)
  {
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'?lafecha='.$fecha50.'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >
										<tr>

										<td><input type="text" class="frm_txt" hidden="true" name="Servicio" value="'.$servicio.'" /></td>
										<td><input type="text" class="frm_txt" hidden="true" name="Valortemp" value="'.$valormaximo.'" /></td>
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
									<td>Numero de Recibo:</td>
									<td><input type="text" class="frm_txt" name="Factura" readonly="readonly" value="'.$nummovi.'"  /></td>
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
									<td><input type="text" class="frm_txt" name="Autoriza" readonly="readonly" value="'.$emplerecibe.'" /></td>
									</tr>


									<td><input type="hidden" class="frm_txt" name="Descuento" value="'.(isset($_POST['Descuento'])?$_POST['Descuento']:'').'" /></td>
												




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
										<td><input type="text" class="frm_txt" hidden="true" name="Fechaiii" value="'.$delmesx.'"/></td>

							
										<tr>
										<td colspan="2" align="center">
										<input  type="submit" value="Guardar e Imprimir"  class="frm_btn" name="aceptar"/>
										<input  type="submit" value="Solo Guardar"  class="frm_btn" name="guardar"/>
										<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
										<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
										<input  type="hidden" value="'.$codigo_salida.'" class="frm_btn" name="CodSalida"/>
										</td>
										</tr>
										</table>
										</form>';
							}





/////////////////////////////////////////////////////////
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
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mnombre" value="'.$registro['Mnombre'].'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" readonly="readonly" name="Mapellido" value="'.$registro['Mapellido'].'" /></td>
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
	    							        </tr>


									<td>Ultimo periodo pagado</td>
									<tr>
									<td>Fecha inicio  del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago1" value="'.$registro['Ulfepago1'].'" /></td>
									</tr>

									<tr>
									<td>Fecha final del periodo:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Ulfepago2" value="'.$registro['Ulfepago2'].'" /></td>
									</tr>

									<tr>
									<td>Departamento:</td>
									<td>
									 <select name="Partida" id="Partida" disabled="true" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
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
									<td>Ciudad:</td>
									<td>
									 <select name="SubPartidas" id="SubPartidas" disabled="true" class="frm_cmb_long" />
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
									<td>Region:</td>
									<td>
									 <select name="SubPartidas_a"  id="SubPartidas_a" disabled="true" class="frm_cmb_long" />
									 <option value="">Seleccione una region...</option>';
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
									 <select name="SubPartidas_b"  id="SubPartidas_b" disabled="true" class="frm_cmb_long" />
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
									<td colspan="2" align="center">
									<input  type="submit" value="Pagos realizados"  class="frm_btn" name="facturas"/>
									<input  type="submit" value="Llamadas de cobro"  class="frm_btn" name="llamadas"/>
									<input  type="submit" value="Historial de servicio"  class="frm_btn" name="activi"/>
									<input  type="submit" value="Historial de planes"  class="frm_btn" name="planes"/>
									<input  type="submit" value="Volver lista clientes"  class="frm_btn" name="cancelar"/>
									<input  type="submit" value="Rep.Historico pagos"  class="frm_btn" name="histopago"/>
									<input  type="submit" value="Rep.Estado cuenta"  class="frm_btn" name="cta"/>
									<input  type="submit" value="Rep.Mora perdonada" class="frm_btn" name="morasper"/>
									</td>
									</tr>
								</table>
								</form>';

								break;
							case 'post':
								if ($registro['Estadohoy']=="1")
								{
									$insertar=false;
									echo '<META HTTP-EQUIV="Refresh" Content="0; URL=idenpaci.php">';    
									exit;  

								}
								if ($insertar==true)
								{
									$resultado=log_conectar_idenpaci($_POST,$_GET['id'],$bodx);
									echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
									Programacion de conexion creada correctamente.
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
									<td><input type="text" class="frm_txt_long" name="Mnombre" value="'.(isset($_POST['Mnombre'])?$_POST['Mnombre']:'').'" /></td>
									</tr>


									<tr>
									<td>Apellidos:</td>
									<td><input type="text" class="frm_txt_long" name="Mapellido" value="'.(isset($_POST['Mapellido'])?$_POST['Mapellido']:'').'" /></td>
									</tr>



						


											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Solicitar Conexion"  class="frm_btn" name="aceptar"/>
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
