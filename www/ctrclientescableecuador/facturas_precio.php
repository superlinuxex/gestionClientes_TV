<?php
if(isset($_GET["prod"]))
{
	$codProd=$_GET["prod"];
	$Encabezado=$_SESSION['parametros'];
	$bodega=$Encabezado['3'];
	require_once("./logica/log_salidas.php");
	$resultado=log_obtener_precio_prod($codProd,$bodega)
	echo'<input type="text" class="frm_txt" name="Precio" id="Precio" readonly="readonly" value="'.$resultado.'" />';
}
else
{
	echo'<input type="text" class="frm_txt" name="Precio" id="Precio" readonly="readonly" value="fail" />';
}
?>