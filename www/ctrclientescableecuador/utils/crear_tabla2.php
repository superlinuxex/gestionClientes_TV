<?php
	function crear_tabla2($tabla, $campos, $titulo, $url,$pie,$edit_url,$delete_url,$select_url,$add_url,$conectar){
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
			case 'Idenpacinodo':	
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'detalle_depto':	
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Entradas':
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
			case 'requides_detalle':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'cambiarcos':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpacides':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpaci3':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpacicartera':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'periodos':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'actitecni2':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;

			case 'cambiopl':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'moracero':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpaci2':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpacigen':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'Idenpacicobra':
				//no se realiza accion pues no se neceita el boton de agregar nuevo
			break;
			case 'listafac':
				echo"<button class=\"btnadd\" style=\"float:right\" type=\"submit\">\n";
				echo"Volver\n";
				echo"</button>\n";
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
						echo "<a href=\"barrios.php".$select_url.$fila[0]."\"><img src=\"imagenes/page-add-child.png\" alt=\"Agregar Barrios\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
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
					case 'kardex':
						//no muestra opciones de mantenimiento en este caso
						//echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "</td>\n" ;
					break;
					case 'planes':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpaci':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" title=\"Modificar o Eliminar\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/reconectarc.png\" title=\"Reconectar\" alt=\"conectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/desconectarc.png\" title=\"Desconectar\" alt=\"desconectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/historia.png\" title=\"Historial\" alt=\"pago\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpacinodo':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/nodo.png\" title=\"Control de Nodo\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/reconectarc.PNG\" title=\"Reconectar\" alt=\"conectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/desconectarc.PNG\" title=\"Desconectar\" alt=\"desconectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/historia.png\" title=\"Historico\" alt=\"historico\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpacicobra':
						echo "<td align=\"center\">";
						//echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						// eliminado para suarios comunes echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/conectarc.png\" alt=\"conectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/historico.png\" alt=\"historico\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'Idenpacicartera':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Cambiar cobrador\" title=\"Cambiar cobrador\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						// eliminado para suarios comunes echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/conectarc.png\" alt=\"conectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/historico.png\" alt=\"historico\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpacigen':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."&id2=".$fila[1]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'Idenpacides':
						echo "<td align=\"center\">";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/desconectarc.png\" alt=\"desconectarc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'periodos':
						echo "<td align=\"center\">";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/periodos.png\" alt=\"periodosc\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'cambiopl':
						echo "<td align=\"center\">";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/cambioplan.png\" alt=\"cambiopl\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
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
					case 'actitecni':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar y asignar tarea a un tecnico\" title=\"Editar y asignar tarea a un tecnico\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						//echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" title=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[0]."\"><img src=\"imagenes/reprogramar.png\" alt=\"Reprogramar\" title=\"Reprogramar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/Ejecutar.png\" alt=\"Ejecutar\" title=\"Ejecutar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'actitecni2':
						echo "<td align=\"center\">";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" title=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;

					case 'llamadas':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" title=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$delete_url."?id=".$fila[0]."\"><img src=\"imagenes/trash.png\" alt=\"Eliminar\" title=\"Eliminar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "<a href=\"".$select_url."?id=".$fila[1]."\"><img src=\"imagenes/actividad.png\" alt=\"Solicitar visita\" title=\"Solicitar visita tecnica\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
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
					case 'Idenpaci2':
						echo "<td align=\"center\">";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/renovar.png\" alt=\"Renovar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'Idenpaci3':
						echo "<td align=\"center\">";
						echo "<a href=\"".$edit_url."?id=".$fila[0]."\"><img src=\"imagenes/user_edit.png\" alt=\"Editar\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
						echo "</td>\n" ;
					break;
					case 'moracero':
						echo "<td align=\"center\">";
						echo "<a href=\"".$conectar."?id=".$fila[0]."\"><img src=\"imagenes/moracero.png\" alt=\"Moracero\" border=\"0\" style=\"padding:0px 5px;\"/></a>\n";
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