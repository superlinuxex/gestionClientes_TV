<?php
	require_once("./logica/log_reportes.php");
	$resultado=log_obtener_datosvale($_GET['proy'],$_GET['bod'],$_GET['vale']);
	if(mysql_num_rows($resultado)==0)
         {
//exit;
         }
 	 $row=mysql_fetch_array($resultado);
	 $fecha=$row['fecha'];
	 $cod_obra=$row['cod_proyecto'];
	 $nom_obra=$row['nombre_proyecto'];
	 $cod_bodega=$row['cod_bodega'];
	 $nom_bodega=$row['nombre_bodega'];
         $vale=$row['numero_vale'];
         $cod_divi=$row['cod_division'];
         $npartida=$row['num_partida'];
         $nsubpartida=$row['num_subpartida'];
         $cod_arti=$row['cod_articulo'];
         $descrip=$row['nom_articulo'];
         $cantidad=$row['cantidad']; 
         $equipo=$row['equipo'];
         $tipoa=$row['tipo_art'];
         $utilen=$row['utilizado_en'];

         $ntipoa=Null;
         $ntipob=Null;
         if($tipoa=='1')
          {
           $ntipoa="X";
           $ntipob="";        
          }
         if($tipoa=='3')
          {
           $ntipob="X";        
           $ntipob="";        
          }

         mysql_data_seek($resultado, 0); 

	
if($tipoa==2)
{	
	echo '<div style="background:url(imagenes/msg_red.png) no-repeat; padding:10px 10px 10px 10px; Color:#ce2700;">
	El vale especificado contiene salida de combustibles, utilice la opcion del reporte para tal proposito.
	</div>';
        exit;
}

?>


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


<table class="vale">

		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />
		<col />

	<tbody>

		<tr>
			<td rowspan="2" colspan="11">
				<?php //echo $html->image('logo.png', array('style' => 'width:4cm; height:0.9cm;')); 
                                 ?>
			</td>
			<td rowspan="2" colspan="9">
				<?php echo 'Fecha '.date('d-m-y', strtotime($fecha)); ?>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="2" colspan="5">
				Vale Retiro
			</td>
			<td colspan="6">
				<?php echo 'Material: '.$ntipoa; ?>
			</td>
			<td rowspan="2" colspan="9" style="font-size:12pt;">
				No.
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php
						echo $vale;
					
				?>
			</td>
		</tr>

		<tr>
			<td colspan="6">
				<?php echo 'Repuestos: '.$ntipob; ?>
			</td>
		</tr>

		<tr style="height:0.05cm">
			<td colspan="20">
			</td>
		</tr>
		<tr>
			<td colspan="20">
				Bodega:
				<span style="border-bottom:1px solid black;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $cod_bodega; ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="11">
				Division:
				<span style="border-bottom:1px solid black;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $cod_divi; ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</td>
			<td colspan="9">
				Obra:
				<span style="border-bottom:1px solid black;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $cod_obra; ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="11">
				Partida:
				<span style="border-bottom:1px solid black;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $npartida; ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</td>
			<td colspan="9">
				Sub-Partida
				<span style="border-bottom:1px solid black;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $nsubpartida; ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>


<?php
		 //Buscar el nombre del equipo 
                 $xxprodu="select nombre from equipos where codigo_equipo='".$equipo."';";
		 $resultado2=mysql_query($xxprodu);
		 $xyprodu=null;
		 if(mysql_num_rows ($resultado2)!=0)
	         {
	  	   $fila=mysql_fetch_array($resultado2);
		   $xyprodu=$fila['nombre'];
                 }
?>


		<tr>
			<td colspan="10">
				Nombre (equipo):
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $xyprodu; ?>
			</td>
		</tr>


		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>

		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>


		<tr>
			<td rowspan="2">
			A utilizar en: 
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="2">
				<?php echo ''.$utilen; ?>
				
			</td>
		</tr>
		<tr>

			<td rowspan="60" colspan="80" style="font-size:12pt;">
						Firma
			</td>
		</tr>


		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:181px;width:440px;">
			<tr>
				<td class="FilaNI" style="width:78px;height: 22px">Codigo</td>
				<td class="FilaN" style="width:55px;height: 22px">Pedido</td>
				<td class="FilaN" style="width:55px;height: 22px;font-size:7pt">Despachado</td>
				<td class="FilaNF" style="width:240px;height: 22px;text-align: center;padding-right:0px;">Descripcion</td>
			</tr>	
		</table>


		<table cellspacing="0" class="Tabla1" style="position:absolute;left:10px;top:205px;width:440px;">

			<?php

			while ( $fila = mysql_fetch_array($resultado))
			{
				echo '
					<tr>
						<td class="FilaNI" style="width:78px;height: 22px;text-align:left">'.$fila['cod_articulo'].'</td>
						<td class="FilaNI" style="width:55px;height: 22px;text-align:right">'.$fila['cantidad'].'</td>
						<td class="FilaN" style="width:55px;height: 22px;text-align:right">-</td>
						<td class="FilaNF" style="height: 22px;text-align:left">'.$fila['nom_articulo'].'</td>
					</tr>';			
			}
			?>
		</table>
	</tbody>
</table>
