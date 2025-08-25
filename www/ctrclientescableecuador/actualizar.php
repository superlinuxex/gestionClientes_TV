<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>SICCAE- Proceso de actualizacion de tablas</title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />
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
							<h3 class="title">Actualizando</a></h3>
							<div class="entry">
								<div id="itsthetable">
			                                	<?php

////////PARA ACTUALIZAR planes de clientes
////////renta mensual
//$sentencia="UPDATE clientes SET valorplan=214.00 where ttplan='101101011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
/////////////////internet domestico
//$sentencia="UPDATE clientes SET valorplan=540.00 where ttplan='203201011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
/////////internet comercial
//$sentencia="UPDATE clientes SET valorplan=956.00 where ttplan='303301011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());

///////plan renta mensual
//$sentencia="UPDATE planes SET costo=214.00 where cod_plan='101101011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
//internet domestico
//$sentencia="UPDATE planes SET costo=540.00 where cod_plan='203201011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
//internet comercial
//$sentencia="UPDATE planes SET costo=956.00 where cod_plan='303301011'";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());

//$sentencia="UPDATE periodos SET cod=cod_cliente";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
//$sentencia="UPDATE activi SET cod=cod_cliente";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());
//$sentencia="UPDATE clientes SET cod=cod_cliente";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());


//despues de crear un campo ID autoincremental en la tabla de clientes hacemos lo siguiente
$sentencia="UPDATE clientes SET clientes.cod_cliente=clientes.id";
$resultado = mysql_query($sentencia) OR die(mysql_error());

/////////VERIFICANDO NOMBRES REPETIDOS Y ELIMINANDO EL DUPLICADO
 $blanco='';
 $sentencia="update clientes set cod='".$blanco."'";
 $resultado = mysql_query($sentencia) OR die(mysql_error());

  $sentencia66 = "select cod_cliente,nombre,apellido,count(*) from clientes group by nombre,apellido having count(*)>1";
  $resultadofin = mysql_query($sentencia66) OR die(mysql_error());
  if(isset($resultadofin))
   {
  	    if( mysql_num_rows($resultadofin)!=0)
	      {
	        while ( $filad = mysql_fetch_array($resultadofin))
		 {
                  $xxcod=$filad['cod_cliente'];
	          $sentencia="update clientes set cod='A' where cod_cliente='".$xxcod."'";
                  $resultado = mysql_query($sentencia) OR die(mysql_error());
                 }
               }
   }
                  $xxcoda='A';
	          $sentencia="DELETE from clientes where cod='".$xxcoda."'";
                  $resultado = mysql_query($sentencia) OR die(mysql_error());


//poniendo un correlativo a los clientes NUEVAMENTE PARA CUBRIR LOS ESPACIOS BORRADOS POR DUPLICADOS Y CREANDO LOS MOVIMIENTOS DE PERIODOS Y ACTIVIDADES TECNICAS
$sentencia66 = "delete from activi";
$resultadofin = mysql_query($sentencia66) OR die(mysql_error());
$sentencia66 = "delete from periodos";
$resultadofin = mysql_query($sentencia66) OR die(mysql_error());

$a="CLIENTES";
$inicio=0;
$bode="1";
$sentencia2="update correla2 set numero='".$inicio."' where codigo='".$a."'";
$resultado2 = mysql_query($sentencia2);

