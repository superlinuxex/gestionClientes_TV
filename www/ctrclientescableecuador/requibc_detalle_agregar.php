<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Agregar Detalle de requisiciones de sucursal </title>
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
							<h3 class="title">Agregar Detalle requisicion</a></h3>
							<div class="entry">
								<?php
									$marc1="SINMARCA";
									require_once("./utils/validar_datos.php");
									$Encabezado=$_SESSION['parametros'];
									$codigo_entrada=$Encabezado['0'];
									$bodega=$Encabezado['2'];
									echo '&nbsp;&nbsp;Requisicion No.:&nbsp;'.$Encabezado['0'];
									echo '&nbsp; de Fecha:&nbsp;'.$Encabezado['5'];

									$insertar=true;
									if (isset ($_POST['cancelar']))
									{
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=requibc_detalle.php">';    
										exit;    
									}
									if (isset ($_POST['aceptar']))
									{
										if (isset($_POST['Producto'])==false or $_POST['Producto']=="")
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe seleccionar un Producto para el Detalle.
											</div>';
											$insertar=false;
										}
										if (isset($_POST['Cantidad'])==false or $_POST['Cantidad']=="" OR $_POST['Cantidad']==0)
										{
											echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
											Debe ingresar la cantidad para el Detalle.
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
											require_once("logica/log_reqsucursal.php");											
											if (log_validar_requibc($codigo_entrada)==0)
											{
												log_insertar_requibc($Encabezado);
											}
											$resulatado=log_insertar_requibc_detalle($_POST,$bodega,$Encabezado);
											echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
											Registro ingresado correctamente.
											</div>';
											unset($_POST); 
										echo '<META HTTP-EQUIV="Refresh" Content="0; URL=requibc_detalle.php">';    
										exit;    

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
									  echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']." -- Despachado por ".$fila['Medidades']."</option>";
									  }
									 }
									 echo'
									 </td>									
									 </tr>	


									<tr>
									<td>Cantidad de artículos a solicitar:</td>
									<td><input type="text" class="frm_txt" name="Cantidad" value="'.(isset($_POST['Cantidad'])?$_POST['Cantidad']:'').'" /></td>
									</tr>
									
					
									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Aceptar"  class="frm_btn" name="aceptar"/>
									<input  type="reset" value="Limpiar" class="frm_btn" name="reset"/>
									<input  type="submit" value="Cancelar" class="frm_btn" name="cancelar"/>
									<input  type="hidden" value="'.$codigo_entrada.'" class="frm_btn" name="CodEntrada"/>
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
