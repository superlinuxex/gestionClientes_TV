<?php
	include("./logica/log_usuarios.php");
	$menu=log_obtener_menu_ppl($_SESSION["perfil"]);
	while ($row = mysql_fetch_array($menu))
	{
		$submenu=log_obtener_menu_sub($_SESSION["perfil"],$row["columna"]);
		$num_rows = mysql_num_rows($submenu);
		if ($num_rows==0){
			echo "<li><a href=\"".$row["url"]."\">".$row["texto"]."</a></li>\n";
		}
		else
		{
			echo "<li><a href=\"".$row["url"]."\">".$row["texto"]."</a>\n";
			echo"<ul class=\"submenu\">\n";
			while($subrow=mysql_fetch_array($submenu))
			{
				echo "<li><a href=\"".$subrow["url"]."\">".$subrow["texto"]."</a></li>\n";
			}
			echo"</ul>\n</li>";
		}
	}		
?>