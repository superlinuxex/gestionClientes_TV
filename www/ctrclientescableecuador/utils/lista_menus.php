<?php
	$id=$_GET["id"];
	require_once("../logica/log_menus.php");
	$resultado=log_obtener_opciones_menu($id);
        if( mysql_num_rows($resultado)!=0){
	echo'<table>';
	echo"<thead>\n";
	echo"<tr>\n";
	echo "<th scope=\"col\">Asignado</th>\n" ;
	echo "<th scope=\"col\">Menu</th>\n" ;	
	echo"</tr>\n";
	echo"</thead>\n";
	echo"<tbody>\n";
	while($fila = mysql_fetch_array($resultado))
	{
		echo "<tr>\n";
		echo '<td align="center"><input type="checkbox" name="chk[]" value="'.$fila['id'].'" '.$fila['asignado'].'></td>';
		echo "<td>".$fila['Nombre']."</td>\n";
		echo "</tr>\n";
	}
	echo'<tr>
		<td colspan="2" align="center">
		<input  type="submit" value="Guardar Cambios"  class="btnadd" name="aceptar"/>
		</td>
		</tr>';
	echo"</tbody>\n</table>\n";
	}

 ?>