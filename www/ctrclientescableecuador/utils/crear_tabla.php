<?php
	function crear_tabla($tabla, $campos, $titulo, $url,$pie,$edit_url,$delete_url,$select_url,$add_url){
		$columnas = count($campos);
		//$tabla=null;
		if ($tabla!=false)
		{
			$num_item = mysql_num_rows($tabla);
		}
		else
		{
			$num_item=0;
		}
		echo"<table summary=\"$titulo\">\n";
		echo"<caption>\n";
		echo"<form name=\"catalogo\" action=\"".$add_url."\" method=\"POST\">";
		switch ($titulo)
		{
			case 'detalle_partida':	
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'detalle_depto':	
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Entradas':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'facturas':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Usuarios':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Agregar Registro\n";
				echo"</button>\n";
			break;
			case 'kardex':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'Salidas':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'revistrans':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'revistrans_detalle':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'Requides':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'facturas_detalleanu':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'requides_detalle':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'facturasanu':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'facturaselim':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'gastos':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'gastoselim':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'cambiarcos':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'listafac':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Volver\n";
				echo"</button>\n";
			break;
			case 'cambiopldeta':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Nuevo Registro\n";
				echo"</button>\n";
                                $bandera="";
				echo "<a href=\"cambiopl.php".$bandera."\"><img src=\"imagenes/boton_volver.png\" alt=\"Salir\" border=\"0\" style=\"float:right\"/></a>\n";
			break;
			case 'moracerodeta':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Nuevo Registro\n";
				echo"</button>\n";
                                $bandera="";
				echo "<a href=\"moracero.php".$bandera."\"><img src=\"imagenes/boton_volver.png\" alt=\"Salir\" border=\"0\" style=\"float:right\"/></a>\n";
			break;
			case 'facturas_detalle':
				echo"</button>\n";
                                $bandera="";
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"AGREGAR ITEM\n";
				echo"</button>\n";
				echo "<a href=\"facturas.php".$bandera."\"><img src=\"imagenes/boton_volverfac.png\" title=\"Salir\" alt=\"Salir\" border=\"3\" style=\"float:left\" /></a>\n";
			break;

			case 'peridetalle':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Nuevo Registro\n";
				echo"</button>\n";
				echo "<a href=\"periodos.php".$bandera."\"><img src=\"imagenes/boton_volver.png\" alt=\"Salir\" border=\"0\" style=\"float:right\"/></a>\n";
			break;
			default:
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Nuevo Registro\n";
				echo"</button>\n";
			break;
		}



		echo"</form>\n";
		echo"</caption>\n";
		echo"<thead>\n";
		echo"<tr>\n";
		for($i = 0; $i < $columnas; $i++){
			echo "<th scope=\"col\">".$campos[$i]."</th>\n" ;
		}
		switch ($titulo)
		{
			case 'detalle_partida':	
				//no se realiza accion pues no se neceita la columna opciones
			break;
			case 'detalle_depto':	
				//no se realiza accion pues no se neceita la columna opciones
			break;
			case 'facturas_detalleanu':	
				//no se realiza accion pues no se neceita la columna opciones
			break;


			case 'Entradas':
				echo "<th scope=\"col\">Opciones</th>\n" ;
			break;

			case 'Salidas':
				echo "<th scope=\"col\">Opciones</th>\n" ;
			break;

			case 'revistrans':
				echo "<th scope=\"col\">Opciones</th>\n" ;
			break;

			case 'kardex':
				//echo "<th scope=\"col\">Opciones</th>\n" ;
			break;
			case 'listafac':
				//echo "<th scope=\"col\">Opciones</th>\n" ;
			break;
			case 'cambiopldeta':
				//echo "<th scope=\"col\">Opciones</th>\n" ;
			break;
			case 'moracerodeta':
				//echo "<th scope=\"col\">Opciones</th>\n" ;
			break;


			default:
				echo "<th scope=\"col\">Opciones</th>\n" ;
			break;
		}
		echo"</tr>\n";
		echo"</thead>\n";
		if ($pie==true){
		echo"<tfoot>\n";
		echo"<tr>\n";
		echo"<th scope=\"row\">Total</th>\n";
		echo"<td colspan=\"4\">67 designs</td>\n";
		echo"</tr>\n";
		echo"</tfoot>\n";
		}
		echo"<tbody>\n";
		if($num_item > 0){
			while($fila=mysql_fetch_array($tabla))
			{
				echo"<tr>\n" ;
				for($i = 0; $i < $columnas; $i++){
					echo"<td>" .$fila[$campos[$i]]. "</td>\n" ;
				}
				switch ($titulo)
				{
					case 'detalle_partida':	
						//no se realiza accion pues no se neceita la columna opciones
					break;
					case 'detalle_depto':	
						//no se realiza accion pues no se neceita la columna opciones
					break;
					case 'Partidas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&div=".$fila[7]."&pro=".$fila[8]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url."?id=".$fila[0]."&div=".$fila[7]."&pro=".$fila[8]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"subpartidas.php?part=".$fila[0]."&div=".$fila[7]."&pro=".$fila[8]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Subpartida\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'subpartidas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"subpartidas_a.php".$select_url.$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Subpartida A\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'deptos':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"municipios.php?part=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Municipio\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'municipios':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"cantones.php".$select_url.$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Cantones\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'cantones':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"barrios.php".$select_url.$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Barrios\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'barrios':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"caserios.php".$select_url.$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Caserios\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'caserios':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'subpartidas_b':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url.$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo"<a href=\"".$delete_url.$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Entradas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Requides':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'planbase':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'veloconec':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'tarifas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'equiad':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'promocion':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'Salidas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/impresor.png\" alt=\"Imprimir\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'listafac':
						//no necesita opciones;
					break;
					case 'facturas_detalleanu':
						//no necesita opciones;
					break;

					case 'moracerodeta':
						//no muestra opciones de mantenimiento en este caso
						//echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "</td>\n" ;
					break;


					case 'kardex':
						//no muestra opciones de mantenimiento en este caso
						//echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "</td>\n" ;
					break;
					case 'planes':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpaci':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" title=\"Editar\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" title=\"Eliminar\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/conectarc.png\" title=\"Reconectar\" alt=\"conectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/historico.png\" title=\"Historico\" alt=\"historico\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'salidas_detalle':
						echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'entradas_detalle':
						echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'requides_detalle':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'entradasasuc_detalle':
						echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'revistrans':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/document_add.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/impresor.png\" alt=\"Imprimir\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'facturas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/user_edit.png\" title=\"Editar\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/trash.png\" title=\"Eliminar\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/page-add-child.png\" title=\"Ver Detalle\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id0=".$_SESSION["idBodega"]."&id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/impresor.png\" title=\"Imprimir\" alt=\"Imprimir\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'gastos':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" title=\"Editar\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/page-add-child.png\" title=\"Ver Detalle\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'gastoselim':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'facturasanu':
						echo "<td align=\"center\">";
						echo "<a href=\"".$select_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/page-add-child.png\" title=\"Ver Detalle\" alt=\"Ver Detalle\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/anulafac.png\" title=\"Anular Factura\" alt=\"Anular Factura\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'facturaselim':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'facturas_detalle':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."&id2=".$fila[1]."&id3=".$fila[2]."&id4=".$fila[3]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";						
						echo "</td>\n" ;
					break;
					case 'gastos_detalle':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id2=".$fila[1]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."&id2=".$fila[1]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";						
						echo "</td>\n" ;
					break;


					case 'peridetalle':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'cambiopldeta':
						//no deben existir opciones de mantenimiento
					break;

					case 'revistrans_detalle':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'cambiarcos':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'talonariocf':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n
							<a href=\"".$delete_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'talonariore':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n
							<a href=\"".$delete_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'talonariocr':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n
							<a href=\"".$delete_url."?id=".$fila[0]."&id1=".$fila[1]."&id2=".$fila[2]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					default:
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n
							<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
				}
			echo"</tr>\n" ;
			}
		}
		echo "</tbody>\n</table>\n";
	}
	
	function paginacion ($num_pag,$total_registros,$url)
	{
		//$indice=$num_pag-1;
		$total_paginas = ceil($total_registros / $_SESSION["cant_reg_pag"]);
		echo "<a href=\"".$url."1\"><img src=\"imagenes/Paginacion_inicio.png\" alt=\"Inicio\" border=\"0\" style=\"padding:0px 5px;\"/></a>";
		if(($num_pag-1)> 0)
		{
			echo "<a href=\"".$url.($num_pag-1)."\"><img src=\"imagenes/Paginacion_anterior.png\" alt=\"Anterior\" border=\"0\" style=\"padding:0px 5px;\"/></a>";
		}
		else
		{
			echo "<img src=\"imagenes/Paginacion_anterior.png\" alt=\"Anterior\" border=\"0\" style=\"padding:0px 5px;\"/>";
		}
		if(($num_pag + 1)<=$total_paginas){
			echo " <a href=\"".$url.($num_pag+1)."\"><img src=\"imagenes/Paginacion_siguiente.png\" alt=\"Siguiente\" border=\"0\" style=\"padding:0px 5px;\"/></a>";
		}
		else
		{
			echo "<img src=\"imagenes/Paginacion_siguiente.png\" alt=\"Anterior\" border=\"0\" style=\"padding:0px 5px;\"/>";
		}
		echo "<a href=\"".$url.$total_paginas."\"><img src=\"imagenes/Paginacion_fin.png\" alt=\"Fin\" border=\"0\" style=\"padding:0px 5px;\"/></a>";
	}
?>