$b="TICKET";
$sentencia="update correla2 set numero='".$inicio."' where codigo='".$b."'";
$resultadok = mysql_query($sentencia);


  $sentencia66 = "select * FROM clientes "; 
  $resultadofin = mysql_query($sentencia66) OR die(mysql_error());
  if(isset($resultadofin))
   {
  	    if( mysql_num_rows($resultadofin)!=0)
	      {
                $numero=1;
	        while ( $filad = mysql_fetch_array($resultadofin))
		 {
		  $xnombre=$filad['nombre'];
		  $xapellido=$filad['apellido'];
                  $xcodigo=$filad['cod_cliente'];
                  $ncliente=$xnombre.' '.$xapellido;
                  $tecni=$filad['cod_vende'];
                  $finstal=$filad['fechaip'];
                  $fechainicial=$filad['ulfepago1'];
                  $fechafinal=$filad['ulfepago2'];
	          $sentencia="UPDATE clientes SET cod_cliente='".$numero."' where nombre='".$xnombre."' and apellido='".$xapellido."'";
                  $resultado = mysql_query($sentencia) OR die(mysql_error());

		  //actualizando correlativo de clientes
                  $sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$a."'";
		  $resultado2 = mysql_query($sentencia2);

		  //actualizando correlativo de movimientos
                  $sentencia2="update correla2 set numero=numero+1 where agencia='".$bode."' and codigo='".$b."'";
		  $resultado2 = mysql_query($sentencia2);

		  //Buscando el nombre de la actividad
		  $ntarea="";
		  $norden=0;
		  $tconexion="999";
		  $sentencia = "select nom_servi,orden from servicios where codservi='".$tconexion."'";  
		  $resultadol = mysql_query($sentencia);
		  if(mysql_num_rows ( $resultadol )!=0)
                   {
                    $filaz=mysql_fetch_array($resultadol);
                    $ntarea=$filaz['nom_servi'];
                    $norden=$filaz['orden'];
                   }

		  //Buscando empleado
		  $nempleado="";
                  $templeado=$tecni;
		  $sentencia = "select nombre,apellido from empleados where cod_emple='".$templeado."'";  
		  $resultadol2 = mysql_query($sentencia);
 	          if(mysql_num_rows ( $resultadol2 )!=0)
		  {
		    $filaz=mysql_fetch_array($resultadol2);
		    $nempleado=$filaz['nombre']." ".$filaz['apellido'];
		  }

			$fechar=$finstal;
			$xtarea="Instalacion del servicio"; 
			$codigomov=$numero;
		        $sentencia="select movimiento nmov FROM activi where sucursal='".$bode."' and movimiento='".$codigomov."'";
			$resultadoj = mysql_query($sentencia);
			if(mysql_num_rows ( $resultadoj )!=0)
			     {
			      $elresultado=1;
			     }
				else
			     {
			      $elresultado=0;
			     }
			     if($elresultado==0)
			     {
				    $sentencia = "insert into activi (movimiento,ordentr,fechasoli,fecha,fechareali,tarea,cod_emple,nomemple,cod_cliente,nomclie,sucursal,fechareg,codservi,nomservi,orden)  
    					VALUES ('".$numero."','".$numero."','".$fechar."','".$fechar."','".$fechar."','".$xtarea."','".$templeado."','".$nempleado."','".$numero."','".$ncliente."','".$bode."',now(),'".$tconexion."','".$xtarea."','".$numero."')";
					$resultadoy = mysql_query($sentencia);
                             }
   //Actualizando el registro de programacion de pagos
   //iniciando el registro de periodos
   $fecha1=$fechainicial;
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

    $xfechafincli=strval($c3)."-".strval($c2)."-".strval($c1);

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
    //Creamos el nuevo periodo de arranque de los periodos del cliente
    $sentencia = "insert into periodos (cod_cliente,fechaini,fechafin,mespagar,mesnpagar,sucursal,fechareg,pagado)  
					VALUES ('".$numero."','".$xfechaini."','".$xfechafin."','".$xmespagar."','".$xmesnpagar."','".$bode."',now(),'".$xpagado."')";
    $resultadoQ = mysql_query($sentencia);

                  $numero=$numero+1;
                 }
               }
	}






//PARA ACTUALIZAR DEPTOS, MUNI,  ETC DEL CLIENTE
//$sentencia="UPDATE clientes SET ncase=(SELECT caserio.nombrecaserio FROM caserio where clientes.cod_depto = caserio.cod_depto and clientes.cod_ciudad = caserio.cod_ciudad and clientes.cod_canton = caserio.cod_canton and clientes.cod_barrio = caserio.cod_barrio and clientes.cod_caserio = caserio.cod_caserio)";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());

//$sentencia="UPDATE clientes SET ulfepago2=(SELECT periodos.fechaini FROM periodos where clientes.sucursal=periodos.sucursal and clientes.cod_cliente = periodos.cod_cliente and periodos.pagado=0), ulfepago1=date('Y-m-d',(strtotime(substr(ulfepago2,0,3).'-'.(intval(substr(ulfepago2,5,2))-1).'-'.substr(ulfepago2,8,2))) where sucursal=1 and estatus=1";
//$resultado2 = mysql_query($sentencia) or die($sentencia.mysql_error());

//          $sentencia66 = "select * FROM clientes where estatus=1 and sucursal=4"; 
//          $resultadofin = mysql_query($sentencia66) OR die(mysql_error());
//          if(isset($resultadofin))
//	  {
//   	    if( mysql_num_rows($resultadofin)!=0)
//	      {
//	        while ( $filad = mysql_fetch_array($resultadofin))
//		 {
//		  $xcliente=$filad['cod_cliente'];
  //                $sentencia661 = "select * FROM periodos where cod_cliente='".$xcliente."' and sucursal=4 and pagado=0"; 
//	          $resultadofin2 = mysql_query($sentencia661) OR die(mysql_error());
//	          if(isset($resultadofin2))
//		  {
//   		    if( mysql_num_rows($resultadofin2)!=0)
//                      {
//                      $row=mysql_fetch_array($resultadofin2);
//		      $fecha2=$row['fechaini'];
//                      $fecha1=substr($fecha2,0,4)."-".(intval(substr($fecha2,5,2))-1)."-".substr($fecha2,8,2);
//  		      $sentencia="UPDATE clientes SET ulfepago2='".$fecha2."',ulfepago1='".$fecha1."' where cod_cliente='".$xcliente."' and sucursal=4";
//                      $resultado = mysql_query($sentencia) OR die(mysql_error());
//                     }
//	      	  }
//                 }
//               }
//	}




										//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
										//exit;    



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
		<p>Todos los derechos reservados  Desarrollo Erving Chamagua, 2013</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
