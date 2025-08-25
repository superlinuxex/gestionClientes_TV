<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_mov_salidasco($_GET['fecha'],$_GET['proy'],$_GET['bod']);
	if( mysql_num_rows($resultado)==0){exit;}
	$row=mysql_fetch_array($resultado);
	$fecha=$row['fecha'];
	$cod_bodega=$row['codigo_bodega_salida'];
	mysql_data_seek($resultado, 0); 
	$alturaLinea=10;
	$alturaTabla=15;

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style type="text/css">
.Tabla1 {
	font-weight: normal;
	color: black;
	border-top: 1pt solid black;
	background-color: white;
}
.FilaNI {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-bottom: 1pt solid black;
}
.FilaN {
	font-weight: normal;
	color: black;
	text-align: center;
	border-bottom: 1pt solid black;
	border-left: 1pt solid black;
}
.FilaNF {
	font-weight: normal;
	color: black;
	text-align: right;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	padding-right:10px;
}
</style>
<title>S I C I O - Reporte de Vales de Salida </title>
</head>
<body>
<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:'.$alturaTabla.'px;width:400px;">
 <tr>
 </tr>';
 $xtipoa="";	
 $cuentavales=1;
 $xautoriza="";

 while ( $fila = mysql_fetch_array($resultado))
  {
   $xautoriza=$fila['autoriza'];
   $cod_salida=$fila['codigo_salida'];
   $sentencian = "select idarticulo FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultadon = mysql_query($sentencian);
   if(isset($resultadon))
    {
     if(mysql_num_rows ( $resultadon )!=0)
     {
      $rown=mysql_fetch_array($resultadon);
      $xartic=$rown['idarticulo'];
     }
    }
   $sentenciam = "select tipo_art FROM articulos where idarticulos='".$xartic."'"; 
   $resultadom = mysql_query($sentenciam);
   if(isset($resultadom))
    {
     if(mysql_num_rows ( $resultadom )!=0)
     {
      $rowm=mysql_fetch_array($resultadom);
      $xtipoa=$rowm['tipo_art'];
     }
    }
  if($xtipoa=="2")    
  {
  if($cuentavales==1)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xprecio=0;
   $xutilen="";
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";
   $xdestiaa="";

   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }
     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }
   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:10px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:250px;top:10px;width:50px;height:45px;">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:250px;top:60px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:275px;top:60px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:10px;top:85px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:10px;top:100px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:250px;top:100px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:10px;top:115px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:10px;top:130px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:10px;top:145px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:10px;top:150px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:165px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:75px;top:165px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:125px;top:165px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:200px;top:165px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:360px;top:165px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:10px;top:170px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:10px;top:185px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:90px;top:185px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:125px;top:185px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:180px;top:185px;width:130px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:370px;top:185px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:10px;top:210px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:225px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:250px;top:225px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:10px;top:240px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:250px;top:255px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:10px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:130px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:250px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:10px;top:285px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:130px;top:285px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:250px;top:285px;width:200px;height:37px;">AUTORIZADO</td>
   </tr>';
  }			
  //segundo vale
  if($cuentavales==2)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xnomarti="";
   $xnplaca="";
   $xprecio=0;
   $xutilen="";
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";

   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }

     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }
   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:430px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:670px;top:10px;width:50px;height:45px;">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:670px;top:60px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:695px;top:60px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:430px;top:85px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:430px;top:100px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:670px;top:100px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:430px;top:115px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:430px;top:130px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:430px;top:145px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:430px;top:150px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:165px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:490px;top:165px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:545px;top:165px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:620px;top:165px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:790px;top:165px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:430px;top:170px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:430px;top:185px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:510px;top:185px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:545px;top:185px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:605px;top:185px;width:150px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:795px;top:185px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:430px;top:210px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:225px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:670px;top:225px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:430px;top:240px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:670px;top:255px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:430px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:550px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:660px;top:270px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:430px;top:285px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:550px;top:285px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:660px;top:285px;width:200px;height:37px;">AUTORIZADO</td>


   </tr>';
  }
  //TERCER VALE
  if($cuentavales==3)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xnomarti="";
   $xprecio=0;
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";
   $xutilen="";
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }

     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }
   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:10px;top:250px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:250px;top:250px;width:50px;height:45px;">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:250px;top:300px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:275px;top:300px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:10px;top:325px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:10px;top:340px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:250px;top:340px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:10px;top:115px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:10px;top:130px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:10px;top:145px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:10px;top:390px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:405px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:75px;top:405px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:125px;top:405px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:200px;top:405px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:360px;top:405px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:10px;top:410px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:10px;top:425px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:90px;top:425px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:125px;top:425px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:180px;top:185px;width:130px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:360px;top:425px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:10px;top:450px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:465px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:250px;top:465px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:10px;top:480px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:250px;top:495px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:10px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:130px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:250px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:10px;top:525px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:130px;top:525px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:250px;top:525px;width:200px;height:37px;">AUTORIZADO</td>

   </tr>';
  }			

  //CUARTO vale
  if($cuentavales==4)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xnomarti="";
   $xprecio=0;
   $xutilen="";
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";

   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }

     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }

   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:430px;top:250px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:670px;top:250px;width:50px;height:45px;">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:670px;top:300px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:695px;top:300px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:430px;top:325px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:430px;top:340px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:670px;top:340px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:430px;top:355px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:430px;top:370px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:430px;top:385px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:430px;top:390px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:405px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:490px;top:405px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:545px;top:405px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:620px;top:405px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:780px;top:405px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:430px;top:410px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:430px;top:425px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:510px;top:425px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:545px;top:425px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:605px;top:425px;width:150px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:795px;top:425px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:430px;top:450px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:465px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:670px;top:465px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:430px;top:480px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:670px;top:495px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:430px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:550px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:660px;top:510px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:430px;top:525px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:550px;top:525px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:660px;top:525px;width:200px;height:37px;">AUTORIZADO</td>


   </tr>';
  }			
  //TERCER VALE
  if($cuentavales==5)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xnomarti="";
   $xprecio=0;
   $xutilen="";
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";

   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }

     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }

   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:10px;top:490px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:250px;top:490px;width:50px;height:45px;">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:250px;top:535px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:275px;top:515px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:10px;top:550px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:10px;top:565px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:250px;top:565px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:10px;top:115px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:10px;top:130px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:10px;top:145px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:10px;top:615px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:630px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:75px;top:630px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:125px;top:630px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:200px;top:630px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:360px;top:630px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:10px;top:635px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:10px;top:650px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:90px;top:650px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:125px;top:650px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:180px;top:185px;width:130px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:360px;top:650px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:10px;top:675px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:10px;top:690px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:565px;top:690px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:10px;top:705px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:250px;top:720px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:10px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:130px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:250px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:10px;top:750px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:130px;top:750px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:250px;top:750px;width:200px;height:37px;">AUTORIZADO</td>
   </tr>';
  }			

  //SEXTO vale
  if($cuentavales==6)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xsubpartida="";
   $xpartida="";
   $xnpartida="";
   $xnsubpartida="";
   $xobra="";
   $xnequipo="";
   $xdivis="";
   $xarti="";
   $xcant="";
   $xnomarti="";
   $xprecio=0;
   $xhora="";
   $xnomarti="";
   $xnplaca="";
   $xkilo="";
   $xhoro="";
   $xdestia="";

   $xutilen="";
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en,hora,minu,Kilometraje,horometro,destino_aceite FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xsubpartida=$row['idsubpartida'];
      $xpartida=$row['idpartida'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      $xhora1=$row['hora'];
      $xminu1=$row['minu'];
      $xhora="$xhora1".":"."$xminu1";
      $xkilo=$row['Kilometraje'];
      $xhoro=$row['horometro'];
      $xdestia=$row['destino_aceite'];
      $xdestia=$row['destino_aceite'];
      if($xdestia=="1")
      {
        $xdestiaa="Cambio";
      }
	 else
      {
        $xdestiaa="Complemento";
      }

     }
    }
    //buscando descripciones
   $sentencia3 = "select idproyecto FROM bodegas where idbodegas='".$cod_bodega."'"; 
   $resultado3 = mysql_query($sentencia3);
   if(isset($resultado3))
    {
     if(mysql_num_rows ( $resultado3 )!=0)
     {
      $row3=mysql_fetch_array($resultado3);
      $xobra=$row3['idproyecto'];
     }
    }
   $sentencia4 = "select iddivision FROM proyectos where idproyectos='".$xobra."'"; 
   $resultado4 = mysql_query($sentencia4);
   if(isset($resultado4))
    {
     if(mysql_num_rows ( $resultado4 )!=0)
     {
      $row4=mysql_fetch_array($resultado4);
      $xdivis=$row4['iddivision'];
     }
    }
   $sentencia5 = "select Nombre FROM partidas where idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."' and idbodegas='".$cod_bodega."'"; 
   $resultado5 = mysql_query($sentencia5);
   if(isset($resultado5))
    {
     if(mysql_num_rows ( $resultado5 )!=0)
     {
      $row5=mysql_fetch_array($resultado5);
      $xnpartida=$row5['Nombre'];
     }
    }

   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
     }
    }

   $sentencia7 = "select Nombre,placa FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
      $xnplaca=$row7['placa'];
     }
    }

   $sentencia8 = "select descripcion FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
     }
    }
  
   echo '
   <tr>
    <td style="position:absolute;left:430px;top:490px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:670px;top:490px;width:50px;height:45px;">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:670px;top:535px;width:400px;height:37px;">No.</td>
    <td style="position:absolute;left:695px;top:535px;width:400px;height:37px;">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:430px;top:555px;width:400px;height:37px;">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:430px;top:567px;width:400px;height:37px;">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:670px;top:580px;width:400px;height:37px;">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:430px;top:580px;width:400px;height:37px;">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:430px;top:595px;width:400px;height:37px;">Placa:'.$xnplaca.'</td>
    <td style="position:absolute;left:430px;top:610px;width:400px;height:37px;">Hora:'.$xhora.'</td>
    <td style="position:absolute;left:430px;top:615px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:630px;width:400px;height:37px;">Codigo</td>
    <td style="position:absolute;left:490px;top:630px;width:400px;height:37px;">Pedido</td>
    <td style="position:absolute;left:545px;top:630px;width:400px;height:37px;">Despacho</td>
    <td style="position:absolute;left:620px;top:630px;width:400px;height:37px;">Descripcion</td>
    <td style="position:absolute;left:780px;top:630px;width:400px;height:37px;">Precio</td>
    <td style="position:absolute;left:430px;top:635px;width:400px;height:37px;">_________________________________________________</td>

    <td style="position:absolute;left:430px;top:650px;width:40px;height:37px;">'.$xarti.'</td>
    <td style="position:absolute;left:510px;top:650px;width:40px;height:37px;">'.$xcanti.'</td>
    <td style="position:absolute;left:545px;top:650px;width:40px;height:37px;">--------</td>
    <td style="position:absolute;left:605px;top:650px;width:150px;height:37px;">'.$xnomarti.'</td>
    <td style="position:absolute;left:795px;top:650px;width:40px;height:37px;">'.$xprecio.'</td>
    <td style="position:absolute;left:430px;top:675px;width:400px;height:37px;">_________________________________________________</td>
    <td style="position:absolute;left:430px;top:690px;width:200px;height:37px;">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:670px;top:690px;width:200px;height:37px;">Horometro:'.$xhoro.'</td>
    <td style="position:absolute;left:430px;top:705px;width:200px;height:37px;">Destino Aceite:'.$xdestiaa.'</td>
    <td style="position:absolute;left:670px;top:720px;width:200px;height:37px;">'.$xautoriza.'</td>
    <td style="position:absolute;left:430px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:550px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:660px;top:735px;width:200px;height:37px;">_____________</td>
    <td style="position:absolute;left:430px;top:750px;width:200px;height:37px;">ENTREGADO</td>
    <td style="position:absolute;left:550px;top:750px;width:200px;height:37px;">RECIBIDO</td>
    <td style="position:absolute;left:660px;top:750px;width:200px;height:37px;">AUTORIZADO</td>

   </tr>';
  }			
  $cuentavales=$cuentavales+1;
  }
  }
  echo'
</table>
</body>
</html>';
?>
