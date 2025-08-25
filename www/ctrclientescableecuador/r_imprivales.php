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

<style>
H1.saltodepagina
{
PAGE-BREAK-AFTER:always
}
</style>



<title>S I C I O - Reporte de Vales de Salida </title>
</head>
<body>
<table cellspacing="0" class="Tabla1" style="position:absolute;left:5px;top:1px'.$alturaTabla.'px;border:1px simple ;width:1100px;page-break-after:always">
 <tr>
 </tr>';    

 $cuentavales=1;
 $xautoriza="";
 $cuentalin=10;
 $cuentalin2=10;
 $cvppag=0;

 while ( $fila = mysql_fetch_array($resultado))
  {
   $xautoriza=$fila['autoriza'];
   $fechaimpr=substr($fecha,8,2)."-".substr($fecha,5,3).substr($fecha,0,4);
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
   $xumed="";
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
   $sentencia8 = "select descripcion,unidadmed FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
      $xumed=$row8['unidadmed'];

     }
    }

    echo '
<div style="position:absolute;left:1x;top:'.$cuentalin.'px;border:1px solid ;width:535px;height:450px;">
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:200px;height:45px;foreground-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:310px;top:'.$cuentalin.'px;width:200px;height:45px;font-size:20px">Fecha:'.$fechaimpr.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:120px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Materiales--:'.$ntipoa.'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Vale Retiro</td>
    <td style="position:absolute;left:290px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">No.</td>
    <td style="position:absolute;left:325px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">'.$fila['codigo_vale'].'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:120px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Repuestos--:'.$ntipob.'</td>
    </tr>';
    $cuentalin=$cuentalin+15;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Bodega:'.$cod_bodega.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:240px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Obra:'.$xobra.'</td>
    </tr>';
    $cuentalin=$cuentalin+18;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:240px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Sub Partida:'.$xsubpartida.'</td>
    </tr>';
    $cuentalin=$cuentalin+18;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:540px;height:37px;font-size:20px">Sub Partida_A:'.$xsubpartida_a.'</td>
    <td style="position:absolute;left:240px;top:'.$cuentalin.'px;width:540px;height:37px;font-size:20px">Sub Partida_B:'.$xsubpartida_b.'</td>
    </tr>';
    $cuentalin=$cuentalin+18;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:540px;height:37px;font-size:15px">'.$xnsubpartida.'</td>
    </tr>';
    $cuentalin=$cuentalin+100;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:20px">Equipo:'.$xnequipo.'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:405px;height:37px">__________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:5px;top:'.$cuentalin.'px;width:90px;height:37px;font-size:20px">Codigo</td>
    <td class="FilaN" style="position:absolute;left:90px;top:'.$cuentalin.'px;width:100px;height:37px;font-size:20px">Despachado</td>
    <td class="FilaN" style="position:absolute;left:190px;top:'.$cuentalin.'px;width:275px;height:37px;font-size:20px;text-align:center">Descripcion</td>
    <td class="FilaNF" style="position:absolute;left:420px;top:'.$cuentalin.'px;width:100px;height:37px;font-size:20px">Precio $</td>
    </tr>';
    $cuentalin=$cuentalin+40;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:5px;top:'.$cuentalin.'px;width:90px;height:50px;font-size:20px">'.$xarti.'</td>
    <td class="FilaN" style="position:absolute;left:90px;top:'.$cuentalin.'px;width:150px;height:50px;font-size:20px">'.$xcanti.'</td>
    <td class="FilaN" style="position:absolute;left:190px;top:'.$cuentalin.'px;width:275px;height:50px;font-size:20px;text-align:left">'.$xnomarti.'</td>
    <td class="FilaNF" style="position:absolute;left:420px;top:'.$cuentalin.'px;width:100px;height:50px;font-size:20px">'.$xprecio.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td style="position:absolute;left:100px;top:'.$cuentalin.'px;width:150px;height:37px;font-size:20px">'.$xumed.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:5px;top:'.$cuentalin.'px;width:350px;height:37px;font-size:20px">A utilizar en:'.$xutilen.'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">|'.$xautoriza.'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:20px">|</td>
