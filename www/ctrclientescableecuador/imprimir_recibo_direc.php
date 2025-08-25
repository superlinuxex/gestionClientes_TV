<?php
require __DIR__ . '/TICKET/autoload.php'; 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


$nombre_impresora = "EPSON TM-U220 Receipt";
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

    require_once("./logica/log_usuarios.php");
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_datosfacww($_GET['id1'],$_GET['id2'],$_GET['id3'],$_GET['id4']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $fecha1=$row['fechafac'];
    $xbodegasali=$row['sucursal'];
    $fecha=substr($fecha1,8,2)."-".substr($fecha1,5,2)."-".substr($fecha1,0,4);
    $envio=$row['numero'];
    $cajero=$row['idusuarios'];
    $factura=$row['numero'];
    $bodega=$row['sucursal'];
    $cliente=$row['nom_clie'];
    $total=$row['total'];
    $codsalida=$row['numero'];
    $cod_cliente=$row['cod_cliente']; 
    $empleado=$row['emplepago']; 
    mysql_data_seek($resultado, 0); 
    $alturaLinea=10;
    $alturaTabla=15;
    $cajade="";
    $resultado3=log_obtener_usuario($cajero);
    $row2=mysql_fetch_array($resultado3);
    $cajade=$row2['Nombre']." ".$row2['Apellido'];

$xycliente=$cod_cliente;  
require_once("./logica/log_facturas.php");
$losdatos1=log_obtener_datos_cliente($xycliente,$bodega);
$registrocli1=mysql_fetch_array($losdatos1);
$xnombrecli=$registrocli1["nombre"];
$xapellidocli=$registrocli1["apellido"];
$xndep=$registrocli1["ndep"];
$nmuni=$registrocli1["nmuni"];
$ncan=$registrocli1["ncan"];
$direccion=$registrocli1["otraref"];
$cuentadeta=0;
$tit13='';
$tit14='';
$tit15='';
$tit16='';
$tit13_1='';
$tit14_2='';
$tit15_3='';
$tit16_4='';
$tit13_5='';
$tit14_6='';
$tit15_7='';
$tit16_8='';
$tit13_9='';
$tit14_10='';
$tit15_11='';
$tit16_12='';
$tit13_13='';
$tit14_14='';
$tit15_15='';
$tit16_16='';
$tit13_17='';
$tit14_18='';
$tit15_19='';
$tit16_20='';


$concepto1="";
$concepto2="";
$concepto3="";
$concepto4="";
$concepto5="";
$concepto6="";

$sumatotal=0;

 //Buscando el detalle de la factura
 $sentencia = "select fechahora,numero,concepto,total FROM detafac where numero='".$codsalida."' and fechafac='".$fecha1."' and sucursal='".$bodega."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    $cuentadeta=0;
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ( $fila = mysql_fetch_array($resultadow))
       {
        $cuentadeta=$cuentadeta+1;
	$fechahora=$fila['fechahora'];
        if($cuentadeta==1)
        {
      	 $concepto1=$fila['concepto'];
         $totalrecibo1=$fila['total'];
         $fechahora1=$fila['fechahora'];
        }
        if($cuentadeta==2)
        {
      	 $concepto2=$fila['concepto'];
         $totalrecibo2=$fila['total'];
         $fechahora2=$fila['fechahora'];
        }
        if($cuentadeta==3)
        {
      	 $concepto3=$fila['concepto'];
         $totalrecibo3=$fila['total'];
         $fechahora3=$fila['fechahora'];
        }
        if($cuentadeta==4)
        {
      	 $concepto4=$fila['concepto'];
         $totalrecibo4=$fila['total'];
         $fechahora4=$fila['fechahora'];
        }
        if($cuentadeta==5)
        {
      	 $concepto5=$fila['concepto'];
         $totalrecibo5=$fila['total'];
         $fechahora5=$fila['fechahora'];
        }
        if($cuentadeta==6)
        {
      	 $concepto6=$fila['concepto'];
         $totalrecibo6=$fila['total'];
         $fechahora6=$fila['fechahora'];
        }
        $sumatotal=$sumatotal+$fila['total'];
       }
     }
  }

if($cuentadeta>=1)
{
$tit13=substr($concepto1,0,25);
$tit14=substr($concepto1,26,25);
$tit15=substr($concepto1,51,25); 
$tit16=substr($concepto1,76,19); 
$tit16_a=$totalrecibo1;
}

if($cuentadeta>=2)
{
$tit13_1=substr($concepto2,0,25);
$tit14_2=substr($concepto2,26,25);
$tit15_3=substr($concepto2,51,25); 
$tit16_4=substr($concepto2,76,19); 
$tit16_4_a=$totalrecibo2;
}

if($cuentadeta>=3)
{
$tit13_5=substr($concepto3,0,25);
$tit14_6=substr($concepto3,26,25);
$tit15_7=substr($concepto3,51,25); 
$tit16_8=substr($concepto3,76,19); 
$tit16_8_a=$totalrecibo3;
}

