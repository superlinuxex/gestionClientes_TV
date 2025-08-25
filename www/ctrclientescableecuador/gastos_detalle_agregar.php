<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Agregar Detalle de factura de gastos</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />
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
							<h3 class="title">Agregar Detalle del gasto</a></h3>
							<div class="entry">
								<?php
									$marc1="SINMARCA";
									require_once("./utils/validar_datos.php");
									//$Encabezado=$_SESSION['parametros'];
									//$codigo_gasto=$Encabezado['0'];
									//$bodega=$Encabezado['3'];

								$codigo=$_SESSION['Codigo'];
								$factura=$_SESSION['documento'];
								$documento=$_SESSION['documento'];
								$fecha1=$_SESSION['fecha'];
								$partida=$_SESSION['partida'];
								$proveedor=$_SESSION['proveedor'];
								$tipo=$_SESSION['tipo'];
								$bodega=$_SESSION['idbodega'];
								$codigoempl=$_SESSION['codigoempl'];
								$idusuarios=$_SESSION['idusuarios'];
								$observaciones=$_SESSION['observaciones'];
								$justifica=$_SESSION['justifica'];
								$fovial=$_SESSION['fovial'];
								$descuento=$_SESSION['descuento'];
								$renta=$_SESSION['renta'];
								$lugarcon=$_SESSION['lugarcon'];
								$remesa=$_SESSION['remesa'];




