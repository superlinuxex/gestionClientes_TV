<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv- Proceso para crear respaldo de la base de datos </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href='https://script.google.com'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_formopti.css" type="text/css" media="screen" title="default" />


<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="stylesheet" />
<script type="text/javascript" src="utils/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="utils/jquery-ui-1.8.19.custom.min.js"></script>



<!-- script para activar drive de google -->
<script >
  window.___gcfg = {
    lang: 'es',
    parsetags: 'onload'
  };
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>




<script type="text/javascript">
	$(function(){
		// Datepicker
		$('#FechaD').datepicker({
			inline: true
		});
		$('#FechaH').datepicker({
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

require __DIR__ . '/ticket/autoload.php'; 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
							<h3 class="title">CREACION DE RESPALDO DE LA BASE DE DATOS EN GOOGLE DRIVE</h3>
							<div class="entry">


<?php
function exportarTablas($host, $usuario, $pasword, $nombreDeBaseDeDatos)
{
    set_time_limit(3000);
    $tablasARespaldar = [];
    $mysqli = new mysqli($host, $usuario, $pasword, $nombreDeBaseDeDatos);
    $mysqli->select_db($nombreDeBaseDeDatos);
    $mysqli->query("SET NAMES 'utf8'");
    $tablas = $mysqli->query('SHOW TABLES');
    while ($fila = $tablas->fetch_row()) {
        $tablasARespaldar[] = $fila[0];
    }
    $contenido = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $nombreDeBaseDeDatos . "`\r\n--\r\n\r\n\r\n";
    foreach ($tablasARespaldar as $nombreDeLaTabla) {
        if (empty($nombreDeLaTabla)) {
            continue;
        }
        $datosQueContieneLaTabla = $mysqli->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
        $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
        $cantidadDeFilas = $mysqli->affected_rows;
        $esquemaDeTabla = $mysqli->query('SHOW CREATE TABLE ' . $nombreDeLaTabla);
        $filaDeTabla = $esquemaDeTabla->fetch_row();
        $contenido .= "\n\n" . $filaDeTabla[1] . ";\n\n";
        for ($i = 0, $contador = 0; $i < $cantidadDeCampos; $i++, $contador = 0) {
            while ($fila = $datosQueContieneLaTabla->fetch_row()) {
                //La primera y cada 100 veces
                if ($contador % 100 == 0 || $contador == 0) {
                    $contenido .= "\nINSERT INTO " . $nombreDeLaTabla . " VALUES";
                }
                $contenido .= "\n(";
                for ($j = 0; $j < $cantidadDeCampos; $j++) {
                    $fila[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
                    if (isset($fila[$j])) {
                        $contenido .= '"' . $fila[$j] . '"';
                    } else {
                        $contenido .= '""';
                    }
                    if ($j < ($cantidadDeCampos - 1)) {
                        $contenido .= ',';
                    }
                }
                $contenido .= ")";
                # Cada 100...
                if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $cantidadDeFilas) {
                    $contenido .= ";";
                } else {
                    $contenido .= ",";
                }
                $contador = $contador + 1;
            }
        }
        $contenido .= "\n\n\n";
    }
    $contenido .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
    $carpeta = __DIR__ . "/respaldos";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }
    # Calcular un ID único
    $id = uniqid();
    # También la fecha
    $fecha = date("Y-m-d");
    # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
    $nombreDelArchivo = sprintf('%s/respaldo_%s_%s.sql', $carpeta, $fecha, $id);
    #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
    return file_put_contents($nombreDelArchivo, $contenido) !== false;

}

function exportarTablas2($host, $usuario, $pasword, $nombreDeBaseDeDatos)
{
    set_time_limit(3000);
    $tablasARespaldar = [];
    $mysqli = new mysqli($host, $usuario, $pasword, $nombreDeBaseDeDatos);
    $mysqli->select_db($nombreDeBaseDeDatos);
    $mysqli->query("SET NAMES 'utf8'");
    $tablas = $mysqli->query('SHOW TABLES');
    while ($fila = $tablas->fetch_row()) {
        $tablasARespaldar[] = $fila[0];
    }
    $contenido = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $nombreDeBaseDeDatos . "`\r\n--\r\n\r\n\r\n";
    foreach ($tablasARespaldar as $nombreDeLaTabla) {
        if (empty($nombreDeLaTabla)) {
            continue;
        }
        $datosQueContieneLaTabla = $mysqli->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
        $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
        $cantidadDeFilas = $mysqli->affected_rows;
        $esquemaDeTabla = $mysqli->query('SHOW CREATE TABLE ' . $nombreDeLaTabla);
        $filaDeTabla = $esquemaDeTabla->fetch_row();
        $contenido .= "\n\n" . $filaDeTabla[1] . ";\n\n";
        for ($i = 0, $contador = 0; $i < $cantidadDeCampos; $i++, $contador = 0) {
            while ($fila = $datosQueContieneLaTabla->fetch_row()) {
                //La primera y cada 100 veces
                if ($contador % 100 == 0 || $contador == 0) {
                    $contenido .= "\nINSERT INTO " . $nombreDeLaTabla . " VALUES";
                }
                $contenido .= "\n(";
                for ($j = 0; $j < $cantidadDeCampos; $j++) {
                    $fila[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
                    if (isset($fila[$j])) {
                        $contenido .= '"' . $fila[$j] . '"';
                    } else {
                        $contenido .= '""';
                    }
                    if ($j < ($cantidadDeCampos - 1)) {
                        $contenido .= ',';
                    }
                }
                $contenido .= ")";
                # Cada 100...
                if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $cantidadDeFilas) {
                    $contenido .= ";";
                } else {
                    $contenido .= ",";
                }
                $contador = $contador + 1;
            }
        }
        $contenido .= "\n\n\n";
    }
    $contenido .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
    $carpeta = __DIR__ . "/respaldos";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }
    # Calcular un ID único
    $id = uniqid();
    # También la fecha
    $fecha = date("Y-m-d");
    # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
    $nombreDelArchivo2 = sprintf('%s/cablefacturas_respaldo.sql', $carpeta, $fecha, $id);
    #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
    return file_put_contents($nombreDelArchivo2, $contenido) !== false;

}
						$elusuario=$_SESSION['idusuarios'];
						$fecha1=date('d-m-Y');
						$bodega=$_SESSION["idBodega"];
						$paso=1;

 	  					require_once("logica/log_facturas.php");
						$tabla31=log_obtener_ventausuario($elusuario);
						$regis31=mysql_fetch_array($tabla31);
                                                $nombre=$regis31['nombre'];
                                                $apellido=$regis31['apellido'];

						$tabla3=log_obtener2_ventausuario($elusuario,$bodega,$fecha1);
						$regis3=mysql_fetch_array($tabla3);
                                                $montoabre=$regis3['montoabre'];
                                                $montocierra=$regis3['montocierra'];
                                                $venta=$regis3['ventas'];
                                                $observa=$regis3['observa'];
                                                $fecha1=$regis3['fecha'];
                                                $montoinicial=0;
						//$fecha=date('d/m/Y');

						if (isset ($_POST['confirmar2']))
						{
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
						exit;    
						}

						//if (isset ($_POST['confirmar1']))
						//{
						$paso=2;
						exportarTablas("localhost", "root", "", "cablefacturas");
						exportarTablas2("localhost", "root", "", "cablefacturas");
						echo '<div style="background-color:powderblue; padding:30px 10px 10px 10px; Color:#ce2700;">
						Haga la copia de respaldo con el boton GUARDAR, siga el proceso de google y espere hasta que aparezca el boton GUARDADO
						</div>';
						$elusuario=$_SESSION['idusuarios'];
						$bodega="1";
						$montousuario=$_POST["Finalcaja"];
						$observa=$_POST["Observa"];
						$montoinicial=$_POST["Montoinicial"];
						$fecha1=$regis3['fecha'];
						//$tabla4=log_actualizar2_ventausuario($elusuario,$montousuario,$bodega,$fecha1,$observa,$montoinicial);
if($bodega=='50')
{
//imprimir recibo de cierre
$minicio=$_POST["Iniciocaja"];
$ventas=$_POST["Valorventa"];
$encaja=$_POST["Finalcaja"];
$diferencia=($minicio+$ventas)-$encaja;
$fechahora=date("j/n/Y")." ".date("h:i:s");
$xnombrecli=$_POST["Nombre"];
$xapellidocli=$_POST["Apellido"];
$nombre_impresora = "EPSON TM-T20II Receipt"; 
$concepto="Reporte de corte de caja parcial";
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->text("       EMPRESA CABLE"."\n"); 
$printer->text("GRUPO S.A."."\n"); 
$printer->text("Fecha y Hora: ".$fechahora."\n"); 
$printer->text("Empleado:"."\n"); 
$printer->text($xnombrecli." ".$xapellidocli."\n");
$printer->text("Concepto               "."\n"); 
$printer->text(substr($concepto,0,25)."     "."\n");
$printer->text(substr($concepto,26,25)."\n");
$printer->text(substr($concepto,51,25)."\n"); 
$printer->text(substr($concepto,76,19)."\n"); 
$printer->text("Monto inicial en caja: ".$minicio."\n"); 
$printer->text("Monto en ventas: ".$ventas."\n"); 
$printer->text("Monto en caja: ".$encaja."\n"); 
$printer->text("Diferencia: ".$diferencia."\n"); 
$printer->text("Observaciones"."\n"); 
$printer->text($_POST["Observa"]."\n"); 
$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();
}



							echo '<div class="post">
									<form method="POST" action="'.$_SERVER["PHP_SELF"].'?tipo='.$tipo.'" >
									<table style="background-color:#FFFFFF; padding:60px 10px 10px 60px;">
									<tr>
 									<td colspan="2" align="right">
									<div class="g-savetodrive" data-src="http://localhost/ctrclientescablefactu/respaldos/cablefacturas_respaldo.sql"   data-filename="cablefacturas_respaldo.sql"   data-sitename="Cablevision"></div>
									<input  type="submit"  value="Salir"  name="confirmar2"/>
									<tr>
									<td>Usar el boton GUARDAR para hacer un respaldo de la base de datos</td>
									</tr>
									<tr>
									<td></td>
									</tr>
									<tr>
									<td></td>
									</tr>
									</td>
									</tr>

									</table>
									</form>
                                                                  </div>';
						//}


////////////////
if($paso==1)
{
									if(isset($_POST['aceptar']))
									{

										$mostrar_datos='post';
									}
									else
									{
										if(isset($_POST['cancelar']))
										{
											echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
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
									<td>Fecha:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Fecha"  value="'.$fecha1.'" /></td>
									</tr>


									<tr>
									<td>Nombre de empleado:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Nombre"  value="'.$nombre.'" /></td>
									</tr>

									<tr>
									<td>Apellido de empleado:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Apellido"  value="'.$apellido.'" /></td>
									</tr>

									<tr>
									<td>Monto inicial de caja:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Iniciocaja"  value="'.$montoabre.'" /></td>
									</tr>
							

									<tr>
									<td>Monto cobrado:</td>
									<td><input type="text" class="frm_txt" readonly="readonly" name="Valorventa"  value="'.$venta.'" /></td>
									</tr>

									<tr>
									<td>Monto final en caja:</td>
									<td><input type="text" class="frm_txt" name="Finalcaja"  value="'.$montocierra.'" /></td>
									</tr>

									<tr>
									<td>Observaciones:</td>
									<td><input type="text" class="frm_txt_long" name="Observa"  value="'.$observa.'" /></td>
									</tr>

									<tr>
									<td>Nuevo monto para iniciar caja:</td>
									<td><input type="text" class="frm_txt" name="Montoinicial"  value="'.$montoinicial.'" /></td>
									</tr>
									<tr>



									<tr>
									<td colspan="2" align="center">
									<input  type="submit" value="Generar reporte" class="frm_btn" name="confirmar1"/>
									</td>
									</tr>
								</table>
								</form>';
								break;
							case 'post':
								$insertar=true;
								if ($insertar==true)
								{
                                                                //Agi guardar los datos del cierre
								$resultado=log_eliminarglob_factura($_POST);
								$elusuario=$_POST['Usuario'];
								$fecha1=$_POST['Fechafac'];
								$bodega="1";
 	  							     require_once("logica/log_facturas.php");
								     $tabla3=log_obtener3_ventausuario($elusuario,$bodega,$fecha1);
								     $regis3=mysql_fetch_array($tabla3);
                                                                     $montousuario=$regis3['ventas']-$_POST["Total"];
								     $tabla4=log_restar_ventausuario($elusuario,$montousuario,$bodega,$fecha1);
								     $regis4=mysql_fetch_array($tabla4);
												
												echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
												Factura eliminada correctamente.
												</div>';
												unset($_POST); 
											//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    
											//exit;  

											}
											if ($insertar==false)
											{
											echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
											echo '
											<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" >

											<tr>
											<td>Fecha:</td>
											<td><input type="text" class="frm_txt" name="Fecha" value="'.(isset($_POST['Fecha'])?$_POST['Fecha']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Nombre de empleado:</td>
											<td><input type="text" class="frm_txt" name="Nombre" value="'.(isset($_POST['Nombre'])?$_POST['Nombre']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Apellido de empleado:</td>
											<td><input type="text" class="frm_txt" name="Apellido" value="'.(isset($_POST['Apellido'])?$_POST['Apellido']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Monto inicial de caja:</td>
											<td><input type="text" class="frm_txt" name="Iniciocaja" value="'.(isset($_POST['Iniciocaja'])?$_POST['Iniciocaja']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td>Monto cobrado:</td>
											<td><input type="text" class="frm_txt" name="Valorventa" value="'.(isset($_POST['Valorventa'])?$_POST['Valorventa']:'').'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Observaciones:</td>
											<td><input type="text" class="frm_txt_long" name="Observa" value="'.(isset($_POST['Observa'])?$_POST['Observa']:'').'" /></td>
											</tr>
											<tr>


											<tr>
											<td>Nuevo monto incial de caja:</td>
											<td><input type="text" class="frm_txt" name="Montoinicial" value="'.(isset($_POST['Montoinicial'])?$_POST['Montoinicial']:'').'" /></td>
											</tr>
											<tr>

											<tr>
											<td colspan="2" align="center">
											<input  type="submit" value="Anular factura"  class="frm_btn" name="aceptar"/>
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



//////////////////////
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
