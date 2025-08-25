<?php
require "dat_base.php";  

function dat_obtener_actitecni($bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select substr(a.movimiento,1,6) Ticket, a.nomservi Actividad,a.tarea Detalles, substr(a.ordentr,1,11) 'Orden Trabajo',substr(a.cod_cliente,1,7) 'Cliente', a.nomclie 'Nombre del cliente', a.fechasoli Solicitado, a.fecha Programado, a.fechareali Realizado, a.fecharepro Reprogramado
          FROM activi a where a.sucursal='".$bodega."' order by a.fechasoli DESC LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_listamateriales($clie,$bodega,$comienzo, $cant)
{
	global $parametros , $conexion ;
    $sentencia = "select a.numero Factura, a.fechafac Fecha,a.concepto Concepto, a.cantidad Cantidad, precio Precio, total Total 
          FROM detafac a where a.sucursal='".$bodega."' and cod_cliente='".$clie."' LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_actitecni_filtro($bodega,$comienzo, $cant, $filtro)
{
	global $parametros , $conexion ;
    $sentencia = "select substr(a.movimiento,1,6) Ticket, a.nomservi Actividad,a.tarea Detalles, substr(a.ordentr,1,11) 'Orden Trabajo',substr(a.cod_cliente,1,7) 'Cliente', a.nomclie 'Nombre del cliente', a.fechasoli Solicitado, a.fecha Programado, a.fechareali Realizado, a.fecharepro Reprogramado
          FROM activi a where a.sucursal='".$bodega."' and
		  (a.ordentr like '%".$filtro."%' or a.cod_cliente like '%".$filtro."%')
          order by a.fechasoli DESC LIMIT $comienzo, $cant"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_actitecni2($id,$bodega)
{
global $parametros , $conexion ;

    $sentencia = "select a.movimiento Nt, a.ordentr Ot, a.cod_cliente Codigo, a.nomclie Nombre, a.codservi Tconexion,a.tarea Detalles,a.fecha Fecha,a.cod_emple Tecnico, fecharepro Fecharepro, fechareali Fechaeje, observa Observa, tecnireali Tecnicor,georeferencia Mgeo, longilati Mlongilati,cone Mcone,marcha Mmarcha,poste Mposte,zona Mzona, poligono Mpoligono, comentario Comentario
          FROM activi a where a.sucursal='".$bodega."' and a.movimiento='$id'"; 
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_num_actitecni($bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM activi where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}

function dat_obtener_num_listamateriales($clie,$bodega)
{
	global $parametros , $conexion ;
    $sentencia = "SELECT COUNT(*) FROM cambiopl where sucursal='".$bodega."' and cod_cliente='".$clie."'";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_obtener_num_actitecni_filtro($bodega,$filtro)
{
	global $parametros , $conexion ;
	//obtine total de registros de la tabla identificacion de clientes
    $sentencia = "SELECT COUNT(*) FROM activi where sucursal='".$bodega."' and (movimiento like '%".$filtro."%' or cod_cliente like '%".$filtro."%')";  
    $resultado = mysql_query($sentencia);
	$total_registros = mysql_result($resultado,0,0);
    return $total_registros;
	exit;
}


function dat_insertar_actitecni($datos,$bode,$usuario)
{
global $parametros , $conexion ;

//obteniendo un correlativo para codigo de ticket
$nummovi=0;
$codigomov="TICKET";
$sentencia="select numero id FROM correla2 where agencia='".$bode."' and codigo='".$codigomov."'";
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
$sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

//Buscando el nombre de la actividad
$ntarea="";
$norden=0;
$tconexion=$datos['Tconexion'];
$sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ntarea=$filaz['nom_servi'];
    $norden=$filaz['orden'];
  }

//Buscando empleado
$nempleado="";
$templeado=$datos['Tecnico'];
$sentencia = "select nombre,apellido from empleados where cod_emple='".$templeado."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $nempleado=$filaz['nombre']." ".$filaz['apellido'];
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
$tcliente=$datos['Cliente'];
$sentencia = "select * from clientes where cod_cliente='".$tcliente."' and sucursal='".$bode."'";  
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



$fecha1=$datos['Fecha'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
 
    $codigomov=$nummovi;
    $sentencia="select movimiento nmov FROM activi where sucursal='".$bode."' and movimiento='".$codigomov."'";
    $resultado = mysql_query($sentencia);
    if(mysql_num_rows ( $resultado )!=0)
     {
      $elresultado=1;
     }
	else
     {
      $elresultado=0;
     }
     if($elresultado==0)
     {
    $sentencia = "insert into activi (movimiento,ordentr,fechasoli,fecha,tarea,cod_emple,nomemple,cod_cliente,nomclie,idusuarios,sucursal,fechareg,codservi,nomservi,direclie,orden)  
    					VALUES ('".$nummovi."','".$datos['Nummovi2']."','".$fecha."','".$fecha."','".$datos['Detalles']."','".$datos['Tecnico']."','".$nempleado."','".$datos['Cliente']."','".$ncliente."','".$usuario."','".$bode."',now(),'".$datos['Tconexion']."','".$ntarea."','".$direccion."','".$norden."')";
    $resultado = mysql_query($sentencia);
     }
     else
     {
      $resultado=0;      
     }

	return $resultado;
	exit;
}


function dat_eliminar_actitecni($id,$bodega)
{
global $parametros , $conexion ;
      $sentencia = "delete from  activi where sucursal='".$bodega."' and movimiento='$id'";  
      $resultado = mysql_query($sentencia);
	return $resultado;
	exit;
}



function dat_actualizar_actitecni($datos, $id,$bodega)
{
global $parametros , $conexion ;

//Buscando empleado
$nempleado="";
$templeado=$datos['Tecnico'];
$sentencia = "select nombre,apellido from empleados where cod_emple='".$templeado."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $nempleado=$filaz['nombre']." ".$filaz['apellido'];
  }

$fecha1=$datos['Fecha'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);



$sentencia = "update activi SET fecha='".$fecha."',ordentr='".$datos['Ot']."',tarea='".$datos['Detalles']."',cod_emple='".$templeado."',nomemple='".$nempleado."',fechamod=now(),usuariom='".$_SESSION["idusuario"]."'
			          WHERE sucursal='".$bodega."' and movimiento= '$id';";  
        $resultado = mysql_query($sentencia);
	echo mysql_error($conexion);
	return $resultado;
	exit;
}

function dat_reprogramar_actitecni($datos, $id,$bodega)
{
global $parametros , $conexion ;

$resultado=0;

$fecha1=$datos['Fecharepro'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

if(intval(substr($fecha1,6,4))>2012)
{
 $sentencia = "update activi SET fecharepro='".$fecha."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
 $resultado = mysql_query($sentencia);
 echo mysql_error($conexion);
}
 return $resultado;
 exit;
}


function dat_ejecutar_actitecni($datos, $id,$bodega)
{
global $parametros , $conexion ;

$resultado=0;
//buscando el valor de la cuota que paga el cliente para calcularle el monto de mora si es actividad de desconexion
$xmorahoy=0;
$xpaga=1;
$sentencia = "select valorplan,morahoy from clientes WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $fila5=mysql_fetch_array($resultado);
    $xpaga=$fila5['valorplan'];
    $xmorahoy=$fila5['morahoy'];
  }

$fecha1=$datos['Fechaeje'];
$fecha=substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

//Buscando tipo de servicio para ver si es conexion o desconexion

$xmotides="";
$ntiposervi="";
$sentencia = "select codservi,codigomot from activi WHERE sucursal='".$bodega."' and movimiento= '$id';";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $ntiposervi=$filaz['codservi'];
    $xmotides=$filaz['codigomot'];
  }

$servicone="";
$sentencia = "select conectacl from servicios WHERE codservi='".$ntiposervi."'";  
$resultado = mysql_query($sentencia);
if(mysql_num_rows ( $resultado )!=0)
  {
    $filaz=mysql_fetch_array($resultado);
    $servicone=$filaz['conectacl'];
  }

if($xmorahoy>0 and $servicone==1)
  {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	Imposible ejecutar esta actividad, el cliente tiene una mora pendiente y usted esta intentando conectarlo
	</div>';
	exit;
  }






//si SERVICONE es 1, estamos hablando de una conexion o reconexion de servicio, si SERVICONE es un 0, estamos hablando de una desconexion.

if(intval(substr($fecha1,6,4))>2017)
{
 $sentencia = "update activi SET fechareali='".$fecha."',observa='".$datos['Observa']."',tecnireali='".$datos['Tecnicor']."',cone='".$datos['Mcone']."',poste='".$datos['Mposte']."',longilati='".$datos['Mlongilati']."',marcha='".$datos['Mmarcha']."',georeferencia='".$datos['Mgeo']."',zona='".$datos['Mzona']."',poligono='".$datos['Mpoligono']."' WHERE sucursal='".$bodega."' and movimiento= '$id';";  
 $resultado = mysql_query($sentencia);
 echo mysql_error($conexion);
 
 //actualizando lo datos del cliente que recibe el servicio
 
 if($datos['Mposte']!="")
  {
   $sentencia2 = "update clientes SET poste='".$datos['Mposte']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }


 if($datos['Mmarcha']!="")
  {
   $sentencia2 = "update clientes SET marcha='".$datos['Mmarcha']."' WHERE sucursal='".$bodega."' and cod_cliente='".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
  }





 //actualizando datos SI ES ACTIVIDAD DE CONEXION DE SERVICIO
 if($servicone=="1")   
  {
   $estatus="1";
   $sentencia2 = "update clientes SET fechaip='".$fecha."',estatus='".$estatus."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
   $resultado2 = mysql_query($sentencia2);
   //iniciando el registro de periodos
   $xfechaini=$fecha;
   $b1=intval(substr($fecha1,0,2));
   $b2=intval(substr($fecha1,3,2));
   $b3=intval(substr($fecha1,6,4));
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


    //*****cambio solo para Joel de Mexico
    $c2mas=$c2;
    $c3mas=$c3;
    if($c2>=12)
       {
        $c2mas="1";
        $c3mas=$c3+1;
       }
       else
       {
        $c2mas=$c2+1;
        $c3mas=$c3;
       }


    $xfechaini=strval($c3)."-".strval($c2)."-"."01";
    $xfechafin=strval($c3mas)."-".strval($c2mas)."-"."01";
    $xmespagar=$c2;

 
    //si la instalacion es del tipo RECONEXION
    $xntiposervi=intval($ntiposervi);
    $b2x1=intval(substr($fecha,6,2));
    $b3x1=intval(substr($fecha,0,4));
    $xdia="28";
    if($b2x1==12) 
       {
        $b2x=1;
        $b3x=$b3x1+1;
       }
       else
       {
        $b2x=$b2x1+1;
        $b3x=$b3x1;
       }

      //calculando el mes anterior
    if($b2x1==1) 
       {
        $b2xx=12;
        $b3xx=$b3x1-1;
       }
       else
       {
        $b2xx=$b2x1-1;
        $b3xx=$b3x1;
       }


    if($xntiposervi==4 OR $xntiposervi==12)    
     {
      if($b2x==1)
       {
        $xdia="31";
       }
      if($b2x==2)
       {
        $xdia="28";
       }
      if($b2x==3)
       {
        $xdia="31";
       }
      if($b2x==4)
       {
        $xdia="30";
       }
      if($b2x==5)
       {
        $xdia="31";
       }
      if($b2x==6)
       {
        $xdia="30";
       }
      if($b2x==7)
       {
        $xdia="31";
       }
      if($b2x==8)
       {
        $xdia="31";
       }
      if($b2x==9)
       {
        $xdia="30";
       }
      if($b2x==10)
       {
        $xdia="31";
       }
      if($b2x==11)
       {
        $xdia="30";
       }
      if($b2x==12)
       {
        $xdia="31";
       }

      $xfechaini=$fecha;
      $xfechafin=strval($b3x)."-".strval($b2x)."-"."01";
      $xmespagar=$b2x1;
     }


    //**************
    

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

$xdia="01";
$xfechainicliente=strval($b3xx)."-".strval($b2xx)."-".$xdia;

    //Borramos todo historial del cliente por ser nueva conexion, nueva fecha inicial de servicio
    $sentencia = "delete from periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'; ";
    $resultadop = mysql_query($sentencia);

    $xpagado="0";
    //Creamos el nuevo periodo de arranque de los periodos del cliente
    $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,idusuarios,sucursal,fechareg,pagado)  
					VALUES ('".$datos['Codigo']."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$usuario."','".$bodega."',now(),'".$xpagado."')";
    $resultadoQ = mysql_query($sentencia);
    
    //Actualizamos el registro del cliente 
   $xvacio='';
   $sentencia2 = "update clientes SET ulfepago1='".$xfechainicliente."',ulfepago2='".$xfechainicliente."',ulmespago='".$xvacio."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
   $resultadot = mysql_query($sentencia2);
  }




 //actualizando datos SI ES ACTIVIDAD DE DESCONEXION DE SERVICIO
if($servicone=="0")   
 {
  $estatus="0";
  $sentencia2 = "update clientes SET estatus='".$estatus."',motidesco='".$xmotides."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."';";  
  $resultado2 = mysql_query($sentencia2);
    
//Buscando dias y monto pendiente de pago
$fecha1=$datos['Fechaeje'];
$fecha2=strtotime(substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2));
$fechalimite=date('Y-m-d',$fecha2);
$xdebemeses=0;
$montodebe=0;


$fecha1=date('d-m-Y');
$fecha2=strtotime(substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2));
$fx1=date('Y-m-d',$fecha2);

 //Buscando datos en la tabla de periodos programados de pagos mensuales
 $sentencia = "select * FROM periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'"; 
 $resultadox = mysql_query($sentencia);
 if(isset($resultadox))
  {
    if(mysql_num_rows ( $resultadox )!=0)
     {
      $rowxx=mysql_fetch_array($resultadox);
      $fx1=$rowxx['fechafin'];
     }
   }


//Contando cuantos periodos debe el cliente a partir del ultimo pagado a la fecha de desconexion
 $xdebe=0;
 $sentencia = "select * FROM periodos WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'"; 
 $resultadow = mysql_query($sentencia);
 if(isset($resultadow))
  {
    if(mysql_num_rows ( $resultadow )!=0)
     {
      while ($fila = mysql_fetch_array($resultadow))
       {
        if($fila['fechafin']>=$fx1)
         {
          $fx1=$fila['fechafin'];
          $fx0=$fila['fechaini'];
          $pp=$fila['pagado'];
         }
       }


       if((intval(substr($fx0,5,2))<intval(substr($fx1,5,2))) or (intval(substr($fx0,5,2))==12 and intval(substr($fx1,5,2))==1))
       {
        if($fechalimite>=$fx1)
         {
          if($pp="1")
           {
            $xdebe=0;
           }
	    else
           {
            $xdebe=1;
	    $hulfe=$fx1;
           }

           while($fechalimite>=$fx1)
           {
	    $xdia=intval(substr($fx1,9,2));
            $xanio=intval(substr($fx1,0,4));
            $xmesante=intval(substr($fx1,5,2));
            if(intval(substr($fx1,5,2))<12)
             {
              $nif1=intval(substr($fx1,5,2))+1;
             }
              else
             {
              $nif1=1;
              $xanio=intval(substr($fx1,0,4))+1;
             }
             $xmes=$nif1;
             if($xdia==31)
             {
              $xdia="30";
             }
             if($xmes==2 and $xdia>28)
             {
              $xdia="28";
             }
             $nuevaf= strtotime($xanio."-".$xmes."-".$xdia);
             $fx1=date('Y-m-d',$nuevaf);
             if($fechalimite>=$fx1)
             {
              $xdebe=$xdebe+1;
 	      $hulfe=$fx1;
             }
           }
           if($xdebe>=1)
            {
             //Calculando mora en dias
             $xpagadia=$xpaga/30;
             $fracdias=$fechalimite-$hulfe;
             $moraendias=$fracdias*$xpagadia;
            }

         }
         //actualice en tabla de clientes 
         $morahoy=($xdebe*$xpaga)+$moraendias;
	 $sentencia2="update clientes set morahoy='".$morahoy."',fedesco='".$fechalimite."' WHERE sucursal='".$bodega."' and cod_cliente= '".$datos['Codigo']."'";
	 $resultado2 = mysql_query($sentencia2);
       }
     }
  }
   //Fin de actualizar la mora a la fecha de desconexion
    //Borramos el mes programado en periodos de pago que tenia estado de no pagado porque se esta desconectando el servicio
    $sentencia = "delete from periodos WHERE sucursal='".$bodega."' and pagado='0' and cod_cliente= '".$datos['Codigo']."'";
    $resultadop = mysql_query($sentencia);
  }
}
 return $resultado;
 exit;
}



