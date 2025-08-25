<?php
 include "./utils/validar_sesion.php";
 require_once("./utils/validar_datos.php");

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
	if(isset($_GET["spart_b"]))
	{
		$spart_b=$_GET["spart_b"];
	}

	switch ($cmb)
	{
		case '1': //cargar direcciones
			echo'<select name="Direccion" id="Direccion" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			require_once("./logica/log_facturas.php");
			$resultado=log_obtener_direccion_cmb($part);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['nmuni']."'> ".$fila['nmuni']."-".$fila['nmuni']."</option>";
			}

			break;
		case '2': //cargar cantones
			echo'<select name="SubPartidas_a" id="SubPartidas_a" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione un canton</option>';
			require_once("./logica/log_cantones.php");
			$resultado=log_obtener_cantones_cmb($part,$spart);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."-".$fila['Nombre']."</option>";
			}
			break;
		case '3': //cargar barrios
			echo'<select name="SubPartidas_b" id="SubPartidas_b" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione un Barrio...</option>';
			require_once("./logica/log_barrios.php");
			$resultado=log_obtener_barrios_cmb($part,$spart,$spart_a);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."-".$fila['Nombre']."</option>";
			}
			break;
		
		case '4': //cargar urbanizaciones
			echo'<select name="SubPartidas_c" id="SubPartidas_c" class="frm_cmb_long" onChange="CargarPartidas(this.id)"/>
			<option value="">Seleccione una Urbanizacion...</option>';
			require_once("./logica/log_caserios.php");
			$resultado=log_obtener_caserios_cmb2($part,$spart,$spart_a,$spart_b);
			while ( $fila = mysql_fetch_array($resultado))
			{
				echo "<option value='".$fila['Codigo']."'> ".$fila['Codigo']."-".$fila['Nombre']."</option>";
			}
			break;
		default: //se dispara cuando el cmb seleccionado es el de  subpartidas b
			break;
	}

?>