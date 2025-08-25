<?php
    require_once("./logica/log_reportes.php");
    $resultado=log_obtener_mov_salidas($_GET['fecha'],$_GET['proy'],$_GET['bod']);
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
<table cellspacing="0" class="Tabla1" style="position:absolute;left:3px;top:1px'.$alturaTabla.'px;width:1100px;">
 <tr>
 </tr>';    
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
  if($xtipoa=="1" or $xtipoa=="3")    
  {
        $ntipoa=Null;
        $ntipob=Null;
        if($xtipoa=='1')
         {
          $ntipoa="X";
          $ntipob="";        
         }
        if($xtipoa=='3')
         {
          $ntipob="X";        
          $ntipoa="";        
         }


  if($cuentavales==1)
   {
   //buscando datos del detalle de la salida
   $xpartida="";
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];
      
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
   
   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;
     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;
     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;
     }
    }
   }
   }

   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:3px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:310px;top:20px;width:50px;height:45px;font-size:24px">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:120px;top:100px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:3px;top:110px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:290px;top:110px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:325px;top:110px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:120px;top:120px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:3px;top:160px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:3px;top:190px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:240px;top:190px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:3px;top:220px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:240px;top:220px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:3px;top:250px;width:400px;height:37px;font-size:24px">'.$xnsubpartida.'</td>
    <td style="position:absolute;left:3px;top:280px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:1px;top:310px;width:405px;height:37px">_________________________________________________________________________</td>
    <td class="FilaN" style="position:absolute;left:1px;top:330px;width:90px;height:37px;font-size:24px">Codigo</td>
    <td class="FilaN" style="position:absolute;left:90px;top:330px;width:150px;height:37px;font-size:24px">Despachado</td>
    <td class="FilaN" style="position:absolute;left:225px;top:330px;width:275px;height:37px;font-size:24px">Descripcion</td>
    <td class="FilaNF" style="position:absolute;left:475px;top:330px;width:100px;height:37px;font-size:24px">Precio $</td>
    <td class="FilaN" style="position:absolute;left:1px;top:370px;width:90px;height:37px;font-size:24px">'.$xarti.'</td>
    <td class="FilaN" style="position:absolute;left:90px;top:370px;width:150px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td class="FilaN" style="position:absolute;left:225px;top:370px;width:275px;height:37px;font-size:24px;text-align:left">'.$xnomarti.'</td>
    <td class="FilaNF" style="position:absolute;left:475px;top:370px;width:100px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:3px;top:440px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:360px;top:470px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>
   </tr>';


  }         
  //segundo vale
  if($cuentavales==2)
   {
   //buscando datos del detalle de la salida
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];

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

   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }


   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:610px;top:10px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:920px;top:20px;width:50px;height:45px;font-size:24px">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:730px;top:100px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:610px;top:110px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:900px;top:110px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:940px;top:110px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:730px;top:120px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:610px;top:160px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:610px;top:190px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:850px;top:190px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:610px;top:220px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:850px;top:220px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:610px;top:250px;width:400px;height:37px;font-size:24px">'.$xnsubpartida.'</td>
    <td style="position:absolute;left:610px;top:280px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:610px;top:310px;width:400px;height:37px;">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:340px;width:400px;height:37px;font-size:24px">Codigo</td>
    <td style="position:absolute;left:690px;top:340px;width:400px;height:37px;font-size:24px">Despachado</td>
    <td style="position:absolute;left:840px;top:340px;width:400px;height:37px;font-size:24px">Descripcion</td>
    <td style="position:absolute;left:1060px;top:340px;width:400px;height:37px;font-size:24px">Precio $</td>
    <td style="position:absolute;left:610px;top:370px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:390px;width:40px;height:37px;font-size:24px">'.$xarti.'</td>
    <td style="position:absolute;left:720px;top:390px;width:40px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td style="position:absolute;left:840px;top:390px;width:150px;height:37px;font-size:24px">'.$xnomarti.'</td>
    <td style="position:absolute;left:1070px;top:390px;width:40px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:610px;top:420px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:440px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:960px;top:470px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>

   </tr>';
  }
  //TERCER VALE
  if($cuentavales==3)
   {
   //buscando datos del detalle de la salida
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];

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

   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }


   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:3px;top:530px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:310px;top:540px;width:50px;height:45px;font-size:24px">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:120px;top:580px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:3px;top:590px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:290px;top:590px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:325px;top:590px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:120px;top:600px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:3px;top:650px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:3px;top:680px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:240px;top:680px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:3px;top:710px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:240px;top:710px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:3px;top:740px;width:400px;height:37px;font-size:24px">Subpartida:'.$xnsubpartida.'</td>
    <td style="position:absolute;left:3px;top:770px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:3px;top:790px;width:400px;height:37px">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:820px;width:400px;height:37px;font-size:24px">Codigo</td>
    <td style="position:absolute;left:95px;top:820px;width:400px;height:37px;font-size:24px">Despachado</td>
    <td style="position:absolute;left:240px;top:820px;width:400px;height:37px;font-size:24px">Descripcion</td>
    <td style="position:absolute;left:500px;top:820px;width:400px;height:37px;font-size:24px">Precio $</td>
    <td style="position:absolute;left:3px;top:870px;width:400px;height:37px;">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:900px;width:40px;height:37px;font-size:24px">'.$xarti.'</td>
    <td style="position:absolute;left:120px;top:900px;width:40px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td style="position:absolute;left:240px;top:900px;width:150px;height:37px;font-size:24px">'.$xnomarti.'</td>
    <td style="position:absolute;left:520px;top:900px;width:40px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:3px;top:920px;width:400px;height:37px;">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:940px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:360px;top:980px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>

   </tr>';
  }         

  //CUARTO vale
  if($cuentavales==4)
   {
   //buscando datos del detalle de la salida
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida,idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];

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

   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }


   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:610px;top:530px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:920px;top:540px;width:50px;height:45px;font-size:24px">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:730px;top:580px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:610px;top:590px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:900px;top:590px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:940px;top:590px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:730px;top:600px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:610px;top:650px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:610px;top:680px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:850px;top:680px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:610px;top:710px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:850px;top:710px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:610px;top:740px;width:400px;height:37px;font-size:24px">'.$xnsubpartida.'</td>
    <td style="position:absolute;left:610px;top:770px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:610px;top:790px;width:400px;height:37px;">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:820px;width:400px;height:37px;font-size:24px">Codigo</td>
    <td style="position:absolute;left:690px;top:820px;width:400px;height:37px;font-size:24px">Despachado</td>
    <td style="position:absolute;left:840px;top:820px;width:400px;height:37px;font-size:24px">Descripcion</td>
    <td style="position:absolute;left:1060px;top:820px;width:400px;height:37px;font-size:24px">Precio $</td>
    <td style="position:absolute;left:610px;top:870px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:900px;width:40px;height:37px;font-size:24px">'.$xarti.'</td>
    <td style="position:absolute;left:720px;top:900px;width:40px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td style="position:absolute;left:840px;top:900px;width:150px;height:37px;font-size:24px">'.$xnomarti.'</td>
    <td style="position:absolute;left:1070px;top:900px;width:40px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:610px;top:920px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:940px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:960px;top:980px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>

   </tr>';
  }         
  //TERCER VALE
  if($cuentavales==5)
   {
   //buscando datos del detalle de la salida
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida, idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];

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

   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }


   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:3px;top:1040px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:310px;top:1050px;width:50px;height:45px;font-size:24px">Fecha:'.$fila['fecha'].'</td>
    <td style="position:absolute;left:120px;top:1100px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:3px;top:1110px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:290px;top:1110px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:325px;top:1110px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:120px;top:1120px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:3px;top:1160px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:3px;top:1190px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:240px;top:1190px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:3px;top:1220px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:240px;top:1220px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:3px;top:1250px;width:400px;height:37px;font-size:24px">'.$xnsubpartida.'</td>
    <td style="position:absolute;left:3px;top:1280px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:3px;top:1310px;width:400px;height:37px">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:1330px;width:400px;height:37px;font-size:24px">Codigo</td>
    <td style="position:absolute;left:95px;top:1330px;width:400px;height:37px;font-size:24px">Despachado</td>
    <td style="position:absolute;left:240px;top:1330px;width:400px;height:37px;font-size:24px">Descripcion</td>
    <td style="position:absolute;left:500px;top:1330px;width:400px;height:37px;font-size:24px">Precio $</td>
    <td style="position:absolute;left:3px;top:1360px;width:400px;height:37px;">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:1390px;width:40px;height:37px;font-size:24px">'.$xarti.'</td>
    <td style="position:absolute;left:120px;top:1390px;width:40px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td style="position:absolute;left:240px;top:1390px;width:150px;height:37px;font-size:24px">'.$xnomarti.'</td>
    <td style="position:absolute;left:520px;top:1390px;width:40px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:3px;top:1420px;width:400px;height:37px;">________________________________________________________________________</td>
    <td style="position:absolute;left:3px;top:1450px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:360px;top:1480px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>

   </tr>';
  
  }         

  //SEXTO vale
  if($cuentavales==6)
   {
   //buscando datos del detalle de la salida
   $xequipo="";
   $xpartida="";
   $xsubpartida="";
   $xsubpartida_a="";
   $xsubpartida_b="";
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
   $cod_salida=$fila['codigo_salida'];
   $sentencia2 = "select idpartida,idsubpartida, idsubpartida_a, idsubpartida_b,idarticulo, codigo_equipo,cantidad,precio_unit,utilizar_en FROM salidas_deta where idbodega='".$cod_bodega."' and codigo_salida='".$cod_salida."'"; 
   $resultado2 = mysql_query($sentencia2);
   if(isset($resultado2))
    {
     if(mysql_num_rows ( $resultado2 )!=0)
     {
      $row=mysql_fetch_array($resultado2);
      $xequipo=$row['codigo_equipo'];
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
      $xsubpartida_a=$row['idsubpartida_a'];
      $xsubpartida_b=$row['idsubpartida_b'];
      $xarti=$row['idarticulo'];
      $xcanti1=$row['cantidad'];
      $xcanti=number_format($xcanti1, 2, ".", ",");
      $xprecio1=$row['precio_unit'];
      $xprecio=number_format($xprecio1, 2, ".", ",");
      $xutilen=$row['utilizar_en'];

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

   $rr=1;
   if($rr==1)
   {
   if($xsubpartida_b!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_b where idsubpartida_b='".$xsubpartida_b."' and idsubpartida_a='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }

   if($rr==1)
   {
   if($xsubpartida_a!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas_a where idsubpartida_A='".$xsubpartida_a."' and idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }
  
   if($rr==1)
   {
   if($xsubpartida!="")
   {
   $sentencia6 = "select Nombre FROM subpartidas where idsubpartida='".$xsubpartida."' and idpartida='".$xpartida."' and idproyecto='".$xobra."' and iddivision='".$xdivis."'"; 
   $resultado6 = mysql_query($sentencia6);
   if(isset($resultado6))
    {
     if(mysql_num_rows ( $resultado6 )!=0)
     {
      $row6=mysql_fetch_array($resultado6);
      $xnsubpartida=$row6['Nombre'];
      $rr=0;

     }
    }
   }
   }


   $sentencia7 = "select Nombre FROM equipos where codigo_equipo='".$xequipo."'"; 
   $resultado7 = mysql_query($sentencia7);
   if(isset($resultado7))
    {
     if(mysql_num_rows ( $resultado7 )!=0)
     {
      $row7=mysql_fetch_array($resultado7);
      $xnequipo=$row7['Nombre'];
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
    <td style="position:absolute;left:610px;top:1040px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    <td style="position:absolute;left:920px;top:1050px;width:50px;height:45px;font-size:24px">Fecha:'.$fecha.'</td>
    <td style="position:absolute;left:730px;top:1100px;width:400px;height:37px;font-size:24px">Materiales--:'.$ntipoa.'</td>
    <td style="position:absolute;left:610px;top:1110px;width:400px;height:37px;font-size:24px">Vale Retiro</td>
    <td style="position:absolute;left:900px;top:1110px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:940px;top:1110px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    <td style="position:absolute;left:730px;top:1120px;width:400px;height:37px;font-size:24px">Repuestos--:'.$ntipob.'</td>
    <td style="position:absolute;left:610px;top:1160px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    <td style="position:absolute;left:610px;top:1190px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:850px;top:1190px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    <td style="position:absolute;left:610px;top:1220px;width:400px;height:37px;font-size:24px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:850px;top:1220px;width:400px;height:37px;font-size:24px">Sub Partida:'.$xsubpartida.'</td>
    <td style="position:absolute;left:610px;top:1250px;width:400px;height:37px;font-size:24px">'.$xnsubpartida.'</td>
    <td style="position:absolute;left:610px;top:1280px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    <td style="position:absolute;left:610px;top:1310px;width:400px;height:37px;">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:1330px;width:400px;height:37px;font-size:24px">Codigo</td>
    <td style="position:absolute;left:690px;top:1330px;width:400px;height:37px;font-size:24px">Despachado</td>
    <td style="position:absolute;left:840px;top:1330px;width:400px;height:37px;font-size:24px">Descripcion</td>
    <td style="position:absolute;left:1060px;top:1330px;width:400px;height:37px;font-size:24px">Precio $</td>
    <td style="position:absolute;left:610px;top:1360px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:1390px;width:40px;height:37px;font-size:24px">'.$xarti.'</td>
    <td style="position:absolute;left:720px;top:1390px;width:40px;height:37px;font-size:24px">'.$xcanti.'</td>
    <td style="position:absolute;left:840px;top:1390px;width:150px;height:37px;font-size:24px">'.$xnomarti.'</td>
    <td style="position:absolute;left:1070px;top:1390px;width:40px;height:37px;font-size:24px">'.$xprecio.'</td>
    <td style="position:absolute;left:610px;top:1420px;width:400px;height:37px">__________________________________________________________________</td>
    <td style="position:absolute;left:610px;top:1450px;width:200px;height:37px;font-size:24px">A utilizar en:'.$xutilen.'</td>
    <td style="position:absolute;left:960px;top:1480px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>

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