<?php
require "dat_base.php";  
function dat_obtener_facturas($comienzo, $cant,$bodega,$filtro)
{
    global $parametros , $conexion ;
    $sentencia="select numero Factura,DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha, tipofac Tipo, cod_cliente Cliente, total1 Subtotal, descuento Descuento, monto Total, iva IVA, total Monto, case anulada when 0 then 'Pagada' when 1 then 'Anulada' end 'Estado'
                    from facturas 
                    where sucursal='".$bodega."'
                    order by fechafac DESC  LIMIT $comienzo, $cant";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_validar_factura($id,$tipo,$fecha,$bodega)
{
    global $parametros , $conexion ;
    $xfecha=substr($fecha,6,4)."/".substr($fecha,3,2)."/".substr($fecha,0,2);

$bodega=$_SESSION['idbodega'];

    $sentencia = "select * from facturas where numero='$id' and sucursal='".$bodega."' and tipofac=".$tipo." and fechafac='".$xfecha."'"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
    exit;
}

function dat_validar_talonario($id,$tipo,$fecha,$bodega)
{
    global $parametros , $conexion ;
    $xfecha=substr($fecha,6,4)."/".substr($fecha,3,2)."/".substr($fecha,0,2);
    $bodega=$_SESSION['idbodega'];


    if($tipo==1)
    {
     //$sentencia = "select facini,facfin,fechaini from taloncf where '$id'>=facini and '$id'<=facfin and sucursal='".$bodega."' and fechaini<=$xfecha"; 
     $sentencia = "select facini,facfin,fechaini from taloncf where  '$id'>=facini and '$id'<=facfin and sucursal='$bodega'"; 
     $resultado = mysql_query($sentencia);
    }
    if($tipo==2)
    {
     //$sentencia = "select facini,facfin,fechaini from taloncr where '$id'>=facini and '$id'<=facfin and sucursal='".$bodega."' and fechaini<=str_to_date('$xfecha','%d-%m-%Y')"; 
     $sentencia = "select facini,facfin,fechaini from taloncr where '$id'>=facini and '$id'<=facfin and sucursal='$bodega'"; 
     $resultado = mysql_query($sentencia);
    }
    return mysql_num_rows ( $resultado );
    exit;
}

function dat_insertar_factura($factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario)
{
global $parametros , $conexion ;
    //inserta un registro en la tabla de articulos
    //$factura=$datos['0'];
    //$tipo=$datos['1'];
    //$usuario=$datos['2'];
    //$bodega=$datos['3'];
    //$cliente=$datos['9'];
    //$autoriza=$datos['12'];
    //$lugarpago=$datos['13'];
    //$descuento=$datos['15'];

$bodega=$_SESSION['idbodega'];


    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


 $xnclie="";
 $sentencia = "select nombre,apellido FROM clientes where sucursal='".$bodega."' and cod_cliente=".$cliente.";"; 
 $resultado = mysql_query($sentencia);
 if(isset($resultado))
 {
 if(mysql_num_rows ( $resultado )!=0)
 {
  $row=mysql_fetch_array($resultado);
  $xnclie=$row['nombre']." ".$row['apellido'];
  }
 }

if($tipo=='1')
 {
   $tipocara="CF";
 }
 else
 {
   $tipocara="CR";
 }

      
    $sentencia = "insert into facturas (numero,tipofac,tipo,fechafac,cod_cliente,nom_clie,lugardepago,emplepago,descuento,idusuarios,sucursal) 
                    VALUES ('".$factura."','".$tipo."','".$tipocara."','".$fecha."','".$cliente."','".$xnclie."','".$lugarpago."','".$autoriza."','".$descuento."','".$usuario."','".$bodega."')"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}



function dat_eliminar_factura($id)
{
global $parametros , $conexion ;
    //Elimina un registro de la tabla de articulos
    $sentencia = "delete from  salidas where idarticulos=$id;";  
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_facturas_detalle($comienzo, $cant,$factura,$tipo,$fecha,$bodega)
{
    global $parametros , $conexion ;
$bodega=$_SESSION["idBodega"];
    $sentencia = "select numero Factura, tipofac Tipo, fechafac Fecha,item Item, concepto Concepto,cantidad Cantidad, precio 'Precio Unitario $'
                    FROM  detafac where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_detalle_facturas($cod_encabezado, $cod_detalle)
{
    global $parametros , $conexion ;
    //obtine un item del detalle de una salida
    $sentencia = "select codigo_salida, codigo_detalle, idpartida Partida, idsubpartida 'Sub-Partida', 
                    idsubpartida_a 'Sub-Partida A', idsubpartida_b'Sub-Partida B', idarticulo Producto, 
                    cantidad Cantidad, precio_unit Precio, utilizar_en , codigo_equipo Equipo, hora, minu, Kilometraje, 
                    horometro, destino_aceite from salidas_deta a  where a.codigo_salida='".$cod_encabezado."' 
                    and a.codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_detalle_facturas_nuevo($cod_encabezado, $cod_detalle)
{
    global $parametros , $conexion ;
    //obtine un item del detalle de una salida
    $sentencia = "select codigo_salida, codigo_detalle, idpartida Partidat, idsubpartida Subpartidat, 
                    idsubpartida_a Subpartidat_a, idsubpartida_b Subpartidat_b, idarticulo Producto, 
                    cantidad Cantidad, precio_unit Precio, utilizar_en , codigo_equipo Equipo, hora, minu, Kilometraje, 
                    horometro, destino_aceite from salidas_deta a  where a.codigo_salida='".$cod_encabezado."' 
                    and a.codigo_detalle='".$cod_detalle."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_detalle_facturas_nuevo2($factura,$tipo,$fecha,$item)
{
    global $parametros , $conexion ;
    $bodega=$_SESSION["idBodega"];
    $factu=$factura;
    $xtipo=$tipo;
    $xfecha=$fecha;
    $xitem=$item;
    $sentencia = "select * from detafac  
		where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and item='".$xitem."' and sucursal='".$bodega."'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_num_facturas_detalle($factura,$tipo,$fecha,$bodega)
{
    global $parametros , $conexion ;
    $fecha1=substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
    $fecha=$fecha1;

    $sentencia = "select * from detafac where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."';"; 
    $resultado = mysql_query($sentencia);
    return mysql_num_rows ( $resultado );
    exit;
}

function dat_insertar_facturas_detalle($datos,$factura,$tipo,$fecha1,$bodega,$cliente,$autoriza,$lugarpago,$descuento,$usuario)
{
    global $parametros , $conexion ;
    //inserta un registro en la tabla de salidas_detalle

    //$factura=$Encabezado['0'];
    //$tipo=$Encabezado['1'];
    //$usuario=$Encabezado['2'];
    //$bodega=$Encabezado['3'];
    //$fecha1=$Encabezado['14'];

if($bodega==0 or $bodega=="")
{
 $bodega=$_SESSION['idbodega'];
}
    $porcen=$descuento;
    $xcliente=$cliente;

    $apagar=$datos['Preciou'];
    $servicio=$datos['Servicio'];
    $valoruno=1;

    $fechat1=$datos['Fechat'];
    $fechat=substr($fechat1,6,4)."-".substr($fechat1,3,2)."-".substr($fechat1,0,2);

    $fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


    $tipocara="ER";
    if($tipo==1) 
     {
      $tipocara="CF";
     } 
    if($tipo==2) 
     {
      $tipocara="CR";
     } 

    $apagar=$datos['Preciou'];

    //tomando datos del cliente 
    $sentencia2 = "select nombre,apellido from clientes WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
    $resultado2 = mysql_query($sentencia2);
    $regis2=mysql_fetch_array($resultado2);
    $nombreclie=$regis2['nombre']." ".$regis2['apellido'];

    //Buscando nuevamente el periodo pagado
     if($servicio==1 or $servicio==7 or $servicio==8)
     {
      $pagado=1;
      $sentencia="select fechaini,fechafin,mesnpagar,mespagar,abonos from periodos where sucursal='".$bodega."' and cod_cliente='".$xcliente."' and pagado!='".$pagado."'";
      $resultado = mysql_query($sentencia);
      $regis2=mysql_fetch_array($resultado);
      $f1=$regis2['fechaini'];
      $f2=$regis2['fechafin'];
      $nmes=$regis2['mesnpagar'];
      $mes=$regis2['mespagar'];
      $impresa=0;
      $anulada=0;
     } 

    $pagoreal=$apagar-$datos['Dcuota'];

    if($datos['Preciou']>0)     //es porque se captura por el digitador
     {
      $pagoreal1=$datos['Preciou'];
      $pagoreal=$pagoreal1-$datos['Dcuota'];
     } 

    //Buscando el correlativo ultimo del detalle    
    $sentencia="select case IFNULL(max(cast(item as decimal)),0) when '0' then 1 else max(cast(item as decimal))+1 end nitem1
                FROM detafac where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'";
    $cod_tab=mysql_query($sentencia);
    $row=mysql_fetch_array($cod_tab);
    $nitem=$row['nitem1'];

    //Guardando el registro de detalle
    $sentencia="insert into detafac (numero,item,tipofac,tipo,fechafac,cod_cliente,codservi,concepto,cantidad,precio,total,fechaini,fechafin,mesnpaga,mespaga,sucursal,idusuarios,fechareg,impresa,fechaacti,descuento,anulada,fpagada) 
          VALUES ('".$factura."','".$nitem."','".$tipo."','".$tipocara."','".$fecha."','".$xcliente."','".$servicio."','".$datos['Concepto']."','".$valoruno."','".$pagoreal."','".$pagoreal."','".$f1."','".$f2."','".$nmes."','".$mes."'
                 ,'".$bodega."','".$usuario."',now(),'".$impresa."','".$fechat."','".$datos['Dcuota']."','".$anulada."','".$fecha."')";
    $resultado=mysql_query($sentencia);


     //Actualizando datos de periodos y cuotas 
     if($servicio==1)     //si es pago de cuota total
      {
       //buscando el numero de la cuota que debe pagar el cliente
       $sentencia="select numeperi from clientes where sucursal='".$bodega."' and cod_cliente='".$xcliente."'";
       $resultado = mysql_query($sentencia);
       $regis2=mysql_fetch_array($resultado);
       $xnumeperi=$regis2['numeperi'];
       $xnnumeri=$xnumeperi+1;

       //buscando el periodo que esta pagando y actualizando los datos del cliente
       $pagado="1";
       $sentencia="select fechaini,fechafin,mesnpagar,mespagar,abonos from periodos where sucursal='".$bodega."' and cod_cliente='".$xcliente."' and pagado!='".$pagado."'";
       $resultado = mysql_query($sentencia);
       $regis2=mysql_fetch_array($resultado);
       $f1=$regis2['fechaini'];
       $f2=$regis2['fechafin'];
       $f3=$regis2['mesnpagar'];
       $sentencia2 = "update clientes SET ulfepago1='".$f1."',ulfepago2='".$f2."',ulmespago='".$f3."',fechaul=now(),ulpago='".$pagoreal."',numeperi='".$xnnumeri."' WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
       $resultado2 = mysql_query($sentencia2);

       //marcando como pagado
       $pagado="1";
       $pago=1;
       $sentencia="update periodos set pagado='".$pago."' where sucursal='".$bodega."' and cod_cliente='".$xcliente."' and pagado!='".$pagado."'";
       $resultado = mysql_query($sentencia);

       //agregregando el nuevo periodo a pagar a futuro
       $xfechaini=$f2;
       $fecha1=$xfechaini; 
       $b1=intval(substr($fecha1,8,2));
       $b2=intval(substr($fecha1,5,2));
       $b3=intval(substr($fecha1,0,4));
       $c1=$b1;
       $c2=$b2;
       $c3=$b3;

       if($b2==12)
       {
        $c2=1;
        $c3=$b3+1;
       }
       else
       {
        $c2=$b2+1;
       }
       $xmespagar=$b2;
       if($c1==31)
        {
         $c1=$c1-1;
        }
       if($c2==2 and $c1>28)
        {
         $c1=28;
        }
       $xfechafin=strval($c3)."-".strval($c2)."-".strval($c1);
       if($xmespagar==1)
        {
         $xmesnpagar="ENERO";
        }
       if($xmespagar==2)
        {
         $xmesnpagar="FEBRERO";
        }
       if($xmespagar==3)
        {
         $xmesnpagar="MARZO";
        }
       if($xmespagar==4)
        {
         $xmesnpagar="ABRIL";
        }
       if($xmespagar==5)
        {
         $xmesnpagar="MAYO";
        }
       if($xmespagar==6)
        {
         $xmesnpagar="JUNIO";
        }
       if($xmespagar==7)
        {
         $xmesnpagar="JULIO";
        }
       if($xmespagar==8)
        {
         $xmesnpagar="AGOSTO";
        }
       if($xmespagar==9)
        {
         $xmesnpagar="SEPTIEMBRE";
        }
       if($xmespagar==10)
        {
         $xmesnpagar="OCTUBRE";
        }
       if($xmespagar==11)
        {
         $xmesnpagar="NOVIEMBRE";
        }
       if($xmespagar==12)
        {
         $xmesnpagar="DICIEMBRE";
        }
       $xpagado="0";
       //Creamos el nuevo periodo para el proximo pago del cliente
       $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,sucursal,fechareg,pagado)  
					VALUES ('".$xcliente."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$bodega."',now(),'".$xpagado."')";
       $resultadoQ = mysql_query($sentencia);
     } 
     if($servicio==7)     //si es abono a la cuota
      {
       $pagado="1";
       $sentencia="update periodos set abonos='".$pagoreal."' where sucursal='".$bodega."' and cod_cliente='".$xcliente."' and pagado!='".$pagado."'";
       $resultado = mysql_query($sentencia);
      } 

     if($servicio==8)     //si es pago de dias de servicio
      {
       $pagado="1";
       $sentencia="update periodos set pagado='".$pagado."' where sucursal='".$bodega."' and cod_cliente='".$xcliente."' and pagado!='".$pagado."'";
       $resultado = mysql_query($sentencia);
      } 


     if($servicio==20)     //si abono a una mora actualizo el registro del cliente
      {
       $sentencia2 = "select morahoy,abonomora from clientes WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
       $resultado2 = mysql_query($sentencia2);
       $regis2=mysql_fetch_array($resultado2);
       $mora=$regis2['morahoy'];
       $amora=$regis2['abonomora'];
       $actumora=$mora-$pagoreal;
       $actumora2=$amora+$pagoreal;

       $sentencia2 = "update clientes SET morahoy='".$actumora."',abonomora='".$actumora2."' WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
       $resultado2 = mysql_query($sentencia2);
      } 

     if($servicio==12)     //si pago de mora con reconexion
      {
       $sentencia2 = "select morahoy,abonomora from clientes WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
       $resultado2 = mysql_query($sentencia2);
       $regis2=mysql_fetch_array($resultado2);
       $mora=$regis2['morahoy'];
       $amora=$regis2['abonomora'];
       $actumora=$mora-$pagoreal;
       $actumora2=$amora+$pagoreal;

       $sentencia2 = "update clientes SET morahoy='".$actumora."',abonomora='".$actumora2."' WHERE sucursal='".$bodega."' and cod_cliente= '".$xcliente."';";  
       $resultado2 = mysql_query($sentencia2);
      } 

      //Evaluando si se ha digitado fecha para solicitud de actividad tecnica
	$fecha1=$datos['Fechat'];
	$fechaabc=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
	if(intval(substr($fecha1,6,4))>2012)   //sin no fue fecha en blanco, crear actividad tecnica
	{
	//obteniendo un correlativo para codigo de ticket
	$nummovi=0;
	$codigomov="TICKET";
	$sentencia="select numero id FROM correla2 where agencia='".$bodega."' and codigo='".$codigomov."'";
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

	$a="TICKET";
	$sentencia2="update correla2 set numero=numero+1 where agencia='".$bodega."' and codigo='".$a."'";
	$resultado2 = mysql_query($sentencia2);
	$usuario=$_SESSION["idusuarios"];
	$fecha1=$datos['Fechai'];
	$fechai=$fechaabc;
	
	//Buscando el nombre de la actividad
	$ntarea="";
	$norden=0;
	$tconexion=$servicio;
	$sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $ntarea=$filaz['nom_servi'];
	    $norden=$filaz['orden'];
	  }

	//Buscando cliente
	$ncliente="";
	$xdepto="";
	$xmuni="";
	$xcanton="";
	$xbarrio="";
	$xcaserio="";
	$xcalle="";
	$xave="";
	$xpasaje="";
	$xpoligono="";
	$xcasa="";
	$xblocke="";
	$tcliente=$xcliente;
	$sentencia = "select * from clientes where cod_cliente='".$tcliente."' and sucursal='".$bodega."'";  
	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $ncliente=$filaz['nombre']." ".$filaz['apellido'];
	    $xdepto=$filaz['cod_depto'];
	    $xmuni=$filaz['cod_ciudad'];
	    $xcanton=$filaz['cod_canton'];
	    $xbarrio=$filaz['cod_barrio'];
	    $xcaserio=$filaz['cod_caserio'];
	    $xpasaje=$filaz['pasaje'];
	    $xpoligono=$filaz['poligono'];
	    $xcasa=$filaz['casa'];
	    $xblocke=$filaz['blocke'];
	  }

	//buscando nombre de departamento
	  $xndepto="";
	  $sentencian = "select nom_depto FROM deptos where cod_depto='".$xdepto."'"; 
	  $resultadon = mysql_query($sentencian);
	  if(isset($resultadon))
	   {
	    if(mysql_num_rows ( $resultadon )!=0)
	    {
	     $rown=mysql_fetch_array($resultadon);
	     $xndepto=$rown['nom_depto'];
	    }
	   }
	//buscando nombre de municipio
	  $xnmuni="";
	  $sentencian = "select nomb_ciudad FROM munici where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."'"; 
	  $resultadon = mysql_query($sentencian);
	  if(isset($resultadon))
	   {
	    if(mysql_num_rows ( $resultadon )!=0)
	    {
	     $rown=mysql_fetch_array($resultadon);
	     $xnmuni=$rown['nomb_ciudad'];
	    }
	   }
	//buscando nombre de canton
	  $xncanton="";
	  $sentencian = "select nombrecant FROM canton where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."'"; 
	  $resultadon = mysql_query($sentencian);
	  if(isset($resultadon))
	   {
	    if(mysql_num_rows ( $resultadon )!=0)
	    {
	     $rown=mysql_fetch_array($resultadon);
	     $xncanton=$rown['nombrecant'];
	    }
	   }
	//buscando nombre de barrio
	  $xnbarrio="";
	  $sentencian = "select nombrebarrio FROM barrios where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."'";  
	  $resultadon = mysql_query($sentencian);
	  if(isset($resultadon))
	   {
	    if(mysql_num_rows ( $resultadon )!=0)
	    {
	     $rown=mysql_fetch_array($resultadon);
	     $xnbarrio=$rown['nombrebarrio'];
	    }
	   }
	//buscando nombre de colonia
	  $xncaserio="";
	  $sentencian = "select nombrecaserio FROM caserio where cod_depto='".$xdepto."' and cod_ciudad='".$xmuni."' and cod_canton='".$xcanton."' and cod_barrio='".$xbarrio."' and cod_caserio='".$xcaserio."'";   
	  $resultadon = mysql_query($sentencian);
	  if(isset($resultadon))
	   {
	    if(mysql_num_rows ( $resultadon )!=0)
	    {
	     $rown=mysql_fetch_array($resultadon);
	     $xncaserio=$rown['nombrecaserio'];
	    }
	   }
	//armando la direccion
	$tbarrio="";
	if($xnbarrio!="")
	{
	 $tbarrio="Barrio";
	}
	
	$tcaserio="";
	if($xncaserio!="")
	{
	 $tcaserio="Col.";
	}

	$tcalle="";
	if($xcalle!="")
	{
	 $tcalle="Calle";
	}

	$tave="";
	if($xave!="")
	{
	 $tave="Ave.";
	}

	$tpasaje="";
	if($xpasaje!="")
	{
	 $tpasaje="Pje.";
	}

	$tpoligono="";
	if($xpoligono!="")
	{
	 $tpoligono="Pol.";
	}

	$tbloque="";
	if($xblocke!="")
	{
	 $tbloque="Block.";
	}


	$direccion=$xnmuni.",".$xncanton.",".$tbarrio.$xnbarrio.",".$tcaserio.$xncaserio.",".$tcalle.$xcalle.",".$tave.$xave.",".$tpasaje.$xpasaje.",".$tpoligono.$xpoligono.",".$tbloque.$xblocke.",#".$xcasa;

	$sentencia = "insert into activi (movimiento,fechasoli,cod_cliente,nomclie,idusuarios,sucursal,fechareg,codservi,nomservi,direclie,orden)  
		VALUES ('".$nummovi."','".$fechai."','".$xcliente."','".$ncliente."','".$usuario."','".$bodega."',now(),'".$servicio."','".$ntarea."','".$direccion."','".$norden."')";
	    $resultado = mysql_query($sentencia);

	} 	
      //fin de crear la actividad tecnica
     
      //tomando el descuento aplicado a la factura en el encabezado
      $descuentoenca=0;
      $sentencia="select descuento from facturas where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'";
      $resultado = mysql_query($sentencia);
      $regis2=mysql_fetch_array($resultado);
      $descuentoenca=$regis2['descuento'];


     //Actualizando el encabezado de la factura
     $stotal=0;
     $res=mysql_query("select total from detafac where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'");
     while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }

      $montosindes=$stotal-$descuentoenca;
      $iva=0;
      
     if($tipo==2)   //si es factura de credito fiscal
      {
       $smtotal=$stotal+($stotal*0.13);
       $montosiva=($montosindes/1.13);
       $iva=$montosindes-$montosiva;
       $montomasiva=$montosiva+$iva;
       $sentencia="update facturas set total1='".$stotal."',monto='".$montosiva."',iva='".$iva."',total='".$montomasiva."' where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $sentencia="update facturas set total1='".$stotal."', monto='".$montosindes."', iva='".$iva."',total='".$montosindes."' where numero='".$factura."' and tipofac='".$tipo."' and fechafac='".$fecha."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }


     $error = mysql_error($conexion) == '' ? 1 : mysql_errno($conexion);
     return $error;
     exit;
}

function dat_actualizar_facturas_detalle($datos,$Encabezado,$registro)
{
 global $parametros , $conexion ;
}

function dat_eliminar_facturas_detalle($factura,$tipo,$fecha,$item)
{
 global $parametros , $conexion ;
 //toma datos del detalle
    $bodega=$_SESSION["idBodega"];
    $factu=$factura;
    $xtipo=$tipo;
    $xfecha=$fecha;
    $xitem=$item;
    $sentencia = "select * from detafac  where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and item='".$xitem."' and sucursal='".$bodega."'"; 
    $resultado = mysql_query($sentencia);
    $regis2=mysql_fetch_array($resultado);
    $xcliente=$regis2['cod_cliente'];
    $f1=$regis2['fechaini'];
    $f2=$regis2['fechafin'];
    $xtotal=$regis2['total'];
    $xservi=$regis2['codservi'];

 //elimina de la tabla de detalle
 $sentencia = "delete from detafac where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and item='".$xitem."' and sucursal='".$bodega."'";
 $resultadoglob = mysql_query($sentencia);
 if ($resultadoglob==1)
  {
   //primero actualizo el encabezado
     $stotal1=0;
     $descuentoenca=0;

     $sentencia = "select * from facturas  where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and sucursal='".$bodega."'"; 
     $resultado = mysql_query($sentencia);
     $regis2=mysql_fetch_array($resultado);
     $descuentoenca=$regis2['descuento'];

     $res=mysql_query("select total from detafac where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and sucursal='".$bodega."'");
     while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }
      $montosindes=$stotal-$descuentoenca;
      $iva=0;
      
     if($tipo==2)   //si es factura de credito fiscal
      {
       $smtotal=$stotal+($stotal*0.13);
       $montosiva=($montosindes/1.13);
       $iva=$montosindes-$montosiva;
       $montomasiva=$montosiva+$iva;
       $sentencia="update facturas set total1='".$stotal."',monto='".$montosiva."',iva='".$iva."',total='".$montomasiva."' where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $sentencia="update facturas set total1='".$stotal."', monto='".$montosindes."', iva='".$iva."',total='".$montosindes."' where numero='".$factu."' and tipofac='".$xtipo."' and fechafac='".$xfecha."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
   //Actualizando periodos
   if($xservi==1)   //es una cuota rechazada
      {
       $pagado="0";
       $pagadover="1";
       $sentencia="update periodos set pagado='".$pagado."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagadover."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
   if($xservi==7)   //es un abono a la cuota
      {
       $pagado="0";
       $sentencia = "select abonos from periodos where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado."' and sucursal='".$bodega."'"; 
       $resultado = mysql_query($sentencia);
       $regis2=mysql_fetch_array($resultado);
       $abonosacumulados=$regis2['abonos'];
       $quedaabono=$abonosacumulados-$xtotal;

       $sentencia="update periodos set abonos='".$quedaabono."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }

   if($xservi==8)   //fue un pago por dias de servicio
      {
       $pagado2="1";
       $pagado="0";
       $sentencia="update periodos set pagado='".$pagado."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado2."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }

    if($xservi==12 or $xservi==20)   //es un abono a mora o pago de mora completa
      {
       $sentencia2 = "select morahoy,abonomora from clientes where cod_cliente='".$xcliente."' and sucursal='".$bodega."'";  
       $resultado2 = mysql_query($sentencia2);
       $regis2=mysql_fetch_array($resultado2);
       $mora=$regis2['morahoy'];
       $amora=$regis2['abonomora'];
       $actumora=$mora+$xtotal;
       $actumora2=$amora-$xtotal;

       $sentencia2 = "update clientes SET morahoy='".$actumora."',abonomora='".$actumora2."' where cod_cliente='".$xcliente."' and sucursal='".$bodega."'";    
       $resultado2 = mysql_query($sentencia2);
      }

  }

 return $resultadoglob;
 exit;
}

function dat_obtener_cod_facturas3()
{
global $parametros , $conexion ;

    $sentencia="select cast(codigo_salida as decimal)+1 id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];
    }
    else
    {
        $retorno=1;
    }
    
    return $retorno;
    exit;
}

function dat_obtener_cod_facturas()
{
global $parametros , $conexion ;

    $sentencia="select cast(codigo_salida as decimal)+1 id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];

            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    else
    {
        $retorno=1;
            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    
    return $retorno;
    exit;
}



function dat_obtener_cod_facturas2()
{
global $parametros , $conexion ;
    
    $sentencia="select case IFNULL(max(cast(codigo_salida as decimal)),0) when '0' then 1 else max(cast(codigo_salida as decimal))+1 end id FROM correla_salidas";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $retorno=$fila['id'];

            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    else
    {
        $retorno=1;
            $sentencia2 = "update correla_salidas set codigo_salida='".$retorno."';";
            $resultado2 = mysql_query($sentencia2);
    }
    
    return $retorno;
    exit;
}

function dat_obtener_cod_vale1($bodega)
{
global $parametros , $conexion ;

    $sentencia1="select idproyecto FROM bodegas where idbodegas='".$bodega."'";
    $resultado1 = mysql_query($sentencia1);
    if(mysql_num_rows ( $resultado1 )!=0)
    {
        $filaxy=mysql_fetch_array($resultado1);
        $a=$filaxy['idproyecto'];

    }
    else
    {
        $a="";
                $retorno="";
    }

if($a!="")
{
    $sentencia="select numerovale FROM correla where codigovale='".$a."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
    {
        $fila=mysql_fetch_array($resultado);
        $b=$fila['numerovale'];
                $c=$b+1;
                $largo=strlen("$c");
                $ceros=6-$largo;
                $tomaceros="";
                for($i=1;$i<=$ceros;$i++)
                {
                 $tomaceros=$tomaceros."0";
                }
                $retorno=$a.$tomaceros."$c";
    }
    else
    {
        $s="insert into correla (codigovale, numerovale) values('".$a."',0)";
                $r=mysql_query($s);
                $retorno=$a."000001";
    }
    
}
    return $retorno;
    exit;
}



function dat_obtener_num_facturas($bodega,$filtro)
{
    global $parametros , $conexion ;
    
    $sentencia="select count(*) from facturas where sucursal='".$bodega."'";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_factura($id,$id2,$id3)
{
    global $parametros , $conexion ;
    $bodega=$_SESSION["idBodega"];
    $fecha=$id2;
    $xfecha=substr($fecha,6,4)."/".substr($fecha,3,2)."/".substr($fecha,0,2);
    $sentencia="select * from facturas where numero='$id' and fechafac='".$xfecha."' and tipofac='$id3' and sucursal='".$bodega."'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_facturamodi($id,$id2,$id3)
{
    global $parametros , $conexion ;
    $bodega=$_SESSION["idBodega"];
    $fecha=$id2;
    $xfecha=substr($fecha,6,4)."/".substr($fecha,3,2)."/".substr($fecha,0,2);
    $sentencia="select tipofac Tipofac, cod_cliente Cod_cliente, numero Factura, fechafac Fechafac, lugardepago Lugarpago, emplepago Autoriza, descuento Descuento, motivoanu Motivo, fechaanu Fechai, anulada Anulada, cmotianu Cmotivo from facturas where numero='$id' and fechafac='".$xfecha."' and tipofac='$id3' and sucursal='".$bodega."'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_actualizar_factura($datos)
{
    global $parametros , $conexion ;
    $bodega=$_SESSION["idBodega"];
    $var1=$datos['Factura'];
    $var2=$datos['Fechafac'];
    $var3=$datos['Tipofac'];
    $sentencia = "update facturas set lugardepago='".$datos['Lugarpago']."', emplepago='".$datos['Autoriza']."', descuento='".$datos['Descuento']."'
    where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
    $resultado1 = mysql_query($sentencia);

    //actualizando los datos tomando en cuenta el detalle de la factura

     $sentencia = "select * from facturas  where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'"; 
     $resultado = mysql_query($sentencia);
     $regis2=mysql_fetch_array($resultado);
     $descuentoenca=$regis2['descuento'];

     $res=mysql_query("select total from detafac where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'");
     while($row=mysql_fetch_assoc($res))
      {
      $stotal+=$row['total'];
      }
      $montosindes=$stotal-$descuentoenca;
      $iva=0;
      
     if($var3==2)   //si es factura de credito fiscal
      {
       $smtotal=$stotal+($stotal*0.13);
       $montosiva=($montosindes/1.13);
       $iva=$montosindes-$montosiva;
       $montomasiva=$montosiva+$iva;
       $sentencia="update facturas set total1='".$stotal."',monto='".$montosiva."',iva='".$iva."',total='".$montomasiva."' where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
      else
      {
       $sentencia="update facturas set total1='".$stotal."', monto='".$montosindes."', iva='".$iva."',total='".$montosindes."' where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }


    return $resultado1;
    exit;
}

function dat_anular_factura($datos)
{
    global $parametros , $conexion ;
    $fecha1=$datos['Fechai'];
    $xfechax=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

    $bodega=$_SESSION["idBodega"];
    $var1=$datos['Factura'];
    $var2=$datos['Fechafac'];
    $var3=$datos['Tipofac'];
    $xanulada="1";
    $sentencia = "update facturas set cmotianu='".$datos['Cmotivo']."',motivoanu='".$datos['Motivo']."', anulada='".$xanulada."', fechaanu='".$xfechax."'
    where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
    $resultado1 = mysql_query($sentencia);

    //actualizando los datos del detalle
    $sentencia = "update detafac set anulada='".$xanulada."'
    where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
    $resultado = mysql_query($sentencia);

    //Rastrear todo el detalle y devolver los datos a las cuentas de periodos y clientes
     $res=mysql_query("select * from detafac where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'");
     while($row=mysql_fetch_assoc($res))
      {
       $xcliente=$row['cod_cliente'];
       $f1=$row['fechaini'];
       $f2=$row['fechafin'];
       $xtotal=$row['total'];
       $xservi=$row['codservi'];

   //Actualizando periodos
   if($xservi==1)   //es una cuota rechazada
      {
       $pagado="0";
       $pagadover="1";
       $sentencia="update periodos set pagado='".$pagado."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagadover."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }
   if($xservi==7)   //es un abono a la cuota
      {
       $pagado="0";
       $sentencia = "select abonos from periodos where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado."' and sucursal='".$bodega."'"; 
       $resultado = mysql_query($sentencia);
       $regis2=mysql_fetch_array($resultado);
       $abonosacumulados=$regis2['abonos'];
       $quedaabono=$abonosacumulados-$xtotal;

       $sentencia="update periodos set abonos='".$quedaabono."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }

   if($xservi==8)   //fue un pago por dias de servicio
      {
       $pagado2="1";
       $pagado="0";
       $sentencia="update periodos set pagado='".$pagado."' where cod_cliente='".$xcliente."' and fechaini='".$f1."' and fechafin='".$f2."' and pagado='".$pagado2."' and sucursal='".$bodega."'";
       $resultado=mysql_query($sentencia);
      }

    if($xservi==12 or $xservi==20)   //es un abono a mora o pago de mora completa
      {
       $sentencia2 = "select morahoy,abonomora from clientes where cod_cliente='".$xcliente."' and sucursal='".$bodega."'";  
       $resultado2 = mysql_query($sentencia2);
       $regis2=mysql_fetch_array($resultado2);
       $mora=$regis2['morahoy'];
       $amora=$regis2['abonomora'];
       $actumora=$mora+$xtotal;
       $actumora2=$amora-$xtotal;

       $sentencia2 = "update clientes SET morahoy='".$actumora."',abonomora='".$actumora2."' where cod_cliente='".$xcliente."' and sucursal='".$bodega."'";    
       $resultado2 = mysql_query($sentencia2);
      }

       
  } //fin del while haya detalle

    return $resultado1;
    exit;
}

function dat_eliminarglob_factura($datos)
{
    global $parametros , $conexion ;

    $bodega=$_SESSION["idBodega"];
    $var1=$datos['Factura'];
    $var2=$datos['Fechafac'];
    $var3=$datos['Tipofac'];
    $sentencia = "delete from facturas where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
    $resultado1 = mysql_query($sentencia);

    //actualizando los datos del detalle
    $sentencia = "delete from detafac where numero='".$var1."' and fechafac='".$var2."' and tipofac='".$var3."' and sucursal='".$bodega."'";
    $resultado = mysql_query($sentencia);

    return $resultado;
    exit;
}

function dat_obtener_facturas_filtro($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    $sentencia="select numero Factura,DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha, tipofac Tipo, cod_cliente Cliente, total1 Subtotal, descuento Descuento, monto Total, iva IVA, total Monto, case anulada when 0 then 'Pagada' when 1 then 'Anulada' end 'Estado'
                    from facturas 
                    where sucursal='".$bodega."' and fechafac>=str_to_date('$filtro1','%d-%m-%Y') and fechafac<=str_to_date('$filtro2','%d-%m-%Y')
                    order by fechafac DESC LIMIT $comienzo, $cant";

    
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}


function dat_obtener_num_facturas_fvale($bodega,$filtro1)
{
    global $parametros , $conexion ;
    $sentencia="select count(*) from facturas where sucursal='".$bodega."' and (numero like '%".$filtro1."%' or cod_cliente like '%".$filtro1."%')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_facturas_fvale($bodega,$comienzo,$cant,$filtro1)
{
    global $parametros , $conexion ;
    $sentencia="select numero Factura,DATE_FORMAT(fechafac,'%d/%m/%Y') Fecha, tipofac Tipo, cod_cliente Cliente, total1 Subtotal, descuento Descuento, monto Total, iva IVA, total Monto, case anulada when 0 then 'Pagada' when 1 then 'Anulada' end 'Estado'
                    from facturas where sucursal='".$bodega."' and (numero like '%".$filtro1."%' or cod_cliente like '%".$filtro1."%') order by fechafac DESC";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}




function dat_obtener_num_facturas_filtro($bodega,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    
    $sentencia="select count(*) from facturas where sucursal='".$bodega."' and fechafac>=str_to_date('$filtro1','%d-%m-%Y') and fechafac<=str_to_date('$filtro2','%d-%m-%Y')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_cuotaapagar_cliente($bodega,$cliente)
{
    global $parametros , $conexion ;
 if($bodega=="" or $bodega==0)
   {
     $bodega=$_SESSION["idBodega"];
   }

    $sentencia="select valorplan, morahoy from clientes where sucursal='".$bodega."' and cod_cliente='".$cliente."'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_periodoapagar_cliente($bodega,$cliente)
{
    global $parametros , $conexion ;
 if($bodega=="" or $bodega==0)
   {
     $bodega=$_SESSION["idBodega"];
   }
    $pagado="1";
    $sentencia="select fechaini,fechafin,mesnpagar,mespagar,abonos from periodos where sucursal='".$bodega."' and cod_cliente='".$cliente."' and pagado!='".$pagado."'";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}
function dat_obtener_motianu_cmb()
{
	global $parametros , $conexion ;
	$sentencia = "select codigo 'Codigo',nombre 'Nombre' FROM motianu";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_datos_cliente($xxcliente,$bodx)
{
global $parametros , $conexion ;
    $sentencia = "select nmuni,ncan,nbar,ncase,calle,ave,pasaje,poligono,blocke,casa,otraref from clientes where cod_cliente='$xxcliente' and sucursal='$bodx'";
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}



?>