</div>
    </tr>';
    $imprivalesig=2;
    $cuentalin=$cuentalin+50;
    $cvppag=$cvppag+1;

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
   $xumed="";
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
   $sentencia8 = "select descripcion,unidadmed FROM articulos where idarticulos='".$xarti."'"; 
   $resultado8 = mysql_query($sentencia8);
   if(isset($resultado8))
    {
     if(mysql_num_rows ( $resultado8 )!=0)
     {
      $row8=mysql_fetch_array($resultado8);
      $xnomarti=$row8['descripcion'];
      $xumed=$row8['unidadmed'];
     }
    }
  
    echo '
<div style="position:absolute;left:560px;top:'.$cuentalin2.'px;border:1px solid ;width:550px;height:450px;">
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:840px;top:'.$cuentalin2.'px;width:200px;height:45px;font-size:20px">Fecha:'.$fechaimpr.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:680px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Materiales--:'.$ntipoa.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Vale Retiro</td>
    <td style="position:absolute;left:850px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">No.</td>
    <td style="position:absolute;left:890px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">'.$fila['codigo_vale'].'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:680px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Repuestos--:'.$ntipob.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+15;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Bodega:'.$cod_bodega.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:810px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Obra:'.$xobra.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+18;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Partida:'.$xpartida.'</td>
    <td style="position:absolute;left:800px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Sub Partida:'.$xsubpartida.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+18;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:540px;height:37px;font-size:20px">Sub Partida_A:'.$xsubpartida_a.'</td>
    <td style="position:absolute;left:800px;top:'.$cuentalin2.'px;width:540px;height:37px;font-size:20px">Sub Partida_B:'.$xsubpartida_b.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+18;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:540px;height:37px;font-size:15px">'.$xnsubpartida.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+100;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:20px">Equipo:'.$xnequipo.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:405px;height:37px">____________________________________________________________________</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:105px;height:37px;font-size:20px">Codigo</td>
    <td class="FilaN" style="position:absolute;left:670px;top:'.$cuentalin2.'px;width:100px;height:37px;font-size:20px;text-align:left">Despachado</td>
    <td class="FilaN" style="position:absolute;left:770px;top:'.$cuentalin2.'px;width:275px;height:37px;font-size:20px;text-align:center">Descripcion</td>
    <td class="FilaNF" style="position:absolute;left:990px;top:'.$cuentalin2.'px;width:100px;height:37px;font-size:20px">Precio $</td>
    </tr>';
    $cuentalin2=$cuentalin2+40;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:105px;height:50px;font-size:20px">'.$xarti.'</td>
    <td class="FilaN" style="position:absolute;left:670px;top:'.$cuentalin2.'px;width:150px;height:50px;font-size:20px">'.$xcanti.'</td>
    <td class="FilaN" style="position:absolute;left:770px;top:'.$cuentalin2.'px;width:275px;height:50px;font-size:20px;text-align:left">'.$xnomarti.'</td>
    <td class="FilaNF" style="position:absolute;left:990px;top:'.$cuentalin2.'px;width:100px;height:50px;font-size:20px">'.$xprecio.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td style="position:absolute;left:670px;top:'.$cuentalin2.'px;width:150px;height:37px;font-size:20px">'.$xumed.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:350px;height:37px;font-size:20px">A utilizar en:'.$xutilen.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:940px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:940px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:940px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:20px">|</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:940px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:20px">|'.$xautoriza.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:940px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:20px">|</td>
</div>
    </tr>';
    $imprivalesig=1;
    $cuentalin2=$cuentalin2+50;
    $cvppag=$cvppag+1;
  }
  //fin de impresion del segundo vale

  if($imprivalesig==1)
    {
    $cuentavales=1;
    }
    else
    {
    $cuentavales=2;
    }
  }
  //fin de si es tipo material o repuestos
  //cambiamos de registro en el lazo
  //DEBEMOS PONER INSTRUCCION DE SALTO DE PAGINA si  $cvppag=6
  if($cvppag==6)
    {
     $cuentalin=$cuentalin+50;
     $cuentalin2=$cuentalin2+50;
     $cvppag=0;
    }
  }
  //fin de while que rastrea todos los registros de vales

  echo'
  </table>

</body>
</html>';
?>