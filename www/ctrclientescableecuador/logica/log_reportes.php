<?php
//importando clase superiores
include 'datos/dat_reportes.php';

function log_obtener_datosmapa()
{
	return dat_obtener_datosmapa();
	exit;
}

function log_actualiza_direcciones()
{
	return dat_actualiza_direcciones();
	exit;
}

function log_obtener_hojaiden($id)
{
	return dat_obtener_hojaiden($id);
	exit;
}

function log_obtener_datosfac($id,$id0)
{
	return dat_obtener_datosfac($id,$id0);
	exit;
}

function log_obtener_datosfacww($id1,$id2,$id3,$id4)
{
	return dat_obtener_datosfacww($id1,$id2,$id3,$id4);
	exit;
}


function log_obtener_datosclie($id,$bodega)
{
	return dat_obtener_datosclie($id,$bodega);
	exit;
}

function log_obtener_remesas($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_remesas($fecha_ini,$fecha_fin,$bod);
	exit;
}



function log_obtener_ventas_deta_cf($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas_deta_cf($fecha_ini,$fecha_fin,$bod);
	exit;
}


function log_obtener_kardex($fecha_fin, $producto, $bode)
{
	return dat_obtener_kardex($fecha_fin, $producto, $bode);

	exit;
}

function log_obtener_movimientos($fecha_ini, $fecha_fin, $producto, $bode)
{
	return dat_obtener_movimientos($fecha_ini, $fecha_fin, $producto, $bode);

	exit;
}

function log_obtener_existencias($proy,$bod,$prod)
{
	return dat_obtener_existencias($proy,$bod,$prod);

	exit;
}

function log_obtener_mov_dia($fecha,$proy,$bod)
{
	return dat_obtener_mov_dia($fecha,$proy,$bod);

	exit;
}

function log_obtener_mov_salidas($fecha,$proy,$bod)
{
	return dat_obtener_mov_salidas($fecha,$proy,$bod);

	exit;
}

function log_obtener_mov_salidasco($fecha,$proy,$bod)
{
	return dat_obtener_mov_salidasco($fecha,$proy,$bod);

	exit;
}


function log_obtener_mov_sema($fecha_ini, $fecha_fin,$proy,$bod)
{
	return dat_obtener_mov_sema($fecha_ini, $fecha_fin,$proy,$bod);

	exit;
}


function log_obtener_existenciasm($proy,$bod)
{
	return dat_obtener_existenciasm($proy,$bod);

	exit;
}

function log_obtener_existenciasm2($bod)
{
	return dat_obtener_existenciasm2($bod);

	exit;
}

function log_obtener_existenciasc($proy,$bod)
{
	return dat_obtener_existenciasc($proy,$bod);

	exit;
}


function log_obtener_existenciasc2($bod)
{
	return dat_obtener_existenciasc2($bod);

	exit;
}

function log_obtener_existenciasr($proy,$bod)
{
	return dat_obtener_existenciasr($proy,$bod);

	exit;
}

function log_obtener_existenciasr2($bod)
{
	return dat_obtener_existenciasr2($bod);

	exit;
}

function log_obtener_datosvale($proy,$bod,$vale)
{
	return dat_obtener_datosvale($proy,$bod,$vale);

	exit;
}

function log_obtener_partidas_repo1($fecha_ini, $fecha_fin,$proy,$bod)
{
	return dat_obtener_partidas_repo1($fecha_ini, $fecha_fin,$proy,$bod);
	exit;
}
function log_obtener_gastos_rgastos1($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_gastos_rgastos1($fecha_ini,$fecha_fin,$bod);
	exit;
}