//if (isset ($_SESSION['fovial'])!=0)
//{
// $fovial=$_SESSION['fovial'];
//}
//else
//{
// $fovial=0;
//}
//if (isset ($_SESSION['descuento'])!=0)
//{
// $descuento=$_SESSION['descuento'];
//}
//else
//{
// $descuento=0;
//}
//if (isset ($_SESSION['renta'])!=0)
//{
// $renta=$_SESSION['renta'];
//}
//else
//{
// $renta=0;
//}
//if (isset ($_SESSION['lugarcon'])!=0)
//{
// $lugarcon=$_SESSION['lugarcon'];
//}
//else
//{
// $lugarcon=1;
//}




				                               if (isset ($_GET['lafecha']))
                                				    {
								       if($_GET['lafecha']!="")
	                                				    {
					                                     $fecha1=$_GET['lafecha'];
        	                        				     $fecha50=$_GET['lafecha'];
									     $_SESSION['fechaxx']=$_GET['lafecha'];
				                                            }  
				                                     }
								     ELSE
	                                			    {
					                                $fecha1=$_SESSION['fechaxx'];
					                            }  




									if ($tipo==1)
									{
											echo '&nbsp;&nbsp;Para la factura:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;


									}
									if ($tipo==2)
									{
											echo '&nbsp;&nbsp;Para el registro fiscal:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}

									if ($tipo==3)
									{
											echo '&nbsp;&nbsp;Para el recibo:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									
									if ($tipo==4)
									{
											echo '&nbsp;&nbsp;Para el tiket:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}
									if ($tipo==5)
									{
											echo '&nbsp;&nbsp;Para el vale:&nbsp;'.$documento;
											echo '&nbsp; de Fecha:&nbsp;'.$fecha1;

									}




									
									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$_SESSION['fecha'].'">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Tipogas'])==false or $_POST['Tipogas']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe especificar el tipo de gasto
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" OR $_POST['Cantidad']==0)
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
										if (isset($_POST['Costou'])==false or $_POST['Costou']=="" or $_POST['Costou']==0)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar el precio Unitario para el Detalle de gasto.
											</div>';
											$insertar=false;										
										}


										if ($insertar==true)
										{
											require_once("logica/log_gastos.php");	
											$id_nuevo_gasto=log_obtener_cod_gasto();
											if($_SESSION["Codigo"]=="Inicio")
											{
 											 $_SESSION["Codigo"]=$id_nuevo_gasto; 
											}
											else
											{
 											 $id_nuevo_gasto=$_SESSION["Codigo"]; 
											}
											
											if (log_validar_gasto($id_nuevo_gasto)==0)
											{

												log_insertar_gasto($id_nuevo_gasto,$factura,$fovial,$partida,$proveedor,$tipo,$fecha1,$bodega,$renta,$codigoempl,$lugarcon,$descuento,$idusuarios,$observaciones,$justifica,$remesa);

												//Tomando los datos del encabezado ya insertado en la tabla
												$tabla=log_obtener_gasto($_SESSION["Codigo"]);
												$registro=mysql_fetch_array($tabla);

												$params[0]=$registro['Codigo'];/*Codigo_entrada*/
												$params[1]=$registro['Tipo'];/*tipo entrada*/
												$params[2]=$_SESSION["idusuarios"];/*idusuario*/
												$params[3]=$_SESSION["idBodega"];
												$params[4]=$registro['Lugarcon'];
												$params[5]=$registro['Proveedor'];
												$params[6]=$registro['Partida'];
												$params[7]=$registro['Documento'];
												$params[8]=$registro['Fovial'];
												$params[9]=null;
												$params[10]=null;
												$params[11]=$registro['Observaciones'];
												$params[12]=$registro['Justificacion'];
												$params[13]=$registro['Fecha'];
												$params[14]=$registro['Renta'];
												$params[15]=$registro['Codigoempl'];
												$params[16]=$registro['Descuento'];
												$params[17]=$registro['Remesa'];

												$_SESSION['Codigo']=$params[0];
												$_SESSION['tipo']=$params[1];
												$_SESSION['idusuarios']=$params[2];
												$_SESSION['idbodega']=$params[3];
												$_SESSION['lugarcon']=$params[4];
												$_SESSION['proveedor']=$params[5];
												$_SESSION['partida']=$params[6];
												$_SESSION['documento']=$params[7];
												$_SESSION['fovial']=$params[8];
												$_SESSION['observaciones']=$params[11];
												$_SESSION['justifica']=$params[12];
												$fecha50=$params[13];
												$_SESSION['fecha']=$params[13];
												$_SESSION['renta']=$params[14];
												$_SESSION['codigoempl']=$params[15];
												$_SESSION['descuento']=$params[16];
												$_SESSION['remesa']=$params[17];

												$_SESSION['parametros']=$params;
											}

											$resultado=log_insertar_gasto_detalle($_POST,$bodega,$_SESSION['Codigo'],$_SESSION['tipo'],$_SESSION['documento'],$_SESSION['fecha'],$_SESSION['proveedor'],$_SESSION['renta'],$_SESSION['fovial'],$_SESSION['descuento'],$_SESSION['remesa']);
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Registro ingresado correctamente.
											</div>';
											unset($_POST); 
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=gastos_detalle.php?lafecha='.$fecha1.'">';    
										exit;    

										}										
									}

									
									echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
									echo '
									<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

												<tr>
												<td>Tipo de gasto:</td>
												<td>
												<select name="Tipogas" class="frm_cmb" />
												<option value="">Seleccione un tipo de gasto...</option>';
												require_once("./logica/log_gastos.php");
												$resultado=log_obtener_tipogas_cmb();
												while ( $fila = mysql_fetch_array($resultado))
												{
												if (isset($_POST["Tipogas"]))
												{
												if ($_POST["Tipogas"]==$fila['Codigo'])
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
									<td>Mas detalles del gasto:</td>
									<td><input type="text" class="frm_txt_long" name="Detalle" value="'.(isset($_POST['Detalle'])?$_POST['Detalle']:'').'" /></td>
									</tr>
									
									<tr>
									<td>Lugar de consumo del gasto:</td>
									<td><input type="text" class="frm_txt_long" name="Consumo" value="'.(isset($_POST['Consumo'])?$_POST['Consumo']:'').'" /></td>
									</tr>


									<tr>
									<td>Placa del vehiculo (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="Placa" value="'.(isset($_POST['Placa'])?$_POST['Placa']:'').'" /></td>
									</tr>

									<tr>
									<td>Kilometraje Inicial (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="K1" value="'.(isset($_POST['K1'])?$_POST['K1']:'').'" /></td>
									</tr>


									<tr>
									<td>Kilometraje Final (si es combustible):</td>
									<td><input type="text" class="frm_txt" name="K2" value="'.(isset($_POST['K2'])?$_POST['K2']:'').'" /></td>
									</tr>

									<tr>
									<td>Zona a trabajar (si es pago de pasajes):</td>
									<td><input type="text" class="frm_txt_long" name="Zona" value="'.(isset($_POST['Zona'])?$_POST['Zona']:'').'" /></td>
									</tr>



									<tr>
									<td>Periodo de corte (si es pago de energia electrica):</td>
									<td><input type="text" class="frm_txt_long" name="Corte" value="'.(isset($_POST['Corte'])?$_POST['Corte']:'').'" /></td>
									</tr>


									<tr>
									<td>NIC (si es pago de energia electrica):</td>
									<td><input type="text" class="frm_txt" name="Nic" value="'.(isset($_POST['Nic'])?$_POST['Nic']:'').'" /></td>
									</tr>


									<tr>
									<td>Costo Unitario:</td>
									<td><input type="text" class="frm_txt" name="Costou" value="'.(isset($_POST['Costou'])?$_POST['Costou']:'').'" /></td>
									</tr>


									<tr>
									<td>Cantidad:</td>
									<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
									</tr>

					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									<input  type="hidden" value="'.$codigo_gasto.'" class="frm_btn" name="Codgasto"/>
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