function dat_obtener_actitecni_cmb($bodega)
{
	global $parametros , $conexion ;
	$sentencia = "select movimiento 'Ticket',nomclie 'Nombre' FROM activi where sucursal='".$bodega."'";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_obtener_actitecni_cmbZZZ()
{
	global $parametros , $conexion ;
	$sentencia = "select movimiento 'Ticket',nomclie 'Nombre' FROM activi";  
    $resultado = mysql_query($sentencia);
    return $resultado;
	exit;
}

function dat_vecodservi_actitecni($codigoservi)
{
	global $parametros , $conexion ;
	$servicone="";
	$sentencia = "select conectacl FROM servicios where codservi='".$codigoservi."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $servicone=$filaz['conectacl'];
	  }
        if($servicone=="1")
         {
          $resultadow=1;
         }
		else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}

function dat_validaconexion_actitecni($tconexion,$cliente,$bodx)
{
	global $parametros , $conexion ;
 	$xestatus="";
	$sentencia = "select estatus FROM clientes where cod_cliente='".$cliente."' and sucursal='".$bodx."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	 {
	  $filax=mysql_fetch_array($resultado);
	  $xestatus=$filax['estatus'];
	 }

	$servicone="";
	$sentencia = "select conectacl FROM servicios where codservi='".$tconexion."'";  
    	$resultado = mysql_query($sentencia);
	if(mysql_num_rows ( $resultado )!=0)
	  {
	    $filaz=mysql_fetch_array($resultado);
	    $servicone=$filaz['conectacl'];
	  }

        if($servicone=="1" and $xestatus=="1")
         {
          $resultadow=1;
         }
         else
         {
          $resultadow=0;
         }
    	return $resultadow;
	exit;
}

