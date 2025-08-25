<?php
 include "./utils/validar_sesion.php";
 require_once("./utils/validar_datos.php");
 $Encabezado=$_SESSION['parametros'];
 $codigo_salida=$Encabezado['0'];
 $bodega=$Encabezado['3'];

	$cmb=$_GET["sel"]; 
	$part=$_GET["part"];
	if(isset($_GET["spart"]))
	{
		$spart=$_GET["spart"];
	}
	if(isset($_GET["spart_a"]))
	{
		$spart_a=$_GET["spart_a"];
	}


	switch ($cmb)
	{
		case '1': //cargar subpartdas
			echo'<select name="SubPartidas" id="SubPartidas" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione una Sub-Partida...</option>';
			require_once("./logica/log_subpartidas.php");
			$resultado=log_obtener_subpartidas_cmb2($bodega,$part);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']." -----Nom.Subpartida:".$fila['Nombre']."</option>";
			}

			break;
		case '2': //cargar subpartidas a
			echo'<select name="SubPartidas_a" id="SubPartidas_a" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione una Sub-Partida A...</option>';
			require_once("./logica/log_subpartidas_a.php");
			$resultado=log_obtener_subpartidas_a_cmb2($bodega,$part,$spart);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."-----Nom.SubpartidaA:".$fila['Nombre']."</option>";
			}
			break;
		case '3': //cargar subpartidas b
			echo'<select name="SubPartidas_b" id="SubPartidas_b" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione una Sub-Partida B...</option>';
			require_once("./logica/log_subpartidas_b.php");
			$resultado=log_obtener_subpartidas_b_cmb2($bodega,$part,$spart,$spart_a);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."-----Nom.SubpartidaB:".$fila['Nombre']."</option>";
			}
			break;
		
		default: //se dispara cuando el cmb seleccionado es el de  subpartidas b
			break;
	}

?>