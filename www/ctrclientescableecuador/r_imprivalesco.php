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

<style>
H1.saltodepagina
{
PAGE-BREAK-AFTER:always
}
</style>



<title>S I C I O - Reporte de Vales de Salida </title>
</head>
<body>
<table cellspacing="0" class="Tabla1" style="position:absolute;left:3px;top:1px'.$alturaTabla.'px;width:1100px;page-break-after:always">
 <tr>
 </tr>';    

 $cuentavales=1;
 $xautoriza="";
 $cuentalin=10;
 $cuentalin2=10;
 $cvppag=0;
 $xtipoa="";	


 while ( $fila = mysql_fetch_array($resultado))
  {
   $xartic="";
   $xtipoa="";
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
  if($xtipoa=="2")    
  {
        $ntipoa=Null;
        $ntipob=Null;
        if($xtipoa=='2')
         {
          $ntipoa="X";
          $ntipob="";        
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
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
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
      if($xdestia=="2")
      {
        $xdestiaa="Complemento";
      }
      if($xdestia=="")
      {
        $xdestiaa="No especificado";
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
<div style="position:absolute;left:1x;top:'.$cuentalin.'px;border:1px solid ;width:535px;height:450px;">
    <tr>
    <td style="position:absolute;left:3px;top:'.$cuentalin.'px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:310px;top:'.$cuentalin.'px;width:200px;height:45px;font-size:24px">Fecha:'.$fechaimpr.'</td>
    </tr>';
    $cuentalin=$cuentalin+45;
    echo '
    <tr>
    <td style="position:absolute;left:290px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:325px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:240px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Placa:'.$xnplaca.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:400px;height:37px;font-size:24px">Hora:'.$xhora.'</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td style="position:absolute;left:6px;top:'.$cuentalin.'px;width:405px;height:37px">___________________________________________________________________</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:5px;top:'.$cuentalin.'px;width:90px;height:37px;font-size:20px">Codigo</td>
    <td class="FilaN" style="position:absolute;left:90px;top:'.$cuentalin.'px;width:115px;height:37px;font-size:20px">Despachado</td>
    <td class="FilaN" style="position:absolute;left:200px;top:'.$cuentalin.'px;width:250px;height:37px;font-size:20px;text-align:center">Descripcion</td>
    <td class="FilaNF" style="position:absolute;left:450px;top:'.$cuentalin.'px;width:78px;height:37px;font-size:20px">Precio $</td>
    </tr>';
    $cuentalin=$cuentalin+40;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:5px;top:'.$cuentalin.'px;width:90px;height:37px;font-size:20px">'.$xarti.'</td>
    <td class="FilaN" style="position:absolute;left:90px;top:'.$cuentalin.'px;width:115px;height:37px;font-size:20px">'.$xcanti.'</td>
    <td class="FilaN" style="position:absolute;left:200px;top:'.$cuentalin.'px;width:250px;height:37px;font-size:20px;text-align:left">'.$xnomarti.'</td>
    <td class="FilaNF" style="position:absolute;left:450px;top:'.$cuentalin.'px;width:78px;height:37px;font-size:20px">'.$xprecio.'</td>
    </tr>';
    $cuentalin=$cuentalin+40;
    echo '
    <tr>
    <td style="position:absolute;left:3px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">Horometro:'.$xhoro.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:3px;top:'.$cuentalin.'px;width:800px;height:37px;font-size:24px">Destino Aceite:'.$xdestiaa.'</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:170px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>
    </tr>';
    $cuentalin=$cuentalin+10;
    echo '
    <tr>
    <td style="position:absolute;left:3px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">____________</td>
    <td style="position:absolute;left:170px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">______________</td>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">______________</td>
    </tr>';
    $cuentalin=$cuentalin+30;
    echo '
    <tr>
    <td style="position:absolute;left:3px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">ENTREGADO</td>
    <td style="position:absolute;left:170px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">RECIBIDO</td>
    <td style="position:absolute;left:360px;top:'.$cuentalin.'px;width:200px;height:37px;font-size:24px">AUTORIZADO</td>
    </tr>';
    $cuentalin=$cuentalin+20;
    echo '
    <tr>
</div>
    </tr>';
    $imprivalesig=2;
    $cuentalin=$cuentalin+35;
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
      $xpartida=$row['idpartida'];
      $xsubpartida=$row['idsubpartida'];
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
      if($xdestia=="2")
      {
        $xdestiaa="Complemento";
      }
      if($xdestia=="")
      {
        $xdestiaa="No especificado";
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
<div style="position:absolute;left:560px;top:'.$cuentalin2.'px;border:1px solid ;width:550px;height:450px;">
    <tr>
    <td style="position:absolute;left:590px;top:'.$cuentalin2.'px;width:200px;height:45px;background-image:url(\'imagenes/arco_log_rpt.png\');"></td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:880px;top:'.$cuentalin2.'px;width:200px;height:45px;font-size:24px">Fecha:'.$fechaimpr.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+45;
    echo '
    <tr>
    <td style="position:absolute;left:880px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">No.</td>
    <td style="position:absolute;left:920px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">'.$fila['codigo_vale'].'</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Bodega:'.$cod_bodega.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Division:'.$xdivis.'</td>
    <td style="position:absolute;left:830px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Obra:'.$xobra.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Equipo:'.$xnequipo.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Placa:'.$xnplaca.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:400px;height:37px;font-size:24px">Hora:'.$xhora.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:405px;height:37px">____________________________________________________________________</td>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:90px;height:37px;font-size:20px">Codigo</td>
    <td class="FilaN" style="position:absolute;left:653px;top:'.$cuentalin2.'px;width:115px;height:37px;font-size:20px;text-align:left">Despachado</td>
    <td class="FilaN" style="position:absolute;left:760px;top:'.$cuentalin2.'px;width:250px;height:37px;font-size:20px;text-align:center">Descripcion</td>
    <td class="FilaNF" style="position:absolute;left:1010px;top:'.$cuentalin2.'px;width:85px;height:37px;font-size:20px">Precio $</td>
    </tr>';
    $cuentalin2=$cuentalin2+40;
    echo '
    <tr>
    <td class="FilaN" style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:90px;height:37px;font-size:20px">'.$xarti.'</td>
    <td class="FilaN" style="position:absolute;left:653px;top:'.$cuentalin2.'px;width:115px;height:37px;font-size:20px">'.$xcanti.'</td>
    <td class="FilaN" style="position:absolute;left:760px;top:'.$cuentalin2.'px;width:250px;height:37px;font-size:20px;text-align:left">'.$xnomarti.'</td>
    <td class="FilaNF" style="position:absolute;left:1010px;top:'.$cuentalin2.'px;width:85px;height:37px;font-size:20px">'.$xprecio.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+40;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">Kilometraje:'.$xkilo.'</td>
    <td style="position:absolute;left:820px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">Horometro:'.$xhoro.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:800px;height:37px;font-size:24px">Destino Aceite:'.$xdestiaa.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:760px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">'.$xautoriza.'</td>
    </tr>';
    $cuentalin2=$cuentalin2+10;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">_____________</td>
    <td style="position:absolute;left:760px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">_____________</td>
    <td style="position:absolute;left:950px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">_____________</td>
    </tr>';
    $cuentalin2=$cuentalin2+30;
    echo '
    <tr>
    <td style="position:absolute;left:560px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">ENTREGADO</td>
    <td style="position:absolute;left:760px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">RECIBIDO</td>
    <td style="position:absolute;left:950px;top:'.$cuentalin2.'px;width:200px;height:37px;font-size:24px">AUTORIZADO</td>
</div>
    </tr>';
    $cuentalin2=$cuentalin2+20;
    echo '
    <tr>
    </tr>';
    $imprivalesig=1;
    $cuentalin2=$cuentalin2+35;
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
  //DEBEMOS PONER INSTRUCCION DE SALTO DE PAGINA si  $cvppag=6;


  }
  //fin de while que rastrea todos los registros de vales

  echo'
  </table>

</body>
</html>';
?>