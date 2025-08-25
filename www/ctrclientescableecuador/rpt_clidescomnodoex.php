<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_clientes_connodoexcel($_GET['fd'],$_GET['fh'],$_GET['bod']);
	if( mysql_num_rows($resultado)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay registros que cumplan con esos parametros en esa sucursal. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }

	 mysql_data_seek($resultado, 0); 


//rutina para enviar a excel
$filename = "reporte_de_clientes_con_nodo.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$show_coloumn = false;
if( mysql_num_rows($resultado)!=0)
 {
  $developer_records = array();
  while ( $rows = mysql_fetch_array($resultado))
  {
   $developer_records[] = $rows;
  }
 }

if(!empty($developer_records)) {
foreach($developer_records as $record) {
if(!$show_coloumn) {
// display field/column names in first row
echo implode("\t", array_keys($record)) . "\n";
$show_coloumn = true;
}
echo implode("\t", array_values($record)) . "\n";
}
exit;    
}


//fin de rutina excel


?>