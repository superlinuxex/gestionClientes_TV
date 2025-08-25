<?php
require __DIR__ . '/TICKET/autoload.php'; 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_datosfac($_GET['id'],$_GET['id0']);
    if( mysql_num_rows($resultado)==0){exit;}
    $row=mysql_fetch_array($resultado);
    $fecha1=$row['fechafac'];
    $xbodegasali=$row['sucursal'];
    $fecha=substr($fecha1,8,2)."-".substr($fecha1,5,2)."-".substr($fecha1,0,4);
    $envio=$row['numero'];
    $factura=$row['numero'];
    $bodega=$row['sucursal'];
    $cliente=$row['nom_clie'];
    $total=$row['total'];
    $codsalida=$row['numero'];
    $cod_cliente=$row['cod_cliente']; 
    mysql_data_seek($resultado, 0); 
    $alturaLinea=10;
    $alturaTabla=15;

$xycliente=$cod_cliente;  
require_once("./logica/log_facturas.php");
$losdatos1=log_obtener_datos_cliente($xycliente,$bodega);
$registrocli1=mysql_fetch_array($losdatos1);
$xnombrecli=$registrocli1["nombre"];
$xapellidocli=$registrocli1["apellido"];
$xndep=$registrocli1["ndep"];
$nmuni=$registrocli1["nmuni"];
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

 //Buscando el detalle de la factura
 $sentencia = "select fechahora,numero,concepto,total FROM detafac where numero='".$codsalida."' and sucursal='".$bodega."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    $cuentadeta=0;
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ( $fila = mysql_fetch_array($resultadow))
       {
        $cuentadeta=$cuentadeta+1;
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
       }
     }
  }

$tit1="CABLEOPERADORA"; 
$tit2=""; 
$tit0="CABLEVISION SUCHIATE"; 
$tit3="RFC:"; 
$tit4="TEL. OFICINA "; 
$tit5="AV."; 
$tit6="SUCHIATE, CHIAPAS"; 
$tit7="Recibo: ".$factura;
$tit8="Fecha: ".$fecha; 
$tit9="Usuario:"; 
$tit10=$xnombrecli." ".$xapellidocli;
$tit11=$nmuni." ".$xndep; 
$tit12="Concepto"; 

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

$tit17="                   TOTAL: ".$total; 
$tit18="  TE INVITAMOS A PAGAR A TIEMPO"; 
$tit19="      GRACIAS POR SU PAGO"; 


if($bodega=="100")
{
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
$printer->text("TEL. OFICINA   964 62 42 937"."\n"); 
$printer->text("    AV. MORELOS SIN NUMERO"."\n"); 
$printer->text("         TUZANTAN, CHIAPAS"."\n"); 
$printer->text("Recibo: ".$factura."\n");
$printer->text("Fecha: ".$fechahora."\n"); 
$printer->text("Usuario:"."\n"); 
$printer->text($xnombrecli." ".$xapellidocli."\n");
$printer->text($nmuni." ".$xndep."\n"); 
$printer->text("Concepto                   Precio"."\n"); 
$printer->text(substr($concepto,0,25)."     ".$totalrecibo."\n");
$printer->text(substr($concepto,26,25)."\n");
$printer->text(substr($concepto,51,25)."\n"); 
$printer->text(substr($concepto,76,19)."\n"); 
$printer->text("                   TOTAL: ".$totalrecibo."\n"); 
$printer->text("  TE INVITAMOS PAGAR A TIEMPO"."\n"); 
$printer->text("      GRACIAS POR SU PAGO"."\n"); 
$printer->text("  ESTE RECIBO SERA INCLUIDO"."\n"); 
$printer->text("      EN LA FACTURA GLOBAL"."\n"); 
$printer->text("ESTE RECIBO ES UNA REIMPRESION"."\n"); 

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

}

//<H1 class=SaltoDePagina> </H1>

if($bodega=="1")
{
echo '
<!DOCTYPE html>
<html>
<link href="css/style_screenprinter.css" rel="stylesheet" type="text/css" media="screen" />
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

    <dt><FONT SIZE=1>'.$tit13_1.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14_2.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15_3.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16_4.'</font></dt>

    <dt><FONT SIZE=1>'.$tit13_5.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14_6.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15_7.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16_8.'</font></dt>


    <dt><FONT SIZE=1>'.$tit13_9.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14_10.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15_11.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16_12.'</font></dt>


    <dt><FONT SIZE=1>'.$tit13_13.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14_14.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15_15.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16_16.'</font></dt>


    <dt><FONT SIZE=1>'.$tit13_17.'</font></dt>
    <dt><FONT SIZE=2>'.$tit14_18.'</font></dt>
    <dt><FONT SIZE=2>'.$tit15_19.'</font></dt>
    <dt><FONT SIZE=2>'.$tit16_20.'</font></dt>


    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tit17.'</font></dt>
    <dt><FONT SIZE=1>'.$tit18.'</font></dt>
    <dt><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;'.$tit19.'</font></dt>
</body>
</html>';


echo '<META HTTP-EQUIV="Refresh" Content="0; URL=facturas.php">';    


}
?>