function dat_obtener_actitecni_filtrofec($bodega,$comienzo,$cant,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    $sentencia = "select substr(movimiento,1,6) Ticket, nomservi Actividad,tarea Detalles, substr(ordentr,1,11) 'Orden Trabajo',substr(cod_cliente,1,7) 'Cliente', nomclie 'Nombre del cliente', fechasoli Solicitado, fecha Programado, fechareali Realizado, fecharepro Reprogramado
          FROM activi  where sucursal='".$bodega."' and fechasoli>=str_to_date('$filtro1','%d-%m-%Y') and fechasoli<=str_to_date('$filtro2','%d-%m-%Y')
                    order by fechasoli DESC LIMIT $comienzo, $cant";
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}

function dat_obtener_num_actitecni_filtrofec($bodega,$filtro1,$filtro2)
{
    global $parametros , $conexion ;
$filtro1=substr($filtro1,0,2)."-".substr($filtro1,3,2)."-".substr($filtro1,6,4);
$filtro2=substr($filtro2,0,2)."-".substr($filtro2,3,2)."-".substr($filtro2,6,4);

    
    $sentencia="select count(*) from activi where sucursal='".$bodega."' and fechasoli>=str_to_date('$filtro1','%d-%m-%Y') and fechasoli<=str_to_date('$filtro2','%d-%m-%Y')";                 
    $resultado = mysql_query($sentencia);
    return $resultado;
    exit;
}



?>