function log_obtener_gastosreme($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_gastosreme($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_ventas($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas($fecha_ini,$fecha_fin,$bod);
	exit;
}

function log_obtener_rangosdefacturas($fecha_ini,$fecha_fin,$bod,$tipo)
{
	return dat_obtener_rangosdefacturas($fecha_ini,$fecha_fin,$bod,$tipo);
	exit;
}



function log_obtener_ventas_d_cf($fecha_ini,$fecha_fin,$bod,$ser)
{
	return dat_obtener_ventas_d_cf($fecha_ini,$fecha_fin,$bod,$ser);
	exit;
}
function log_obtener_ventas_usuario($fecha_ini,$fecha_fin,$elusuario,$bod)
{
	return dat_obtener_ventas_usuario($fecha_ini,$fecha_fin,$elusuario,$bod);
	exit;
}


function log_obtener_ventas_deta_cr($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas_deta_cr($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_ventas_d_cr($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas_d_cr($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_ventas_cuotas($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas_cuotas($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_fac_anuladas($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_fac_anuladas($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_clientes_conec($fecha_ini,$fecha_fin,$moti,$servi,$bod)
{
	return dat_obtener_clientes_conec($fecha_ini,$fecha_fin,$moti,$servi,$bod);
	exit;
}

function log_obtener_clientes_coneccontrat($bod)
{
	return dat_obtener_clientes_coneccontrat($bod);
	exit;
}

function log_obtener_clientes_desco($fecha_ini,$fecha_fin,$moti,$servi,$bod)
{
	return dat_obtener_clientes_desco($fecha_ini,$fecha_fin,$moti,$servi,$bod);
	exit;
}

function log_obtener_clientes_mora($numemeses,$tipoinfo,$bod)
{
	return dat_obtener_clientes_mora($numemeses,$tipoinfo,$bod);
	exit;
}

function log_obtener_clientes_morameses($numemeses,$tipoinfo,$bod)
{
	return dat_obtener_clientes_morameses($numemeses,$tipoinfo,$bod);
	exit;
}


function log_obtener_clientes_descom($fecha_ini,$fecha_fin,$tipoinfo,$bod)
{
	return dat_obtener_clientes_descom($fecha_ini,$fecha_fin,$tipoinfo,$bod);
	exit;
}

function log_obtener_clientes_descomnodo($sector,$mes,$bod)
{
	return dat_obtener_clientes_descomnodo($sector,$mes,$bod);
	exit;
}

function log_obtener_clientes_avisoscf($fecha_ini,$fecha_fin,$cod,$bod)
{
	return dat_obtener_clientes_avisoscf($fecha_ini,$fecha_fin,$cod,$bod);
	exit;
}

function log_obtener_clientes_avisosre($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_clientes_avisosre($fecha_ini,$fecha_fin,$bod);
	exit;
}


function log_obtener_clientes_avisosre_sec($fecha_ini,$fecha_fin,$zo,$zo2,$bod)
{
	return dat_obtener_clientes_avisosre_sec($fecha_ini,$fecha_fin,$zo,$zo2,$bod);
	exit;
}


function log_obtener_clientes_avisoscfsegundo($fecha_ini,$fecha_fin,$cod,$bod)
{
	return dat_obtener_clientes_avisoscfsegundo($fecha_ini,$fecha_fin,$cod,$bod);
	exit;
}

function log_obtener_clientes_avisoscfsegundo_excel($fecha_ini,$fecha_fin,$cod,$bod)
{
	return dat_obtener_clientes_avisoscfsegundo_excel($fecha_ini,$fecha_fin,$cod,$bod);
	exit;
}


function log_obtener_clientes_avisosresegundo($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_clientes_avisosresegundo($fecha_ini,$fecha_fin,$bod);
	exit;
}

function log_obtener_clientes_avisosresegundoexcel($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_clientes_avisosresegundoexcel($fecha_ini,$fecha_fin,$bod);
	exit;
}

function log_obtener_clientes_connodoexcel($sector,$mes,$bod)
{
	return dat_obtener_clientes_connodoexcel($sector,$mes,$bod);
	exit;
}
function log_obtener_clientes_avisoscr($fecha_ini,$fecha_fin,$cod,$bod)
{
	return dat_obtener_clientes_avisoscr($fecha_ini,$fecha_fin,$cod,$bod);
	exit;
}

function log_obtener_clientes_avisoscrsegundo($fecha_ini,$fecha_fin,$cod,$bod)
{
	return dat_obtener_clientes_avisoscrsegundo($fecha_ini,$fecha_fin,$cod,$bod);
	exit;
}

function log_obtener_activ_ordent($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_activ_ordent($fecha_ini,$fecha_fin,$bod);
	exit;
}
function log_obtener_activ($fecha_ini,$fecha_fin,$tip,$acti,$bod)
{
	return dat_obtener_activ($fecha_ini,$fecha_fin,$tip,$acti,$bod);
	exit;
}

function log_obtener_ventas_iva($fecha_ini,$fecha_fin,$bod)
{
	return dat_obtener_ventas_iva($fecha_ini,$fecha_fin,$bod);
	exit;
}


function log_obtener_clientes_general1($fecha_ini,$fecha_fin,$tipoinfo,$bod)
{
	return dat_obtener_clientes_general1($fecha_ini,$fecha_fin,$tipoinfo,$bod);
	exit;
}

function log_obtener_listaclientes($sec1,$sec2,$estado,$muni,$pobla,$caja,$barrio)
{
	return dat_obtener_listaclientes($sec1,$sec2,$estado,$muni,$pobla,$caja,$barrio);
	exit;
}

function log_obtener_listaclientesp($sec1,$sec2)
{
	return dat_obtener_listaclientesp($sec1,$sec2);
	exit;
}

function log_obtener_clientes_general1excel($mcanton,$mzona,$tipoinfo,$tipoinfobase,$bod)
{
	return dat_obtener_clientes_general1excel($mcanton,$mzona,$tipoinfo,$tipoinfobase,$bod);
	exit;
}

function log_actualizagastos()
{
	return dat_actualizagastos();
	exit;
}
function log_obtener_cierre($fecha_fin,$lista,$bod)
{
	return dat_obtener_cierre($fecha_fin,$lista,$bod);
	exit;
}

function log_obtener_cierre_dos($fecha_fin,$lista,$bod,$cod_usuario)
{
	return dat_obtener_cierre_dos($fecha_fin,$lista,$bod,$cod_usuario);
	exit;
}



?>