if($cuentadeta>=4)
{
$tit13_9=substr($concepto4,0,25);
$tit14_10=substr($concepto4,26,25);
$tit15_11=substr($concepto4,51,25); 
$tit16_12=substr($concepto4,76,19); 
$tit16_12_a=$totalrecibo4;
}

if($cuentadeta>=5)
{
$tit13_13=substr($concepto5,0,25);
$tit14_14=substr($concepto5,26,25);
$tit15_15=substr($concepto5,51,25); 
$tit16_16=substr($concepto5,76,19); 
$tit16_16_a=$totalrecibo5;
}

if($cuentadeta>=6)
{
$tit13_17=substr($concepto6,0,25);
$tit14_18=substr($concepto6,26,25);
$tit15_19=substr($concepto6,51,25); 
$tit16_20=substr($concepto6,76,19); 
$tit16_20_a=$totalrecibo6;
}

$subtotal=($sumatotal/1.08);
$impuestos=($sumatotal-$subtotal);

$printer->text("         CABLEVISION SUCHIATE"."\n"); 
$printer->text("       3a. Avenida Norte No.8-A"."\n"); 
$printer->text("         Col.Centro C.P.30840"."\n"); 
$printer->text("        Ciudad Hidalgo Suchiate"."\n"); 
$printer->text("            Chiapas Mexico"."\n"); 
$printer->text("           RFC:CUDA580815Q6A"."\n"); 
$printer->text("            Tel. 9626980335"."\n"); 
$printer->text("          WhatsApp 9621399199"."\n"); 
$printer->text("---------------------------------------"."\n"); 
$printer->text("Folio: ".$factura."\n"); 
$printer->text("Fecha y Hora: ".$fechahora."\n"); 
$printer->text("Atendido por: ".$cajade."\n"); 
$printer->text("_______________________________________"."\n"); 
$printer->text("No. CLIENTE: ".$cod_cliente."\n"); 
$printer->text("Cliente: ".$xnombrecli." ".$xapellidocli."\n");
$printer->text("Colonia: ".$ncan."\n"); 
$printer->text("Ciudad: ".$nmuni."\n"); 
$printer->text("_______________________________________"."\n"); 
$printer->text("CANT.     DESCRIPCION    PRECIO IMPORTE"."\n"); 
$printer->text("_______________________________________"."\n"); 
if($concepto1!="")
{
$printer->text("1 ".$tit13."\n"); 
$printer->text("  ".$tit14."\n"); 
//$printer->text("  ".$tit15."\n"); 
//$printer->text("  ".$tit16."\n"); 
$printer->text("                              $".$tit16_a."\n"); 
}
if($concepto2!="")
{
$printer->text("1 ".$tit13_1."\n"); 
$printer->text("  ".$tit14_2."\n"); 
//$printer->text("  ".$tit15_3."\n"); 
//$printer->text("  ".$tit16_4."\n"); 
$printer->text("                              $".$tit16_4_a."\n"); 
}
if($concepto3!="")
{
$printer->text("1 ".$tit13_5."\n"); 
$printer->text("  ".$tit14_6."\n"); 
//$printer->text("  ".$tit15_7."\n"); 
//$printer->text("  ".$tit16_8."\n"); 
$printer->text("                              $".$tit16_8_a."\n"); 
}
if($concepto4!="")
{
$printer->text("1 ".$tit13_9."\n"); 
$printer->text("  ".$tit14_10."\n"); 
//$printer->text("  ".$tit15_11."\n"); 
//$printer->text("  ".$tit16_12."\n"); 
$printer->text("                              $".$tit16_12_a."\n"); 
}
if($concepto5!="")
{
$printer->text("1 ".$tit13_13."\n"); 
$printer->text("  ".$tit14_14."\n"); 
//$printer->text("  ".$tit15_15."\n"); 
//$printer->text("  ".$tit16_16."\n"); 
$printer->text("                              $".$tit16_16_a."\n"); 
}
if($concepto6!="")
{
$printer->text("1 ".$tit13_17."\n"); 
$printer->text("  ".$tit14_18."\n"); 
//$printer->text("  ".$tit15_19."\n"); 
//$printer->text("  ".$tit16_20."\n"); 
$printer->text("                              $".$tit16_20_a."\n"); 
}


$printer->text("---------------------------------------"."\n"); 
$printer->text("SubTotal                      $ ".number_format($subtotal,2,'.','')."\n"); 
$printer->text("Impuestos (8%)                 $ ".number_format($impuestos,2,'.','')."\n"); 
$printer->text("_______________________________________"."\n"); 
$printer->text("Total                         $ ".$total."\n"); 
$printer->text("_______________________________________"."\n"); 

$printer->text("       NO OLVIDES PAGAR DEL"."\n"); 
$printer->text("        1 AL 5 DE CADA MES"."\n"); 
$printer->text("       GRACIAS POR SU PAGO !"."\n"); 

$printer->feed();
$printer->cut();
$printer->pulse();
$printer->close();

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    



?>