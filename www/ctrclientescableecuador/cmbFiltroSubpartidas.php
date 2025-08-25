<?php

print "llego";
	$dpartida="";
	if(isset($_GET["dpartida"]))
	{
		$dpartida=$_GET["dpartida"];
		$dbod=$_GET["dbod"];
	}
	if(trim($prod)!="")
	{
		echo'
			<select name="SubPartidas" class="frm_cmb" />
			<option value="">Seleccione una Subpartida...</option>';
			require_once("./logica/log_subpartidas.php");
			$resultado=log_obtener_subpartidas_cmbtres($dbod,$dpartida);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."</option>";
			}
			echo'</select>';
	}
	else
	{
			<select name="SubPartidas" class="frm_cmb" />
			<option value="">Seleccione una Subpartida...</option>';
			require_once("./logica/log_subpartidas.php");
			$resultado=log_obtener_subpartidas_cmb();
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."</option>";
			}
			echo'</select>';
	}
?>