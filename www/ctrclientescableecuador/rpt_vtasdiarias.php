<?php
require_once("./logica/log_reportes.php");
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
.FilaNI2 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-left: 1pt solid black;
	border-bottom: 1pt solid black;
	border-top: 1pt solid black;

}

.FilaN {
	font-weight: normal;
	color: black;
	text-align: center;
	border-bottom: 1pt solid black;
	border-left: 1pt solid black;
}
.FilaN2 {
	font-weight: normal;
	color: black;
	text-align: center;
	border-top: 1pt solid black;
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
.FilaNF2 {
	font-weight: normal;
	color: black;
	text-align: right;
	border-top: 1pt solid black;
	border-left: 1pt solid black;
	border-right: 1pt solid black;
	border-bottom: 1pt solid black;
	padding-right:10px;
}
</style>

<title>Customerscabletv - Reporte de Ventas del Dia</title>
</head>
<body>
 <div style="position:absolute;top:15px;border:1px no-solid;width:100%;height:98%;">
   <div style="position:absolute;left:850px;top:10px;width:350px;height:22px;z-index:1;">
    <span style="color:#000000;font-family:Arial;font-size:12px;"><strong>Fecha: </strong>'.$_GET['fd'].'</span>
   </div>
   <div style="position:absolute;left:100px;top:50px;width:800px;height:37px;text-align:center;z-index:0;">
    <span style="color:#000000;font-family:Arial;font-size:32px;"><strong>Reporte de cobros diarios</strong></span>
   </div>
   <table cellspacing="0" class="Tabla1" style="position:absolute;left:1px;top:80px;width:98%;">
    <tr>
     <td class="FilaNI" style="height: 22px;width:120px;text-align: center;padding-right:0px;font-size:15px"><strong>No.de Caja</strong></td>
     <td class="FilaN" style="height: 22px;font-size:15px"><strong>Usuario Cajero</strong></td>
     <td class="FilaN" style="height: 22px;font-size:15px"><strong>Nombre de la sucursal</strong></td>
     <td class="FilaNF" style="height: 22px;width:120px;text-align: center;padding-right:0px;font-size:15px"><strong>Total Cobrado</strong></td>
    </tr>';	

    $fecharepo=$_GET['fd'];
    $fecharepoaa=substr($fecharepo,6,4)."-".substr($fecharepo,3,2)."-".substr($fecharepo,0,2);

    $sentencia66="select marca,caja,usuario,sucursal FROM cortescaja where fecha='".$fecharepoaa."'";
    $resultadofin = mysql_query($sentencia66) OR die(mysql_error());
    if(isset($resultadofin))
     {
      if( mysql_num_rows($resultadofin)!=0)
      {
        while ( $filad = mysql_fetch_array($resultadofin))
	 {
   	  if($filad['marca']==1)
	 {
          $cod_caja=$filad['caja'];
          $cod_usuario=$filad['usuario'];
	  $cod_bodega=$filad['sucursal'];

          //contando el total de cobros por recibos de la fecha dada
          $totfactu_cf=0;
          $lista=12;
	  $resultado=log_obtener_cierre_dos($fecharepoaa,$lista,$cod_caja,$cod_usuario);
          $totfactu_cf=$resultado;
          if($totfactu_cf>0)
           {
		 $nom_bodega="";
        	 $sentencia2 = "select nombre FROM bodegas where idbodegas='".$cod_bodega."'"; 
	         $resultado2 = mysql_query($sentencia2);
	         if(isset($resultado2))
		  {
		   if(mysql_num_rows ( $resultado2 )!=0)
		     {
		      $row=mysql_fetch_array($resultado2);
		      $nom_bodega=$row['nombre'];
        	     }
          	  }

		 $nombreusuario="";
        	 $sentencia2 = "select usuario FROM usuarios where idusuarios='".$cod_usuario."'"; 
	         $resultado2 = mysql_query($sentencia2);
	         if(isset($resultado2))
		  {
		   if(mysql_num_rows ( $resultado2 )!=0)
		     {
		      $row=mysql_fetch_array($resultado2);
		      $nombreusuario=$row['usuario'];
        	     }
          	  }

 	  echo '	
    	  <tr>
   	    <td class="FilaNI" style="height: 22px;width:50px; font-size:10px; text-align: center">'.$cod_caja.'</td>
            <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$nombreusuario.'</td>
            <td class="FilaN" style="height: 22px; font-size:10px; text-align: left">'.$nom_bodega.'</td>
	    <td class="FilaNF" style="height: 22px;font-size:10px; text-align: left">'.$totfactu_cf.'</td>
	  </tr>';
          }
         }
         }
      }
   }  
echo '
</table>
</div>
</body>
</html>';

?>