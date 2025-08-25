<?php
//MUESTRA UN PADRON EN EXCEL DE TODOS LOS CLIENTES EN LA BASE
//rutina para enviar a excel
$mcanton=$_GET['fd'];
$mzona=$_GET['fh'];
$tipoinfo=$_GET['ti'];
$tipoinfobase=$_GET['ti2'];
$bod=$_GET['bod'];
$filename = "reporte_general_clientes.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$show_coloumn = false;
require_once("./logica/log_reportes.php");
$resultadofin=log_obtener_clientes_general1excel($mcanton,$mzona,$tipoinfo,$tipoinfobase,$bod);
	if( mysql_num_rows($resultadofin)==0)
         {
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ffffff;">
	No hay registros que mostrar. Retorne a la pagina anterior con el boton ( <== ) de su navegador
	</div>';
	exit;
         }

if( mysql_num_rows($resultadofin)!=0)
 {
  $developer_records = array();
  while ( $rows = mysql_fetch_assoc($resultadofin))
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
//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
exit;    
}
?>
