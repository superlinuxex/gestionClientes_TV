<?php
	$prod="";
	if(isset($_GET["prod"]))
	{
		$prod=$_GET["prod"];
	}
	if(trim($prod)!="")
	{
		echo'
			<select name="Producto" class="frm_cmb" />
			<option value="">Seleccione un Producto...</option>';
			require_once("./logica/log_articulos.php");
			$resultado=log_obtener_articulos_cmb_filtro($prod);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
			}
			echo'</select>';
	}
	else
	{
		echo'
			<select name="Producto" class="frm_cmb" />
			<option value="">Seleccione un Producto...</option>';
			require_once("./logica/log_articulos.php");
			$resultado=log_obtener_articulos_cmb();
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
			}
			echo'</select>';
	}
?>